<?
//-------------------------------------------------------------------------------------------------

require_once "../../engine.php";

//-------------------------------------------------------------------------------------------------

$data = array();//DB 필드데이터

if ($env->_post['mode'] == "insert")
{
	//변수 유효성 체크
	if (empty($env->_post['new_menu_nm'])) {
		rt_js_msg("추가할 메뉴명을 정확히 입력해 주세요");
		exit;
	}

	//출력 순서 초기설정
	$_r = $dbo->fetch("SELECT MAX(ord) AS maxord FROM RT_GNB");

	$data['menu_nm'			] = $env->_post['new_menu_nm'];
	$data['link_target_en'	] = "_self";
	$data['link_uri'		] = "";
	$data['menu_en'			] = "y";
	$data['menu_auth_en'	] = "normal";
	$data['ord'				] = $_r['maxord'] + 1;

	if ($dbo->insert("RT_GNB", $data)) {
		rt_js_move("", "parent", "reload");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "modify")
{
	$data['menu_nm'			] = $env->_post['menu_nm'];
	$data['link_target_en'	] = $env->_post['link_target_en'];
	$data['link_uri'		] = $env->_post['link_uri'];
	$data['menu_en'			] = $env->_post['menu_en'];
	$data['menu_auth_en'	] = $env->_post['menu_auth_en'];

	if ($dbo->update("RT_GNB", $data, "seq=".$env->_post['seq'])) {
		rt_js_msg("정보가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

}
else if ($env->_get['mode'] == "delete" && is_numeric($env->_get['seq']))
{
	$result = $dbo->query("DELETE FROM RT_GNB WHERE seq='".$env->_get['seq']."'");

	if ($result) {
		rt_js_move("", "parent", "href", RTW_ADM."/gnb/?sd=gnb");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_get['mode'] == "chgord" && $env->_get['part'] && is_numeric($env->_get['seq']))
{
	$r = $dbo->fetch("SELECT * FROM RT_GNB WHERE seq='".$env->_get['seq']."'");

	if ($env->_get['part'] == "up") {
		$t = $dbo->fetch("SELECT * FROM RT_GNB WHERE ord < ".$r['ord']." ORDER BY ord DESC LIMIT 1");
	} else if ($env->_get['part'] == "down") {
		$t = $dbo->fetch("SELECT * FROM RT_GNB WHERE ord > ".$r['ord']." ORDER BY ord ASC LIMIT 1");
		
	}

	if (is_numeric($t['seq'])) {

		$data['ord'] = $r['ord'];
		$dbo->update("RT_GNB", $data, "seq='".$t['seq']."'");

		$data['ord'] = $t['ord'];
		$dbo->update("RT_GNB", $data, "seq='".$r['seq']."'");
	}

	rt_js_move("", "parent", "reload");
}
exit;
?>