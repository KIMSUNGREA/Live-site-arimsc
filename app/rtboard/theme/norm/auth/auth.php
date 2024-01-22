<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php
if ($env->_get['bcode']) {
	require_once RT_DOC_ROOT.$_def['path_app']."/theme/".$_bdinfo['theme']."/inc.common.menu.php";
}
?>

<form name="dataform" action="<?php echo $_def['path_app']."/".$__sd;?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="<?php echo $_def['mode'];?>">
<input type="hidden" name="bcode" value="<?php echo $env->_get['bcode'];?>">
<table class="rt_data_table">
	<caption>이용 권한 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>목록 권한</p></th>
			<td>
				<p><label><input name="auth_list[]" id="auth_list_0" type="checkbox" value="0" <?php echo ($auth_list_arr[0]=="0")?"checked='checked'":""?>>비회원</label></p>
				<?php
				for ($m = 0; $m < count($mgrp); $m++) {
					$checked = "";
					if (count($auth_list_arr) > 0) {
						if (in_array($mgrp[$m]['grp_seq'], $auth_list_arr)) {
							$checked = "checked='checked'";
						}
					}
					?>
					<p><label><input name="auth_list[]" id="auth_list_<?php echo $mgrp[$m]['grp_seq'];?>" type="checkbox" value="<?php echo $mgrp[$m]['grp_seq'];?>" <?php echo $checked?>> <?php echo $mgrp[$m]['grp_name'];?></label></p>
					<?
				}?>
			</td>
		</tr>
		<tr>
			<th><p>보기 권한</p></th>
			<td>
				<p><label><input name="auth_read[]" id="auth_read_0" type="checkbox" value="0" <?php echo ($auth_read_arr[0]=="0")?"checked='checked'":""?>>비회원</label></p>
				<?php
				for ($m = 0; $m < count($mgrp); $m++) {
					$checked = "";
					if (count($auth_read_arr) > 0) {
						if (in_array($mgrp[$m]['grp_seq'], $auth_read_arr)) {
							$checked = "checked='checked'";
						}
					}
					?>
					<p><label><input name="auth_read[]" id="auth_read_<?php echo $mgrp[$m]['grp_seq'];?>" type="checkbox" value="<?php echo $mgrp[$m]['grp_seq'];?>" <?php echo $checked?>> <?php echo $mgrp[$m]['grp_name'];?></label></p>
					<?
				}?>
			</td>
		</tr>
		<tr>
			<th>쓰기 권한</th>
			<td>
				<p><label><input name="auth_write[]" id="auth_write_0" type="checkbox" value="0" <?php echo ($auth_write_arr[0]=="0")?"checked='checked'":""?>>비회원</label></p>
				<?php
				for ($m = 0; $m < count($mgrp); $m++) {
					$checked = "";
					if (count($auth_write_arr) > 0) {
						if (in_array($mgrp[$m]['grp_seq'], $auth_write_arr)) {
							$checked = "checked='checked'";
						}
					}
					?>
					<p><label><input name="auth_write[]" id="auth_write_<?php echo $mgrp[$m]['grp_seq'];?>" type="checkbox" value="<?php echo $mgrp[$m]['grp_seq'];?>" <?php echo $checked?>> <?php echo $mgrp[$m]['grp_name'];?></label></p>
					<?
				}?>
			</td>
		</tr>
		<tr>
			<th>답글 권한</th>
			<td>
				<p><label><input name="auth_reply[]" id="auth_reply_0" type="checkbox" value="0" <?php echo ($auth_reply_arr[0]=="0")?"checked='checked'":""?>>비회원</label></p>
				<?php
				for ($m = 0; $m < count($mgrp); $m++) {
					$checked = "";
					if (count($auth_reply_arr) > 0) {
						if (in_array($mgrp[$m]['grp_seq'], $auth_reply_arr)) {
							$checked = "checked='checked'";
						}
					}
					?>
					<p><label><input name="auth_reply[]" id="auth_reply_<?php echo $mgrp[$m]['grp_seq'];?>" type="checkbox" value="<?php echo $mgrp[$m]['grp_seq'];?>" <?php echo $checked?>> <?php echo $mgrp[$m]['grp_name'];?></label></p>
					<?
				}?>
			</td>
		</tr>
		<tr>
			<th><p>댓글 권한</p></th>
			<td>
				<p><label><input name="auth_comment[]" id="auth_comment_0" type="checkbox" value="0" <?php echo ($auth_comment_arr[0]=="0")?"checked='checked'":""?>>비회원</label></p>
				<?php
				for ($m = 0; $m < count($mgrp); $m++) {
					$checked = "";
					if (count($auth_comment_arr) > 0) {
						if (in_array($mgrp[$m]['grp_seq'], $auth_comment_arr)) {
							$checked = "checked='checked'";
						}
					}
					?>
					<p><label><input name="auth_comment[]" id="auth_comment_<?php echo $mgrp[$m]['grp_seq'];?>" type="checkbox" value="<?php echo $mgrp[$m]['grp_seq'];?>" <?php echo $checked?>> <?php echo $mgrp[$m]['grp_name'];?></label></p>
					<?
				}?>
			</td>
		</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar mb25">
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">설정 변경</a>
</div>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em>그룹 권한에 체크를 하면 해당 기능에 대해 적절한 이용권한을 제공합니다.</p>
	<p><em>-</em>회원 그룹은 <span class="rt_mint">회원관리 &gt; 회원그룹관리</span> 메뉴에서 설정할 수 있습니다.</p>
</div>


<script src="<?php echo $_def['path_section'];?>/js/rtboard.theme.norm.auth.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>