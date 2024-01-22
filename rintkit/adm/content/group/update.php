<?php
//-------------------------------------------------------------------------------------------------
/*
 * 콘텐츠 그룹 정보 업데이트
 * 
 * mode			: 데이터 처리 구분
 * 
 * insert		: 신규 그룹 등록
 * modify		: 그룹 정보 수정
 * delete		: 그룹 삭제
 * chgord		: 그룹 출력 순서 변경
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ADM."/engine.php";

//-------------------------------------------------------------------------------------------------

$data = array();//DB 필드데이터

if ($env->_post['mode'] == "insert")
{
	//변수 유효성 체크
	if (empty($env->_post['grp_name'])) {
		rt_js_msg("추가할 그룹명을 정확히 입력해 주세요", "parent", "error", "업데이트 실패");
		exit;
	}

	//출력 순서 초기설정
	$_r = $dbo->fetch("SELECT COUNT(grp_seq) AS reccnt, MAX(grp_ord) AS maxord FROM RT_CONTENT_GROUP");

	$data['grp_name'] = $env->_post['grp_name'];
	$data['grp_ord'] = ($_r['reccnt'] < 1) ? 0 : $_r['maxord'] + 1;

	if ($dbo->insert("RT_CONTENT_GROUP", $data)) {
		rt_js_move("", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "modify" && is_numeric($env->_post['grp_seq']))
{
	$data['grp_name'] = $env->_post['grp_name'];

	if ($dbo->update("RT_CONTENT_GROUP", $data, "grp_seq=".$env->_post['grp_seq'])) {
		rt_js_msg("데이터가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

}
else if ($env->_get['mode'] == "delete" && is_numeric($env->_get['grp_seq']))
{
	$result = $dbo->query("DELETE FROM RT_CONTENT_GROUP WHERE grp_seq='".$env->_get['grp_seq']."'");

	if ($result) {
		rt_js_move("", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

}
else if ($env->_get['mode'] == "chgord" && $env->_get['part'] && is_numeric($env->_get['grp_seq']))
{
	$r = $dbo->fetch("SELECT * FROM RT_CONTENT_GROUP WHERE grp_seq='".$env->_get['grp_seq']."'");

	if ($env->_get['part'] == "up") {
		$t = $dbo->fetch("SELECT * FROM RT_CONTENT_GROUP WHERE grp_ord < ".$r['grp_ord']." ORDER BY grp_ord DESC LIMIT 1");
	} else if ($env->_get['part'] == "down") {
		$t = $dbo->fetch("SELECT * FROM RT_CONTENT_GROUP WHERE grp_ord > ".$r['grp_ord']." ORDER BY grp_ord ASC LIMIT 1");
		
	}

	if (is_numeric($t['grp_seq'])) {

		$data['grp_ord'] = $r['grp_ord'];
		$dbo->update("RT_CONTENT_GROUP", $data, "grp_seq='".$t['grp_seq']."'");

		$data['grp_ord'] = $t['grp_ord'];
		$dbo->update("RT_CONTENT_GROUP", $data, "grp_seq='".$r['grp_seq']."'");
	}

	rt_js_move("", "parent", "reload");
}
exit;
?>