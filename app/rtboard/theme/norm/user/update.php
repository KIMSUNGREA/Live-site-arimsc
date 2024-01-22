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

rt_load_component("board,fileupload,thumbnail");

$cls_board = new board("RT_RTBOARD_NORM");
$cls_board->init();

//댓글
$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='rtboard'");

require_once RT_DOC_ROOT.$_app['app_path']."/controller/rtboard.comment.controller.php";
$cls_cmt = new rtboard_cmt();

//파일업로드
$cls_fu = new fileupload($env->_post['path_files']);
$cls_thumb = new thumbnail();

//-------------------------------------------------------------------------------------------------

if ($env->_request['pcd']) $addurl = "&pcd=".$env->_request['pcd'];
if ($env->_request['screen']) $addurl.= "&screen=".$env->_request['screen'];
if ($env->_request['ct']) $addurl = "&ct=".$env->_request['ct'];

//-------------------------------------------------------------------------------------------------

/**
 * 신규 게시물 등록
 */

$udata = array();//업데이트 데이터

if ($env->_post['mode'] == "insert") {

	if (!$cls_rtm->is_login()) {
		//보안문자 체크
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

	$env->_post['serial_num'] = trim($env->_post['serial_num']);
	$env->_post['serial_num'] = str_replace(" ","",$env->_post['serial_num']);
	$env->_post['serial_num'] = strtoupper($env->_post['serial_num']);

	//시리얼 유효성 확인 
	$srn = $dbo->fetch("SELECT serial_num FROM RT_SERIAL WHERE serial_num='".$env->_post['serial_num']."'");
	if (!$srn['serial_num']) {
		rt_js_move("유효한 시리얼번호가 아닙니다.","parent","reload");
		exit;
	}

	//이미 등록된 시리얼인지 확인
	$user = $cls_rtm->get_member_info();
	$cnta = $dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_COUPON WHERE serial_num='".$env->_post['serial_num']."'");

	if ($cnta['cnt'] > 0) {
		rt_js_move("사용할 수 없는 시리얼번호입니다.","parent","reload");
		exit;
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

	$udata['bcode'				] = $env->_post['bcode'];
	$udata['userid'				] = $cls_rtm->id;
	$udata['name'				] = $env->_post['name'];
	$udata['subject'			] = $env->_post['subject'];
	$udata['content'			] = $env->_post['content'];
	$udata['list_img_cont_is'	] = ($env->_post['list_img_cont_is']=="y") ? "y":"n";
	$udata['webeditor_is'		] = $env->_post['webeditor_is'];
	$udata['hits'				] = 0;
	$udata['reg_date'			] = date("Y-m-d H:i:s");
	$udata['notice_is'			] = "n";
	$udata['user_ip'			] = $env->_server['REMOTE_ADDR'];

	$udata['sns_url'			] = $env->_post['sns_url'];
	$udata['pdt_model'			] = $env->_post['pdt_model'];
	$udata['serial_num'			] = $env->_post['serial_num'];
	$udata['recode'				] = $env->_post['recode'];
	$udata['rating_en'			] = $env->_post['rating_en'];

	//대표(목록)이미지 설정
	if (!empty($env->_files['list_img']['name']) && $_conf['list_img_is'] == "y") {

		$uplist = $cls_fu->upload($env->_files['list_img'],"/norm");

		$udata['list_img_dir'] = $uplist['path_base'].$uplist['path_sub'];
		$udata['list_img_new'] = $uplist['name_new'];
		$udata['list_img_ori'] = $uplist['name'];

		if ($_conf['list_img_thumb_is'] == "y") {
			$udata['list_img_thumb'] = $cls_thumb->resize_image($udata['list_img_new'], $uplist['ext'], $udata['list_img_dir'], $_conf['list_img_thumb_w'], $_conf['list_img_thumb_h']);
		}
	}

	//계층정보설정
	$r = $dbo->fetch("SELECT MAX(ref) AS ref FROM ".$cls_board->db_tbl);
	$udata['ref'			] = $r['ref'] + 1;
	$udata['re_step'		] = 0;
	$udata['re_level'		] = 0;

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

		//파일 업로드
		for ($m = 1; $m <= $_conf['upload_cnt']; $m++) {

			$upres = "";
			if (!empty($env->_files['file'.$m]['name'])) {
				$upres = $cls_fu->upload($env->_files['file'.$m],"/norm");
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

		//구매고객으로 등록
		$dbo->query("UPDATE RT_RTMEMBER SET buy_en='y' WHERE user_id='".$cls_rtm->id."'");

		if ($env->_post['bcode'] == "review") {
			$msg = "글이 등록되었습니다.\\n운영자 승인후 노출되니 참고해 주세요.\\n참여해 주셔서 감사합니다.";
		} else {
			$msg = "글이 등록되었습니다.";
		}
		
		rt_js_move($msg, "parent", "href", $rt_conf_db['ssl_url_n'].$env->_post['php_self']."?cf=list".$addurl);
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

//-------------------------------------------------------------------------------------------------

/**
 * 게시물 수정
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
			$(".rt-button-tac").show();
		</script>
		<?
		exit;
	}

	//대표(목록) 이미지 삭제
	if ($env->_post['list_img_del_is'] == "y") {
		if ($r['list_img_new']) {
			rt_file_delete($r['list_img_dir'],$r['list_img_new']);
			rt_file_delete($r['list_img_dir']."thumb/",$r['list_img_thumb']);
			$dbo->query("UPDATE ".$cls_board->db_tbl." SET list_img_dir='', list_img_new='', list_img_ori='', list_img_thumb='' WHERE seq='".$env->_post['seq']."'");
		}
	}

	//첨부파일 삭제
	for ($m = 1; $m <= $_conf['upload_cnt']; $m++) {
		if ($env->_post['attc_del'.$m.'_is'] == "y") {
			$f = $dbo->fetch("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$env->_post['bcode']."' AND post_seq=".$env->_post['seq']." AND file_num=".$m);
			if ($f['file_ori']) {
				rt_file_delete($env->_post['path_files'],"/norm/".$f['file_new']);
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

	$udata['name'				] = $env->_post['name'];
	$udata['subject'			] = $env->_post['subject'];
	$udata['content'			] = $env->_post['content'];
	$udata['list_img_cont_is'	] = ($env->_post['list_img_cont_is']=="y") ? "y":"n";
	$udata['webeditor_is'		] = $env->_post['webeditor_is'];
	$udata['mod_date'			] = date("Y-m-d H:i:s");
	$udata['user_ip'			] = $env->_server['REMOTE_ADDR'];

	$udata['sns_url'			] = $env->_post['sns_url'];
	$udata['pdt_model'			] = $env->_post['pdt_model'];
	$udata['serial_num'			] = $env->_post['serial_num'];
	$udata['recode'				] = $env->_post['recode'];
	$udata['rating_en'			] = $env->_post['rating_en'];

	//대표(목록)이미지 설정
	if (!empty($env->_files['list_img']['name']) && $_conf['list_img_is'] == "y") {

		if ($r['list_img_new']) {
			rt_file_delete($r['list_img_dir'],$r['list_img_new']);
			rt_file_delete($r['list_img_dir']."thumb/",$r['list_img_thumb']);
			$dbo->query("UPDATE ".$cls_board->db_tbl." SET list_img_dir='', list_img_new='', list_img_ori='', list_img_thumb='' WHERE seq='".$env->_post['seq']."'");
		}

		$uplist = $cls_fu->upload($env->_files['list_img'],"/norm");

		$udata['list_img_dir'] = $uplist['path_base'].$uplist['path_sub'];
		$udata['list_img_new'] = $uplist['name_new'];
		$udata['list_img_ori'] = $uplist['name'];

		if ($_conf['list_img_thumb_is'] == "y") {
			$udata['list_img_thumb'] = $cls_thumb->resize_image($udata['list_img_new'], $uplist['ext'], $udata['list_img_dir'], $_conf['list_img_thumb_w'], $_conf['list_img_thumb_h']);
		}
	}

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
					rt_file_delete($env->_post['path_files'],"/norm/".$f['file_new']);
					$dbo->query("DELETE FROM RT_RTBOARD_FILES WHERE bcode='".$env->_post['bcode']."' AND post_seq=".$env->_post['seq']." AND file_num=".$m);
				}
				$upres = $cls_fu->upload($env->_files['file'.$m],"/norm");
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
		if (is_numeric($env->_post['pg'])) $addurl.= "&pg=".$env->_post['pg'];
		if ($env->_post['ct']) $addurl.= "&ct=".urlencode($env->_post['ct']);
		if (!empty($env->_post['searchstring'])) $addurl.= "&search=".$env->_post['search']."&searchstring=".$env->_post['searchstring'];

		rt_js_move("", "parent", "href", $rt_conf_db['ssl_url_n'].$env->_post['php_self']."?cf=view&seq=".$env->_post['seq'].$addurl);
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

//-------------------------------------------------------------------------------------------------

/**
 * 수정페이지 비밀번호 인증
 */
} else if($env->_post['mode'] == "modify_move" && is_numeric($env->_post['seq'])) {

	if (empty($env->_post['mod_pwd'])) {
		rt_js_msg("비밀번호를 입력해 주세요");exit;
	}

	$r = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl." WHERE seq=".$env->_post['seq']);

	$checkpwd = rt_password($env->_post['mod_pwd']);
	if ($r['post_pw'] != $checkpwd) {
		rt_js_msg("비밀번호가 맞지 않습니다.");exit;
	}

	//직접 접속 방지(최근 인증된 1개 게시물만 직접 접속 허용)
	$_SESSION['post_'.$env->_post['theme'].'_'.$env->_post['seq']] = "y";

	rt_js_move("", "parent", "href", $rt_conf_db['ssl_url_n'].$env->_post['php_self']."?cf=form&seq=".$env->_post['seq']."&pg=".$env->_post['pg'].$addurl);

//-------------------------------------------------------------------------------------------------

/**
 * 내 글 수정페이지 접근 인증
 */
} else if($env->_post['mode'] == "my_modify_move" && is_numeric($env->_post['seq'])) {

	//직접 접속 방지(최근 인증된 1개 게시물만 직접 접속 허용)
	$_SESSION['post_'.$env->_post['theme'].'_'.$env->_post['seq']] = "y";

	//검색 페이지, 검색어
	if (is_numeric($env->_post['pg'])) $addurl.= "&pg=".$env->_post['pg'];
	if ($env->_post['ct']) $addurl.= "&ct=".urlencode($env->_post['ct']);
	if (!empty($env->_post['searchstring'])) $addurl.= "&search=".$env->_post['search']."&searchstring=".$env->_post['searchstring'];

	rt_js_move("", "parent", "href", $rt_conf_db['ssl_url_n'].$env->_post['php_self']."?cf=form&seq=".$env->_post['seq'].$addurl);

//-------------------------------------------------------------------------------------------------

/**
 * 답글 달기
 */
} else if ($env->_post['mode'] == "reply") {
	//게시판 환경 정보
	$_conf = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl."_CONF WHERE bcode='".$env->_post['bcode']."'");

	//원글 게시물 정보
	$r = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl." WHERE seq='".$env->_post['seq']."'");

	//파일 업로드 제한
	$total_size = 0;
	foreach ($env->_files as $k => $v) {
		$total_size+= $env->_files[$k]['size'];
	}
	$check_size = $total_size / 1000000;
	if ($check_size > $_conf['upload_size_limit']) {
		rt_js_msg("한번에 ".$_conf['upload_size_limit']."MB 이상 업로드할 수 없습니다");
		exit;
	}

	//DB 입력 데이터 설정
	if ($_conf['category_is'] == "y") {
		$udata['category'] = $env->_post['category'];
	}

	if (!empty($env->_post['post_pw'])) {
		$udata['post_pw'] = rt_password($env->_post['post_pw']);
	}

	$udata['bcode'				] = $r['bcode'];
	$udata['userid'				] = $cls_rtm->id;
	$udata['name'				] = $env->_post['name'];
	$udata['subject'			] = $env->_post['subject'];
	$udata['content'			] = $env->_post['content'];
	$udata['list_img_cont_is'	] = ($env->_post['list_img_cont_is']=="y") ? "y":"n";
	$udata['webeditor_is'		] = $env->_post['webeditor_is'];
	$udata['hits'				] = 0;
	$udata['reg_date'			] = date("Y-m-d H:i:s");
	$udata['notice_is'			] = "n";
	$udata['user_ip'			] = $env->_server['REMOTE_ADDR'];

	//대표(목록)이미지 설정
	if (!empty($env->_files['list_img']['name']) && $_conf['list_img_is'] == "y") {

		$uplist = $cls_fu->upload($env->_files['list_img'],"/norm");

		$udata['list_img_dir'] = $uplist['path_base'].$uplist['path_sub'];
		$udata['list_img_new'] = $uplist['name_new'];
		$udata['list_img_ori'] = $uplist['name'];

		if ($_conf['list_img_thumb_is'] == "y") {
			$udata['list_img_thumb'] = $cls_thumb->resize_image($udata['list_img_new'], $uplist['ext'], $udata['list_img_dir'], $_conf['list_img_thumb_w'], $_conf['list_img_thumb_h']);
		}
	}

	//계층정보설정
	$dbo->query("UPDATE ".$cls_board->db_tbl." SET re_step=re_step+1 WHERE ref='".$r['ref']."' AND re_step > ".$r['re_step']." AND bcode='".$r['bcode']."'");
	$udata['ref'			] = $env->_post['ref'];
	$udata['re_step'		] = $r['re_step'] + 1;
	$udata['re_level'		] = $r['re_level'] + 1;

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

		//파일 업로드
		for ($m = 1; $m <= $_conf['upload_cnt']; $m++) {

			$upres = "";
			if (!empty($env->_files['file'.$m]['name'])) {
				$upres = $cls_fu->upload($env->_files['file'.$m],"/norm");
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

		if ($env->_post['searchstring']) {
			$addurl = "&search=".$env->_post['search']."&searchstring=".$env->_post['searchstring'];
		}

		rt_js_move("글이 등록되었습니다.", "parent", "href", $rt_conf_db['ssl_url_n'].$env->_post['php_self']."?pg=".$env->_post['pg'].$addurl);
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

//-------------------------------------------------------------------------------------------------

/**
 * 게시물 삭제
 */
} else if($env->_post['mode'] == "delete" && is_numeric($env->_post['seq'])) {

	//삭제할 게시물 정보
	$r = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl." WHERE seq=".$env->_post['seq']);

	// 내 글은 비밀번호 체크하지 않음
	if ($cls_rtm->id == $r['userid'] && !empty($r['userid'])){}else {

		if (empty($env->_post['del_pwd'])) {
			rt_js_msg("비밀번호를 입력해 주세요");exit;
		}

		$checkpwd = rt_password($env->_post['del_pwd']);
		if ($r['post_pw'] != $checkpwd) {
			rt_js_msg("비밀번호가 맞지 않습니다.");exit;
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
		if (is_numeric($env->_post['pg'])) $addurl.= "&pg=".$env->_post['pg'];
		if ($env->_post['ct']) $addurl.= "&ct=".urlencode($env->_post['ct']);
		if (!empty($env->_post['searchstring'])) $addurl.= "&search=".$env->_post['search']."&searchstring=".$env->_post['searchstring'];
		
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
 * 신규 댓글 등록
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
			rt_js_msg("삭제권한이 없습니다.");exit;
		} else {

			//회원 댓글
			if ($env->_post['id'] != $cmt['userid']) {
				rt_js_msg("삭제권한이 없습니다.");exit;
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