<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 이메일 수신거부 처리
//-----------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

//-------------------------------------------------------------------------------------------------

if ($env->_get['mode'] == "maildeny" && $env->_get['email']) {

	$r = $dbo->fetch("SELECT * FROM RT_RTMEMBER WHERE email='".$env->_get['email']."'");

	if ($r['email']) {

		$udata['email_en'] = "n";

		if ($dbo->update("RT_RTMEMBER", $udata, "email='".$env->_get['email']."'")) {
			?><script>
				alert("수신거부처리가 되었습니다.");
				parent.self.close();
			</script><?
		} else {
			rt_js_msg("시스템문제로 등록되지 않았습니다.");
		}
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}

exit;
?>