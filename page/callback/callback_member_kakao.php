<?
//공동 환경변수 파일
require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";
require_once $_SERVER['DOCUMENT_ROOT']."/app/rtmember/config/rtmember.config.php";

define('KAKAO_CLIENT_ID', $_rtm_cfg['kakao_client_id']);
define('KAKAO_CALLBACK_URL', $_rtm_cfg['kakao_callback_url']);

$kakao_curl = "https://kauth.kakao.com/oauth/token?grant_type=authorization_code&client_id=".KAKAO_CLIENT_ID."&redirect_uri=".KAKAO_CALLBACK_URL."&code=".$_GET['code'];
 
// 토큰값 가져오기 
$is_post = false; 
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $kakao_curl); 
curl_setopt($ch, CURLOPT_POST, $is_post); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
 
$response = curl_exec ($ch); 
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
curl_close ($ch); 
 
if($status_code == 200){

	$responseArr= json_decode($response); 

	// 토큰값으로 카카오 회원정보 가져오기 
	$headers = array( 'Content-Type: application/json', sprintf('Authorization: Bearer %s', $responseArr->access_token) ); 
	$is_post = false; 
	$me_ch = curl_init(); 
	curl_setopt($me_ch, CURLOPT_URL, "https://kapi.kakao.com/v2/user/me"); 
	curl_setopt($me_ch, CURLOPT_POST, $is_post ); 
	curl_setopt($me_ch, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt($me_ch, CURLOPT_RETURNTRANSFER, true); 
	$res = curl_exec ($me_ch); 
	curl_close ($me_ch); 
	$res_data = json_decode($res , true);

/*
Array
(
    [id] => 2918450107
    [connected_at] => 2023-07-18T13:38:54Z
    [kakao_account] => Array
        (
            [has_email] => 1
            [email_needs_agreement] => 
            [is_email_valid] => 1
            [is_email_verified] => 1
            [email] => peetee@naver.com
        )

)
*/
	if ($res_data["id"]) {

		$user_id = $res_data["id"];
		$email = $res_data['response']['email'];

		//기존 회원 ID 중복 체크
		$_r = $dbo->fetch("SELECT * FROM ".$cls_rtm->tbl." WHERE user_id='".$user_id."' AND lgubun='k'");
		
		if($_r['user_id']){

			$result = $cls_rtm->login_sns($user_id, "k");

			if ($result) {
				
				if (empty($env->_post['prepage'])) {
					if ($cls_pg->conn_screen == "mobile") {
						$movepage = $cls_rtm->_rtm_conf['login_after_url_mobile'];
					} else {
						$movepage = $cls_rtm->_rtm_conf['login_after_url'];
					}
				} else {
					$movepage = urldecode($env->_post['prepage']);
				}

				//이름/이메일 필드가 비어 있을 경우 마이페이지로 이동
				if ($_r['email']=="" || $_r['user_nm']=="") {
					rt_js_move("원활한 서비스이용을 위해 내 정보를 정확히 기입해 주세요.", "parent", "href", "/page/mb/mypage.php?cf=modify");
				} else {
					rt_js_move("", "parent", "href", $movepage);
				}
			}
		}
		else
		{
			//기존 회원 Email 중복 체크
			$_ck = $dbo->fetch("SELECT * FROM ".$cls_rtm->tbl." WHERE email='".$email."'");

			if ($_ck['user_id']) {
				rt_js_move("이미 가입된 이메일입니다. 네이버로그인이나 계정찾기를 이용해 주세요.", "parent", "href", "/page/mb/login.php");
			} else {

				// ID 가 존재 하지 않을 경우 가입 처리
				$udata['user_id'		] = $user_id;
				$udata['user_nm'		] = "";
				$udata['email'			] = $email;
				$udata['lgubun'			] = "k";
				$udata['rest_en'		] = "n";
				$udata['blockout_en'	] = "n";
				$udata['withdraw_en'	] = "n";
				$udata['approval_en'	] = ($cls_rtm->_rtm_conf['mb_approval_en'] == 'y')?"n":"y";
				$udata['mgroup'			] = 2;
				$udata['reg_date'		] = date("Y-m-d H:i:s");

				if($dbo->insert("RT_RTMEMBER", $udata)){

					$result = $cls_rtm->login_sns($user_id, "k");

					if ($result) {
						
						if (empty($env->_post['prepage'])) {
							if ($cls_pg->conn_screen == "mobile") {
								$movepage = $cls_rtm->_rtm_conf['login_after_url_mobile'];
							} else {
								$movepage = $cls_rtm->_rtm_conf['login_after_url'];
							}
						} else {
							$movepage = urldecode($env->_post['prepage']);
						}

						//이름/이메일 필드가 비어 있을 경우 마이페이지로 이동
						if ($_r['email']=="" || $_r['user_nm']=="") {
							rt_js_move("원활한 서비스이용을 위해 내 정보를 정확히 기입해 주세요.", "parent", "href", "/page/mb/mypage.php?cf=modify");
						} else {
							rt_js_move("", "parent", "href", $movepage);
						}
					}
				}
			}
		}
	}
}
?>
