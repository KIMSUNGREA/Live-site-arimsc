<?php
//-------------------------------------------------------------------------------------------------

/**
 * 레이아웃 / 테마 : 데이터 세팅
 */

//LNB 메인 메뉴 활성화 여부
if ($__dr == "app") {
	${"__lnb_app_".$env->_get['appcode']."_on"} = "active";
} else {
	//환경설정메뉴(디렉토리로 인증)
	$__apply_confs = array("company","source","ipset","gnb","config");
	if (in_array($__dr, $__apply_confs)) {
		$__lnb_confs_on = "active";
	} else {
		${"__lnb_".$__dr."_on"} = "active";
	}
}

//LNB 서브 메뉴 활성화 여부
if ($__dr == "app") {
	$lnb_sd = str_replace("-","_",$env->_get['sd']);
	if (empty($env->_get['cf'])) {
		${"__lnb_app_".$env->_get['appcode']."_".$lnb_sd."_on"} = "active";
	} else {
		${"__lnb_app_".$env->_get['appcode']."_".$lnb_sd."_".$env->_get['cf']."_on"} = "active";
	}
} else {
	if (empty($__cf)) {
		${"__lnb_".$__dr."_".$__dr."_on"} = "active";
	} else {
		${"__lnb_".$__dr."_".$__cf."_on"} = "active";
	}
}

//-------------------------------------------------------------------------------------------------

/**
 * 상단 메뉴 출력 설정
 */

if ($cls_adm->auth_code == "master") {
	$__topmenu = $dbo->fetch_list("SELECT * FROM RT_GNB WHERE menu_en='y' ORDER BY ord ASC");
} else {
	$__topmenu = $dbo->fetch_list("SELECT * FROM RT_GNB WHERE menu_en='y' AND menu_auth_en='".$cls_adm->auth_code."' ORDER BY ord ASC");
}

//-------------------------------------------------------------------------------------------------

/**
 * 좌단 메뉴 출력 데이터 설정
 */

//게시판 리스트
$__left_board = $dbo->fetch_list("SELECT * FROM RT_RTBOARD AS b LEFT JOIN RT_RTBOARD_GROUP AS bg ON (b.gseq=bg.grp_seq) WHERE b.state='on' ORDER BY bg.grp_ord ASC, b.name ASC");

//-------------------------------------------------------------------------------------------------

/**
 * 레이아웃 / 테마 : 스킨 세팅 및 출력
 */

//공동 상단 스킨
require_once RT_ADM."/layout/adm.head.php";

//본문 스킨 설정
if ($__app_admin == "y") {

	$app_admin_path = RT_DOC_ROOT."/".$_app['app_path']."/".$__sd."/".$_def['func'].".php";
	$app_admin_path = str_replace("//", "/", $app_admin_path);
	if (is_file($app_admin_path) === TRUE) {
		require_once $app_admin_path;
	} else {
		
		require_once RT_LAYOUT."/error.php";
	}

} else {

	if (!empty($__dr) && !empty($__sc) && !empty($__cf)) {

		$layout_path = RT_ADM."/".$__dr."/".$__sc."/".$__cf.".php";
		if (is_file($layout_path) === TRUE) {
			require_once $layout_path;
		} else {
			require_once RT_LAYOUT."/error.php";
		}

	} else {
		require_once RT_LAYOUT."/error.php";
	}
}

//공동 하단 스킨
require_once RT_ADM."/layout/adm.tail.php";
//-------------------------------------------------------------------------------------------------
?>