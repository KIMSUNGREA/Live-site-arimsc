<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 이미지 썸네일 생성 콤포넌트
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if( !class_exists("thumbnail") )
{
	class thumbnail
	{
		var $real_path		= '';			//(필수) 저장된 이미지가 있는곳
		var $target_path	= '';			//(필수) 썸네일 이미지가 저장될 곳.
		var $add_name		= 'thumb_';		//(옵션) 기본값 thumb
		var $image_quality	= 100;			//(옵션) 이미지 퀄리티(%)

		//-----------------------------------------------------------------------------------------

		/**
		* 썸네일 저장 디렉토리 설정
		*/

		function check_dir() {
			if(!is_dir($this->target_path)) {
				mkdir($this->target_path, 0777);
			}
		}

		//-----------------------------------------------------------------------------------------

		/**
		* 썸네일 이미지 생성
		*
		* @param	String				$real_image		:	파일명
		* @param	String				$target_ext		:	변환될 확장자
		* @param	Integer				$width			:	가로사이즈
		* @param	Integer				$height			:	세로사이즈
		* @return	Boolen
		*/
		function resize_image($real_image, $target_ext, $real_path, $width, $height) {

			static $ext_name;
			static $src;
			static $thumb;

			$this->real_path = RT_DOC_ROOT.$real_path;
			$this->target_path = $this->real_path."thumb";

			$this->check_dir();

			$ext_name = strtolower( substr( $real_image, -3 ) );

			switch($ext_name) {
				case 'jpg' :
					$src = ImageCreateFromJPEG($this->real_path . '/' . $real_image) or die('err!');
					break;
				case 'gif' :
					$src = ImageCreateFromGIF($this->real_path . '/' . $real_image) or die('err!');
					break;
				case 'png' :
					$src = ImageCreateFromPNG($this->real_path . '/' . $real_image) or die('err!');
					break;
			}

			$thumb = ImageCreateTrueColor($width, $height);

			ImageCopyResampled($thumb, $src, 0,0,0,0, $width, $height, ImageSX($src), ImageSY($src) );

			$real_image = substr($real_image, 0, -3) . $target_ext;

			switch($target_ext) {
				case 'jpg' :
					ImageJPEG($thumb, $this->target_path . '/' . $this->add_name . $real_image, $this->image_quality) or die('err.');
					break;
				case 'gif' :
					ImageGIF($thumb, $this->target_path . '/' . $this->add_name . $real_image, $this->image_quality) or die('err.');
					break;
				case 'png' :
					ImagePNG($thumb, $this->target_path . '/' . $this->add_name . $real_image, $this->image_quality) or die('err.');
					break;
			}

			ImageDestroy($src);
			ImageDestroy($thumb);

			return $this->add_name.$real_image;
		}

		//-----------------------------------------------------------------------------------------

		/**
		* 웹에디터 업로드 이미지 사이즈 변환
		*
		* @param	String				$real_path		:	파일 경로
		* @param	String				$real_image		:	실제 파일명
		* @param	Integer				$width			:	변환할 가로사이즈
		* @param	Integer				$height			:	변환할 세로사이즈
		* @return	Boolen
		*/
		function resize_image_webeditor($real_path, $real_image, $width, $height) {

			static $ext_name;
			static $src;
			static $thumb;

			$this->real_path = $real_path;
			$this->target_path = $real_path;

			$ext_name = strtolower( substr( $real_image, -3 ) );
			switch($ext_name) {

				case 'peg' :
				case 'jpg' :
					$src = ImageCreateFromJPEG($this->real_path . $real_image) or die('err');
					break;
				case 'gif' :
					$src = ImageCreateFromGIF($this->real_path . $real_image) or die('err');
					break;
				case 'png' :
					$src = ImageCreateFromPNG($this->real_path . $real_image) or die('err');
					break;
			}

			$thumb = ImageCreateTrueColor($width, $height);

			ImageCopyResampled($thumb, $src, 0,0,0,0, $width, $height, ImageSX($src), ImageSY($src) );

			$real_image = substr($real_image, 0, -3) . $ext_name;

			switch($ext_name) {

				case 'jpeg' :
				case 'jpg' :
					@ImageJPEG($thumb, $this->target_path . $this->add_name . $real_image, $this->image_quality) or die('err');
					break;
				case 'gif' :
					@ImageGIF($thumb, $this->target_path . $this->add_name . $real_image, $this->image_quality) or die('err');
					break;
				case 'png' :
					@ImagePNG($thumb, $this->target_path . $this->add_name . $real_image, $this->image_quality) or die('err');
					break;
			}

			ImageDestroy($src);
			ImageDestroy($thumb);

			return $this->add_name.$real_image;
		}
		//-----------------------------------------------------------------------------------------
	}
}
?>