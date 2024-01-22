<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: Popup controller
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if( !class_exists("popup") )
{
	class popup
	{
		var $env, $dbo, $popup;

		//----------------------------------------------------------------------------------------------

		function popup() {

			global $env, $dbo;

			$this->env = $env;
			$this->dbo = $dbo;
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 초기화
		 */

		function reset_app() {

			$this->popup = $this->dbo->fetch_list("SELECT * FROM RT_POPUP");

			for ($m =0 ; $m < count($this->popup) ; $m++) {
				rt_file_delete($this->popup[$m]['file_subdir']."/",$this->popup[$m]['file1_new']);
			}

			if ($this->dbo->query("TRUNCATE TABLE RT_POPUP")) {
				return true;
			} else {
				return false;
			}
		}

		//----------------------------------------------------------------------------------------------
	}
}
?>