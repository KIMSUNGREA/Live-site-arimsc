<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>

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
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo $__pg['mobile_path'];?>/assets/css/mobile.css" />
	<link rel="stylesheet" href="<?php echo $__pg['mobile_path'];?>/assets/css/jquery.bxslider.css" />

	<?php echo $__pg['shortcut_icon'];?>

	<script type="text/javascript" src="<?php echo $__pg['mobile_path'];?>/assets/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $__pg['mobile_path'];?>/assets/js/jquery.bxslider.js"></script>
	<script type="text/javascript" src="<?php echo $__pg['mobile_path'];?>/assets/js/mobile.js"></script>
	<script type="text/javascript" src="<?php echo $__pg['mobile_path'];?>/assets/js/respond.src.js"></script>
	<script type="text/javascript" src="<?php echo $__pg['mobile_path'];?>/assets/js/rt-links.js"></script>
	
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

<body style="background:url(<?php echo $__pg['mobile_path'];?>/assets/img/back-bg.jpg) 0 center no-repeat; ">
	
	<div id="wrap-bg" style="background-image:url('<?php echo $__pg['mobile_path'];?>/assets/img/m-phone-bg.png');">
	<div id="wrap">
		<!-- haeder -->
		<?php require_once RT_DOC_ROOT.$__pg['mobile_path']."/layout/header.php";?>
		<!-- //haeder -->
		<div class="sub-content-wrap">
			<div class="sub-title-wrap">
				<h1 class="sub-title"><span class="radius"></span><?php echo $page_name;?></h1>
				<ul class="sub-tab-wrap">
					<li class="depth-1"><a href="#;" class="clearfix"><?php echo $section_name;?><span>▼</span></a>
						<ul class="depth2-container">
							<?php require_once RT_DOC_ROOT.$__pg['mobile_path']."/layout/s-tab-".$a_num.".php";?>
						</ul>
					</li>
				</ul>
			</div>