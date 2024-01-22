<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: rtboard
 * APP SECTION		: formtpl
 *
 * 설명 : 게시판 글쓰기 템플릿 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

/**
 * 네비게이션 데이터
 */

$__cfg = array();
$__cfg['nav'][0] = "글쓰기 템플릿 관리";

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
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "list"	:

		$__cfg['nav'][1] = "목록";

		$_list = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_FORM_TPL ORDER BY ord ASC");
	break;

	case "form"	:

		$__cfg['nav'][1] = "수정";
		$__cfg['mode'] = "modify";

		$_r = $dbo->fetch("SELECT * FROM RT_RTBOARD_FORM_TPL WHERE seq='".$env->_get['seq']."'");

		foreach($_r as $k => $v) $_r[$k] = stripslashes($v);
	break;
}

$__cfg['page'] = $__cfg['nav'][0]." <span style='color:#999999;'> | ".$__cfg['nav'][1]."</span>";
?>