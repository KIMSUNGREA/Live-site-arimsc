<?php
//-------------------------------------------------------------------------------------------------
/*
 * 데이터 처리
 * 
 * mode 별 데이터 처리 구분
 * 
 * modify : 게시판 환경 설정
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";

//-------------------------------------------------------------------------------------------------

$udata = array();//업데이트 데이터

if($env->_post['mode'] == "modify")
{

	$udata['default_name'				] = $env->_post['default_name'];
	$udata['category_is'				] = $env->_post['category_is'];
	$udata['category_data'				] = $env->_post['category_data'];
	$udata['comment_is'					] = $env->_post['comment_is'];
	$udata['page_cnt'					] = $env->_post['page_cnt'];
	$udata['block_cnt'					] = $env->_post['block_cnt'];
	$udata['page_cnt_mobile'			] = $env->_post['page_cnt_mobile'];
	$udata['block_cnt_mobile'			] = $env->_post['block_cnt_mobile'];
	$udata['page_cnt_admin'				] = $env->_post['page_cnt_admin'];
	$udata['block_cnt_admin'			] = $env->_post['block_cnt_admin'];
	$udata['page_cnt_gallery'			] = $env->_post['page_cnt_gallery1'].",".$env->_post['page_cnt_gallery2'];
	$udata['page_cnt_gallery_mobile'	] = $env->_post['page_cnt_gallery_mobile1'].",".$env->_post['page_cnt_gallery_mobile2'];
	$udata['subject_cut_length'			] = $env->_post['subject_cut_length'];
	$udata['subject_cut_length_m'		] = $env->_post['subject_cut_length_m'];
	$udata['upload_cnt'					] = $env->_post['upload_cnt'];
	$udata['upload_size_limit'			] = $env->_post['upload_size_limit'];
	$udata['webeditor_is'				] = $env->_post['webeditor_is'];
	$udata['post_new_period'			] = $env->_post['post_new_period'];
	$udata['assent_term_is'				] = $env->_post['assent_term_is'];
	$udata['assent_term_txt'			] = $env->_post['assent_term_txt'];
	$udata['gallery_is'					] = $env->_post['gallery_is'];
	$udata['list_img_is'				] = $env->_post['list_img_is'];
	$udata['list_img_thumb_is'			] = $env->_post['list_img_thumb_is'];
	$udata['list_img_thumb_w'			] = $env->_post['list_img_thumb_w'];
	$udata['list_img_thumb_h'			] = $env->_post['list_img_thumb_h'];
	$udata['upfile_cont_is'				] = $env->_post['upfile_cont_is'];

	if ($dbo->update("RT_RTBOARD_NORM_CONF", $udata, "bcode='".$env->_post['bcode']."'")) {
		rt_js_msg("데이터가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
exit;
?>