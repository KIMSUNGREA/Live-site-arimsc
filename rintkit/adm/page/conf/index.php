<?php
//-------------------------------------------------------------------------------------------------
/*
 * 페이지 관리 - 공통환경설정
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

//페이지 APP 환경정보
$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='page'");

//네비게이션 데이터
$__cfg = array();
$__cfg['nav'][0] = "페이지 관리";

switch ($__cf)
{
	case "conf":

		$__cfg['nav'][1] = "공통 환경 설정";

		$upload_path = $_app['app_path']."/upload";

		$_r = $dbo->fetch("SELECT * FROM RT_PAGE_CONF");

		foreach ($_r as $k => $v) {
			if ($k == "meta_naver") {
				$_r[$k] = rt_dbstr_decode($v,"html");
			} else {
				$_r[$k] = rt_dbstr_decode($v);
			}
		}

	break;
}

$__sub_title = "y";
$__cfg['page'] = $__cfg['nav'][0]." <span style='color:#999999;'> | ".$__cfg['nav'][1]."</span>";
?>