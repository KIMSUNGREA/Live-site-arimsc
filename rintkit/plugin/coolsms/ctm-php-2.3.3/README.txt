
  개요

CTM은 별도의 서버없이 SKT, KT, LGT 3개 이동통신사의 가입자 핸드폰으로 문자메시지
(SMS, LMS)를 전송하는 기능을 포함하는 모듈입니다. GSLB 시스템을 기반으로 365일 
무정지(failover) 서비스를 구현하여 안정성을 보장합니다.


  소스코드 라이센스

기본적으로 BSD 라이센스에 따라 소스코드를 수정 및 배포가능하며 자세한 사항은 COP
YRIGHT.txt 파일을 참고바랍니다.


  계정만들기

문자전송을 위해 쿨에스엠에스(http://www.coolsms.co.kr/acct/signup.php)에서 회원
가입을 통하여 서비스 계정을 만듭니다.


  파일구성

사용하시는 한글인코딩에 따라 EUC-KR 혹은 UTF-8 으로 작성된 예제를 선택하세요.
--------------------------------------------------------------------------------
 파일명                       | 내용
------------------------------+-------------------------------------------------
 coolsms.php                  | (공통)문자메시지 전송 클래스
 example_euckr_sendsms.php    | (EUC-KR)문자메시지 전송 예제
 example_euckr_sendlms.php    | (EUC-KR)장문(2,000바이트) LMS 전송 예제
 example_euckr_sendmms.php    | (EUC-KR)장문(2,000바이트) MMS 이미지 전송 예제
 example_euckr_remain.php     | (EUC-KR)캐쉬, 포인트, 문자방울 잔량 확인 예제
 example_euckr_localkey.php   | (EUC-KR)클라이언트측 메시지ID 생성 예제
 example_euckr_rcheck.php     | (EUC-KR)핸드폰 수신결과 확인 예제
 example_utf8_sendsms.php     | (UTF-8)문자메시지 전송 예제
 example_utf8_sendlms.php     | (UTF-8)장문(2,000바이트) LMS 전송 예제
 example_utf8_sendmms.php     | (UTF-8)장문(2,000바이트) MMS 이미지 전송 예제
 example_utf8_remain.php      | (UTF-8)캐쉬, 포인트, 문자방울 잔량 확인 예제
 example_utf8_localkey.php    | (UTF-8)클라이언트측 메시지ID 생성 예제
 example_utf8_rcheck.php      | (UTF-8)핸드폰 수신결과 확인 예제
--------------------------------------------------------------------------------


  Quick Start

문자 1건을 보내는 간단한 예제를 만드는 방법을 설명합니다.

1. coolsms.php 파일과 example_euckr_sendsms.php(혹은 example_utf8_sendsms.php)파
   일을 웹페이지에 노출되는 디렉토리 아래로 복사합니다.

2. example_euckr_sendsms.php 파일을 열어서 50번째 줄에 coolsms_user_id와 coolsms
   _user_password 를 www.coolsms.co.kr 사이트에서 가입할 때 입력 아이디와 비밀번   호를 그대로 입력합니다.

     $sms->setuser("example", "example-password");

3. 75번째 줄에 addsms 메소드 호출에서 받는번호(반드시 SMS를 받을 수 있는 핸드폰
   번호로 입력), 회신번호, 문자내용을 입력해 줍니다.

     if (!$sms->addsms("01012123434", "01012123434", "테스트 문자")) {

4. 웹브라우저를 띄워서 주소창에 http://mydomain.com/example_euckr_sendsms.php 를
   입력하고 엔터를 누르면 핸드폰으로 "테스트 문자"라는 문자가 수신됨을 확인하세
   요. 

5. 문자가 수신되지 않을 경우 전송결과(http://www.coolsms.co.kr/?mid=report)에서
   전송상태를 확인하세요.

상세 매뉴얼은 http://doc.nurigo.net/694 에서 확인하세요.
