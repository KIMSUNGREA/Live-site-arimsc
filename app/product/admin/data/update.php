<?php
//-------------------------------------------------------------------------------------------------
/*
 * 제품 정보 업데이트
 * 
 * $env->_post['mode'] 데이터 처리 구분
 * 
 * insert		: 제품 등록
 * modify		: 제품 정보 수정
 * delete		: 제품 삭제
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ADM."/engine.php";

//-------------------------------------------------------------------------------------------------

/**
 * 제품 환경정보
 */

$_conf = $dbo->fetch("SELECT * FROM RT_PRODUCT_CONF");

$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='product'");
$upload_path = $_app['app_path']."/files";

//-------------------------------------------------------------------------------------------------

/**
 * 업로드 콤포넌트 설정
 */

rt_load_component("fileupload,thumbnail");

$cls_fu = new fileupload($upload_path);
$cls_thumb = new thumbnail();

//-------------------------------------------------------------------------------------------------

$data = array();//DB 필드데이터

if ($env->_post['mode'] == "insert")
{
	$c = $dbo->fetch("SELECT * FROM RT_CATEGORY WHERE groupcode='PRODUCT' AND code='".$env->_post['cate']."'");

	$udata['parent'				] = $c['parent'];
	$udata['cate'				] = $env->_post['cate'];
	$udata['pdt_name'			] = $env->_post['pdt_name'];
	$udata['opt_tit1'			] = $env->_post['opt_tit1'];
	$udata['opt_tit2'			] = $env->_post['opt_tit2'];
	$udata['opt_tit3'			] = $env->_post['opt_tit3'];
	$udata['opt_tit4'			] = $env->_post['opt_tit4'];
	$udata['opt1'				] = $env->_post['opt1'];
	$udata['opt2'				] = $env->_post['opt2'];
	$udata['opt3'				] = $env->_post['opt3'];
	$udata['opt4'				] = $env->_post['opt4'];
	$udata['vopt_tit'			] = serialize($env->_post['vopt_tit']);
	$udata['vopt_val'			] = serialize($env->_post['vopt_val']);
	$udata['type_en'			] = $env->_post['type_en'];
	$udata['detail_img_cont_is'	] = $env->_post['detail_img_cont_is'];
	$udata['detail_cont'		] = $env->_post['detail_cont'];
	$udata['pdt_html'			] = $env->_post['pdt_html'];
	$udata['reg_date'			] = date("Y-m-d H:i:s");

	//출력 순서 초기설정
	$_r = $dbo->fetch("SELECT COUNT(seq) AS reccnt, MAX(ord) AS maxord FROM RT_PRODUCT");
	$udata['ord'] = ($_r['reccnt'] < 1) ? 0 : $_r['maxord'] + 1;

	//목록 이미지 설정
	if (!empty($env->_files['list_img']['name'])) {

		$uplist = $cls_fu->upload($env->_files['list_img']);
		$udata['list_img_dir'] = $uplist['path_base'].$uplist['path_sub'];
		$udata['list_img_new'] = $uplist['name_new'];
		$udata['list_img_ori'] = $uplist['name'];

		if ($_conf['img_thumb_is'] == "y") {
			$udata['list_img_thumb'] = $cls_thumb->resize_image($udata['list_img_new'], $uplist['ext'], $udata['list_img_dir'], $_conf['list_img_thumb_w'], $_conf['list_img_thumb_h']);
		}
	}

	//콘텐츠 이미지 설정
	if (!empty($env->_files['pdt_img']['name'])) {

		$uplist = $cls_fu->upload($env->_files['pdt_img']);
		$udata['pdt_img_dir'] = $uplist['path_base'].$uplist['path_sub'];
		$udata['pdt_img_new'] = $uplist['name_new'];
		$udata['pdt_img_ori'] = $uplist['name'];
	}

	if ($dbo->insert("RT_PRODUCT", $udata)) {

		$post_seq = $dbo->last_insert_id();

		//제품 이미지 업로드
		for ($m = 1; $m <= $_conf['upload_img_cnt']; $m++) {

			$upres = "";
			if (!empty($env->_files['img_file'.$m]['name'])) {
				$upres = $cls_fu->upload($env->_files['img_file'.$m]);
				$upload['pdt_seq'		] = $post_seq;
				$upload['file_type'		] = "img";
				$upload['file_num'		] = $m;
				$upload['path_base'		] = $upres['path_base'];
				$upload['path_sub'		] = $upres['path_sub'];
				$upload['file_ori'		] = $upres['name'];
				$upload['file_new'		] = $upres['name_new'];
				$upload['file_size'		] = $upres['size'];
				$upload['file_ext'		] = $upres['ext'];
				$upload['download_hits'	] = 0;
				$upload['upload_date'	] = date("Y-m-d H:i:s");

				if ($_conf['img_thumb_is'] == "y") {
					$upload['file_thumb'] = $cls_thumb->resize_image($upres['name_new'], $upres['ext'], $upres['path_base'].$upres['path_sub'], $_conf['pdt_img_thumb_w'], $_conf['pdt_img_thumb_h']);
				}
				$dbo->insert("RT_PRODUCT_FILES", $upload);
			}
		}

		//첨부파일 업로드
		for ($m = 1; $m <= $_conf['upload_file_cnt']; $m++) {

			$upres = "";
			if (!empty($env->_files['attc_file'.$m]['name'])) {
				$upres = $cls_fu->upload($env->_files['attc_file'.$m]);
				$upload['pdt_seq'		] = $post_seq;
				$upload['file_type'		] = "file";
				$upload['file_num'		] = $m;
				$upload['path_base'		] = $upres['path_base'];
				$upload['path_sub'		] = $upres['path_sub'];
				$upload['file_ori'		] = $upres['name'];
				$upload['file_new'		] = $upres['name_new'];
				$upload['file_size'		] = $upres['size'];
				$upload['file_ext'		] = $upres['ext'];
				$upload['download_hits'	] = 0;
				$upload['upload_date'	] = date("Y-m-d H:i:s");
				$dbo->insert("RT_PRODUCT_FILES", $upload);
			}
		}

		rt_js_move("제품이 등록되었습니다.", "parent", "href", RTW_ADM."/app/?appcode=product&sd=admin-data");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "modify" && is_numeric($env->_post['seq']))
{
	$c = $dbo->fetch("SELECT * FROM RT_CATEGORY WHERE groupcode='PRODUCT' AND code='".$env->_post['cate']."'");
	$r = $dbo->fetch("SELECT * FROM RT_PRODUCT WHERE seq=".$env->_post['seq']);

	//목록 이미지 삭제
	if ($env->_post['list_img_del_is'] == "y") {
		if ($r['list_img_new']) {
			rt_file_delete($r['list_img_dir'],$r['list_img_new']);
			rt_file_delete($r['list_img_dir']."thumb/",$r['list_img_thumb']);
			$dbo->query("UPDATE RT_PRODUCT SET list_img_dir='', list_img_new='', list_img_ori='', list_img_thumb='' WHERE seq='".$env->_post['seq']."'");
		}
	}

	//콘텐츠 이미지 삭제
	if ($env->_post['pdt_img_del_is'] == "y") {
		if ($r['pdt_img_new']) {
			rt_file_delete($r['pdt_img_dir'],$r['pdt_img_new']);
			$dbo->query("UPDATE RT_PRODUCT SET pdt_img_dir='', pdt_img_new='', pdt_img_ori='' WHERE seq='".$env->_post['seq']."'");
		}
	}

	//상세 이미지 삭제
	for ($m = 1; $m <= $_conf['upload_img_cnt']; $m++) {
		if ($env->_post['img_del'.$m.'_is'] == "y") {
			$f = $dbo->fetch("SELECT * FROM RT_PRODUCT_FILES WHERE pdt_seq='".$env->_post['seq']."' AND file_type='img' AND file_num=".$m);
			if ($f['file_ori']) {
				rt_file_delete($f['path_base'],$f['path_sub'].$f['file_new']);
				rt_file_delete($f['path_base']."/thumb",$f['path_sub'].$f['file_thumb']);
				$dbo->query("DELETE FROM RT_PRODUCT_FILES WHERE pdt_seq='".$env->_post['seq']."' AND file_type='img' AND file_num=".$m);
			}
		}
	}

	//첨부파일 삭제
	for ($m = 1; $m <= $_conf['upload_file_cnt']; $m++) {
		if ($env->_post['attc_del'.$m.'_is'] == "y") {
			$f = $dbo->fetch("SELECT * FROM RT_PRODUCT_FILES WHERE pdt_seq='".$env->_post['seq']."' AND file_type='file' AND file_num=".$m);
			if ($f['file_ori']) {
				rt_file_delete($f['path_base'],$f['path_sub'].$f['file_new']);
				$dbo->query("DELETE FROM RT_PRODUCT_FILES WHERE pdt_seq='".$env->_post['seq']."' AND file_type='file' AND file_num=".$m);
			}
		}
	}

	if ($env->_post['type_en'] == "field") {
		$udata['parent'				] = $c['parent'];
		$udata['cate'				] = $env->_post['cate'];
		$udata['pdt_name'			] = $env->_post['pdt_name'];
		$udata['opt_tit1'			] = $env->_post['opt_tit1'];
		$udata['opt_tit2'			] = $env->_post['opt_tit2'];
		$udata['opt_tit3'			] = $env->_post['opt_tit3'];
		$udata['opt_tit4'			] = $env->_post['opt_tit4'];
		$udata['opt1'				] = $env->_post['opt1'];
		$udata['opt2'				] = $env->_post['opt2'];
		$udata['opt3'				] = $env->_post['opt3'];
		$udata['opt4'				] = $env->_post['opt4'];
		$udata['vopt_tit'			] = serialize($env->_post['vopt_tit']);
		$udata['vopt_val'			] = serialize($env->_post['vopt_val']);
		$udata['type_en'			] = $env->_post['type_en'];
		$udata['detail_img_cont_is'	] = $env->_post['detail_img_cont_is'];
		$udata['detail_cont'		] = $env->_post['detail_cont'];
		$udata['pdt_html'			] = $env->_post['pdt_html'];
		$udata['mod_date'			] = date("Y-m-d H:i:s");
	} else if ($env->_post['type_en'] == "html") {
		$udata['parent'				] = $c['parent'];
		$udata['cate'				] = $env->_post['cate'];
		$udata['type_en'			] = $env->_post['type_en'];
		$udata['detail_img_cont_is'	] = $env->_post['detail_img_cont_is'];
		$udata['pdt_name'			] = $env->_post['pdt_name'];
		$udata['pdt_html'			] = $env->_post['pdt_html'];
		$udata['mod_date'			] = date("Y-m-d H:i:s");
	} else if ($env->_post['type_en'] == "img") {
		$udata['parent'				] = $c['parent'];
		$udata['type_en'			] = $env->_post['type_en'];
		$udata['detail_img_cont_is'	] = $env->_post['detail_img_cont_is'];
		$udata['cate'				] = $env->_post['cate'];
		$udata['pdt_name'			] = $env->_post['pdt_name'];
		$udata['mod_date'			] = date("Y-m-d H:i:s");
	}

	//목록 이미지 설정
	if (!empty($env->_files['list_img']['name'])) {

		if ($r['list_img_new']) {
			rt_file_delete($r['list_img_dir'],$r['list_img_new']);
			rt_file_delete($r['list_img_dir']."thumb/",$r['list_img_thumb']);
			$dbo->query("UPDATE RT_PRODUCT SET list_img_dir='', list_img_new='', list_img_ori='', list_img_thumb='' WHERE seq='".$env->_post['seq']."'");
		}

		$uplist = $cls_fu->upload($env->_files['list_img']);
		$udata['list_img_dir'] = $uplist['path_base'].$uplist['path_sub'];
		$udata['list_img_new'] = $uplist['name_new'];
		$udata['list_img_ori'] = $uplist['name'];

		if ($_conf['img_thumb_is'] == "y") {
			$udata['list_img_thumb'] = $cls_thumb->resize_image($udata['list_img_new'], $uplist['ext'], $udata['list_img_dir'], $_conf['list_img_thumb_w'], $_conf['list_img_thumb_h']);
		}
	}

	//콘텐츠 이미지 설정
	if (!empty($env->_files['pdt_img']['name'])) {

		if ($r['pdt_img_new']) {
			rt_file_delete($r['pdt_img_dir'],$r['pdt_img_new']);
			$dbo->query("UPDATE RT_PRODUCT SET pdt_img_dir='', pdt_img_new='', pdt_img_ori='' WHERE seq='".$env->_post['seq']."'");
		}

		$uplist = $cls_fu->upload($env->_files['pdt_img']);
		$udata['pdt_img_dir'] = $uplist['path_base'].$uplist['path_sub'];
		$udata['pdt_img_new'] = $uplist['name_new'];
		$udata['pdt_img_ori'] = $uplist['name'];
	}

	if ($dbo->update("RT_PRODUCT", $udata, "seq=".$env->_post['seq'])) {

		//제품 이미지 업로드
		for ($m = 1; $m <= $_conf['upload_img_cnt']; $m++) {

			$upres = "";
			if (!empty($env->_files['img_file'.$m]['name'])) {
				$f = $dbo->fetch("SELECT * FROM RT_PRODUCT_FILES WHERE pdt_seq='".$env->_post['seq']."' AND file_type='img' AND file_num=".$m);
				if ($f['file_ori']) {
					rt_file_delete($f['path_base'],$f['path_sub'].$f['file_new']);
					rt_file_delete($f['path_base']."/thumb",$f['path_sub'].$f['file_thumb']);
					$dbo->query("DELETE FROM RT_PRODUCT_FILES WHERE pdt_seq='".$env->_post['seq']."' AND file_type='img' AND file_num=".$m);
				}
				$upres = $cls_fu->upload($env->_files['img_file'.$m]);
				$upload['pdt_seq'		] = $env->_post['seq'];
				$upload['file_type'		] = "img";
				$upload['file_num'		] = $m;
				$upload['path_base'		] = $upres['path_base'];
				$upload['path_sub'		] = $upres['path_sub'];
				$upload['file_ori'		] = $upres['name'];
				$upload['file_new'		] = $upres['name_new'];
				$upload['file_size'		] = $upres['size'];
				$upload['file_ext'		] = $upres['ext'];
				$upload['download_hits'	] = 0;
				$upload['upload_date'	] = date("Y-m-d H:i:s");

				if ($_conf['img_thumb_is'] == "y") {
					$upload['file_thumb'] = $cls_thumb->resize_image($upres['name_new'], $upres['ext'], $upres['path_base'].$upres['path_sub'], $_conf['pdt_img_thumb_w'], $_conf['pdt_img_thumb_h']);
				}
				$dbo->insert("RT_PRODUCT_FILES", $upload);
			}
		}

		//첨부파일 업로드
		for ($m = 1; $m <= $_conf['upload_file_cnt']; $m++) {

			$upres = "";
			if (!empty($env->_files['attc_file'.$m]['name'])) {
				$f = $dbo->fetch("SELECT * FROM RT_PRODUCT_FILES WHERE pdt_seq='".$env->_post['seq']."' AND file_type='file' AND file_num=".$m);
				if ($f['file_ori']) {
					rt_file_delete($f['path_base'],$f['path_sub'].$f['file_new']);
					$dbo->query("DELETE FROM RT_PRODUCT_FILES WHERE pdt_seq='".$env->_post['seq']."' AND file_type='file' AND file_num=".$m);
				}
				$upres = $cls_fu->upload($env->_files['attc_file'.$m]);
				$upload['pdt_seq'		] = $env->_post['seq'];
				$upload['file_type'		] = "file";
				$upload['file_num'		] = $m;
				$upload['path_base'		] = $upres['path_base'];
				$upload['path_sub'		] = $upres['path_sub'];
				$upload['file_ori'		] = $upres['name'];
				$upload['file_new'		] = $upres['name_new'];
				$upload['file_size'		] = $upres['size'];
				$upload['file_ext'		] = $upres['ext'];
				$upload['download_hits'	] = 0;
				$upload['upload_date'	] = date("Y-m-d H:i:s");
				$dbo->insert("RT_PRODUCT_FILES", $upload);
			}
		}

		rt_js_move("정보가 변경되었습니다.", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_get['mode'] == "delete" && is_numeric($env->_get['seq']))
{
	//삭제할 게시물 정보
	$r = $dbo->fetch("SELECT * FROM RT_PRODUCT WHERE seq=".$env->_get['seq']);

	if ($dbo->query("DELETE FROM RT_PRODUCT WHERE seq='".$r['seq']."'")) {

		//목록 이미지 삭제
		rt_file_delete($r['list_img_dir'],$r['list_img_new']);
		rt_file_delete($r['list_img_dir']."thumb/",$r['list_img_thumb']);

		//상세이미지&첨부파일 삭제
		$fr = $dbo->fetch_list("SELECT * FROM RT_PRODUCT_FILES WHERE pdt_seq='".$r['seq']."'");

		$dbo->query("DELETE FROM RT_PRODUCT_FILES WHERE pdt_seq='".$r['seq']."'");

		for ($m = 0; $m < count($fr); $m++) {
			rt_file_delete($fr[$m]['path_base'],$fr[$m]['path_sub'].$fr[$m]['file_new']);
			if ($fr[$m]['file_thumb']) {
				rt_file_delete($fr[$m]['path_base']."/thumb",$fr[$m]['path_sub'].$fr[$m]['file_thumb']);
			}
		}

		//페이지 및 검색어 유지
		if (is_numeric($env->_get['pg'])) $add_url.= "&pg=".$env->_get['pg'];
		if (!empty($env->_get['searchstring'])) $add_url.= "&search=".$env->_get['search']."&searchstring=".$env->_get['searchstring'];
		
		rt_js_move("제품이 삭제되었습니다.", "parent", "href", RTW_ADM."/app/?appcode=product&sd=admin-data".$add_url);
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_get['mode'] == "chgord" && $env->_get['part'] && is_numeric($env->_get['seq']))
{
	if ($env->_get['schcate']) {
		$fixqry = " cate='".$env->_get['schcate']."' AND ";
	}

	$r = $dbo->fetch("SELECT * FROM RT_PRODUCT WHERE ".$fixqry." seq='".$env->_get['seq']."'");

	if ($env->_get['part'] == "up") {
		$t = $dbo->fetch("SELECT * FROM RT_PRODUCT WHERE ".$fixqry." ord > ".$r['ord']." ORDER BY ord ASC LIMIT 1");
	} else if ($env->_get['part'] == "down") {
		$t = $dbo->fetch("SELECT * FROM RT_PRODUCT WHERE ".$fixqry." ord < ".$r['ord']." ORDER BY ord DESC LIMIT 1");
		
	}

	if (is_numeric($t['seq'])) {

		$data['ord'] = $r['ord'];
		$dbo->update("RT_PRODUCT", $data, "seq='".$t['seq']."'");

		$data['ord'] = $t['ord'];
		$dbo->update("RT_PRODUCT", $data, "seq='".$r['seq']."'");
	}

	rt_js_move("", "parent", "reload");
}
exit;
?>