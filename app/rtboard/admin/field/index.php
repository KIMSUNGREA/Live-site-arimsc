<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: rtboard
 * APP SECTION		: admin-field
 *
 * 설명 : 게시판 데이터 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

/**
 * 게시판 환경정보 체크
 */

$_bdinfo = $dbo->fetch("SELECT * FROM RT_RTBOARD WHERE bcode='".$env->_get['bcode']."'");

if (empty($env->_get['bcode']) || empty($_bdinfo['bcode'])) {
	rt_js_move("게시판 정보가 올바르지 않습니다.", "parent", "href", RTW_ADM);
	exit;
}

//-------------------------------------------------------------------------------------------------

/**
 * 네비게이션 데이터
 */

$__cfg = array();
$__cfg['nav'][0] = "게시판 목록";
$__cfg['nav'][1] = $_bdinfo['name'];
$__cfg['page'] = $_bdinfo['name'];

//-------------------------------------------------------------------------------------------------

/**
 * 공동 데이터
 */

$_def = array();
$_def['path_app'] = $_app['app_path'];
$_def['path_admin'] = $_def['path_app']."/admin";
$_def['path_assets'] = $_def['path_app']."/assets";
$_def['path_section'] = $_def['path_admin']."/".$__sc;
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
		$_fl = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_ADD_FIELD WHERE bcode='".$env->_get['bcode']."' ORDER BY formnum ASC");

		//필드 정보
		$_f = $dbo->fetch("SELECT * FROM RT_RTBOARD_ADD_FIELD WHERE seq='".$env->_get['seq']."'");
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