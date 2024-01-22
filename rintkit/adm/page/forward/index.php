<?php
//-------------------------------------------------------------------------------------------------
/*
 * 포워딩 규칙 설정
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }


//네비게이션 데이터
$__cfg = array();
$__cfg['nav'][0] = "페이지 관리";


//환경설정 데이터
$_r = $dbo->fetch("SELECT * FROM RT_PAGE_CONF");

switch ($__cf)
{
	case "forward":
		$__cfg['nav'][1] = "유입자 화면이동 규칙";

		$szfw = unserialize(html_entity_decode($_r['screen_forward']));
		$szld = unserialize(html_entity_decode($_r['screen_forward_landing']));

		for ($m = 1; $m <= 12; $m++) {
			${'fw'.$m.'_o_selected'} = ($szfw['fw'.$m] == "o")?"selected":"";
			${'fw'.$m.'_x_selected'} = ($szfw['fw'.$m] == "x")?"selected":"";

			${'ld'.$m.'_pc_selected'} = ($szld['ld'.$m] == "pc")?"selected":"";
			${'ld'.$m.'_mobile_selected'} = ($szld['ld'.$m] == "mobile")?"selected":"";
		}

	break;
}

$__sub_title = "y";
$__cfg['page'] = $__cfg['nav'][0]." <span style='color:#999999;'> | ".$__cfg['nav'][1]."</span>";
?>