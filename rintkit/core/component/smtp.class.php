<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: SMTP 메일 발송 콤포넌트(PHPMailer 사용)
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (!class_exists("smtp_class")) {

	class smtp_class {

		var $env, $dbo;
		var $conf, $_rtm_conf;
		var $html_head, $html_bottom;

		//----------------------------------------------------------------------------------------------

		/**
		* 생성자
		*/

		function smtp_class() {

			global $env, $dbo, $_rtm_conf;

			$this->dbo			= $dbo;
			$this->env			= $env;
			$this->conf			= $this->dbo->fetch("SELECT * FROM RT_CONFIG");
			$this->_rtm_conf	= $_rtm_conf;

			$this->set_mail_layout();
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 메일 발송
		*/

		function mailsend($r_email, $r_name, $subj, $cont) {

			$title_encode = "=?utf-8?B?".base64_encode($subj)."?=\n"; //제목 인코딩
			$mail_html = $this->html_head.$cont.$this->html_bottom;

			$headers = "MIME-Version: 1.0" . "\r\n"; 
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; //헤더인코딩
			$headers .= "From: ".$this->conf['sender_email']."\r\n"; //보내는 사람

			mail($r_email, $title_encode, $mail_html, $headers); //메일보내기
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 회원 가입 메일
		*/

		function member_join($join_arr) {

			global $_rt_rtmember;

			//템틀릿 환경 세팅
			rt_load_component("tpl");
			$tpl = new tpl(RT_DOC_ROOT.$_rt_rtmember['app_path']);
			$tpl->define(array('join' => $this->_rtm_conf['mb_skin_join_mail']));

			//템틀릿 코드
			$tpl->assign('회사명', $this->conf['company']);
			$tpl->assign('사이트명', $this->conf['website']);
			$tpl->assign('대표자명', $this->conf['ceo_nm']);
			$tpl->assign('대표전화', $this->conf['comp_tel']);
			$tpl->assign('팩스', $this->conf['comp_fax']);
			$tpl->assign('회사이메일', $this->conf['comp_email']);
			$tpl->assign('회사주소', $this->conf['comp_addr']);
			$tpl->assign('사업자번호', $this->conf['comp_number1']);
			$tpl->assign('법인번호', $this->conf['comp_number2']);
			$tpl->assign('통신판매번호', $this->conf['comp_number3']);
			$tpl->assign('업태', $this->conf['comp_type1']);
			$tpl->assign('종목', $this->conf['comp_type2']);
			$tpl->assign('아이디', $join_arr['user_id']);
			$tpl->assign('회원명', $join_arr['user_nm']);
			$tpl->assign('이메일', $join_arr['email']);
			$tpl->assign('가입날짜', date("Y-m-d"));
			$tpl->assign('가입년', date("Y"));
			$tpl->assign('가입월', date("m"));
			$tpl->assign('가입일', date("d"));
			$tpl->assign('수신거부링크', "//".$this->conf['domain'].$_rt_rtmember['app_path']."/user/mail_refusal.php?email=".$join_arr['email']);

			//메일본문 설정
			$cont = $tpl->fetch("join");

			//메일 제목
			$subj = "[".$this->conf['website']."] 회원가입이 되었습니다.";

			//메일 발송
			$this->mailsend($join_arr['email'], $join_arr['user_nm'], $subj, $cont);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 계정 찾기 - 아이디
		*/

		function member_find_id($find_arr) {

			global $_rt_rtmember;

			//템틀릿 환경 세팅
			rt_load_component("tpl");
			$tpl = new tpl(RT_DOC_ROOT.$_rt_rtmember['app_path']);
			$tpl->define(array('findid' => $this->_rtm_conf['mb_skin_findid_mail']));

			//템틀릿 코드
			$tpl->assign('회사명', $this->conf['company']);
			$tpl->assign('사이트명', $this->conf['website']);
			$tpl->assign('대표자명', $this->conf['ceo_nm']);
			$tpl->assign('대표전화', $this->conf['comp_tel']);
			$tpl->assign('팩스', $this->conf['comp_fax']);
			$tpl->assign('회사이메일', $this->conf['comp_email']);
			$tpl->assign('회사주소', $this->conf['comp_addr']);
			$tpl->assign('사업자번호', $this->conf['comp_number1']);
			$tpl->assign('법인번호', $this->conf['comp_number2']);
			$tpl->assign('통신판매번호', $this->conf['comp_number3']);
			$tpl->assign('업태', $this->conf['comp_type1']);
			$tpl->assign('종목', $this->conf['comp_type2']);
			$tpl->assign('아이디', $find_arr['user_id']);
			$tpl->assign('회원명', $find_arr['user_nm']);
			$tpl->assign('이메일', $find_arr['email']);
			$tpl->assign('수신거부링크', "//".$this->conf['domain'].$_rt_rtmember['app_path']."/user/mail_refusal.php?email=".$find_arr['email']);

			//메일본문 설정
			$cont = $tpl->fetch("findid");

			//메일 제목
			$subj = "[".$this->conf['website']."] 홈페이지에 가입된 회원 아이디입니다.";

			//메일 발송
			$this->mailsend($find_arr['email'], $find_arr['user_nm'], $subj, $cont);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 계정 찾기 - 비밀번호
		*/

		function member_find_pw($find_arr) {

			global $_rt_rtmember;

			//템틀릿 환경 세팅
			rt_load_component("tpl");
			$tpl = new tpl(RT_DOC_ROOT.$_rt_rtmember['app_path']);
			$tpl->define(array('findpw' => $this->_rtm_conf['mb_skin_findpw_mail']));

			//템틀릿 코드
			$tpl->assign('회사명', $this->conf['company']);
			$tpl->assign('사이트명', $this->conf['website']);
			$tpl->assign('대표자명', $this->conf['ceo_nm']);
			$tpl->assign('대표전화', $this->conf['comp_tel']);
			$tpl->assign('팩스', $this->conf['comp_fax']);
			$tpl->assign('회사이메일', $this->conf['comp_email']);
			$tpl->assign('회사주소', $this->conf['comp_addr']);
			$tpl->assign('사업자번호', $this->conf['comp_number1']);
			$tpl->assign('법인번호', $this->conf['comp_number2']);
			$tpl->assign('통신판매번호', $this->conf['comp_number3']);
			$tpl->assign('업태', $this->conf['comp_type1']);
			$tpl->assign('종목', $this->conf['comp_type2']);
			$tpl->assign('아이디', $find_arr['user_id']);
			$tpl->assign('회원명', $find_arr['user_nm']);
			$tpl->assign('이메일', $find_arr['email']);
			$tpl->assign('임시패스워드', $find_arr['new_pw']);
			$tpl->assign('수신거부링크', "//".$this->conf['domain'].$_rt_rtmember['app_path']."/user/mail_refusal.php?email=".$find_arr['email']);

			//메일본문 설정
			$cont = $tpl->fetch("findpw");

			//메일 제목
			$subj = "[".$this->conf['company']."] 임시 패스워드를 발송해 드립니다.";

			//메일 발송
			$this->mailsend($find_arr['email'], $find_arr['user_nm'], $subj, $cont);
		}

		/**
		* 계정 찾기 - 비밀번호
		*/

		function member_rest($rest_arr) {

			global $_rt_rtmember;

			//템틀릿 환경 세팅
			rt_load_component("tpl");
			$tpl = new tpl(RT_DOC_ROOT.$_rt_rtmember['app_path']);
			$tpl->define(array('rest' => $this->_rtm_conf['mb_skin_rest_mail']));

			//템틀릿 코드
			$tpl->assign('회사명', $this->conf['company']);
			$tpl->assign('사이트명', $this->conf['website']);
			$tpl->assign('대표자명', $this->conf['ceo_nm']);
			$tpl->assign('대표전화', $this->conf['comp_tel']);
			$tpl->assign('팩스', $this->conf['comp_fax']);
			$tpl->assign('회사이메일', $this->conf['comp_email']);
			$tpl->assign('회사주소', $this->conf['comp_addr']);
			$tpl->assign('사업자번호', $this->conf['comp_number1']);
			$tpl->assign('법인번호', $this->conf['comp_number2']);
			$tpl->assign('통신판매번호', $this->conf['comp_number3']);
			$tpl->assign('업태', $this->conf['comp_type1']);
			$tpl->assign('종목', $this->conf['comp_type2']);
			$tpl->assign('아이디', $rest_arr['user_id']);
			$tpl->assign('회원명', $rest_arr['user_nm']);
			$tpl->assign('이메일', $rest_arr['email']);
			$tpl->assign('가입날짜', date("Y-m-d"));
			$tpl->assign('가입년', date("Y"));
			$tpl->assign('가입월', date("m"));
			$tpl->assign('가입일', date("d"));
			$tpl->assign('휴면해제링크', "//".$this->conf['domain'].$_rt_rtmember['app_path']."/user/mail_rest.php?email=".$rest_arr['email']);
			$tpl->assign('수신거부링크', "//".$this->conf['domain'].$_rt_rtmember['app_path']."/user/mail_refusal.php?email=".$rest_arr['email']);

			//메일본문 설정
			$cont = $tpl->fetch("rest");

			//메일 제목
			$subj = "[".$this->conf['website']."] 휴면회원 해제 안내";

			//메일 발송
			$this->mailsend($rest_arr['email'], $rest_arr['user_nm'], $subj, $cont);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 메일 레이아웃 설정
		*/

		function set_mail_layout() {

			$this->html_head = "
			<html>
			<head>
				<title>".$this->conf['website']."</title>
			</head>
			<body>";
			$this->html_bottom = "
			</body>
			</html>";
		}

		//----------------------------------------------------------------------------------------------
	}

}
?>