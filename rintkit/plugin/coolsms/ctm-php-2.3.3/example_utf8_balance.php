<?php
/**
 * vi:set ts=4 sw=4 expandtab enc=utf8:
 * Copyright(C) 2008-2010 D&SOFT
 * http://open.coolsms.co.kr
 **/
header("Cache-Control: no-cache");
?>
<html lang="ko" xml:lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
require_once("coolsms.php");

// 객체를 생성합니다.
$sms = new coolsms();

// 아이디, 비밀번호를 입력합니다.
$sms->setuser("coolsms-user-id", "coolsms-user-password");

// 서버에 연결합니다.
if (!$sms->connect()) {
	// 오류처리
	echo "서버에 연결할 수 없습니다.";
	exit(1);
}

// 잔액을 읽어옵니다.
$result = $sms->remain();

// 연결을 끊습니다.
$sms->disconnect();

// 결과를 출력합니다.
if ($result["RESULT-CODE"] == "00")	// RESULT-CODE 가 00이면 성공.
{
    echo "캐쉬: " . $result["CASH"];
    echo "포인트: " . $result["POINT"];
    echo "문자방울: " . $result["DROP"];
    echo "전체 SMS건수: " . $result["CREDITS"];
} else {
    echo "Result Code: " . $result["RESULT-CODE"] . "<br />";
    echo "Result Message: " . $result["RESULT-MESSAGE"] . "<br />";
}
?>
</body>
</html>
