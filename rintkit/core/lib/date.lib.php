<?
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 날짜 처리 함수
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (defined('_RT_LIB_DATE_') === FALSE) {

	define('_RT_LIB_DATE_',TRUE);

	//----------------------------------------------------------------------------------------------

	/**
	 * 오늘 날짜를 기준으로 이전 날짜 뽑아내기
	 *
	 * @param		integer				$ai_step			:	뒤로일수, 1이면 1일전 Y-m-d, 2면 2일전
	 * @param		string				$as_format			:	적용할 윈도우(self, parent, opener)
	 * @return		date
	 */

	function rt_get_prev_date($ai_step=1, $as_format="Y-m-d") {

		$ymd = date("Ymd");

		$y = substr($ymd, 0, 4);
		$m = substr($ymd, 4, 2);
		$d = substr($ymd, 6, 2);

		return date($as_format, mktime(0, 0, 0, $m, $d-$ai_step, $y));
	}

	//----------------------------------------------------------------------------------------------

	/**
	 * 지난 시간을 텍스트로 형태 출력
	 *
	 * @param		string				$adt_Expire			:	뒤로일수, 1이면 1일전 Y-m-d, 2면 2일전
	 * @return		string
	 */

	function rt_put_date_diff($adt_Expire) {

		$arrWeekStr = array("일요일","월요일","화요일","수요일","목요일","금요일","토요일");
		$arrDayStr = array("AM"=>"오전","PM"=>"오후");

		$now = date("Y-m-d H:i:s");
		$arDiff = rt_get_interval_to_date($now, $adt_Expire);

		#timestamp
		$tmsNow = rt_convert_date_to_unixtime($now);
		$tmsDif = rt_convert_date_to_unixtime($adt_Expire);

		#ymdhis
		$arrNow = rt_convert_time_to_date_arr($now);
		$arrDif = rt_convert_time_to_date_arr($adt_Expire);

		#data
		$arr[w] = $arrWeekStr[date("w",$tmsDif)];
		$arr[A] = $arrDayStr[date("A",$tmsDif)];
		$arr[G] = date("g",$tmsDif);
		$arr[i] = date("i",$tmsDif);

		if ($arrDif[0] == $arrNow[0]) {

			if ($arrDif[1] == $arrNow[1]) {

				if ($arDiff['d'] > 0) {

					if ($arDiff['d'] == 1) {
						$strRet = "어제 ".$arr[A]." ".$arr[G].":".$arr[i];
					} else if ($arDiff['d'] > 1 && $arDiff['d'] < 7) {
						$strRet = $arr[w]." ".$arr[A]." ".$arr[G].":".$arr[i];
					} else if ($arDiff['d'] == 7) {
						$strRet ="일주일 전 ".$arr[A]." ".$arr[G].":".$arr[i];
					} else if ($arDiff['d'] > 1) {
						$strRet = $arDiff['d']."일 전 ".$arr[A]." ".$arr[G].":".$arr[i];
					}

				} else if($arDiff['h'] > 0) {
					$strRet = $arDiff['h']."시간 전";
				} else if($arDiff['i'] > 0) {
					$strRet = ($arDiff['i'] > 49 && $arDiff['i'] < 60) ? "약 1시간 전" : $arDiff['i']."분 전";
				} else {
					$strRet = ($arDiff['s'] < 30) ? "방금" : "약 1분 전";
				}

			} else { //if ($arrDif[1] == $arrNow[1]) {
				$strRet = $arrDif[1]."월 ".$arrDif[2]."일 ".$arr[w]." ".$arr[A]." ".$arr[G].":".$arr[i];
			}

		} else { //if ($arrDif[0] == $arrNow[0]) {
			$strRet = $arrDif[0]."년 ".$arrDif[1]."월 ".$arrDif[2]."일 ".$arr[w]." ".$arr[A]." ".$arr[G].":".$arr[i];
		}
		return $strRet;
	}

	//----------------------------------------------------------------------------------------------

	/**
	 * 두 개의 날짜간격을 일,시,분,초 단위로 회신
	 *
	 * @param		string		$adt_diff		: 비교날짜(Y-m-d H:i:s)
	 * @param		string		$adt_expire		: 만료일(Y-m-d H:i:s)
	 * @return		string
	 */

	function rt_get_interval_to_date($adt_diff, $adt_expire) {

		$diff_time  = rt_convert_date_to_unixtime($adt_diff);
		$expire_time = rt_convert_date_to_unixtime($adt_expire);

		$ret['s'] = $diff_time - $expire_time;
		$ret['i'] = round($ret['s'] / 60);
		$ret['h'] = round($ret['i'] / 60);
		$ret['d'] = round($ret['h'] / 24);

		return $ret;
	}

	//----------------------------------------------------------------------------------------------

	/**
	 * 날짜정보를 유닉스 타임으로 변환
	 *
	 * @param		string		$adt			: 변환할 날짜
	 * @return		integer
	 */

	function rt_convert_date_to_unixtime($adt) {

		$tmp = explode(" ",$adt);
		$arrYmd = explode("-",$tmp[0]);
		$arrHis = explode(":",$tmp[1]);

		return mktime($arrHis[0],$arrHis[1],$arrHis[2],$arrYmd[1],$arrYmd[2],$arrYmd[0]);
	}

	//----------------------------------------------------------------------------------------------

	/**
	 * 날짜를 배열로 형태로 변환
	 *
	 * @param		string		$adt			: 변환할 날짜
	 * @return		array
	 */

	function rt_convert_time_to_date_arr($adt) {

		$tmp = explode(" ",$adt);
		$ymd = explode("-",$tmp[0]);
		$his = explode(":",$tmp[1]);
		$ret[] = $ymd[0];
		$ret[] = (int)$ymd[1];
		$ret[] = $ymd[2];
		$ret[] = $his[0];
		$ret[] = $his[1];
		$ret[] = $his[2];

		return $ret;
	}

	//----------------------------------------------------------------------------------------------

	/**
	 * 선택 월의 말일 계산
	 *
	 * @param		integer		$year			: 대상 연도
	 * @param		integer		$month			: 대상 월
	 * @return		array
	 */

	function rt_month_end_day($year, $month) {

		$year = (int)$year;
		$month = (int)$month;

		$dt = mktime(0, 0, 0, $month + 1, 0, $year);
		return date("d", $dt);
	}

	//----------------------------------------------------------------------------------------------
}
?>