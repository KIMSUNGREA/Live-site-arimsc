<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 로그아웃 처리
//-----------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

//-----------------------------------------------------------------------------------------

//실 세션 삭제
$cls_rtm->logout();

if (empty($_SESSION['RT_USER_ID'])) {
	if (empty($env->_get['prepage'])) {
		if ($cls_pg->conn_screen == "mobile") {
			$movepage = $cls_rtm->_rtm_conf['logout_after_url_mobile'];
		} else {
			$movepage = $cls_rtm->_rtm_conf['logout_after_url'];
		}
	} else {
		$movepage = urldecode($env->_get['prepage']);
	}

	$target = ($env->_get['target']) ? $env->_get['target'] : "self";

	rt_js_move("안전하게 로그아웃되었습니다. 감사합니다.", $target, "href", $movepage);
} else {
	rt_js_move("시스템문제로 로그아웃되지 않았습니다.", "self", "href", $rt_conf_db['ssl_url_n']);
}
exit;
?>