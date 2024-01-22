<?php
//-------------------------------------------------------------------------------------------------
/*
 * APP CODE			: product
 * APP SECTION		: admin-category
 *
 * 설명 : 제품 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

/**
 * 네비게이션 데이터
 */

$__cfg = array();
$__cfg['nav'][0] = "제품 관리";
$__cfg['nav'][1] = "분류 관리";
$__cfg['page'] = "제품 관리";

//-------------------------------------------------------------------------------------------------

/**
 * 공동 데이터
 */

$_def = array();
$_def['path_app'] = $_app['app_path'];
$_def['path_admin'] = $_def['path_app']."/admin";
$_def['path_assets'] = $_def['path_app']."/assets";
$_def['func'] = ($env->_get['cf']) ? $env->_get['cf'] : "category";

//-------------------------------------------------------------------------------------------------

/**
 * 페이지 별 출력 데이터 세팅
 */

switch ($_def['func'])
{
	case "category"	:

		$__cfg['nav'][2] = "분류 설정";

		//카테고리 출력용 클래스 호출/생성
		rt_load_component("category");
		$cls_ct = new category("PRODUCT");
		$cls_ct->dbLoadCategory();

		//카테고리 목록 세팅
		$cls_ct->setCateList("0");

		$data = array();
		for ($m = 0; $m < count($cls_ct->listdata['code']); $m++) {

			$r = $dbo->fetch("SELECT * FROM RT_PRODUCT_CATE_CONF WHERE code='".$cls_ct->listdata['code'][$m]."'");

			$data[$m]['depth'] = $cls_ct->listdata['depth'][$m];
			$data[$m]['code'] = $cls_ct->listdata['code'][$m];
			$data[$m]['label'] = $cls_ct->listdata['label'][$m];
			$data[$m]['parent'] = $cls_ct->listdata['parent'][$m];
			$data[$m]['use_is'] = $r['use_is'];
			$data[$m]['type_en'] = $r['type_en'];
			$data[$m]['auth_en'] = $r['auth_en'];
		}
	break;
}

$__cfg['page'] = "".$__cfg['page']." <span style='color:#999999;'> | ".$__cfg['nav'][2]."</span>";
?>