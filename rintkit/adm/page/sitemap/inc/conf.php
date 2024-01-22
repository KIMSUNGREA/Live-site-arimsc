<?php
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//분류 정보 세팅
$cls_ct->dbLoadCategory();

//페이지의 분류 정보
$_c = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['code']."'");

//페이지 정보
$_p = $dbo->fetch("SELECT * FROM RT_PAGE WHERE pcode='".$_c['code']."'");

//라디오형 데이터 세팅
${"use_is_".$_p['use_is']} = "checked='checked'";
${"mobile_is_".$_p['mobile_is']} = "checked='checked'";
${"page_setting_en_".$_p['page_setting_en']} = "checked='checked'";
${"forward_is_".$_p['forward_is']} = "checked='checked'";
${"forward_type_en_".$_p['forward_type_en']} = "checked='checked'";

//display
if ($_p['page_setting_en'] == "custom") {
	$tr_url_custom = "";
	$tr_url_auto = "none";
} else {
	$tr_url_custom = "none";
	$tr_url_auto = "";
}

if ($_p['forward_is'] == "n") {
	$tr_forward_en = "none";
	$tr_forward_url = "none";
	$tr_forward_page = "none";
} else {
	$tr_forward_en = "";
	if ($_p['forward_type_en'] == "page") {
		$tr_forward_page = "";
		$tr_forward_url = "none";
	} else {
		$tr_forward_page = "none";
		$tr_forward_url = "";
	}
}
?>

<h1 class="tit">페이지 정보 수정</h1>
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>페이지 정보</h1>
</div>
<form name="page_modify_form" action="<?php echo RTW_ADM;?>/page/sitemap/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="page_modify">
<input type="hidden" name="code" value="<?php echo $env->_post['code'];?>">
<table class="rt_data_table">
	<caption>페이지 정보 수정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>페이지 코드</p></th>
			<td>
				<p><?php echo $_c['code'];?></p>
			</td>
		</tr>
		<tr>
			<th><p>페이지 명</p></th>
			<td>
				<input type="text" name="label" value="<?php echo $_c['label'];?>" />
			</td>
		</tr>
	</tbody>
</table>
</form>
<div class="rt_button_wrap rt_tar">
	<a href="javascript:page_delete('<?php echo $_c['code'];?>');" class="rt_bg_red">페이지 삭제</a>
	<a href="javascript:page_form_submit('page_modify_form','');" class="rt_bg_blue">정보 수정</a>
</div>

<form name="dataform" action="<?php echo RTW_ADM;?>/page/sitemap/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="page">
<input type="hidden" name="code" value="<?php echo $env->_post['code'];?>">
<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>페이지 정보</h1>
</div>
<table class="rt_data_table">
	<caption>페이지 정보</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>페이지 명</p></th>
			<td>
				<p><?php echo $_c['label'];?></p>
			</td>
			<th><p>활성화</p></th>
			<td>
				<p class="mr5"><label><input name="use_is" value="y" type="radio" <?php echo $use_is_y;?>>활성화</label></p>
				<p class="mr5"><label><input name="use_is" value="n" type="radio" <?php echo $use_is_n;?>>비활성화</label></p>
			</td>
		</tr>
		<tr>
			<th><p>페이지 연결</p></th>
			<td>
				<p class="mr5"><label><input name="page_setting_en" onclick="toggle_data('page_setting_en',this)" value="custom" type="radio" <?php echo $page_setting_en_custom;?>>직접제작</label></p>
				<p class="mr5"><label><input name="page_setting_en" onclick="toggle_data('page_setting_en',this)" value="auto" type="radio" <?php echo $page_setting_en_auto;?>>가상페이지</label></p>
			</td>
			<th><p>모바일 페이지</p></th>
			<td>
				<p class="mr5"><label><input name="mobile_is" value="y" type="radio" <?php echo $mobile_is_y;?>>사용함</label></p>
				<p class="mr5"><label><input name="mobile_is" value="n" type="radio" <?php echo $mobile_is_n;?>>사용안함</label></p>
			</td>
		</tr>
		<tr class="tr-url-custom" style="display:<?php echo $tr_url_custom;?>;">
			<th><p>페이지 URL<br />(도메인 제외)</p></th>
			<td colspan="3">
				<input type="text" name="page_url" value="<?php echo $_p['page_url'];?>">
			</td>
		</tr>
		<tr class="tr-url-custom" style="display:<?php echo $tr_url_custom;?>;">
			<th><p>모바일 URL<br />(도메인 제외)</p></th>
			<td colspan="3">
				<input type="text" name="page_url_m" value="<?php echo $_p['page_url_m'];?>">
			</td>
		</tr>
		<tr class="tr-url-auto" style="display:<?php echo $tr_url_auto;?>;">
			<th><p>가상 URL</p></th>
			<td colspan="3">
				<?php echo $_app['app_path'];?>/?pcd=<?php echo $_p['pcode'];?>
			</td>
		</tr>
		<tr class="tr-url-auto" style="display:<?php echo $tr_url_auto;?>;">
			<th><p>가상 모바일 URL</p></th>
			<td colspan="3">
				<?php echo $_app['app_path'];?>/?pcd=<?php echo $_p['pcode'];?>&screen=mobile
			</td>
		</tr>
	</tbody>
</table>
<table class="rt_data_table">
	<caption>포워딩 설정 정보</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>포워딩 여부</p></th>
			<td>
				<p class="mr5"><label><input name="forward_is" onclick="toggle_data('forward_is',this)" value="n" type="radio" <?php echo $forward_is_n;?>>사용안함</label></p>
				<p class="mr5"><label><input name="forward_is" onclick="toggle_data('forward_is',this)" value="y" type="radio" <?php echo $forward_is_y;?>>사용함</label></p>
			</td>
		</tr>
		<tr class="tr-forward-en" style="display:<?php echo $tr_forward_en;?>;">
			<th><p>포워딩 설정</p></th>
			<td>
				<p class="mr5"><label><input name="forward_type_en" onclick="toggle_data('forward_type_en',this)" value="page" type="radio" <?php echo $forward_type_en_page;?>>페이지 선택</label></p>
				<p class="mr5"><label><input name="forward_type_en" onclick="toggle_data('forward_type_en',this)" value="custom" type="radio" <?php echo $forward_type_en_custom;?>>직접 입력</label></p>
			</td>
		</tr>
		<tr class="tr-forward-url" style="display:<?php echo $tr_forward_url;?>;">
			<th><p>포워딩 URL</p></th>
			<td colspan="3">
				<input type="text" name="forward_url" value="<?php echo $_p['forward_url'];?>" />
			</td>
		</tr>
		<tr class="tr-forward-page" style="display:<?php echo $tr_forward_page;?>;">
			<th><p>포워딩 페이지</p></th>
			<td>
				<select name="forward_page">
					<option value="">페이지를 선택해 주세요</option>
					<?php
					$cls_ct->setCateList("0");
					for ($m = 0; $m < count($cls_ct->listdata['code']); $m++) {
						$addstr = "";
						if ($cls_ct->listdata['parent'][$m] != '0') {
							for ($i = 1; $i < $cls_ct->listdata['depth'][$m]; $i++) {$addstr.= " ─ ";}
						}
						?>
						<option value="<?php echo $cls_ct->listdata['code'][$m];?>" <?php echo ($cls_ct->listdata['code'][$m] == $_p['forward_page'])?"selected":"";?>><?php echo $addstr.$cls_ct->listdata['label'][$m];?></option>
						<?
					} ?>
				</select>
			</td>
		</tr>
	</tbody>
</table>
</form>
<div class="rt_button_wrap rt_tar mb20">
	<a href="javascript:page_form_submit('dataform','');" class="rt_bg_blue">정보 수정</a>
</div>

<div class="rt_bot_box rt_dash_top">
	<h1>이용안내</h1>
	<p><em>-</em><span class="rt_mint">하위 페이지가 있는 페이지</span>는 <span class="rt_red">삭제</span>할 수 없습니다.</p>
	<p><em>-</em><span class="rt_mint">직접 제작</span>된 페이지를 연결하는 경우 페이지의 경로를 정확히 입력해 주세요. </p>
</div>

<br />