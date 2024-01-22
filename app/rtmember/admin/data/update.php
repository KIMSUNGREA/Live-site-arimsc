<?php
//-------------------------------------------------------------------------------------------------
/*
 * 회원 정보 업데이트
 * 
 * $env->_post['mode'] 데이터 처리 구분
 * 
 * insert		: 회원 신규 가입
 * modify		: 회원 정보 수정
 * delete		: 회원 삭제(DB에서 직접 삭제)
 * check_id		: 아이디 중복 검사
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ADM."/engine.php";

//-------------------------------------------------------------------------------------------------

/**
 * 컴포넌트 로드
 */

rt_load_component("board");

//-------------------------------------------------------------------------------------------------

/**
 * 컨트롤러 로드
 */

$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='rtmember'");

require_once RT_DOC_ROOT.$_app['app_path']."/config/rtmember.config.php";
require_once RT_DOC_ROOT.$_app['app_path']."/controller/rtmember.admin.controller.php";
$cls_mem = new rtmember_admin();

//-------------------------------------------------------------------------------------------------

$data = array();//DB 필드데이터

if ($env->_post['mode'] == "insert")
{
	if ($env->_post['phone1'] && $env->_post['phone2'] && $env->_post['phone3']) {
		$phone = $env->_post['phone1']."-".$env->_post['phone2']."-".$env->_post['phone3'];
	}

	if ($env->_post['email_id'] && $env->_post['email_domain']) {
		$email = trim($env->_post['email_id'])."@".trim($env->_post['email_domain']);
	}

	//아이디 중복 체크
	$r = $dbo->fetch("SELECT * FROM RT_RTMEMBER WHERE user_id='".trim($env->_post['user_id'])."'");
	if (!empty($r['user_id'])) {
		rt_js_msg("아이디가 중복되었습니다.");exit;
	}

	//이메일 중복 체크
	$_email = $dbo->fetch("SELECT * FROM RT_RTMEMBER WHERE email='".$email."'");
	if (!empty($_email['seq'])) {
		rt_js_msg("이미 등록된 E-mail입니다.", "parent");exit;
	}

	//휴대폰 중복 체크
	$_phone = $dbo->fetch("SELECT * FROM RT_RTMEMBER WHERE phone='".$phone."'");
	if (!empty($_phone['seq'])) {
		rt_js_msg("이미 등록된 휴대폰 번호 입니다..", "parent");exit;
	}

	$udata['user_id'		] = trim($env->_post['user_id']);
	$udata['user_pw'		] = rt_password($env->_post['user_pw']);
	$udata['user_nm'		] = trim($env->_post['user_nm']);
	$udata['phone'			] = $phone;
	$udata['sms_en'			] = ($env->_post['sms_en'])?$env->_post['sms_en']:"n";
	$udata['email'			] = $email;
	$udata['email_en'		] = ($env->_post['email_en'])?$env->_post['email_en']:"n";
	$udata['mgroup'			] = $env->_post['mgroup'];
	$udata['recode'			] = $env->_post['recode'];
	$udata['rest_en'		] = "n";
	$udata['blockout_en'	] = ($env->_post['blockout_en'])?$env->_post['blockout_en']:"n";
	$udata['withdraw_en'	] = "n";
	$udata['point'			] = 0;//관리자 설정에 따름
	$udata['reg_date'		] = date("Y-m-d H:i:s");

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
		rt_js_move("", "parent", "href", RTW_ADM."/app/?appcode=rtmember&sd=admin-data");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "modify" && is_numeric($env->_post['seq']))
{
	if ($env->_post['phone1'] && $env->_post['phone2'] && $env->_post['phone3']) {
		$phone = $env->_post['phone1']."-".$env->_post['phone2']."-".$env->_post['phone3'];
	}

	if ($env->_post['email_id'] && $env->_post['email_domain']) {
		//$email = trim($env->_post['email_id'])."@".trim($env->_post['email_domain']);
	}

	//패스워드 변경
	if (!empty($env->_post['user_pw']) || !empty($env->_post['user_pw_re'])) {
		if ($env->_post['user_pw'] == $env->_post['user_pw_re']) {
			$udata['user_pw'] = rt_password($env->_post['user_pw']);
		} else {
			rt_js_msg("패스워드가 맞지 않습니다.");
			exit;
		}
	}

	$udata['user_nm'		] = trim($env->_post['user_nm']);
	$udata['phone'			] = $phone;
	$udata['sms_en'			] = ($env->_post['sms_en'])?$env->_post['sms_en']:"n";
	//$udata['email'			] = $email;
	$udata['email_en'		] = ($env->_post['email_en'])?$env->_post['email_en']:"n";
	$udata['mgroup'			] = $env->_post['mgroup'];
	$udata['recode'			] = $env->_post['recode'];
	$udata['rest_en'		] = ($env->_post['rest_en'])?$env->_post['rest_en']:"n";
	$udata['blockout_en'	] = ($env->_post['blockout_en'])?$env->_post['blockout_en']:"n";
	$udata['withdraw_en'	] = ($env->_post['withdraw_en'])?$env->_post['withdraw_en']:"n";
	$udata['point'			] = $env->_post['point'];
	$udata['blockout_date'	] = ($env->_post['blockout_en'] == "y")?date("Y-m-d H:i:s"):"";
	$udata['rest_date'		] = ($env->_post['rest_en'] == "y")?date("Y-m-d H:i:s"):"";
	$udata['mod_date'		] = date("Y-m-d H:i:s");
	$udata['withdraw_date'	] = ($env->_post['withdraw_en'] == "y")?date("Y-m-d H:i:s"):"";

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

	if ($dbo->update("RT_RTMEMBER", $udata, "seq=".$env->_post['seq'])) {

		if ($env->_post['searchstring']) {
			$addurl = "&search=".$env->_post['search']."&searchstring=".$env->_post['searchstring'];
		}
		rt_js_move("", "parent", "href", RTW_ADM."/app/?appcode=rtmember&sd=admin-data&cf=view&seq=".$env->_post['seq']."&pg=".$env->_post['pg'].$addurl);
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "approval" && is_numeric($env->_post['seq']))
{
	$udata['approval_en'] = $env->_post['en'];

	if ($dbo->update("RT_RTMEMBER", $udata, "seq=".$env->_post['seq'])) {
		?>var chkres=1;<?
	} else {
		?>var chkres=0;<?
	}
}
else if ($env->_post['mode'] == "delete" && is_numeric($env->_post['seq']))
{
	if ($dbo->query("DELETE FROM RT_RTMEMBER WHERE seq='".$env->_post['seq']."' LIMIT 1")) {
		?>var chkres=1;<?
	} else {
		?>var chkres=0;<?
	}
}
else if ($env->_post['mode'] == "check_id" && $env->_post['user_id'])
{
	$_r = $dbo->fetch("SELECT * FROM RT_RTMEMBER WHERE user_id='".$env->_post['user_id']."'");
	if ($_r['user_id']) {
		?>var chkres=0;<?
	} else {
		?>var chkres=1;<?
	}

}
exit;
?>