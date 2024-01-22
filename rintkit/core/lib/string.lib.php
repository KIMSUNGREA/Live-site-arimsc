<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 문자열 처리 함수
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (defined('_LIB_STRING_') === FALSE) {

	define('_LIB_STRING_',TRUE);

	//-----------------------------------------------------------------------------------------

	/**
	 * 문자열 자르기
	 *
	 * @param	integer				$as_str			:	원본 문자열
	 * @param	integer				$ai_len			:	반환예정 문자열 길이
	 * @param	integer				$as_suffix		:	문자열 후위 치환자
	 * @param	string				$as_charSet		:	문자열 코드
	 * @return	string
	 */

	function rt_str_length_cut( $as_str, $ai_len, $as_suffix="", $as_charset="UTF-8" ) {
		return mb_strimwidth($as_str, '0', $ai_len, $as_suffix, $as_charset);
	}

	//-----------------------------------------------------------------------------------------

	/**
	 * 문자열 내 특정 단어에 배경색상 CSS추가
	 *
	 * @param	array				$ar_sch				:	검색 단어 배열
	 * @param	text				$text				:	대상 텍스트
	 * @param	string				$css				:	적용할 CSS
	 */

	function rt_paint_search_word($ar_sch, $ax_text, $as_css="background-color:yellow;color:red;") {

		for ($m = 0; $m < count($ar_sch); $m++){
			$ax_text = str_replace($ar_sch[$m], "<span style='".$as_css."'>".$ar_sch[$m]."</span>", $ax_text);
		}

		return $ax_text;
	}

	//-----------------------------------------------------------------------------------------

	/**
	 * 검색 키워드 포함한 문자열 영역 가져오기
	 *
	 * @param	string				$as_keyword			:	검색 단어
	 * @param	text				$as_text			:	원본 텍스트
	 * @param	integer				$ai_len				:	반환할 문자열의 길이
	 * @param	string				$as_charset			:	문자열 코드
	 * @return	text
	 */
	
	function rt_get_str_keyword_area($as_keyword, $as_text, $ai_len, $as_charset="UTF-8") {

		if (!empty($as_keyword)) {

			$apply_pos = "";//최종 적용할 위치
			$word_pos = stripos($as_text, $as_keyword); //텍스트 내 키워드 위치
			$diff_pos = $word_pos - 90; //결과 문장내 키워드 위치 설정

			if ($diff_pos < 0) {
				$apply_pos = 0;
				$start_pos = 0;
			} else {
				$apply_pos = $diff_pos;
				$start_pos = 4;
			}

			$retstr = substr($as_text, $apply_pos, $ai_len);
			$retstr = mb_substr($retstr, $start_pos, mb_strlen($retstr, $as_charset)-4, $as_charset);//mb로 한번 필터링

			return $retstr;
		}
	}

	// ex) $str_res = rt_get_str_keyword_area("냉장고", $text, 241);
	//     $str_res = rt_paint_search_word(array("냉장고"), $str_res);

	//-----------------------------------------------------------------------------------------

	/**
	 * 문자열에서 특정 태그 제거
	 *
	 * @param	text				$str				:	대상 문자열
	 * @param	array				$tags				:	대상 태그 배열 ex) array('<br />')
	 * @return	text
	 */
	function rt_remove_tag($str, $tags) {

		if (!is_array($tags)) {

			$tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
			if(end($tags) == '') array_pop($tags);
		}

		foreach ($tags as $tag) $str = preg_replace('#</?'.$tag.'[^>]*>#is', '<br />', $str);

		return $str;
	}

	//-----------------------------------------------------------------------------------------

	/**
	 * 이름/아이디 일부 가리기(뒤에서 두번째 문자 치환)
	 *
	 * @param	string				$str_ori				:	대상 문자열
	 * @param	string				$str_chg				:	치환할 문자(*,O...)
	 * @return	text
	 */
	function rt_name_hide($str_ori, $str_chg="*") {

		return preg_replace('/.(?=.$)/u', $str_chg, $str_ori);
	}

	//-----------------------------------------------------------------------------------------

	/**
	 * DB 문자열 데이터 출력 디코딩
	 *
	 * @param	string				$str				:	필드 데이터
	 * @param	string				$prt				:	출력 타입
	 * @return	text
	 */
	function rt_dbstr_decode($str, $prt="") {

		return ($prt=="html")?stripslashes($str):htmlspecialchars_decode(stripslashes($str));
	}

	//-----------------------------------------------------------------------------------------
}
?>