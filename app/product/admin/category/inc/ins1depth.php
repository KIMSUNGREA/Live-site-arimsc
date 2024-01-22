<?php
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.');}

//제품 모듈 정보
$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='product'");
?>

<form name="ins_1depth_form" action="<?php echo $_app['app_path'];?>/admin/category/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="category_ins_1depth">
<input type="hidden" name="new_code" value="<?php echo time();?>">
<h1 class="tit">최상위 분류 추가</h1>
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>분류 정보</h1>
</div>
<table class="rt_data_table">
	<caption>최상위 분류 정보</caption>
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
	<a href="javascript:page_form_submit('ins_1depth_form','required');" class="rt_bg_blue">최상위 분류 추가</a>
</div>