<?php
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if ($cls_adm->auth_code == "master") {
	$_tmp_sd = str_replace("-","_",$env->_get['sd']);
	${"on_".$_tmp_sd} = "rt_active";
	?>
<div class="rt_s_gnb">
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtboard&sd=admin-board" class="rt_depth1">게시판 목록</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtboard&sd=admin-board&cf=form&bcode=<?php echo $env->_get['bcode'];?>" class="rt_depth1 <?php echo $on_admin_board;?>">게시판 정보</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtboard&sd=theme-<?php echo $_bdinfo['theme'];?>-data&&bcode=<?php echo $env->_get['bcode'];?>" class="rt_depth1 <?php echo $on_theme_qna_data;?>">게시물 관리</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtboard&sd=theme-<?php echo $_bdinfo['theme'];?>-auth&bcode=<?php echo $env->_get['bcode'];?>" class="rt_depth1 <?php echo $on_theme_qna_auth;?>">이용 권한</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtboard&sd=admin-field&bcode=<?php echo $env->_get['bcode'];?>" class="rt_depth1 <?php echo $on_admin_field;?>">추가 필드</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtboard&sd=theme-<?php echo $_bdinfo['theme'];?>-skin&bcode=<?php echo $env->_get['bcode'];?>" class="rt_depth1 <?php echo $on_theme_qna_skin;?>">스킨 설정</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtboard&sd=theme-<?php echo $_bdinfo['theme'];?>-conf&bcode=<?php echo $env->_get['bcode'];?>" class="rt_depth1 <?php echo $on_theme_qna_conf;?>">환경 설정</a>
	<a href="<?php echo RTW_ADM;?>/app/?appcode=rtboard&sd=admin-source&bcode=<?php echo $env->_get['bcode'];?>" class="rt_depth1 <?php echo $on_admin_source;?>">설치 소스</a>
</div>
	<?
}
?>