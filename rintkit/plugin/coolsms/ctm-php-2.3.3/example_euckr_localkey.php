<?php
/**
 * vi:set ts=4 sw=4 expandtab fileencoding=cp949:
 * Copyright(C) 2008-2010 D&SOFT
 * http://open.coolsms.co.kr
 */
header("Cache-Control: no-cache");
?>
<html lang="ko" xml:lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=EUC-KR" />
</head>
<body>
<?php
require_once("coolsms.php");

/**
 * 메시지ID를 클라이언트에서 생성하여 보낼 수 있습니다. 
 * ($localkey 값을 입력하지 않으면 서버에서 메시지ID를 생성하여 리턴합니다.)
 * 최종 전송결과를 이 메시지ID로 확인가능하게 됩니다.
 * 메시지ID는 한 계정에 대하여 반드시 유일한 값이어야 하므로 coolsms::keygen() 을 사용하실 것을 권장합니다.
 */

// 객체를 생성합니다.
$sms = new coolsms();

/**
 * 테스트 / 실전송 모드 선택
 * 테스트 문자 확인 : http://open.coolsms.co.kr/?mid=test_report
 * 실전송 문자 확인 : http://www.coolsms.co.kr/?mid=report
 **/
$sms->setRealMode();
//$sms->setTestMode();


// 프로그램명/버젼을 설정합니다.
$sms->appversion("TEST/1.0");

// 한글인코딩 설정
$sms->charset("euckr");

// 아이디, 비밀번호를 입력합니다.
// 테스트 모드일 경우 아이디 앞에 XX를 붙여줍니다. 아이디가 test라면 XXtest
$sms->setuser("coolsms_user_id", "coolsms_user_password");

// 메시지ID를 생성합니다.
$localkey = coolsms::keygen();
echo "생성된 로컬키 : {$localkey}<br />";

// 전송할 메시지를 추가합니다. $sms->add(받는번호, 회신번호, 문자내용, 참조용이름, 예약일시(YYYYMMDDHHMISS), 로컬키);
$sms->add("0111234567", "0212341234", "Localkey 테스트 입니다.", "홍길동", "", $localkey);

// 서버에 연결합니다.
if (!$sms->connect()) {
	// 오류처리
	echo "서버에 접속할 수 없습니다.";
	exit(1);
}

// 추가된 문자메시지를 발송합니다.
$sms->send();

// 오류검사
if ($sms->errordetected()) {
    echo "오류가 발생했습니다 : " . $sms->lasterror();
}

// 연결을 끊습니다.
$sms->disconnect();

// 발송결과 출력 (Message ID 값에 $localkey 값이 그대로 리턴됩니다.)
echo "<p>서버로부터 리턴된 결과 출력<br />";
$sms->printr();

// 메시지목록 비우기
$sms->emptyall();
?>
</body>
</html>
