<?php
//-------------------------------------------------------------------------------------------------
/**
 * 콘텐츠 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }


//네비게이션 데이터
$__cfg = array();
$__cfg['nav'][0] = "콘텐츠 관리";

$__cf = ($env->_get['cf']) ? $env->_get['cf'] : "content";

//그룹 명
$grp = $dbo->fetch_list("SELECT * FROM RT_CONTENT_GROUP ORDER BY grp_ord ASC");
for ($m = 0; $m < count($grp); $m++) {
	$grp_cfg[$grp[$m]['grp_seq']] = $grp[$m]['grp_name'];
}

switch ($__cf) {

	case "content"	:

		$__cfg['nav'][1] = "콘텐츠 목록";

		$_list = $dbo->fetch_list("SELECT * FROM RT_CONTENT AS b LEFT JOIN RT_CONTENT_GROUP AS bg ON (b.grp_seq=bg.grp_seq) ORDER BY bg.grp_ord ASC, b.seq ASC");

	break;

	case "form"	:

		$_r = $dbo->fetch("SELECT * FROM RT_CONTENT WHERE seq='".$env->_get['seq']."'");

		//정보 입력 구분 설정
		if ($_r['seq']) {

			$__cfg['nav'][1] = "콘텐츠 수정";
			$__cfg['mode'] = "modify";

			${"login_is_".$_r['login_is']} = "checked='checked'";
			${"login_is_class_".$_r['login_is']} = "class='check'";

			${"link_is_".$_r['link_is']} = "checked='checked'";
			${"link_is_class_".$_r['link_is']} = "class='check'";

		} else {

			$__cfg['nav'][1] = "콘텐츠 등록";
			$__cfg['mode'] = "insert";

			$login_is_n = "checked='checked'";
			$login_is_class_n = "class='check'";

			$link_is_n = "checked='checked'";
			$link_is_class_n = "class='check'";
		}
	break;
}
?>