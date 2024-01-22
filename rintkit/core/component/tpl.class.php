<?php
//-----------------------------------------------------------------------------------------
// 프로그램			: RINT-KIT
// 제작				: 린트킷(rintkit.com)
// 버전				: 1.0
// 인코딩			: UTF-8
// 설명				: 템플릿 출력 관리
// 템플릿언더바		: http://www.xtac.net/
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (!class_exists("Template_")) require_once RT_PLUGIN."/Template_.2.2.8/Template_.class.php";

if (!class_exists("tpl"))
{
	class tpl extends Template_
	{
		//----------------------------------------------------------------------------------------------

		/**
		* 게시판 생성자
		*
		* @param	string					$as_path			:	DB 명
		*/

		function tpl($as_path="")
		{
			$this->compile_dir = $as_path."/".$this->compile_dir;
			$this->template_dir = $as_path."/".$this->template_dir;
			$this->cache_dir = $as_path."/".$this->cache_dir;
		}

		//----------------------------------------------------------------------------------------------

	}
}
?>