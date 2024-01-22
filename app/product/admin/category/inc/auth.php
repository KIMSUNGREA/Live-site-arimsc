<?php
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//회원 그룹 정보
$mgrp = $dbo->fetch_list("SELECT * FROM RT_RTMEMBER_GROUP ORDER BY grp_ord ASC");

//제품 모듈 정보
$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='product'");

//분류 정보
$_c = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['code']."'");

//분류 환경 정보
$_r = $dbo->fetch("SELECT * FROM RT_PRODUCT_CATE_CONF WHERE code='".$env->_post['code']."'");

//라디오형 데이터 세팅
${"auth_en_".$_r['auth_en']} = "checked='checked'";

//이용권한설정
$auth_list_arr = unserialize(html_entity_decode($_r['auth_list']));
$auth_read_arr = unserialize(html_entity_decode($_r['auth_read']));

//display
if ($_r['auth_en'] == "common") {
	$tr_auth = "none";
} else if ($_r['auth_en'] == "each") {
	$tr_auth = "";
}
?>

<h1 class="tit"><?php echo $_c['label'];?> | 이용 권한 설정</h1>

<form name="dataform" action="<?php echo $_app['app_path'];?>/admin/category/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
<input type="hidden" name="mode" value="category_auth">
<input type="hidden" name="code" value="<?php echo $env->_post['code'];?>">
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>이용 권한 설정</h1>
</div>
<table class="rt_data_table">
	<caption>이용 권한 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>권한 설정</p></th>
			<td colspan="3">
				<p>
					<label><input type="radio" name="auth_en" value="common" onclick="toggle_data('auth_en','common')" <?php echo $auth_en_common;?>> 기본 권한 설정</label>
					<label><input type="radio" name="auth_en" value="each" onclick="toggle_data('auth_en','each')" <?php echo $auth_en_each;?>> 개별 권한 설정</label>
				</p>
			</td>
		</tr>
		<tr class="tr_auth" style="display:<?php echo $tr_auth;?>;">
			<th><p>목록 접근 권한</p></th>
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
		<tr class="tr_auth" style="display:<?php echo $tr_auth;?>;">
			<th><p>상세 접근 권한</p></th>
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
	</tbody>
</table>
</form>
<div class="rt_button_wrap rt_tar mb20">
	<a href="javascript:page_form_submit('dataform','');" class="rt_bg_blue">정보 수정</a>
</div>

<div class="rt_bot_box">
	<h1>이용안내</h1>
	<p><em>-</em><span class="rt_mint">기본 권한 설정</span>은 <span class="rt_mint">환경설정</span>에서 변경할 수 있습니다.</p>
</div>

<br />