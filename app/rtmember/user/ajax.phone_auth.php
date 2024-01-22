<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 회원 가입 SMS 인증
//-----------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

//-------------------------------------------------------------------------------------------------

rt_load_lib("sms");

//-------------------------------------------------------------------------------------------------

if (empty($env->_post['phone']) || empty($rt_conf_db['sender_phone'])) {exit;}

//인증코드
$aunthnum = rt_get_authcode();

//발송정보
$r_num = str_replace("-","",$env->_post['phone']);
$s_num = $rt_conf_db['sender_phone'];
$s_msg = "[".$rt_conf_db['sender_name']."][".$aunthnum."] 인증번호 4자리를 정확히 입력해 주세요";

//SMS 발송
rt_sms($r_num, $s_num, $s_msg);
?>
var setauthnum = "<?php echo $aunthnum;?>";