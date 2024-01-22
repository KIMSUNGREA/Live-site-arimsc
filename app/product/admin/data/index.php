<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: product
 * APP SECTION		: admin-data
 *
 * 설명 : 제품 정보 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

/**
 * 컴포넌트 로드
 */

rt_load_component("board");

//-------------------------------------------------------------------------------------------------

/**
 * 개별환경 정보
 */

$_conf = $dbo->fetch("SELECT * FROM RT_PRODUCT_CONF");

//-------------------------------------------------------------------------------------------------

/**
 * 컨트롤러 로드
 */
require_once RT_DOC_ROOT.$_app['app_path']."/controller/product.admin.controller.php";
$cls_pdt = new product_admin($_conf['page_cnt_admin'],$_conf['block_cnt_admin']);

//-------------------------------------------------------------------------------------------------

//카테고리 출력용 클래스 호출/생성
rt_load_component("category");
$cls_ct = new category("PRODUCT");
$cls_ct->dbLoadCategory();

//카테고리 목록 세팅
$cls_ct->setCateList("0");

$_c = array();
for ($m = 0; $m < count($cls_ct->listdata['code']); $m++) {
	$_c[$cls_ct->listdata['code'][$m]] = $cls_ct->listdata['label'][$m];
}

//-------------------------------------------------------------------------------------------------

/**
 * 네비게이션 데이터
 */

$__cfg = array();
$__cfg['nav'][0] = "제품 관리";
$__cfg['nav'][1] = "제품 목록";
$__cfg['page'] = "제품 관리";

//-------------------------------------------------------------------------------------------------

/**
 * 공동 데이터
 */

$_def = array();
$_def['path_app'] = $_app['app_path'];
$_def['path_admin'] = $_def['path_app']."/admin";
$_def['path_assets'] = $_def['path_app']."/assets";
$_def['func'] = ($env->_get['cf']) ? $env->_get['cf'] : "list";

//-------------------------------------------------------------------------------------------------

/**
 * 게시판 환경 데이터
 */

$add_qry = array(); //DB 쿼리 배열
$add_url = ""; //전달 변수 배열

//고정 URL
$add_url.= "appcode=product&sd=".$env->_get['sd'];

//변동 쿼리
if ($env->_get['search'] && $env->_get['searchstring']) {
	$add_qry[] = "(".$env->_get['search']." LIKE '%".$env->_get['searchstring']."%')";
	$add_url.= "&search=".$env->_get['search']."&searchstring=".$env->_get['searchstring'];
}

if ($env->_get['schcate']) {
	$add_qry[] = "(cate='".$env->_get['schcate']."')";
	$add_url.= "&schcate=".$env->_get['schcate'];
}

if (count($add_qry) > 0) {
	$str_add_qry = implode(" AND ", $add_qry);
	$cls_pdt->set_fix_where_qry($str_add_qry);
}

$cls_pdt->set_fix_url_val($add_url);
$cls_pdt->init();

//-------------------------------------------------------------------------------------------------

/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "list"	:

		$__cfg['nav'][2] = "제품 목록";

		$env->_get['pg'] = (empty($env->_get['pg'])) ? 1 : $env->_get['pg'];

		$base_url = RTW_ADM."/app/";
	break;

	case "form"	:

		//제품 정보
		$_r = $dbo->fetch("SELECT * FROM RT_PRODUCT WHERE seq='".$env->_get['seq']."'");

		//상용 템플릿
		$formtpl_arr = $dbo->fetch_list("SELECT * FROM RT_PRODUCT_FORM_TPL ORDER BY ord ASC");

		//카테고리 출력용 클래스 호출/생성
		rt_load_component("category");
		$cls_ct = new category("PRODUCT");
		$cls_ct->dbLoadCategory();

		//카테고리 목록 세팅
		$cls_ct->setCateList("0");

		//정보 입력 구분 설정
		if ($_r['seq']) {

			$__cfg['nav'][2] = "정보 수정";
			$__cfg['mode'] = "modify";

			$vopt_tit = unserialize(html_entity_decode($_r['vopt_tit']));
			$vopt_val = unserialize(html_entity_decode($_r['vopt_val']));

			$_r['mod_date'] = substr($_r['mod_date'], 0, 10);
			$_r['reg_date'] = substr($_r['reg_date'], 0, 10);

			//상세 이미지 파일
			$attc_img_tmp = $dbo->fetch_list("SELECT * FROM RT_PRODUCT_FILES WHERE pdt_seq='".$_r['seq']."' AND file_type='img' ORDER BY file_num ASC");
			for ($m = 0; $m < count($attc_img_tmp); $m++) {
				$attc_img_arr[$attc_img_tmp[$m]['file_num']] = $attc_img_tmp[$m];
			}

			//다운로드 첨부 파일
			$attc_file_tmp = $dbo->fetch_list("SELECT * FROM RT_PRODUCT_FILES WHERE pdt_seq='".$_r['seq']."' AND file_type='file' ORDER BY file_num ASC");
			for ($m = 0; $m < count($attc_file_tmp); $m++) {
				$attc_file_arr[$attc_file_tmp[$m]['file_num']] = $attc_file_tmp[$m];
			}

			${"type_".$_r['type_en']} = "checked";
			${"detail_img_cont_is_".$_r['detail_img_cont_is']} = "checked";

			if ($_r['type_en'] == "img") {
				$type_en_img = "";
				$type_en_html = "none";
				$type_en_field = "none";
			} else if ($_r['type_en'] == "html") {
				$type_en_img = "none";
				$type_en_html = "";
				$type_en_field = "none";
			} else if ($_r['type_en'] == "field") {
				$type_en_img = "none";
				$type_en_html = "none";
				$type_en_field = "";
			}

		} else {

			$__cfg['nav'][2] = "제품 등록";
			$__cfg['mode'] = "insert";

			//가상 기본 옵션
			$optset_arr = $dbo->fetch("SELECT * FROM RT_PRODUCT_OPTION WHERE default_en='y' LIMIT 1");

			//기본 옵션명 세팅
			$_r['opt_tit1'] = $optset_arr['opt_field1'];
			$_r['opt_tit2'] = $optset_arr['opt_field2'];
			$_r['opt_tit3'] = $optset_arr['opt_field3'];
			$_r['opt_tit4'] = $optset_arr['opt_field4'];

			$vopt_tit = unserialize(html_entity_decode($optset_arr['vopt']));

			$type_field = "checked";
			$detail_img_cont_is_n = "checked";

			$type_en_img = "none";
			$type_en_html = "none";
			$type_en_field = "";
		}
	break;
}

$__cfg['page'] = "".$__cfg['page']." <span style='color:#999999;'> | ".$__cfg['nav'][2]."</span>";
?>