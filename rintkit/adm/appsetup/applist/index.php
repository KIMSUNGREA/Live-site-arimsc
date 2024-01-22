<?php
//-------------------------------------------------------------------------------------------------
/*
 * 어플리케이션 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }


//네비게이션 데이터
$__cfg = array();
$__cfg['nav'][0] = "APP 관리";

switch ($__cf) {

	case "list"	:

		$__cfg['nav'][1] = "APP 목록";

		$_list = $dbo->fetch_list("SELECT * FROM RT_APP ORDER BY app_seq DESC");
	break;

	case "form"	:

		$_r = $dbo->fetch("SELECT * FROM RT_APP WHERE app_seq='".$env->_get['app_seq']."'");

		//정보 입력 구분 설정
		if ($_r['app_seq']) {

			$__cfg['nav'][1] = "정보 수정";
			$__cfg['mode'] = "modify";

			${"app_plug_en_".$_r['app_plug_en']} = "checked='checked'";

		} else {

			$__cfg['nav'][1] = "추가 입력";
			$__cfg['mode'] = "insert";

			$app_plug_en_off = "checked='checked'";
		}
	break;
}
?>