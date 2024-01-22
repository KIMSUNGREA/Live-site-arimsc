<?php
//-------------------------------------------------------------------------------------------------
/*
 * 데이터 처리
 * 
 * mode 별 데이터 처리 구분
 * 
 * modify : 로그인 관련 환경설정
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ADM."/engine.php";

//-------------------------------------------------------------------------------------------------

$udata = array();//업데이트 데이터

if($env->_post['mode'] == "modify")
{
	$udata['mobile_skin_is'			] = $env->_post['mobile_skin_is'];

	$udata['mb_skin_login'			] = $env->_post['mb_skin_login'];
	$udata['mb_skin_mypage'			] = $env->_post['mb_skin_mypage'];
	$udata['mb_skin_modify'			] = $env->_post['mb_skin_modify'];
	$udata['mb_skin_withdraw'		] = $env->_post['mb_skin_withdraw'];
	$udata['mb_skin_find'			] = $env->_post['mb_skin_find'];
	$udata['mb_skin_join_step1'		] = $env->_post['mb_skin_join_step1'];
	$udata['mb_skin_join_step2'		] = $env->_post['mb_skin_join_step2'];
	$udata['mb_skin_join_step3'		] = $env->_post['mb_skin_join_step3'];

	$udata['mb_skin_mobile_login'			] = $env->_post['mb_skin_mobile_login'];
	$udata['mb_skin_mobile_mypage'			] = $env->_post['mb_skin_mobile_mypage'];
	$udata['mb_skin_mobile_modify'			] = $env->_post['mb_skin_mobile_modify'];
	$udata['mb_skin_mobile_withdraw'		] = $env->_post['mb_skin_mobile_withdraw'];
	$udata['mb_skin_mobile_find'			] = $env->_post['mb_skin_mobile_find'];
	$udata['mb_skin_mobile_join_step1'		] = $env->_post['mb_skin_mobile_join_step1'];
	$udata['mb_skin_mobile_join_step2'		] = $env->_post['mb_skin_mobile_join_step2'];
	$udata['mb_skin_mobile_join_step3'		] = $env->_post['mb_skin_mobile_join_step3'];

	if ($dbo->update("RT_RTMEMBER_CONFIG", $udata)) {
		rt_js_msg("데이터가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
exit;
?>