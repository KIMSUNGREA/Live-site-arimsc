<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 이미지 처리 함수
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (defined('_LIB_IMAGE_') === FALSE) {

	define('_LIB_IMAGE_',TRUE);

	//-----------------------------------------------------------------------------------------

	/**
	* 이미지를 지정된 상대 사이즈로 축소하여 화면에 출력
	*
	* @param String			$objImg				: 이미지경로(절대경로)
	* @param Integer		$limitWidth			: 최대 가로사이즈
	* @param Integer		$limitHeight		: 최대 세로사이즈
	* @return Array
	**/

	function rt_get_relative_size($objImg, $limitWidth, $limitHeight) {

		$arRet = array();

		if ($objImg) {

			$objImg = RT_DOC_ROOT.$objImg;

			$imgsize = getimagesize($objImg);

			if ($imgsize[0] > $limitWidth || $imgsize[1] > $limitHeight) {

				if ($imgsize[0] < $imgsize[1]) {
					$sumw = (100*$limitHeight)/$imgsize[1];
					$img_width = ceil(($imgsize[0]*$sumw)/100);
					$img_height = $limitHeight; 
				} else {
					$sumh = (100*$limitWidth)/$imgsize[0];
					$img_height = ceil(($imgsize[1]*$sumh)/100);
					$img_width = $limitWidth;
				}

			} else {

				$img_width = $imgsize[0];
				$img_height = $imgsize[1];
			}

			$arRet['width'] = $img_width;
			$arRet['height'] = $img_height;
		}

		return $arRet;
	}

	//-----------------------------------------------------------------------------------------

	/**
	* 이미지 파일여부 회신
	*
	* @param		string				$file_name		 :	파일명
	* @param		string				$path			 :	파일경로
	* @return		boolean
	*/
	function rt_is_image($file_name, $path) {

		$arImgMime = array('image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png', 'image/gif','image/bmp','image/pjpeg');

		$file_path = RT_DOC_ROOT.$path."/".$file_name;
		$arAttc = getimagesize($file_path);

		if (in_array($arAttc['mime'], $arImgMime)) {
			return true;
		} else {
			return false;
		}
	}

}
?>