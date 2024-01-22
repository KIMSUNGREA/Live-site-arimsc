<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 404 페이지 매칭 포워딩
//
// 주의사항		: 이 파일은 반드시 웹 경로 최상위 디렉토리에 생성해 주세요.
//				  리라이트 모듈이 사용가능해야 하며 .htaccess 파일이 설정되어 있어야 합니다.
// 웹 경로		: http://domain.com/_x_redirect.php
// 시스템 경로	: $_SERVER['DOCUMENT_ROOT']."/_x_redirect.php"
//-----------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

//-----------------------------------------------------------------------------------------


if (!empty($env->_server['REQUEST_URI'])) {

	$rq_url = $env->_server['REQUEST_URI'];					//요청 URL 전체
	$rq_page = $env->_server['REDIRECT_URL'];				//요청 페이지
	$rq_qstr = $env->_server['REDIRECT_QUERY_STRING'];		//전달 데이터

	// 전체 URL 비교 데이터(등록 데이터가 여러개일 경우 가장 최근에 등록한 1개만 추출)
	$_a = $dbo->fetch("SELECT * FROM RT_PAGE_MATCH WHERE rule_en='all' AND pg_target='".$rq_url."' ORDER BY seq DESC");

	if (is_numeric($_a['seq'])) {
		rt_js_move("", "self", "href", $_a['pg_forward']); exit;
	}

	//파일명 비교 데이터(등록 데이터가 여러개일 경우 가장 최근에 등록한 1개만 추출)
	$_f = $dbo->fetch("SELECT * FROM RT_PAGE_MATCH WHERE rule_en='page' AND pg_target LIKE '".$rq_page."%' ORDER BY seq DESC");

	if (is_numeric($_f['seq'])) {
		rt_js_move("", "self", "href", $_f['pg_forward']); exit;
	}

	//DB에 요청페이지 저장
	$_c = $dbo->fetch("SELECT * FROM RT_PAGE_404 WHERE try_url='".$rq_url."'");
	if (is_numeric($_c['seq'])) {
		$dbo->query("UPDATE RT_PAGE_404 SET try_cnt=try_cnt+1 WHERE try_url='".$rq_url."'");
	} else {
		$data = array();
		$data['try_file'	] = $rq_page;
		$data['try_url'		] = $rq_url;
		$data['try_qstr'	] = $rq_qstr;
		$data['try_cnt'		] = 1;
		$dbo->insert("RT_PAGE_404", $data);
	}

	//세팅된 페이지가 없다면 인덱스 페이지로 강제 이동
	rt_js_move("", "self", "href", "/");exit;
}

//-----------------------------------------------------------------------------------------
?>