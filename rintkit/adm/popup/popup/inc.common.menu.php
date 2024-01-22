<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if ($cls_adm->auth_code == "master") {
	$_tmp_sd = str_replace("-","_",$env->_get['cf']);
	${"on_".$_tmp_sd} = "rt_active";
	?>
<div class="rt_s_gnb">
	<a href="<?php echo RTW_ADM;?>/popup/?sd=popup&cf=list" class="rt_depth1 <?php echo $on_list;?>">팝업 관리</a>
	<a href="<?php echo RTW_ADM;?>/popup/?sd=popup&cf=source" class="rt_depth1 <?php echo $on_source;?>">설치 소스</a>
</div>
	<?
}
?>