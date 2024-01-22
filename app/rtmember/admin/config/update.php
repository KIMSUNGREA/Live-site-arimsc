<?php
//-------------------------------------------------------------------------------------------------
/*
 * 데이터 처리
 * 
 * mode 별 데이터 처리 구분
 * 
 * modify : 회원모듈 설정
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ADM."/engine.php";

//-------------------------------------------------------------------------------------------------

$udata = array();//업데이트 데이터

if($env->_post['mode'] == "modify")
{
	$udata['join_set_page'		] = $env->_post['join_set_page'];
	$udata['login_set_page'		] = $env->_post['login_set_page'];
	$udata['mypage_set_page'	] = $env->_post['mypage_set_page'];
	$udata['find_set_page'		] = $env->_post['find_set_page'];

	$udata['join_set_mobile_page'		] = $env->_post['join_set_mobile_page'];
	$udata['login_set_mobile_page'		] = $env->_post['login_set_mobile_page'];
	$udata['mypage_set_mobile_page'		] = $env->_post['mypage_set_mobile_page'];
	$udata['find_set_mobile_page'		] = $env->_post['find_set_mobile_page'];


	if ($dbo->update("RT_RTMEMBER_CONFIG", $udata)) {
		rt_js_msg("데이터가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
exit;
?>