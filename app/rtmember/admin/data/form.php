<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>기본 정보</h1>
</div>

<form name="dataform" action="<?php echo $_def['path_app']."/".$__sd?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="<?php echo $__cfg['mode'];?>">
<input type="hidden" name="seq" value="<?php echo $env->_get['seq'];?>">
<input type="hidden" name="sd" value="<?php echo $env->_get['sd'];?>">
<input type="hidden" name="search" value="<?php echo $env->_get['search'];?>">
<input type="hidden" name="searchstring" value="<?php echo $env->_get['searchstring'];?>">
<input type="hidden" name="pg" value="<?php echo $env->_get['pg'];?>">
<input type="hidden" name="id_check" value="">
<input type="hidden" name="buy_en" value="<?php echo $env->_get['buy_en'];?>">
<table class="rt_field_table mb10">
	<caption>회원수기입력</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tr>
		<th><p>아이디</p></th>
		<td>
		<?php if ($__cfg['mode'] == "insert") {?>
			<input type="text" class="rt_input_txt rt_w250 required" value="<?php echo $_r['user_id'];?>" name="user_id" msg="아이디를 입력해 주세요" />
			<span class="rt_button_wrap"><a href="#;" id="btn-id-check" class="rt_btn_orange bth_in">중복확인</a></span>
		<?php } else {?>
			<?php echo $_r['user_id'];?>
		<?php }?>
		</td>
		<th><p>이름</p></th>
		<td><input type="text" class="rt_input_txt required" value="<?php echo $_r['user_nm'];?>" name="user_nm" msg="이름을 입력해 주세요" /></td>
	</tr>
	<?php if ($__cfg['mode'] == "insert") {?>
	<tr>
		<th><p>패스워드</p></th>
		<td><input type="password" class="rt_input_txt required" value="" name="user_pw" msg="비밀번호를 입력해 주세요" /></td>
		<th><p>재입력</p></th>
		<td><input type="password" class="rt_input_txt required" value="" name="user_pw_re" msg="비밀번호를 다시 한번 입력해 주세요" /></td>
	</tr>
	<?php } else {?>
	<tr>
		<th>패스워드</th>
		<td><input type="password" class="rt_input_txt" value="" name="user_pw" /></td>
		<th>재입력</th>
		<td><input type="password" class="rt_input_txt" value="" name="user_pw_re" /></td>
	</tr>
	<?php }?>
	<tr>
		<th><p>이메일</p></th>
		<td>
			<div class="rt_box3 clearfix">
				<div><input type="text" disabled="true" id="email_id" value="<?php echo $email[0];?>" name="email_id" msg="메일을 정확히 입력해 주세요" class="rt_input_txt" /><span>@</span></div>
				<div><input type="text" disabled="true" id="email_domain" name="email_domain" value="<?php echo $email[1];?>" msg="메일을 정확히 입력해 주세요" class="rt_input_txt" /></div>
				<div>
					<select disabled="true" class="rt_input_txt" onchange="$('#email_domain').val($(this).val());">
						<option value="">직접입력</option>
						<?php for ($m = 0; $m < count($_rtm_cfg['email']); $m++) {?>
						<option value="<?php echo $_rtm_cfg['email'][$m];?>"><?php echo $_rtm_cfg['email'][$m];?></option>
						<?php }?>
					</select>
				</div>
			</div>
		</td>
		<th><p>메일링</p></th>
		<td>
			<label><input name="email_en" value="y" type="radio" <?php echo $email_en_y;?>>동의함</label>
			<label><input name="email_en" value="n" type="radio" <?php echo $email_en_n;?>>동의안함</label>
		</td>
	</tr>
	<tr>
		<th><p>전화번호</p></th>
		<td>
			<div class="rt_box3 clearfix">
				<div>
					<select class="rt_input_txt" name="phone1">
						<?php for ($m = 0; $m < count($_rtm_cfg['phone']); $m++) {?>
						<option value="<?php echo $_rtm_cfg['phone'][$m];?>" <?php echo ($_rtm_cfg['phone'][$m]==$phone[0])?"selected":""?>><?php echo $_rtm_cfg['phone'][$m];?></option>
						<?php }?>
					</select>
				</div>
				<div><input type="text" class="rt_input_txt required" value="<?php echo $phone[1];?>" name="phone2" maxlength="4" msg="전화번호를 입력해 주세요" /><span>-</span></div>
				<div><input type="text" class="rt_input_txt required" value="<?php echo $phone[2];?>" name="phone3" maxlength="4" msg="전화번호를 입력해 주세요" /></div>
			</div>
		</td>
		<th><p>SMS수신</p></th>
		<td>
			<label><input name="sms_en" value="Y" type="radio" <?php echo $sms_en_y;?>>동의함</label>
			<label><input name="sms_en" value="N" type="radio" <?php echo $sms_en_n;?>>동의안함</label>
		</td>
	</tr>
	<tr>
		<th><p>회원분류</p></th>
		<td>
			<select class="rt_input_txt required" name="mgroup" msg="회원그룹을 설정해 주세요">
				<option value="">회원그룹을 선택해 주세요</option>
				<?php for ($m = 0; $m < count($grp); $m++) {?>
				<option value="<?php echo $grp[$m]['grp_seq'];?>" <?php echo ($grp[$m]['grp_seq'] == $_r['mgroup'])?"selected":""?>><?php echo $grp[$m]['grp_name'];?></option>
				<?php }?>
			</select>
		</td>
		<th><p>추천인코드</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo $_r['recode'];?>" name="recode" /></td>
	</tr>
	<tr>
		<th><p>휴면여부</p></th>
		<td>
			<label><input name="rest_en" value="n" type="radio" <?php echo $rest_en_n;?>>활동회원</label>
			<label><input name="rest_en" value="y" type="radio" <?php echo $rest_en_y;?>>휴면회원</label>
		</td>
		<th><p>휴면 처리일</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo ($_r['rest_date']!="0000-00-00")?$_r['rest_date']:"";?>" name="rest_date" id="rest_date" /></td>
	</tr>
	<tr>
		<th><p>로그인차단</p></th>
		<td>
			<label><input name="blockout_en" value="n" type="radio" <?php echo $blockout_en_n;?>>접속허용</label>
			<label><input name="blockout_en" value="y" type="radio" <?php echo $blockout_en_y;?>>접속차단</label>
		</td>
		<th><p>로그인 차단일</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo ($_r['blockout_date']!="0000-00-00")?$_r['blockout_date']:""?>" name="blockout_date" id="blockout_date" /></td>
	</tr>
	<tr>
		<th><p>탈퇴여부</p></th>
		<td>
			<label><input name="withdraw_en" value="n" type="radio" <?php echo $withdraw_en_n;?>>활동회원</label>
			<label><input name="withdraw_en" value="y" type="radio" <?php echo $withdraw_en_y;?>>탈퇴회원</label>
		</td>
		<th><p>탈퇴처리일</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo ($_r['withdraw_date']!="0000-00-00")?$_r['withdraw_date']:""?>" name="withdraw_date" id="withdraw_date" /></td>
	</tr>
	<tr>
		<th><p>가입일</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo ($_r['reg_date']!="0000-00-00")?$_r['reg_date']:""?>" name="reg_date" id="reg_date" /></td>
		<th><p>수정일</p></th>
		<td>
			<?php if ($__cfg['mode'] == "modify") { ?>
			<input type="text" class="rt_input_txt" value="<?php echo ($_r['mod_date']!="0000-00-00")?$_r['mod_date']:""?>" name="mod_date" id="mod_date" />
			<?php } ?>
		</td>
	</tr>
</table>
<?php if (count($_fset) > 0) {?>

<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>추가 정보</h1>
</div>

<table class="rt_field_table mb10">
<caption>회원 추가 정보</caption>
<colgroup>
	<col width="15%" />
	<col width="85%" />
</colgroup>
<tbody>
<?for ($m = 0; $m < count($_fset); $m++){?>
<tr id="rt-textarea-box">
	<th><?php echo $_fset[$m]['name'];?></th>
	<td><?php echo $cls_mem->formset($_fset[$m], $sz, true)?></td>
</tr>
<?}?>
</tbody>
</table>
<?php } ?>
</form>

<div class="rt_button_wrap rt_tar">
	<?php if ($__cfg['mode'] == "modify") { ?>
	<a href="javascript:member_delete(<?php echo $env->_get['seq'];?>,'');" class="rt_btn_red">회원 삭제</a>
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">회원 등록</a>
	<?php } else { ?>
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">회원 등록</a>
	<?php } ?>
	<a href="#;" id="btn-move-list" class="rt_btn_gray">목록 가기</a>
</div>

<script src="<?php echo $_def['path_assets'];?>/js/rtmember.admin.data.js?ver=001" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>