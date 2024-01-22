<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: rtmember
 * APP SECTION		: admin-field
 *
 * 설명 : 게시판 데이터 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

/**
 * 네비게이션 데이터
 */

$__cfg = array();
$__cfg['nav'][0] = "회원 관리";
$__cfg['nav'][1] = "회원 모듈";
$__cfg['page'] = "회원 관리";

//-------------------------------------------------------------------------------------------------

/**
 * 공동 데이터
 */

$_def = array();
$_def['path_app'] = $_app['app_path'];
$_def['path_admin'] = $_def['path_app']."/admin";
$_def['path_assets'] = $_def['path_app']."/assets";
$_def['func'] = ($env->_get['cf']) ? $env->_get['cf'] : "field";

//-------------------------------------------------------------------------------------------------

/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "field"	:

		$__cfg['nav'][2] = "추가 필드 설정";

		//전체 필드 정보
		$_fl = $dbo->fetch_list("SELECT * FROM RT_RTMEMBER_ADD_FIELD ORDER BY formnum ASC");

		//필드 정보
		$_f = $dbo->fetch("SELECT * FROM RT_RTMEMBER_ADD_FIELD WHERE seq='".$env->_get['seq']."'");
		if (is_numeric($_f['seq'])) {

			$_def['mode'] = "modify";

			/* selected, checked */
			${'is_require_'.$_f['is_require']} = "checked";
			${'is_use_'.$_f['is_use']} = "checked";
			${'type_'.$_f['type']} = "checked";

			if ($_f['type'] == "text") {
				$trSizeWDisplay = "";
				$trSizeHDisplay = "none";
				$trDataDisplay = "none";
				$trReqDisplay = "";
				$trReqData = "";
			}

			if ($_f['type'] == "checkbox" || $_f['type'] == "radio" || $_f['type'] == "select") {
				$trSizeWDisplay = "none";
				$trSizeHDisplay = "none";
				$trDataDisplay = "";
				$trReqDisplay = "none";
				$trReqData = "none";
			}

			if ($_f['type'] == "textarea") {
				$trSizeWDisplay = "";
				$trSizeHDisplay = "";
				$trDataDisplay = "none";
				$trReqDisplay = "";
				$trReqData = "";
			}

		} else {

			$_def['mode'] = "insert";

			/* selected, checked */
			$is_require_n = "checked";
			$is_use_y = "checked";
			$type_text = "checked";

			/* hidden el */
			$trDataDisplay = "none";
			$trSizeHDisplay = "none";
		}

	break;
}

$__cfg['page'] = "".$__cfg['page']." <span style='color:#999999;'> | ".$__cfg['nav'][2]."</span>";
?>