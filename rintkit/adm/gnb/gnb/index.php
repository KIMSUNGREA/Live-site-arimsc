<?php
//-------------------------------------------------------------------------------------------------
/*
 * GNB 메뉴 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }


//네비게이션 데이터
$__cfg = array();
$__cfg['nav'][0] = "관리자 상단 메뉴 설정";

switch ($__cf) {

	case "gnb"	:

		$__cfg['nav'][1] = "상단 메뉴 목록";

		$_list = $dbo->fetch_list("SELECT * FROM RT_GNB ORDER BY ord ASC");
	break;

	case "form"	:

		$_r = $dbo->fetch("SELECT * FROM RT_GNB WHERE seq='".$env->_get['seq']."'");

		$__cfg['nav'][1] = "정보 수정";
		$__cfg['mode'] = "modify";

		//라디오&체크&셀렉트 박스 설정
		${"link_target".$_r['link_target_en']} = "checked";
		${"menu_auth_".$_r['menu_auth_en']} = "checked";
		${"menu_".$_r['menu_en']} = "checked";
	break;
}
?>