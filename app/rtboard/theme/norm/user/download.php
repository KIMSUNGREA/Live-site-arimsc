<?php
//-----------------------------------------------------------------------------------------
// 프로그램			: RINT-KIT
// 제작				: 린트킷(rintkit.com)
// 버전				: 1.0
// 인코딩			: UTF-8
// 설명				: 첨부파일 다운로드
//-----------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";

//-----------------------------------------------------------------------------------------

if($env->_get['bcode'] && is_numeric($env->_get['seq']) && is_numeric($env->_get['file_num'])) {
	$f = $dbo->fetch("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$env->_get['bcode']."' AND post_seq=".$env->_get['seq']." AND file_num=".$env->_get['file_num']);
	rt_download($f['file_new'], $f['file_ori'], $f['path_base'].$f['path_sub']);

	//다운로드 횟수 업데이트
	$dbo->query("UPDATE RT_RTBOARD_FILES SET download_hits=download_hits+1 WHERE bcode='".$env->_get['bcode']."' AND post_seq=".$env->_get['seq']." AND file_num=".$env->_get['file_num']);
} else {
	rt_js_move("접속오류입니다. 다시 접속해 주세요", "parent", "href", "/");
}
exit;
?>