<?php
//-------------------------------------------------------------------------------------------------
/*
 * 데이터 처리
 * 
 * mode 별 데이터 처리 구분
 * 
 * modify : 회원관련 알림 환경설정
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ADM."/engine.php";

//-------------------------------------------------------------------------------------------------

$udata = array();//업데이트 데이터

if($env->_post['mode'] == "modify")
{
	$udata['join_send_email_en'		] = ($env->_post['join_send_email_en']=="y")?"y":"n";
	$udata['mb_skin_join_mail'		] = $env->_post['mb_skin_join_mail'];
	$udata['join_send_sms_en'		] = ($env->_post['join_send_sms_en']=="y")?"y":"n";
	$udata['sms_content'			] = $env->_post['sms_content'];
	$udata['mb_skin_findid_mail'	] = $env->_post['mb_skin_findid_mail'];
	$udata['mb_skin_findpw_mail'	] = $env->_post['mb_skin_findpw_mail'];
	$udata['mb_skin_rest_mail'		] = $env->_post['mb_skin_rest_mail'];

	if ($dbo->update("RT_RTMEMBER_CONFIG", $udata)) {
		rt_js_msg("데이터가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
exit;
?>