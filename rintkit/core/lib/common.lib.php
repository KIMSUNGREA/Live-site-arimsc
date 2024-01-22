<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 공통 라이브러리
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (defined('_RT_LIB_COMMON_') === FALSE) {

	define('_RT_LIB_COMMON_', TRUE);

	//----------------------------------------------------------------------------------------------

	/** 
	 * 라이브러리 파일 인클루드
	 * 
	 * @param array			as_lib				: 콤마(,)로 구분된 공백없는 문자열
	 */

	function rt_load_lib($as_lib) {

		$ar_lib = explode(",", $as_lib);
		foreach ($ar_lib as $k => $code) {

			$code = trim($code);
			if (!empty($code)) {

				$file_path = RT_LIB."/".$code.".lib.php";

				if (is_file($file_path) === TRUE) {
					include_once $file_path;
				}
			}
		}
	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * 컴포넌프 파일 인클루드
	 * 
	 * @param string		as_component			: Component 코드
	 * @param string		as_path					: 파일 디렉토리 경로
	 */

	function rt_load_component($as_component, $as_path=RT_COMPONENT) {

		$ar_component = explode(",", $as_component);
		foreach ($ar_component as $k => $code) {

			$code = trim($code);
			if (!class_exists($code)) {

				$file_path = RT_COMPONENT."/".$code.".class.php";

				if (is_file($file_path) === TRUE) {
					include_once $file_path;
				}
			}
		}

	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * APP 콘트롤러 파일 인클루드
	 * 
	 * @param string		app_code			: APP code
	 * @param string		ctr_code			: controller code
	 */

	function rt_load_app_controller($app_code, $ctr_code) {

		global $rt_app;

		$rt_app = rt_app_info(trim($app_code));

		if ($rt_app['app_code']) {

			$file_path = RT_DOC_ROOT.$rt_app['app_path']."/controller/".$rt_app['app_code'].".".$ctr_code.".controller.php";
			if (is_file($file_path) === TRUE) {
				include_once $file_path;
			}
		}

	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * App controller
	 * 
	 * @param string		app_code			: APP 코드
	 * @param string		func				: 실행할 Function
	 * @param string		args				: 함수에 전달할 변수 => rt_app("popup", "put_script", array('arg1','arg2'))
	 */
	function rt_app($app_code, $func=null, $args=null) {

		global $env, $dbo;

		//APP 정보
		$_app = rt_app_info(trim($app_code));

		//APP Controller 실행
		if (!class_exists($app_code)) {
			require_once RT_DOC_ROOT.$_app['app_path']."/controller/".$_app['app_code'].".controller.php";
			eval("\$_".$_app['app_code']." = new ".$_app['app_code']."();");
		}

		//선 기능 실행 시 전달할 변수 설정(콤마로 구분) : func_name(arg1, arg2, arg3 ...)
		if (count($args) > 0) {
			foreach ($args as $k => $v) $args[$k] = "'".$v."'";
			$str_args = implode(",", $args);
		}

		//선 기능 실행
		if ($func) {
			eval("\$_".$_app['app_code']."->".$func."(".$str_args.");");
		}

	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * rtboard widget
	 * 
	 * @param string		skinfile			: 스킨파일명
	 */
	function rt_board_widget($skinfile) {

		global $env, $dbo;

		//APP 정보
		$_app = rt_app_info("rtboard");

		//스킨 파일 연결
		$fp = RT_DOC_ROOT.$_app['app_path']."/widget/".$skinfile;
		if (is_file($fp)) require_once $fp;
	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * rtboard widget data
	 * 
	 * @param string		_wg_conf			: 환경 데이터
	 */
	function rt_board_widget_data($_wg_conf) {

		global $env, $dbo;

		//APP 정보
		$_app = rt_app_info("rtboard");

		$path_theme = $_app['app_path']."/theme/".$_wg_conf['theme'];

		//페이지 설정정보
		$_wg_page = $dbo->fetch("SELECT * FROM RT_PAGE WHERE pcode='".$_wg_conf['pcd']."'");

		//게시판 환경정보
		$_wg_board_conf = $dbo->fetch("SELECT * FROM RT_RTBOARD_".strtoupper($_wg_conf['theme'])."_CONF WHERE bcode='".$_wg_conf['bcode']."'");

		//게시물 데이터
		if ($_wg_conf['theme'] == "norm") {
			$order_by = "ORDER BY ref DESC,re_step ASC LIMIT ".$_wg_conf['prtcnt'];
		} else {
			$order_by = "ORDER BY seq DESC LIMIT ".$_wg_conf['prtcnt'];
		}
		$_wg_board = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_".strtoupper($_wg_conf['theme'])." WHERE bcode='".$_wg_conf['bcode']."' AND use_is='y' ".$order_by);

		$_b = array();
		$_wg_cnt = $_wg_conf['prtcnt'];

		//테마별 리스트 데이터 세팅
		if ($_wg_conf['theme'] == "info") {

			for ($m = 0; $m < count($_wg_board); $m++) {

				$_b[$m]['번호'] = $_wg_cnt;
				$_b[$m]['분류'] = rt_dbstr_decode($_wg_board[$m]['category']);
				$_b[$m]['아이디'] = rt_dbstr_decode($_wg_board[$m]['userid']);
				$_b[$m]['작성자'] = rt_dbstr_decode($_wg_board[$m]['name']);
				$_b[$m]['제목'] = rt_str_length_cut(stripslashes($_wg_board[$m]['subject']),$_wg_conf['subjcut'],"..");
				$_b[$m]['본문'] = rt_dbstr_decode($_wg_board[$m]['content']);
				$_b[$m]['줄임본문'] = rt_str_length_cut(strip_tags(nl2br($_wg_board[$m]['content'])), $_wg_conf['contcut'], "..");
				$_b[$m]['조회수'] = $_wg_board[$m]['hits'];
				$_b[$m]['아이피'] = $_wg_board[$m]['user_ip'];

				if ($_wg_page['page_setting_en'] == "auto") {
					$_b[$m]['상세페이지링크'] = rt_page_link($_wg_conf['pcd'])."&cf=view&seq=".$_wg_board[$m]['seq'];
				} else if ($_wg_page['page_setting_en'] == "custom") {
					$_b[$m]['상세페이지링크'] = rt_page_link($_wg_conf['pcd'])."?cf=view&seq=".$_wg_board[$m]['seq'];
				}

				$_b[$m]['새글아이콘'] = (rt_is_new_post($_wg_board[$m]['reg_date'], $_wg_board_conf['post_new_period'])) ? $_wg_conf['newimg']:"";
				$_b[$m]['등록일'] = str_replace("-", $_wg_conf['expdate'], substr($_wg_board[$m]['reg_date'],0,10));

				$chkf = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$_wg_conf['bcode']."' AND post_seq='".$_wg_board[$m]['seq']."' ORDER BY file_num ASC");
				$_b[$m]['첨부아이콘'] = (count($chkf) > 0) ? $_wg_conf['attcimg'] : "";

				$chkc = $dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_RTBOARD_CMT WHERE post_seq='".$_wg_board[$m]['seq']."' AND del_en='n'");
				$_b[$m]['댓글수'] = number_format($chkc['cnt']);

				if ($_wg_board_conf['list_img_is'] == "y") {
					$list_img_src = "";
					if ($_wg_board_conf['list_img_thumb_is'] == "y") {
						$list_img_src = $_wg_board[$m]['list_img_dir']."thumb/".$_wg_board[$m]['list_img_thumb'];
					} else {
						$list_img_src = $_wg_board[$m]['list_img_dir'].$_wg_board[$m]['list_img_new'];
					}

					if (!is_file(RT_DOC_ROOT.$list_img_src)) {
						$list_img_src = $path_theme."/user/files/no_img.png";
					}

					$_b[$m]['목록이미지경로'] = $list_img_src;
				}

				$_wg_cnt--;
			}

		} else if ($_wg_conf['theme'] == "qna") {

			for ($m = 0; $m < count($_wg_board); $m++) {

				$_b[$m]['번호'] = $_wg_cnt;
				$_b[$m]['분류'] = rt_dbstr_decode($_wg_board[$m]['category']);
				$_b[$m]['아이디'] = rt_dbstr_decode($_wg_board[$m]['userid']);
				$_b[$m]['작성자'] = rt_dbstr_decode($_wg_board[$m]['name']);
				$_b[$m]['가림작성자'] = rt_name_hide(rt_dbstr_decode($_wg_board[$m]['name']));
				$_b[$m]['제목'] = rt_str_length_cut(stripslashes($_wg_board[$m]['subject']),$_wg_conf['subjcut'],"..");
				$_b[$m]['본문'] = rt_dbstr_decode($_wg_board[$m]['content']);
				$_b[$m]['줄임본문'] = rt_str_length_cut(strip_tags(nl2br($_wg_board[$m]['content'])), $_wg_conf['contcut'], "..");
				$_b[$m]['아이피'] = $_wg_board[$m]['user_ip'];
				$_b[$m]['새글아이콘'] = (rt_is_new_post($_wg_board[$m]['reg_date'], $_wg_board_conf['post_new_period'])) ? $_wg_conf['newimg']:"";
				$_b[$m]['등록일'] = str_replace("-", $_wg_conf['expdate'], substr($_wg_board[$m]['reg_date'],0,10));

				$chkf = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$_wg_conf['bcode']."' AND post_seq='".$_wg_board[$m]['seq']."' ORDER BY file_num ASC");
				$_b[$m]['첨부아이콘'] = (count($chkf) > 0) ? $_wg_conf['attcimg'] : "";

				$_wg_cnt--;
			}

		} else if ($_wg_conf['theme'] == "norm") {

			for ($m = 0; $m < count($_wg_board); $m++) {

				$_b[$m]['번호'] = $_wg_cnt;
				$_b[$m]['분류'] = rt_dbstr_decode($_wg_board[$m]['category']);
				$_b[$m]['아이디'] = rt_dbstr_decode($_wg_board[$m]['userid']);
				$_b[$m]['작성자'] = rt_dbstr_decode($_wg_board[$m]['name']);
				$_b[$m]['제목'] = rt_str_length_cut(stripslashes($_wg_board[$m]['subject']),$_wg_conf['subjcut'],"..");
				$_b[$m]['본문'] = rt_dbstr_decode($_wg_board[$m]['content']);
				$_b[$m]['줄임본문'] = rt_str_length_cut(strip_tags(nl2br($_wg_board[$m]['content'])), $_wg_conf['contcut'], "..");
				$_b[$m]['조회수'] = $_wg_board[$m]['hits'];
				$_b[$m]['아이피'] = $_wg_board[$m]['user_ip'];
				
				if ($_wg_page['page_setting_en'] == "auto") {
					$_b[$m]['상세페이지링크'] = rt_page_link($_wg_conf['pcd'])."&cf=view&seq=".$_wg_board[$m]['seq'];
				} else if ($_wg_page['page_setting_en'] == "custom") {
					$_b[$m]['상세페이지링크'] = rt_page_link($_wg_conf['pcd'])."?cf=view&seq=".$_wg_board[$m]['seq'];
				}

				$_b[$m]['새글아이콘'] = (rt_is_new_post($_wg_board[$m]['reg_date'], $_wg_board_conf['post_new_period'])) ? $_wg_conf['newimg']:"";
				$_b[$m]['등록일'] = str_replace("-", $_wg_conf['expdate'], substr($_wg_board[$m]['reg_date'],0,10));

				if ($_wg_board[$m]['re_level'] > 0) {
					$wid = 10 * $_wg_board[$m]['re_level'];
					$_b[$m]['답글공백'] = "<img src='".$path_theme."/user/files/ico_level.gif' width=".$wid." height='8'> RE: ";
				} else {
					$_b[$m]['답글공백'] = "";
				}

				$chkf = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$_wg_conf['bcode']."' AND post_seq='".$_wg_board[$m]['seq']."' ORDER BY file_num ASC");
				$_b[$m]['첨부아이콘'] = (count($chkf) > 0) ? $_wg_conf['attcimg'] : "";

				$chkc = $dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_RTBOARD_CMT WHERE post_seq='".$_wg_board[$m]['seq']."' AND del_en='n'");
				$_b[$m]['댓글수'] = number_format($chkc['cnt']);

				if ($_wg_board_conf['list_img_is'] == "y") {
					$list_img_src = "";
					if ($_wg_board_conf['list_img_thumb_is'] == "y") {
						$list_img_src = $_wg_board[$m]['list_img_dir']."thumb/".$_wg_board[$m]['list_img_thumb'];
					} else {
						$list_img_src = $_wg_board[$m]['list_img_dir'].$_wg_board[$m]['list_img_new'];
					}

					if (!is_file(RT_DOC_ROOT.$list_img_src)) {
						$list_img_src = $path_theme."/user/files/no_img.png";
					}

					$_b[$m]['목록이미지경로'] = $list_img_src;
				}

				$_wg_cnt--;
			}
		}

		return $_b;
	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * product widget
	 * 
	 * @param string		skinfile			: 스킨파일명
	 */
	function rt_product_widget($skinfile) {

		global $env, $dbo;

		//APP 정보
		$_app = rt_app_info("product");

		//스킨 파일 연결
		$fp = RT_DOC_ROOT.$_app['app_path']."/widget/".$skinfile;
		if (is_file($fp)) require_once $fp;
	}

	//----------------------------------------------------------------------------------------------

	/** 
	 * App 등록정보 가져오기
	 * 
	 * @param string		app_code			: APP 코드
	 */
	function rt_app_info($app_code) {

		global $dbo;

		if (!empty($app_code)) {
			return $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='".$dbo->sift($app_code)."' AND app_plug_en='on'");
		} else {
			return false;
		}
	}

	//----------------------------------------------------------------------------------------------

	/**
	 * 페이지 이동 Javascript 소스 출력
	 *
	 * @param	string				$as_msg					:	출력 메시지
	 * @param	string				$as_target				:	적용할 윈도우(self, parent, opener)
	 * @param	string				$as_location_type		:	이동 타입(reload, href)
	 * @param	string				$as_move_ag				:	이동할 정보(href:URL, history:history step)
	 * @param	boolean				$ab_is_close			:	창을 닫을지 여부
	 */

	function rt_js_move($as_msg="", $as_target="self", $as_location_type="href", $as_move_ag="", $ab_is_close=false) {

		$js_str = "<script type='text/javascript'>";
		if (trim($as_msg)) $js_str.= "alert('".$as_msg."');";

		switch ($as_location_type)
		{
			case "reload":
				$js_str.= $as_target.".location.reload();";
				break;
			case "href":
				$js_str.= $as_target.".location.href='".$as_move_ag."';";
				break;
			case "history":
				$js_str.= $as_target.".history.go(".$as_move_ag.");";
				break;
		}
		if($ab_is_close) $js_str.= "self.close();";
		$js_str.= "</script>";

		echo $js_str;
	}


	//----------------------------------------------------------------------------------------------

	/**
	 * 메시지 출력 Javascript 소스 출력
	 *
	 * @param	String				$as_msg				:	출력할 메시지
	 */

	function rt_js_msg($as_msg="") {

		$js_str = "<script type='text/javascript'>";
		$js_str.= "alert('".$as_msg."');";
		$js_str.= "</script>";

		echo $js_str;
	}

	//----------------------------------------------------------------------------------------------

	/**
	 * 문자열을 암호화 값으로 변경
	 *
	 * @param		string			$as_password			:	암호화시킬 문자열
	 * @return		string									:	암호화된 문자열
	 */

	function rt_password($as_password) {
		$as_password = trim($as_password);
		return strtoupper(md5($as_password.RT_SECKEY));
	}

	//----------------------------------------------------------------------------------------------

	/**
	 * 모바일 체크
	 *
	 * @return		boolean		: 모바일(true), PC(false)
	 */

	function rt_mobile_is() {
		$hwarr = 'ipod|phone|samsung|lgtel|mobile|[^A]skt|nokia|blackberry|symbianos|opera mini|windows ce|nokia|sonyericsson|webos|palmos|android|sony';
		return preg_match('/'.$hwarr.'/i', $_SERVER['HTTP_USER_AGENT']);
	}

	//----------------------------------------------------------------------------------------------

	/**
	* 파일명 변경
	*/

	function rt_set_new_file_name($fnm)
	{
		$r = "";
		$str = explode(",","A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,0,1,2,3,4,5,6,7,8,9");
		shuffle($str);
		$r .= $str[0].$str[2].$str[3].$str[4].$str[5];

		$ext = substr($fnm,"-4");
		return date('YmdHis')."-".$r.$ext;
	}
}
?>