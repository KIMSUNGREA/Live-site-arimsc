<?php
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//제품 모듈 정보
$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='product'");

//분류 정보
$_c = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['code']."'");

//분류 환경 정보
$_r = $dbo->fetch("SELECT * FROM RT_PRODUCT_CATE_CONF WHERE code='".$env->_post['code']."'");
?>
<h1 class="tit"><?php echo $_c['label'];?> | 분류 대표이미지 설정</h1>

<form name="dataform" action="<?php echo $_app['app_path'];?>/admin/category/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
<input type="hidden" name="mode" value="cateimg">
<input type="hidden" name="code" value="<?php echo $env->_post['code'];?>">
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>분류 대표 이미지</h1>
</div>
<table class="rt_data_table">
	<caption>분류 대표 이미지</caption>
	<colgroup>
		<col style="width:20%"/>
		<col style="width:80%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>분류 이미지</p></th>
			<td>
				<input type="file" class="rt_input_txt rt_w250" value="" name="cate_img" />
				<?php if ($_r['cate_img_new']) {?>
				<p class="rt_fln">
					<label><input type="checkbox" name="cate_img_del_is" id="cate_img_del_is" value="y" /><span class="rt_txt rt_green"> 체크 시 첨부파일 삭제</span></label>
					<p class="mb10"><img src="<?php echo $_app['app_path'];?>/files/<?php echo $_r['cate_img_new'];?>" style="max-width:550px;" /></p>
				</p>
				<?php } ?>
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
	<p><em>-</em>분류 대표 이미지는 분류 별 대표 고정 이미지를 설정하는 기능입니다.</p>
</div>

<br />
