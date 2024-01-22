<?php
//-------------------------------------------------------------------------------------------------
/**
 *  멘토 모집 공고
 */
//-------------------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

/**
 * 추가 컴포넌트 로드
 */

rt_load_component("board");
$cls_board = new board("RT_REVIEW");

//-------------------------------------------------------------------------------------------------

//네비게이션 데이터
$__cfg = array();
$__cfg['nav'][0] = "체험후기";

switch ($__cf) {

	case "list"	:

		$__cfg['nav'][1] = "목록";

		/**
		 * 게시판 환경 데이터
		 */

		$add_qry = array(); //DB 쿼리 배열
		$add_url = ""; //전달 변수 배열

		//고정 쿼리
		$add_url.= "&sd=".$env->_get['sd']."&cf=".$env->_get['cf'];

		//변동 쿼리
		if ($env->_get['search'] && $env->_get['searchstring']) {
			if ($env->_get['search'] == "subjcont") {
				$add_qry[] = "((subject LIKE '%".$env->_get['searchstring']."%') OR (content LIKE '%".$env->_get['searchstring']."%'))";
			} else {
				$add_qry[] = "(".$env->_get['search']." LIKE '%".$env->_get['searchstring']."%')";
			}
			$add_url.= "&search=".$env->_get['search']."&searchstring=".$env->_get['searchstring'];
			$add_sch_url = "&search=".$env->_get['search']."&searchstring=".$env->_get['searchstring'];
		}

		if (count($add_qry) > 0) {
			$str_add_qry = implode(" AND ", $add_qry);
			$cls_board->set_fix_where_qry($str_add_qry);
		}
		$cls_board->set_fix_url_val($add_url);
		$cls_board->init();

		//-------------------------------------------------------------------------------------------------

	break;

	case "form"	:

		$_r = $dbo->fetch("SELECT * FROM RT_REVIEW WHERE seq='".$env->_get['seq']."'");

		if (!empty($_r)) {

			$__cfg['nav'][1] = "데이터 폼";
			$__cfg['mode'] = "modify";

		} else {

			$__cfg['nav'][1] = "데이터 등록";
			$__cfg['mode'] = "insert";
		}

	break;
}
?>