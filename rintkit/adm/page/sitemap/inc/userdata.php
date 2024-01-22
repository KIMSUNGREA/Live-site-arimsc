<?php
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//분류 정보 세팅
$cls_ct->dbLoadCategory();

//페이지의 분류 정보
$_c = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['code']."'");

//페이지 데이터 레코드
$_r = $dbo->fetch("SELECT * FROM RT_PAGE WHERE pcode='".$_c['code']."'");
?>

<h1 class="tit">개발자 정의 데이터</h1>
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>개발자 정의 데이터</h1>
</div>
<form name="userdata_form" action="<?php echo RTW_ADM;?>/page/sitemap/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="userdata">
<input type="hidden" name="code" value="<?php echo $env->_post['code'];?>">
<table class="rt_data_table">
	<caption>개발자 정의 데이터</caption>
	<colgroup>
		<col style="width:20%"/>
		<col style="width:80%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>데이터1</p></th>
			<td><input type="text" name="user_data1" value="<?php echo $_r['user_data1'];?>" class="rt-input" /></td>
		</tr>
		<tr>
			<th><p>데이터2</p></th>
			<td><input type="text" name="user_data2" value="<?php echo $_r['user_data2'];?>" class="rt-input" /></td>
		</tr>
		<tr>
			<th><p>데이터3</p></th>
			<td><input type="text" name="user_data3" value="<?php echo $_r['user_data3'];?>" class="rt-input" /></td>
		</tr>
		<tr>
			<th><p>데이터4</p></th>
			<td><input type="text" name="user_data4" value="<?php echo $_r['user_data4'];?>" class="rt-input" /></td>
		</tr>
		<tr>
			<th><p>데이터5</p></th>
			<td><input type="text" name="user_data5" value="<?php echo $_r['user_data5'];?>" class="rt-input" /></td>
		</tr>
	</tbody>
</table>
</form>
<div class="rt_button_wrap rt_tar mb20">
	<a href="javascript:page_form_submit('userdata_form','');" class="rt_bg_blue">정보 수정</a>
</div>
<div class="rt_bot_box rt_dash_top">
	<h1>이용안내</h1>
	<p><em>-</em>이곳에 설정된 데이터는 <span class="rt_mint">연동 소스를 사용자페이지에 삽입</span>하여 연동할 수 있습니다. </p>
</div>

<br />