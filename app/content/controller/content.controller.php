<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: Content controller
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if( !class_exists("content") )
{
	class content
	{
		var $dbo;

		//----------------------------------------------------------------------------------------------

		function content() {

			global $dbo;

			$this->dbo = $dbo;
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 초기화
		 */

		function reset_app() {

			$content = $this->dbo->fetch_list("SELECT * FROM RT_CONTENT");

			for ($m =0 ; $m < count($content) ; $m++) {
				if ($content[$m]['file1_new']) {
					rt_file_delete($content[$m]['file_subdir']."/",$content[$m]['file1_new']);
				}
				if ($content[$m]['file2_new']) {
					rt_file_delete($content[$m]['file_subdir']."/",$content[$m]['file2_new']);
				}
			}

			if ($this->dbo->query("TRUNCATE TABLE RT_CONTENT") && $this->dbo->query("TRUNCATE TABLE RT_CONTENT_GROUP")) {
				return true;
			} else {
				return false;
			}
		}

		//----------------------------------------------------------------------------------------------
	}
}
?>