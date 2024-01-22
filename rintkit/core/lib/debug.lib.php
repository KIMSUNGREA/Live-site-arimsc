<?
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 디버그용 함수
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (defined('_RT_LIB_DEBUG_') === FALSE) {

	define('_RT_LIB_DEBUG_', TRUE);

	//----------------------------------------------------------------------------------------------

	/**
	 * 데이터 배열 프린트
	 *
	 * @param		string				$arr				:	출력할 배열 변수
	 * @param		boolean				$is_exit			:	출력 후 exit 여부
	 */

	function rt_print_r($arr, $is_exit=true) {

		echo "<pre>";
		print_r($arr);
		echo "</pre>";

		if ($is_exit) {
			exit;
		}
	}

	//----------------------------------------------------------------------------------------------
}
?>