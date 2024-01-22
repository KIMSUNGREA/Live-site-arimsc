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
	<script src="<?php echo RTW_LAYOUT;?>/js/jquery.bxslider.js" type="text/javascript"></script>
	<script src="<?php echo RTW_LAYOUT;?>/js/rt-common.js" type="text/javascript"></script>
</head>
<body>
<div class="hide">
	<a href="#header">상단 바로가기</a>
	<a href="#body">본문 바로가기</a>
</div>
<div id="wrap">
	<div class="rt_login_wrap">
		<div class="rt_login_con">
		<form name="login_form" action="<?php echo RTW_ADM;?>/login/update.php" method="post" target="rt_ifrm">
		<input type="hidden" name="mode" value="in">
			<h1 class="rt_tit"><?php echo $rt_conf_db['adm_title'];?> 관리자</h1>
			<p class="rt_txt">Sign in using your registered account</p>
			<div class="rt_input_box">
				<label for="afor-input-1" class="rt_bgcon fr"><i class="rt_icon people-dark"></i><span>아이디</span></label>
				<span><input type="text" name="adm_id" value="<?php echo (empty($env->_cookie['save_adm_id']))?"":$env->_cookie['save_adm_id']?>" id="adm_id" class="rt_input la required" msg="아이디를 정확히 입력해 주세요"></span>
			</div>
			<div class="rt_input_box">
				<label for="afor-input-2" class="rt_bgcon fr"><i class="rt_icon key-dark"></i><span>비밀번호</span></label>
				<span><input type="password" name="adm_pw" id="adm_pw" class="rt_input la required" value="" msg="비밀번호를 정확히 입력해 주세요"></span>
			</div>
			<div class="rt_check_box">
				<label for="is_memory"><input type="checkbox" name="is_memory" id="is_memory" value="y" <?php echo $is_save_id;?>><span class="check"> ID 기억하기</span></label>
			</div>
			<div class="bt-wrap">
				<button type="button" class="rt_btn dark icon block s-r" id="btnSubmit" style="cursor: pointer;"><i class="rt_icon check rt_marr5"></i><b>로그인</b></button>
			</div>
		</form>
		</div>
	</div>
</div>

<!-- common js //-->
<script src="<?php echo RTW_ASSETS;?>/js/common.lib.js" type="text/javascript"></script>

<!-- custom js //-->
<script src="<?php echo RTW_ADM;?>/login/assets/js/login.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" style="width:700px;height:500px;"></iframe>
</body>
</html>