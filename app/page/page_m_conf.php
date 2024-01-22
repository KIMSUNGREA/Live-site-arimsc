<?php
//-----------------------------------------------------------------------------------------
// 페이지 레이아웃 데이터 생성
//-----------------------------------------------------------------------------------------

$arr_dir = explode("/", $env->_server["PHP_SELF"]);

if ($pcd) {
	$m_dir = str_replace("/", "", $__pg['mobile_path']);	//모바일 구분 디렉토리
	$div_dir = $arr_dir[1];			//최상위 구분 디렉토리
	$sub_dir = $arr_dir[2];			//서브 디렉토리
	$now_page = $arr_dir[3];		//현재 페이지
} else {
	$m_dir = $arr_dir[1];	//모바일 구분 디렉토리
	$div_dir = $arr_dir[2];			//최상위 구분 디렉토리
	$sub_dir = $arr_dir[3];			//서브 디렉토리
	$now_page = $arr_dir[4];		//현재 페이지
}

$section_name = "";				//섹션명
$page_name = "";				//페이지명

//-----------------------------------------------------------------------------------------
// 직접 제작된 페이지 별 레이아웃 데이터 설정
//-----------------------------------------------------------------------------------------

// 1차 디렉토리 : /page/
if($div_dir == "page") {

	// 2차 디렉토리 별 설정
	switch ($sub_dir) {

		case "s1" :
			$a_num = "1";
			$section_name = "린트소개";

			// 디렉토리 내 페이지 별 데이터 설정
			switch ($now_page) {
				case "s1.php" : $page_name="인사말";		$b_num="1";		$c_num=""; break;
				case "s2.php" : $page_name="연혁";			$b_num="2";		$c_num=""; break;
			}
			//$page_navi_str = $section_name."&nbsp;&nbsp;>&nbsp;&nbsp;".$page_name;
		break;

		case "s2" :
			$a_num = "2";
			$section_name = "사업안내";

			// 디렉토리 내 페이지 별 데이터 설정
			switch ($now_page) {
				case "s1.php" : $page_name="주요사업";		$b_num="1";		$c_num=""; break;
			}
		break;

		case "s3" :
			$a_num = "3";
			$section_name = "정보광장";

			// 디렉토리 내 페이지 별 데이터 설정
			switch ($now_page) {
				case "s1.php" : $page_name="공지사항";		$b_num="1";		$c_num=""; break;
			}
		break;

		case "s4" :
			$a_num = "4";
			$section_name = "커뮤니티";

			// 디렉토리 내 페이지 별 데이터 설정
			switch ($now_page) {
				case "s1.php" : $page_name="자유게시판";		$b_num="1";		$c_num=""; break;
				case "s2.php" : $page_name="Q&A";				$b_num="2";		$c_num=""; break;
				case "s3.php" : $page_name="썸업 게시판";		$b_num="3";		$c_num=""; break;
				case "s4.php" : $page_name="자주하는 질문";		$b_num="4";		$c_num=""; break;
				case "s5.php" : $page_name="포토 갤러리";		$b_num="5";		$c_num=""; break;
				case "s6.php" : $page_name="포토 게시판";		$b_num="6";		$c_num=""; break;
			}
		break;

		case "s5" :
			$a_num = "5";
			$section_name = "제품소개";

			// 디렉토리 내 페이지 별 데이터 설정
			switch ($now_page) {
				case "s1.php" : $page_name="제품소개";		$b_num="1";		$c_num=""; break;
			}
		break;

		case "mb" :
			$a_num = "mb";
			$section_name = "회원";

			// 디렉토리 내 페이지 별 데이터 설정
			switch ($now_page) {
				case "join.php" : $page_name="회원가입";			$b_num="1";		$c_num=""; break;
				case "login.php" : $page_name="로그인";				$b_num="2";		$c_num=""; break;
				case "mypage.php" : $page_name="마이페이지";		$b_num="3";		$c_num=""; break;
				case "find.php" : $page_name="계정찾기";			$b_num="4";		$c_num=""; break;
			}
		break;
	}

	// CASE 내에 정의된 네비 정보가 없으면 기본 설정에 따름
	$page_navi_str = (empty($page_navi_str)) ? $section_name."&nbsp;&nbsp;>&nbsp;&nbsp;".$page_name : $page_navi_str;

//-----------------------------------------------------------------------------------------
// 가상 URL을 사용하는 페이지 레이아웃 데이터 설정
//-----------------------------------------------------------------------------------------

} else if($div_dir == "app" && !empty($pcd)) {

	// 페이지 코드(GET으로만 처리)
	$pcd = $env->_get['pcd'];

	// 레이아웃 변수 설정
	$a_num = $__pg['u_data1']; // 사용자 정의 데이터1
	$b_num = $__pg['u_data2']; // 사용자 정의 데이터2
	$c_num = $__pg['u_data3']; // 사용자 정의 데이터3

	// 타이틀 설정
	$cls_ct->getCateInfo($pcd);

	$page_navi_str = $cls_ct->data[1]."&nbsp;>&nbsp;".$cls_ct->data[0];
	$section_name = $cls_ct->data[1];
	$page_name = $cls_ct->data[0];
}

//-----------------------------------------------------------------------------------------
// 이하 공통 데이터
//-----------------------------------------------------------------------------------------

// 메뉴 활성 여부
${"class_active_".$b_num} = "class='active'";

// javascript에서 사용할 변수 설정
$j_a_num = $a_num-1; if($j_a_num=="-1"){$j_a_num = "";}
$j_b_num = $b_num-1; if($j_b_num=="-1"){$j_b_num = "";}
$j_c_num = $c_num-1; if($j_c_num=="-1"){$j_c_num = "";}
?>