<?php
//-------------------------------------------------------------------------------------------------
/*
 * 데이터 처리
 * 
 * mode 데이터 처리 구분
 * 
 * insert		: 신규 입력
 * modify		: 정보 수정
 * delete		: 데이터 삭제
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ADM."/engine.php";

//-------------------------------------------------------------------------------------------------

$udata = array();//업데이트 데이터

if ($env->_post['mode'] == "insert")
{
	$udata['name'			] = $env->_post['name'];
	$udata['type'			] = $env->_post['type'];
	$udata['size_w'			] = $env->_post['size_w'];
	$udata['size_h'			] = $env->_post['size_h'];
	$udata['data'			] = $env->_post['data'];
	$udata['is_require'		] = $env->_post['is_require'];
	$udata['is_use'			] = $env->_post['is_use'];
	$udata['require_text'	] = $env->_post['require_text'];

	$_f = $dbo->fetch("SELECT MAX(formnum) AS formnum FROM RT_RTMEMBER_ADD_FIELD");
	$udata['formnum'] = $_f['formnum']+1;

	if($dbo->insert("RT_RTMEMBER_ADD_FIELD", $udata)) {
		rt_js_move("", "parent", "href", RTW_ADM."/app/?appcode=rtmember&sd=admin-field");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다." ,"parent", "error", "게시물 등록 실패");
	}
}
else if($env->_post['mode'] == "modify" && is_numeric($env->_post['seq']))
{
	$_f = $dbo->fetch("SELECT * FROM RT_RTMEMBER_ADD_FIELD WHERE seq='".$env->_post['seq']."'");

	if (!empty($env->_post['name'])) { $udata['name'] = $env->_post['name']; }
	if (!empty($env->_post['type'])) { $udata['type'] = $env->_post['type']; }

	$udata['size_w'			] = $env->_post['size_w'];
	$udata['size_h'			] = $env->_post['size_h'];
	$udata['data'			] = $env->_post['data'];
	$udata['is_require'		] = $env->_post['is_require'];
	$udata['is_use'			] = $env->_post['is_use'];
	$udata['require_text'	] = $env->_post['require_text'];

	if ($dbo->update("RT_RTMEMBER_ADD_FIELD", $udata, "seq='".$env->_post['seq']."'")) {
		rt_js_move("정보가 변경되었습니다.", "parent", "href", RTW_ADM."/app/?appcode=rtmember&sd=admin-field&seq=".$env->_post['seq']);
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다." ,"parent", "error", "게시물 수정 실패");
	}
}
else if($env->_get['mode'] == "delete" && is_numeric($env->_get['seq']))
{
	if ($dbo->query("DELETE FROM RT_RTMEMBER_ADD_FIELD WHERE seq='".$env->_get['seq']."'")) {
		rt_js_move("", "parent", "href", RTW_ADM."/app/?appcode=rtmember&sd=admin-field");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다." ,"parent", "error", "게시물 삭제 실패");
	}
}
else if ($env->_get['mode'] == "chgord" && is_numeric($env->_get['formnum']) && $env->_get['type'])
{
	$_r1 = $dbo->fetch("SELECT * FROM RT_RTMEMBER_ADD_FIELD WHERE formnum='".$env->_get['formnum']."'");

	if ($env->_get['type'] == "u") {

		$_fnum = $env->_get['formnum'] - 1;
		if ($_fnum > 0) {

			$_r2 = $dbo->fetch("SELECT * FROM RT_RTMEMBER_ADD_FIELD WHERE formnum='".$_fnum."'");

			$adata['formnum'] = $_r2['formnum'];
			$dbo->update("RT_RTMEMBER_ADD_FIELD", $adata, "seq='".$_r1['seq']."'");

			$bdata['formnum'] = $_r1['formnum'];
			$dbo->update("RT_RTMEMBER_ADD_FIELD", $bdata, "seq='".$_r2['seq']."'");
		}

	} else if ($env->_get['type'] == "d") {

		$_fnum = $env->_get['formnum'] + 1;
		$_r2 = $dbo->fetch("SELECT * FROM RT_RTMEMBER_ADD_FIELD WHERE formnum='".$_fnum."'");

		if (is_numeric($_r2['seq'])) {

			$adata['formnum'] = $_r2['formnum'];
			$dbo->update("RT_RTMEMBER_ADD_FIELD", $adata, "seq='".$_r1['seq']."'");

			$bdata['formnum'] = $_r1['formnum'];
			$dbo->update("RT_RTMEMBER_ADD_FIELD", $bdata, "seq='".$_r2['seq']."'");
		}
	}

	rt_js_move("", "parent", "reload");
}
else
{
	rt_js_move("접속오류입니다. 다시 접속해 주세요", "parent", "href", RTW_ADM);
}
exit;

?>
