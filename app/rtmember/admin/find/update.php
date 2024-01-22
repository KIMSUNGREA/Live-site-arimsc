<?php
//-------------------------------------------------------------------------------------------------
/*
 * 데이터 처리
 * 
 * mode 별 데이터 처리 구분
 * 
 * modify : 계정찾기 관련 환경설정
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ADM."/engine.php";

//-------------------------------------------------------------------------------------------------

$udata = array();//업데이트 데이터

if($env->_post['mode'] == "modify")
{
	$udata['find_type_en'		] = ($env->_post['find_type_en']=="email")?"email":"sms";

	if ($dbo->update("RT_RTMEMBER_CONFIG", $udata)) {
		rt_js_msg("데이터가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
exit;
?>