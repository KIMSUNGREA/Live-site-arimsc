<?php
//-------------------------------------------------------------------------------------------------
/**
 * 팝업 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }


//네비게이션 데이터
$__cfg = array();
$__cfg['nav'][0] = "팝업 관리";

switch ($__cf) {

	case "list"	:

		$__cfg['nav'][1] = "팝업 목록";

		$_list = $dbo->fetch_list("SELECT * FROM RT_POPUP ORDER BY seq DESC");

	break;

	case "form"	:

		$_r = $dbo->fetch("SELECT * FROM RT_POPUP WHERE seq='".$env->_get['seq']."'");
		$formtpl_arr = $dbo->fetch_list("SELECT * FROM RT_POPUP_FORM_TPL ORDER BY ord ASC");

		//정보 입력 구분 설정
		if ($_r['seq']) {

			$__cfg['nav'][1] = "팝업 수정";
			$__cfg['mode'] = "modify";

			$_r['content_html'] = stripslashes($_r['content_html']);

		} else {

			$__cfg['nav'][1] = "팝업 등록";
			$__cfg['mode'] = "insert";

			$_r['pos_x'] = 0;
			$_r['pos_y'] = 0;
		}
	break;

	case "source";

		$__cfg['nav'][1] = "팝업 소스";

	break;
}
?>