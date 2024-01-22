<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 회원 데이터 관리
//-----------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

//-----------------------------------------------------------------------------------------

/**
 * 로그인
*/

if ($env->_post['mode'] == "login") {

	if ($env->_post['is_memory'] == "y") {
		rt_set_cookie("save_adm_id", $env->_post['userid'], 30);
	} else {
		rt_del_cookie("save_adm_id");
	}

	$result = $cls_rtm->login($env->_post['userid'], $env->_post['userpw']);

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

		rt_js_move("", "parent", "href", $rt_conf_db['ssl_url_n'].$movepage);
	}

//-------------------------------------------------------------------------------------------------

/**
 * 아이디 체크
*/
} else if ($env->_post['mode'] == "check_id" && $env->_post['user_id']) {

	//기존 회원 ID 중복 체크
	$_r = $dbo->fetch("SELECT * FROM ".$cls_rtm->tbl." WHERE user_id='".$env->_post['user_id']."'");
	if ($_r['user_id']) {
		?>var chkres=0;<?
	} else {
		?>var chkres=1;<?
	}

	//가입 제한 ID
	$arr_refusal = explode(",", $cls_rtm->_rtm_conf['refusal_id']);
	if (in_array($env->_post['user_id'], $arr_refusal)) {
		?>var chkres=0;<?
	}

//-------------------------------------------------------------------------------------------------

/**
 * 회원 가입
*/
} else if ($env->_post['mode'] == "insert") {

	if ($env->_post['phone1'] && $env->_post['phone2'] && $env->_post['phone3']) {
		//$phone = $env->_post['phone1']."-".$env->_post['phone2']."-".$env->_post['phone3'];
	}

	if ($env->_post['email_id'] && $env->_post['email_domain']) {
		$email = trim($env->_post['email_id'])."@".trim($env->_post['email_domain']);
	} else {
		rt_js_msg("아이디(이메일)가 작성되지 않았습니다.");
		exit;
	}

	//회원아이디는 이메일로 설정
	$env->_post['user_id'] = $email;

	//보안문자 체크
	if ($env->_post['sec_code'] != $env->_session['RT_CAPCHA_JOIN']) {
		rt_js_msg("보안문자가 맞지 않습니다");
		?>
		<script>
			parent.$("#btn-form-submit").show();
			parent.$("#join_check").val('n');
		</script>
		<?
		exit;
	}

	//아이디 중복 체크
	$_userid = $dbo->fetch("SELECT * FROM ".$cls_rtm->tbl." WHERE user_id='".$env->_post['user_id']."'");
	if ($_userid['seq']) {
		rt_js_msg("이미 등록된 아이디(이메일) 입니다.");
		?>
		<script>
			parent.$("#btn-form-submit").show();
			parent.$("#join_check").val('n');
		</script>
		<?
		exit;
	}

	//이메일 중복 체크
	/*
	$_email = $dbo->fetch("SELECT * FROM ".$cls_rtm->tbl." WHERE email='".$email."'");
	if ($_email['seq']) {
		rt_js_msg("이미 등록된 E-mail입니다.");
		?>
		<script>
			parent.$("#btn-form-submit").show();
			parent.$("#join_check").val('n');
		</script>
		<?
		exit;
	}
	*/

	//휴대폰 중복 체크
	/*
	$_phone = $dbo->fetch("SELECT * FROM ".$cls_rtm->tbl." WHERE phone='".$phone."'");
	if ($_phone['seq']) {
		rt_js_msg("이미 등록된 휴대폰 번호 입니다..");
		?>
		<script>
			parent.$("#btn-form-submit").show();
			parent.$("#join_check").val('n');
		</script>
		<?
		exit;
	}
	*/

	$udata['lgubun'			] = "w";
	$udata['user_id'		] = $env->_post['user_id'];
	$udata['user_pw'		] = rt_password($env->_post['user_pw']);
	$udata['user_nm'		] = trim($env->_post['user_nm']);
	//$udata['phone'			] = $phone;
	//$udata['sms_en'			] = ($env->_post['sms_en'])?$env->_post['sms_en']:"n";
	$udata['email'			] = $email;
	$udata['email_en'		] = ($env->_post['email_en'])?$env->_post['email_en']:"n";
	$udata['email_en'		] = "y";
	$udata['rest_en'		] = "n";
	$udata['blockout_en'	] = "n";
	$udata['withdraw_en'	] = "n";
	$udata['approval_en'	] = ($cls_rtm->_rtm_conf['mb_approval_en'] == 'y')?"n":"y";
	$udata['mgroup'			] = 1;
	$udata['reg_date'		] = date("Y-m-d H:i:s");
	$udata['recode'			] = time();

	/* 추가 폼 데이터 처리 S */
	$arSz = array();
	foreach ($env->_post as $k => $v)
	{
		$arK = null;
		$arFV = null;

		$arK = explode("_", $k);

		if (is_numeric($arK[1])) {
			$arFV = $dbo->fetch("SELECT * FROM RT_RTMEMBER_ADD_FIELD WHERE seq='".$arK[1]."'");
		}

		if ($arK[0] == "rtfeild") {

			$arSz[$arK[1]]['type'] = $arFV['type'];
			$arSz[$arK[1]]['name'] = $arFV['name'];

			if ($arFV['type'] == "checkbox") {
				$arSz[$arK[1]]['val'][$arK[2]] = $v;
			} else {
				$arSz[$arK[1]]['val'] = $v;
			}
		}
	}
	$udata['extvar'] = serialize($arSz);
	/* 추가 폼 데이터 처리 E */

	if ($dbo->insert("RT_RTMEMBER", $udata)) {

		if ($cls_rtm->_rtm_conf['join_send_email_en'] == 'y' && $udata['email_en'] == "y" && $email) {

			//가입 메일 발송
			rt_load_component("smtp");

			$cls_email = new smtp_class();

			$join_arr = array();
			$join_arr['user_id'] = $udata['user_id'];
			$join_arr['user_nm'] = $udata['user_nm'];
			$join_arr['email'] = $email;
			$cls_email->member_join($join_arr);
		}

		if ($cls_rtm->_rtm_conf['join_send_sms_en'] == 'y' && $udata['sms_en'] == "y" && $phone) {

			//가입 SMS 발송
			rt_load_lib("sms");

			$r_num = str_replace("-","",$phone);
			$s_num = $rt_conf_db['sender_phone'];
			$s_msg = $cls_rtm->_rtm_conf['sms_content'];

			//SMS 발송
			rt_sms($r_num, $s_num, $s_msg);
		}

		//이동할 페이지 설정
		if ($cls_pg->conn_screen == "mobile") {

			if ($env->_post['pcd']) {
				$movepage = $env->_post['php_self']."?cf=step3&memid=".$env->_post['user_id']."&pcd=".$env->_post['pcd']."&screen=mobile";
			} else {
				$movepage = $cls_rtm->_rtm_conf['join_after_url_mobile'];
			}

		} else {

			if ($env->_post['pcd']) {
				$movepage = $env->_post['php_self']."?cf=step3&memid=".$env->_post['user_id']."&pcd=".$env->_post['pcd'];
			} else {
				$movepage = $cls_rtm->_rtm_conf['join_after_url'];
			}
		}

		$movemsg = ($cls_rtm->_rtm_conf['mb_approval_en'] == 'n') ? "회원가입되었습니다. 감사합니다." : "회원가입되었습니다. 관리자 승인 후 로그인이 가능합니다.";

		rt_js_move($movemsg, "parent", "href", $rt_conf_db['ssl_url_n'].$movepage);

	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

//-------------------------------------------------------------------------------------------------

/**
 * 회원 정보 수정
*/
} else if ($env->_post['mode'] == "modify") {

	if (!$cls_rtm->is_login()) {
		$movepage = ($cls_rtm->_rtm_conf['login_set_page'])?$cls_rtm->_rtm_conf['login_set_page']:"/";
		rt_js_move("로그인을 해주세요", "parent", "href", $movepage);
		exit;
	}

	if ($env->_post['phone1'] && $env->_post['phone2'] && $env->_post['phone3']) {
		//$udata['phone'] = $env->_post['phone1']."-".$env->_post['phone2']."-".$env->_post['phone3'];
	}

	if ($env->_post['email_id'] && $env->_post['email_domain']) {
		$udata['email'] = trim($env->_post['email_id'])."@".trim($env->_post['email_domain']);
	}

	if ($env->_post['user_pw'] && $env->_post['user_pw_re']) {
		$udata['user_pw'] = rt_password($env->_post['user_pw']);
	}

	if ($env->_post['user_nm']) {
		$udata['user_nm'] = $env->_post['user_nm'];
	}
	//$udata['sms_en'			] = ($env->_post['sms_en'])?$env->_post['sms_en']:"n";
	$udata['email_en'		] = ($env->_post['email_en'])?$env->_post['email_en']:"n";
	$udata['mod_date'		] = date("Y-m-d H:i:s");

	/* 추가 폼 데이터 처리 S */
	$arSz = array();
	foreach ($env->_post as $k => $v)
	{
		$arK = null;
		$arFV = null;

		$arK = explode("_", $k);

		if (is_numeric($arK[1])) {
			$arFV = $dbo->fetch("SELECT * FROM RT_RTMEMBER_ADD_FIELD WHERE seq='".$arK[1]."'");
		}

		if ($arK[0] == "rtfeild") {

			$arSz[$arK[1]]['type'] = $arFV['type'];
			$arSz[$arK[1]]['name'] = $arFV['name'];

			if ($arFV['type'] == "checkbox") {
				$arSz[$arK[1]]['val'][$arK[2]] = $v;
			} else {
				$arSz[$arK[1]]['val'] = $v;
			}
		}
	}
	$udata['extvar'] = serialize($arSz);
	/* 추가 폼 데이터 처리 E */

	//이동할 페이지 설정
	if ($cls_pg->conn_screen == "mobile") {

		if ($env->_post['pcd']) {
			$movepage = $env->_post['php_self']."?cf=mypage&pcd=".$env->_post['pcd']."&screen=mobile";
		} else {
			$movepage = $env->_post['php_self']."?cf=mypage";
		}

	} else {

		if ($env->_post['pcd']) {
			$movepage = $env->_post['php_self']."?cf=mypage&pcd=".$env->_post['pcd'];
		} else {
			$movepage = $env->_post['php_self']."?cf=mypage";
		}
	}

	if ($dbo->update("RT_RTMEMBER", $udata, "user_id='".$cls_rtm->id."'")) {
		//rt_js_move("내 정보가 업데이트되었습니다.", "parent", "href", $rt_conf_db['ssl_url_n'].$movepage);
		rt_js_move("내 정보가 업데이트되었습니다.", "parent", "href", "/page/mb/mypage.php");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

//-------------------------------------------------------------------------------------------------

/**
 * 회원 탈퇴
*/
} else if ($env->_post['mode'] == "withdraw") {

	if (!$cls_rtm->is_login()) {
		$movepage = ($cls_rtm->_rtm_conf['login_set_page'])?$cls_rtm->_rtm_conf['login_set_page']:"/";
		rt_js_move("로그인을 해주세요", "parent", "href", $rt_conf_db['ssl_url_n'].$movepage);
		exit;
	}

	if ($env->_post['sec_code'] != $env->_session['RT_CAPCHA_DRAW']) {
		rt_js_msg("보안문자가 맞지 않습니다", "parent");
		exit;
	}

	if ($env->_post['withdraw_type_en'] > 1) {

		//회원 삭제
		if ($dbo->query("DELETE FROM ".$cls_rtm->tbl." WHERE user_id='".$cls_rtm->id."'")) {

			session_destroy();

			rt_js_move("정상적 탈퇴되었습니다. 이용해 주셔서 감사합니다.", "parent", "href", $rt_conf_db['ssl_url_n']);
		} else {
			rt_js_msg("시스템문제로 처리되지 않았습니다.");
		}

	} else {

		//아이디 외 삭제
		$data = array();
		$data['user_pw'			] = "";
		$data['user_nm'			] = "";
		$data['phone'			] = "";
		$data['sms_en'			] = "n";
		$data['email'			] = "";
		$data['email_en'		] = "n";
		$data['rest_en'			] = "y";
		$data['blockout_en'		] = "y";
		$data['withdraw_en'		] = "y";
		$data['approval_en'		] = "n";
		$data['blockout_date'	] = "0000-00-00";
		$data['reg_date'		] = "0000-00-00";
		$data['rest_date'		] = "0000-00-00";
		$data['mod_date'		] = "0000-00-00";
		$data['withdraw_date'	] = date("Y-m-d H:i:s");

		if ($dbo->update($cls_rtm->tbl, $data, "user_id='".$cls_rtm->id."'")) {

			session_destroy();

			rt_js_move("정상적 탈퇴되었습니다. 이용해 주셔서 감사합니다.", "parent", "href", $rt_conf_db['ssl_url_n']);
		} else {
			rt_js_msg("시스템문제로 처리되지 않았습니다.");
		}
	}

//-------------------------------------------------------------------------------------------------

/**
 * 아이디 찾기
*/
} else if ($env->_post['mode'] == "findid") {

	//보안문자 체크
	if ($env->_post['sec_code'] == $env->_session['RT_CAPCHA_ID']) {

		if ($env->_post['findid_name'] && $env->_post['findid_email']) {

			$_r = $dbo->fetch("SELECT * FROM ".$cls_rtm->tbl." WHERE user_nm='".$env->_post['findid_name']."' AND email='".$env->_post['findid_email']."'");

			if ($_r['user_id']) {

				//회원 아이디 메일 발송
				rt_load_component("smtp");

				$cls_email = new smtp_class();

				$find_arr = array();
				$find_arr['user_id'] = $_r['user_id'];
				$find_arr['user_nm'] = $_r['user_nm'];
				$find_arr['email'] = $_r['email'];
				$cls_email->member_find_id($find_arr);

				?>
				var chkres = 'y';
				var sec_code = 'y';
				<?
			} else {
				?>var chkres = 'n'; var sec_code = 'y';<?
			}
		} else {
			?>var chkres = 'n'; var sec_code = 'y';<?
		}
	} else {
		?>var chkres = 'n'; var sec_code = 'n';<?
	}

//-------------------------------------------------------------------------------------------------

/**
 * 패스워드 찾기
*/
} else if ($env->_post['mode'] == "findpw") {

	//보안문자 체크
	if ($env->_post['sec_code'] == $env->_session['RT_CAPCHA_PW']) {

		if ($env->_post['findpw_id'] && $env->_post['findpw_name']) {

			$_r = $dbo->fetch("SELECT * FROM ".$cls_rtm->tbl." WHERE user_id='".$env->_post['findpw_id']."' AND user_nm='".$env->_post['findpw_name']."'");

			if ($_r['user_id']) {

				//새 비밀번호 생성
				$new_pw = $cls_rtm->get_new_password();

				//회원 정보 업데이트
				$data['user_pw'] = rt_password($new_pw);
				$dbo->update($cls_rtm->tbl, $data, "user_id='".$_r['user_id']."'");

				//임시 비밀번호 메일 발송
				rt_load_component("smtp");

				$cls_email = new smtp_class();

				$find_arr = array();
				$find_arr['user_id'] = $_r['user_id'];
				$find_arr['user_nm'] = $_r['user_nm'];
				$find_arr['new_pw'] = $new_pw;
				$find_arr['email'] = $_r['user_id'];
				$cls_email->member_find_pw($find_arr);

				?>var chkres = 'y'; var sec_code = 'y';<?
			} else {
				?>var chkres = 'n'; var sec_code = 'y';<?
			}
		} else {
			?>var chkres = 'n'; var sec_code = 'y';<?
		}
	} else {
		?>var chkres = 'n'; var sec_code = 'n';<?
	}

//-------------------------------------------------------------------------------------------------

/**
 * 보안문자
 */
} else if ($env->_post['mode'] == "capcha") {

	$capcha = rt_random_code();
	$_SESSION['RT_CAPCHA_'.strtoupper($env->_post['part'])] = $capcha[2];
	$randstr = "<b>".$capcha[0].", ".$capcha[1]."</b> 둘 중 큰 수를 입력해 주세요";

	?>var rand_str = '<?php echo $randstr;?>';<?

//-------------------------------------------------------------------------------------------------

}
exit;
?>