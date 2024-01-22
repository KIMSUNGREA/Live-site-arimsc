<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: rtmember
 * APP SECTION		: admin-find
 *
 * 설명 : 회원 로그인관련 설정
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
$__cfg['page'] = "회원 모듈";

//-------------------------------------------------------------------------------------------------

/**
 * 공동 데이터
 */

$_def = array();
$_def['path_app'] = $_app['app_path'];
$_def['path_admin'] = $_def['path_app']."/admin";
$_def['path_assets'] = $_def['path_app']."/assets";
$_def['func'] = ($env->_get['cf']) ? $env->_get['cf'] : "find";

//-------------------------------------------------------------------------------------------------

/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "find"	:

		$__cfg['nav'][2] = "계정찾기 환경설정";
		$__cfg['mode'] = "modify";

		//환경설정정보
		$r = $dbo->fetch("SELECT * FROM RT_RTMEMBER_CONFIG");

		foreach($r as $k => $v) $r[$k] = stripslashes($v);

		//템플릿 파일 리스트
		$tpl_dir = RT_DOC_ROOT.$_def['path_app']."/template";
		$tpl_files = rt_template_list($tpl_dir);

		${"find_type_en_".$r['find_type_en']} = "checked";

	break;
}

$__cfg['page'] = "".$__cfg['page']." <span style='color:#999999;'> | ".$__cfg['nav'][2]."</span>";
?>