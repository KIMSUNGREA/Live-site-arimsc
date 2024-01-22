<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 제품 모듈 출력
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

/**
 * 공동 데이터
 */

$_def = array();
$_def['path_app'] = $this->app['app_path'];
$_def['path_user'] = $_def['path_app']."/user";
$_def['path_assets'] = $_def['path_app']."/assets";
$_def['path_tpl'] = $_def['path_app']."/template";
$_def['func'] = ($this->env->_get['cf']) ? $this->env->_get['cf'] : "list";

$tpl->assign('이동화면', $this->cls_pg->conn_screen);
$tpl->assign('php_self', $this->env->_server['PHP_SELF']);
$tpl->assign('path_user', $_def['path_user']);
$tpl->assign('path_assets', $_def['path_assets']);

//-------------------------------------------------------------------------------------------------

/**
 * 게시판 환경 데이터
 */

$add_qry = array(); //DB 쿼리 배열
$add_url = ""; //전달 변수 배열

//고정 DB 쿼리
$add_qry[] = "parent='".$ct['parent']."'";

if (!empty($this->c)) {
	$add_qry[] = "cate='".$this->c."'";
	$add_url.= "&c=".$this->c;
}

if (!empty($this->env->_get['pg'])) {
	$add_pg_url = "&pg=".$this->env->_get['pg'];
}

//변동 쿼리
if ($this->env->_get['search'] && $this->env->_get['searchstring']) {
	$add_qry[] = "(".$this->env->_get['search']." LIKE '%".$this->env->_get['searchstring']."%')";
	$add_url.= "&search=".$this->env->_get['search']."&searchstring=".$this->env->_get['searchstring'];
}

if (count($add_qry) > 0) {
	$str_add_qry = implode(" AND ", $add_qry);
	$this->cls_board->set_fix_where_qry($str_add_qry);
}
$this->cls_board->set_fix_url_val($add_url);
$this->cls_board->init();

//-------------------------------------------------------------------------------------------------

/**
 * 분류 데이터
 */

$ctl = $this->dbo->fetch_list("SELECT * FROM RT_CATEGORY WHERE groupcode='PRODUCT' AND parent='".$ct['parent']."' ORDER BY sort ASC");

$cdata = array();
for ($m = 0; $m < count($ctl); $m++) {

	$pcc = $this->dbo->fetch("SELECT * FROM RT_PRODUCT_CATE_CONF WHERE code='".$ctl[$m]['code']."'");

	$cdata[$m]['분류코드'] = $ctl[$m]['code'];
	$cdata[$m]['분류명'] = $ctl[$m]['label'];
	$cdata[$m]['분류사용여부'] = $ct_conf['use_is'];
	$cdata[$m]['페이지구성타입'] = $ct_conf['type_en'];
	$cdata[$m]['active'] = ($ctl[$m]['code'] == $this->env->_get['c']) ? "active":"";
	$cdata[$m]['selected'] = ($ctl[$m]['code'] == $this->env->_get['c']) ? "selected='selected'":"";
	$cdata[$m]['분류이동링크'] = "?".$add_url;
}
$tpl->assign('제품분류', $cdata);

//분류 대표 이미지
$tpl->assign('분류대표이미지명', $ct_conf['cate_img_new']);
$cate_img_src = $ct_conf['cate_img_dir'].$ct_conf['cate_img_new'];
if (is_file(RT_DOC_ROOT.$cate_img_src)) {
	$tpl->assign('분류대표이미지경로', $cate_img_src);
}

//현재 분류 정보
$tpl->assign('분류명', $ct['label']);
$tpl->assign('분류코드', $ct['code']);
$tpl->assign('페이지구성', $ct_conf['type_en']);

//-------------------------------------------------------------------------------------------------

/**
 * 현재 페이지 네비게이션
 */

$navi_cnt = count($this->cls_ct->data) - 1;
for ($m = $navi_cnt; $m >= 0; $m--) {
	$navi_str.= " > ".$this->cls_ct->data[$m];
}

$tpl->assign('현재카테고리', $navi_str);

//-------------------------------------------------------------------------------------------------



/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "list"	:

		//접근 권한
		if (!$this->check_auth("list",$this->c)) {
			if ($this->rtm->is_login()) {
				rt_js_move("이용권한이 없습니다.", "self", "href", "/");
			} else {
				rt_js_move("", "self", "href", $this->_rtm_conf['login_set_page']."?prepage=".urlencode($this->env->_server['PHP_SELF']));
			}
			exit;
		}

		//리스트 데이터 설정
		if ($this->cls_board->list_rec_cnt > 0)
		{
			$num = $this->cls_board->list_rec_cnt;
			$_l = $this->cls_board->get_list("ord ASC,reg_date DESC");

			for ($i = 0; $i < count($_l); $i++)
			{
				$_l[$i]['번호'] = $num;
				$_l[$i]['분류코드'] = rt_dbstr_decode($_l[$i]['cate']);
				$_l[$i]['제품명'] = rt_dbstr_decode($_l[$i]['pdt_name']);
				$_l[$i]['줄임제품명'] = rt_str_length_cut($_l[$i]['제품명'],$this->pdt_conf['subject_cut_length'],"..");
				$_l[$i]['모바일줄임제품명'] = rt_str_length_cut($_l[$i]['제품명'],$this->pdt_conf['subject_cut_length_m'],"..");
				$_l[$i]['옵션명1'] = rt_dbstr_decode($_l[$i]['opt_tit1']);
				$_l[$i]['옵션명2'] = rt_dbstr_decode($_l[$i]['opt_tit2']);
				$_l[$i]['옵션명3'] = rt_dbstr_decode($_l[$i]['opt_tit3']);
				$_l[$i]['옵션명4'] = rt_dbstr_decode($_l[$i]['opt_tit4']);
				$_l[$i]['옵션1'] = rt_dbstr_decode($_l[$i]['opt1']);
				$_l[$i]['옵션2'] = rt_dbstr_decode($_l[$i]['opt2']);
				$_l[$i]['옵션3'] = rt_dbstr_decode($_l[$i]['opt3']);
				$_l[$i]['옵션4'] = rt_dbstr_decode($_l[$i]['opt4']);

				$vopt_tit = unserialize(html_entity_decode($_l[$i]['vopt_tit']));
				$vopt_val = unserialize(html_entity_decode($_l[$i]['vopt_val']));

				$vcnt = 1;
				for ($m = 0; $m <= count($vopt_tit); $m++) {
					$_l[$i]['가상옵션명'.$vcnt] = $vopt_tit[$m];
					$_l[$i]['가상옵션'.$vcnt] = $vopt_val[$m];
					$vcnt++;
				}

				$_l[$i]['상세내용'] = rt_dbstr_decode($_l[$i]['detail_cont']);
				$_l[$i]['줄임상세내용'] = rt_str_length_cut(strip_tags(nl2br($_l[$i]['상세내용'])), 380, "..");
				$_l[$i]['등록일'] = str_replace("-",".",substr($_l[$i]['reg_date'], 0, 10));
				$_l[$i]['상세페이지링크'] = "?cf=view&seq=".$_l[$i]['seq'].$add_url.$add_pg_url;

				//리스트 썸네일
				$_l[$i]['list_img_src'] = "";
				if ($this->pdt_conf['img_thumb_is'] == "y" && $_l[$i]['list_img_thumb']) {
					$_l[$i]['list_img_src'] = $_l[$i]['list_img_dir']."thumb/".$_l[$i]['list_img_thumb'];
				} else {
					$_l[$i]['list_img_src'] = $_l[$i]['list_img_dir'].$_l[$i]['list_img_new'];
				}

				if (!is_file(RT_DOC_ROOT.$_l[$i]['list_img_src'])) {
					$_l[$i]['list_img_src'] = $_def['path_theme']."/user/files/no_img.png";
				}

				$_l[$i]['목록이미지경로'] = $_l[$i]['list_img_src'];

				//아이콘 설정
				$_l[$i]['새글아이콘'] = (rt_is_new_post($_l[$i]['reg_date'], $this->pdt_conf['post_new_period'])) ? "<span><img src='".$_def['path_app']."/assets/img/board_new.png' alt='새로 등록된 글'/></span>":"";

				$num--;
			}
		}

		if ($ct_conf['type_en'] == "img") {
			$__file_path = RT_DOC_ROOT.$ct_conf['cont_img_dir'].$ct_conf['cont_img_new'];
			if (is_file($__file_path)) {
				$tpl->assign('분류콘텐츠이미지', $ct_conf['cont_img_dir'].$ct_conf['cont_img_new']);
			}
		} else if ($ct_conf['type_en'] == "html") {
			$tpl->assign('분류페이지HTML', rt_dbstr_decode($ct_conf['cont_html']));
		}

		$tpl->assign('페이지인덱스', $this->page_index($this->env->_server['PHP_SELF']));
		$tpl->assign('제품리스트', $_l);
		$tpl->assign('게시물수', $this->cls_board->total_record_cnt);

		$_def['skin'] = $skin_arr['skin_list'];
	break;

	case "view"	:

		//접근 권한
		if (!$this->check_auth("read",$this->c)) {
			if ($this->rtm->is_login()) {
				rt_js_move("이용권한이 없습니다.", "self", "href", "/");
			} else {
				rt_js_move("", "self", "href", $this->_rtm_conf['login_set_page']."?prepage=".urlencode($this->env->_server['PHP_SELF']));
			}
			exit;
		}

		if (is_numeric($this->env->_get['seq'])) {

			$r = $this->dbo->fetch("SELECT * FROM RT_PRODUCT WHERE seq='".$this->env->_get['seq']."'");
			$_cate_conf = $this->dbo->fetch("SELECT * FROM RT_PRODUCT_CATE_CONF WHERE code='".$r['cate']."'");

			$r['고유키'] = $r['seq'];
			$r['분류코드'] = rt_dbstr_decode($r['cate']);
			$r['제품명'] = rt_dbstr_decode($r['pdt_name']);
			$r['옵션명1'] = rt_dbstr_decode($r['opt_tit1']);
			$r['옵션명2'] = rt_dbstr_decode($r['opt_tit2']);
			$r['옵션명3'] = rt_dbstr_decode($r['opt_tit3']);
			$r['옵션명4'] = rt_dbstr_decode($r['opt_tit4']);
			$r['옵션1'] = rt_dbstr_decode($r['opt1']);
			$r['옵션2'] = rt_dbstr_decode($r['opt2']);
			$r['옵션3'] = rt_dbstr_decode($r['opt3']);
			$r['옵션4'] = rt_dbstr_decode($r['opt4']);
			$r['상세내용'] = rt_dbstr_decode($r['detail_cont']);
			$r['페이지구성'] = rt_dbstr_decode($r['type_en']);
			$r['페이지HTML'] = rt_dbstr_decode($r['pdt_html']);

			$vopt_tit = unserialize(html_entity_decode($r['vopt_tit']));
			$vopt_val = unserialize(html_entity_decode($r['vopt_val']));

			$vcnt = 1;
			for ($m = 0; $m <= count($vopt_tit); $m++) {
				$r['가상옵션명'.$vcnt] = $vopt_tit[$m];
				$r['가상옵션'.$vcnt] = $vopt_val[$m];
				$vcnt++;
			}

			//목록 이미지
			$r['목록이미지'] = $r['list_img_new'];
			$r['목록이미지썸네일'] = $r['list_img_thumb'];
			$r['목록이미지파일명'] = $r['list_img_ori'];

			$list_img_src = $r['list_img_dir'].$r['list_img_new'];
			if (is_file(RT_DOC_ROOT.$list_img_src)) {
				$r['목록이미지경로'] = $list_img_src;
			}

			//콘텐츠 이미지
			$r['콘텐츠이미지'] = $r['pdt_img_new'];
			$r['콘텐츠이미지파일명'] = $r['pdt_img_ori'];

			$pdt_img_src = $r['pdt_img_dir'].$r['pdt_img_new'];
			if (is_file(RT_DOC_ROOT.$pdt_img_src)) {
				$r['콘텐츠이미지경로'] = $pdt_img_src;
			}

			//이전제품 다음제품 데이터
			$arr_prev = $this->prev_post($this->env->_get['seq'],$r['cate']);
			$arr_next = $this->next_post($this->env->_get['seq'],$r['cate']);

			$r['이전제품번호'] = $arr_prev['seq'];
			$r['이전제품제목'] = rt_str_length_cut(rt_dbstr_decode($arr_prev['subject']),$this->pdt_conf['subject_cut_length'],"..");
			if ($arr_prev['result']) {
				$r['이전제품링크'] = "?cf=view&seq=".$arr_prev['seq'].$add_url.$add_pg_url;
			} else {
				$r['이전제품링크'] = "#;";
			}
			$r['다음제품번호'] = $arr_next['seq'];
			$r['다음제품제목'] = rt_str_length_cut(rt_dbstr_decode($arr_next['subject']),$this->pdt_conf['subject_cut_length'],"..");
			if ($arr_next['result']) {
				$r['다음제품링크'] = "?cf=view&seq=".$arr_next['seq'].$add_url.$add_pg_url;
			} else {
				$r['다음제품링크'] = "#;";
			}

			//상세 이미지 파일
			if ($this->pdt_conf['upload_img_cnt'] > 0) {

				$attc_img = $this->dbo->fetch_list("SELECT * FROM RT_PRODUCT_FILES WHERE pdt_seq='".$r['seq']."' AND file_type='img' ORDER BY file_num ASC");
				for ($m = 0; $m < count($attc_img); $m++) {
					$attc_img[$m]['고유키'] = $attc_img[$m]['pdt_seq'];
					$attc_img[$m]['파일번호'] = $attc_img[$m]['file_num'];
					$attc_img[$m]['파일명'] = $attc_img[$m]['file_ori'];
					$attc_img[$m]['이미지여부'] = rt_is_image($attc_img[$m]['file_new'],$attc_img[$m]['path_base'].$attc_img[$m]['path_sub']);
					$attc_img[$m]['이미지경로'] = $attc_img[$m]['path_base'].$attc_img[$m]['path_sub'].$attc_img[$m]['file_new'];
					$attc_img[$m]['썸네일이미지경로'] = $attc_img[$m]['path_base'].$attc_img[$m]['path_sub']."thumb/".$attc_img[$m]['file_thumb'];
					$attc_img[$m]['다운로드수'] = $attc_img[$m]['download_hits'];
					$attc_img[$m]['다운로드링크'] = $_def['path_user']."/download.php?mode=download&file_type=img&pdt_seq=".$attc_img[$m]['pdt_seq']."&file_num=".$attc_img[$m]['file_num'];
				}
				$tpl->assign('상세이미지', $attc_img);
			}
			$r['상세이미지본문사용'] = $r['detail_img_cont_is'];

			//첨부파일
			if ($this->pdt_conf['upload_file_cnt'] > 0) {

				$attc = $this->dbo->fetch_list("SELECT * FROM RT_PRODUCT_FILES WHERE pdt_seq='".$r['seq']."' AND file_type='file' ORDER BY file_num ASC");
				for ($m = 0; $m < count($attc); $m++) {
					$attc[$m]['고유키'] = $attc[$m]['pdt_seq'];
					$attc[$m]['파일번호'] = $attc[$m]['file_num'];
					$attc[$m]['파일명'] = $attc[$m]['file_ori'];
					$attc[$m]['이미지여부'] = rt_is_image($attc[$m]['file_new'],$attc[$m]['path_base'].$attc[$m]['path_sub']);
					$attc[$m]['파일경로'] = $attc[$m]['path_base'].$attc[$m]['path_sub'].$attc[$m]['file_new'];
					$attc[$m]['다운로드수'] = $attc[$m]['download_hits'];
					$attc[$m]['다운로드링크'] = $_def['path_user']."/download.php?mode=download&file_type=file&pdt_seq=".$attc[$m]['pdt_seq']."&file_num=".$attc[$m]['file_num'];
				}
				$tpl->assign('첨부파일', $attc);
			}

			$tpl->assign('목록가기링크', "?".$add_url.$add_pg_url);
			$tpl->assign('제품정보', $r);

			$_def['skin'] = $skin_arr['skin_view'];

		} else {
			rt_js_move("잘못된 접근입니다.", "self", "history", "-1");
		}
	break;
}
?>