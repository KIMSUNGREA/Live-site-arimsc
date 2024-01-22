<?php
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//분류 정보 세팅
$cls_ct->dbLoadCategory();

//페이지의 분류 정보
$_c = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['code']."'");

//현재 분류에 소속된 모든 페이지
$_l = $dbo->fetch_list("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND parent='".$_c['parent']."' ORDER BY sort ASC");

?>

<h1 class="tit">페이지 이동</h1>
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>페이지 이동</h1>
</div>
<form name="page_move_form" action="<?php echo RTW_ADM;?>/page/sitemap/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="page_move">
<input type="hidden" name="code" value="<?php echo $env->_post['code'];?>">
<table class="rt_data_table">
	<caption>페이지 이동</caption>
	<colgroup>
		<col style="width:20%"/>
		<col style="width:80%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>선택 페이지 코드</p></th>
			<td>
				<p><?php echo $_c['label'];?> (<?php echo $_c['code'];?>)</p>
			</td>
		</tr>
		<tr>
			<th><p>이동할 페이지 위치</p></th>
			<td>
				<select name="chg_sort">
					<option value="">맞바꿀 페이지를 선택해 주세요</option>
				<?php
				for ($m = 0; $m < count($_l); $m++) {
					if ($_l[$m]['code'] == $env->_post['code']) {
						?><option value="<?php echo $_l[$m]['sort'];?>"> ▶ <?php echo $_l[$m]['label'];?></option><?php 
					} else {
						?><option value="<?php echo $_l[$m]['sort'];?>"><?php echo $_l[$m]['label'];?></option><?php 
					}
				} ?>
				</select>
			</td>
		</tr>
	</tbody>
</table>
</form>
<div class="rt_button_wrap rt_tar mb20">
	<a href="javascript:page_form_submit('page_move_form','');" class="rt_bg_orange">페이지 위치 변경</a>
</div>

<div class="rt_bot_box rt_dash_top">
	<h1>이용안내</h1>
	<p><em>-</em>페이지 이동은 <span class="rt_mint">같은 분류(깊이)의 페이지</span>와 위치를 맞바꾸는 기능입니다.</p>
</div>

<br />