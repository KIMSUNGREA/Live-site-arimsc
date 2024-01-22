<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: rtboard
 * APP SECTION		: theme-info-conf
 *
 * 설명 : 게시판 환경 설정
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
$_def['func'] = ($env->_get['cf']) ? $env->_get['cf'] : "conf";

//-------------------------------------------------------------------------------------------------

/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "conf"	:

		$__cfg['nav'][2] = "환경 설정";

		$_def['mode'] = "modify";

		//게시판 환경 정보
		$_r = $dbo->fetch("SELECT * FROM RT_RTBOARD_INFO_CONF WHERE bcode='".$env->_get['bcode']."'");

		$page_cnt_gallery = explode(",", $_r['page_cnt_gallery']);
		$page_cnt_gallery_mobile = explode(",", $_r['page_cnt_gallery_mobile']);

		${"category_is_".$_r['category_is']} = "checked='checked'";
		${"comment_is_".$_r['comment_is']} = "checked='checked'";
		${"write_template_is_".$_r['write_template_is']} = "checked='checked'";
		${"list_img_is_".$_r['list_img_is']} = "checked='checked'";

		$_r['list_img_list_is'] = (empty($_r['list_img_list_is'])) ? "n":"y";
		$_r['list_img_view_is'] = (empty($_r['list_img_view_is'])) ? "n":"y";

		${"list_img_list_is_".$_r['list_img_list_is']} = "checked='checked'";
		${"list_img_view_is_".$_r['list_img_view_is']} = "checked='checked'";
		${"list_img_thumb_is_".$_r['list_img_thumb_is']} = "checked='checked'";
		${"gallery_is_".$_r['gallery_is']} = "checked='checked'";
		${"upfile_cont_is_".$_r['upfile_cont_is']} = "checked='checked'";

	break;
}

$__cfg['page'] = "".$__cfg['page']." <span style='color:#999999;'> | ".$__cfg['nav'][2]."</span>";
?>