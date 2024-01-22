<?php
//-------------------------------------------------------------------------------------------------
/*
 * 환경 정보 업데이트
 * 
 * $env->_post['mode'] 데이터 처리 구분
 * 
 * modify : 환경 정보 수정
 */
//-------------------------------------------------------------------------------------------------

require_once "../../engine.php";

//-------------------------------------------------------------------------------------------------


$data = array();//DB 필드데이터

if ($env->_post['mode'] == "modify")
{
	$fw = array();
	$ld = array();
	for ($m = 1; $m <= 12; $m++) {
		$fw['fw'.$m] = $env->_post['fw'.$m];
		$ld['ld'.$m] = $env->_post['ld'.$m];
	}

	$data['screen_forward'			] = serialize($fw);
	$data['screen_forward_landing'	] = serialize($ld);

	if ($dbo->update("RT_PAGE_CONF", $data)) {
		rt_js_msg("정보가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

}
exit;
?>