<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP 정보 업데이트
 * 
 * $env->_post['mode'] 데이터 처리 구분
 * 
 * insert : APP 신규 등록
 * modify : APP 등록 정보 수정
 * delete : APP 해지
 */
//-------------------------------------------------------------------------------------------------

require_once "../../engine.php";

//-------------------------------------------------------------------------------------------------

$udata = array();//업데이트 데이터

if ($env->_post['mode'] == "insert")
{
	/** 필수 입력 필드 검수 패턴부 필요 */
	//ex)check_compulsory_field();

	$udata['app_name'		] = $env->_post['app_name'];
	$udata['app_code'		] = $env->_post['app_code'];
	$udata['app_path'		] = $env->_post['app_path'];
	$udata['app_version'	] = $env->_post['app_version'];
	$udata['app_dever'		] = $env->_post['app_dever'];
	$udata['app_plug_en'	] = $env->_post['app_plug_en'];

	if ($dbo->insert("RT_APP", $udata)) {
		rt_js_move("", "parent", "href", "../?sd=applist&cf=list");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "modify" && is_numeric($env->_post['app_seq']))
{
	$_r = $dbo->fetch("SELECT * FROM RT_APP WHERE app_seq='".$env->_post['app_seq']."'");

	if (is_numeric($_r['app_seq'])) {

		$udata['app_name'		] = $env->_post['app_name'];
		$udata['app_code'		] = $env->_post['app_code'];
		$udata['app_path'		] = $env->_post['app_path'];
		$udata['app_version'	] = $env->_post['app_version'];
		$udata['app_dever'		] = $env->_post['app_dever'];
		$udata['app_plug_en'	] = $env->_post['app_plug_en'];

		if ($dbo->update("RT_APP", $udata, "app_seq='".$env->_post['app_seq']."'")) {
			rt_js_msg("정보가 변경되었습니다.");
		} else {
			rt_js_msg("시스템문제로 등록되지 않았습니다.");
		}

	} else {
		rt_js_move("접속경로가 올바르지 않습니다.", "parent", "href", "../?sd=applist&cf=list");
	}

}
else if ($env->_post['mode'] == "delete" && is_numeric($env->_post['app_seq']))
{
	if ($dbo->query("DELETE FROM RT_APP WHERE app_seq='".$env->_post['app_seq']."' LIMIT 1")) {
		rt_js_move("APP 등록 정보가 삭제되었습니다.", "parent", "href", "../?sd=applist&cf=list");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

}
else if ($env->_get['mode'] == "delete_data")
{
	if ($env->_get['code'] && $env->_get['path']) {

		require_once RT_DOC_ROOT.$env->_get['path']."/controller/".$env->_get['code'].".controller.php";

		$cls_del = new $env->_get['code']();

		if ($cls_del->reset_app()) {
			rt_js_move("초기화가 완료 되었습니다.", "parent", "reload", "");
		} else {
			rt_js_msg("시스템문제로 삭제되지 않았습니다.");
		}
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
exit;
?>