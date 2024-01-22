<?php
//-------------------------------------------------------------------------------------------------
/**
 * 콘텐츠 관리
 * 
 * $env->_post['mode'] 데이터 처리 구분
 * 
 * insert : 신규 등록
 * modify : 등록 정보 수정
 * delete : 콘텐츠 삭제
 */
//-------------------------------------------------------------------------------------------------

require_once "../../engine.php";

//-------------------------------------------------------------------------------------------------

/**
 * 업로드 경로 설정
 */

$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='content'");
$upload_path = $_app['app_path']."/upload";

//-------------------------------------------------------------------------------------------------

/**
 * 업로드 콤포넌트 설정
 */

rt_load_component("fileupload");
$cls_F = new fileupload($upload_path);

//-------------------------------------------------------------------------------------------------

$udata = array();

if ($env->_post['mode'] == "insert")
{
	$udata['grp_seq'		] = $env->_post['grp_seq'];
	$udata['title'			] = $env->_post['title'];
	$udata['login_is'		] = $env->_post['login_is'];
	$udata['content_type'	] = $env->_post['content_type'];
	$udata['html1'			] = $env->_post['html1'];
	$udata['html2'			] = $env->_post['html2'];
	$udata['href'			] = $env->_post['href'];
	$udata['file_subdir'	] = $upload_path;

	for ($m = 1; $m < 3; $m++) {
		if (!empty($env->_files['file'.$m]['name'])) {
			$ar_info = $cls_F->upload($env->_files['file'.$m]);
			$udata['file'.$m.'_new'] = $ar_info['name_new'];
			$udata['file'.$m.'_ori'] = $ar_info['name'];
		}
	}

	if ($dbo->insert("RT_CONTENT", $udata)) {
		rt_js_move("등록되었습니다.", "parent", "href", "../?sd=content");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "modify" && is_numeric($env->_post['seq']))
{
	$_r = $dbo->fetch("SELECT * FROM RT_CONTENT WHERE seq='".$env->_post['seq']."'");

	if (is_numeric($_r['seq'])) {

		$udata['grp_seq'		] = $env->_post['grp_seq'];
		$udata['title'			] = $env->_post['title'];
		$udata['login_is'		] = $env->_post['login_is'];
		$udata['content_type'	] = $env->_post['content_type'];
		$udata['html1'			] = $env->_post['html1'];
		$udata['html2'			] = $env->_post['html2'];
		$udata['href'			] = $env->_post['href'];
		$udata['file_subdir'	] = $upload_path;

		for ($m = 1; $m < 3; $m++) {
			if (!empty($env->_files['file'.$m]['name'])) {
				$ar_info = $cls_F->upload($env->_files['file'.$m]);
				$udata['file'.$m.'_new'] = $ar_info['name_new'];
				$udata['file'.$m.'_ori'] = $ar_info['name'];

				if ($ar_info['name_new'] && $_r['file'.$m.'_new']) {
					$cls_F->delete_file($_r['file'.$m.'_new']);
				}
			}
		}

		if ($dbo->update("RT_CONTENT", $udata, "seq='".$env->_post['seq']."'")) {
			rt_js_move("정보가 변경되었습니다.", "parent", "reload", "");
		} else {
			rt_js_msg("시스템문제로 등록되지 않았습니다.");
		}

	} else {
		?><script>alert("접속경로가 올바르지 않습니다.");</script><?
		rt_js_move("", "parent", "href", "../?sd=content");
	}

}
else if ($env->_get['mode'] == "delete" && is_numeric($env->_get['seq']))
{
	$_r = $dbo->fetch("SELECT * FROM RT_CONTENT WHERE seq='".$env->_get['seq']."'");

	if ($dbo->query("DELETE FROM RT_CONTENT WHERE seq='".$env->_get['seq']."' LIMIT 1")) {

		$cls_F->delete_file($_r['file1_new']);
		$cls_F->delete_file($_r['file2_new']);

		rt_js_move("", "parent", "href", "../?sd=content");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_get['mode'] == "imgdel" && is_numeric($env->_get['seq']) && is_numeric($env->_get['num']))
{
	$_r = $dbo->fetch("SELECT * FROM RT_CONTENT WHERE seq='".$env->_get['seq']."'");

	if ($dbo->query("UPDATE RT_CONTENT SET file".$env->_get['num']."_new='',file".$env->_get['num']."_ori='' WHERE seq='".$env->_get['seq']."'")) {

		$cls_F->delete_file($_r['file'.$env->_get['num'].'_new']);

		rt_js_move("", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else
{
	rt_js_move("", "parent", "href", "../?sd=content");
}
exit;
?>