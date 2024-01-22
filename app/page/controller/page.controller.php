<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: PAGE Controller
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-----------------------------------------------------------------------------------------

if( !class_exists("page") )
{
	class page
	{
		var $env, $dbo;

		//----------------------------------------------------------------------------------------------

		function page() {

			global $env, $dbo;

			$this->env = $env;
			$this->dbo = $dbo;
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 초기화
		 */

		function reset_app() {

			$cnt = 0;
			if ($this->dbo->query("DELETE FROM RT_CATEGORY WHERE groupcode='PAGE'")) {
				$cnt++;
			}

			if ($this->dbo->query("TRUNCATE TABLE RT_PAGE")) {
				$cnt++;
			}

			if ($this->dbo->query("TRUNCATE TABLE RT_PAGE_404")) {
				$cnt++;
			}

			if ($this->dbo->query("TRUNCATE TABLE RT_PAGE_MATCH")) {
				$cnt++;
			}

			//등록 파일 삭제

			return ($cnt > 1) ? true : false;
		}

		//----------------------------------------------------------------------------------------------
	}
}
?>