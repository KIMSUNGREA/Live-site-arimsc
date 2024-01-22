<?php
//-------------------------------------------------------------------------------------------------
/*
 * 데이터 처리
 * 
 * mode 별 데이터 처리 구분
 * 
 * modify : 회원 가입 관련 환경설정
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ADM."/engine.php";

//-------------------------------------------------------------------------------------------------

$udata = array();//업데이트 데이터

if($env->_post['mode'] == "modify")
{
	//회원가입
	$udata['mb_approval_en'			] = ($env->_post['mb_approval_en']=="y")?"y":"n";
	$udata['join_permission_en'		] = ($env->_post['join_permission_en']=="y")?"y":"n";
	$udata['join_after_url'					] = $env->_post['join_after_url'];
	$udata['join_after_url_mobile'		] = $env->_post['join_after_url_mobile'];
	$udata['join_group'					] = $env->_post['join_group'];
	$udata['auth_sms_en'				] = ($env->_post['auth_sms_en']=="y")?"y":"n";
	$udata['agreement1_title'			] = $env->_post['agreement1_title'];
	$udata['agreement1_txt'				] = $env->_post['agreement1_txt'];
	$udata['agreement2_title'			] = $env->_post['agreement2_title'];
	$udata['agreement2_txt'				] = $env->_post['agreement2_txt'];
	$udata['refusal_id'						] = $env->_post['refusal_id'];

	//로그인/계정찾기
	$udata['login_try_cnt'					] = $env->_post['login_try_cnt'];
	$udata['login_after_url'				] = $env->_post['login_after_url'];
	$udata['login_after_url_mobile'	] = $env->_post['login_after_url_mobile'];
	$udata['logout_after_url'				] = $env->_post['logout_after_url'];
	$udata['logout_after_url_mobile'	] = $env->_post['logout_after_url_mobile'];

	if ($dbo->update("RT_RTMEMBER_CONFIG", $udata)) {
		rt_js_msg("정보가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
exit;
?>