<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="imagetoolbar" content="no">
	<meta name="viewport" content="width=1280" />
	<meta name="author" content="RINT">

	<title><?php echo $rt_conf_db['adm_title'];?> 관리자</title>

	<link href="<?php echo RTW_LAYOUT;?>/css/style.css" rel="stylesheet" type="text/css"/>

	<script src="<?php echo RTW_LAYOUT;?>/js/jquery-1.11.1.min.js" type="text/javascript"></script>
	<script src="<?php echo RTW_LAYOUT;?>/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	
	<link href="<?php echo RTW_LAYOUT;?>/js/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<script src="<?php echo RTW_LAYOUT;?>/js/jquery-ui.min.js" type="text/javascript"></script>

	<script src="<?php echo RTW_LAYOUT;?>/js/masonry.pkgd.min.js" type="text/javascript"></script>
	<script src="<?php echo RTW_LAYOUT;?>/js/jquery.bxslider.js" type="text/javascript"></script>
	<script src="<?php echo RTW_LAYOUT;?>/js/rt-common.js" type="text/javascript"></script>
	<script src="<?php echo RTW_LAYOUT;?>/js/rt-sub.js" type="text/javascript"></script>

	<!-- plugin : http://dinbror.dk/bpopup/ //-->
	<script src="<?php echo RTW_PLUGIN;?>/bpopup/jquery.bpopup.min.js"></script>

	<!-- 린트킷 관리자 전역변수 //-->
	<script type="text/javascript">
	var rt_path = Array();
	rt_path['root'] = "<?php echo RTW_ROOT;?>";
	rt_path['adm'] = "<?php echo RTW_ADM;?>";
	<?php if ($__dr == "app") { ?>
	rt_path['app'] = "<?php echo $_app['app_path'];?>";
	<?php }?>

	var rt_layout = Array();
	rt_layout['dr'] = "<?php echo $__dr?>";
	rt_layout['sd'] = "<?php echo $__sd?>";
	rt_layout['sc'] = "<?php echo $__sc?>";
	rt_layout['cf'] = "<?php echo $__cf?>";
	</script>
</head>
<body>
	<div id="wrap">
		<!-- haeder -->
		<div id="header">
			<div class="rt_header_wrap clearfix">
				<h1 class="rt_logo"><a href="<?php echo RTW_ADM;?>" ><?php echo $rt_conf_db['adm_title'];?></a></h1>
				<div class="rt_hd_menu_area">
					<ul class="rt_hd_menu_wrap clearfix">
						<?php for ($m = 0; $m < count($__topmenu); $m++) { ?>
						<li class="rt_hd_menu_con"><a href="<?php echo $__topmenu[$m]['link_uri'];?>" target="<?php echo $__topmenu[$m]['link_target_en'];?>" class="rt_hd_menu"><?php echo $__topmenu[$m]['menu_nm'];?><span></span></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<?php require_once RT_LAYOUT."/adm.left.php";?>
		<!-- //haeder -->
		<div id="body">
			<div class="rt_content_wrap">
				<div class="rt_content_container rt_shadow">
					<div class="rt_route_wrap">
						<span class="rt_home"><img src="<?php echo RTW_LAYOUT;?>/images/sub/home_ico.png" alt="집" /> 관리자</span>
						<?php
						$nav_cnt = count($__cfg['nav']);
						$nav_max_key = $nav_cnt - 1;
						for ($m = 0; $m < $nav_cnt; $m++) {
							if ($nav_max_key == $m) {
								?><span class="rt_route"><span class="rt_arrow">&gt;</span><b><?php echo $__cfg['nav'][$m];?></b></span><?
							} else {
								?><span class="rt_route"><span class="rt_arrow">&gt;</span><?php echo $__cfg['nav'][$m];?></span><?
							}
						}?>
					</div>
					<div class="rt_s_wrap">
						<?php if ($__app_admin == "y") { ?>
						<h1 class="rt_s_bar_tit mb20"><?php echo $__cfg['page'];?></h1>
						<?php } else if ($__sub_title == "y") { ?>
						<h1 class="rt_s_bar_tit mb20"><?php echo $__cfg['page'];?></h1>
						<?php } else { ?>
						<h1 class="rt_s_bar_tit mb20"><?php echo $__cfg['nav'][0];?></h1>
						<?php } ?>