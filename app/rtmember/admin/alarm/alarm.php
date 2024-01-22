<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<form name="dataform" action="<?=$_def['path_app']."/".$__sd?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="<?=$__cfg['mode']?>">
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>알림 설정</h1>
</div>
<table class="rt_field_table mb10">
	<caption>알림 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tr>
		<th><p>가입 시 메일 발송여부</p></th>
		<td>
			<label><input name="join_send_email_en" value="y" type="radio" <?php echo $join_send_email_en_y;?>><span>사용함</span></label>
			<label><input name="join_send_email_en" value="n" type="radio" <?php echo $join_send_email_en_n;?>><span>사용하지 않음</span></label>
		</td>
	</tr>
	<tr>
		<th><p>가입 시 SMS 발송여부</p></th>
		<td>
			<label><input name="join_send_sms_en" value="y" type="radio" <?php echo $join_send_sms_en_y;?>><span>사용함</span></label>
			<label><input name="join_send_sms_en" value="n" type="radio" <?php echo $join_send_sms_en_n;?>><span>사용하지 않음</span></label>
		</td>
	</tr>
</table>

<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>SMS 메시지 설정</h1>
</div>
<table class="rt_field_table mb10">
	<caption>문구 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tr>
		<th><p>가입 시 발송 SMS</p></th>
		<td>
			<textarea name="sms_content"><?php echo $r['sms_content'];?></textarea>
		</td>
	</tr>
</table>

<div class="rt_s_tit clearfix">
	<p>03<span></span></p>
	<h1>스킨 설정</h1>
</div>
<table class="rt_field_table mb10">
	<caption>스킨 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tr>
		<th>스킨 파일 경로</th>
		<td>
			<span class="rt_txt rt_brown">FTP PATH : <?php echo $_def['path_app']?>/template/</span>
		</td>
	</tr>
	<tr>
		<th><p>가입메일 스킨</p></th>
		<td>
			<select class="rt_input_txt" name="mb_skin_join_mail" msg="템플릿 파일을 선택해 주세요">
				<option value="">템플릿파일을 선택해 주세요</option>
				<?php foreach ($tpl_files as $k => $v) {?>
				<option value="<?php echo $v;?>" <?php echo ($v == $r['mb_skin_join_mail'])?"selected":"";?>><?php echo $v;?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr>
		<th><p>아이디 찾기 메일 스킨</p></th>
		<td>
			<select class="required rt_input_txt" name="mb_skin_findid_mail" msg="템플릿 파일을 선택해 주세요">
				<option value="">템플릿파일을 선택해 주세요</option>
				<?php foreach ($tpl_files as $k => $v) {?>
				<option value="<?php echo $v;?>" <?php echo ($v == $r['mb_skin_findid_mail'])?"selected":"";?>><?php echo $v;?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr>
		<th><p>패스워드 찾기 메일 스킨</p></th>
		<td>
			<select class="required rt_input_txt" name="mb_skin_findpw_mail" msg="템플릿 파일을 선택해 주세요">
				<option value="">템플릿파일을 선택해 주세요</option>
				<?php foreach ($tpl_files as $k => $v) {?>
				<option value="<?php echo $v;?>" <?php echo ($v == $r['mb_skin_findpw_mail'])?"selected":"";?>><?php echo $v;?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr>
		<th><p>휴면회원 휴면 해제 메일 스킨</p></th>
		<td>
			<select class="required rt_input_txt" name="mb_skin_rest_mail" msg="템플릿 파일을 선택해 주세요">
				<option value="">템플릿파일을 선택해 주세요</option>
				<?php foreach ($tpl_files as $k => $v) {?>
				<option value="<?php echo $v;?>" <?php echo ($v == $r['mb_skin_rest_mail'])?"selected":"";?>><?php echo $v;?></option>
				<?php }?>
			</select>
		</td>
	</tr>
</table>
<div class="rt_button_wrap rt_tar mb30">
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">설정 변경</a>
</div>
</form>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em><span class="rt_mint">메일 발송 알림</span>을 사용하기 위해서는 <span class="rt_mint">메일 서버 정보</span>가 설정되어 있어야 합니다. <a href="<?php echo RTW_ADM;?>/config/?sd=config" class="rt_mint">(메일 서버 설정하기)</a></p>
	<p><em>-</em><span class="rt_mint">SMS 발송 알림</span>을 사용하기 위해서는 <span class="rt_mint">SMS 업체 정보</span>가 설정되어 있어야 합니다. <a href="<?php echo RTW_ADM;?>/config/?sd=config" class="rt_mint">(SMS 환경 설정하기)</a></p>
</div>

<script src="<?php echo $_def['path_assets'];?>/js/rtmember.admin.alarm.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>