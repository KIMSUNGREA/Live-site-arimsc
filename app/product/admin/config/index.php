<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: product
 * APP SECTION		: admin-config
 *
 * 설명 : 제품 환경 설정
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

/**
 * 네비게이션 데이터
 */

$__cfg = array();
$__cfg['nav'][0] = "제품 관리";
$__cfg['nav'][1] = "환경 설정";
$__cfg['page'] = "제품 관리";

//-------------------------------------------------------------------------------------------------

/**
 * 공동 데이터
 */

$_def = array();
$_def['path_app'] = $_app['app_path'];
$_def['path_admin'] = $_def['path_app']."/admin";
$_def['path_assets'] = $_def['path_app']."/assets";
$_def['func'] = ($env->_get['cf']) ? $env->_get['cf'] : "config";

//-------------------------------------------------------------------------------------------------

/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "config"	:

		$__cfg['nav'][2] = "환경 설정";
		$__cfg['mode'] = "modify";

		//회원 그룹 정보
		$mgrp = $dbo->fetch_list("SELECT * FROM RT_RTMEMBER_GROUP ORDER BY grp_ord ASC");

		//환경설정정보
		$_r = $dbo->fetch("SELECT * FROM RT_PRODUCT_CONF");

		//이용권한설정
		$auth_list_arr = unserialize(html_entity_decode($_r['auth_list']));
		$auth_read_arr = unserialize(html_entity_decode($_r['auth_read']));

		//템플릿 파일 리스트
		$tpl_dir = RT_DOC_ROOT.$_def['path_app']."/template";
		$tpl_files = rt_template_list($tpl_dir);

		${"comment_is_".$_r['comment_is']} = "checked";
		${"img_thumb_is_".$_r['img_thumb_is']} = "checked";

	break;
}

$__cfg['page'] = "".$__cfg['page']." <span style='color:#999999;'> | ".$__cfg['nav'][2]."</span>";
?>