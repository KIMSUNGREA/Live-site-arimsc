<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="dataform" action="<?php echo $__sc?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="modify">
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>관리자 타이틀</h1>
</div>
<table class="rt_data_table">
	<caption>관리자 환경설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>타이틀 명</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['adm_title'];?>" name="adm_title" />
			</td>
		</tr>
	</tbody>
</table>
<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>도메인 환경설정</h1>
</div>
<table class="rt_data_table">
	<caption>관리자 환경설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>도메인 URL</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['domain'];?>" name="domain" />
			</td>
		</tr>
		<tr>
			<th><p>보안 SSL</p></th>
		<td>
			<p><label><input name="ssl_is" id="ssl_y" value="y" type="radio" <?php echo $ssl_is_y?>><span>사용함</span></label></p>
			<p><label><input name="ssl_is" value="n" type="radio" <?php echo $ssl_is_n?>><span>사용안함</span></label></p>
		</td>
		</tr>
		<tr>
			<th><p>SSL PORT</p></th>
			<td>
				<input type="text" class="rt_input_txt rt_w250" value="<?php echo $_r['ssl_port'];?>" name="ssl_port" id="ssl_port" />
			</td>
		</tr>
		<tr>
			<th><p>관리자 접속IP</p></th>
			<td>
				<p><label><input name="ip_set_type" value="N" type="radio" <?php echo $ip_set_type_N?>><span>제한안함</span></label></p>
				<p><label><input name="ip_set_type" value="D" type="radio" <?php echo $ip_set_type_D?>><span>IP차단</span></label></p>
				<p><label><input name="ip_set_type" value="P" type="radio" <?php echo $ip_set_type_P?>><span>IP허용</span></label></p>
			</td>
		</tr>
	</tbody>
</table>
<div class="rt_s_tit clearfix">
	<p>03<span></span></p>
	<h1>시스템 수/발신정보 설정</h1>
</div>
<table class="rt_data_table">
	<caption>관리자 환경설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>발신 명</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['sender_name'];?>" name="sender_name" />
			</td>
			<th><p>수신 명</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['receive_name'];?>" name="receive_name" />
			</td>
		</tr>
		<tr>
			<th><p>발신 이메일</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['sender_email'];?>" name="sender_email" />
			</td>
			<th><p>수신 이메일</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['receive_email'];?>" name="receive_email" />
			</td>
		</tr>
		<tr>
			<th><p>발신 번호</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['sender_phone'];?>" name="sender_phone" />
			</td>
			<th><p>수신 번호</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['receive_phone'];?>" name="receive_phone" />
			</td>
		</tr>
	</tbody>
</table>
<div class="rt_s_tit clearfix">
	<p>04<span></span></p>
	<h1>SMTP 환경 설정</h1>
</div>
<table class="rt_data_table">
	<caption>관리자 환경설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>HOST</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['smtp_host'];?>" name="smtp_host" />
			</td>
		</tr>
		<tr>
			<th><p>PORT</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['smtp_port'];?>" name="smtp_port" />
			</td>
		</tr>
		<tr>
			<th><p>계정 ID</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['smtp_id'];?>" name="smtp_id" />
			</td>
		</tr>
		<tr>
			<th><p>계정 PW</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['smtp_pw'];?>" name="smtp_pw" />
			</td>
		</tr>
	</tbody>
</table>
<div class="rt_s_tit clearfix">
	<p>05<span></span></p>
	<h1>SMS 환경 설정</h1>
</div>
<table class="rt_data_table">
	<caption>관리자 환경설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>SMS 서비스 업체</p></th>
			<td>
				<p>쿨에스엠에스(coolsms.co.kr)</p>
			</td>
		</tr>
		<tr>
			<th><p>계정 ID</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['sms_id'];?>" name="sms_id" />
			</td>
		</tr>
		<tr>
			<th><p>계정 PW</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['sms_pw'];?>" name="sms_pw" />
			</td>
		</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar mb25">
	<a href="#;" id="btn-submit" class="rt_btn_blue">정보 변경</a>
</div>

<script src="assets/js/config.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>