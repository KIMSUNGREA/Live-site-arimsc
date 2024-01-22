<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";
/*
// 네이버 로그인 콜백 예제
$client_id = "r7KuDfMfh4Hts0IYMslg";
$client_secret = "MpMHC3UXS8";
$code = $_GET["code"];
$state = $_GET["state"];
$redirectURI = urlencode("YOUR_CALLBACK_URL");
$url = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&redirect_uri=".$redirectURI."&code=".$code."&state=".$state;

$is_post = false;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, $is_post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = array();
$response = curl_exec ($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo "status_code:".$status_code."<br>";

curl_close ($ch);

if($status_code == 200) {
	echo $response;
} else {
	echo "Error 내용:".$response;
}
*/
?>
<!doctype html>
<html lang="ko">
<head>
<script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.2.js" charset="utf-8"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
<script type="text/javascript">

// 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
  function naverSignInCallback() {
    //alert(naver_id_login.getProfileData('email'));
    //alert(naver_id_login.getProfileData('nickname'));
    //alert(naver_id_login.getProfileData('age'));
	opener.window.location.href="/";
  }

  var naver_id_login = new naver_id_login("r7KuDfMfh4Hts0IYMslg");

  // 접근 토큰 값 출력
  if (naver_id_login.oauthParams.access_token) {
	// 네이버 사용자 프로필 조회
	naver_id_login.get_naver_userprofile("naverSignInCallback()");
  } else {
	  self.close();
  }

</script>
</body>
</html>