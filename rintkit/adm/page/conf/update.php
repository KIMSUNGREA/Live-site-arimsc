<?php
//-------------------------------------------------------------------------------------------------
/*
 * 페이지 관리 - 공통환경설정 - 업데이트
 * 
 * $env->_post['mode'] 데이터 처리 구분
 */
//-------------------------------------------------------------------------------------------------

require_once "../../engine.php";

//-------------------------------------------------------------------------------------------------

/**
 * 업로드 경로 설정
 */

$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='page'");
$upload_path = $_app['app_path']."/upload";

//-------------------------------------------------------------------------------------------------

/**
 * 업로드 콤포넌트 설정
 */

rt_load_component("fileupload");
$cls_F = new fileupload($upload_path);

//-------------------------------------------------------------------------------------------------

$data = array();//DB 필드데이터

if ($env->_post['mode'] == "modify") {

	$udata['meta_title'		] = $env->_post['meta_title'];
	$udata['meta_desc'		] = $env->_post['meta_desc'];
	$udata['meta_keyword'	] = $env->_post['meta_keyword'];
	$udata['meta_main_img'	] = $env->_post['meta_main_img'];
	$udata['meta_naver'		] = $env->_post['meta_naver'];
	$udata['mobile_path'	] = $env->_post['mobile_path'];
	$udata['common_data1'	] = $env->_post['common_data1'];
	$udata['common_data2'	] = $env->_post['common_data2'];
	$udata['common_data3'	] = $env->_post['common_data3'];
	$udata['common_data4'	] = $env->_post['common_data4'];
	$udata['common_data5'	] = $env->_post['common_data5'];

	if (!empty($env->_files['favicon']['name'])) {
		$ar_info = $cls_F->upload($env->_files['favicon']);
		$udata['shortcut_icon'] = $ar_info['name_new'];
	}

	if ($dbo->update("RT_PAGE_CONF", $udata, "")) {
		rt_js_move("정보가 변경되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_get['mode'] == "icondel")
{
	$_r = $dbo->fetch("SELECT * FROM RT_PAGE_CONF");

	$udata['shortcut_icon'] = "";

	if ($dbo->update("RT_PAGE_CONF", $udata, "")) {

		$cls_F->delete_file($_r['shortcut_icon']);

		rt_js_move("파비콘이 삭제되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
exit;
?>