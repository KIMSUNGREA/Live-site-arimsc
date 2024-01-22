<?php
//-------------------------------------------------------------------------------------------------
/*
 * 게시판 템플릿 정보 업데이트
 * 
 * mode			: 데이터 처리 구분
 * 
 * insert		: 신규 등록
 * modify		: 정보 수정
 * delete		: 삭제
 * chgord		: 출력 순서 변경
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ADM."/engine.php";

//-------------------------------------------------------------------------------------------------

$data = array();//DB 필드데이터

if ($env->_post['mode'] == "insert")
{
	//변수 유효성 체크
	if (empty($env->_post['title'])) {
		rt_js_msg("추가할 템플릿 제목을 정확히 입력해 주세요");
		exit;
	}

	//출력 순서 초기설정
	$_r = $dbo->fetch("SELECT COUNT(seq) AS reccnt, MAX(ord) AS maxord FROM RT_POPUP_FORM_TPL");

	$data['title'] = $env->_post['title'];
	$data['ord'] = ($_r['reccnt'] < 1) ? 0 : $_r['maxord'] + 1;

	if ($dbo->insert("RT_POPUP_FORM_TPL", $data)) {
		rt_js_move("", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "modify" && is_numeric($env->_post['seq']))
{
	$data['title'] = $env->_post['title'];
	$data['content'] = $env->_post['content'];

	if ($dbo->update("RT_POPUP_FORM_TPL", $data, "seq=".$env->_post['seq'])) {
		rt_js_move("", "parent", "href", "../?sd=formtpl&cf=list");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_get['mode'] == "delete" && is_numeric($env->_get['seq']))
{
	$result = $dbo->query("DELETE FROM RT_POPUP_FORM_TPL WHERE seq='".$env->_get['seq']."'");

	if ($result) {
		rt_js_move("", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_get['mode'] == "chgord" && $env->_get['part'] && is_numeric($env->_get['seq']))
{
	$r = $dbo->fetch("SELECT * FROM RT_POPUP_FORM_TPL WHERE seq='".$env->_get['seq']."'");

	if ($env->_get['part'] == "up") {
		$t = $dbo->fetch("SELECT * FROM RT_POPUP_FORM_TPL WHERE ord < ".$r['ord']." ORDER BY ord DESC LIMIT 1");
	} else if ($env->_get['part'] == "down") {
		$t = $dbo->fetch("SELECT * FROM RT_POPUP_FORM_TPL WHERE ord > ".$r['ord']." ORDER BY ord ASC LIMIT 1");
		
	}

	if (is_numeric($t['seq'])) {

		$data['ord'] = $r['ord'];
		$dbo->update("RT_POPUP_FORM_TPL", $data, "seq='".$t['seq']."'");

		$data['ord'] = $t['ord'];
		$dbo->update("RT_POPUP_FORM_TPL", $data, "seq='".$r['seq']."'");
	}

	rt_js_move("", "parent", "reload");
}
else if ($env->_post['mode'] == "gettpl" && is_numeric($env->_post['seq']))
{
	$r = $dbo->fetch("SELECT * FROM RT_POPUP_FORM_TPL WHERE seq='".$env->_post['seq']."'");

	echo html_entity_decode(stripslashes($r['content']));
}
exit;
?>