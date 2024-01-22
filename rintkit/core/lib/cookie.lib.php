<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 쿠키 처리 함수
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (defined('_RT_LIB_COOKIE_') === FALSE) {

	define('_RT_LIB_COOKIE_',TRUE);

	//----------------------------------------------------------------------------------------------

	/** 
	 * 쿠키 만들기
	 * 
	 * @param string		as_name				: 쿠키 명
	 * @param string		as_value			: 쿠키 값
	 * @param integer		ai_day				: 유효 기간(일)
	 */

	function rt_set_cookie($as_name, $as_value, $ai_day=1) {

		$expire_day = $ai_day*24*60*60+time();
		setCookie($as_name, $as_value, $expire_day, "/");
	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * 쿠키 가져오기
	 * 
	 * @param string		as_name				: 쿠키 명
	 * @return				data type
	 */

	function rt_get_cookie($as_name) {

		global $env;

		return $env->_cookie[$as_name];
	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * 특정 쿠키 삭제
	 * 
	 * @param string		as_name				: 쿠키 명
	 */

	function rt_del_cookie($as_name) {

		setcookie($as_name, "", time()-3600, "/");
	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * 모든 쿠키 삭제
	 */

	function rt_del_cookie_all() {

		global $env;

		foreach($env->_cookie as $k => $v) {
			setcookie($env->_cookie[$k], "", time()-3600);
		}
	}

	//----------------------------------------------------------------------------------------------
}
?>