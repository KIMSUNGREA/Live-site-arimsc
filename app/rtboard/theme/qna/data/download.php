<?php
//-------------------------------------------------------------------------------------------------
/*
 * 파일 다운로드
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";

//-------------------------------------------------------------------------------------------------

if($env->_get['bcode'] && is_numeric($env->_get['seq']) && is_numeric($env->_get['file_num'])) {
	$f = $dbo->fetch("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$env->_get['bcode']."' AND post_seq=".$env->_get['seq']." AND file_num=".$env->_get['file_num']);
	rt_download($f['file_new'], $f['file_ori'], $f['path_base'].$f['path_sub']);
} else {
	rt_js_move("접속오류입니다. 다시 접속해 주세요", "parent", "href", RTW_ADM);
}
exit;
?>