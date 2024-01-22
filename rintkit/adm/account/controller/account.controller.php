<?php
//-----------------------------------------------------------------------------------------
/*
 * 클래스명	: adm_account
 * 인코딩	: UTF-8
 * 설명		: 관리자 계정 관리
 */
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (!class_exists("adm_account")) {

	class adm_account {

		var $dbo				= NULL;
		var $adm_id				= "";
		var $adm_nm				= "";
		var $auth_code			= "";
		var $db_tbl				= "RT_ACCOUNT";

		//----------------------------------------------------------------------------------------------

		/** 
		 * 생성자
		 */
		function adm_account() {

			global $env, $dbo;

			$this->dbo = $dbo;
			$this->adm_id = $env->_session['RT_ADM_ID'];
			$this->adm_nm = $env->_session['RT_ADM_NM'];
			$this->auth_code = $env->_session['RT_ADM_AUTH_CODE'];

		}

		//----------------------------------------------------------------------------------------------

		/**
		 * 로그인 여부
		 * 
		 * @return boolean					해당 Config
		 */
		function is_login() {

			return ($this->adm_id) ? true : false;

		}

		//----------------------------------------------------------------------------------------------

		/**
		* 로그인 실행
		*
		* @param	Array			$ar_info			:	로그인 정보 배열 - adm_id, adm_pw
		*/
		function login($aa_info) {

			$input_pwd = rt_password($aa_info['adm_pw']);

			$row = $this->dbo->fetch("SELECT * FROM ".$this->db_tbl." WHERE adm_id='".$aa_info['adm_id']."' AND adm_pw='".$input_pwd."'");

			if ($row['adm_id'] == $aa_info['adm_id']) {

				//계정 부가 정보 업데이트
				$udata = array();
				$udata['login_date'] = date("Y-m-d H:i:s");
				$udata['login_ip'] = $_SERVER['REMOTE_ADDR'];
				$this->dbo->update($this->db_tbl, $udata, "seq=".$row['seq']);

				//로그인 인증 데이터 설정
				$this->adm_id = $row['adm_id'];
				$this->adm_nm = $row['adm_nm'];
				$this->auth_code = $row['auth_code'];

				$_SESSION['RT_ADM_ID'] = $row['adm_id'];
				$_SESSION['RT_ADM_NM'] = $row['adm_nm'];
				$_SESSION['RT_ADM_AUTH_CODE'] = $row['auth_code'];

				return true;

			} else {

				return false;
			}
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 로그아웃 
		 */
		function logout() { 

			$this->dbo			= null;
			$this->adm_id		= "";
			$this->auth_code		= "";
			$this->db_tbl		= "";

			session_destroy();
		}

		//----------------------------------------------------------------------------------------------

	}

}
?>