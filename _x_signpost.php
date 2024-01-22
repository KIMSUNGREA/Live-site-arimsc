<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 린트킷 경로 설정
//
// 주의사항		: 이 파일은 반드시 웹 경로 최상위 디렉토리에 생성해 주세요.
// 웹 경로		: http://domain.com/_x_signpost.php
// 시스템 경로	: $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php"
//-----------------------------------------------------------------------------------------

define('RINTKIT'		, true);
define('RT_DOC_ROOT'	, $_SERVER['DOCUMENT_ROOT']);
define('RT_SET_DIR'		, 'rintkit');
define('RT_ROOT'		, str_replace("//", "/", RT_DOC_ROOT."/".RT_SET_DIR));

require_once RT_ROOT."/core/engine.php";
/*
if($_SERVER['HTTP_X_FORWARDED_SCHEME'] == "https"){
	$redirect = 'http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: ' . $redirect);
	exit();
}
*/
//----------------------------------------------------------------------------------------------
?>