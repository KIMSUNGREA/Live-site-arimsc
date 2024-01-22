<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: QnA 테마, 사용자 출력 데이터
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

/**
 * 추가 컴포넌트 로드
 */

rt_load_component("board");

//-------------------------------------------------------------------------------------------------

/**
 * 게시판 컨트롤러 로드
 */

require_once RT_DOC_ROOT.$this->app['app_path']."/theme/".$this->board_info['theme']."/lib/rtboard.qna.class.php";

//페이지 출력 수 설정
if ($this->cls_pg->conn_screen == "mobile") {
	$list_cnt = $this->board_conf['page_cnt_mobile'];
	$block_cnt = $this->board_conf['block_cnt_mobile'];
} else {
	$list_cnt = $this->board_conf['page_cnt'];
	$block_cnt = $this->board_conf['block_cnt'];
}

$cls_board = new rtboard_qna($list_cnt, $block_cnt);

//-------------------------------------------------------------------------------------------------

/**
 * 댓글 컨트롤러 로드
 */

require_once RT_DOC_ROOT.$this->app['app_path']."/controller/rtboard.comment.controller.php";
$cls_cmt = new rtboard_cmt(15,10);

//-------------------------------------------------------------------------------------------------

/**
 * 추가필드 정보
 */

$_fset = $this->dbo->fetch_list("SELECT * FROM RT_RTBOARD_ADD_FIELD WHERE bcode='".$this->bcode."' AND is_use='y' ORDER BY formnum ASC");

//-------------------------------------------------------------------------------------------------

/**
 * 공동 데이터
 */

$_def = array();
$_def['path_app'] = $this->app['app_path'];
$_def['path_theme'] = $_def['path_app']."/theme/".$this->board_info['theme'];
$_def['path_files'] = $_def['path_app']."/files";
$_def['path_tpl'] = $_def['path_app']."/template";
$_def['path_css'] = $_def['path_theme']."/user/css";
$_def['func'] = ($this->env->_get['cf']) ? $this->env->_get['cf'] : "list";
//$_def['acturl'] = ($this->rt_conf_db['ssl_is'] == "y")?$this->rt_conf_db['ssl_url']:$this->rt_conf_db['ssl_url_n'];

$this->env->_get['pg'] = (empty($this->env->_get['pg'])) ? 1 : $this->env->_get['pg'];

//-------------------------------------------------------------------------------------------------

/**
 * 공동 템플릿 코드
 */

$tpl->assign('path_app', $_def['path_app']);
$tpl->assign('path_theme', $_def['path_theme']);
$tpl->assign('path_files', $_def['path_files']);
$tpl->assign('path_tpl', $_def['path_tpl']);
$tpl->assign('path_css', $_def['path_css']);
$tpl->assign('pg', $this->env->_get['pg']);
$tpl->assign('php_self', $this->env->_server['PHP_SELF']);
$tpl->assign('acturl', $_def['acturl'].$_def['path_theme']);

$tpl->assign('로그인여부', $this->rtm->is_login());
$tpl->assign('회원아이디', $this->rtm->id);
$tpl->assign('회원이름', $this->rtm->nm);

$tpl->assign('테마코드', $this->board_info['theme']);
$tpl->assign('이동화면', $this->cls_pg->conn_screen);
$tpl->assign('페이지코드', $this->env->_get['pcd']);
$tpl->assign('게시판코드', $this->bcode);
$tpl->assign('검색키', $this->env->_get['search']);
$tpl->assign('검색어', $this->env->_get['searchstring']);
$tpl->assign('검색분류', urlencode($this->env->_get['ct']));
$tpl->assign('게시판명', $this->board_info['name']);
$tpl->assign('웹에디터사용', $this->board_conf['webeditor_is']);
$tpl->assign('분류사용', $this->board_conf['category_is']);
$tpl->assign('댓글사용', $this->board_conf['comment_is']);
$tpl->assign('댓글이용권한', $this->check_auth("comment"));

if ($this->cls_pg->conn_screen == "mobile") {
	$tpl->assign('웹에디터사용', "n");
} else {
	$tpl->assign('웹에디터사용', $this->board_conf['webeditor_is']);
}

//신청가능횟수
$cnta = $this->dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_COUPON WHERE user_id='".$this->rtm->id."' AND coupon_type='a' AND use_is='n'");
$cntb = $this->dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_COUPON WHERE user_id='".$this->rtm->id."' AND coupon_type='b' AND use_is='n'");
$cntc = $this->dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_COUPON WHERE user_id='".$this->rtm->id."' AND coupon_type='c' AND use_is='n'");

$total_sum = $cnta['cnt'] + $cntb['cnt'] + $cntc['cnt'];

$tpl->assign('신청가능횟수', $total_sum);
$tpl->assign('구매후기신청횟수', $cnta['cnt']);
$tpl->assign('베스트신청횟수', $cntb['cnt']);
$tpl->assign('추천인신청횟수', $cntc['cnt']);
//-------------------------------------------------------------------------------------------------

/**
 * 게시판 환경 데이터
 */

$add_qry = array(); //DB 쿼리 배열
$add_url = ""; //전달 변수 배열


//고정 DB 쿼리
$add_qry[] = "bcode='".$this->bcode."'";
$add_qry[] = "use_is='y'";
$add_qry[] = "notice_is='n'";

//고정 URL
$add_url.= "&bcode=".$this->bcode;

//자동 생성 페이지 사용 시, 페이지 코드를 고정 URL로 설정
if (!empty($this->env->_get['pcd'])) {
	$add_sch_url.= "&pcd=".$this->env->_get['pcd']."";
}

//모바일 보기 여부
if ($this->cls_pg->conn_screen == "mobile") {
	$add_sch_url.= "&screen=mobile";
}

//변동 쿼리
if ($this->env->_get['search'] && $this->env->_get['searchstring']) {
	if ($this->env->_get['search'] == "subjcont") {
		$add_qry[] = "((subject LIKE '%".$this->env->_get['searchstring']."%') OR (content LIKE '%".$this->env->_get['searchstring']."%'))";
	} else {
		$add_qry[] = "(".$this->env->_get['search']." LIKE '%".$this->env->_get['searchstring']."%')";
	}
	$add_url.= "&search=".$this->env->_get['search']."&searchstring=".$this->env->_get['searchstring'];
	$add_sch_url = "&search=".$this->env->_get['search']."&searchstring=".$this->env->_get['searchstring'];
}

if ($this->env->_get['ct']) {
	$add_qry[] = "(category='".$this->env->_get['ct']."')";
	$add_url.= "&ct=".urlencode($this->env->_get['ct']);
	$add_sch_url.= "&ct=".urlencode($this->env->_get['ct']);
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

		//접근 권한
		if (!$this->check_auth("list")) {
			if ($this->rtm->is_login()) {
				rt_js_move("이용권한이 없습니다.", "self", "history", "-1");
			} else {
				rt_js_move("", "self", "href", $this->_rtm_conf['login_set_page']."?prepage=".urlencode($this->env->_server['REQUEST_URI']));
			}
			exit;
		}

		//글분류 정보
		$ct_conf_arr = explode(",",$this->board_conf['category_data']);
		for ($m = 0; $m < count($ct_conf_arr); $m++) {
			$ct_arr[$m]['분류명'] = $ct_conf_arr[$m];
			$ct_arr[$m]['onclass'] = ($ct_conf_arr[$m] == $this->env->_get['ct']) ? "on":"";
			$ct_arr[$m]['selected'] = ($ct_conf_arr[$m] == $this->env->_get['ct']) ? "selected='selected'":"";
		}
		$tpl->assign('글분류', $ct_arr);

		//공지사항 데이터 설정
		$_ntc = $this->dbo->fetch_list("SELECT * FROM RT_RTBOARD_QNA WHERE bcode='".$this->bcode."' AND notice_is='y' AND use_is='y' ORDER BY seq DESC");
		if (count($_ntc) > 0) {
			for ($i = 0; $i < count($_ntc); $i++) {

				$_ntc[$i]['번호'] = $num;
				$_ntc[$i]['분류'] = rt_dbstr_decode($_ntc[$i]['category']);
				$_ntc[$i]['제목'] = rt_dbstr_decode($_ntc[$i]['subject']);
				$_ntc[$i]['줄임제목'] = rt_str_length_cut($_ntc[$i]['제목'],$this->board_conf['subject_cut_length'],"..");
				$_ntc[$i]['모바일줄임제목'] = rt_str_length_cut($_ntc[$i]['제목'],$this->board_conf['subject_cut_length_m'],"..");
				$_ntc[$i]['작성자'] = rt_dbstr_decode($_ntc[$i]['name']);
				$_ntc[$i]['가림작성자'] = rt_name_hide(rt_dbstr_decode($_ntc[$i]['name']));
				$_ntc[$i]['회원아이디'] = rt_dbstr_decode($_ntc[$i]['userid']);
				$_ntc[$i]['본문'] = rt_dbstr_decode($_ntc[$i]['content']);
				$_ntc[$i]['줄임본문'] = rt_str_length_cut(strip_tags(nl2br($_ntc[$i]['본문'])), 380, "..");
				$_ntc[$i]['작성일'] = str_replace("-",".",substr($_ntc[$i]['reg_date'], 0, 10));
				$_ntc[$i]['조회수'] = $_ntc[$i]['hits'];
				$_ntc[$i]['아이피'] = $_ntc[$i]['user_ip'];
				$_ntc[$i]['상세페이지링크'] = "?cf=view&seq=".$_ntc[$i]['seq']."&pg=".$this->env->_get['pg'].$add_sch_url;

				//추가 필드 데이터
				$sz = unserialize(html_entity_decode($_ntc[$i]['extvar']));

				for ($m = 0; $m < count($_fset); $m++) {
					$_ntc[$i]['추가_'.$_fset[$m]['name']] = $cls_board->formset_data($_fset[$m], $sz);
				}

				//아이콘 설정
				$_ntc[$i]['새글아이콘'] = (rt_is_new_post($_ntc[$i]['reg_date'], 10)) ? "<span><img src='".$_def['path_app']."/assets/img/board_new.png' alt='새로 등록된 글'/></span>":"";

				//첨부파일
				$_atc = $cls_board->get_attc_info($this->bcode,$_ntc[$i]['seq']);
				$_ntc[$i]['첨부파일여부'] = $_atc['result'];

				$_ntc[$i]['첨부아이콘'] = "";
				if ($_atc['result']) {
					$_ntc[$i]['첨부아이콘'] = "<span><img src='".$_def['path_theme']."/user/files/ico_file.png' alt='첨부파일'/></span>";
				}

				//댓글 수
				$_cmt = $this->dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_RTBOARD_CMT WHERE bcode='".$this->bcode."' AND post_seq='".$_ntc[$i]['seq']."' AND del_en='n'");
				$_ntc[$i]['댓글수'] = number_format($_cmt['cnt']);
			}
		}
		$tpl->assign('공지글', $_ntc);

		//리스트 데이터 설정
		if ($cls_board->list_rec_cnt > 0)
		{
			$num = $cls_board->list_rec_cnt;
			$_l = $cls_board->get_list("seq DESC");
			for ($i = 0; $i < count($_l); $i++)
			{
				$_l[$i]['번호'] = $num;
				$_l[$i]['고유키'] = $_l[$i]['seq'];
				$_l[$i]['분류'] = rt_dbstr_decode($_l[$i]['category']);
				$_l[$i]['제목'] = rt_dbstr_decode($_l[$i]['subject']);
				$_l[$i]['줄임제목'] = rt_str_length_cut($_l[$i]['제목'],$this->board_conf['subject_cut_length'],"..");
				$_l[$i]['모바일줄임제목'] = rt_str_length_cut($_l[$i]['제목'],$this->board_conf['subject_cut_length_m'],"..");
				$_l[$i]['작성자'] = rt_dbstr_decode($_l[$i]['name']);
				$_l[$i]['가림작성자'] = rt_name_hide(rt_dbstr_decode($_l[$i]['name']));
				$_l[$i]['회원아이디'] = rt_dbstr_decode($_l[$i]['userid']);
				$_l[$i]['본문'] = rt_dbstr_decode($_l[$i]['content']);
				$_l[$i]['작성일'] = str_replace("-",".",substr($_l[$i]['reg_date'], 0, 10));
				$_l[$i]['답변상태'] = $_l[$i]['reply_is'];
				$_l[$i]['아이피'] = $_l[$i]['user_ip'];
				$_l[$i]['휴대폰번호'] = $_l[$i]['phone'];
				$_l[$i]['상세페이지링크'] = "?cf=view&seq=".$_l[$i]['seq']."&pg=".$this->env->_get['pg'].$add_sch_url;

				//추가 필드 데이터
				$sz = unserialize(html_entity_decode($_l[$i]['extvar']));

				for ($m = 0; $m < count($_fset); $m++) {
					$_l[$i]['추가_'.$_fset[$m]['name']] = $cls_board->formset_data($_fset[$m], $sz);
				}

				//아이콘 설정
				$_l[$i]['새글아이콘'] = (rt_is_new_post($_l[$i]['reg_date'], $this->board_conf['post_new_period'])) ? "<span><img src='".$_def['path_app']."/assets/img/board_new.png' alt='새로 등록된 글'/></span>":"";

				//첨부파일
				$_atc = $cls_board->get_attc_info($this->bcode,$_l[$i]['seq']);
				$_l[$i]['첨부파일여부'] = $_atc['result'];

				$_l[$i]['첨부아이콘'] = "";
				if ($_atc['result']) {
					$_l[$i]['첨부아이콘'] = "<span><img src='".$_def['path_theme']."/user/files/ico_file.gif' alt='첨부파일'/></span>";
				}

				//댓글 수
				$_cmt = $this->dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_RTBOARD_CMT WHERE bcode='".$this->bcode."' AND post_seq='".$_l[$i]['seq']."' AND del_en='n'");
				$_l[$i]['댓글수'] = number_format($_cmt['cnt']);

				//내 글 여부
				$_l[$i]['내글여부'] = false;
				if ($this->rtm->id == $_l[$i]['회원아이디'] && !empty($_l[$i]['회원아이디'])) {
					$_l[$i]['내글여부'] = true;
				}

				$num--;
			}
		}

		if ($this->env->_get['pcd']) $addqry = "&pcd=".$this->env->_get['pcd'];
		if ($this->env->_get['screen']) $addqry.= "&screen=".$this->env->_get['screen'];

		$tpl->assign('쓰기페이지링크', "?cf=form".$addqry);
		$tpl->assign('페이지인덱스', $cls_board->page_index($this->env->_server['PHP_SELF']));
		$tpl->assign('리스트', $_l);
		$tpl->assign('게시물수', $cls_board->list_rec_cnt);

		$_def['skin'] = $skin_arr['skin_list'];
	break;

	case "form"	:

		//접근 권한
		if (!$this->check_auth("write")) {
			if ($this->rtm->is_login()) {
				rt_js_move("이용권한이 없습니다.", "self", "history", "-1");
			} else {
				rt_js_move("", "self", "href", $this->_rtm_conf['login_set_page']."?prepage=".urlencode($this->env->_server['REQUEST_URI']));
			}
			exit;
		}

if ($total_sum < 1) {
	rt_js_move("신청가능건수가 없습니다.", "self", "history", "-1");
	exit;
}

		if (is_numeric($this->env->_get['seq'])) {

			$tpl->assign('mode', "modify");

			$r = $this->dbo->fetch("SELECT * FROM ".$cls_board->db_tbl." WHERE seq='".$this->env->_get['seq']."'");

			//직접접속 방지
			if ($this->rtm->id == $r['userid'] && !empty($r['userid'])){}else {
				if ($this->env->_session['post_'.$this->board_info['theme'].'_'.$this->env->_get['seq']] != "y") {
					rt_js_move("올바른 접속이 아닙니다", "parent", "history", "-1");exit;
				}
			}

			//글분류 정보
			$ct_conf_arr = explode(",",$this->board_conf['category_data']);
			for ($m = 0; $m < count($ct_conf_arr); $m++) {
				$ct_arr[$m]['분류명'] = $ct_conf_arr[$m];
				$ct_arr[$m]['onclass'] = ($ct_conf_arr[$m] == $r['category']) ? "on":"";
				$ct_arr[$m]['selected'] = ($ct_conf_arr[$m] == $r['category']) ? "selected='selected'":"";
			}
			$tpl->assign('글분류', $ct_arr);

			//추가 필드 데이터
			$sz = unserialize(html_entity_decode($r['extvar']));

			$addfield = array();
			for ($m = 0; $m < count($_fset); $m++) {
				$r['추가_'.$_fset[$m]['name']] = $cls_board->formset($_fset[$m], $sz, false, true);
				$addfield[$m]['필드명'] = $_fset[$m]['name'];
				$addfield[$m]['데이터'] = $cls_board->formset($_fset[$m], $sz, false, true);
			}
			$tpl->assign('추가필드', $addfield);

			foreach($r as $k => $v) $r[$k] = stripslashes($v);

			$r['고유키'] = $r['seq'];
			$r['분류'] = rt_dbstr_decode($r['category']);
			$r['아이디'] = $r['userid'];
			$r['작성자'] = rt_dbstr_decode($r['name']);
			$r['제목'] = rt_dbstr_decode($r['subject']);
			$r['휴대폰번호'] = rt_dbstr_decode($r['phone']);

			if ($this->cls_pg->conn_screen == "mobile" && $r['webeditor_is'] == "y") {
				$r['내용'] = strip_tags(rt_dbstr_decode($r['content']));
			} else if ($this->cls_pg->conn_screen == "mobile" && $r['webeditor_is'] == "n") {
				$r['내용'] = strip_tags(rt_dbstr_decode($r['content']));
			} else if ($this->board_conf['webeditor_is'] == "y" && $r['webeditor_is'] == "n") {
				$r['내용'] = nl2br(rt_dbstr_decode($r['content']));
			} else if ($this->board_conf['webeditor_is'] == "n" && $r['webeditor_is'] == "y") {
				$r['내용'] = strip_tags(rt_dbstr_decode($r['content']));
			} else {
				$r['내용'] = rt_dbstr_decode($r['content']);
			}

			$r['작성일'] = substr($r['reg_date'],0,10);
			$r['수정일'] = substr($r['mod_date'],0,10);
			$r['조회수'] = number_format($r['hits']);
			$r['아이피'] = $r['user_ip'];

			//첨부파일
			$attc_list_tmp = $this->dbo->fetch_list("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$r['bcode']."' AND post_seq='".$r['seq']."'");
			for ($m = 0; $m < count($attc_list_tmp); $m++) {
				$attc_arr[$attc_list_tmp[$m]['file_num']] = $attc_list_tmp[$m];
			}

			if ($this->board_conf['upload_cnt'] > 0) {
				for ($m = 1; $m <= $this->board_conf['upload_cnt']; $m++) {
					$attc[$m]['게시판코드'] = $attc_arr[$m]['bcode'];
					$attc[$m]['고유키'] = $attc_arr[$m]['post_seq'];
					$attc[$m]['파일번호'] = $m;
					$attc[$m]['파일명'] = $attc_arr[$m]['file_ori'];
					$attc[$m]['파일경로'] = $attc_arr[$m]['path_base'].$attc_arr[$m]['path_sub'].$attc_arr[$m]['file_new'];
					$attc[$m]['다운로드링크'] = $_def['path_theme']."/user/download.php?mode=download&bcode=".$attc_arr[$m]['bcode']."&seq=".$attc_arr[$m]['post_seq']."&file_num=".$attc_arr[$m]['file_num'];
				}
				$tpl->assign('첨부파일', $attc);
			}

			$tpl->assign('포스트', $r);

		} else {

			$tpl->assign('mode', "insert");

			//글분류 정보
			$ct_conf_arr = explode(",",$this->board_conf['category_data']);
			for ($m = 0; $m < count($ct_conf_arr); $m++) {
				$ct_arr[$m]['분류명'] = $ct_conf_arr[$m];
			}
			$tpl->assign('글분류', $ct_arr);

			//첨부파일
			if ($this->board_conf['upload_cnt'] > 0) {

				for ($m = 1; $m <= $this->board_conf['upload_cnt']; $m++) {
					$attc[$m]['파일번호'] = $m;
				}
				$tpl->assign('첨부파일', $attc);
			}

			//추가필드
			$addfield = array();
			for ($m = 0; $m < count($_fset); $m++) {
				$addfield[$m]['필드명'] = $_fset[$m]['name'];
				$addfield[$m]['데이터'] = $cls_board->formset($_fset[$m], $sz, false, false);
			}
			$tpl->assign('추가필드', $addfield);
		}

		$tpl->assign('약관여부', $this->board_conf['assent_term_is']);
		$tpl->assign('약관내용', rt_dbstr_decode($this->board_conf['assent_term_txt']));

		$_def['skin'] = $skin_arr['skin_form'];
	break;

	case "view"	:

		if (is_numeric($this->env->_get['seq'])) {

			$_def['mode'] = "modify";

			$r = $this->dbo->fetch("SELECT * FROM ".$cls_board->db_tbl." WHERE seq='".$this->env->_get['seq']."'");

			//직접접속 방지
			if ($r['notice_is'] == "n") {
				if ($this->rtm->id == $r['userid'] && !empty($r['userid'])){}else {
					if ($this->env->_session['post_'.$this->board_info['theme'].'_'.$this->env->_get['seq']] != "y") {
						rt_js_move("올바른 접속이 아닙니다", "parent", "history", "-1");exit;
					}
				}
			}

			//추가 필드 데이터
			$sz = unserialize(html_entity_decode($r['extvar']));

			$addfield = array();
			for ($m = 0; $m < count($_fset); $m++) {
				$r['추가_'.$_fset[$m]['name']] = $cls_board->formset_data($_fset[$m], $sz);
				$addfield[$m]['필드명'] = $_fset[$m]['name'];
				$addfield[$m]['데이터'] = $cls_board->formset_data($_fset[$m], $sz);
			}
			$tpl->assign('추가필드', $addfield);

			foreach($r as $k => $v) $r[$k] = stripslashes($v);

			$r['고유키'] = $r['seq'];
			$r['분류'] = rt_dbstr_decode($r['category']);
			$r['아이디'] = $r['userid'];
			$r['작성자'] = rt_dbstr_decode($r['name']);
			$r['제목'] = rt_dbstr_decode($r['subject']);
			$r['휴대폰번호'] = rt_dbstr_decode($r['phone']);
			$r['내용'] = ($r['webeditor_is'] == "y")?rt_dbstr_decode($r['content']):nl2br(rt_dbstr_decode($r['content']));
			$r['답글여부'] = $r['reply_is'];
			$r['답글내용'] = rt_dbstr_decode($r['content_reply']);
			$r['작성일'] = substr($r['reg_date'],0,10);
			$r['수정일'] = substr($r['mod_date'],0,10);
			$r['조회수'] = number_format($r['hits']);
			$r['아이피'] = $r['user_ip'];
			$r['공지여부'] = $r['notice_is'];

			//댓글 목록
			if ($this->board_conf['comment_is'] == "y") {

				$cmt_add_qry = array();
				$cmt_add_qry[] = "bcode='".$this->bcode."'";
				$cmt_add_qry[] = "post_seq='".$r['seq']."'";

				$cmt_add_url.= "seq=".$r['seq'];
				$cmt_add_url.= "&cf=view";
				$cmt_add_url.= "&pg=".$this->env->_get['pg'];
				$cmt_add_url.= "#cmtarea";

				if (count($cmt_add_qry) > 0) {
					$cmt_str_add_qry = implode(" AND ", $cmt_add_qry);
					$cls_cmt->set_fix_where_qry($cmt_str_add_qry);
				}
				$cls_cmt->set_fix_url_val($cmt_add_url);
				$cls_cmt->init();

				$cmt_total = $cls_cmt->total_record_cnt;

				$cmt = $cls_cmt->get_list("ref DESC, re_step ASC");
				if (count($cmt) > 0) {
					for ($i = 0; $i < count($cmt); $i++) {

						foreach($cmt[$i] as $k => $v) $cmt[$i][$k] = stripslashes($v);

						$cmt[$i]['고유키'] = $cmt[$i]['seq'];
						$cmt[$i]['작성자'] = rt_dbstr_decode($cmt[$i]['name']);
						$cmt[$i]['아이디'] = $cmt[$i]['userid'];
						$cmt[$i]['작성일'] = substr($cmt[$i]['reg_date'], 0, 10);
						$cmt[$i]['작성시간'] = substr($cmt[$i]['reg_date'], 10, 10);
						$cmt[$i]['내용'] = nl2br(rt_dbstr_decode($cmt[$i]['content']));
						$cmt[$i]['아이피'] = $cmt[$i]['user_ip'];
					}
				}
			}

			$tpl->assign('댓글페이지인덱스', $cls_cmt->comment_page_index($this->env->_server['PHP_SELF']));
			$tpl->assign('전체댓글수', number_format($cmt_total));
			$tpl->assign('댓글', $cmt);

			//첨부파일
			if ($this->board_conf['upload_cnt'] > 0) {

				$attc = $this->dbo->fetch_list("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$r['bcode']."' AND post_seq=".$r['seq']);
				for ($m = 0; $m < count($attc); $m++) {
					$attc[$m]['게시판코드'] = $attc[$m]['bcode'];
					$attc[$m]['고유키'] = $attc[$m]['post_seq'];
					$attc[$m]['파일번호'] = $attc[$m]['file_num'];
					$attc[$m]['파일명'] = $attc[$m]['file_ori'];
					$attc[$m]['파일경로'] = $attc[$m]['path_base'].$attc[$m]['path_sub'].$attc[$m]['file_new'];
					$attc[$m]['다운로드수'] = $attc[$m]['download_hits'];
					$attc[$m]['다운로드링크'] = $_def['path_theme']."/user/download.php?mode=download&bcode=".$attc[$m]['bcode']."&seq=".$attc[$m]['post_seq']."&file_num=".$attc[$m]['file_num'];
				}
				$tpl->assign('첨부파일', $attc);
			}

			//내 글 여부
			$auth_my_is = false;
			if ($this->rtm->id == $r['userid'] && !empty($r['userid'])) {
				$auth_my_is = true;
			}

			if ($this->env->_get['pcd']) $addqry = "&pcd=".$this->env->_get['pcd'];
			if ($this->env->_get['pg']) $addqry.= "&pg=".$this->env->_get['pg'];

			$tpl->assign('수정페이지링크', "?cf=form&seq=".$r['seq'].$addqry);
			$tpl->assign('내글여부', $auth_my_is);
			$tpl->assign('포스트', $r);

			$_def['skin'] = $skin_arr['skin_view'];

		} else {
			rt_js_move("올바른 접근이 아닙니다.", "self", "href", "/");
		}
	break;
}
?>