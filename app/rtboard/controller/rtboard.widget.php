<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: RTBOARD Widget Controller
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if( !class_exists("rtboard_widget") )
{
	class rtboard_widget
	{
		var $env, $dbo, $app, $rtm, $_rtm_conf;
		var $bcode, $board_info, $board_conf;

		//----------------------------------------------------------------------------------------------

		function rtboard_widget() {

			global $env, $dbo, $cls_rtm, $_rtm_conf;

			$this->env = $env;
			$this->dbo = $dbo;
			$this->rtm = $cls_rtm;
			$this->_rtm_conf = $_rtm_conf;
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 초기 설정
		 */

		function display($bcode, $hardware="pc") {

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
			$this->skin($hardware);
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 게시판 출력
		 */

		function skin($hardware) {

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
			if ($this->board_conf['mobile_skin_is'] == "y") {

				if ($hardware == "mobile") {
					foreach ($_cfg_use_func as $k => $v) {
						$skin_arr['skin_'.$v] = $skin_arr['skin_mobile_'.$v];
					}
				} else {
					if (rt_mobile_is()) {
						foreach ($_cfg_use_func as $k => $v) {
							$skin_arr['skin_'.$v] = $skin_arr['skin_mobile_'.$v];
						}
					} else {
						foreach ($_cfg_use_func as $k => $v) {
							$skin_arr['skin_'.$v] = $skin_arr['skin_pc_'.$v];
						}
					}
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
	}
}
?>