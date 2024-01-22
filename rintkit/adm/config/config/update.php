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
	$data['adm_title'		] = $env->_post['adm_title'];
	$data['domain'			] = $env->_post['domain'];
	$data['ssl_is'			] = $env->_post['ssl_is'];
	$data['ssl_port'		] = $env->_post['ssl_port'];
	$data['sender_name'		] = $env->_post['sender_name'];
	$data['sender_email'	] = $env->_post['sender_email'];
	$data['sender_phone'	] = $env->_post['sender_phone'];
	$data['receive_name'	] = $env->_post['receive_name'];
	$data['receive_email'	] = $env->_post['receive_email'];
	$data['receive_phone'	] = $env->_post['receive_phone'];
	$data['smtp_id'			] = $env->_post['smtp_id'];
	$data['smtp_pw'			] = $env->_post['smtp_pw'];
	$data['smtp_host'		] = $env->_post['smtp_host'];
	$data['smtp_port'		] = $env->_post['smtp_port'];
	$data['sms_id'			] = $env->_post['sms_id'];
	$data['sms_pw'			] = $env->_post['sms_pw'];
	$data['ip_set_type'		] = $env->_post['ip_set_type'];

	if ($dbo->update("RT_CONFIG", $data)) {

		//IP허용 설정 시 현재 아이피 등록
		if ($env->_post['ip_set_type'] == "P") {
			$arr_ip = explode(".", $env->_server['REMOTE_ADDR']);
			$udata['part'] = "permit";
			$udata['type'] = "O";
			$udata['ip1'] = $arr_ip[0];
			$udata['ip2'] = $arr_ip[1];
			$udata['ip3'] = $arr_ip[2];
			$udata['ip4'] = $arr_ip[3];
			$udata['rdate'] = date("Y-m-d");
			$dbo->insert("RT_IP_SET", $udata);
		}
		rt_js_msg("정보가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

}
exit;
?>