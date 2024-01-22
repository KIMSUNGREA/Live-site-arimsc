<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: Q&A 테마, 사용자 출력 데이터
//-----------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

//-------------------------------------------------------------------------------------------------

/**
 * 추가 컴포넌트 로드
 */

rt_load_component("board,fileupload");

$cls_board = new board("RT_RTBOARD_QNA");
$cls_board->init();

//댓글
$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='rtboard'");

require_once RT_DOC_ROOT.$_app['app_path']."/controller/rtboard.comment.controller.php";
$cls_cmt = new rtboard_cmt();

//파일업로드
$cls_fu = new fileupload($env->_post['path_files']);

//-------------------------------------------------------------------------------------------------

if ($env->_request['pcd']) $addurl = "&pcd=".$env->_request['pcd'];
if ($env->_request['screen']) $addurl.= "&screen=".$env->_request['screen'];

//-------------------------------------------------------------------------------------------------

/**
 * 신규 게시물 등록
 */

$udata = array();

if ($env->_post['mode'] == "insert") {

	//보안문자 체크
	if (!$cls_rtm->is_login()) {
		if ($env->_post['sec_code'] != $env->_session['RT_CAPCHA']) {
			rt_js_msg("보안문자가 맞지 않습니다", "parent");
			?>
			<script>
				parent.$(".rt-button-tac").show();
			</script>
			<?
			exit;
		}
	}

	//게시판 환경 정보
	$_conf = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl."_CONF WHERE bcode='".$env->_post['bcode']."'");

	//파일 업로드 제한
	$total_size = 0;
	foreach ($env->_files as $k => $v) {
		$total_size+= $env->_files[$k]['size'];
	}
	$check_size = $total_size / 1000000;
	if ($check_size > $_conf['upload_size_limit']) {
		rt_js_msg("한번에 ".$_conf['upload_size_limit']."MB 이상 업로드할 수 없습니다");
		?>
		<script>
			parent.$(".rt-button-tac").show();
		</script>
		<?
		exit;
	}

	//DB 입력 데이터 설정
	if ($_conf['category_is'] == "y") {
		$udata['category'] = $env->_post['category'];
	}

	if (!empty($env->_post['post_pw'])) {
		$udata['post_pw'] = rt_password($env->_post['post_pw']);
	}

	$udata['bcode'			] = $env->_post['bcode'];
	$udata['userid'			] = $cls_rtm->id;
	$udata['name'			] = $env->_post['name'];
	$udata['phone'			] = $env->_post['phone'];
	$udata['subject'		] = $env->_post['subject'];
	$udata['content'		] = $env->_post['content'];
	$udata['reg_date'		] = date("Y-m-d H:i:s");
	$udata['user_ip'		] = $env->_server['REMOTE_ADDR'];
	$udata['give_en'		] = "n";

	/* 추가 폼 데이터 처리 S */
	$arSz = array();
	foreach ($env->_post as $k => $v)
	{
		$arK = null;
		$arFV = null;

		$arK = explode("_", $k);

		if (is_numeric($arK[2])) {
			$arFV = $dbo->fetch("SELECT * FROM RT_RTBOARD_ADD_FIELD WHERE seq='".$arK[2]."'");
		}

		if ($arK[0] == "rtfeild") {

			$arSz[$arK[2]]['type'] = $arFV['type'];
			$arSz[$arK[2]]['name'] = $arFV['name'];

			if ($arFV['type'] == "checkbox") {
				$arSz[$arK[2]]['val'][$arK[3]] = $v;
			} else {
				$arSz[$arK[2]]['val'] = $v;
			}
		}
	}
	$udata['extvar'] = serialize($arSz);
	/* 추가 폼 데이터 처리 E */

	if($cls_board->insert($udata)) {

		$post_seq = $cls_board->insert_seq;

		//보유쿠폰 차감 - 종류는 상관없이 1개
		$user = $cls_rtm->get_member_info();
		$req = $dbo->fetch_list("SELECT * FROM RT_COUPON WHERE user_id='".$user['user_id']."' AND use_is='n'");
		if (count($req) > 0) {
			$_r = $req[0];

			$dbo->query("UPDATE RT_COUPON SET use_is='y' WHERE seq='".$_r['seq']."'");
		}

		//파일 업로드
		for ($m = 1; $m <= $_conf['upload_cnt']; $m++) {

			$upres = "";
			if (!empty($env->_files['file'.$m]['name'])) {
				$upres = $cls_fu->upload($env->_files['file'.$m],"/qna");
				$upload['bcode'			] = $env->_post['bcode'];
				$upload['post_seq'		] = $post_seq;
				$upload['file_num'		] = $m;
				$upload['path_base'		] = $upres['path_base'];
				$upload['path_sub'		] = $upres['path_sub'];
				$upload['file_ori'		] = $upres['name'];
				$upload['file_new'		] = $upres['name_new'];
				$upload['file_size'		] = $upres['size'];
				$upload['file_ext'		] = $upres['ext'];
				$upload['download_hits'	] = 0;
				$upload['upload_date'	] = date("Y-m-d H:i:s");
				$dbo->insert("RT_RTBOARD_FILES", $upload);
			}
		}

		rt_js_move("글이 등록되었습니다.", "parent", "href", $rt_conf_db['ssl_url_n'].$env->_post['php_self']."?cf=list".$addurl);
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

//-------------------------------------------------------------------------------------------------

/**
 * 게시글 수정
 */
} else if($env->_post['mode'] == "modify" && is_numeric($env->_post['seq'])) {

	//게시판 환경 정보
	$_conf = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl."_CONF WHERE bcode='".$env->_post['bcode']."'");

	//수정할 게시물 정보
	$r = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl." WHERE seq=".$env->_post['seq']);

	//파일 업로드 제한
	$total_size = 0;
	foreach ($env->_files as $k => $v) {
		$total_size+= $env->_files[$k]['size'];
	}
	$check_size = $total_size / 1000000;
	if ($check_size > $_conf['upload_size_limit']) {
		rt_js_msg("한번에 ".$_conf['upload_size_limit']."MB 이상 업로드할 수 없습니다");
		?>
		<script>
			parent.$("#btn-form-submit").show();
			parent.$("#btn-list").show();
		</script>
		<?
		exit;
	}

	//첨부파일 삭제
	for ($m = 1; $m <= $_conf['upload_cnt']; $m++) {
		if ($env->_post['attc_del'.$m.'_is'] == "y") {
			$f = $dbo->fetch("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$env->_post['bcode']."' AND post_seq=".$env->_post['seq']." AND file_num=".$m);
			if ($f['file_ori']) {
				rt_file_delete($env->_post['path_files'],"/qna/".$f['file_new']);
				$dbo->query("DELETE FROM RT_RTBOARD_FILES WHERE bcode='".$env->_post['bcode']."' AND post_seq=".$env->_post['seq']." AND file_num=".$m);
			}
		}
	}

	//DB 입력 데이터 설정
	if ($_conf['category_is'] == "y") {
		$udata['category'] = $env->_post['category'];
	}

	if (!empty($env->_post['post_pw'])) {
		$udata['post_pw'] = rt_password($env->_post['post_pw']);
	}

	$udata['name'			] = $env->_post['name'];
	$udata['subject'		] = $env->_post['subject'];
	$udata['content'		] = $env->_post['content'];
	$udata['phone'			] = $env->_post['phone'];
	$udata['mod_date'		] = date("Y-m-d H:i:s");
	$udata['user_ip'		] = $env->_server['REMOTE_ADDR'];

	/* 추가 폼 데이터 처리 S */
	$arSz = array();
	foreach ($env->_post as $k => $v)
	{
		$arK = null;
		$arFV = null;

		$arK = explode("_", $k);

		if (is_numeric($arK[2])) {
			$arFV = $dbo->fetch("SELECT * FROM RT_RTBOARD_ADD_FIELD WHERE seq='".$arK[2]."'");
		}

		if ($arK[0] == "rtfeild") {

			$arSz[$arK[2]]['type'] = $arFV['type'];
			$arSz[$arK[2]]['name'] = $arFV['name'];

			if ($arFV['type'] == "checkbox") {
				$arSz[$arK[2]]['val'][$arK[3]] = $v;
			} else {
				$arSz[$arK[2]]['val'] = $v;
			}
		}
	}

	$udata['extvar'] = serialize($arSz);
	/* 추가 폼 데이터 처리 E */

	if ($cls_board->update($udata, "seq='".$env->_post['seq']."'")) {

		$post_seq = $env->_post['seq'];

		//파일 업로드
		for ($m = 1; $m <= $_conf['upload_cnt']; $m++) {

			$upres = "";
			if (!empty($env->_files['file'.$m]['name'])) {
				$f = $dbo->fetch("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$env->_post['bcode']."' AND post_seq=".$env->_post['seq']." AND file_num=".$m);
				if ($f['file_ori']) {
					rt_file_delete($env->_post['path_files'],"/qna/".$f['file_new']);
					$dbo->query("DELETE FROM RT_RTBOARD_FILES WHERE bcode='".$env->_post['bcode']."' AND post_seq=".$env->_post['seq']." AND file_num=".$m);
				}
				$upres = $cls_fu->upload($env->_files['file'.$m],"/qna");
				$upload['bcode'			] = $env->_post['bcode'];
				$upload['post_seq'		] = $post_seq;
				$upload['file_num'		] = $m;
				$upload['path_base'		] = $upres['path_base'];
				$upload['path_sub'		] = $upres['path_sub'];
				$upload['file_ori'		] = $upres['name'];
				$upload['file_new'		] = $upres['name_new'];
				$upload['file_size'		] = $upres['size'];
				$upload['file_ext'		] = $upres['ext'];
				$upload['download_hits'	] = 0;
				$upload['upload_date'	] = date("Y-m-d H:i:s");
				$dbo->insert("RT_RTBOARD_FILES", $upload);
			}
		}

		//검색 페이지, 검색어
		$add_url.= $addurl;
		if (is_numeric($env->_post['pg'])) $add_url.= "&pg=".$env->_post['pg'];
		if ($env->_post['ct']) $add_url.= "&ct=".urlencode($env->_post['ct']);
		if (!empty($env->_post['searchstring'])) $add_url.= "&search=".$env->_post['search']."&searchstring=".$env->_post['searchstring'];

		rt_js_move("", "parent", "href", $rt_conf_db['ssl_url_n'].$env->_post['php_self']."?cf=view&seq=".$env->_post['seq'].$addurl);
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

//-------------------------------------------------------------------------------------------------

/**
 * 보기 페이지 접근 인증
 */
} else if($env->_post['mode'] == "view_move" && is_numeric($env->_post['seq'])) {

	$r = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl." WHERE seq=".$env->_post['seq']);

	if ($env->_post['type'] != "list") {

		if (empty($env->_post['view_pwd'])) {
			rt_js_msg("비밀번호를 입력해 주세요");exit;
		}

		$checkpwd = rt_password($env->_post['view_pwd']);

		if ($r['post_pw'] != $checkpwd) {
			rt_js_msg("비밀번호가 맞지 않습니다.");exit;
		}
	}

	//직접 접속 방지(최근 인증된 1개 게시물만 직접 접속 허용)
	$_SESSION['post_'.$env->_post['theme'].'_'.$env->_post['seq']] = "y";

	//검색 페이지, 검색어
	$add_url.= $addurl;
	if (is_numeric($env->_post['pg'])) $add_url.= "&pg=".$env->_post['pg'];
	if ($env->_post['ct']) $add_url.= "&ct=".urlencode($env->_post['ct']);
	if (!empty($env->_post['searchstring'])) $add_url.= "&search=".$env->_post['search']."&searchstring=".$env->_post['searchstring'];

	rt_js_move("", "parent", "href", $rt_conf_db['ssl_url_n'].$env->_post['php_self']."?cf=view&seq=".$env->_post['seq'].$addurl);

//-------------------------------------------------------------------------------------------------

/**
 * 게시글 삭제
 */
} else if($env->_post['mode'] == "delete" && is_numeric($env->_post['seq'])) {

	//삭제할 게시물 정보
	$r = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl." WHERE seq=".$env->_post['seq']);

	//직접접속 방지
	if ($cls_rtm->id == $r['userid'] && !empty($r['userid'])){}else {
		if ($env->_session['post_'.$env->_post['theme'].'_'.$env->_post['seq']] != "y") {
			rt_js_msg("올바른 접속이 아닙니다");exit;
		}
	}

	if ($dbo->query("DELETE FROM ".$cls_board->db_tbl." WHERE seq='".$r['seq']."'")) {

		//삭제할 첨부파일 정보
		$fr = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$r['bcode']."' AND post_seq=".$r['seq']);

		$dbo->query("DELETE FROM RT_RTBOARD_FILES WHERE bcode='".$r['bcode']."' AND post_seq='".$r['seq']."'");

		//실제 첨부파일 삭제
		for ($m = 0; $m < count($fr); $m++) {
			$target_file = RT_DOC_ROOT.$fr[$m]['path_base'].$fr[$m]['path_sub'].$fr[$m]['file_new'];
			if (is_file($target_file)) {
				@unlink($target_file);
			}
		}

		//게시물 댓글 삭제
		$dbo->query("DELETE FROM RT_RTBOARD_CMT WHERE bcode='".$r['bcode']."' AND post_seq='".$r['seq']."'");

		//페이지 및 검색어 유지
		$add_url.= $addurl;
		if (is_numeric($env->_post['pg'])) $add_url.= "&pg=".$env->_post['pg'];
		if ($env->_post['ct']) $add_url.= "&ct=".urlencode($env->_post['ct']);
		if (!empty($env->_post['searchstring'])) $add_url.= "&search=".$env->_post['search']."&searchstring=".$env->_post['searchstring'];
		
		rt_js_move("글이 삭제되었습니다.", "parent", "href", $rt_conf_db['ssl_url_n'].$env->_post['php_self']."?".$addurl);
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

//-------------------------------------------------------------------------------------------------

/**
 * 첨부파일 다운로드
 */
} else if($env->_get['mode'] == "download" && $env->_get['bcode'] && is_numeric($env->_get['seq']) && is_numeric($env->_get['file_num'])) {

	$f = $dbo->fetch("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$env->_get['bcode']."' AND post_seq=".$env->_get['seq']." AND file_num=".$env->_get['file_num']);
	rt_download($f['file_new'], $f['file_ori'], $f['path_base'].$f['path_sub']);

//-------------------------------------------------------------------------------------------------

/**
 * 신규 댓글 입력
 */
} else if ($env->_post['mode'] == "cmt_insert") {

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

//-------------------------------------------------------------------------------------------------

/**
 * 댓글 삭제
 */
} else if ($env->_post['mode'] == "cmt_delete" && is_numeric($env->_post['seq'])) {

	$cmt = $dbo->fetch("SELECT * FROM RT_RTBOARD_CMT WHERE seq=".$env->_post['seq']);

	//삭제 체크
	if (!empty($cmt['userid'])) {

		//회원 권한 댓글
		if ($cmt['userid'] == "master" || $cmt['userid'] == "admin") {

			//관리자 댓글
			rt_js_msg("본인 글만 삭제할 수 있습니다.");exit;
		} else {

			//회원 댓글
			if ($env->_post['id'] != $cmt['userid']) {
				rt_js_msg("본인 글만 삭제할 수 있습니다.");exit;
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

//-------------------------------------------------------------------------------------------------

/**
 * 댓글의 답글 달기
 */
} else if ($env->_post['mode'] == "cmt_reply" && is_numeric($env->_post['seq'])) {

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

//-------------------------------------------------------------------------------------------------

/**
 * 보안문자
 */
} else if ($env->_post['mode'] == "capcha") {

	$capcha = rt_random_code();
	$_SESSION['RT_CAPCHA'] = $capcha[2];
	$randstr = "<b>".$capcha[0].", ".$capcha[1]."</b> 둘 중 큰 수를 입력해 주세요";

	?>var rand_str = '<?php echo $randstr;?>';<?
} else {
	rt_js_move("접속오류입니다. 다시 접속해 주세요", "parent", "href", "/");
}

exit;
?>