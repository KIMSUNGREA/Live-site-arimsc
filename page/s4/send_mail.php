<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

// 메일발송
if ($env->_post['mode'] == "inquiry") {

	$fromMail = "arimsc@arimsc.com";
	$toMail = "arimsc@arimsc.com";
	$subject = "[ARIM] ".$env->_post['name']."님 상담문의가 접수되었습니다.";

	$header = "Return-Path: <".$fromMail.">\r\n";
	$header .= "From: <".$fromMail.">\r\n";
	$header .= "X-Sender: <".$fromMail.">\r\n";
	$header .= "X-Mailer: PHP\r\n";
	$header .= "Reply-To:<".$fromMail.">\r\n";
	$header .= "MIME-Version: 1.0\r\n";                                  // MIME 버전 표시
	$header .= "Content-Type: text/html; charset=utf-8\r\n";
	$header .= "Content-Transfer-Encoding: base64 \r\n\r\n";

	// --- 이메일 본문 생성 --- //  
	$mail_content.= "<br>성함 : ".$env->_post['name']."\r\n";
	$mail_content.= "<br>이메일 : ".$env->_post['email']."\r\n";
	$mail_content.= "<br><br>제목 : ".$env->_post['subject']."\r\n";
	$mail_content.= "<br>문의내용 : ".$env->_post['contents']."\r\n";

	$mail_content = chunk_split(base64_encode($mail_content));
	$mailbody = stripslashes($mail_content)."\r\n";

	$rs = mail($toMail,$subject,$mailbody,$header);

	rt_js_move("메일이 접수되었습니다. 감사합니다.", "parent", "reload");
}
?>