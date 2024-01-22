<?php
//-------------------------------------------------------------------------------------------------
/*
 * 페이지 관리 - 페이지 링크 정보
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

//페이지 APP 환경정보
$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='page'");

//네비게이션 데이터
$__cfg = array();
$__cfg['nav'][0] = "페이지 관리";

switch ($__cf)
{
	case "code":

		$__cfg['nav'][1] = "페이지 링크 데이터";

		//$_l = $dbo->fetch_list("SELECT * FROM RT_CATEGORY AS c LEFT JOIN RT_PAGE AS p ON (c.code=p.pcode) WHERE c.groupcode='PAGE' ORDER BY c.sort ASC");

		//카테고리 출력용 클래스 호출/생성
		rt_load_component("category");
		$cls_ct = new category("PAGE");
		$cls_ct->dbLoadCategory();

		//카테고리 목록 세팅
		$cls_ct->setCateList("0");

		$data = array();
		for ($m = 0; $m < count($cls_ct->listdata['code']); $m++) {

			$data[$m]['code'] = $cls_ct->listdata['code'][$m];
			$data[$m]['label'] = $cls_ct->listdata['label'][$m];
			$data[$m]['parent'] = $cls_ct->listdata['parent'][$m];
		}
	break;
}

$__sub_title = "y";
$__cfg['page'] = $__cfg['nav'][0]." <span style='color:#999999;'> | ".$__cfg['nav'][1]."</span>";
?>