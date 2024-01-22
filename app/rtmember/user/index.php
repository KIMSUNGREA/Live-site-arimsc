<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 사용자 출력 데이터
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-----------------------------------------------------------------------------------------

/**
 * 공동 데이터
 */

$_def = array();
$_def['path_app'] = $this->app['app_path'];
$_def['path_user'] = $_def['path_app']."/user";
$_def['path_assets'] = $_def['path_app']."/assets";
$_def['path_tpl'] = $_def['path_app']."/template";
$_def['func'] = ($as_section) ? $as_section : "login";
$_def['acturl'] = ($this->rt_conf_db['ssl_is'] == "y")?$this->rt_conf_db['ssl_url']:$this->rt_conf_db['ssl_url_n'];

if ($_def['func'] == "join") {
	$_def['skin'] = ($this->env->_get['cf']) ? $this->env->_get['cf'] : "step1";
} else if ($_def['func'] == "mypage") {
	$_def['skin'] = ($this->env->_get['cf']) ? $this->env->_get['cf'] : "mypage";
} else {
	$_def['skin'] = $_def['func'];
}

//모듈 설치 페이지 정보
if ($this->_rtm_conf['mobile_skin_is'] == "y" && $this->cls_pg->conn_screen == "mobile") {
	$_def['page_join'] = $this->_rtm_conf['join_set_mobile_page'];
	$_def['page_login'] = $this->_rtm_conf['login_set_mobile_page'];
	$_def['page_mypage'] = $this->_rtm_conf['mypage_set_mobile_page'];
	$_def['page_modify'] = $this->_rtm_conf['mypage_set_mobile_page']."?cf=modify";
	$_def['page_withdraw'] = $this->_rtm_conf['mypage_set_mobile_page']."?cf=withdraw";
	$_def['page_find'] = $this->_rtm_conf['find_set_mobile_page'];
} else {
	$_def['page_join'] = $this->_rtm_conf['join_set_page'];
	$_def['page_login'] = $this->_rtm_conf['login_set_page'];
	$_def['page_mypage'] = $this->_rtm_conf['mypage_set_page'];
	$_def['page_modify'] = $this->_rtm_conf['mypage_set_page']."?cf=modify";
	$_def['page_withdraw'] = $this->_rtm_conf['mypage_set_page']."?cf=withdraw";
	$_def['page_find'] = $this->_rtm_conf['find_set_page'];
}

//가상 페이지일 경우 주소 재구성
if (!empty($this->env->_get['pcd'])) {

	$_mb_login = $this->dbo->fetch("SELECT * FROM ".$this->cls_pg->tbl." WHERE page_url='".$_def['page_login']."' OR page_url_m='".$_def['page_login']."'");
	$_mb_join = $this->dbo->fetch("SELECT * FROM ".$this->cls_pg->tbl." WHERE page_url='".$_def['page_join']."' OR page_url_m='".$_def['page_join']."'");
	$_mb_mypage = $this->dbo->fetch("SELECT * FROM ".$this->cls_pg->tbl." WHERE page_url='".$_def['page_mypage']."' OR page_url_m='".$_def['page_mypage']."'");
	$_mb_find = $this->dbo->fetch("SELECT * FROM ".$this->cls_pg->tbl." WHERE page_url='".$_def['page_find']."' OR page_url_m='".$_def['page_find']."'");

	$addmurl = ($this->cls_pg->conn_screen == "mobile") ? "&screen=mobile":"";

	$tpl->assign('page_login', $this->cls_pg->_rt_page['app_path']."/?pcd=".$_mb_login['pcode'].$addmurl);
	$tpl->assign('page_join', $this->cls_pg->_rt_page['app_path']."/?pcd=".$_mb_join['pcode'].$addmurl);
	$tpl->assign('page_mypage', $this->cls_pg->_rt_page['app_path']."/?pcd=".$_mb_mypage['pcode'].$addmurl);
	$tpl->assign('page_modify', $this->cls_pg->_rt_page['app_path']."/?pcd=".$_mb_mypage['pcode']."&cf=modify".$addmurl);
	$tpl->assign('page_withdraw', $this->cls_pg->_rt_page['app_path']."/?pcd=".$_mb_mypage['pcode']."&cf=withdraw".$addmurl);
	$tpl->assign('page_find', $this->cls_pg->_rt_page['app_path']."/?pcd=".$_mb_find['pcode'].$addmurl);
} else {
	$tpl->assign('page_login', $_def['page_login']);
	$tpl->assign('page_join', $_def['page_join']);
	$tpl->assign('page_mypage', $_def['page_mypage']);
	$tpl->assign('page_modify', $_def['page_modify']);
	$tpl->assign('page_withdraw', $_def['page_withdraw']);
	$tpl->assign('page_find', $_def['page_find']);
}

$tpl->assign('이동화면', $this->cls_pg->conn_screen);
$tpl->assign('페이지코드', $this->env->_get['pcd']);
$tpl->assign('php_self', $this->env->_server['PHP_SELF']);
$tpl->assign('path_user', $_def['path_user']);
$tpl->assign('path_assets', $_def['path_assets']);
$tpl->assign('ssl', $_def['ssl']);//보안 HTTPS 주소
$tpl->assign('ssl_n', $_def['ssl_n']);//일반 HTTP 주소

$tpl->assign('캐시버전', time());

//공동 환경변수 파일
require_once RT_DOC_ROOT.$_def['path_app']."/config/rtmember.config.php";

//-------------------------------------------------------------------------------------------------

/**
 * 추가필드 정보
 */

$_fset = $this->dbo->fetch_list("SELECT * FROM RT_RTMEMBER_ADD_FIELD WHERE is_use='y' ORDER BY formnum ASC");

//-------------------------------------------------------------------------------------------------

/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['skin'])
{
	case "login"	:

		if ($this->rtm->is_login()) {
			rt_js_msg("이미 로그인되어 있습니다");
		}

		$save_adm_id = rt_get_cookie("save_adm_id");

		if (empty($this->env->_cookie['save_adm_id'])) {
			$is_save_id =  "";
		} else {
			$is_save_id =  "checked='checked'";
		}

		$tpl->assign('prepage', $this->env->_get['prepage']);
		$tpl->assign('아이디', $save_adm_id);
		$tpl->assign('아이디기억하기', $is_save_id);

		$_def['skin'] = $skin_arr['skin_login'];
	break;

	case "step1"	:

		if ($this->_rtm_conf['join_permission_en'] == "n") {
			rt_js_move("당분간 회원을 받지 않습니다.", "self", "href", "/");
			exit;
		}

		if ($this->rtm->is_login()) {
			rt_js_move("이미 로그인되어 있습니다", "self", "href", "/");
			exit;
		}

		$tpl->assign('agreement1_title', $this->_rtm_conf['agreement1_title']);
		$tpl->assign('agreement2_title', $this->_rtm_conf['agreement2_title']);
		$tpl->assign('agreement1_txt', stripslashes($this->_rtm_conf['agreement1_txt']));
		$tpl->assign('agreement2_txt', stripslashes($this->_rtm_conf['agreement2_txt']));

		$_def['skin'] = $skin_arr['skin_join_step1'];
	break;

	case "step2"	:

		if ($this->_rtm_conf['join_permission_en'] == "n") {
			rt_js_move("당분간 회원을 받지 않습니다.", "self", "href", "/");
			exit;
		}

		if ($this->rtm->is_login()) {
			rt_js_move("이미 로그인되어 있습니다", "self", "href", "/");
			exit;
		}

		//추가 필드 데이터
		$sz = unserialize(html_entity_decode($r['extvar']));

		$addfield = array();
		for ($m = 0; $m < count($_fset); $m++) {
			$r['추가_'.$_fset[$m]['name']] = $this->rtm->formset($_fset[$m], $sz, false, true);
			$addfield[$m]['필드명'] = $_fset[$m]['name'];
			$addfield[$m]['데이터'] = $this->rtm->formset($_fset[$m], $sz, false, true);
		}
		$tpl->assign('추가필드', $addfield);

		$addfield_is = (count($_fset) > 0) ? "y":"n";
		$tpl->assign('추가필드여부', $addfield_is);

		for ($m = 0; $m < count($_rtm_cfg['email']); $m++) {
			$_email[$m]['도메인'] = $_rtm_cfg['email'][$m];
		}

		for ($m = 0; $m < count($_rtm_cfg['phone']); $m++) {
			$_phone[$m]['국번'] = $_rtm_cfg['phone'][$m];
		}

		$tpl->assign('메일리스트', $_email);
		$tpl->assign('국번리스트', $_phone);
		$tpl->assign('SMS인증', $this->_rtm_conf['auth_sms_en']);

		$tpl->assign('agreement1_title', $this->_rtm_conf['agreement1_title']);
		$tpl->assign('agreement2_title', $this->_rtm_conf['agreement2_title']);
		$tpl->assign('agreement1_txt', nl2br(stripslashes($this->_rtm_conf['agreement1_txt'])));
		$tpl->assign('agreement2_txt', nl2br(stripslashes($this->_rtm_conf['agreement2_txt'])));

		$_def['skin'] = $skin_arr['skin_join_step2'];
	break;

	case "step3"	:

		if ($this->rtm->is_login()) {
			rt_js_move("이미 로그인되어 있습니다", "self", "href", "/");
			exit;
		}

		$tpl->assign('가입아이디', $this->env->_get['memid']);

		$_def['skin'] = $skin_arr['skin_join_step3'];
	break;

	case "mypage"	:

		$r = $this->rtm->get_member_info();
		if (empty($r['user_id'])) {
			rt_js_move("", "self", "href", $this->_rtm_conf['login_set_page']."?prepage=".urlencode($this->env->_server['REQUEST_URI']));
			exit;
		}

		//템플릿코드 설정
		$r['아이디'] = $r['user_id'];
		$r['이름'] = $r['user_nm'];
		$r['회원등급'] = $r['mgroup'];
		$r['SNS구분'] = $r['lgubun'];
		$r['이메일'] = $r['email'];
		$r['전화번호'] = $r['phone'];
		$r['메일수신'] = ($r['email_en']=="y")?"동의함":"동의안함";
		$r['SMS수신'] = ($r['sms_en']=="y")?"동의함":"동의안함";
		$r['가입일'] = $r['reg_date'];
		$r['수정일'] = $r['mod_date'];

		//추가 필드 데이터
		$sz = unserialize(html_entity_decode($r['extvar']));

		$addfield = array();
		for ($m = 0; $m < count($_fset); $m++) {
			$r['추가_'.$_fset[$m]['name']] = $this->rtm->formset_data($_fset[$m], $sz);
			$addfield[$m]['필드명'] = $_fset[$m]['name'];
			$addfield[$m]['데이터'] = $this->rtm->formset_data($_fset[$m], $sz);
		}
		$tpl->assign('추가필드', $addfield);

		$addfield_is = (count($_fset) > 0) ? "y":"n";
		$tpl->assign('추가필드여부', $addfield_is);

		$tpl->assign('회원', $r);

		$_def['skin'] = $skin_arr['skin_mypage'];
	break;

	case "modify"	:

		$r = $this->rtm->get_member_info();
		if (empty($r['user_id'])) {
			rt_js_move("", "self", "href", $this->_rtm_conf['login_set_page']."?prepage=".urlencode($this->env->_server['REQUEST_URI']));
			exit;
		}

		for ($m = 0; $m < count($_rtm_cfg['email']); $m++) {
			$_email[$m]['도메인'] = $_rtm_cfg['email'][$m];
		}

		for ($m = 0; $m < count($_rtm_cfg['phone']); $m++) {
			$_phone[$m]['국번'] = $_rtm_cfg['phone'][$m];
		}

		//템플릿코드 설정
		$arr_email = explode("@", $r['email']);
		$arr_phone = explode("-", $r['phone']);

		$r['아이디'] = $r['user_id'];
		$r['이름'] = $r['user_nm'];
		$r['회원등급'] = $r['mgroup'];
		$r['SNS구분'] = $r['lgubun'];
		$r['이메일아이디'] = $arr_email[0];
		$r['이메일도메인'] = $arr_email[1];
		$r['전화번호1'] = $arr_phone[0];
		$r['전화번호2'] = $arr_phone[1];
		$r['전화번호3'] = $arr_phone[2];
		$r['메일수신'] = $r['email_en'];
		$r['SMS수신'] = $r['sms_en'];
		$r['가입일'] = $r['reg_date'];
		$r['수정일'] = $r['mod_date'];

		//추가 필드 데이터
		$sz = unserialize(html_entity_decode($r['extvar']));

		$addfield = array();
		for ($m = 0; $m < count($_fset); $m++) {
			$r['추가_'.$_fset[$m]['name']] = $this->rtm->formset($_fset[$m], $sz, false, true);
			$addfield[$m]['필드명'] = $_fset[$m]['name'];
			$addfield[$m]['데이터'] = $this->rtm->formset($_fset[$m], $sz, false, true);
		}
		$tpl->assign('추가필드', $addfield);

		$addfield_is = (count($_fset) > 0) ? "y":"n";
		$tpl->assign('추가필드여부', $addfield_is);

		$tpl->assign('회원', $r);
		$tpl->assign('메일리스트', $_email);
		$tpl->assign('국번리스트', $_phone);

		$_def['skin'] = $skin_arr['skin_modify'];
	break;

	case "find"	:

		if ($this->rtm->is_login()) {
			rt_js_move("이미 로그인되어 있습니다", "self", "href", "/");
			exit;
		}

		$_def['skin'] = $skin_arr['skin_find'];
	break;

	case "withdraw"	:

		$r = $this->rtm->get_member_info();
		if (empty($r['user_id'])) {
			rt_js_move("", "self", "href", $this->_rtm_conf['login_set_page']."?prepage=".urlencode($this->env->_server['REQUEST_URI']));
			exit;
		}

		$_def['skin'] = $skin_arr['skin_withdraw'];
	break;
}

// 네이버 로그인 API KEY SET start
define('NAVER_CLIENT_ID', $_rtm_cfg['naver_client_id']);
define('NAVER_CLIENT_SECRET', $_rtm_cfg['naver_secret_key']);
define('NAVER_CALLBACK_URL', $_rtm_cfg['naver_callback_url']);
$naverUrl = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".NAVER_CLIENT_ID."&redirect_uri=".urlencode(NAVER_CALLBACK_URL);

$tpl->assign('naverUrl', $naverUrl);
// 네이버 로그인 API KEY SET end

// 카카오 로그인 API KEY SET start
define('KAKAO_CLIENT_ID', $_rtm_cfg['kakao_client_id']);
define('KAKAO_CALLBACK_URL', $_rtm_cfg['kakao_callback_url']);
$kakaoUrl = "https://kauth.kakao.com/oauth/authorize?client_id=".KAKAO_CLIENT_ID."&redirect_uri=".KAKAO_CALLBACK_URL."&response_type=code";

$tpl->assign('kakaoUrl', $kakaoUrl);
// 카카오 로그인 API KEY SET end
?>