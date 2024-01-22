<?php
//-----------------------------------------------------------------------------------------
// 프로그램			: RINT-KIT
// 제작				: 린트킷(rintkit.com)
// 버전				: 1.0
// 인코딩			: UTF-8
// 설명				: mode 별 데이터 처리 구분
//-----------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

//-------------------------------------------------------------------------------------------------

/**
 * 추가 컴포넌트 로드
 */

rt_load_component("board,fileupload");

//-------------------------------------------------------------------------------------------------

/**
 * 댓글 컨트롤러 로드
 */

require_once RT_DOC_ROOT.$_rt_rtboard['app_path']."/controller/rtboard.comment.controller.php";
$cls_cmt = new rtboard_cmt();

//-------------------------------------------------------------------------------------------------

$udata = array();//업데이트 데이터

if($env->_get['mode'] == "download" && $env->_get['bcode'] && is_numeric($env->_get['seq']) && is_numeric($env->_get['file_num']))
{
	$f = $dbo->fetch("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$env->_get['bcode']."' AND post_seq=".$env->_get['seq']." AND file_num=".$env->_get['file_num']);
	rt_download($f['file_new'], $f['file_ori'], $f['path_base'].$f['path_sub']);
}
else if ($env->_post['mode'] == "cmt_insert")
{
	if (!empty($env->_post['pwd'])) {
		$udata['pwd'] = rt_password($env->_post['pwd']);
	}

	$udata['post_seq'		] = $env->_post['post_seq'];
	$udata['bcode'			] = $env->_post['bcode'];
	$udata['userid'			] = $env->_post['id'];
	$udata['name'			] = $env->_post['name'];
	$udata['content'		] = $env->_post['content'];
	$udata['reg_date'		] = date("Y-m-d H:i:s");
	$udata['user_ip'		] = $env->_server['REMOTE_ADDR'];

	if($cls_cmt->cmt_insert($udata)) {
		rt_js_move("", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "cmt_delete" && is_numeric($env->_post['seq']))
{
	$cmt = $dbo->fetch("SELECT * FROM RT_RTBOARD_CMT WHERE seq=".$env->_post['seq']);

	//삭제 체크
	if (!empty($cmt['userid'])) {

		//회원 권한 댓글
		if ($cmt['userid'] == "master" || $cmt['userid'] == "admin") {

			//관리자 댓글
			rt_js_msg("삭제권한이 없습니다");exit;
		} else {

			//회원 댓글
			if ($env->_post['id'] != $cmt['userid']) {
				rt_js_msg("삭제권한이 없습니다");exit;
			}
		}

	} else if (!empty($env->_post['pwd'])) {

		//비회원 권한 댓글
		$tmp_pwd = rt_password($env->_post['pwd']);
		if ($tmp_pwd != $cmt['pwd']) {
			rt_js_msg("비밀번호가 맞지 않습니다.");exit;
		}
	}

	//현재 댓글이 1차
	if ($cmt['re_level'] == 0) {

		//하위 댓글여부에 따른 처리
		$chk = $dbo->fetch("SELECT COUNT(seq) AS seqcnt FROM RT_RTBOARD_CMT WHERE post_seq=".$cmt['post_seq']." AND ref=".$cmt['ref']." AND re_level > 0");
		if ($chk['seqcnt'] > 0) {

			$udata['content'] = "삭제된 댓글입니다.";
			$udata['del_en'] = "y";
			$result = $dbo->update("RT_RTBOARD_CMT", $udata, "seq='".$env->_post['seq']."'");

		} else {

			$result = $dbo->query("DELETE FROM RT_RTBOARD_CMT WHERE seq='".$env->_post['seq']."'");
		}

	//현재 댓글이 2차이상
	} else if ($cmt['re_level'] > 0) {

		//1차 댓글이 삭제되었는지 여부에 따른 처리
		$chk = $dbo->fetch("SELECT * FROM RT_RTBOARD_CMT WHERE post_seq=".$cmt['post_seq']." AND ref=".$cmt['ref']." AND re_level = 0 AND del_en='y'");
		if (is_numeric($chk['seq'])) {

			//1차 댓글이 삭제된 경우 그 이하 댓글이 1개인지 2개이상인지에 따른 처리, 1개인경우 1차 댓글 포함 삭제
			$chk2 = $dbo->fetch("SELECT COUNT(seq) AS seqcnt FROM RT_RTBOARD_CMT WHERE post_seq=".$cmt['post_seq']." AND ref=".$cmt['ref']." AND re_level > 0");
			if ($chk2['seqcnt'] > 1) {
				$result = $dbo->query("DELETE FROM RT_RTBOARD_CMT WHERE seq='".$env->_post['seq']."'");
			} else {
				$result = $dbo->query("DELETE FROM RT_RTBOARD_CMT WHERE post_seq=".$cmt['post_seq']." AND ref=".$cmt['ref']);
			}

		} else {
			$result = $dbo->query("DELETE FROM RT_RTBOARD_CMT WHERE seq='".$env->_post['seq']."'");
		}
	}

	if ($result) {
		rt_js_move("", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 처리되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "cmt_reply" && is_numeric($env->_post['seq']))
{
	$r = $dbo->fetch("SELECT * FROM RT_RTBOARD_CMT WHERE seq=".$env->_post['seq']);

	if (!empty($env->_post['pwd']) && !$cls_rtm->is_login()) {
		$udata['pwd'] = rt_password($env->_post['pwd']);
	}

	$udata['post_seq'		] = $r['post_seq'];
	$udata['bcode'			] = $r['bcode'];
	$udata['userid'			] = $env->_post['id'];
	$udata['name'			] = $env->_post['name'];
	$udata['content'		] = $env->_post['content'];
	$udata['ref'			] = $r['ref'];
	$udata['re_step'		] = $r['re_step'];
	$udata['re_level'		] = $r['re_level'];
	$udata['reg_date'		] = date("Y-m-d H:i:s");
	$udata['user_ip'		] = $env->_server['REMOTE_ADDR'];

	if($cls_cmt->cmt_reply($udata)) {
		rt_js_move("", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 처리되지 않았습니다.");
	}
}
else
{
	rt_js_move("접속오류입니다. 다시 접속해 주세요", "parent", "href", "/");
}
exit;

?>
