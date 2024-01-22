<?php
//-------------------------------------------------------------------------------------------------
/*
 * 옵션 세트 정보 업데이트
 * 
 * mode			: 데이터 처리 구분
 * 
 * insert		: 신규 그룹 등록
 * modify		: 옵션 세트 정보 수정
 * delete		: 옵션 세트 삭제
 * chgord		: 옵션 세트 출력 순서 변경
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ADM."/engine.php";

//-------------------------------------------------------------------------------------------------

$data = array();//DB 필드데이터

if ($env->_post['mode'] == "insert")
{
	//변수 유효성 체크
	if (empty($env->_post['opt_name'])) {
		rt_js_msg("추가할 세트명을 정확히 입력해 주세요");
		exit;
	}

	$data['opt_name'] = $env->_post['opt_name'];
	$data['opt_field1'] = trim($env->_post['opt_field1']);
	$data['opt_field2'] = trim($env->_post['opt_field2']);
	$data['opt_field3'] = trim($env->_post['opt_field3']);
	$data['opt_field4'] = trim($env->_post['opt_field4']);
	$data['vopt'] = serialize($env->_post['vopt']);

	//출력 순서 초기설정
	$_r = $dbo->fetch("SELECT COUNT(opt_seq) AS reccnt, MAX(opt_ord) AS maxord FROM RT_PRODUCT_OPTION");
	$data['opt_ord'] = ($_r['reccnt'] < 1) ? 0 : $_r['maxord'] + 1;

	//기본 출력 옵션 설정
	$data['default_en'] = ($_r['reccnt'] < 1) ? "y" : "n";

	if ($dbo->insert("RT_PRODUCT_OPTION", $data)) {
		rt_js_move("", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "modify" && is_numeric($env->_post['opt_seq']))
{
	$data['opt_name'] = $env->_post['opt_name'];
	$data['opt_field1'] = trim($env->_post['opt_field1']);
	$data['opt_field2'] = trim($env->_post['opt_field2']);
	$data['opt_field3'] = trim($env->_post['opt_field3']);
	$data['opt_field4'] = trim($env->_post['opt_field4']);
	$data['vopt'] = serialize($env->_post['vopt']);

	if ($dbo->update("RT_PRODUCT_OPTION", $data, "opt_seq=".$env->_post['opt_seq'])) {
		rt_js_msg("정보가 수정되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

}
else if ($env->_get['mode'] == "delete" && is_numeric($env->_get['opt_seq']))
{
	$_r = $dbo->fetch("SELECT * FROM RT_PRODUCT_OPTION WHERE opt_seq='".$env->_get['opt_seq']."'");

	$result = $dbo->query("DELETE FROM RT_PRODUCT_OPTION WHERE opt_seq='".$env->_get['opt_seq']."'");
	if ($result) {

		//기본 출력 옵션 세트를 삭제 시 임의로 아무거나 하나를 기본으로 지정
		if ($_r['default_en'] == "y") {

			$_r2 = $dbo->fetch("SELECT * FROM RT_PRODUCT_OPTION LIMIT 1");

			$data['default_en'] = "y";
			$dbo->update("RT_PRODUCT_OPTION", $data, "opt_seq=".$_r2['opt_seq']);
		}

		rt_js_move("", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

}
else if ($env->_get['mode'] == "defaultset" && is_numeric($env->_get['opt_seq']))
{
	$dbo->query("UPDATE RT_PRODUCT_OPTION SET default_en='n'");
	$dbo->query("UPDATE RT_PRODUCT_OPTION SET default_en='y' WHERE opt_seq='".$env->_get['opt_seq']."'");

	rt_js_move("", "parent", "reload");
}
else if ($env->_get['mode'] == "chgord" && $env->_get['part'] && is_numeric($env->_get['opt_seq']))
{
	$r = $dbo->fetch("SELECT * FROM RT_PRODUCT_OPTION WHERE opt_seq='".$env->_get['opt_seq']."'");

	if ($env->_get['part'] == "up") {
		$t = $dbo->fetch("SELECT * FROM RT_PRODUCT_OPTION WHERE opt_ord < ".$r['opt_ord']." ORDER BY opt_ord DESC LIMIT 1");
	} else if ($env->_get['part'] == "down") {
		$t = $dbo->fetch("SELECT * FROM RT_PRODUCT_OPTION WHERE opt_ord > ".$r['opt_ord']." ORDER BY opt_ord ASC LIMIT 1");
		
	}

	if (is_numeric($t['opt_seq'])) {

		$data['opt_ord'] = $r['opt_ord'];
		$dbo->update("RT_PRODUCT_OPTION", $data, "opt_seq='".$t['opt_seq']."'");

		$data['opt_ord'] = $t['opt_ord'];
		$dbo->update("RT_PRODUCT_OPTION", $data, "opt_seq='".$r['opt_seq']."'");
	}

	rt_js_move("", "parent", "reload");
} 
exit;
?>