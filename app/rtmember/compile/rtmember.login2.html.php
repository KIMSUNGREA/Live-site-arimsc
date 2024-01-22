<?php /* Template_ 2.2.7 2016/07/01 16:17:28 /home/rintkit.com/dev/app/rtmember/template/rtmember.login2.html 000001880 */ ?>
<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.');}?>
<h1 class="rt-member-title">로그인</h1>
<div class="rt-member-wrap">
	<form name="login_form" method="post" action="<?php echo $TPL_VAR["path_user"]?>/update.php" target="rt_ifrm">
		<input type="hidden" name="mode" value="login">
<?php if($TPL_VAR["prepage"]){?>
		<input type="hidden" name="prepage" value="<?php echo $TPL_VAR["prepage"]?>">
<?php }?>
		<div class="rt-login-box" style="padding-bottom:0px;">
			<ul class="text-box">
				<li>아이디</li>
				<li>패스워드</li>
			</ul>
			<ul class="input-box">
				<li><input type="text" name="userid" id="userid" value="<?php echo $TPL_VAR["아이디"]?>" msg="아이디를 입력해 주세요"/></li>
				<li><input type="password" name="userpw" id="userpw" msg="비밀번호를 입력해 주세요"/></li>
				<li style="margin: -7px -11px; float: left;"><label for="is_memory" class=""><input type="checkbox" name="is_memory" id="is_memory" value="y" style="width:12px; height:12px;float:none;" <?php echo $TPL_VAR["아이디기억하기"]?>><span> ID 기억하기</span></label></li>
			</ul>
			<ul class="button-box">
				<li><a href="#" id="btn-login">로그인</a></li>
			</ul>
		</div>
	</form>
	<div class="rt-button-wrap">
		<a href="<?php echo $TPL_VAR["page_find"]?>">아이디/패스워드 찾기</a>
		<a href="<?php echo $TPL_VAR["page_join"]?>">회원가입</a>
	</div>
</div>
<script src="<?php echo $TPL_VAR["path_assets"]?>/js/rtmember.login.js" type="text/javascript"></script>
<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>
<link rel="stylesheet" href="<?php echo $TPL_VAR["path_assets"]?>/css/rt_member.css" />