<?
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if ($cls_adm->auth_code == "master") {
	$_tmp_sd = explode("-",$env->_get['sd']);
	${"active_".$_tmp_sd[1]} = "rt_active";
	?>
<div class="rt_s_gnb">
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-data" class="rt_depth1 <?php echo $active_data;?>">회원 목록</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-group" class="rt_depth1 <?php echo $active_group;?>">회원 그룹</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-field" class="rt_depth1 <?php echo $active_field;?>">추가 필드</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-skin" class="rt_depth1 <?php echo $active_skin;?>">스킨 설정</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-alarm" class="rt_depth1 <?php echo $active_alarm;?>">알림 설정</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-config" class="rt_depth1 <?php echo $active_config;?>">연동 설정</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-setting" class="rt_depth1 <?php echo $active_setting;?>">환경 설정</a>
</div>
<?php } else { ?>
<div class="rt_s_gnb">
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-data" class="rt_depth1 <?php echo $active_data;?>">회원 목록</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-group" class="rt_depth1 <?php echo $active_group;?>">회원 그룹</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-alarm" class="rt_depth1 <?php echo $active_alarm;?>">알림 설정</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-setting" class="rt_depth1 <?php echo $active_setting;?>">환경 설정</a>
</div>
<?php } ?>