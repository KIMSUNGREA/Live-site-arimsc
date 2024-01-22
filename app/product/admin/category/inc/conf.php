<?php
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//제품 모듈 정보
$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='product'");

//분류 정보
$_c = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['code']."'");

//분류 환경 정보
$_r = $dbo->fetch("SELECT * FROM RT_PRODUCT_CATE_CONF WHERE code='".$env->_post['code']."'");

//라디오형 데이터 세팅
${"use_is_".$_r['use_is']} = "checked='checked'";
${"type_en_".$_r['type_en']} = "checked='checked'";

//display
if ($_r['use_is'] == "y") {
	if ($_r['type_en'] == "none") {
		$tr_type_img = "none";
		$tr_type_html = "none";
	} else if ($_r['type_en'] == "img") {
		$tr_type_img = "";
		$tr_type_html = "none";
	} else if ($_r['type_en'] == "html") {
		$tr_type_img = "none";
		$tr_type_html = "";
	}
} else {
	$tr_type = "none";
	$tr_type_img = "none";
	$tr_type_html = "none";
}

//레이아웃 파일 리스트
$tpl_dir = RT_DOC_ROOT.$_app['app_path']."/template";
$tpl_files = rt_template_list($tpl_dir);
?>

<h1 class="tit"><?php echo $_c['label'];?> | 분류 정보 수정</h1>
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>분류 정보</h1>
</div>
<form name="category_modify_form" action="<?php echo $_app['app_path'];?>/admin/category/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="category_modify">
<input type="hidden" name="code" value="<?php echo $env->_post['code'];?>">
<table class="rt_data_table">
	<caption>분류 정보 수정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>분류 코드</p></th>
			<td>
				<p><?php echo $_c['code'];?></p>
			</td>
		</tr>
		<tr>
			<th><p>분류 명</p></th>
			<td>
				<input type="text" name="label" value="<?php echo $_c['label'];?>" />
			</td>
		</tr>
	</tbody>
</table>
</form>
<div class="rt_button_wrap rt_tar">
	<a href="javascript:category_delete('<?php echo $_c['code'];?>');" class="rt_bg_red">분류 삭제</a>
	<a href="javascript:page_form_submit('category_modify_form','');" class="rt_bg_blue">정보 수정</a>
</div>

<form name="dataform" action="<?php echo $_app['app_path'];?>/admin/category/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
<input type="hidden" name="mode" value="category_conf">
<input type="hidden" name="code" value="<?php echo $env->_post['code'];?>">
<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>환경 설정</h1>
</div>
<table class="rt_data_table">
	<caption>환경 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>분류 사용 여부</p></th>
			<td>
				<p class="mr5"><label><input name="use_is" value="y" onclick="use_is_data('y')" type="radio" <?php echo $use_is_y;?>>사용함</label></p>
				<p class="mr5"><label><input name="use_is" value="n" onclick="use_is_data('n')" type="radio" <?php echo $use_is_n;?>>사용하지 않음</label></p>
			</td>
		</tr>
		<tr class="tr_type" style="display:<?php echo $tr_type;?>;">
			<th><p>분류 구성(용도)</p></th>
			<td>
				<p class="mr5"><label><input name="type_en" value="none" onclick="toggle_data('type_en','none')" type="radio" <?php echo $type_en_none;?>>제품 출력</label></p>
				<p class="mr5"><label><input name="type_en" value="img" onclick="toggle_data('type_en','img')" type="radio" <?php echo $type_en_img;?>>콘텐츠 이미지</label></p>
				<p class="mr5"><label><input name="type_en" value="html" onclick="toggle_data('type_en','html')" type="radio" <?php echo $type_en_html;?>>페이지 HTML</label></p>
			</td>
		</tr>
		<tr class="tr_type_img" style="display:<?php echo $tr_type_img;?>;">
			<th><p>콘텐츠 이미지</p></th>
			<td>
				<input type="file" class="rt_input_txt rt_w250" name="cont_img" />
				<?php if ($_r['cont_img_new']) {?>
				<p class="rt_fln">
					<label><input type="checkbox" name="cont_img_del_is" id="cont_img_del_is" value="y" /><span class="rt_txt rt_green"> 체크 시 첨부파일 삭제</span></label><br />
					<p class="mb10"><img src="<?php echo $_app['app_path'];?>/files/<?php echo $_r['cont_img_new'];?>" style="max-width:550px;" /></p>
				</p>
				<?php } ?>
			</td>
		</tr>
		<tr class="tr_type_html" style="display:<?php echo $tr_type_html;?>;">
			<th><p>페이지 HTML</p></th>
			<td>
				<textarea name="cont_html" style="height:300px;"><?php echo rt_dbstr_decode($_r['cont_html'],"html");?></textarea>
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
	<p><em>-</em><span class="rt_mint">하위 분류가 있는 분류</span>는 <span class="rt_red">삭제</span>할 수 없습니다.</p>
	<p><em>-</em>제품 출력의 <span class="rt_mint">레이아웃 스킨</span>은 <span class="rt_mint">환경설정에서 설정</span>할 수 있습니다.</p>
</div>

<br />