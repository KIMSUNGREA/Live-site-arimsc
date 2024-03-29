<?php
//-------------------------------------------------------------------------------------------------
/*
 * 데이터 처리
 * 
 * mode 데이터 처리 구분
 * 
 * insert			: 신규 입력
 * modify			: 정보 수정
 * reply			: 답글 입력
 * delete			: 데이터 삭제
 * select_delete	: 선택 데이터 삭제
 * download			: 첨부파일 다운로드
 * cmt_insert		: 댓글 등록
 * cmt_delete		: 댓글 삭제
 * cmt_reply		: 댓글 답변 등록
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ADM."/engine.php";

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

$udata = array();//업데이트 데이터

if ($env->_post['mode'] == "insert")
{
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
		exit;
	}

	//DB 입력 데이터 설정
	$notice_is = ($env->_post['notice_is']=="y") ? "y":"n";
	$use_is = ($env->_post['use_is']=="y") ? "y":"n";
	$webeditor_is = ($env->_post['webeditor_is']=="y") ? "y":"n";
	$list_img_cont_is = ($env->_post['list_img_cont_is']=="y") ? "y":"n";
	$reg_date = ($env->_post['reg_date']) ? $env->_post['reg_date'] : date("Y-m-d H:i:s");
	$mod_date = ($env->_post['mod_date']) ? $env->_post['mod_date'] : date("Y-m-d H:i:s");

	$udata['bcode'			] = $env->_post['bcode'];
	if ($env->_post['bcode'] == "review") {
		//$udata['auth_en'] = ($env->_post['auth_en']=="y") ? "y":"n";
	}
	if ($_conf['category_is'] == "y") {
		$udata['category'] = $env->_post['category'];
	}
	if (!empty($env->_post['post_pw'])) {
		$udata['post_pw'] = rt_password($env->_post['post_pw']);
	}
	$udata['userid'				] = $env->_session['RT_ADM_ID'];
	$udata['name'				] = $env->_post['name'];
	$udata['subject'			] = $env->_post['subject'];
	$udata['content'			] = $env->_post['content'];
	$udata['hits'				] = 0;
	$udata['reg_date'			] = $reg_date;
	$udata['mod_date'			] = $mod_date;
	$udata['notice_is'			] = $notice_is;
	//$udata['use_is'				] = $use_is;
	$udata['list_img_cont_is'	] = $list_img_cont_is;
	$udata['webeditor_is'		] = $webeditor_is;
	$udata['user_ip'			] = $env->_server['REMOTE_ADDR'];
/*
	$udata['pdt_model'			] = $env->_post['pdt_model'];
	$udata['serial_num'			] = $env->_post['serial_num'];
	$udata['recode'				] = $env->_post['recode'];
*/
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

		rt_js_move("", "parent", "href", RTW_ADM."/app/?appcode=rtboard&sd=theme-norm-data&bcode=".$env->_post['bcode']);
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if($env->_post['mode'] == "modify" && is_numeric($env->_post['seq']))
{
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
	$notice_is = ($env->_post['notice_is']=="y") ? "y":"n";
	$use_is = ($env->_post['use_is']=="y") ? "y":"n";
	$list_img_cont_is = ($env->_post['list_img_cont_is']=="y") ? "y":"n";
	$webeditor_is = ($env->_post['webeditor_is']=="y") ? "y":"n";
	$reg_date = ($env->_post['reg_date']) ? $env->_post['reg_date'] : date("Y-m-d H:i:s");
	$mod_date = ($env->_post['mod_date']) ? $env->_post['mod_date'] : date("Y-m-d H:i:s");

	if ($env->_post['bcode'] == "review") {
		//$udata['auth_en'] = ($env->_post['auth_en']=="y") ? "y":"n";
	}
	if ($_conf['category_is'] == "y") {
		$udata['category'] = $env->_post['category'];
	}
	if (!empty($env->_post['post_pw'])) {
		$udata['post_pw'] = rt_password($env->_post['post_pw']);
	}
	$udata['name'				] = $env->_post['name'];
	$udata['subject'			] = $env->_post['subject'];
	$udata['content'			] = $env->_post['content'];
	$udata['reg_date'			] = $reg_date;
	$udata['mod_date'			] = $mod_date;
	$udata['notice_is'			] = $notice_is;
	//$udata['use_is'				] = $use_is;
	$udata['list_img_cont_is'	] = $list_img_cont_is;
	$udata['webeditor_is'		] = $webeditor_is;
	$udata['user_ip'			] = $env->_server['REMOTE_ADDR'];
/*
	$udata['pdt_model'			] = $env->_post['pdt_model'];
	$udata['serial_num'			] = $env->_post['serial_num'];
	$udata['recode'				] = $env->_post['recode'];
*/
	$udata['rating_en'			] = $env->_post['rating_en'];
	$udata['best_en'] = ($env->_post['best_en']=="y") ? "y":"n";

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

		$new_best = ($r['best_en']=="y")?"n":"y";

		//선정으로 돌릴 시 쿠폰발행
		if ($new_best == "y") {

			//베스트후기 선정 혜택
			$data['coupon_type'	] = "c";
			$data['user_id'		] = $r['userid'];
			$data['pdt_model'	] = $r['pdt_model'];
			$data['serial_num'	] = $r['serial_num'];
			$data['recode'		] = "";
			$data['regdate'		] = date("Y-m-d");
			$data['use_is'		] = "n";
			$dbo->insert("RT_COUPON", $data);

			//알림설정
			$dbo->query("UPDATE RT_RTMEMBER SET review_alarm='y' WHERE user_id='".$r['userid']."'");

			//메일발송
			$fromMail = "arimsc@arimsc.com";
			$toMail = $r['userid'];
			$subject = "[ARIM] ".$env->_post['name']."님의 후기가 베스트후기로 선정되었습니다.";

			$header = "Return-Path: <".$fromMail.">\r\n";
			$header .= "From: <".$fromMail.">\r\n";
			$header .= "X-Sender: <".$fromMail.">\r\n";
			$header .= "X-Mailer: PHP\r\n";
			$header .= "Reply-To:<".$fromMail.">\r\n";
			$header .= "MIME-Version: 1.0\r\n";                                  // MIME 버전 표시
			$header .= "Content-Type: text/html; charset=utf-8\r\n";
			$header .= "Content-Transfer-Encoding: base64 \r\n\r\n";

			// --- 이메일 본문 생성 --- //  
			$mail_content.= "<br>홈페이지에서 확인해 주세요."."\r\n";
			$mail_content.= "<br><a href='https://arimsc.com/' target='_blank'><u>아림사이언스 홈페이지 바로가기(arimsc.com)</u></a>"."\r\n";

			$mail_content = chunk_split(base64_encode($mail_content));
			$mailbody = stripslashes($mail_content)."\r\n";

			$rs = mail($toMail,$subject,$mailbody,$header);
		}

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
		if (is_numeric($env->_post['pg'])) $add_url.= "&pg=".$env->_post['pg'];
		if (!empty($env->_post['searchstring'])) $add_url.= "&search=".$env->_post['search']."&searchstring=".$env->_post['searchstring'];

		rt_js_move("", "parent", "href", RTW_ADM."/app/?appcode=rtboard&sd=theme-norm-data&bcode=".$env->_post['bcode']."&cf=view&seq=".$env->_post['seq'].$add_url);
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "reply")
{
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
	$notice_is = ($env->_post['notice_is']=="y") ? "y":"n";
	$use_is = ($env->_post['use_is']=="y") ? "y":"n";
	$list_img_cont_is = ($env->_post['list_img_cont_is']=="y") ? "y":"n";
	$webeditor_is = ($env->_post['webeditor_is']=="y") ? "y":"n";
	$reg_date = ($env->_post['reg_date']) ? $env->_post['reg_date'] : date("Y-m-d H:i:s");
	$mod_date = ($env->_post['mod_date']) ? $env->_post['mod_date'] : date("Y-m-d H:i:s");

	if ($_conf['category_is'] == "y") {
		$udata['category'] = $env->_post['category'];
	}
	if (!empty($env->_post['post_pw'])) {
		$udata['post_pw'] = rt_password($env->_post['post_pw']);
	}
	$udata['bcode'				] = $r['bcode'];
	$udata['name'				] = $env->_post['name'];
	$udata['subject'			] = $env->_post['subject'];
	$udata['content'			] = $env->_post['content'];
	$udata['reg_date'			] = $reg_date;
	$udata['mod_date'			] = $mod_date;
	$udata['notice_is'			] = $notice_is;
	$udata['use_is'				] = $use_is;
	$udata['list_img_cont_is'	] = $list_img_cont_is;
	$udata['webeditor_is'		] = $webeditor_is;
	$udata['user_ip'			] = $env->_server['REMOTE_ADDR'];

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

	//계층정보설정
	$dbo->query("UPDATE ".$cls_board->db_tbl." SET re_step=re_step+1 WHERE ref='".$r['ref']."' AND re_step > ".$r['re_step']." AND bcode='".$r['bcode']."'");
	$udata['ref'			] = $env->_post['ref'];
	$udata['re_step'		] = $r['re_step'] + 1;
	$udata['re_level'		] = $r['re_level'] + 1;

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

		rt_js_move("", "parent", "href", RTW_ADM."/app/?appcode=rtboard&sd=theme-norm-data&bcode=".$env->_post['bcode']);
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if($env->_get['mode'] == "delete" && is_numeric($env->_get['seq']))
{
	//삭제할 게시물 정보
	$r = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl." WHERE seq=".$env->_get['seq']);

	if ($dbo->query("DELETE FROM ".$cls_board->db_tbl." WHERE seq='".$r['seq']."'")) {

		//목록 이미지 삭제
		$list_file = RT_DOC_ROOT.$r['list_img_dir'].$r['list_img_new'];
		$list_file_thumb = RT_DOC_ROOT.$r['list_img_dir']."thumb/".$r['list_img_thumb'];

		if (is_file($list_file)) @unlink($list_file);
		if (is_file($list_file_thumb)) @unlink($list_file_thumb);

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

		//쿠폰 삭제
		//$dbo->query("DELETE FROM RT_COUPON WHERE user_id='".$r['userid']."' AND pdt_model='".$r['pdt_model']."' AND serial_num='".$r['serial_num']."'");
		$dbo->query("DELETE FROM RT_COUPON WHERE serial_num='".$r['serial_num']."'");

		//구매고객 필드 업데이트
		//등록된 구매후기가 한건도 없으면 비구매 고객으로 재분류
		$buyck = $dbo->fetch("SELECT COUNT(seq) AS cnt FROM ".$cls_board->db_tbl." WHERE userid='".$r['userid']."'");
		if ($buyck['cnt'] > 0) {
			$dbo->query("UPDATE RT_RTMEMBER SET buy_en='y' WHERE user_id='".$r['userid']."'");
		} else {
			//비구매고객으로 전환
			$dbo->query("UPDATE RT_RTMEMBER SET buy_en='n' WHERE user_id='".$r['userid']."'");
		}

		//게시물 댓글 삭제
		$dbo->query("DELETE FROM RT_RTBOARD_CMT WHERE bcode='".$r['bcode']."' AND post_seq='".$r['seq']."'");

		//페이지 및 검색어 유지
		if (is_numeric($env->_get['pg'])) $add_url.= "&pg=".$env->_get['pg'];
		if (!empty($env->_get['searchstring'])) $add_url.= "&search=".$env->_get['search']."&searchstring=".$env->_get['searchstring'];
		
		rt_js_move("", "parent", "href", RTW_ADM."/app/?appcode=rtboard&sd=theme-norm-data&bcode=".$env->_get['bcode'].$add_url);
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if($env->_post['mode'] == "select_delete" && $env->_post['seqstr'])
{
	$arr_seq = explode("/", $env->_post['seqstr']);

	foreach ($arr_seq as $k => $v) {

		if (!empty($v)) {

			//삭제할 게시물 정보
			$r = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl." WHERE seq=".$v);

			if ($dbo->query("DELETE FROM ".$cls_board->db_tbl." WHERE seq='".$r['seq']."'")) {

				//목록 이미지 삭제
				$list_file = RT_DOC_ROOT.$r['list_img_dir'].$r['list_img_new'];
				$list_file_thumb = RT_DOC_ROOT.$r['list_img_dir']."thumb/".$r['list_img_thumb'];

				if (is_file($list_file)) @unlink($list_file);
				if (is_file($list_file_thumb)) @unlink($list_file_thumb);

				//삭제할 첨부파일 정보
				unset($fr);
				$fr = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$r['bcode']."' AND post_seq=".$r['seq']);

				$dbo->query("DELETE FROM RT_RTBOARD_FILES WHERE bcode='".$r['bcode']."' AND post_seq='".$r['seq']."'");

				//실제 첨부파일 삭제
				for ($m = 0; $m < count($fr); $m++) {
					$target_file = RT_DOC_ROOT.$fr[$m]['path_base'].$fr[$m]['path_sub'].$fr[$m]['file_new'];
					echo $target_file;exit;
					if (is_file($target_file)) {
						@unlink($target_file);
					}
				}

				//쿠폰 삭제
				//$dbo->query("DELETE FROM RT_COUPON WHERE user_id='".$r['userid']."' AND pdt_model='".$r['pdt_model']."' AND serial_num='".$r['serial_num']."'");
				$dbo->query("DELETE FROM RT_COUPON WHERE serial_num='".$r['serial_num']."'");

				//구매고객 필드 업데이트
				//등록된 구매후기가 한건도 없으면 비구매 고객으로 재분류
				$buyck = $dbo->fetch("SELECT COUNT(seq) AS cnt FROM ".$cls_board->db_tbl." WHERE userid='".$r['userid']."'");
				if ($buyck['cnt'] > 0) {
					$dbo->query("UPDATE RT_RTMEMBER SET buy_en='y' WHERE user_id='".$r['userid']."'");
				} else {
					//비구매고객으로 전환
					$dbo->query("UPDATE RT_RTMEMBER SET buy_en='n' WHERE user_id='".$r['userid']."'");
				}

				//게시물 댓글 삭제
				$dbo->query("DELETE FROM RT_RTBOARD_CMT WHERE bcode='".$r['bcode']."' AND post_seq='".$r['seq']."'");

			} else {
				rt_js_move("잘못된 데이터가 있어 삭제 작업이 중지되었습니다.", "parent", "reload");
			}
		}
	}
	rt_js_move("", "parent", "reload");
}
else if($env->_post['mode'] == "select_status" && $env->_post['seqstr'])
{
	//div : a 승인 / c 베스트
	$arr_seq = explode("/", $env->_post['seqstr']);

	foreach ($arr_seq as $k => $v) {

		if (!empty($v)) {

			//게시물 정보
			$r = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl." WHERE seq=".$v);

			//선택 승인 프로세스
			if ($env->_post['div'] == "a") {

				$new_stat = ($r['auth_en']=="y")?"n":"y";

				//승인으로 돌릴 시 쿠폰발행 1회 한정
				if ($new_stat == "y") {
					
					//구매후기 작성 혜택
					//등록된 쿠폰이 없으면 등록 : 회원ID, 제품코드, 시리얼넘버
					$c = $dbo->fetch("SELECT * FROM RT_COUPON WHERE user_id='".$r['userid']."' AND pdt_model='".$r['pdt_model']."' AND serial_num='".$r['serial_num']."'");

					if (!$c['user_id']) {
						$data['coupon_type'	] = "a";
						$data['user_id'		] = $r['userid'];
						$data['pdt_model'	] = $r['pdt_model'];
						$data['serial_num'	] = $r['serial_num'];
						$data['recode'		] = $r['recode'];
						$data['regdate'		] = date("Y-m-d");
						$data['use_is'		] = "n";
						$dbo->insert("RT_COUPON", $data);
					}

					//추천인 혜택
					if ($r['recode']) {
						$reuser = $dbo->fetch("SELECT * FROM RT_RTMEMBER WHERE recode='".$r['recode']."'");

						if ($reuser['user_id']) {
							$w = $dbo->fetch("SELECT * FROM RT_COUPON WHERE coupon_type='b' AND user_id='".$reuser['user_id']."' AND pdt_model='".$r['pdt_model']."' AND serial_num='".$r['serial_num']."'");
							if (!$w['user_id']) {
								$data['coupon_type'	] = "b";
								$data['user_id'		] = $reuser['user_id'];
								$data['pdt_model'	] = $r['pdt_model'];
								$data['serial_num'	] = $r['serial_num'];
								$data['recode'		] = "";
								$data['regdate'		] = date("Y-m-d");
								$data['use_is'		] = "n";
								$dbo->insert("RT_COUPON", $data);
							}
						}
					}
				}

				$dbo->query("UPDATE ".$cls_board->db_tbl." SET auth_en='".$new_stat."' WHERE seq='".$r['seq']."'");

			} else if ($env->_post['div'] == "c") {

				//선택 베스트후기 프로세스
				$new_stat = ($r['best_en']=="y")?"n":"y";
				
				//베스트상품 선정 시 쿠폰발행 1회 한정
				if ($new_stat == "y") {
					//베스트후기 작성 혜택
					//등록된 쿠폰이 없으면 등록 : 회원ID, 제품코드, 시리얼넘버
					$c = $dbo->fetch("SELECT * FROM RT_COUPON WHERE user_id='".$r['userid']."' AND pdt_model='".$r['pdt_model']."' AND serial_num='".$r['serial_num']."' AND coupon_type='c'");

					if (!$c['user_id']) {
						$data['coupon_type'	] = "c";
						$data['user_id'		] = $r['userid'];
						$data['pdt_model'	] = $r['pdt_model'];
						$data['serial_num'	] = $r['serial_num'];
						$data['recode'		] = '';
						$data['regdate'		] = date("Y-m-d");
						$data['use_is'		] = "n";
						$dbo->insert("RT_COUPON", $data);
					}
				}

				$dbo->query("UPDATE ".$cls_board->db_tbl." SET best_en='".$new_stat."' WHERE seq='".$r['seq']."'");
			}
		}
	}
	rt_js_move("상태가 변경되었습니다.", "parent", "reload");
}
else if($env->_get['mode'] == "download" && $env->_get['bcode'] && is_numeric($env->_get['seq']) && is_numeric($env->_get['file_num']))
{
	$f = $dbo->fetch("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$env->_get['bcode']."' AND post_seq=".$env->_get['seq']." AND file_num=".$env->_get['file_num']);
	rt_download($f['file_new'], $f['file_ori'], $f['path_base'].$f['path_sub']);
}
else if ($env->_post['mode'] == "cmt_insert")
{
	$udata['post_seq'		] = $env->_post['post_seq'];
	$udata['bcode'			] = $env->_post['bcode'];
	$udata['userid'			] = $cls_adm->adm_id;
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
else if ($env->_get['mode'] == "cmt_delete" && is_numeric($env->_get['seq']))
{
	$cmt = $dbo->fetch("SELECT * FROM RT_RTBOARD_CMT WHERE seq=".$env->_get['seq']);

	//현재 댓글이 1차
	if ($cmt['re_level'] == 0) {

		//하위 댓글여부에 따른 처리
		$chk = $dbo->fetch("SELECT COUNT(seq) AS seqcnt FROM RT_RTBOARD_CMT WHERE post_seq=".$cmt['post_seq']." AND ref=".$cmt['ref']." AND re_level > 0");
		if ($chk['seqcnt'] > 0) {

			$udata['content'] = "삭제된 댓글입니다.";
			$udata['del_en'] = "y";
			$result = $dbo->update("RT_RTBOARD_CMT", $udata, "seq='".$env->_get['seq']."'");

		} else {

			$result = $dbo->query("DELETE FROM RT_RTBOARD_CMT WHERE seq='".$env->_get['seq']."'");
		}

	//현재 댓글이 2차이상
	} else if ($cmt['re_level'] > 0) {

		//1차 댓글이 삭제되었는지 여부에 따른 처리
		$chk = $dbo->fetch("SELECT * FROM RT_RTBOARD_CMT WHERE post_seq=".$cmt['post_seq']." AND ref=".$cmt['ref']." AND re_level = 0 AND del_en='y'");
		if (is_numeric($chk['seq'])) {

			//1차 댓글이 삭제된 경우 그 이하 댓글이 1개인지 2개이상인지에 따른 처리, 1개인경우 1차 댓글 포함 삭제
			$chk2 = $dbo->fetch("SELECT COUNT(seq) AS seqcnt FROM RT_RTBOARD_CMT WHERE post_seq=".$cmt['post_seq']." AND ref=".$cmt['ref']." AND re_level > 0");
			if ($chk2['seqcnt'] > 1) {
				$result = $dbo->query("DELETE FROM RT_RTBOARD_CMT WHERE seq='".$env->_get['seq']."'");
			} else {
				$result = $dbo->query("DELETE FROM RT_RTBOARD_CMT WHERE post_seq=".$cmt['post_seq']." AND ref=".$cmt['ref']);
			}

		} else {
			$result = $dbo->query("DELETE FROM RT_RTBOARD_CMT WHERE seq='".$env->_get['seq']."'");
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
	if (empty($env->_post['name'])) {rt_js_msg("이름을 입력해 주세요.");exit;}
	if (empty($env->_post['content'])) {rt_js_msg("내용을 입력해 주세요.");exit;}

	$r = $dbo->fetch("SELECT * FROM RT_RTBOARD_CMT WHERE seq=".$env->_post['seq']);

	$udata['post_seq'		] = $r['post_seq'];
	$udata['bcode'			] = $r['bcode'];
	$udata['userid'			] = $cls_rtm->id;
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
else if($env->_post['mode'] == "select_move" && $env->_post['seqstr'])
{
	$arr_seq = explode("/", $env->_post['seqstr']);

	foreach ($arr_seq as $k => $v) {

		if (!empty($v)) {

			//삭제할 게시물 정보
			$r = $dbo->fetch("SELECT * FROM ".$cls_board->db_tbl." WHERE seq=".$v);

			if ($dbo->query("UPDATE ".$cls_board->db_tbl." SET bcode='".$env->_post['bcode']."' WHERE seq='".$r['seq']."'")) {
				$f = $dbo->fetch("SELECT * FROM RT_RTBOARD_FILES WHERE post_seq=".$r['seq']);
				if ($f['post_seq']){
					$dbo->query("UPDATE RT_RTBOARD_FILES SET bcode='".$env->_post['bcode']."' WHERE post_seq='".$r['seq']."'");
				}
			} else {
				rt_js_move("잘못된 데이터가 있어 이동 작업이 중지되었습니다.", "parent", "reload");
			}
		}
	}
	rt_js_move("", "parent", "reload");
}
else
{
	rt_js_move("접속오류입니다. 다시 접속해 주세요", "parent", "href", RTW_ADM);
}
exit;

?>