<?php
//-------------------------------------------------------------------------------------------------
/*
 * 외부 소스 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }


//네비게이션 데이터
$__cfg = array();
$__cfg['nav'][0] = "외부 소스 관리";

switch ($__cf) {

	case "source"	:

		$__cfg['nav'][1] = "소스 목록";

		$_list = $dbo->fetch_list("SELECT * FROM RT_SOURCE ORDER BY seq DESC");
	break;

	case "form"	:

		$_r = $dbo->fetch("SELECT * FROM RT_SOURCE WHERE seq='".$env->_get['seq']."'");

		$__cfg['nav'][1] = "소스 수정";
		$__cfg['mode'] = "modify";

		//라디오&체크&셀렉트 박스 설정
		${"use_en_".$_r['use_en']} = "checked";
	break;
}
?>