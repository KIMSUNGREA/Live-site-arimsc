<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: rtboard
 * APP SECTION		: board-list
 *
 * 설명 : 게시판 생성/설정 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

/**
 * 네비게이션 데이터
 */

$__cfg = array();
$__cfg['nav'][0] = "게시판 관리";

//-------------------------------------------------------------------------------------------------

/**
 * 공동 데이터
 */

$_def = array();
$_def['path_app'] = $_app['app_path'];
$_def['path_admin'] = $_def['path_app']."/admin";
$_def['path_assets'] = $_def['path_app']."/assets";
$_def['path_section'] = $_def['path_admin']."/".$__sc;
$_def['func'] = ($env->_get['cf']) ? $env->_get['cf'] : "list";

//-------------------------------------------------------------------------------------------------

/**
 * 공동환경 데이터 파일 로드
 */

require_once RT_DOC_ROOT.$_app['app_path']."/config.php";

//-------------------------------------------------------------------------------------------------

/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "list"	:

		$__cfg['nav'][1] = "게시판 목록";
		$__cfg['page'] = "게시판 목록";

		$default_url = RTW_ADM."/app/?appcode=rtboard";

		$_l = $dbo->fetch_list("SELECT * FROM RT_RTBOARD AS b LEFT JOIN RT_RTBOARD_GROUP AS bg ON (b.gseq=bg.grp_seq) ORDER BY bg.grp_ord ASC, b.name ASC");
	break;

	case "form"	:

		if ($env->_get['bcode']) {

			$_bdinfo = $dbo->fetch("SELECT * FROM RT_RTBOARD WHERE bcode='".$env->_get['bcode']."'");

			$__cfg['nav'][1] = $_bdinfo['name'];
			$__cfg['nav'][2] = "게시판 정보";
			$__cfg['page'] = $_bdinfo['name'];
			$__cfg['page'] = $__cfg['page']." <span style='color:#999999;'> | ".$__cfg['nav'][2]."</span>";

			$__cfg['mode'] = "modify";

			${"theme_".$_bdinfo['theme']} = "checked='checked'";
			${"theme_select_".$_bdinfo['theme']} = "style='border:5px solid #F29661;'";
			${"state_".$_bdinfo['state']} = "checked='checked'";

		} else {

			$__cfg['nav'][1] = "새 게시판 등록";
			$__cfg['page'] = "새 게시판 등록";
			$__cfg['mode'] = "insert";

			$theme_info = "checked='checked'";
			$state_on = "checked='checked'";
		}

		$_g = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_GROUP ORDER BY grp_ord ASC");
	break;
}
?>