<?php
//-------------------------------------------------------------------------------------------------
/*
 * 데이터 처리
 * 
 * mode 별 데이터 처리 구분
 * 
 * modify : 회원 가입 관련 환경설정
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";

//-------------------------------------------------------------------------------------------------

$udata = array();//업데이트 데이터

if($env->_post['mode'] == "modify")
{
	$udata['post_new_period'			] = $env->_post['post_new_period'];
	$udata['subject_cut_length'			] = $env->_post['subject_cut_length'];
	$udata['subject_cut_length_m'		] = $env->_post['subject_cut_length_m'];
	$udata['img_thumb_is'				] = $env->_post['img_thumb_is'];
	$udata['list_img_thumb_w'			] = $env->_post['list_img_thumb_w'];
	$udata['list_img_thumb_h'			] = $env->_post['list_img_thumb_h'];
	$udata['pdt_img_thumb_w'			] = $env->_post['pdt_img_thumb_w'];
	$udata['pdt_img_thumb_h'			] = $env->_post['pdt_img_thumb_h'];
	$udata['page_cnt'					] = $env->_post['page_cnt'];
	$udata['block_cnt'					] = $env->_post['block_cnt'];
	$udata['page_cnt_mobile'			] = $env->_post['page_cnt_mobile'];
	$udata['block_cnt_mobile'			] = $env->_post['block_cnt_mobile'];
	$udata['page_cnt_admin'				] = $env->_post['page_cnt_admin'];
	$udata['block_cnt_admin'			] = $env->_post['block_cnt_admin'];
	$udata['auth_list'					] = serialize($env->_post['auth_list']);
	$udata['auth_read'					] = serialize($env->_post['auth_read']);
	$udata['skin_list'					] = $env->_post['skin_list'];
	$udata['skin_view'					] = $env->_post['skin_view'];
	$udata['skin_list_m'				] = $env->_post['skin_list_m'];
	$udata['skin_view_m'				] = $env->_post['skin_view_m'];
	$udata['upload_img_cnt'				] = $env->_post['upload_img_cnt'];
	$udata['upload_file_cnt'			] = $env->_post['upload_file_cnt'];

	if ($dbo->update("RT_PRODUCT_CONF", $udata)) {
		rt_js_msg("데이터가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
exit;
?>