<?php
//-----------------------------------------------------------------------------------------
// 린트킷 엔진 포함
//-----------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

//페이지 환경설정
require_once RT_DOC_ROOT.$_rt_page['app_path']."/page_conf.php";
//-----------------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<?php echo $__pg['meta_auth_naver'];?>
	<meta name="description" content="<?php echo $__pg['meta_desc'];?>">
	<meta name="keyword" content="<?php echo $__pg['meta_keyword'];?>">

	<!-- sns og tag-->
	<meta property="og:type" content="website">
	<meta property="og:title" content="<?php echo $__pg['meta_title'];?>">
	<meta property="og:description" content="<?php echo $__pg['meta_desc'];?>">
	<!-- <meta property="og:image" content="https://arimsc.com/arim.png"> -->
	<meta property="og:url" content="https://arimsc.com/<?php echo $__pg['main_url'];?>">

        <meta http-equiv="Author" content="김성래">
        <meta http-equiv="Publisher">

	<title><?php echo $__pg['meta_title'];?></title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <link rel="stylesheet" href="/assets/css/reset.css">
        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" href="/assets/css/m_style.css">

	<link rel="canonical" href="//<?php echo $__pg['main_url'];?>">

	<?php echo $__pg['shortcut_icon'];?>

	<script src="/assets/js/jquery-3.6.4.min.js"></script>
	<script src="/assets/js/common.js?ver=<?=time();?>"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/gsap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/ScrollTrigger.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

	<script>
	//<![CDATA[
	var a_num = "<?php echo $j_a_num?>";
	var b_num = "<?php echo $j_b_num?>";
	var c_num = "<?php echo $j_c_num?>";
	var c_sub = "<?php echo $j_c_sub?>";
	//]]>
	</script>
	<!--[if lt IE 9]>
		<script src="/assets/plugin/html5.js"></script>
		<script src="/assets/plugin/respond.js"></script>
	<![endif]-->
	<!-- Rint-kit define S //-->
	<script>
	var rt_path = Array();
	rt_path['root'] = "<?php echo RTW_ROOT?>";
	rt_path['rtboard'] = "<?php echo $_rt_rtboard['app_path']?>";
	rt_path['rtmember'] = "<?php echo $_rt_rtmember['app_path']?>";
	</script>
	<script src="<?php echo RTW_ASSETS?>/js/common.lib.js?ver=<?=time();?>"></script>
	<!-- Rint-kit E //-->
</head>
<body>
<div id="wrap">
<!-- haeder -->
<?php include("layout/header.php");?>
<!-- //haeder -->