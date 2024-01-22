<?
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: URL 관련 함수
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (defined('_LIB_URL_') === FALSE) {

	define('_LIB_URL_',TRUE);

	//-----------------------------------------------------------------------------------------

	/**
	* GET 변수로 넘어온 URL DATA 타입
	*/
	function rt_url2arr($url)
	{
		$ret_arr = array();
		$data_arr = explode("?", $url);
		$path_arr = explode("/", $data_arr[0]);
		$arg_arr = explode("&", $data_arr[1]);

		foreach ($path_arr as $k => $v) {
			if ($v) $ret_arr['path'][] = $v;
		}

		foreach ($arg_arr as $k => $v) {
			$arr = explode("=", $v);
			$ret_arr['arg'][$arr[0]] = $arr[1];
		}

		$ret_arr['url']['page'] = $data_arr[0];
		$ret_arr['url']['get'] = $data_arr[1];

		return $ret_arr;
	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * PC / 모바일 페이지간 포워딩 링크(화면고정 설정 실행)
	 */
	function rt_switch_link($fwd) {

		global $env, $_rt_page;

		return $_rt_page['app_path']."/screen_switch.php?fwd=".$fwd."&data=".urlencode($env->_server['REQUEST_URI']);
	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * 페이지 별 링크 정보 출력
	 */
	function rt_page_link($pcd, $req_screen="pc") {

		global $env, $dbo, $_rt_page;

		//페이지 데이터
		$_r = $dbo->fetch("SELECT * FROM RT_PAGE WHERE pcode='".$pcd."'");

		if ($_r['page_setting_en'] == "custom") {
			$link = ($req_screen=="m") ? $_r['page_url_m'] : $_r['page_url'];
		} else if ($_r['page_setting_en'] == "auto") {
			if ($req_screen=="m") {
				$link = $_rt_page['app_path']."/?pcd=".$pcd."&screen=mobile";
			} else {
				$link = $_rt_page['app_path']."/?pcd=".$pcd;
			}
		}
		
		return $link;
	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * PC / 모바일 페이지간 이동 화면 판단
	 *
	 * @param		string				$as_screen			:	이동할 화면(가상페이지 접근 시 활용), pc or mobile
	 * @return		string									:	pc or mobile
	 */
	function rt_check_screen($as_screen="pc") {

		global $dbo, $env, $_rt_page_conf;

		//포워딩 설정 데이터
		$F = unserialize(html_entity_decode($_rt_page_conf['screen_forward']));
		$L = unserialize(html_entity_decode($_rt_page_conf['screen_forward_landing']));

		// 1.현재 접속한 기기(하드웨어) 체크
		$conn_eq = (rt_mobile_is()) ? "mobile" : "pc";

		// 2. 이동할 화면
		if ($as_screen == "mobile") {
			$req_screen = "mobile";
		} else {
			//관리자에서 설정된 모바일 디렉토리 구분 정보를 활용
			$url_arr = explode("/", $env->_server['REQUEST_URI']);
			$path_arr = explode("/", $_rt_page_conf['mobile_path']);
			$req_screen = ($url_arr[1] == $path_arr[1]) ? "mobile" : "pc";
		}

		// 3. 화면 고정 설정
		if (!empty($env->_session['RT_SCREEN_VIEW'])) {
			$view_stat = $env->_session['RT_SCREEN_VIEW']; //pc, mobile
		} else {
			$view_stat = "none";
		}

		// 4. 포워딩 테이블에 적용
		$match_stat = array();
		$match_stat['pc']['pc']['none']				= 1;
		$match_stat['pc']['pc']['pc']				= 2;
		$match_stat['pc']['pc']['mobile']			= 3;
		$match_stat['pc']['mobile']['none']			= 4;
		$match_stat['pc']['mobile']['pc']			= 5;
		$match_stat['pc']['mobile']['mobile']		= 6;
		$match_stat['mobile']['pc']['none']			= 7;
		$match_stat['mobile']['pc']['pc']			= 8;
		$match_stat['mobile']['pc']['mobile']		= 9;
		$match_stat['mobile']['mobile']['none']		= 10;
		$match_stat['mobile']['mobile']['pc']		= 11;
		$match_stat['mobile']['mobile']['mobile']	= 12;

		$stat = $match_stat[$conn_eq][$req_screen][$view_stat];

		return ($F['fw'.$stat] == "o") ? $L['ld'.$stat] : $req_screen;
	}

	//----------------------------------------------------------------------------------------------
}
?>