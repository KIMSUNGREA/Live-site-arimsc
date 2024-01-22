<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<form name="dataform" action="<?php echo $_def['path_app']."/".$__sd;?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="<?php echo $__cfg['mode'];?>">
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>회원가입</h1>
</div>
<table class="rt_data_table">
	<caption>회원가입</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>관리자 승인제</p></th>
			<td>
				<p>
					<label><input name="mb_approval_en" value="y" type="radio" <?php echo $mb_approval_en_y;?>> 관리자 승인 후 가입</label>
					<label><input name="mb_approval_en" value="n" type="radio" <?php echo $mb_approval_en_n;?>> 가입 시 자동 승인</label>
				</p>
			</td>
			<th><p>회원가입 허가</p></th>
			<td>
				<p>
					<label><input name="join_permission_en" value="y" type="radio" <?php echo $join_permission_en_y;?>> 회원가입을 허가합니다.</label>
					<label><input name="join_permission_en" value="n" type="radio" <?php echo $join_permission_en_n;?>> 당분간 받지 않습니다.</label>
				</p>
			</td>
		</tr>
		<tr>
			<th><p>회원가입 후 이동 페이지</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $r['join_after_url'];?>" name="join_after_url" />
				<p class="rt_green">도메인을 제외한 절대 경로를 입력해 주세요. Ex) /main/index.php</p>
			</td>
			<th><p>(모바일) 회원가입 후 이동 페이지</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $r['join_after_url_mobile'];?>" name="join_after_url_mobile" />
				<p class="rt_green">도메인을 제외한 절대 경로를 입력해 주세요. Ex) /main/index.php</p>
			</td>
		</tr>
		<tr>
			<th><p>가입 시 회원그룹</p></th>
			<td>
				<select class="rt_input_txt required" name="join_group" msg="기본 회원그룹을 설정해 주세요">
					<option value="">기본 회원그룹을 선택해 주세요</option>
					<?php for ($m = 0; $m < count($grp); $m++) { ?>
					<option value="<?php echo $grp[$m]['grp_seq'];?>" <?php echo ($grp[$m]['grp_seq'] == $r['join_group'])?"selected":"";?>><?php echo $grp[$m]['grp_name'];?></option>
					<?php } ?>
				</select>
			</td>
			<th><p>가입 시 SMS 인증</p></th>
			<td>
				<p>
					<label><input name="auth_sms_en" value="y" type="radio" <?php echo $auth_sms_en_y;?>> 사용합니다</label>
					<label><input name="auth_sms_en" value="n" type="radio" <?php echo $auth_sms_en_n;?>> 사용하지 않습니다</label>
				</p>
			</td>
		</tr>
		<tr>
			<th><p>가입 동의서 1번 타이틀</p></th>
			<td><input type="text" class="rt_input_txt" value="<?php echo $r['agreement1_title'];?>" name="agreement1_title" /></td>
			<th><p>가입 동의서 2번 타이틀</p></th>
			<td><input type="text" class="rt_input_txt" value="<?php echo $r['agreement2_title'];?>" name="agreement2_title" /></td>
		</tr>
		<tr>
			<th><p>가입 동의서 1번 내용</p></th>
			<td><textarea name="agreement1_txt" style="height:200px;"><?php echo $r['agreement1_txt'];?></textarea></td>
			<th><p>가입 동의서 2번 내용</p></th>
			<td><textarea name="agreement2_txt" style="height:200px;"><?php echo $r['agreement2_txt'];?></textarea></td>
		</tr>
		<tr>
			<th><p>가입제한 ID<br />(공백없이 쉼표(,)로 구분하여 입력)</p></th>
			<td colspan="3"><textarea class="agreement2_txt" name="refusal_id" style="height:100px;"><?php echo $r['refusal_id'];?></textarea></td>
		</tr>
	</tbody>
</table>

<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>로그인/계정찾기</h1>
</div>
<table class="rt_data_table">
	<caption>로그인/계정찾기</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>로그인 후 이동 페이지</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $r['login_after_url'];?>" name="login_after_url" />
				<p class="rt_green">설정되면 로그인 후 강제로 이동합니다. Ex) /main/index.php</p>
			</td>
			<th><p>(모바일) 로그인 후 이동 페이지</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $r['login_after_url_mobile'];?>" name="login_after_url_mobile" />
				<p class="rt_green">설정되면 로그인 후 강제로 이동합니다. Ex) /main/index.php</p>
			</td>
		</tr>
		<tr>
			<th><p>로그아웃 후 이동 페이지</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $r['logout_after_url'];?>" name="logout_after_url" />
				<p class="rt_green">설정되면 로그아웃 후 강제로 이동합니다. Ex) /main/index.php</p>
			</td>
			<th><p>(모바일) 로그아웃 후 이동 페이지</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $r['logout_after_url_mobile'];?>" name="logout_after_url_mobile" />
				<p class="rt_green">설정되면 로그아웃 후 강제로 이동합니다. Ex) /main/index.php</p>
			</td>
		</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar">
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">설정 변경</a>
</div>

<script src="<?=$_def['path_assets']?>/js/rtmember.admin.join.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>