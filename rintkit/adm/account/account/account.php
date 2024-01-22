<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="data_form" action="<?php echo $__sc;?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="modify">
<table class="rt_field_table mb10">
	<caption>마스터 계정 정보</caption>
	<colgroup>
		<col width="170px">
		<col width="*">
		<col width="170px">
		<col width="*">
	</colgroup>
	<tr>
		<th><p>아이디</p></th>
		<td colspan="3"><span class="rt_txt"><?php echo $_r['adm_id'];?></span></td>
	</tr>
	<tr>
		<th><p>현재 비밀번호</p></th>
		<td colspan="3"><input type="password" name="adm_pwd_now" value="" class="rt_input_txt required" msg="현재 비밀번호를 입력해 주세요"></td>
	</tr>
	<tr>
		<th><p>새 비밀번호</p></th>
		<td><input type="password" name="adm_pwd_new" value="" class="rt_input_txt required" msg="새 비밀번호를 입력해 주세요"></td>
		<th><p>재입력</p></th>
		<td><input type="password" name="adm_pwd_new_re" value="" class="rt_input_txt required" msg="새 비밀번호를 다시 입력해 주세요"></td>
	</tr>
	<tr>
		<th><p>최근 변경일</p></th>
		<td><?php echo $_r['last_pw_dt'];?></td>
		<th><p>마지막 로그인</p></th>
		<td><?php echo $_r['login_date'];?></td>
	</tr>
</table>
</form>

<div class="rt_button_wrap rt_tar mb20">
	<a href="#;" class="rt_btn_blue" id="btn_submit">정보 변경</a>
</div>

<?php if ($cls_adm->auth_code == "master") {?>
<div class="rt_bot_box">
	<h1>이용안내</h1>
	<p class="rt_mint"><em>-</em>마스터 계정은 일반 관리자 계정의 현재 비밀번호가 맞지 않아도 새 비밀번호로 강제 설정할 수 있습니다.</p>
</div>
<?php } ?>

<script src="assets/js/account.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>