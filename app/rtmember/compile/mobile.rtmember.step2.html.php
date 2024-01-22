<?php /* Template_ 2.2.7 2016/06/13 10:29:58 /home/rintkit.com/dev/app/rtmember/template/mobile.rtmember.step2.html 000006720 */ 
$TPL_메일리스트_1=empty($TPL_VAR["메일리스트"])||!is_array($TPL_VAR["메일리스트"])?0:count($TPL_VAR["메일리스트"]);
$TPL_국번리스트_1=empty($TPL_VAR["국번리스트"])||!is_array($TPL_VAR["국번리스트"])?0:count($TPL_VAR["국번리스트"]);
$TPL_추가필드_1=empty($TPL_VAR["추가필드"])||!is_array($TPL_VAR["추가필드"])?0:count($TPL_VAR["추가필드"]);?>
<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.');}?>
<div class="rt-join-wrap">
	<div class="rt-join-container">
		<h1 class="rt-info-required clearfix">기본정보<span>* 필수입력사항</span></h1>
		<form name="join_form" action="<?php echo $TPL_VAR["path_user"]?>/update.php" method="post" target="rt_ifrm">
		<input type="hidden" name="mode" value="insert">
		<input type="hidden" name="path_user" value="<?php echo $TPL_VAR["path_user"]?>">
		<input type="hidden" name="php_self" value="<?php echo $TPL_VAR["php_self"]?>">
		<input type="hidden" name="id_check" value="">
		<table class="rt-join">
			<colgroup>
				<col width="*"/>
			</colgroup>
			<tbody>
				<tr>
					<th>* 아이디</th>
				</tr>
				<tr>
					<td class="posr"><input type="text" class="rt-common-field" name="user_id" msg="아이디를 입력해 주세요"/><a href="#none" class="rt-join-a" id="btn-id-check">중복확인</a><span class="rt-join-span">* 4자 이상, 12자 이하 영문 및 숫자</span></td>
				</tr>
				<tr>
					<th>* 비밀번호</th>
				</tr>
				<tr>
					<td><input type="password" class="rt-common-field" name="user_pw" msg="비밀번호를 입력해 주세요"/><span class="rt-join-span">* 영문, 숫자조합으로 6 ~12자 이내로 사용하실 수 있습니다</span></td>
				</tr>
				<tr>
					<th>* 비밀번호 확인</th>
				</tr>
				<tr>
					<td><input type="password" class="rt-common-field" name="user_pw_re" msg="비밀번호를 다시 한번 입력해 주세요"/><span class="rt-join-span">* 비밀번호를 한번 더 입력하여 주십시오</span></td>
				</tr>
				<tr>
					<th>* 이름</th>
				</tr>
				<tr>
					<td><input type="text" class="rt-common-field" name="user_nm" msg="이름을 입력해 주세요"/></td>
				</tr>
				<tr>
					<th>* 이메일</th>
				</tr>
				<tr>
					<td>
						<input type="text" class="rt-common-field email" name="email_id" id="email_id" msg="메일을 정확히 입력해 주세요"/> @ <input type="text" class="rt-common-field email right" id="email_domain" name="email_domain" msg="메일을 정확히 입력해 주세요"/>
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
						<label><input type="radio" value="y" name="email_en" checked="checked"/> 예 </label>
						<label><input type="radio" value="n" name="email_en"/> 아니오 </label>
					</td>
				</tr>
				<tr>
					<th>* 휴대폰</th>
				</tr>
				<tr>
					<td>
						<select class="rt-join-select phone" name="phone1" id="phone1" msg="휴대폰번호를 정확히 입력해 주세요">
							<option value="선택">선택</option>
<?php if($TPL_국번리스트_1){foreach($TPL_VAR["국번리스트"] as $TPL_V1){?>
							<option value="<?php echo $TPL_V1["국번"]?>"><?php echo $TPL_V1["국번"]?></option>
<?php }}?>
						</select>
						- <input type="text" class="rt-common-field phone" name="phone2" id="phone2" maxlength="4" msg="휴대폰번호를 정확히 입력해 주세요"/> - <input type="text" class="rt-common-field phone right" name="phone3" id="phone3" maxlength="4" msg="휴대폰번호를 정확히 입력해 주세요"/>
<?php if($TPL_VAR["SMS인증"]=='y'){?>
						<a class="rt-join-a" id="btnPhoneAuth">휴대폰 인증</a>
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
				<tr>
					<td>
						<label><input type="radio" value="y" name="sms_en" checked="checked"/> 예 </label>
						<label><input type="radio" value="n" name="sms_en"/> 아니오 </label>
					</td>
				</tr>
<?php if($TPL_VAR["추가필드여부"]=='n'){?>
				<tr>
					<th>* 보안문자</th>
				</tr>
				<tr>
					<td><span id="capcha_str"></span> <a class="rt-join-a" href="#;" onclick="rt_get_capcha()">새로고침</a></td>
				</tr>
				<tr class="rt-tr-last">
					<td><input type="text" class="rt-common-field required" value="" name="sec_code" msg="보안문자를 입력해 주세요" style="width:100px;" /> ※보안문자를 입력해 주세요.</td>
				</tr>
<?php }?>
			</tbody>
		</table>

<?php if($TPL_VAR["추가필드여부"]=='y'){?>
		<h1 class="rt-info-required">추가정보</h1>
		<table class="rt-join">
			<colgroup>
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
				<tr>
					<th>* 보안문자</th>
				</tr>
				<tr>
					<td><span id="capcha_str"></span> <a class="rt-join-a" href="#;" onclick="rt_get_capcha()">새로고침</a></td>
				</tr>
				<tr class="rt-tr-last">
					<td><input type="text" class="rt-common-field required" value="" name="sec_code" msg="보안문자를 입력해 주세요" style="width:100px;" /> ※보안문자를 입력해 주세요.</td>
				</tr>
			</tbody>
		</table>
<?php }?>

		<div class="rt-button-wrap">
			<a href="#;" id="btn-form-submit" class="rt-join-step-next">회원 가입</a>
		</div>
	</div>
</div>

<script src="<?php echo $TPL_VAR["path_assets"]?>/js/rtmember.join.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $TPL_VAR["path_assets"]?>/css/rt_member_mobile.css" />

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>