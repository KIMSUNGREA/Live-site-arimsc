<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: rtmember
 * APP SECTION		: group
 *
 * 설명 : 게시판 그룹 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

/**
 * 네비게이션 데이터
 */

$__cfg = array();
$__cfg['nav'][0] = "회원 관리";
$__cfg['page'] = "회원 관리";

//-------------------------------------------------------------------------------------------------

/**
 * 공동 데이터
 */

$_def = array();
$_def['path_app'] = $_app['app_path'];
$_def['path_admin'] = $_def['path_app']."/admin";
$_def['path_assets'] = $_def['path_app']."/assets";
$_def['func'] = ($env->_get['cf']) ? $env->_get['cf'] : "list";

//-------------------------------------------------------------------------------------------------

/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "list"	:

		$__cfg['nav'][1] = "그룹 목록";

		$_list = $dbo->fetch_list("SELECT * FROM RT_RTMEMBER_GROUP ORDER BY grp_ord ASC");
	break;

	case "form"	:

		$_r = $dbo->fetch("SELECT * FROM RT_RTMEMBER_GROUP WHERE grp_seq='".$env->_get['grp_seq']."'");

		$__cfg['nav'][1] = "정보 수정";
		$__cfg['mode'] = "modify";
	break;
}

$__cfg['page'] = "".$__cfg['page']." <span style='color:#999999;'> | ".$__cfg['nav'][1]."</span>";
?>