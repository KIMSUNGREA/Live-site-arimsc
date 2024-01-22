<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: DB Query 처리 함수
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (defined('_LIB_DBQUERY_') === FALSE) {

	define('_LIB_DBQUERY_',TRUE);

	//-----------------------------------------------------------------------------------------

	/**
	* 검색 쿼리 만들기
	*
	* @param		array				$ar_field				:	검색 대상 필드
	* @param		array				$ar_sch					:	검색 단어 배열
	* @return		string
	*/
	function rt_make_search_qry($ar_field, $ar_sch) {

		$qryStr = "";
		$qry_step1 = array();
		$qry_step2 = array();

		foreach ($ar_field as $k => $v) {

			$qry_step1 = null;

			for ($m = 0; $m < count($ar_sch); $m++) {
				$qry_step1[] = $v." LIKE '%".$ar_sch[$m]."%'";
			}
			if (count($qry_step1)> 0) $qry_step2[] = "(".implode(" OR ", $qry_step1).")";
		}

		if (count($qry_step2)> 0) {
			$qryStr = "(".implode(" OR ", $qry_step2).")";
		} else {
			$qryStr = "1=1";
		}

		return $qryStr;
	}

	/**
	* 초성 검색 쿼리 생성
	*
	* @param		string		$as_chosung				: 대상 초성자(ㄱ,ㄴ,ㄷ...)
	* @param		string		$as_field				: 검색 필드명
	* @return		string
	**/
	function rt_chosung_query($as_chosung, $as_field) {

		$qry = "";

		switch ($as_chosung)
		{
			case 'ㄱ':
					$qry = "(".$as_field." RLIKE '^(ㄱ|ㄲ)' OR ( ".$as_field." >= '가' AND ".$as_field." < '나' ))"; 
					break;
			case 'ㄴ':
					$qry = "(".$as_field." RLIKE '^ㄴ' OR ( ".$as_field." >= '나' AND ".$as_field." < '다' ))"; 
					break;
			case 'ㄷ':
					$qry = "(".$as_field." RLIKE '^(ㄷ|ㄸ)' OR ( ".$as_field." >= '다' AND ".$as_field." < '라' ))"; 
					break;
			case 'ㄹ':
					$qry = "(".$as_field." RLIKE '^ㄹ' OR ( ".$as_field." >= '라' AND ".$as_field." < '마' ))"; 
					break;
			case 'ㅁ':
					$qry = "(".$as_field." RLIKE '^ㅁ' OR ( ".$as_field." >= '마' AND ".$as_field." < '바' ))";
					break;
			case 'ㅂ':
					$qry = "(".$as_field." RLIKE '^ㅂ' OR ( ".$as_field." >= '바' AND ".$as_field." < '사' ))"; 
					break;
			case 'ㅅ':
					$qry = "(".$as_field." RLIKE '^(ㅅ|ㅆ)' OR ( ".$as_field." >= '사' AND ".$as_field." < '아' ))"; 
					break;
			case 'ㅇ':
					$qry = "(".$as_field." RLIKE '^ㅇ' OR ( ".$as_field." >= '아' AND ".$as_field." < '자' ))"; 
					break;
			case 'ㅈ':
					$qry = "(".$as_field." RLIKE '^(ㅈ|ㅉ)' OR ( ".$as_field." >= '자' AND ".$as_field." < '차' ))"; 
					break;
			case 'ㅊ':
					$qry = "(".$as_field." RLIKE '^ㅊ' OR ( ".$as_field." >= '차' AND ".$as_field." < '카' ))"; 
					break;
			case 'ㅋ':
					$qry = "(".$as_field." RLIKE '^ㅋ' OR ( ".$as_field." >= '카' AND ".$as_field." < '타' ))"; 
					break;
			case 'ㅌ':
					$qry = "(".$as_field." RLIKE '^ㅌ' OR ( ".$as_field." >= '타' AND ".$as_field." < '파' ))"; 
					break;
			case 'ㅍ':
					$qry = "(".$as_field." RLIKE '^ㅍ' OR ( ".$as_field." >= '파' AND ".$as_field." < '하' ))"; 
					break;
			case 'ㅎ':
					$qry = "(".$as_field." RLIKE '^ㅎ' OR ( ".$as_field." >= '하'))"; 
					break;
			default:
					$qry = "";
		}
		return $qry;
	}

}
?>