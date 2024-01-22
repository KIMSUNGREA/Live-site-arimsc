<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 이메일 휴면상태 해지
//-----------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

//-------------------------------------------------------------------------------------------------
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $rt_conf_db['website'];?> | 휴면 상태 해지</title>
</head>
<style>
@charset "utf-8";
@import url(http://fonts.googleapis.com/earlyaccess/notosanskr.css);

.emailBox{position:relative;width:740px; margin:0 auto; margin-top:20px; padding:65px 0; border-top:solid 2px #b0b0b0; border-bottom:solid 1px #b0b0b0; text-align:center; font-family:'Noto Sans KR', sans-serif;}
.emailBox .title{ font-size:40px; letter-spacing:-3px;}
.emailBox p{padding:10px 0; }
.emailBox p span{color:#34b2be;}
.emailBox p a{margin:0 auto; text-decoration:none;}
.emailBox p .more{top:68px;background-color:#444545;color:#fff; padding:10px 50px;font-size:16px;text-align:center; letter-spacing:-1px; }
.emailBox p .more:hover{background-color:#34b2be;color:#fff;}
</style>

<body>
<div style="margin:0 auto; text-align:center; margin-top:150px;"><a href="http://<?php echo $rt_conf_db['domain'];?>" target="_blank" style="font-size:60px; font-family:'Noto Sans KR', sans-serif;  text-decoration:none; font-weight:600; color:#333;"><?php echo $rt_conf_db['website'];?></a></div>
<div class="emailBox">
	<form action="#" method="post" target="_blank" onSubmit="#">
	<input type="hidden" name="gEmail" value="#">
	<input type="hidden" name="mode" value="#">
	
	<div class="title">휴면 상태를 해지 하시겠습니까?</div>
	<p><a href="<?php echo "http://".$rt_conf_db['domain'].$_rt_rtmember['app_path']?>/user/mail_rest_update.php?mode=maildeny&email=<?php echo $env->_get['email']?>" target="rt_ifrm" class="more">예</a>&nbsp;<a href="javascript:self.close();" class="more">창닫기</a></p>
	</form>
</div>
<iframe name="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>
</body>
</html>
