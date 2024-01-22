<?php
//-------------------------------------------------------------------------------------------------
/**
 * 콘텐츠 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }


//네비게이션 데이터
$__cfg = array();
$__cfg['nav'][0] = "콘텐츠 그룹 관리";

$__cf = ($env->_get['cf']) ? $env->_get['cf'] : "group";

switch ($__cf)
{
	case "group"	:

		$__cfg['nav'][1] = "그룹 목록";

		$_list = $dbo->fetch_list("SELECT * FROM RT_CONTENT_GROUP ORDER BY grp_ord ASC");

	break;

	case "form"	:

		$_r = $dbo->fetch("SELECT * FROM RT_CONTENT_GROUP WHERE grp_seq='".$env->_get['grp_seq']."'");

		$__cfg['nav'][1] = "정보 수정";
		$__cfg['mode'] = "modify";
	break;
}
?>