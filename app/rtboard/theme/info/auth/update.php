<?php
//-------------------------------------------------------------------------------------------------
/*
 * 데이터 처리
 * 
 * mode 별 데이터 처리 구분
 * 
 * modify : 이용권한 설정 수정
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";

//-------------------------------------------------------------------------------------------------

$udata = array();//업데이트 데이터

if($env->_post['mode'] == "modify")
{
	$udata['auth_list'		] = serialize($env->_post['auth_list']);
	$udata['auth_read'		] = serialize($env->_post['auth_read']);
	$udata['auth_comment'	] = serialize($env->_post['auth_comment']);

	if ($dbo->update("RT_RTBOARD_INFO_CONF", $udata, "bcode='".$env->_post['bcode']."'")) {
		rt_js_msg("정보가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
exit;
?>