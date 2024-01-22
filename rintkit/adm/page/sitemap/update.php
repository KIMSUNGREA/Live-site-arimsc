<?php
//-------------------------------------------------------------------------------------------------
/*
 * 페이지 정보 업데이트
 * 
 * $env->_post['mode'] 데이터 처리 구분
 * 
 * ins1depth : 1차 카테고리 추가
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
/**
 * 분류 콤포넌트 로드
 */

rt_load_component("category");
$cls_ct = new category("PAGE");

//-------------------------------------------------------------------------------------------------

$data = array();//DB 필드데이터

if ($env->_post['mode'] == "page_ins_1depth") {

	//페이지 코드 중복 검사
	$_t = $dbo->fetch("SELECT code FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['new_code']."'");

	if (!empty($_t['code'])) {
		rt_js_msg("페이지코드가 중복되었습니다. 다시 입력해 주세요.");exit;
	}

	//추가되는 페이지는 마지막 순서로 세팅
	$_r = $dbo->fetch("SELECT MAX(sort)+1 AS nxsort FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND parent=0");

	//입력 데이터 세팅
	$cls_ct->setRecord($env->_post['label'], 0, $_r['nxsort'], $env->_post['new_code']);

	if ($cls_ct->dbInsert()) {

		//페이지 추가
		$_chk = $dbo->fetch("SELECT * FROM RT_PAGE WHERE pcode='".$env->_post['new_code']."'");
		if (empty($_chk['pcode'])) {
			$idata['pcode'] = $env->_post['new_code'];
			$dbo->insert("RT_PAGE", $idata);
		}
		rt_js_move("페이지가 추가되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_post['mode'] == "page_insert") {

	//페이지 코드 중복 검사
	$_t = $dbo->fetch("SELECT code FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['new_code']."'");

	if (!empty($_t['code'])) {
		rt_js_msg("페이지코드가 중복되었습니다. 다시 입력해 주세요.");exit;
	}

	//추가되는 페이지는 마지막 순서로 세팅
	$_r = $dbo->fetch("SELECT MAX(sort)+1 AS nxsort FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND parent='".$env->_post['parent']."'");

	//입력 데이터 세팅
	$cls_ct->setRecord($env->_post['label'], $env->_post['parent'], $_r['nxsort'], $env->_post['new_code']);

	if ($cls_ct->dbInsert()) {

		//페이지 추가
		$_chk = $dbo->fetch("SELECT * FROM RT_PAGE WHERE pcode='".$env->_post['new_code']."'");
		if (empty($_chk['pcode'])) {
			$idata['pcode'] = $env->_post['new_code'];
			$dbo->insert("RT_PAGE", $idata);
		}
		rt_js_move("페이지가 추가되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_post['mode'] == "page_modify") {

	$_r = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['code']."'");

	//수정 데이터 세팅
	$cls_ct->setRecord($env->_post['label'], $_r['parent'], $_r['sort'], $env->_post['code']);

	if ($cls_ct->dbUpdate()) {

		//순서 변경 선택 시 처리
		if (!empty($env->_post['chg_sort'])) {

			$_t = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND parent='".$_r['parent']."' AND sort='".$env->_post['chg_sort']."'");
			
			$udata['sort'] = $_r['sort'];
			if (!$dbo->update($cls_ct->db_tbl, $udata, "groupcode='".$cls_ct->groupcode."' AND code='".$_t['code']."'")) {
				rt_js_msg("시스템문제로 등록되지 않았습니다.");exit;
			}

			$udata['sort'] = $_t['sort'];
			if (!$dbo->update($cls_ct->db_tbl, $udata, "groupcode='".$cls_ct->groupcode."' AND code='".$_r['code']."'")) {
				rt_js_msg("시스템문제로 등록되지 않았습니다.");exit;
			}
		}
		rt_js_move("페이지 정보가 수정되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_get['mode'] == "page_delete") {

	//현재 페이지 정보
	$_t = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_get['code']."'");

	//하위 페이지가 있으면 삭제 불가
	$_r = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND parent='".$_t['code']."' LIMIT 1");

	if (!empty($_r['code'])) {
		rt_js_msg("하위 페이지가 있으면 삭제할 수 없습니다.");exit;
	}

	if ($dbo->query("DELETE FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_get['code']."' LIMIT 1")) {

		//페이지 데이터 삭제
		$dbo->query("DELETE FROM RT_PAGE WHERE pcode='".$env->_get['code']."'");

		//레코드 순서 재정렬
		$cls_ct->dbSortReset($_t['parent'], $cls_ct->groupcode);

		rt_js_move("페이지가 삭제되었습니다.", "parent", "href", "../?sd=sitemap");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_post['mode'] == "page") {

	$udata['use_is'					] = $env->_post['use_is'];
	$udata['mobile_is'				] = $env->_post['mobile_is'];
	$udata['page_setting_en'		] = $env->_post['page_setting_en'];
	$udata['page_url'				] = $env->_post['page_url'];
	$udata['page_url_m'				] = $env->_post['page_url_m'];
	$udata['forward_is'				] = $env->_post['forward_is'];
	$udata['forward_type_en'		] = $env->_post['forward_type_en'];
	$udata['forward_url'			] = $env->_post['forward_url'];
	$udata['forward_page'			] = $env->_post['forward_page'];

	if ($dbo->update("RT_PAGE", $udata, "pcode='".$env->_post['code']."'")) {
		rt_js_move("페이지 정보가 변경되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_post['mode'] == "content") {

	$r = $dbo->fetch("SELECT * FROM RT_PAGE WHERE pcode='".$env->_post['code']."'");

	//콘텐츠 이미지 삭제
	if ($env->_post['cont_img_del_is'] == "y") {
		if ($r['cont_img']) {
			rt_file_delete($_app['app_path']."/upload/".$r['cont_img']);
			$dbo->query("UPDATE RT_PAGE SET cont_img='' WHERE pcode='".$env->_post['code']."'");
		}
	}

	$udata['layout_skin_head'		] = $env->_post['layout_skin_head'];
	$udata['layout_skin_footer'		] = $env->_post['layout_skin_footer'];
	$udata['cont_type_en'			] = $env->_post['cont_type_en'];
	$udata['cont_html'				] = $env->_post['cont_html'];
	$udata['board_code'				] = $env->_post['board_code'];
	$udata['member_code'			] = $env->_post['member_code'];

	if (!empty($env->_files['cont_img']['name'])) {
		$ar_info = $cls_F->upload($env->_files['cont_img']);
		$udata['cont_img'] = $ar_info['name_new'];
	}

	if ($dbo->update("RT_PAGE", $udata, "pcode='".$env->_post['code']."'")) {
		rt_js_move("페이지 정보가 변경되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_post['mode'] == "content_m") {

	$r = $dbo->fetch("SELECT * FROM RT_PAGE WHERE pcode='".$env->_post['code']."'");

	//콘텐츠 이미지 삭제
	if ($env->_post['cont_img_m_del_is'] == "y") {
		if ($r['cont_img_m']) {
			rt_file_delete($_app['app_path']."/upload/".$r['cont_img_m']);
			$dbo->query("UPDATE RT_PAGE SET cont_img_m='' WHERE pcode='".$env->_post['code']."'");
		}
	}

	$udata['layout_skin_head_m'		] = $env->_post['layout_skin_head_m'];
	$udata['layout_skin_footer_m'	] = $env->_post['layout_skin_footer_m'];
	$udata['cont_type_m_en'			] = $env->_post['cont_type_m_en'];
	$udata['cont_html_m'			] = $env->_post['cont_html_m'];
	$udata['board_code_m'			] = $env->_post['board_code_m'];
	$udata['member_code_m'			] = $env->_post['member_code_m'];

	if (!empty($env->_files['cont_img_m']['name'])) {
		$ar_info = $cls_F->upload($env->_files['cont_img_m']);
		$udata['cont_img_m'] = $ar_info['name_new'];
	}

	if ($dbo->update("RT_PAGE", $udata, "pcode='".$env->_post['code']."'")) {
		rt_js_move("페이지 정보가 변경되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_post['mode'] == "userdata") {

	$udata['user_data1'] = $env->_post['user_data1'];
	$udata['user_data2'] = $env->_post['user_data2'];
	$udata['user_data3'] = $env->_post['user_data3'];
	$udata['user_data4'] = $env->_post['user_data4'];
	$udata['user_data5'] = $env->_post['user_data5'];

	if ($dbo->update("RT_PAGE", $udata, "pcode='".$env->_post['code']."'")) {
		rt_js_move("페이지 정보가 변경되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_post['mode'] == "meta") {

	$udata['meta_common_is'			] = $env->_post['meta_common_is'];
	$udata['meta_title'				] = $env->_post['meta_title'];
	$udata['meta_desc'				] = $env->_post['meta_desc'];
	$udata['meta_keyword'			] = $env->_post['meta_keyword'];
	$udata['meta_main_img'			] = $env->_post['meta_main_img'];

	if ($dbo->update("RT_PAGE", $udata, "pcode='".$env->_post['code']."'")) {
		rt_js_move("페이지 정보가 변경되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_post['mode'] == "page_move") {

	$_r = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['code']."'");

	//수정 데이터 세팅
	$cls_ct->setRecord($_r['label'], $_r['parent'], $_r['sort'], $env->_post['code']);

	if ($cls_ct->dbUpdate()) {

		//순서 변경 선택 시 처리
		if (!empty($env->_post['chg_sort'])) {

			$_t = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND parent='".$_r['parent']."' AND sort='".$env->_post['chg_sort']."'");
			
			$udata['sort'] = $_r['sort'];
			if (!$dbo->update($cls_ct->db_tbl, $udata, "groupcode='".$cls_ct->groupcode."' AND code='".$_t['code']."'")) {
				rt_js_msg("시스템문제로 등록되지 않았습니다.");exit;
			}

			$udata['sort'] = $_t['sort'];
			if (!$dbo->update($cls_ct->db_tbl, $udata, "groupcode='".$cls_ct->groupcode."' AND code='".$_r['code']."'")) {
				rt_js_msg("시스템문제로 등록되지 않았습니다.");exit;
			}
		}
		rt_js_move("페이지 정보가 수정되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_post['mode'] == "get_skin") {

	$skin_path = "./inc/".$env->_post['skin'].".php";
	if (is_file($skin_path)) {
		require_once "inc/".$env->_post['skin'].".php";
	} else {
		require_once "inc/404.php";
	}
}
exit;
?>