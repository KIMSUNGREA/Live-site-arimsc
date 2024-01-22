<?php
/**
 * vi:set ts=4 sw=4 expandtab enc=utf8:
 * Copyright(C) 2008-2010 D&SOFT
 * http://open.coolsms.co.kr
 */
header("Cache-Control: no-cache");
?>
<html lang="ko" xml:lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
require_once("coolsms.php");

function GetStatusStr($status)
{
    switch($status)
    {
        case "0":
            return "전송대기";
        case "1":
            return "전송 후 기지국";
        case "2":
            return "전송완료";
        case "9":
            return "없는 메시지ID";

    }
}

// 객체를 생성합니다.
$sms = new coolsms();

/**
 * 테스트 / 실전송 모드 선택
 * 테스트 문자 확인 : http://open.coolsms.co.kr/?mid=test_report
 * 실전송 문자 확인 : http://www.coolsms.co.kr/?mid=report
 **/
$sms->setRealMode();
//$sms->setTestMode();

// 아이디, 비밀번호를 입력합니다.
// 테스트 모드일 경우 아이디 앞에 XX를 붙여줍니다. 아이디가 test라면 XXtest
$sms->setuser("coolsms-user-id", "coolsms-user-password");

// 서버에 연결합니다.
if (!$sms->connect()) {
    echo "서버에 연결할 수 없습니다.";
    exit(1);
}

// 발송된 문자메시지의 상태 및 핸드폰에 전송된 결과를 얻어옵니다.
$result = $sms->rcheck("메세지ID");	// 서버로부터 리턴 받은 값 혹은 LocalKey

// 연결을 끊습니다.
$sms->disconnect();

// 결과를 출력합니다.
echo "Status:" . GetStatusStr($result["STATUS"]) . "<br />";
echo "Result-Code:" . $result["RESULT-CODE"] . "<br />";
echo "Result-Message:" . $result["RESULT-MESSAGE"] . "<br />";
?>
</body></html>
