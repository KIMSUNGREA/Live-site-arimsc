<?
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: SMS 발송 라이브러리
// SMS 업체		: coolsms.co.kr
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (defined('_LIB_SMS_') === FALSE) {

	define('_LIB_SMS_',TRUE);

	//-----------------------------------------------------------------------------------------

	/**
	* SMS 발송
	*/
	function rt_sms($r_num, $s_num, $s_msg)
	{
		rt_coolsms($r_num, $s_num, $s_msg);
	}

	//-----------------------------------------------------------------------------------------

	/**
	* coolsms.co.kr
	*/

	function rt_coolsms($r_num, $s_num, $s_msg)
	{
		global $rt_conf_db;

		require_once RT_PLUGIN."/coolsms/coolsms.php";

		//모듈 기본 설정
		$sms = new coolsms();
		$sms->setRealMode();
		$sms->appversion("php/2.3.3");
		$sms->charset("utf8");
		$sms->setuser($rt_conf_db['sms_id'], $rt_conf_db['sms_pw']);

		if (!empty($s_msg)) {

			$sms->addsms($r_num, $s_num, $s_msg);
			$sms->connect();
			$sms->send();

			$arRet = $sms->getr();//발송 결과 저장

			//발송후 오류검사
			if ($sms->errordetected()){
				$is_succ = false;
				$errcnt++;
			} else {
				$is_succ = true;
				$succcnt++;
			}

			$sms->disconnect();//접속종료
			$sms->emptyall();//메시지목록을 지움
		}
	}

	//-----------------------------------------------------------------------------------------

	/**
	* coolsms.co.kr_v4
	*/

	function rt_coolsms_v4($r_num, $s_num, $s_msg)
	{
		global $rt_conf_db;

		$apiKey = $rt_conf_db['sms_id'];
		$apiSecret = $rt_conf_db['sms_pw'];
		 
		date_default_timezone_set('Asia/Seoul'); 
		$date = date('Y-m-d\TH:i:s.Z\Z', time());  // date must be ISO 8361 format 
		$salt = uniqid(); // Any random strings with [0-9a-zA-Z] 
		$signature = hash_hmac('sha256', $date.$salt, $apiSecret); 
		 
		$url = "https://rest.coolsms.co.kr/messages/v4/send"; 
		$fields = new stdClass(); 
		$message = new stdClass(); 
		$message->text = $s_msg; 
		$message->type = "SMS"; 
		$message->to = $r_num; 
		$message->from = $s_num; 
		$fields->message = $message; 
		$fields_string = json_encode($fields); 
		$header = "Authorization: HMAC-SHA256 apiKey={$apiKey}, date={$date}, salt={$salt}, signature={$signature}"; 
		 
		//open connection 
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($header, "Content-Type: application/json")); 
		curl_setopt($ch, CURLOPT_POST, count($fields)); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string); 
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);  
		 
		$result = curl_exec($ch); 
		echo $result; 
	}

	//-----------------------------------------------------------------------------------------

	/**
	 * 랜덤 인증코드(4자리 생성)
	 */
	function rt_get_authcode()
	{
		$str = explode(",","0,1,2,3,4,5,6,7,8,9");
		shuffle($str);
		return $str[0].$str[2].$str[4].$str[5];
	}

	//----------------------------------------------------------------------------------------------
}
?>