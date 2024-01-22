<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: rtmember
 * APP SECTION		: admin-data
 *
 * 설명 : 게시판 생성/설정 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

/**
 * 컴포넌트 로드
 */

rt_load_component("board");

//-------------------------------------------------------------------------------------------------

/**
 * 컨트롤러 로드
 */
require_once RT_DOC_ROOT.$_app['app_path']."/config/rtmember.config.php";
require_once RT_DOC_ROOT.$_app['app_path']."/controller/rtmember.admin.controller.php";
$cls_mem = new rtmember_admin();

//-------------------------------------------------------------------------------------------------

/**
 * 네비게이션 데이터
 */

$__cfg = array();
$__cfg['nav'][0] = "회원 관리";
$__cfg['nav'][1] = "회원 목록";
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

//회원 등급명
$grp = $dbo->fetch_list("SELECT * FROM RT_RTMEMBER_GROUP ORDER BY grp_ord ASC");
for ($m = 0; $m < count($grp); $m++) {
	$grp_cfg[$grp[$m]['grp_seq']] = $grp[$m]['grp_name'];
}

//-------------------------------------------------------------------------------------------------

/**
 * 게시판 환경 데이터
 */

$add_qry = array(); //DB 쿼리 배열
$add_url = ""; //전달 변수 배열

//고정 URL
$add_url.= "appcode=rtmember&sd=".$env->_get['sd'];

//변동 쿼리
if ($env->_get['search'] && $env->_get['searchstring']) {
	$add_qry[] = "(".$env->_get['search']." LIKE '%".$env->_get['searchstring']."%')";
	$add_url.= "&search=".$env->_get['search']."&searchstring=".$env->_get['searchstring'];
}

if ($env->_get['buy_en']) {
	$add_qry[] = "(buy_en='".$env->_get['buy_en']."')";
	$add_url.= "&buy_en=".$env->_get['buy_en'];
}

if (count($add_qry) > 0) {
	$str_add_qry = implode(" AND ", $add_qry);
	$cls_mem->set_fix_where_qry($str_add_qry);
}
$cls_mem->set_fix_url_val($add_url);
$cls_mem->init();

//-------------------------------------------------------------------------------------------------

/**
 * 추가 필드 정보
 */

$_fset = $dbo->fetch_list("SELECT * FROM RT_RTMEMBER_ADD_FIELD WHERE is_use='y' ORDER BY formnum ASC");

//-------------------------------------------------------------------------------------------------

/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "list"	:

		$conf = $dbo->fetch("SELECT * FROM RT_RTMEMBER_CONFIG LIMIT 1");

		if ($env->_get['buy_en']=="y") {
			$__cfg['nav'][2] = "구매회원";
		} else if ($env->_get['buy_en']=="n") {
			$__cfg['nav'][2] = "일반회원";
		} else {
			$__cfg['nav'][2] = "전체회원";
		}

		$env->_get['pg'] = (empty($env->_get['pg'])) ? 1 : $env->_get['pg'];
		$base_url = RTW_ADM."/app/";
	break;

	case "form"	:

		require_once RT_DOC_ROOT.$_app['app_path']."/config/rtmember.config.php";

		$_r = $dbo->fetch("SELECT * FROM RT_RTMEMBER WHERE seq='".$env->_get['seq']."'");
		$grp = $dbo->fetch_list("SELECT * FROM RT_RTMEMBER_GROUP ORDER BY grp_ord ASC");

		//정보 입력 구분 설정
		if ($_r['seq']) {

			$__cfg['nav'][2] = "정보 수정";
			$__cfg['mode'] = "modify";

			//추가 필드 정보
			$sz = unserialize(html_entity_decode($_r['extvar']));

			$email = explode("@", $_r['email']);
			$phone = explode("-", $_r['phone']);

			${"class_".$_r['class']} = "checked";
			${"email_en_".$_r['email_en']} = "checked";
			${"sms_en_".$_r['sms_en']} = "checked";
			${"rest_en_".$_r['rest_en']} = "checked";
			${"blockout_en_".$_r['blockout_en']} = "checked";
			${"withdraw_en_".$_r['withdraw_en']} = "checked";

			$_r['reg_date'] = substr($_r['reg_date'], 0, 10);
			$_r['rest_date'] = substr($_r['rest_date'], 0, 10);
			$_r['mod_date'] = substr($_r['mod_date'], 0, 10);
			$_r['blockout_date'] = substr($_r['blockout_date'], 0, 10);
			$_r['withdraw_date'] = substr($_r['withdraw_date'], 0, 10);

		} else {

			$__cfg['nav'][2] = "수기 입력";
			$__cfg['mode'] = "insert";

			$_r['recode'] = time();

			$class_m = "checked";
			$email_en_y = "checked";
			$sms_en_y = "checked";
			$rest_en_n = "checked";
			$blockout_en_n = "checked";
			$withdraw_en_n = "checked";

		}
	break;

	case "view"	:

		//정보 입력 구분 설정
		if ($env->_get['seq']) {

			$__cfg['nav'][2] = "정보 보기";

			$_r = $dbo->fetch("SELECT * FROM RT_RTMEMBER WHERE seq='".$env->_get['seq']."'");

			//추가 필드 정보
			$sz = unserialize(html_entity_decode($_r['extvar']));

		} else {

			rt_js_move("등록된 데이터가 없습니다.", "parent", "href", RTW_ADM);
		}
	break;

}

$__cfg['page'] = "".$__cfg['page']." <span style='color:#999999;'> | ".$__cfg['nav'][2]."</span>";
?>