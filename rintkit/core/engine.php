<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 린트킷 시스템 데이터 관리
//-----------------------------------------------------------------------------------------

/**
 * 시스템 전역 변수 설정
 */

//시스템 절대 경로 설정(시스템 구성 작업에 사용)
define('RT_ADM'					, RT_ROOT.'/adm');
define('RT_LAYOUT'				, RT_ADM.'/layout');
define('RT_ASSETS'				, RT_ROOT.'/assets');
define('RT_CORE'				, RT_ROOT.'/core');
define('RT_COMPONENT'			, RT_CORE.'/component');
define('RT_DRIVER'				, RT_CORE.'/driver');
define('RT_LIB'					, RT_CORE.'/lib');
define('RT_INSTALL'				, RT_ROOT.'/install');
define('RT_PLUGIN'				, RT_ROOT.'/plugin');

//웹 절대경로 설정(브라우저 출력 리소스에 사용)
define('RTW_ROOT'				, '/'.RT_SET_DIR);
define('RTW_ADM'				, RTW_ROOT.'/adm');
define('RTW_LAYOUT'				, RTW_ADM.'/layout');
define('RTW_ASSETS'				, RTW_ROOT.'/assets');
define('RTW_INSTALL'			, RTW_ROOT.'/install');
define('RTW_PLUGIN'				, RTW_ROOT.'/plugin');

//암호화 고정키(변경 시 기존 패스워드 데이터 사용불가)
define("RT_SECKEY"				, '_aj.eI2Y3aDfNe');

//마스터 계정, 비밀번호 강제변경(y 설정 시, 마스터 계정으로 시도되는 로그인 패스워드로 강제 변경)
define("RT_CHANGE_ADMIN_PWD"	, 'n');

/**
 * 1. 타 프로그램과 공유되는 페이지일 경우 세션 및 헤더를 사용하지 않음
 * 2. 헤더 사용 안할 경우 $_rt_header 변수에 임의의 값 설정, ex) $_rt_header = 'n';
 */

if (!isset($_rt_header) || $_rt_header == "y") {

	// 기본 환경 설정(서버환경 / 개발 요구사항에 따라 임의설정)
	@error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );

	@ini_set("session.use_trans_sid"	, 0);
	@ini_set("url_rewriter.tags"		, "");


	// 세션 설정(서버환경 / 개발 요구사항에 따라 임의설정)
	session_start();

	// 헤더 설정(서버환경 / 개발 요구사항에 따라 임의설정)
	header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
	header("Content-Type: text/html; charset=UTF-8");
	header("Progma:no-cache");
	header("Cache-Control:no-cache,must-revalidate");

} else {
	// 환경설정 커스텀 영역
}

//-------------------------------------------------------------------------------------------------

/**
 * 기본 환경 설정
 * 브라우저 로딩 시 각 종 변수 초기화 설정(server,post,get,file,url 등)
 */

require_once RT_DRIVER."/env.driver.php";
$env = new env_driver_class();

//-------------------------------------------------------------------------------------------------

/**
 * 공동 라이브러리
 */

require_once RT_LIB."/common.lib.php";

//-------------------------------------------------------------------------------------------------

/**
 * DB 접속 설정
 */

require_once RT_DRIVER."/mysql.driver.php";
require_once RT_COMPONENT."/dbo.class.php";

$dbo = new dbo_class();

//-------------------------------------------------------------------------------------------------

/**
 * 기본 라이브러리 로드
 *
 * 추가적으로 필요한 라이브러리는 해당 페이지에서 별도로 선언하여 로드
 *
 * ex1) rt_load_lib("file");
 * ex2) rt_load_lib("file,image"); //여러개 로드 시 쉼표(,)로 구분
 */

rt_load_lib("cookie,session,string,file,image,dbquery,debug,date,url,etc");

//-------------------------------------------------------------------------------------------------

/**
 * 시스템 공동환경설정 정보(관리자 설정정보)
 */

$rt_conf_db = $dbo->fetch("SELECT * FROM RT_CONFIG");

//-------------------------------------------------------------------------------------------------

/* 제품 코드 */
$__model['RA300'] = "ArimAir RA300";
$__model['RA201'] = "ArimAir RA201";
$__model['OA200'] = "ArimAir OA200";
$__model['OA100'] = "ArimAir OA100";
?>