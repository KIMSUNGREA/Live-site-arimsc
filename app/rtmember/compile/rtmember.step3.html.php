<?php /* Template_ 2.2.8 2017/03/11 00:47:06 /home/rintkit.com/new/app/rtmember/template/rtmember.step3.html 000000868 */ ?>
<!-- 반응형 회원 시작 -->
<div class="rt-rwd-member-wrap">
	<div class="rt-rwd-join-result-wrap">
		<h1 class="rt-rwd-join-result-title">가입완료</h1>
		<p class="rt-rwd-join-result-substance">회원가입이 완료되었습니다.</p>
		<p class="rt-rwd-join-result-substance">가입하신 아이디는 <span class="rt-red-join-bold"><?php echo $TPL_VAR["가입아이디"]?></span>입니다.</p>
	</div>
	<!-- 버튼 시작 -->
	<div class="rt-button rt-button-tac">
		<a href="/">메인으로</a>
		<a href="<?php echo $TPL_VAR["page_login"]?>">로그인</a>
	</div>
	<!-- 버튼 끝 -->
</div>
<!-- 반응형 회원 끝 -->

<link rel="stylesheet" href="<?php echo $TPL_VAR["path_assets"]?>/css/rt_member.css" />