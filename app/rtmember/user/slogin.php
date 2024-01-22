<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

$__type = explode("__", $_GET["state"]);

if ($__type[0] == "NA") {

	$client_id = "1UwHNGcSysWa42fz5F7E";
	$client_secret = "2hO0dGXIB2";
	$code = $_GET["code"];
	$state = $_GET["state"];
	$redirectURI = urlencode("http://".$_SERVER['HTTP_HOST']."/app/rtmember/user/slogin.php");
	$api = "https://nid.naver.com/oauth2.0/token";
	$params = array();
	$params['grant_type'] = "authorization_code";
	$params['client_id'] = $client_id;
	$params['client_secret'] = $client_secret;
	$params['redirectURI'] = $redirectURI;
	$params['code'] = $code;
	$params['state'] = $state;
	$method = "GET";

	$_token = request($api, $params, $method, $header);

	//$book = json_decode($book,1);

	$token = $_token['access_token'];
	$header = "Authorization: Bearer ".$token; // Bearer 다음에 공백 추가
	$url = "https://openapi.naver.com/v1/nid/me";
	$method = "GET";

	$info = request($url, "", $method, $header);

	//set_session('login_seq', $info['response']['id']);

	//print_r($info); exit;

	$__id = $info['response']['id'];
	$__name = $info['response']['name'];

	if (!empty($__id)) {
		//php5 이상 세션등록 - sns로그인 세션 저장
		$_SESSION['RT_USER_ID'] = $__id;
		$_SESSION['RT_USER_NM'] = $__name;
		$_SESSION['RT_USER_GR']= 1;

		rt_js_move("", "self", "href", "/");
	}

}
?>