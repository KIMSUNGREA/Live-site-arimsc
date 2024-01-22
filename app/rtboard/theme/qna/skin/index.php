<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: rtboard
 * APP SECTION		: theme-qna-skin
 *
 * 설명 : 게시판 스킨 설정
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
$_def['path_theme'] = $_def['path_app']."/theme/".$_bdinfo['theme'];
$_def['path_files'] = $_def['path_app']."/files";
$_def['path_assets'] = $_def['path_app']."/assets";
$_def['path_section'] = $_def['path_theme']."/".$__sc;
$_def['func'] = ($env->_get['cf']) ? $env->_get['cf'] : "skin";

//-------------------------------------------------------------------------------------------------

/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "skin"	:

		$__cfg['nav'][2] = "스킨 설정";

		$_def['mode'] = "modify";

		//회원 그룹 정보
		$mgrp = $dbo->fetch_list("SELECT * FROM RT_RTMEMBER_GROUP ORDER BY grp_ord ASC");

		//게시판 환경 정보
		$_r = $dbo->fetch("SELECT * FROM RT_RTBOARD_QNA_CONF WHERE bcode='".$env->_get['bcode']."'");

		$skin_arr = unserialize(html_entity_decode($_r['skin_txt']));

		//템플릿 파일 리스트
		$tpl_dir = RT_DOC_ROOT.$_def['path_app']."/template";
		$tpl_files = rt_template_list($tpl_dir);

		${"mobile_skin_is_".$_r['mobile_skin_is']} = "checked='checked'";
		${"mobile_skin_is_class_".$_r['mobile_skin_is']} = "class='check'";

	break;
}

$__cfg['page'] = "".$__cfg['page']." <span style='color:#999999;'> | ".$__cfg['nav'][2]."</span>";
?>