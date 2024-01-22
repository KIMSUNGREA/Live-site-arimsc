<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: PAGE User controller
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-----------------------------------------------------------------------------------------

if (!class_exists("page_user"))
{
	class page_user
	{
		var $env, $dbo, $rt_conf_db, $_rt_page, $_rt_page_conf, $d, $ct, $data, $tbl, $cttbl;

		//----------------------------------------------------------------------------------------------

		function page_user() {

			global $env, $dbo, $rt_conf_db, $_rt_page, $_rt_page_conf;

			$this->env = $env;
			$this->dbo = $dbo;
			$this->tbl = "RT_PAGE";
			$this->cttbl = "RT_CATEGORY";

			//린트킷 공통 환경 정보
			$this->rt_conf_db = $rt_conf_db;

			//APP 정보
			$this->_rt_page = $_rt_page;

			//페이지 공통 환경 정보
			$this->_rt_page_conf = $_rt_page_conf;

			//연결 화면 설정 정보
			$this->conn_screen = "";
		}

		//----------------------------------------------------------------------------------------------

		/**
		 * 페이지 환경 데이터 설정
		 *
		 * @param		string				$as_pcd				:	페이지 코드
		 * @param		string				$as_screen			:	이동할 화면(가상페이지 접근 시 활용)
		 */

		function init($as_pcd="",$as_screen="pc") {

			//연결 화면 설정
			$this->conn_screen = rt_check_screen($as_screen);
			//$this->conn_screen = "mobile";

			//접속 페이지가 일반 HTML 페이지인 경우
			if (empty($as_pcd)) {

				// 인덱스는 별도 처리
				$_index_file = array("/","/index.php","/index.htm","/index.html",$this->_rt_page_conf['mobile_path']."/",$this->_rt_page_conf['mobile_path']."/index.php",$this->_rt_page_conf['mobile_path']."/index.htm",$this->_rt_page_conf['mobile_path']."/index.html");

				// 인덱스 페이지 인식
				if (in_array($this->env->_server['PHP_SELF'],$_index_file)) {

					// 현재 접속 화면
					$url_arr = explode("/", $this->env->_server['REQUEST_URI']);
					$mobile_path = str_replace("/","",$this->_rt_page_conf['mobile_path']);
					$req_pg = ($url_arr[1] == $mobile_path) ? "mobile" : "pc";

					if ($this->conn_screen != $req_pg) {
						if($req_pg == "mobile") {
							rt_js_move("", "self", "href", "/");exit;
						} else {
							rt_js_move("", "self", "href", $this->_rt_page_conf['mobile_path']);exit;
						}
					}
				}

				// 현재 접속 페이지명으로 등록된 사이트맵 검색
				$this->d = $this->dbo->fetch("SELECT * FROM ".$this->tbl." WHERE page_url='".$this->env->_server['PHP_SELF']."' OR page_url_m='".$this->env->_server['PHP_SELF']."'");

				// 사이트맵에 등록된 페이지이면 해당 정보를 세팅
				if (!empty($this->d['pcode'])) {

					// 이동할 페이지와 모바일/PC 매칭 설정값이 다를 경우 강제 포워딩
					if ($this->env->_server['PHP_SELF'] == $this->d['page_url']) {
						if ($this->conn_screen == "mobile" && $this->d['mobile_is'] == "y") {
							rt_js_move("", "self", "href", $this->d['page_url_m']);exit;
						}
					}
					if ($this->env->_server['PHP_SELF'] == $this->d['page_url_m']) {
						if ($this->conn_screen == "pc") {
							rt_js_move("", "self", "href", $this->d['page_url']);exit;
						}
					}

					// 페이지 사용 여부
					if ($this->d['use_is'] == "n") {
						rt_js_move("사용하지 않은 페이지입니다.", "self", "href", "/");exit;
					}

					// 포워딩 체크
					$this->check_forward();

					// 페이지 분류 정보
					$this->ct = $this->dbo->fetch("SELECT * FROM ".$this->cttbl." WHERE code='".$this->d['pcode']."'");

					// 메타 데이터 세팅
					$this->set_meta_data();

				// 사이트맵에 등록된 페이지가 아닐경우 공통 환경설정 정보를 세팅
				} else {

					$this->data['meta_title'] = $this->_rt_page_conf['meta_title'];
					$this->data['meta_desc'] = $this->_rt_page_conf['meta_desc'];
					$this->data['meta_keyword'] = $this->_rt_page_conf['meta_keyword'];
				}

			// 접속 페이지가 가상 페이지인 경우
			} else {

				$this->d = $this->dbo->fetch("SELECT * FROM ".$this->tbl." WHERE pcode='".$as_pcd."'");

				// 사이트맵에 등록된 페이지이면 해당 정보를 세팅
				if (empty($this->d['pcode'])) {
					rt_js_move("등록된 페이지가 아닙니다.", "self", "href", "/");exit;
				}

				// 페이지 사용 여부
				if ($this->d['use_is'] == "n") {
					rt_js_move("사용하지 않은 페이지입니다.", "self", "href", "/");exit;
				}

				// 포워딩 체크
				$this->check_forward();

				// 페이지 분류 정보
				$this->ct = $this->dbo->fetch("SELECT * FROM ".$this->cttbl." WHERE code='".$this->d['pcode']."'");

				// 메타 데이터 세팅
				$this->set_meta_data();
			}

			//모바일 페이지를 사용하지 않을 경우 PC 페이지로 화면 강제이동
			if ($this->conn_screen == "mobile" && $this->d['mobile_is'] == "n") {
				$_SESSION['RT_SCREEN_VIEW'] = "pc";
				rt_js_move("", "self", "href", $this->d['page_url']);exit;
			}

			// 페이지 공통 데이터
			if ($this->ct['label']) {
				$this->data['meta_title'].= " | ".$this->ct['label'];
			}
			$this->data['mobile_path'] = $this->_rt_page_conf['mobile_path'];
			$this->data['main_img'] = $this->rt_conf_db['domain'].$this->_rt_page_conf['meta_main_img'];
			$this->data['main_url'] = $this->rt_conf_db['domain'].$this->env->_server['REQUEST_URI'];
			$this->data['meta_auth_naver'] = rt_dbstr_decode($this->_rt_page_conf['meta_naver']);
			if (!empty($this->_rt_page_conf['shortcut_icon'])) {
				$this->data['shortcut_icon'] = "<link rel='icon' href='".$this->_rt_page['app_path']."/upload/".$this->_rt_page_conf['shortcut_icon']."' type='image/vnd.microsoft.icon' />";
			}
			$this->data['c_data1'] = $this->_rt_page_conf['common_data1'];
			$this->data['c_data2'] = $this->_rt_page_conf['common_data2'];
			$this->data['c_data3'] = $this->_rt_page_conf['common_data3'];
			$this->data['c_data4'] = $this->_rt_page_conf['common_data4'];
			$this->data['c_data5'] = $this->_rt_page_conf['common_data5'];
		}

		//----------------------------------------------------------------------------------------------

		/**
		 * 포워딩 설정 확인 후 처리
		 */

		function check_forward() {

			if ($this->d['forward_is'] == "y") {

				if ($this->d['forward_type_en'] == "page") {

					//포워딩할 페이지 정보 확인
					$_rf = $this->dbo->fetch("SELECT * FROM ".$this->tbl." WHERE pcode='".$this->d['forward_page']."'");
					if ($_rf['use_is'] == "y") {

						if ($_rf['page_setting_en'] == "auto") {

							$movepage = $this->_rt_page['app_path']."/?pcd=".$this->d['forward_page'];
							rt_js_move("", "self", "href", $movepage);exit;

						} else if ($_rf['page_setting_en'] == "custom") {

							//연결 화면 설정
							$forward_pos = rt_check_screen();

							if ($forward_pos == "mobile" && $_rf['mobile_is'] == "y") {
								$movepage = $this->d['page_url_m'];
							} else {
								$movepage = $this->d['page_url'];
							}
							rt_js_move("", "self", "href", $movepage);exit;
						}
					} else {
						rt_js_move("사용하지 않은 페이지입니다.", "self", "href", "/");exit;
					}

				} else if ($this->d['forward_type_en'] == "custom") {
					rt_js_move("", "self", "href", $this->d['forward_url']);exit;
				}
			}
		}

		//----------------------------------------------------------------------------------------------

		/**
		 * 메타 데이터 세팅
		 */

		function set_meta_data() {

			//메타 정보 설정
			if ($this->d['meta_common_is'] == "y") {
				$this->data['meta_title'] = $this->_rt_page_conf['meta_title'];
				$this->data['meta_desc'] = $this->_rt_page_conf['meta_desc'];
				$this->data['meta_keyword'] = $this->_rt_page_conf['meta_keyword'];
				$this->data['main_img'] = $this->rt_conf_db['domain'].$this->_rt_page_conf['meta_main_img'];
			} else {
				$this->data['meta_title'] = $this->d['meta_title'];
				$this->data['meta_desc'] = $this->d['meta_desc'];
				$this->data['meta_keyword'] = $this->d['meta_keyword'];
				$this->data['main_img'] = $this->rt_conf_db['domain'].$this->d['meta_main_img'];
			}

			//페이지 별 사용자 데이터
			$this->data['u_data1'] = $this->d['user_data1'];
			$this->data['u_data2'] = $this->d['user_data2'];
			$this->data['u_data3'] = $this->d['user_data3'];
			$this->data['u_data4'] = $this->d['user_data4'];
			$this->data['u_data5'] = $this->d['user_data5'];
		}

		//----------------------------------------------------------------------------------------------

	}
}
?>