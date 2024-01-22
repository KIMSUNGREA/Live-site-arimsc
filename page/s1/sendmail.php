<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

// 메일발송
if ($env->_post['mode'] == "inquiry") {

	$fromMail = "arimsc@arimsc.com";
	$toMail = "arimsc@arimsc.com";
	$subject = "[ARIM] ".$env->_post['name']."님 제품구매상담이 접수되었습니다.";

	$header = "Return-Path: <".$fromMail.">\r\n";
	$header .= "From: <".$fromMail.">\r\n";
	$header .= "X-Sender: <".$fromMail.">\r\n";
	$header .= "X-Mailer: PHP\r\n";
	$header .= "Reply-To:<".$fromMail.">\r\n";
	$header .= "MIME-Version: 1.0\r\n";                                  // MIME 버전 표시
	$header .= "Content-Type: text/html; charset=utf-8\r\n";
	$header .= "Content-Transfer-Encoding: base64 \r\n\r\n";

	// --- 이메일 본문 생성 --- //  
	$mail_content.= "<br>모델 : ".$env->_post['model']."\r\n";
	$mail_content.= "<br>성함 : ".$env->_post['name']."\r\n";
	$mail_content.= "<br>회사명 : ".$env->_post['company']."\r\n";
	$mail_content.= "<br>연락처 : ".$env->_post['phone']."\r\n";
	$mail_content.= "<br>이메일 : ".$env->_post['email']."\r\n";
	$mail_content.= "<br><br>[문의내용] <br> ".nl2br($env->_post['contents'])."\r\n";

	$mail_content = chunk_split(base64_encode($mail_content));
	$mailbody = stripslashes($mail_content)."\r\n";

	$rs = mail($toMail,$subject,$mailbody,$header);

	rt_js_move("상담신청이 접수되었습니다. 감사합니다.", "parent", "reload");
}
?>