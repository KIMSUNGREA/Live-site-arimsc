<?
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

$_tmp_sd = explode("-",$env->_get['sd']);
${"active_".$_tmp_sd[1]} = "rt_active";
?>
<div class="rt_s_gnb">
	<a href="<?php echo RTW_ADM;?>/app/?appcode=product&sd=admin-data" class="rt_depth1 <?php echo $active_data;?>">제품 목록</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=product&sd=admin-category" class="rt_depth1 <?php echo $active_category;?>">제품 분류</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=product&sd=admin-option" class="rt_depth1 <?php echo $active_option;?>">옵션 세트</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=product&sd=admin-formtpl" class="rt_depth1 <?php echo $active_formtpl;?>">상용 템플릿</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=product&sd=admin-config" class="rt_depth1 <?php echo $active_config;?>">환경 설정</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=product&sd=admin-source" class="rt_depth1 <?php echo $active_source;?>">설치 소스</a>
</div>