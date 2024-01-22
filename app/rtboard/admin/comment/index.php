<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: rtboard
 * APP SECTION		: comment
 *
 * 설명 : 댓글 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

/**
 * 추가 컴포넌트 로드
 */

rt_load_component("board");

//-------------------------------------------------------------------------------------------------

/**
 * 댓글 컨트롤러 로드
 */

require_once RT_DOC_ROOT.$_app['app_path']."/controller/rtboard.comment.controller.php";
$cls_cmt = new rtboard_cmt(10,10);

//-------------------------------------------------------------------------------------------------

/**
 * 네비게이션 데이터
 */

$__cfg = array();
$__cfg['nav'][0] = "전체 댓글 보기";

//-------------------------------------------------------------------------------------------------

/**
 * 공동 데이터
 */

$_def = array();
$_def['path_app'] = $_app['app_path'];
$_def['path_admin'] = $_def['path_app']."/admin";
$_def['path_assets'] = $_def['path_app']."/assets";
$_def['path_section'] = $_def['path_admin']."/".$__sc;
$_def['func'] = ($env->_get['cf']) ? $env->_get['cf'] : "list";

//-------------------------------------------------------------------------------------------------

/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "list"	:

		$__cfg['nav'][1] = "목록";

		$_b = $dbo->fetch_list("SELECT * FROM RT_RTBOARD");
		for ($m = 0; $m < count($_b); $m++) {
			$board_theme[$_b[$m]['bcode']] = $_b[$m]['theme'];
			$board_name[$_b[$m]['bcode']] = $_b[$m]['name'];
		}

		$cmt_add_qry = array();
		if ($env->_get['bcode']) {
			$cmt_add_qry[] = "bcode='".$env->_get['bcode']."'";
			$cmt_add_url.= "&bcode=".$env->_get['bcode'];
		}

		$cmt_add_url.= "&appcode=rtboard";
		$cmt_add_url.= "&sd=".$env->_get['sd'];

		if (count($cmt_add_qry) > 0) {
			$cmt_str_add_qry = implode(" AND ", $cmt_add_qry);
			$cls_cmt->set_fix_where_qry($cmt_str_add_qry);
		}
		$cls_cmt->set_fix_url_val($cmt_add_url);
		$cls_cmt->init();

		$cmt = $cls_cmt->get_list("ref DESC, re_step ASC");
		if (count($cmt) > 0) {
			for ($i = 0; $i < count($cmt); $i++) {

				foreach($cmt[$i] as $k => $v) $cmt[$i][$k] = stripslashes($v);

				$cmt[$i]['name'] = rt_dbstr_decode($cmt[$i]['name']);
				$cmt[$i]['userid'] = rt_dbstr_decode($cmt[$i]['userid']);
				$cmt[$i]['content'] = nl2br(rt_dbstr_decode($cmt[$i]['content'],"html"));
				$cmt[$i]['reg_date'] = substr($cmt[$i]['reg_date'], 0, 10);
			}
		}

	break;
}

$__cfg['page'] = $__cfg['nav'][0]." <span style='color:#999999;'> | ".$__cfg['nav'][1]."</span>";
?>