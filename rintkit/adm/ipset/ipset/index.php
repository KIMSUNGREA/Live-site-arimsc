<?php
//-------------------------------------------------------------------------------------------------
/*
 * IP 설정
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }


//네비게이션 데이터
$__cfg = array();
$__cfg['nav'][0] = "관리자 접근제한";

if ($rt_conf_db['ip_set_type'] == "D") {
	$__cf = "list_deny";
} else if ($rt_conf_db['ip_set_type'] == "P") {
	$__cf = "list_permit";
} else {
	$__cf = "list";
}

switch ($__cf)
{
	case "list_deny":
		$__cfg['nav'][1] = "IP 차단";
		$_list = $dbo->fetch_list("SELECT * FROM RT_IP_SET WHERE part='deny'");
	break;

	case "list_permit":
		$__cfg['nav'][1] = "IP 허용";
		$_list = $dbo->fetch_list("SELECT * FROM RT_IP_SET WHERE part='permit'");
	break;

	case "list":
		$__cfg['nav'][1] = "제한안함";
	break;
}

$__sub_title = "y";
$__cfg['page'] = $__cfg['nav'][0]." <span style='color:#999999;'> | ".$__cfg['nav'][1]."</span>";
?>