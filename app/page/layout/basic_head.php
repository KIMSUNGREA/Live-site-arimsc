<!DOCTYPE HTML>
<html lang="KO">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=1200">

	<title><?php echo $__pg['meta_title'];?></title>

	<?php echo $__pg['meta_auth_naver'];?>
	<meta name="description" content="<?php echo $__pg['meta_desc'];?>">
	<meta name="keyword" content="<?php echo $__pg['meta_keyword'];?>">

	<!-- sns og tag-->
	<meta property="og:type" content="website">
	<meta property="og:title" content="<?php echo $__pg['meta_title'];?>">
	<meta property="og:description" content="<?php echo $__pg['meta_desc'];?>">
	<meta property="og:image" content="http://<?php echo $__pg['main_img'];?>">
	<meta property="og:url" content="http://<?php echo $__pg['main_url'];?>">
	<meta http-equiv="imagetoolbar" content="no">

	<link rel="canonical" href="http://<?php echo $__pg['main_url'];?>">
	<link rel="stylesheet" href="/assets/css/jquery-ui.css" />
	<link rel="stylesheet" href="/assets/js/jquery.bxslider.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="/assets/css/common.css" />
	<link rel="stylesheet" href="/assets/css/sub.css" />

	<?php echo $__pg['shortcut_icon'];?>

	<!--[if lt IE 10]>
	<link rel="stylesheet" href="/assets/css/ie8.css"></link>
	<![endif]-->

	<script src="/assets/js/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="/assets/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<script src="/assets/js/jquery-ui.min.js" type="text/javascript"></script>

	<!--[if lt IE 9]>
	<script src="/assets/js/html5.js"></script>
	<script src="/assets/js/respond.min.js"></script>
	<![endif]-->

	<script src="/assets/js/jquery.bxslider.js" type="text/javascript"></script>
	<script src="/assets/js/rt-common.js" type="text/javascript"></script>
	<script src="/assets/js/rt-links.js" type="text/javascript"></script>
	<script src="/assets/js/rt-navi-top.js" type="text/javascript"></script>

	<!-- Subpage preset S //-->
	<script type="text/javascript">
	var a_num = "<?php echo $j_a_num;?>";
	var b_num = "<?php echo $j_b_num;?>";
	var c_num = "<?php echo $j_c_num;?>";
	var c_sub = "<?php echo $j_c_sub;?>";
	</script>
	<!-- Subpage preset E //-->

	<!-- Rint-kit define S //-->
	<script type="text/javascript">
	var rt_path = Array();
	rt_path['root'] = "<?php echo RTW_ROOT;?>";
	rt_path['rtboard'] = "<?php echo $_rt_rtboard['app_path'];?>";
	rt_path['rtmember'] = "<?php echo $_rt_rtmember['app_path'];?>";
	</script>
	<script src="<?php echo RTW_ASSETS;?>/js/common.lib.js" type="text/javascript"></script>
	<!-- Rint-kit E //-->

</head>
<body>
	<div id="wrap">
		<!-- haeder -->
		<?php require_once RT_DOC_ROOT."/layout/header.php";?>
		<!-- //haeder -->
			<div class="content_wrap">
				<div class="container">
					<div class="menu_container left">
					<?php require_once RT_DOC_ROOT."/layout/lnb_".$a_num.".php";?>
					</div>
					<div class="route-wrap">
						<h1><img src="/assets/images/sub/sub-home.jpg" alt="home" />&nbsp;Home &gt; <?php echo $page_navi_str;?></h1>
					</div>
					<div class="sub-container">
						<div class="sub-title-wrap">
							<h1 class="title"><?php echo $page_name;?></h1>
							<span></span>
						</div>