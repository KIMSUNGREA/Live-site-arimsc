<?php /* Template_ 2.2.7 2016/11/23 13:20:08 /home/rintkit.com/dev/app/rtmember/template/mobile.rtmember.login.html 000001799 */ ?>
<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.');}?>
<div class="rt-member-wrap">
	<form name="login_form" method="post" action="<?php echo $TPL_VAR["path_user"]?>/update.php" target="rt_ifrm">
		<input type="hidden" name="mode" value="login">
		<input type="hidden" name="pcd" value="<?php echo $TPL_VAR["페이지코드"]?>">
<?php if($TPL_VAR["prepage"]){?>
		<input type="hidden" name="prepage" value="<?php echo $TPL_VAR["prepage"]?>">
<?php }?>
		<div class="rt-login-box">
			<ul class="input-box">
				<li><input type="text" name="userid" id="userid" msg="아이디를 입력해 주세요" placeholder="아이디"/></li>
				<li><input type="password" name="userpw" id="userpw" msg="비밀번호를 입력해 주세요" placeholder="비밀번호"/></li>
				<li><a href="#" id="btn-login">로그인</a></li>
			</ul>
		</div>
	</form>
	<h1 class="rt-join-substance">
		회원이 아니실 경우에는 <span>"회원가입"</span>을 하십시오.<br />
		패스워드/아이디를 잊으셧다면 <span>"아이디/패스워드 찾기"</span>로 찾으시면 됩니다.
	</h1>
	<div class="rt-button-wrap">
		<a href="<?php echo $TPL_VAR["page_join"]?>" class="rt-join-button">회원가입</a>
		<a href="<?php echo $TPL_VAR["page_find"]?>" class="rt-find-button">아이디/패스워드 찾기</a>
	</div>
</div>
<script src="<?php echo $TPL_VAR["path_assets"]?>/js/rtmember.login.js" type="text/javascript"></script>
<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>
<link rel="stylesheet" href="<?php echo $TPL_VAR["path_assets"]?>/css/rt_member_mobile.css" />