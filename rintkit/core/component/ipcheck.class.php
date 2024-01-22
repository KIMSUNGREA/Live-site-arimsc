<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 접근 IP에 따른 페이지 접속 권한 설정
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if( !class_exists("ipcheck") )
{
	class ipcheck
	{
		//-----------------------------------------------------------------------------------------

		var $dbo			= NULL;
		var $env			= NULL;
		var $db_tbl			= "RT_IP_SET";
		var $user_ip		= "";
		var $ip_list		= array();
		var $set_type		= "";
		var $is_ip_match	= false;

		//----------------------------------------------------------------------------------------------

		/**
		 * 생성자
		 *
		 * @param	string					$as_user_ip			:	IP 주소
		 */

		function ipcheck($as_user_ip)
		{
			global $dbo,$env;

			$this->dbo			= $dbo;
			$this->env			= $env;
			$this->user_ip		= $as_user_ip;
			$this->set_type		= $this->get_setting_info();

			if ($this->set_type == "N"){}else {
				$this->main();
			}
		}

		//-----------------------------------------------------------------------------------------

		function main()
		{
			#Step 1 : 체크할 IP정보 설정
			$this->check_ip();

			#Step 2 : 설정IP와 접근IP 조사하여 매칭여부 회신
			$this->inspect_ip();

			#Step 3 : 기본설정에 따른 페이지 제한 여부 설정
			$this->is_page_arrow();
		}

		//-----------------------------------------------------------------------------------------

		/**
		 * 설정IP와 접근IP 조사하여 매칭여부 회신
		 */

		function inspect_ip()
		{
			$aruser_ip = explode(".", $this->user_ip);
			$strBip = $aruser_ip[0].".".$aruser_ip[1].".".$aruser_ip[2];
			$strOip = $aruser_ip[0].".".$aruser_ip[1].".".$aruser_ip[2].".".$aruser_ip[3];

			for ($m = 0; $m < count($this->ip_list); $m++) {

				$chkIp = "";
				if ($this->ip_list[$m]['type'] == "O") {

					$chkIp = $this->ip_list[$m]['ip1'].".".$this->ip_list[$m]['ip2'].".".$this->ip_list[$m]['ip3'].".".$this->ip_list[$m]['ip4'];
					if ($chkIp == $strOip) $this->is_ip_match = true;

				} else if ($this->ip_list[$m]['type'] == "B") {

					$chkIp = $this->ip_list[$m]['ip1'].".".$this->ip_list[$m]['ip2'].".".$this->ip_list[$m]['ip3'];
					if ($chkIp == $strBip) $this->is_ip_match = true;
				}

				if ($this->is_ip_match) break;
			}
		}

		//-----------------------------------------------------------------------------------------

		/**
		 * 기본설정에 따른 페이지 제한 여부 설정
		 *
		 * D : 특정 IP만 접근 제한
		 * P : 특정 IP만 접근 허용
		 */

		function is_page_arrow()
		{
			if ($this->set_type == "D") {

				if ($this->is_ip_match) {
					rt_js_msg("접근이 제한된 IP입니다.");
					exit;
				}

			} else if ($this->set_type == "P") {

				if (!$this->is_ip_match) {
					rt_js_msg("접근이 제한된 IP입니다.");
					exit;
				}
			}
		}

		//-----------------------------------------------------------------------------------------

		/**
		* 체크할 IP정보 업데이트
		*/
		function check_ip()
		{
			if ($this->set_type == "D") {
				$fd = "deny";
			} else if ($this->set_type == "P") {
				$fd = "permit";
			}

			$this->ip_list = $this->dbo->fetch_list("SELECT * FROM ".$this->db_tbl." WHERE part='".$fd."'");
		}

		//-----------------------------------------------------------------------------------------

		/**
		* IP 제한방식 설정정보
		*/
		function get_setting_info()
		{
			global $rt_conf_db;

			return $rt_conf_db['ip_set_type'];
		}

		//-----------------------------------------------------------------------------------------
	}
}
?>
