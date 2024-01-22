<?php
//-------------------------------------------------------------------------------------------------
/*
 * 데이터 처리
 * 
 * mode 별 데이터 처리 구분
 * 
 * modify : 게시판 스킨 설정
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";

//-------------------------------------------------------------------------------------------------

$udata = array();
$szdata = array();

if($env->_post['mode'] == "modify")
{
	//기능 페이지 설정 목록
	$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='rtboard'");
	require_once RT_DOC_ROOT.$_app['app_path']."/theme/".$env->_post['theme']."/lib/config.php";

	foreach ($_cfg_use_func as $k => $v) {
		$szdata['skin_pc_'.$v] = $env->_post['skin_pc_'.$v];
		$szdata['skin_mobile_'.$v] = $env->_post['skin_mobile_'.$v];
	}

	$udata['skin_txt'] = serialize($szdata);
	$udata['mobile_skin_is'] = $env->_post['mobile_skin_is'];

	if ($dbo->update("RT_RTBOARD_INFO_CONF", $udata, "bcode='".$env->_post['bcode']."'")) {
		rt_js_msg("정보가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
exit;
?>