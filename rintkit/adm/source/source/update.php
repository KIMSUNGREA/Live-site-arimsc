<?php
//-------------------------------------------------------------------------------------------------

require_once "../../engine.php";

//-------------------------------------------------------------------------------------------------

$data = array();//DB 필드데이터

if ($env->_post['mode'] == "insert")
{
	//변수 유효성 체크
	if (empty($env->_post['s_name'])) {
		rt_js_msg("추가할 메뉴명을 정확히 입력해 주세요");
		exit;
	}

	$data['name'] = $env->_post['s_name'];

	if ($dbo->insert("RT_SOURCE", $data)) {
		rt_js_move("", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "modify")
{
	$data['name'	] = $env->_post['s_name'];
	$data['source'	] = $env->_post['source'];
	$data['use_en'	] = $env->_post['use_en'];

	if ($dbo->update("RT_SOURCE", $data, "seq=".$env->_post['seq'])) {
		rt_js_msg("정보가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

}
else if ($env->_get['mode'] == "delete" && is_numeric($env->_get['seq']))
{
	$result = $dbo->query("DELETE FROM RT_SOURCE WHERE seq='".$env->_get['seq']."'");

	if ($result) {
		rt_js_move("", "parent", "href", RTW_ADM."/source/?sd=source");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
exit;
?>