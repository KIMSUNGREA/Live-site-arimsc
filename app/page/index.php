<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 가상 페이지 설정
//-----------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

//-----------------------------------------------------------------------------------------
// 레이아웃 스킨 설정
//-----------------------------------------------------------------------------------------

$layout_path = RT_DOC_ROOT.$_rt_page['app_path']."/layout";

//이동할 페이지와 모바일/PC 매칭 설정값이 다를 경우 강제 포워딩
if ($reg_screen == "pc") {
	if ($cls_pg->conn_screen == "mobile" && $cls_pg->d['mobile_is'] == "y") {
		rt_js_move("", "self", "href", $_rt_page['app_path']."/?pcd=".$cls_pg->d['pcode']."&screen=mobile");exit;
	}
}
if ($reg_screen == "mobile") {
	if ($cls_pg->conn_screen == "pc" || $cls_pg->d['mobile_is'] == "n") {
		rt_js_move("", "self", "href", $_rt_page['app_path']."/?pcd=".$cls_pg->d['pcode']);exit;
	}
}

if ($cls_pg->conn_screen == "mobile") {

	require_once RT_DOC_ROOT.$_rt_page['app_path']."/page_m_conf.php";

	$path_head = $layout_path."/".$cls_pg->d['layout_skin_head_m'];
	$path_tail = $layout_path."/".$cls_pg->d['layout_skin_footer_m'];

} else {

	require_once RT_DOC_ROOT.$_rt_page['app_path']."/page_conf.php";

	$path_head = $layout_path."/".$cls_pg->d['layout_skin_head'];
	$path_tail = $layout_path."/".$cls_pg->d['layout_skin_footer'];
}

//----------------------------------------------------------------------------------------------

/*
 * 레이아웃 스킨 출력
 */

$_v_1 = ($cls_pg->conn_screen == "mobile") ? "_m" : "";
$_v_2 = ($cls_pg->conn_screen == "mobile") ? "m_" : "";

require_once $path_head;

if ($cls_pg->d['cont_type_'.$_v_2.'en'] == "img") {

	$__file_path = RT_DOC_ROOT.$_rt_page['app_path']."/upload/".$cls_pg->d['cont_img'.$_v_1];
	if (is_file($__file_path)) {
	?><img src="<?php echo $_rt_page['app_path']."/upload/".$cls_pg->d['cont_img'.$_v_1];?>" /><?
	}

} else if ($cls_pg->d['cont_type_'.$_v_2.'en'] == "html") {

	echo rt_dbstr_decode($cls_pg->d['cont_html'.$_v_1]);

} else if ($cls_pg->d['cont_type_'.$_v_2.'en'] == "member") {

	if (!empty($cls_pg->d['member_code'])) rt_app("rtmember","display",array($cls_pg->d['member_code'.$_v_1]));

} else if ($cls_pg->d['cont_type_'.$_v_2.'en'] == "board") {

	if (!empty($cls_pg->d['board_code'])) rt_app("rtboard","display",array($cls_pg->d['board_code'.$_v_1]));
}

require_once $path_tail;
//----------------------------------------------------------------------------------------------
?>