<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: rtboard
 * APP SECTION		: theme-info-data
 *
 * 설명 : 게시판 데이터 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

/**
 * 게시판 공통 환경정보
 */

$_bdinfo = $dbo->fetch("SELECT * FROM RT_RTBOARD WHERE bcode='".$env->_get['bcode']."'");

if (empty($env->_get['bcode']) || empty($_bdinfo['bcode'])) {
	rt_js_move("게시판 정보가 올바르지 않습니다.", "parent", "href", RTW_ADM);
	exit;
}

//-------------------------------------------------------------------------------------------------

/**
 * 게시판 개별환경 정보
 */

$_conf = $dbo->fetch("SELECT * FROM RT_RTBOARD_".strtoupper($_bdinfo['theme'])."_CONF WHERE bcode='".$env->_get['bcode']."'");
$_fset = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_ADD_FIELD WHERE bcode='".$env->_get['bcode']."' AND is_use='y' ORDER BY formnum ASC");

//-------------------------------------------------------------------------------------------------

/**
 * 추가 컴포넌트 로드
 */

rt_load_component("board");

//-------------------------------------------------------------------------------------------------

/**
 * 게시판 컨트롤러 로드
 */

require_once RT_DOC_ROOT.$_app['app_path']."/theme/".$_bdinfo['theme']."/lib/rtboard.".$_bdinfo['theme'].".class.php";
$cls_board = new rtboard_info($_conf['page_cnt_admin'],$_conf['block_cnt_admin']);

//-------------------------------------------------------------------------------------------------

/**
 * 댓글 컨트롤러 로드
 */

require_once RT_DOC_ROOT.$_app['app_path']."/controller/rtboard.comment.controller.php";
$cls_cmt = new rtboard_cmt(15,10);

//-------------------------------------------------------------------------------------------------

/**
 * 네비게이션 데이터
 */

$__cfg = array();
$__cfg['nav'][0] = "게시판 목록";
$__cfg['nav'][1] = $_bdinfo['name'];
$__cfg['page'] = $_bdinfo['name'];

//-------------------------------------------------------------------------------------------------

/**
 * 공동 데이터
 */

$_def = array();
$_def['path_app'] = $_app['app_path'];
$_def['path_admin'] = $_def['path_app']."/admin";
$_def['path_theme'] = $_def['path_app']."/theme/".$_bdinfo['theme'];
$_def['path_files'] = $_def['path_app']."/files";
$_def['path_assets'] = $_def['path_app']."/assets";
$_def['path_section'] = $_def['path_theme']."/".$__sc;
$_def['func'] = ($env->_get['cf']) ? $env->_get['cf'] : "list";

$category_arr = explode(",", $_conf['category_data']);

//-------------------------------------------------------------------------------------------------

/**
 * 게시판 환경 데이터
 */

$add_qry = array(); //DB 쿼리 배열
$add_url = ""; //전달 변수 배열


//고정 DB 쿼리
$add_qry[] = "bcode='".$env->_get['bcode']."'";
$add_qry[] = "notice_is='n'";

//고정 URL
$add_url.= "&appcode=rtboard";
$add_url.= "&sd=".$env->_get['sd'];
$add_url.= "&bcode=".$env->_get['bcode'];

//변동 쿼리
if ($env->_get['search'] && $env->_get['searchstring']) {
	if ($env->_get['search'] == "subjcont") {
		$add_qry[] = "((subject LIKE '%".$env->_get['searchstring']."%') OR (content LIKE '%".$env->_get['searchstring']."%'))";
	} else {
		$add_qry[] = "(".$env->_get['search']." LIKE '%".$env->_get['searchstring']."%')";
	}
	$add_url.= "&search=".$env->_get['search']."&searchstring=".$env->_get['searchstring'];
	$add_sch_url = "&search=".$env->_get['search']."&searchstring=".$env->_get['searchstring'];
}

if (count($add_qry) > 0) {
	$str_add_qry = implode(" AND ", $add_qry);
	$cls_board->set_fix_where_qry($str_add_qry);
}
$cls_board->set_fix_url_val($add_url);
$cls_board->init();

//-------------------------------------------------------------------------------------------------

/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "list"	:
		$__cfg['nav'][2] = "데이터 목록";

		$env->_get['pg'] = (empty($env->_get['pg'])) ? 1 : $env->_get['pg'];

		//공지사항 데이터 설정
		$_ntc = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_INFO WHERE bcode='".$env->_get['bcode']."' AND notice_is='y' ORDER BY seq DESC");
		if (count($_ntc) > 0) {
			for ($i = 0; $i < count($_ntc); $i++) {

				$_ntc[$i]['no'] = $num;
				$_ntc[$i]['subject'] = rt_str_length_cut(rt_dbstr_decode($_ntc[$i]['subject']),$_conf['subject_cut_length'],"..");
				$_ntc[$i]['reg_date'] = substr($_ntc[$i]['reg_date'], 0, 10);
				$_ntc[$i]['viewpage'] = "?appcode=rtboard&sd=theme-".$_bdinfo['theme']."-data&cf=view&bcode=".$env->_get['bcode']."&seq=".$_ntc[$i]['seq']."&pg=".$env->_get['pg'].$add_sch_url;

				//리스트 썸네일
				if ($_conf['list_img_is'] == "y") {
					$_ntc[$i]['list_img_src'] = "";
					if ($_conf['list_img_thumb_is'] == "y") {
						$_ntc[$i]['list_img_src'] = $_ntc[$i]['list_img_dir']."thumb/".$_ntc[$i]['list_img_thumb'];
					} else {
						$_ntc[$i]['list_img_src'] = $_ntc[$i]['list_img_dir'].$_ntc[$i]['list_img_new'];
					}

					if (!is_file(RT_DOC_ROOT.$_ntc[$i]['list_img_src'])) {
						$_ntc[$i]['list_img_src'] = $_def['path_theme']."/user/files/list_no.png";
					}
				}

				//아이콘 설정
				$_ntc[$i]['new'] = (rt_is_new_post($_ntc[$i]['reg_date'], $_conf['post_new_period'])) ? "<img src='".$_def['path_assets']."/img/new_ico.png' />":"";

				//첨부파일여부
				$_atc = $cls_board->get_attc_info($env->_get['bcode'],$_ntc[$i]['seq']);
				$_ntc[$i]['file'] = ($_atc['result']) ? "<img src='".$_def['path_assets']."/img/file_ico.png' />" : "";

				//댓글 수
				$_cmt = $dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_RTBOARD_CMT WHERE bcode='".$env->_get['bcode']."' AND post_seq='".$_ntc[$i]['seq']."' AND del_en='n'");
				$_ntc[$i]['cmtcnt'] = number_format($_cmt['cnt']);
			}
		}
		
		//게시판 리스트 데이터 설정
		if ($cls_board->list_rec_cnt > 0)
		{
			$num = $cls_board->list_rec_cnt;
			$_l = $cls_board->get_list("seq DESC");
			for ($i = 0; $i < count($_l); $i++)
			{
				$_l[$i]['no'] = $num;
				$_l[$i]['subject'] = rt_str_length_cut(rt_dbstr_decode($_l[$i]['subject']),$_conf['subject_cut_length'],"..");
				$_l[$i]['reg_date'] = substr($_l[$i]['reg_date'], 0, 10);
				$_l[$i]['viewpage'] = "?appcode=rtboard&sd=theme-".$_bdinfo['theme']."-data&cf=view&bcode=".$env->_get['bcode']."&seq=".$_l[$i]['seq']."&pg=".$env->_get['pg'].$add_sch_url;

				//리스트 썸네일
				if ($_conf['list_img_is'] == "y") {
					$_l[$i]['list_img_src'] = "";
					if ($_conf['list_img_thumb_is'] == "y") {
						$_l[$i]['list_img_src'] = $_l[$i]['list_img_dir']."thumb/".$_l[$i]['list_img_thumb'];
					} else {
						$_l[$i]['list_img_src'] = $_l[$i]['list_img_dir'].$_l[$i]['list_img_new'];
					}

					if (!is_file(RT_DOC_ROOT.$_l[$i]['list_img_src'])) {
						$_l[$i]['list_img_src'] = $_def['path_theme']."/user/files/list_no.png";
					}
				}

				//아이콘 설정
				$_l[$i]['new'] = (rt_is_new_post($_l[$i]['reg_date'], $_conf['post_new_period'])) ? "<img src='".$_def['path_assets']."/img/new_ico.png' />":"";

				//첨부파일여부
				$_atc = $cls_board->get_attc_info($env->_get['bcode'],$_l[$i]['seq']);
				$_l[$i]['file'] = ($_atc['result']) ? "<img src='".$_def['path_assets']."/img/file_ico.png' />" : "";

				//댓글 수
				$_cmt = $dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_RTBOARD_CMT WHERE bcode='".$env->_get['bcode']."' AND post_seq='".$_l[$i]['seq']."' AND del_en='n'");
				$_l[$i]['cmtcnt'] = number_format($_cmt['cnt']);

				$num--;
			}
		}

		//변동 데이터에 따른 colspan 설정
		$_no_data_colspan = 6;
		if ($_conf['category_is'] == "y") $_no_data_colspan+= 1;
		if ($_conf['list_img_is'] == "y") $_no_data_colspan+= 1;

		$_board_info = $dbo->fetch_list("SELECT * FROM RT_RTBOARD WHERE theme='info' ORDER BY bseq ASC");
	break;

	case "form"	:

		$__cfg['nav'][2] = "데이터 폼";

		//게시판 폼 템플릿
		$formtpl_arr = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_FORM_TPL ORDER BY ord ASC");

		if($env->_get['seq']){

			$_def['mode'] = "modify";

			$r = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl." WHERE seq='".$env->_get['seq']."'");

			//추가 필드 정보
			$sz = unserialize(html_entity_decode($r['extvar']));

			foreach($r as $k => $v) $r[$k] = stripslashes($v);

			${"notice_is_".$r['notice_is']} = "checked";
			${"use_is_".$r['use_is']} = "checked";
			${"list_img_cont_is_".$r['list_img_cont_is']} = "checked";

			$mod_date = (empty($r['mod_date'])) ? "" : $r['mod_date'];

			//첨부파일 목록
			$attc_list_tmp = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$env->_get['bcode']."' AND post_seq='".$env->_get['seq']."' ORDER BY file_num ASC");
			for ($m = 0; $m < count($attc_list_tmp); $m++) {
				$attc_arr[$attc_list_tmp[$m]['file_num']] = $attc_list_tmp[$m];
			}

		}else{
			$_def['mode'] = "insert";

			$r['name'] = $_conf['default_name'];

			$use_is_y = "checked";
			$list_img_cont_is_n = "checked";
		}

	break;

	case "view"	:

		$__cfg['nav'][2] = "상세 보기";

		if (is_numeric($env->_get['seq'])) {

			$_def['mode'] = "modify";

			$r = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl." WHERE seq='".$env->_get['seq']."'");

			//추가 필드 정보
			$sz = unserialize(html_entity_decode($r['extvar']));

			foreach($r as $k => $v) $r[$k] = stripslashes($v);

			$r['content'] = rt_dbstr_decode($r['content']);
			$r['reg_date'] = substr($r['reg_date'],0,10);

			//리스트 썸네일
			if ($_conf['list_img_is'] == "y") {
				$r['list_img_src'] = "";
				if ($_conf['list_img_thumb_is'] == "y") {
					$r['list_img_src'] = $r['list_img_dir']."thumb/".$r['list_img_thumb'];
				} else {
					$r['list_img_src'] = $r['list_img_dir'].$r['list_img_new'];
				}

				if (!is_file(RT_DOC_ROOT.$r['list_img_src'])) {
					$r['list_img_src'] = $_def['path_theme']."/user/files/list_no.png";
				}
			}

			//첨부파일 목록
			$attc_arr = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$env->_get['bcode']."' AND post_seq='".$env->_get['seq']."' ORDER BY file_num ASC");

			//댓글 목록
			$cmt_add_qry = array();
			$cmt_add_qry[] = "post_seq='".$r['seq']."'";
			$cmt_add_qry[] = "bcode='".$env->_get['bcode']."'";

			$cmt_add_url.= "&seq=".$r['seq'];
			$cmt_add_url.= "&appcode=rtboard";
			$cmt_add_url.= "&sd=".$env->_get['sd'];
			$cmt_add_url.= "&cf=".$env->_get['cf'];
			$cmt_add_url.= "&bcode=".$env->_get['bcode'];
			$cmt_add_url.= "&pg=".$env->_get['pg'];

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

					$cmt[$i]['name'] = html_entity_decode($cmt[$i]['name']);
					$cmt[$i]['userid'] = html_entity_decode($cmt[$i]['userid']);
					$cmt[$i]['content'] = nl2br(html_entity_decode($cmt[$i]['content']));
					$cmt[$i]['reg_date'] = substr($cmt[$i]['reg_date'], 0, 10);
				}
			}

		} else {
			rt_js_move("올바른 접근이 아닙니다.", "self", "href", RTW_ADM);
		}
	break;
}

$__cfg['page'] = "".$__cfg['page']." <span style='color:#999999;'> | ".$__cfg['nav'][2]."</span>";
?>