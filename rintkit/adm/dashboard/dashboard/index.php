<?php
//-------------------------------------------------------------------------------------------------
/*
 * 대시보드
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }


//네비게이션 데이터
$__cfg = array();
$__cfg['nav'][0] = "대시보드";

switch ($__cf) {

	case "dashboard"	:

		$__cfg['nav'][1] = "메뉴 목록";

		//메일 환경정보 설정 여부
		$__mail_conf_is = true;
		$__mail_conf_arr = array("sender_name","receive_name","sender_email","receive_email","sender_phone","receive_phone");
		foreach($__mail_conf_arr as $k => $v) {
			if (empty($rt_conf_db[$v])) {$__mail_conf_is = false;}
		}

		//SMS 환경정보 환경정보 설정 여부
		$__sms_conf_is = true;
		$__sms_conf_arr = array("sms_id","sms_pw");
		foreach($__sms_conf_arr as $k => $v) {
			if (empty($rt_conf_db[$v])) {$__sms_conf_is = false;}
		}

		//보안 SSL 환경정보 환경정보 설정 여부
		$__ssl_conf_is = ($rt_conf_db['ssl_is'] == "y") ? true : false;

		//회원정책  y 관리자 승인 후 가입
		$__mem_conf = $dbo->fetch("SELECT * FROM RT_RTMEMBER_CONFIG");
		$__mem_conf_is = ($__mem_conf['mb_approval_en'] == "y") ? true : false;

		//회원 통계
		$member_total_cnt = $dbo->rows_count("SELECT * FROM RT_RTMEMBER WHERE blockout_en != 'y'");
		$member_today_cnt = $dbo->rows_count("SELECT * FROM RT_RTMEMBER WHERE reg_date LIKE '".date("Y-m-d")."%'");
		$member_month_cnt = $dbo->rows_count("SELECT * FROM RT_RTMEMBER WHERE reg_date LIKE '".date("Y-m")."%'");
		$member_today_login = $dbo->rows_count("SELECT * FROM RT_RTMEMBER WHERE login_date LIKE '".date("Y-m-d")."%'");

		//전체 게시판 목록
		$bbs_list = $dbo->fetch_list("SELECT * FROM RT_RTBOARD AS b LEFT JOIN RT_RTBOARD_GROUP AS bg ON (b.gseq=bg.grp_seq) WHERE b.state='on' ORDER BY bg.grp_ord ASC, b.name ASC");

		//최근 게시판 데이터
		for ($m = 0; $m < count($bbs_list); $m++) {
			$bbs_data[$m] = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_".strtoupper($bbs_list[$m]['theme'])." WHERE bcode='".$bbs_list[$m]['bcode']."' ORDER BY reg_date ASC LIMIT 4");
		}

		//최근 댓글 데이터
		$cmt_data = $dbo->fetch_list("SELECT cmt.*,rtb.theme FROM RT_RTBOARD_CMT AS cmt LEFT JOIN RT_RTBOARD AS rtb ON (cmt.bcode=rtb.bcode) WHERE rtb.state='on' ORDER BY cmt.reg_date DESC LIMIT 6");

	break;
}
?>