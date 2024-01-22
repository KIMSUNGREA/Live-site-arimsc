<?php /* Template_ 2.2.7 2016/05/11 19:20:48 /home/rintkit.com/dev/app/rtmember/template/mobile.rtmember.withdraw.html 000002573 */ ?>
<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.');}?>
<div class="rt-join-wrap">
	<div class="rt-join-container">
		<h1 class="rt-info-required"></h1>
		<form name="withdraw_form" action="<?php echo $TPL_VAR["path_user"]?>/update.php" method="post" target="rt_ifrm">
		<input type="hidden" name="mode" value="withdraw">
		<input type="hidden" name="path_user" value="<?php echo $TPL_VAR["path_user"]?>">
		<input type="hidden" name="php_self" value="<?php echo $TPL_VAR["php_self"]?>">
		<table class="rt-join">
			<colgroup>
				<col width="*"/>
			</colgroup>
			<tbody>
				<tr>
					<th>개인정보처리</th>
				</tr>
				<tr>
					<td>
						<p><label><input type="radio" value="1" name="withdraw_type_en" checked="checked" /> 동일한 아이디의 재가입 방지 용도로 사용할 아이디만 남기고 모든 정보는 즉시 파기합니다.</label> </p>
						<p style="margin-top:10px;"><label><input type="radio" value="2" name="withdraw_type_en" /> 회원 아이디까지 포함하는 모든 정보를 즉시 파기합니다.(다른 회원이 동일한 아이디 사용가능)</label> </p>
					</td>
				</tr>
				<tr>
					<th>주의사항</th>
				</tr>
				<tr>
					<td><p>회원 탈퇴 시 홈페이지에 등록/제공한 자료는 자동으로 삭제되지 않습니다.<br />
					탈퇴 전에 회원으로 등록한 자료를 삭제하거나 운영자에게 삭제 요청한 후 탈퇴하셔야 합니다.</p>
					</td>
				</tr>
				<tr>
					<th>보안문자</th>
				</tr>
				<tr>
					<td><span id="capcha_str"></span> <a class="rt-join-a-2" href="#" onclick="rt_get_capcha()">새로고침</a></td>
				</tr>
				<tr>
					<td><input type="text" class="rt-common-field" value="" name="sec_code" msg="보안문자를 입력해 주세요" /> ※보안문자를 입력해 주세요.</td>
				</tr>
			</tbody>
		</table>
		<div class="rt-button-wrap">
			<a href="#;" id="btn-form-submit" class="rt-join-step-next">회원 탈퇴하기</a>
			<a href="?cf=mypage" class="rt-join-step-back">돌아가기</a>
		</div>
	</div>
</div>
<script src="<?php echo $TPL_VAR["path_assets"]?>/js/rtmember.withdraw.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $TPL_VAR["path_assets"]?>/css/rt_member_mobile.css" />

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>