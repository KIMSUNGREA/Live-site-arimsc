<?php /* Template_ 2.2.7 2016/06/16 17:17:24 /home/rintkit.com/dev/app/rtmember/template/mobile.rtmember.find.html 000002435 */ ?>
<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.');}?>
<input type="hidden" id="ssl" value="<?php echo $TPL_VAR["ssl"]?>">

<form name="findid_form" method="post" target="rt_ifrm">
	<div class="rt-find-wrap">
		<div class="rt-find">
			<h1 class="rt-find-title">아이디 찾기</h1>
			<h1 class="rt-find-substance">회원가입 시 등록하신 이름 과 메일주소를 입력해 주세요.</h1>
			<ul class="rt-find-id">
				<li><input type="text" id="findid_name" placeholder="이름"/></li>
				<li><input type="text" id="findid_email" placeholder="가입 메일주소"/></li>
				<li><span id="capcha_str"></span> <a class="" href="#;" onclick="rt_get_capcha()">새로고침</a></li>
				<li><input type="text" class="rt-join-input" value="" name="sec_code" id="sec_code" style="width:100px;" /> ※보안문자를 입력해 주세요.</li>
				<li><a href="#none" id="btn-find-id">아이디 찾기</a></li>
			</ul>
		</div>
	</div>
</form>
<form name="findpw_form" method="post" target="rt_ifrm">
	<div class="rt-find-wrap">
		<div class="rt-find">
			<h1 class="rt-find-title">비밀번호 찾기</h1>
			<h1 class="rt-find-substance">회원가입 시 등록하신 이름 과 메일주소를 입력해 주세요. <br />이메일발송으로 아이디와 비밀번호 정보를 보내드립니다.</h1>
			<ul class="rt-find-password">
				<li><input type="text" id="findpw_name" placeholder="이름"/></li>
				<li><input type="text" id="findpw_id" placeholder="아이디"/></li>
				<li><input type="text" id="findpw_email" placeholder="가입 메일주소"/></li>
				<li><span id="capcha_str2"></span> <a class="" href="#;" onclick="rt_get_capcha2()">새로고침</a></li>
				<li><input type="text" class="rt-join-input" value="" name="sec_code2" id="sec_code2" style="width:100px;" /> ※보안문자를 입력해 주세요.</li>
				<li><a href="#none" id="btn-find-pw">비밀번호 찾기</a></li>
			</ul>
		</div>
	</div>
</form>
<script src="<?php echo $TPL_VAR["path_assets"]?>/js/rtmember.find.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $TPL_VAR["path_assets"]?>/css/rt_member_mobile.css" />
<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>