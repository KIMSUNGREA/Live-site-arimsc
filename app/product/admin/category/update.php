<?php
//-------------------------------------------------------------------------------------------------
/*
 * 분류 정보 업데이트
 * 
 * $env->_post['mode'] 데이터 처리 구분
 * 
 * ins1depth : 1차 카테고리 추가
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ADM."/engine.php";

//-------------------------------------------------------------------------------------------------

/**
 * 업로드 경로 설정
 */

$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='product'");
$upload_path = $_app['app_path']."/files";

//-------------------------------------------------------------------------------------------------

/**
 * 업로드 콤포넌트 설정
 */

rt_load_component("fileupload");
$cls_fu = new fileupload($upload_path);

//-------------------------------------------------------------------------------------------------
/**
 * 분류 콤포넌트 로드
 */

rt_load_component("category");
$cls_ct = new category("PRODUCT");

//-------------------------------------------------------------------------------------------------

$data = array();//DB 필드데이터

if ($env->_post['mode'] == "category_ins_1depth") {

	//분류 코드 중복 검사
	$_t = $dbo->fetch("SELECT code FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['new_code']."'");

	if (!empty($_t['code'])) {
		rt_js_msg("분류 코드가 중복되었습니다. 다시 입력해 주세요.");exit;
	}

	//추가되는 분류는 마지막 순서로 세팅
	$_r = $dbo->fetch("SELECT MAX(sort)+1 AS nxsort FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND parent=0");

	//입력 데이터 세팅
	$cls_ct->setRecord($env->_post['label'], 0, $_r['nxsort'], $env->_post['new_code']);

	if ($cls_ct->dbInsert()) {

		//분류 환경 추가
		$_chk = $dbo->fetch("SELECT * FROM RT_PRODUCT_CATE_CONF WHERE code='".$env->_post['new_code']."'");
		if (empty($_chk['code'])) {
			$idata['code'] = $env->_post['new_code'];
			$idata['auth_list'] = 'a:2:{i:0;s:1:"0";i:1;s:1:"1";}';
			$idata['auth_read'] = 'a:2:{i:0;s:1:"0";i:1;s:1:"1";}';
			$dbo->insert("RT_PRODUCT_CATE_CONF", $idata);
		}
		rt_js_move("분류가 추가되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_post['mode'] == "category_insert") {

	//분류 코드 중복 검사
	$_t = $dbo->fetch("SELECT code FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['new_code']."'");

	if (!empty($_t['code'])) {
		rt_js_msg("분류코드가 중복되었습니다. 다시 입력해 주세요.");exit;
	}

	//추가되는 분류는 마지막 순서로 세팅
	$_r = $dbo->fetch("SELECT MAX(sort)+1 AS nxsort FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND parent='".$env->_post['parent']."'");

	//입력 데이터 세팅
	$cls_ct->setRecord($env->_post['label'], $env->_post['parent'], $_r['nxsort'], $env->_post['new_code']);

	if ($cls_ct->dbInsert()) {

		//분류 환경 추가
		$_chk = $dbo->fetch("SELECT * FROM RT_PRODUCT_CATE_CONF WHERE code='".$env->_post['new_code']."'");
		if (empty($_chk['code'])) {
			$idata['code'] = $env->_post['new_code'];
			$idata['auth_list'] = 'a:2:{i:0;s:1:"0";i:1;s:1:"1";}';
			$idata['auth_read'] = 'a:2:{i:0;s:1:"0";i:1;s:1:"1";}';
			$dbo->insert("RT_PRODUCT_CATE_CONF", $idata);
		}
		rt_js_move("분류가 추가되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_post['mode'] == "category_modify") {

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
		rt_js_move("분류 정보가 수정되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_get['mode'] == "category_delete") {

	//현재 분류 정보
	$_t = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_get['code']."'");

	//하위 분류가 있으면 삭제 불가
	$_r = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND parent='".$_t['code']."' LIMIT 1");

	if (!empty($_r['code'])) {
		rt_js_msg("하위 분류가 있으면 삭제할 수 없습니다.");exit;
	}

	if ($dbo->query("DELETE FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_get['code']."' LIMIT 1")) {

		//분류 환경 데이터 삭제
		$dbo->query("DELETE FROM RT_PRODUCT_CATE_CONF WHERE code='".$env->_get['code']."'");

		//레코드 순서 재정렬
		$cls_ct->dbSortReset($_t['parent'], $cls_ct->groupcode);

		rt_js_move("분류가 삭제되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_post['mode'] == "category_conf") {

	$r = $dbo->fetch("SELECT * FROM RT_PRODUCT_CATE_CONF WHERE code='".$env->_post['code']."'");

	$udata['use_is'		] = $env->_post['use_is'];
	$udata['type_en'	] = $env->_post['type_en'];
	$udata['cont_html'	] = $env->_post['cont_html'];

	//이미지 삭제
	if ($env->_post['cont_img_del_is'] == "y") {
		if ($r['cont_img_new']) {
			rt_file_delete($r['cont_img_dir'],$r['cont_img_new']);
			$dbo->query("UPDATE RT_PRODUCT_CATE_CONF SET cont_img_dir='', cont_img_new='', cont_img_ori='' WHERE code='".$env->_post['code']."'");
		}
	}

	//이미지 업로드
	if (!empty($env->_files['cont_img']['name'])) {

		$uplist = $cls_fu->upload($env->_files['cont_img']);
		$udata['cont_img_dir'] = $uplist['path_base'].$uplist['path_sub'];
		$udata['cont_img_new'] = $uplist['name_new'];
		$udata['cont_img_ori'] = $uplist['name'];
	}

	if ($dbo->update("RT_PRODUCT_CATE_CONF", $udata, "code='".$env->_post['code']."'")) {
		rt_js_move("정보가 변경되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_post['mode'] == "cateimg") {

	$r = $dbo->fetch("SELECT * FROM RT_PRODUCT_CATE_CONF WHERE code='".$env->_post['code']."'");

	//이미지 삭제
	if ($env->_post['cate_img_del_is'] == "y") {
		if ($r['cate_img_new']) {
			rt_file_delete($r['cate_img_dir'],$r['cate_img_new']);
			$dbo->query("UPDATE RT_PRODUCT_CATE_CONF SET cate_img_dir='', cate_img_new='', cate_img_ori='' WHERE code='".$env->_post['code']."'");
			rt_js_move("삭제되었습니다.", "parent", "reload");exit;
		}
	}

	//이미지 업로드
	if (!empty($env->_files['cate_img']['name'])) {

		$uplist = $cls_fu->upload($env->_files['cate_img']);
		$udata['cate_img_dir'] = $uplist['path_base'].$uplist['path_sub'];
		$udata['cate_img_new'] = $uplist['name_new'];
		$udata['cate_img_ori'] = $uplist['name'];

		if ($dbo->update("RT_PRODUCT_CATE_CONF", $udata, "code='".$env->_post['code']."'")) {
			rt_js_move("정보가 변경되었습니다.", "parent", "reload");
		} else {
			rt_js_msg("시스템문제로 등록되지 않았습니다.");
		}
	}

} else if ($env->_post['mode'] == "category_auth") {

	$r = $dbo->fetch("SELECT * FROM RT_PRODUCT_CATE_CONF WHERE code='".$env->_post['code']."'");

	$udata['auth_en'	] = $env->_post['auth_en'];
	$udata['auth_list'	] = serialize($env->_post['auth_list']);
	$udata['auth_read'	] = serialize($env->_post['auth_read']);

	if ($dbo->update("RT_PRODUCT_CATE_CONF", $udata, "code='".$env->_post['code']."'")) {
		rt_js_msg("정보가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

} else if ($env->_post['mode'] == "category_move") {

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
		rt_js_move("분류 정보가 수정되었습니다.", "parent", "reload");
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