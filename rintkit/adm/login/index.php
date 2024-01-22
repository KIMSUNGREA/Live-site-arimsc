<?php
//-------------------------------------------------------------------------------------------------

require_once "../engine.php";

//-------------------------------------------------------------------------------------------------


/** 
 * 데이터 설정
 */
$save_adm_id = rt_get_cookie("save_adm_id");

if (empty($env->_cookie['save_adm_id'])) {
	$is_save_id =  "";
	$checked_class = "";
} else {
	$is_save_id =  "checked='checked'";
	$checked_class = "class='check'";
}

/**
 * login theme setting
 */

require_once "login.php";
?>