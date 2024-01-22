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
	$data['company'			] = $env->_post['company'];
	$data['website'			] = $env->_post['website'];
	$data['ceo_nm'			] = $env->_post['ceo_nm'];
	$data['comp_tel'		] = $env->_post['comp_tel'];
	$data['comp_fax'		] = $env->_post['comp_fax'];
	$data['comp_email'		] = $env->_post['comp_email'];
	$data['comp_number1'	] = $env->_post['comp_number1'];
	$data['comp_number2'	] = $env->_post['comp_number2'];
	$data['comp_number3'	] = $env->_post['comp_number3'];
	$data['comp_type1'		] = $env->_post['comp_type1'];
	$data['comp_type2'		] = $env->_post['comp_type2'];
	$data['comp_addr'		] = $env->_post['comp_addr'];

	if ($dbo->update("RT_CONFIG", $data)) {
		rt_js_msg("정보가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

}
exit;
?>