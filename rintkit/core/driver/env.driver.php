<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 솔루션 환경 연동 드라이버
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (!class_exists("env_driver_class")) {

	class env_driver_class {

		var $_session = null;
		var $_cookie = null;
		var $_get = null;
		var $_post = null;
		var $_files = null;
		var $_server = null;
		var $_request = null;


		//-------------------------------------------------------------------------------------------

		function env_driver_class() {

			$this->_var_server();
			$this->_var_session();
			$this->_var_cookie();
			$this->_var_post_files();
			$this->_var_post();
			$this->_var_get();
			$this->_var_request();
		}

		//-------------------------------------------------------------------------------------------

		/** 
		 * $_SERVER 설정
		 */
		function _var_server() {

			global $_SERVER, $HTTP_SERVER_VARS;

			if (!empty($HTTP_SERVER_VARS)) $_SERVER = $HTTP_SERVER_VARS;

			$this->_server = $_SERVER;
		}

		//-------------------------------------------------------------------------------------------

		/** 
		 * $_SESSION 설정
		 */
		function _var_session() {

			global $_SESSION, $HTTP_SESSION_VARS;

			if (!empty($HTTP_SESSION_VARS)) $_SESSION = $HTTP_SESSION_VARS;

			$this->_session = $_SESSION;
		}

		//-------------------------------------------------------------------------------------------

		/** 
		 * $_COOKIE 설정
		 */
		function _var_cookie() {

			global $_COOKIE, $HTTP_COOKIE_VARS;

			if (!empty($HTTP_COOKIE_VARS)) $_COOKIE = $HTTP_COOKIE_VARS;

			$this->_cookie = $_COOKIE;
		}

		//-------------------------------------------------------------------------------------------

		/** 
		 * $_FILES 설정
		 */

		function _var_post_files() {

			global $_FILES, $HTTP_POST_FILES;

			if (!empty($HTTP_POST_FILES)) $_FILES = $HTTP_POST_FILES;

			$this->_files = $_FILES;
		}

		//-------------------------------------------------------------------------------------------

		/** 
		 * $_POST 설정
		 */
		function _var_post() {

			global $_POST, $HTTP_POST_VARS;

			if (!empty($HTTP_POST_VARS)) $_POST = $HTTP_POST_VARS;

			$this->_post = $_POST;
		}

		//-------------------------------------------------------------------------------------------

		/** 
		 * $_GET 설정
		 */
		function _var_get() {

			global $_GET, $HTTP_GET_VARS;

			if (!empty($HTTP_GET_VARS)) $_POST = $HTTP_GET_VARS;

			$this->_get = $_GET;
		}

		//-------------------------------------------------------------------------------------------

		/** 
		 * $_REQUEST 설정
		 */
		function _var_request() {

			global $_REQUEST, $HTTP_REQUEST_VARS;

			if (!empty($HTTP_REQUEST_VARS)) $_REQUEST = $HTTP_REQUEST_VARS;

			$this->_request = $_REQUEST;
		}

		//-------------------------------------------------------------------------------------------

	}

}
?>