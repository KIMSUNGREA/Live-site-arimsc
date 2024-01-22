<?php
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if ($__sd != "page") {
	$_tmp_sd = str_replace("-","_",$__cf);
	${"on_".$_tmp_sd} = "class='on'";
} else {
	$on_page = "class='on'";
}
?>
<div class="rt-box-wrap">
	<div class="rt-tab-wrap">
		<ul class="rt-tab-list2 rt-tab-bt01">
			<?php if ($cls_adm->auth_code == "master") { ?>
			<li <?php echo $on_sitemap;?>><a href="<?php echo RTW_ADM;?>/page/?sd=sitemap">사이트맵 설정</a></li>
			<?php } ?>
			<li <?php echo $on_page;?>><a href="<?php echo RTW_ADM;?>/page/?sd=page">페이지 별 설정</a></li>
			<li <?php echo $on_seo;?>><a href="<?php echo RTW_ADM;?>/page/?sd=seo">SEO(META)</a></li>
		</ul>
		<div class="rt-drop-wrap rt-tab-bt02">
			<button type="button" class="rt-btn dark block rt-drop-bt"><b>메뉴 보기</b> <i class="rt-icon arrowb"></i></button>
			<ul class="rt-drop-ul">
				<?php if ($cls_adm->auth_code == "master") { ?>
				<li <?php echo $on_sitemap;?>><a href="<?php echo RTW_ADM;?>/page/?sd=sitemap">사이트맵 설정</a></li>
				<?php } ?>
				<li <?php echo $on_page;?>><a href="<?php echo RTW_ADM;?>/page/?sd=page">페이지 별 설정</a></li>
				<li <?php echo $on_seo;?>><a href="<?php echo RTW_ADM;?>/page/?sd=seo">SEO(META)</a></li>
			</ul>
		</div>
	</div>
</div>
