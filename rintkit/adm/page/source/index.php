<?php
//-------------------------------------------------------------------------------------------------
/*
 * 화면고정 링크소스
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }


//네비게이션 데이터
$__cfg = array();
$__cfg['nav'][0] = "페이지 관리";


//환경설정 데이터
$_r = $dbo->fetch("SELECT * FROM RT_CONFIG");

switch ($__cf)
{
	case "source":
		$__cfg['nav'][1] = "화면고정 링크소스";
	break;
}

$__sub_title = "y";
$__cfg['page'] = $__cfg['nav'][0]." <span style='color:#999999;'> | ".$__cfg['nav'][1]."</span>";
?>