<?php
//-----------------------------------------------------------------------------------------
// 프로그램			: RINT-KIT
// 제작				: 린트킷(rintkit.com)
// 버전				: 1.0
// 인코딩			: UTF-8
// 설명				: RTMEMBER 공통 변수 설정
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-----------------------------------------------------------------------------------------

$_rtm_cfg = array();
$_rtm_cfg['phone'] = array("010","011","016","017","018","019");
$_rtm_cfg['tel'] = array("02","031","032","033","041","042","043","044","051","052","053","054","055","061","062","063","064","070");
$_rtm_cfg['email'] = array("naver.com","gmail.com","hanmail.net","hotmail.com","nate.com","yahoo.co.kr","dreamwiz.com","empal.com","korea.com","lycos.co.kr","netian.com");

# SNS 로그인정보
$_rtm_cfg['naver_client_id'] = "P0Rlz6FYoUtfdUwmC4je";
$_rtm_cfg['naver_secret_key'] = "9KFkhRQkvh";
$_rtm_cfg['naver_callback_url'] = "http://arim.admin2.co.kr/page/callback/callback_member_naver.php";

$_rtm_cfg['kakao_client_id'] = "8c643898214dc9af02955141e68e515f";
$_rtm_cfg['kakao_callback_url'] = "http://arim.admin2.co.kr/page/callback/callback_member_kakao.php";

/*
# SNS 로그인정보
$_rtm_cfg['naver_client_id'] = "597VCnQXkGJ8AvTZ0PAW";
$_rtm_cfg['naver_secret_key'] = "koGa9REgf2";
$_rtm_cfg['naver_callback_url'] = "https://eisaiedge.com/page/callback/callback_member_naver.php";

$_rtm_cfg['kakao_client_id'] = "5608d474e1d0dfb8cd0d43926ec121a9";
$_rtm_cfg['kakao_callback_url'] = "https://eisaiedge.com/page/callback/callback_member_kakao.php";
*/
?>