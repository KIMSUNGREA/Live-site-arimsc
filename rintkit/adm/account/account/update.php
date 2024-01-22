<?php
//-------------------------------------------------------------------------------------------------
/**
 * 계정 정보 업데이트
 * 
 * $_POST['mode'] 데이터 처리 구분
 * 
 * modify : 계정정보 업데이트
 */
//-------------------------------------------------------------------------------------------------

require_once "../../engine.php";

//-------------------------------------------------------------------------------------------------

$udata = array();//업데이트 데이터

if ($env->_post['mode'] == "modify")
{
	$now_pwd = rt_password($env->_post['adm_pwd_now']);
	$new_pwd = rt_password($env->_post['adm_pwd_new']);

	$_r = $dbo->fetch("SELECT * FROM ".$cls_adm->db_tbl." WHERE auth_code='normal' AND adm_pw='".$now_pwd."'");

	if ($cls_adm->auth_code == "normal") {
		if (empty($_r['adm_id'])) {
			rt_js_msg("현재 비밀번호가 맞지 않습니다.");exit;
		}
	}

	$udata['adm_pw'		] = $new_pwd;
	$udata['last_pw_dt'	] = date("Y-m-d H:i:s");

	if ($dbo->update($cls_adm->db_tbl, $udata, "auth_code='normal'")) {
		rt_js_move("비밀번호가 변경되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
exit;
?>