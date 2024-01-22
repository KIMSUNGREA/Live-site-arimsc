<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩			: UTF-8
// 설명			: PC / 모바일간 강제 포워딩 설정
//-----------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

//----------------------------------------------------------------------------------------------

// 포워딩 방향 설정
$fwd = $env->_get['fwd'];

// 화면 고정 세션 설정
$_SESSION['RT_SCREEN_VIEW'] = (empty($fwd)) ? "pc" : $fwd;


// 요청 URL을 배열 데이터로 변환
$url_arr = rt_url2arr($env->_get['data']);

// 인덱스 구분 페이지
$_index_type = array("/","/index.php","/index.htm","/index.html",$_rt_page_conf['mobile_path']."/",$_rt_page_conf['mobile_path']."/index.php",$_rt_page_conf['mobile_path']."/index.htm",$_rt_page_conf['mobile_path']."/index.html");

// PC -> 모바일로 가는 경우
if ($fwd == "mobile") {

	//인덱스 페이지는 별도 처리
	if (in_array($url_arr['url']['page'],$_index_type)) {
		if ($_rt_page_conf['mobile_path']) {
			rt_js_move("", "parent", "href", $_rt_page_conf['mobile_path']);exit;
		} else {
			$_SESSION['RT_SCREEN_VIEW'] = "pc";
			rt_js_msg("이 페이지는 모바일 페이지가 없습니다.");exit;
		}
	}
	
	//현재 페이지 정보 추출하여 이동할 페이지 정보를 가져옴
	if (empty($url_arr['arg']['pcd'])) {
		//직접 제작된 페이지인 경우
		$_r = $dbo->fetch("SELECT * FROM ".$cls_pg->tbl." WHERE page_url='".$url_arr['url']['page']."'");
	} else {
		//가상 페이지인 경우
		$_r = $dbo->fetch("SELECT * FROM ".$cls_pg->tbl." WHERE pcode='".$url_arr['arg']['pcd']."'");
	}

	if ($_r['mobile_is'] == "y") {

		//이동할 페이지가 직접 제작 페이지인 경우
		if ($_r['page_setting_en'] == "custom") {
			rt_js_move("", "parent", "href", $_r['page_url_m']);exit;
		}

		//이동할 페이지가 가상 페이지인 경우
		if ($_r['page_setting_en'] == "auto") {
			rt_js_move("", "parent", "href", $_rt_page['app_path']."/?pcd=".$_r['pcode']."&screen=mobile");exit;
		}

	} else {
		$_SESSION['RT_SCREEN_VIEW'] = "pc";
		rt_js_msg("이 페이지는 모바일 페이지가 없습니다.");exit;
	}

// 모바일 -> PC로 가는 경우
} else if ($fwd == "pc") {

	//인덱스 페이지는 별도 처리
	if (in_array($url_arr['url']['page'],$_index_type)) {
		rt_js_move("", "parent", "href", "/");exit;
	}

	//현재 페이지 정보 추출하여 이동할 페이지 정보를 가져옴
	if (empty($url_arr['arg']['pcd'])) {
		//직접 제작된 페이지인 경우
		$_r = $dbo->fetch("SELECT * FROM ".$cls_pg->tbl." WHERE page_url_m='".$url_arr['url']['page']."'");
	} else {
		//가상 페이지인 경우
		$_r = $dbo->fetch("SELECT * FROM ".$cls_pg->tbl." WHERE pcode='".$url_arr['arg']['pcd']."'");
	}

	//이동할 페이지가 직접 제작 페이지인 경우
	if ($_r['page_setting_en'] == "custom") {
		rt_js_move("", "parent", "href", $_r['page_url']);exit;
	}

	//이동할 페이지가 가상 페이지인 경우
	if ($_r['page_setting_en'] == "auto") {
		rt_js_move("", "parent", "href", $_rt_page['app_path']."/?pcd=".$_r['pcode']);exit;
	}

	//입력된 페이지URL 정보가 없을 경우 메인으로 이동
	rt_js_move("", "parent", "href", "/");exit;
}

//----------------------------------------------------------------------------------------------
?>