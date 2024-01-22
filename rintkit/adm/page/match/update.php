<?php
//-------------------------------------------------------------------------------------------------
/*
 * 페이지 관리 - 404페이지매칭 - 업데이트
 * 
 * $env->_post['mode'] 데이터 처리 구분
 */
//-------------------------------------------------------------------------------------------------

require_once "../../engine.php";

//-------------------------------------------------------------------------------------------------

$data = array();//DB 필드데이터

if ($env->_post['mode'] == "insert")
{

	$data['rule_en'			] = $env->_post['rule_en'];
	$data['pg_target'		] = trim($env->_post['pg_target']);
	$data['pg_forward'		] = trim($env->_post['pg_forward']);
	$data['pg_title'		] = $env->_post['pg_title'];

	if ($dbo->insert("RT_PAGE_MATCH", $data)) {
		rt_js_move("", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "modify")
{
	$data['rule_en'			] = $env->_post['rule_en'];
	$data['pg_target'		] = trim($env->_post['pg_target']);
	$data['pg_forward'		] = trim($env->_post['pg_forward']);
	$data['pg_title'		] = $env->_post['pg_title'];

	if ($dbo->update("RT_PAGE_MATCH", $data, "seq=".$env->_post['seq'])) {
		rt_js_msg("정보가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

}
else if ($env->_get['mode'] == "delete" && is_numeric($env->_get['seq']))
{
	$result = $dbo->query("DELETE FROM RT_PAGE_MATCH WHERE seq='".$env->_get['seq']."'");

	if ($result) {
		rt_js_move("", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
exit;
?>