<?
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 기타 함수
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (defined('_LIB_ETC_') === FALSE) {

	define('_LIB_ETC_',TRUE);

	//-----------------------------------------------------------------------------------------

	/**
	* 새 포스트인지 판단하여 회신
	*
	* @param	string					$adt_day			:	기준 일자
	* @param	integer					$ai_limit_day		:	몇 일까지를 새 포스트로 볼 건지
	* @return	boolean
	*/

	function rt_is_new_post($adt_day, $ai_limit_day)
	{
		$predate = mktime(0,0,0, date('m'), date('d'), date('Y'));
		$strtime = substr(str_replace("-","",$adt_day),0,8);
		$strtime = strtotime($strtime);
		$diff_time = $predate - $strtime;
		$limit_time = 86400 * $ai_limit_day;

		if($diff_time < $limit_time && $strtime != 1239807600) { // 1239807600 는 초기값
			return true;
		} else {
			return false;
		}
	}

	//----------------------------------------------------------------------------------------------

	/**
	* 랜덤 비교수 생성(UP And Down)
	*
	* @param	integer					$ai_cnt		:	기본 4자리
	* @return	array
	*/
	function rt_random_code($ai_cnt=4)
	{
		$r = array();

		$randval = mt_rand();
		$r[0] = substr($randval, 0, $ai_cnt);

		$randval = mt_rand();
		$r[1] = substr($randval, 0, $ai_cnt);

		$randval = mt_rand();
		$dupc = substr($randval, -1);

		if ($r[0] != $r[1]) {
			$r[2] = ($r[0] > $r[1]) ? $r[0] : $r[1];
			return $r;
		} else {
			rt_random_code();
		}
	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * 관리자 외부소스 관리 메뉴 연동
	 * 
	 * @param integer			seq			: 고유키
	 */
	function rt_source($seq) {

		global $dbo;

		$r = $dbo->fetch("SELECT * FROM RT_SOURCE WHERE seq='".$seq."' AND use_en='y'");
		echo htmlspecialchars_decode(stripslashes($r['source']));
	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * 관리자 콘텐츠 관리 메뉴 연동
	 * 
	 * @param integer			seq				: 고유키
	 * @param integer			prtfield		: 출력 필드(html, link, path)
	 */
	function rt_content($seq, $prtfield="") {

		global $dbo, $cls_rtm;

		$r = $dbo->fetch("SELECT * FROM RT_CONTENT WHERE seq='".$seq."'");

		$ret = array();

		if ($r['login_is'] == "y" && $cls_rtm->is_login()) {
			$ret['html'	] = htmlspecialchars_decode(stripslashes($r['html2']));
			$ret['path'	] = $r['file_subdir']."/".$r['file2_new'];
		} else {
			$ret['html'	] = htmlspecialchars_decode(stripslashes($r['html1']));
			$ret['path'	] = $r['file_subdir']."/".$r['file1_new'];
		}
		$ret['href'	] = (!empty($r['href'])) ? $r['href']:"#none";

		return $ret[$prtfield];
	}

	//----------------------------------------------------------------------------------------------
}
?>