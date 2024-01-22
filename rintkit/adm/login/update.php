<?php
//-----------------------------------------------------------------------------------------
/*
 * 관리자 로그인 / 로그아웃 처리
 */
//-----------------------------------------------------------------------------------------

require_once "../engine.php";

//-----------------------------------------------------------------------------------------

if ($env->_post['mode'] == "in")
{
	if ($env->_post['is_memory'] == "y") {
		rt_set_cookie("save_adm_id", $env->_post['adm_id'], 30);
	} else {
		rt_del_cookie("save_adm_id");
	}

	$data = array();
	$data['adm_id'	] = trim($env->_post['adm_id']);
	$data['adm_pw'	] = trim($env->_post['adm_pw']);

	//마스터계정 로그인 시도 시 비밀번호 강제설정이면 입력 패스워드로 강제 업데이트
	if (RT_CHANGE_ADMIN_PWD == "y" && $data['adm_id'] == "master") {

		$new_pwd = rt_password($data['adm_pw']);

		$udata['adm_pw'] = $new_pwd;
		$dbo->update($cls_adm->db_tbl, $udata, "auth_code='master'");
	}

	if ($cls_adm->login($data)) {
		rt_js_move("", "parent", "href", RTW_ADM."/");
	} else {
		rt_js_msg("로그인 정보가 맞지 않습니다. 다시 입력해 주세요", "parent");
	}
}
else if ($_GET['mode'] == "out")
{
	$cls_adm->logout();
	rt_js_move("", "self", "href", RTW_ADM."/");
}
exit;
?>
