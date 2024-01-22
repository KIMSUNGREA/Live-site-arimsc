<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//분류 정보 세팅
$cls_ct->dbLoadCategory();

//분류의 분류 정보
$_c = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['code']."'");

//제품 모듈 정보
$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='product'");
?>

<h1 class="tit"><?php echo $_c['label'];?> | 하위 분류 추가</h1>

<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>분류 정보</h1>
</div>
<table class="rt_data_table">
	<caption>분류 정보</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>현재 분류</p></th>
			<td>
				<p><?php echo $_c['label'];?> (<?php echo $_c['code'];?>)</p>
			</td>
		</tr>
	</tbody>
</table>
</form>

<form name="page_insert_form" action="<?php echo $_app['app_path'];?>/admin/category/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="category_insert">
<input type="hidden" name="parent" value="<?php echo $env->_post['code'];?>">
<input type="hidden" name="new_code" value="<?php echo time();?>">
<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>하위 분류 추가</h1>
</div>
<table class="rt_data_table">
	<caption>하위 분류 추가</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>분류 명</p></th>
			<td>
				<input type="text" name="label" value="" class="required" msg="분류명을 입력해 주세요">
			</td>
		</tr>
	</tbody>
</table>
</form>
<div class="rt_button_wrap rt_tar">
	<a href="javascript:page_form_submit('page_insert_form','required');" class="rt_bg_orange">새 분류 추가</a>
</div>