<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: rtmember
 * APP SECTION		: admin-setting
 *
 * 설명 : 회원 환경 설정
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
$_def['func'] = ($env->_get['cf']) ? $env->_get['cf'] : "setting";

//-------------------------------------------------------------------------------------------------

/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "setting"	:

		$__cfg['nav'][2] = "환경설정";
		$__cfg['mode'] = "modify";

		//환경설정정보
		$r = $dbo->fetch("SELECT * FROM RT_RTMEMBER_CONFIG");

		foreach($r as $k => $v) $r[$k] = stripslashes($v);

		//회원그룹정보
		$grp = $dbo->fetch_list("SELECT * FROM RT_RTMEMBER_GROUP ORDER BY grp_ord ASC");

		//템플릿 파일 리스트
		$tpl_dir = RT_DOC_ROOT.$_def['path_app']."/template";
		$tpl_files = rt_template_list($tpl_dir);

		${"mb_approval_en_".$r['mb_approval_en']} = "checked";
		${"join_permission_en_".$r['join_permission_en']} = "checked";
		${"auth_sms_en_".$r['auth_sms_en']} = "checked";
		${"auth_email_en_".$r['auth_email_en']} = "checked";
		${"agreement1_en_".$r['agreement1_en']} = "checked";
		${"agreement2_en_".$r['agreement2_en']} = "checked";
		${"agreement3_en_".$r['agreement3_en']} = "checked";

	break;
}

$__cfg['page'] = "".$__cfg['page']." <span style='color:#999999;'> | ".$__cfg['nav'][2]."</span>";
?>