<?
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 파일 처리 함수
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (defined('_LIB_FILE_') === FALSE) {

	define('_LIB_FILE_',TRUE);

	//-----------------------------------------------------------------------------------------

	/**
	* 파일 다운로드
	*
	* @param		string				$file_save_name		:	DB에 저장되는 파일명
	* @param		string				$file_real_name		:	업로드 시 파일명
	* @param		string				$dir_path			:	파일경로
	*/

	function rt_download($file_save_name, $file_real_name, $dir_path) {

		$df = RT_DOC_ROOT.$dir_path.$file_save_name;

		if (is_file($df)) {

			if(fopen(RT_DOC_ROOT.$dir_path.$file_save_name,"r")) {

				$file_real_name = iconv("UTF-8", "EUC-KR", $file_real_name);

				Header("Content-type: application/octet-stream");
				Header("Content-Length: ".filesize(RT_DOC_ROOT.$dir_path.$file_save_name));
				Header("Content-Disposition: attachment; filename=".$file_real_name);
				Header("Content-Transfer-Encoding: binary");
				Header("Pragma: no-cache");
				Header("Expires: 0");

				$fp = fopen(RT_DOC_ROOT.$dir_path.$file_save_name, "rb");
				while(!feof($fp)) {
					echo fread($fp, 100*1024);
					flush();
				}
				fclose ($fp);
			}
		} else {
			rt_js_msg("파일이 없습니다.");exit;
		}
	}

	//-----------------------------------------------------------------------------------------

	/**
	* Byte 단위의 사이즈를 상위 용량 단위로 적절히 변환하여 회신
	*
	* @param	integer				$ai_size		 :	파일용량 (Byte)
	* @return	string
	*/
	function rt_get_file_unit_format($ai_size) {

		$units = array('B', 'KB', 'MB', 'GB', 'TB');

		for ($i = 0; $ai_size >= 1024 && $i < 4; $i++) {
			$ai_size /= 1024;
		}

		return round($ai_size, 2).$units[$i];
	}

	//-----------------------------------------------------------------------------------------

	/**
	* 타겟 디렉토리 포함 이하 모두 삭제
	*
	* @param	string				$dir		 :	삭제할 디렉토리 경로(RT_ROOT."/_test/")
	*/
	function rt_dir_delete($dir) {

		$files = array_diff(scandir($dir), array('.','..'));
		foreach ($files as $file) {
			(is_dir("$dir/$file")) ? rt_dir_delete("$dir/$file") : unlink("$dir/$file");
		}
		return @rmdir($dir); 
	}

	//-----------------------------------------------------------------------------------------

	/**
	* 타겟 파일 삭제
	*
	* @param	string				$target_path		:	디렉토리 경로(RT_DOC_ROOT."/_test/")
	* @param	string				$file				:	삭제할 파일명
	*/
	function rt_file_delete($target_path, $file, $debug="false") {

		$abs_path = RT_DOC_ROOT.$target_path;

		if ($debug) {
			unlink($abs_path.$file);
		} else {
			@unlink($abs_path.$file);
		}
	}

	//-----------------------------------------------------------------------------------------

	/**
	* 파일 리스트 회신
	*
	* @param	string				$as_dir			:	디렉토리 경로
	* @return	array
	*/
	function rt_template_list($as_dir) {

		$arr_ret = array();

		if (is_dir($as_dir)) {

			$objDir = dir($as_dir);
			while (false !== ($entry = $objDir->read()))
			{
				if ($entry != "." && $entry != "..") {
					$arr_ret[] = $entry;
				}
			}
			$objDir->close();

			asort($arr_ret);

			return $arr_ret;
		}
	}

	//-----------------------------------------------------------------------------------------

	/**
	* 파일 쓰기
	*
	* @param	string				$content		:	내용
	* @param	string				$file_name		:	파일 이름
	* @param	string				$dir_path		:	디렉토리 경로
	* @param	string				$mode			:	a:추가, w:새로작성, r:읽기
	*/
	function rt_file_write($content, $file_name, $dir_path, $mode) {

		$file = fopen(RT_DOC_ROOT.$dir_path.$file_name, $mode);

		if ($file){
			fwrite($file, $content);

			fclose($file);

			return true;
		} else {
			return false;
		}
	}

	//-----------------------------------------------------------------------------------------
}
?>