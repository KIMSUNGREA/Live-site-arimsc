<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//분류 정보 세팅
$cls_ct->dbLoadCategory();

//페이지의 분류 정보
$_c = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['code']."'");
?>

<h1 class="tit">하위 페이지 추가</h1>
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>페이지 정보</h1>
</div>
<table class="rt_data_table">
	<caption>페이지 정보</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>현재 페이지</p></th>
			<td>
				<p><?php echo $_c['label'];?> (<?php echo $_c['code'];?>)</p>
			</td>
		</tr>
	</tbody>
</table>
</form>

<form name="page_insert_form" action="<?php echo RTW_ADM;?>/page/sitemap/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="page_insert">
<input type="hidden" name="parent" value="<?php echo $env->_post['code'];?>">
<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>하위 페이지 추가</h1>
</div>
<table class="rt_data_table">
	<caption>하위 페이지 추가</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>페이지 코드</p></th>
			<td>
				<input type="text" name="new_code" value="" class="required" msg="페이지코드를 입력해 주세요">
				<p class="rt_green">* 공백없이 영문과 숫자로만 사용해 주세요.</p>
			</td>
		</tr>
		<tr>
			<th><p>페이지 명</p></th>
			<td>
				<input type="text" name="label" value="" class="required" msg="페이지명을 입력해 주세요">
			</td>
		</tr>
	</tbody>
</table>
</form>
<div class="rt_button_wrap rt_tar">
	<a href="javascript:page_form_submit('page_insert_form','required');" class="rt_bg_orange">새 페이지 추가</a>
</div>