<?
//공동 환경변수 파일
require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";
require_once $_SERVER['DOCUMENT_ROOT']."/app/rtmember/config/rtmember.config.php";

define('NAVER_CLIENT_ID', $_rtm_cfg['naver_client_id']);
define('NAVER_CLIENT_SECRET', $_rtm_cfg['naver_secret_key']);
define('NAVER_CALLBACK_URL', $_rtm_cfg['naver_callback_url']); 

//취소 버튼 대응
if ($_GET['error_description'] == "Canceled By User") {
	rt_js_move("", "self", "href","/page/mb/login.php");
	exit;
}

$naver_curl = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".NAVER_CLIENT_ID."&client_secret=".NAVER_CLIENT_SECRET."&redirect_uri=".urlencode(NAVER_CALLBACK_URL)."&code=".$_GET['code'];
 
// 토큰값 가져오기 
$is_post = false; 
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $naver_curl); 
curl_setopt($ch, CURLOPT_POST, $is_post); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

$response = curl_exec ($ch); 
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
curl_close ($ch); 

if ($status_code == 200) { 

	$responseArr = json_decode($response, true); 

	// 토큰값으로 네이버 회원정보 가져오기 
	$headers = array( 'Content-Type: application/json', sprintf('Authorization: Bearer %s', $responseArr['access_token']) ); 
	$is_post = false; 
	$me_ch = curl_init(); 
	curl_setopt($me_ch, CURLOPT_URL, "https://openapi.naver.com/v1/nid/me"); 
	curl_setopt($me_ch, CURLOPT_POST, $is_post ); 
	curl_setopt($me_ch, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt($me_ch, CURLOPT_RETURNTRANSFER, true); 
	$res = curl_exec ($me_ch); 
	curl_close ($me_ch); 
	$res_data = json_decode($res , true);

    /*
Array
(
    [resultcode] => 00
    [message] => success
    [response] => Array
        (
            [id] => OZr3n4Nlle7JV_mVdjTayQkkAhUMitZewOOf738uy1A
            [email] => peetee@naver.com
        )

)

ID : 일반회원(이메일), SNS(UNIQ ID)
Email : 일반회원(ID와 동일하게 세팅, 변경불가), SNS(회신이메일로 기록, 없을 경우 공란, 수기입력 독려 메시지)

[아이디가 없는 경우 - 회원가입]
 - ID : 회신받은 아이디로 기록
 - email : 회신받은 이메일로 기록
 - 회신 받은 이메일이 중복일 경우 알림을 띄워주고 이메일 필드에 기록하지 않음
 - 로그인 후 마이페이지로 강제 이동 시켜서 이름과 이메일을 기입하게 독려

[아이디가 있는 경우 - 로그인]
 - 이름/이메일 필드가 비어 있을 경우 기입 독려 메시지
    */
 
	if ($res_data['response']['id']) {

		$user_id = $res_data['response']['id'];
		$email = $res_data['response']['email'];

		//기존 회원 ID 중복 체크
		$_r = $dbo->fetch("SELECT * FROM ".$cls_rtm->tbl." WHERE user_id='".$user_id."' AND lgubun='n'");

		if ($_r['user_id']) {

			$result = $cls_rtm->login_sns($user_id, "n");

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
				rt_js_move("이미 가입된 이메일입니다. 카카오로그인이나 계정찾기를 이용해 주세요.", "parent", "href", "/page/mb/login.php");
			} else {

				// ID 가 존재 하지 않을 경우 가입 처리
				$udata['user_id'		] = $user_id;
				$udata['user_nm'		] = "";
				$udata['email'			] = $email;
				$udata['lgubun'			] = "n";
				$udata['rest_en'		] = "n";
				$udata['blockout_en'	] = "n";
				$udata['withdraw_en'	] = "n";
				$udata['approval_en'	] = ($cls_rtm->_rtm_conf['mb_approval_en'] == 'y')?"n":"y";
				$udata['mgroup'			] = 2;
				$udata['reg_date'		] = date("Y-m-d H:i:s");

				if($dbo->insert("RT_RTMEMBER", $udata)) {

					$result = $cls_rtm->login_sns($user_id, "n");

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