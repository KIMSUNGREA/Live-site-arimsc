<?php /* Template_ 2.2.7 2016/05/03 12:13:35 /home/rintkit.com/dev/app/rtmember/template/mobile.rtmember.step1.html 000001595 */ ?>
<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.');}?>
<form name="agree_form" method="post" action="?cf=step2"><input type="hidden" name="is_agree" value="y"></form>
<div class="rt-join-wrap">
	<div class="rt-join-container">
		<h1 class="rt-info-required"><?php echo $TPL_VAR["agreement1_title"]?></h1>
		<div class="rt-agree-wrap">
			<textarea class="rt-agree-box" title="">
<?php echo $TPL_VAR["agreement1_txt"]?>

			</textarea>
		</div>
		<h1 class="rt-agree-check"><label for="agr1"><input type="checkbox" id="agr1"/><span>동의합니다.</span></label></h1>
		<h1 class="rt-info-required"><?php echo $TPL_VAR["agreement2_title"]?></h1>
		<div class="rt-agree-wrap">
			<textarea class="rt-agree-box" title="">
<?php echo $TPL_VAR["agreement2_txt"]?>

			</textarea>
		</div>
		<h1 class="rt-agree-check"><label for="agr2"><input type="checkbox" id="agr2"/><span>동의합니다.</span></label></h1>
		<h1 class="rt-all-agree">
			<label for="agr-all">
				<input type="checkbox" id="agr-all"/>
				<span>모두 동의합니다.</span>
			</label>
		</h1>
		<div class="rt-button-wrap">
			<a href="#none" id="btn-agree" class="rt-join-step-next">회원 정보 입력 </a>
		</div>
	</div>
</div>
<script src="<?php echo $TPL_VAR["path_assets"]?>/js/rtmember.join.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $TPL_VAR["path_assets"]?>/css/rt_member_mobile.css" />