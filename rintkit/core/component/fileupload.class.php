<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 파입업로드 콤포넌트
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (!class_exists("fileupload")) {

	class fileupload {

		var $dbo				= NULL;
		var $path_base			= "";
		var $path_sub			= "";
		var $upload_path		= "";

		//----------------------------------------------------------------------------------------------

		/**
		 * 생성자
		 */
		function fileupload($path="") {

			global $dbo;

			$this->dbo = $dbo;
			$this->path_base = str_replace("//","/",$path);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 파일 업로드
		*
		* @param	object				$attach_file			:	업로드 원본 파일
		* @param	string				$path_sub				:	저장 디렉토리
		* @return	array
		*/
		function upload($attach_file, $path_sub="") {

			$ar_info = array();
			$ar_info['result'] = false;
			$ar_info['name'] = $attach_file['name'];

			$ar_div = explode(".", $attach_file['name']);
			$ar_info['ext'] = strtolower($ar_div[1]);
			$ar_info['size'] = $attach_file['size'];

			$this->path_sub = ($path_sub) ? $path_sub."/" : "/";
			$this->upload_path = RT_DOC_ROOT.$this->path_base;
			$this->upload_path = ereg_replace("/$", "", $this->upload_path);
			$this->upload_path.= $this->path_sub;
			$this->upload_path = str_replace("//", "/", $this->upload_path);

			//새 파일명 생성
			$new_file_name = $this->make_filename();
			$ar_info['name_new'] = $new_file_name.".".$ar_info['ext'];

			//파일 이동 및 퍼미션
			@copy($attach_file['tmp_name'], $this->upload_path.$ar_info['name_new']);
			$ar_info['path_base'] = $this->path_base;
			$ar_info['path_sub'] = $this->path_sub;

			@chmod($this->upload_path.$new_file_name, 0777);
			@unlink($attach_file['tmp_name']);

			$ar_info['result'] = true;

			return $ar_info;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 파일 삭제
		*
		* @param	string				$delfile			:	삭제할 파일명
		* @param	string				$path_sub				:	저장 디렉토리
		* @return	array
		*/
		function delete_file($delfile, $path_sub="") {

			$this->path_sub = ($path_sub) ? $path_sub."/" : "/";
			$this->upload_path = RT_DOC_ROOT.$this->path_base;
			$this->upload_path = ereg_replace("/$", "", $this->upload_path);
			$this->upload_path.= $this->path_sub;
			$this->upload_path = str_replace("//", "/", $this->upload_path);

			if (is_file($this->upload_path.$delfile)) {
				@unlink($this->upload_path.$delfile);
			}
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 새 파일명 생성
		*
		* @return string
		*/
		function make_filename()
		{
			$r = "";
			$str = explode(",","A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,0,1,2,3,4,5,6,7,8,9");
			shuffle($str);
			$r .= $str[0].$str[2].$str[3].$str[4].$str[5];

			return date('YmdHis')."-".$r;
		}

		//------------------------------------------------------------------------------------

	}
}
?>