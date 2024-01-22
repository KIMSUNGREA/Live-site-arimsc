<?
//-------------------------------------------------------------------------------------------------
/**
 * IP 설정
 * 
 * $env->_post['mode'] 데이터 처리 구분
 * 
 * insert : IP 등록
 * delKey : 데이터 삭제
 */
//-------------------------------------------------------------------------------------------------

require_once "../../engine.php";

//-------------------------------------------------------------------------------------------------

$udata = array();
if($env->_post['mode'] == "insert")
{
	$udata['part'	] = $env->_post['part'	];
	$udata['type'	] = $env->_post['type'	];
	$udata['ip1'	] = $env->_post['ip1'	];
	$udata['ip2'	] = $env->_post['ip2'	];
	$udata['ip3'	] = $env->_post['ip3'	];
	$udata['ip4'	] = ($env->_post['type']=="O") ? $env->_post['ip4'] : "";
	$udata['rdate'	] = date("Y-m-d H:i:s");

	if ($dbo->insert("RT_IP_SET", $udata)) {
		rt_js_move("","parent","reload");
	} else {
		rt_js_move("시스템문제가 발생했습니다.","parent","reload");
	}
}
else if(is_numeric($env->_get['delKey']))
{
	if ($dbo->query("DELETE FROM RT_IP_SET WHERE seq='".$env->_get['delKey']."'")) {
		rt_js_move("","parent","reload");
	} else {
		rt_js_move("시스템문제가 발생했습니다.","parent","reload");
	}
}
else
{
	rt_js_move("시스템문제가 발생했습니다","parent","reload");
}
exit;
?>
