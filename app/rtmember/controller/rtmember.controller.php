<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: RTMEMBER controller
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-----------------------------------------------------------------------------------------

if (!class_exists("rtmember"))
{
	class rtmember
	{
		var $env, $dbo, $app, $rtm, $_rtm_conf, $rt_conf_db, $cls_pg;

		//----------------------------------------------------------------------------------------------

		function rtmember() {

			global $env, $dbo, $cls_rtm, $_rtm_conf, $rt_conf_db, $cls_pg;

			$this->env = $env;
			$this->dbo = $dbo;
			$this->cls_pg = $cls_pg;
			$this->tbl = "RT_RTMEMBER";
			$this->rtm = $cls_rtm;
			$this->_rtm_conf = $_rtm_conf;
			$this->rt_conf_db = $rt_conf_db;

			//APP 정보
			$this->app = rt_app_info("rtmember");
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 스킨 출력
		 */

		function display($as_section) {

			//템틀릿 컴포넌트 로드
			rt_load_component("tpl");
			$tpl = new tpl(RT_DOC_ROOT.$this->app['app_path']);

			//스킨 파일 설정
			if ($this->_rtm_conf['mobile_skin_is'] == "y" && $this->cls_pg->conn_screen == "mobile") {

				$skin_arr['skin_login'			] = $this->_rtm_conf['mb_skin_mobile_login'];
				$skin_arr['skin_mypage'			] = $this->_rtm_conf['mb_skin_mobile_mypage'];
				$skin_arr['skin_modify'			] = $this->_rtm_conf['mb_skin_mobile_modify'];
				$skin_arr['skin_withdraw'		] = $this->_rtm_conf['mb_skin_mobile_withdraw'];
				$skin_arr['skin_find'			] = $this->_rtm_conf['mb_skin_mobile_find'];
				$skin_arr['skin_join_step1'		] = $this->_rtm_conf['mb_skin_mobile_join_step1'];
				$skin_arr['skin_join_step2'		] = $this->_rtm_conf['mb_skin_mobile_join_step2'];
				$skin_arr['skin_join_step3'		] = $this->_rtm_conf['mb_skin_mobile_join_step3'];

			} else {

				$skin_arr['skin_login'			] = $this->_rtm_conf['mb_skin_login'];
				$skin_arr['skin_mypage'			] = $this->_rtm_conf['mb_skin_mypage'];
				$skin_arr['skin_modify'			] = $this->_rtm_conf['mb_skin_modify'];
				$skin_arr['skin_withdraw'		] = $this->_rtm_conf['mb_skin_withdraw'];
				$skin_arr['skin_find'			] = $this->_rtm_conf['mb_skin_find'];
				$skin_arr['skin_join_step1'		] = $this->_rtm_conf['mb_skin_join_step1'];
				$skin_arr['skin_join_step2'		] = $this->_rtm_conf['mb_skin_join_step2'];
				$skin_arr['skin_join_step3'		] = $this->_rtm_conf['mb_skin_join_step3'];
			}

			//데이터 세팅
			require_once RT_DOC_ROOT.$this->app['app_path']."/user/index.php";

			//스킨 세팅
			$tpl->define(array(
				'rtmember' => $_def['skin']
			));

			//스킨 출력
			$tpl->print_("rtmember");
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 초기화
		 */

		function reset_app() {

			if ($this->dbo->query("TRUNCATE TABLE RT_RTMEMBER") && 
				$this->dbo->query("TRUNCATE TABLE RT_RTMEMBER_ADD_FIELD") && 
				$this->dbo->query("TRUNCATE TABLE RT_RTMEMBER_GROUP") && 
				$this->dbo->query("TRUNCATE TABLE RT_RTMEMBER_LATELY_LOG") && 
				$this->dbo->query("TRUNCATE TABLE RT_RTMEMBER_LOG")) {

				//기본 회원그룹 ins
				$this->dbo->query("INSERT INTO RT_RTMEMBER_GROUP (`grp_name`, `grp_ord`)  values ('일반회원', '1')");

				return true;
			} else {
				return false;
			}
		}

		//----------------------------------------------------------------------------------------------
	}

	$_rtmember = new rtmember(); 
}
?>