<?php /* Template_ 2.2.7 2016/07/14 13:22:43 /home/rintkit.com/dev/app/rtmember/template/mobile.rtmember.modify.html 000006356 */ 
$TPL_메일리스트_1=empty($TPL_VAR["메일리스트"])||!is_array($TPL_VAR["메일리스트"])?0:count($TPL_VAR["메일리스트"]);
$TPL_국번리스트_1=empty($TPL_VAR["국번리스트"])||!is_array($TPL_VAR["국번리스트"])?0:count($TPL_VAR["국번리스트"]);
$TPL_추가필드_1=empty($TPL_VAR["추가필드"])||!is_array($TPL_VAR["추가필드"])?0:count($TPL_VAR["추가필드"]);?>
<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.');}?>
<div class="rt-join-wrap">
	<div class="rt-join-container">
		<h1 class="rt-info-required clearfix">기본정보<span>* 필수입력사항</span></h1>
		<form name="modify_form" action="<?php echo $TPL_VAR["path_user"]?>/update.php" method="post" target="">
		<input type="hidden" name="mode" value="modify">
		<input type="hidden" name="path_user" value="<?php echo $TPL_VAR["path_user"]?>">
		<input type="hidden" name="php_self" value="<?php echo $TPL_VAR["php_self"]?>">
<?php if($TPL_VAR["회원"]["SNS회원"]=='y'){?>
		<input type="hidden" name="sns_m" value="y">
<?php }?>
		<table class="rt-join">
			<colgroup>
				<col width="*"/>
			</colgroup>
			<tbody>
<?php if($TPL_VAR["회원"]["SNS회원"]=="n"){?>
				<tr>
					<th>아이디</th>
				</tr>
				<tr>
					<td><?php echo $TPL_VAR["회원"]["아이디"]?></td>
				</tr>
				<tr>
					<th>비밀번호</th>
				</tr>
				<tr>
					<td><input type="password" class="rt-common-field" value="" name="user_pw" /></td>
				</tr>
				<tr>
					<th>비밀번호 확인</th>
				</tr>
				<tr>
					<td><input type="password" class="rt-common-field" value="" name="user_pw_re"/> <span class="rt-join-span">* 비밀번호를 입력시 변경됩니다.</span></td>
				</tr>
<?php }?>
				<tr>
					<th>이름</th>
				</tr>
				<tr>
					<td><?php if($TPL_VAR["회원"]["SNS회원"]=='n'){?><?php echo $TPL_VAR["회원"]["이름"]?><?php }else{?><input type="text" class="rt-common-field" name="user_nm" value="<?php echo $TPL_VAR["회원"]["이름"]?>"/><?php }?></td>
				</tr>
				<tr>
					<th>* 이메일</th>
				</tr>
				<tr>
					<td>
						<input type="text" class="rt-common-field email" name="email_id" id="email_id" msg="메일을 정확히 입력해 주세요" value="<?php echo $TPL_VAR["회원"]["이메일아이디"]?>"/> @ <input type="text" class="rt-common-field email" id="email_domain" name="email_domain" msg="메일을 정확히 입력해 주세요" value="<?php echo $TPL_VAR["회원"]["이메일도메인"]?>"/>
						<select class="rt-join-select" onchange="$('#email_domain').val($(this).val());">
							<option value="직접입력">직접입력</option>
<?php if($TPL_메일리스트_1){foreach($TPL_VAR["메일리스트"] as $TPL_V1){?>
							<option value="<?php echo $TPL_V1["도메인"]?>"><?php echo $TPL_V1["도메인"]?></option>
<?php }}?>
						</select>
					</td>
				</tr>
				<tr>
					<th>* 메일링 동의</th>
				</tr>
				<tr>
					<td>
						<label><input type="radio" value="y" name="email_en" <?php if($TPL_VAR["회원"]["메일수신"]=='y'){?>checked="checked"<?php }?> /> 예</label> 
						<label><input type="radio" value="n" name="email_en" <?php if($TPL_VAR["회원"]["메일수신"]=='n'){?>checked="checked"<?php }?> /> 아니오</label>
					</td>
				</tr>
				<tr>
					<th>* 연락처</th>
				</tr>
				<tr>
					<td>
						<select class="rt-join-select phone" name="phone1" id="phone1" msg="전화번호를 입력해 주세요">
							<option value="">선택</option>
<?php if($TPL_국번리스트_1){foreach($TPL_VAR["국번리스트"] as $TPL_V1){?>
							<option value="<?php echo $TPL_V1["국번"]?>" <?php if($TPL_V1["국번"]==$TPL_VAR["회원"]["전화번호1"]){?>selected="selected"<?php }?>><?php echo $TPL_V1["국번"]?></option>
<?php }}?>
						</select>
						- <input type="text" class="rt-common-field phone" name="phone2" id="phone2" maxlength="4" msg="전화번호를 입력해 주세요" value="<?php echo $TPL_VAR["회원"]["전화번호2"]?>"/> - <input type="text" class="rt-common-field phone" name="phone3" id="phone3" maxlength="4" msg="전화번호를 입력해 주세요" value="<?php echo $TPL_VAR["회원"]["전화번호3"]?>"/>
<?php if($TPL_VAR["SMS인증"]=='y'||$TPL_VAR["회원"]["SNS회원"]=='y'){?>
						<a class="rt-join-a" id="btnPhoneAuth">핸드폰 인증</a>
						<div style="display:none;" id="auth">
							<br />
								<input type="text" name="userinput_num" id="userinput_num" class="rt-common-field phone" maxlength="5" size="5">
								<a id="btnCheckAuthNum" class="rt-join-a">인증코드 확인</a>
						</div>
						<input type="hidden" name="is_sms_auth" value="n"/>
<?php }?>
					</td>
				</tr>
				<tr>
					<th>* SMS 수신동의</th>
				</tr>
				<tr class="rt-tr-last">
					<td>
						<label><input type="radio" class="" value="y" name="sms_en" <?php if($TPL_VAR["회원"]["SMS수신"]=='y'){?>checked="checked"<?php }?> /> 예</label> 
						<label><input type="radio" class="" value="n" name="sms_en" <?php if($TPL_VAR["회원"]["SMS수신"]=='n'){?>checked="checked"<?php }?> /> 아니오</label>
					</td>
				</tr>
			</tbody>
		</table>

<?php if($TPL_VAR["추가필드여부"]=='y'){?>
		<h1 class="rt-info-required">추가정보</h1>
		<table class="rt-join">
			<colgroup>
				<col width="18%"/>
				<col width="*"/>
			</colgroup>
			<tbody>
<?php if($TPL_추가필드_1){foreach($TPL_VAR["추가필드"] as $TPL_V1){?>
				<tr>
					<th><?php echo $TPL_V1["필드명"]?></th>
				</tr>
				<tr>
					<td><?php echo $TPL_V1["데이터"]?></td>
				</tr>
<?php }}?>
			</tbody>
		</table>
<?php }?>

		<div class="rt-button-wrap">
			<a href="#;" id="btn-form-submit" class="rt-join-step-next">회원 정보 수정</a>
			<a href="?cf=mypage" class="rt-join-step-back">돌아가기</a>
		</div>
	</div>
</div>

<script src="<?php echo $TPL_VAR["path_assets"]?>/js/rtmember.modify.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $TPL_VAR["path_assets"]?>/css/rt_member_mobile.css" />

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>