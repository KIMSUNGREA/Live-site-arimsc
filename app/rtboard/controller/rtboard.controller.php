<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: RTBOARD Controller
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if( !class_exists("rtboard") )
{
	class rtboard
	{
		var $env, $dbo, $app, $rtm, $_rtm_conf, $bfile, $ibfile;
		var $bcode, $board_info, $board_conf, $cls_pg, $rt_conf_db;

		//----------------------------------------------------------------------------------------------

		function rtboard() {

			global $env, $dbo, $cls_rtm, $_rtm_conf, $cls_pg, $rt_conf_db;

			$this->env = $env;
			$this->dbo = $dbo;
			$this->cls_pg = $cls_pg;
			$this->rt_conf_db = $rt_conf_db;
			$this->rtm = $cls_rtm;
			$this->_rtm_conf = $_rtm_conf;
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 초기 설정
		 */

		function display($bcode) {

			$this->bcode = $bcode;

			//APP 정보
			$this->app = rt_app_info("rtboard");

			//게시판 등록 정보
			$this->board_info = $this->dbo->fetch("SELECT * FROM RT_RTBOARD WHERE bcode='".$this->bcode."'");
			if ($this->board_info['state'] != "on") {
				rt_js_move("운영되지 않는 게시판입니다.", "parent", "href", "/");
				exit;
			}

			//게시판 환경 정보
			$this->board_conf = $this->dbo->fetch("SELECT * FROM RT_RTBOARD_".strtoupper($this->board_info['theme'])."_CONF WHERE bcode='".$this->bcode."'");

			//게시판 출력
			$this->skin();
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 게시판 출력
		 */

		function skin() {

			//게시판 환경정보 체크
			if (empty($this->board_info['bcode'])) {
				rt_js_move("게시판 정보가 올바르지 않습니다.", "parent", "href", "/");
				exit;
			}

			//템플릿 컴포넌트 로드
			rt_load_component("tpl");
			$tpl = new tpl(RT_DOC_ROOT.$this->app['app_path']);

			//템플릿 설정 스킨
			$skin_arr = unserialize(html_entity_decode($this->board_conf['skin_txt']));

			//기능 페이지 설정 목록
			require_once RT_DOC_ROOT.$this->app['app_path']."/theme/".$this->board_info['theme']."/lib/config.php";

			//모바일 스킨 사용여부
			if ($this->board_conf['mobile_skin_is'] == "y" && $this->cls_pg->conn_screen == "mobile") {

				foreach ($_cfg_use_func as $k => $v) {
					$skin_arr['skin_'.$v] = $skin_arr['skin_mobile_'.$v];
				}

			} else {

				foreach ($_cfg_use_func as $k => $v) {
					$skin_arr['skin_'.$v] = $skin_arr['skin_pc_'.$v];
				}
			}

			//데이터 세팅
			require_once RT_DOC_ROOT.$this->app['app_path']."/theme/".$this->board_info['theme']."/user/index.php";

			//스킨 세팅
			$tpl->define(array(
				'board' => $_def['skin']
			));

			//스킨 출력
			$tpl->print_("board");
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 접근 권한 설정
		*
		* @param	string					$auth_part		:	접근 권한 종류(func 명)
		* @return	array
		 */

		function check_auth($auth_part) {

			$arsz = unserialize(html_entity_decode($this->board_conf['auth_'.$auth_part]));

			$auth_is = false;
			if (count($arsz) > 0) {

				if ($this->rtm->is_login()) {

					for ($m = 0; $m < count($arsz); $m++) {
						if ($arsz[$m] == $this->rtm->gr) {
							$auth_is = true;
						}
					}

				} else {
					$auth_is = (is_numeric($arsz[0]) && $arsz[0] == "0") ? true : false;
				}
			}

			return $auth_is;
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 초기화
		 */

		function reset_app() {

			$this->bfile = $this->dbo->fetch_list("SELECT * FROM RT_RTBOARD_FILES");
			$this->ibfile = $this->dbo->fetch_list("SELECT * FROM RT_RTBOARD_INFO");

			for ($m =0 ; $m < count($this->bfile) ; $m++) {
				if ($this->bfile[$m]['file_new']) {
					rt_file_delete($this->bfile[$m]['path_base'].$this->bfile[$m]['path_sub'],$this->bfile[$m]['file_new']);
				}
			}
			for ($m =0 ; $m < count($this->ibfile) ; $m++) {
				if ($this->ibfile[$m]['list_img_new']) {
					rt_file_delete($this->ibfile[$m]['list_img_dir'],$this->ibfile[$m]['list_img_new']);
					rt_file_delete($this->ibfile[$m]['list_img_dir']."thumb/",$this->ibfile[$m]['list_img_thumb']);
				}
			}

			if ($this->dbo->query("TRUNCATE TABLE RT_RTBOARD") && 
				$this->dbo->query("TRUNCATE TABLE RT_RTBOARD_FILES") && 
				$this->dbo->query("TRUNCATE TABLE RT_RTBOARD_ADD_FIELD") && 
				$this->dbo->query("TRUNCATE TABLE RT_RTBOARD_CMT") && 
				$this->dbo->query("TRUNCATE TABLE RT_RTBOARD_GROUP") && 
				$this->dbo->query("TRUNCATE TABLE RT_RTBOARD_INFO") && 
				$this->dbo->query("TRUNCATE TABLE RT_RTBOARD_INFO_CONF") && 
				$this->dbo->query("TRUNCATE TABLE RT_RTBOARD_NORM") && 
				$this->dbo->query("TRUNCATE TABLE RT_RTBOARD_NORM_CONF") && 
				$this->dbo->query("TRUNCATE TABLE RT_RTBOARD_QNA") && 
				$this->dbo->query("TRUNCATE TABLE RT_RTBOARD_QNA_CONF")) {

				return true;
			} else {
				return false;
			}
		}

		//----------------------------------------------------------------------------------------------
	}
}
?>