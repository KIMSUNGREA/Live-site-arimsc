<?php
//-------------------------------------------------------------------------------------------------
/*
 * 페이지 관리
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-------------------------------------------------------------------------------------------------

//네비게이션 데이터
$__cfg = array();
$__cfg['nav'][0] = "페이지 관리";

switch ($__cf)
{
	case "sitemap":

		$__cfg['nav'][1] = "사이트맵 설정";

		//카테고리 출력용 클래스 호출/생성
		rt_load_component("category");
		$cls_ct = new category("PAGE");
		$cls_ct->dbLoadCategory();

		//카테고리 목록 세팅
		$cls_ct->setCateList("0");

		$data = array();
		for ($m = 0; $m < count($cls_ct->listdata['code']); $m++) {

			$_p = $dbo->fetch("SELECT * FROM RT_PAGE WHERE pcode='".$cls_ct->listdata['code'][$m]."'");

			if ($_p['use_is'] == "y") {
				if ($_p['use_is'] == "y" && $_p['forward_is'] == "y") {
					$data[$m]['fw_str'] = "<span class='rt_green'>[포워딩 사용중]</span>";
				} else if ($_p['use_is'] == "n") {
					$data[$m]['fw_str'] = "";
				} else {
					$data[$m]['fw_str'] = "";
				}
			} else {
				$data[$m]['use_str'] = "<span class='rt_red'>[페이지 비활성]</span>";
			}

			$data[$m]['depth'] = $cls_ct->listdata['depth'][$m];
			$data[$m]['code'] = $cls_ct->listdata['code'][$m];
			$data[$m]['label'] = $cls_ct->listdata['label'][$m];
			$data[$m]['parent'] = $cls_ct->listdata['parent'][$m];
		}
	break;
}

$__sub_title = "y";
$__cfg['page'] = $__cfg['nav'][0]." <span style='color:#999999;'> | ".$__cfg['nav'][1]."</span>";
?>