<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 유저 페이지 기본 포함 파일
//-----------------------------------------------------------------------------------------

/**
 * APP 환경 정보
 */

$_load_app = $dbo->fetch_list("SELECT * FROM RT_APP WHERE app_plug_en='on'");

for ($m = 0; $m < count($_load_app); $m++) {
	${'_rt_'.$_load_app[$m]['app_code']} = rt_app_info($_load_app[$m]['app_code']);
}

//----------------------------------------------------------------------------------------------

/**
 * 회원 환경 설정 정보
 */

$_rtm_conf = $dbo->fetch("SELECT * FROM RT_RTMEMBER_CONFIG");

//----------------------------------------------------------------------------------------------

/**
 * 페이지 공통 설정 데이터
 */

$_rt_page_conf = $dbo->fetch("SELECT * FROM RT_PAGE_CONF");

//----------------------------------------------------------------------------------------------

/**
 * 페이지 분류 컴포넌트 로드
 */

rt_load_component("category");
$cls_ct = new category("PAGE");

//----------------------------------------------------------------------------------------------

/**
 * 페이지 관리 컨트롤러 로드
 */

rt_load_app_controller("page","user");
$cls_pg = new page_user();

//----------------------------------------------------------------------------------------------

/**
 * 페이지 및 분류 정보 설정
 */

if (empty($env->_get['fwd'])) {
	$pcd = (empty($env->_get['pcd'])) ? "" : $env->_get['pcd'];

	if (!empty($env->_session['RT_SCREEN_VIEW'])) {
		$reg_screen = $env->_session['RT_SCREEN_VIEW'];
	} else if (empty($env->_session['RT_SCREEN_VIEW']) && !empty($env->_get['screen'])) {
		$reg_screen = $env->_get['screen'];
	} else {
		$reg_screen = "pc";
	}

	$cls_pg->init($pcd, $reg_screen);

	$__pg = $cls_pg->data;
	$__ct = $cls_pg->ct;
}

//----------------------------------------------------------------------------------------------

/**
 * 회원 컨트롤러 로드
 */

rt_load_app_controller("rtmember","user");
$cls_rtm = new rtmember_user();

//----------------------------------------------------------------------------------------------

/**
 * 보안 SSL 사용 시
 */

if ($rt_conf_db['ssl_is'] == 'y') {
	$ssl_port_str = ($rt_conf_db['ssl_port']) ? ":".$rt_conf_db['ssl_port']:"";
	$rt_conf_db['ssl_url'] = "//".$env->_server['HTTP_HOST'].":".$ssl_port_str;
	$rt_conf_db['ssl_url_n'] = "//".$env->_server['HTTP_HOST'];
} else {
	$rt_conf_db['ssl_url_n'] = "//".$env->_server['HTTP_HOST'];
}

//----------------------------------------------------------------------------------------------
?>