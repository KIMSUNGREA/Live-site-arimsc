<?php
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//분류 정보 세팅
$cls_ct->dbLoadCategory();

//페이지의 분류 정보
$_c = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['code']."'");

//페이지 데이터 레코드
$_r = $dbo->fetch("SELECT * FROM RT_PAGE WHERE pcode='".$_c['code']."'");

//라디오형 데이터 세팅
${"meta_common_is_".$_r['meta_common_is']} = "checked='checked'";

//display
$tr_meta_data = ($_r['meta_common_is'] == "n")?"":"none";
?>

<h1 class="tit">SEO(META)</h1>
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>META 설정</h1>
</div>
<form name="meta_form" action="<?php echo RTW_ADM;?>/page/sitemap/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="meta">
<input type="hidden" name="code" value="<?php echo $env->_post['code'];?>">
<table class="rt_data_table">
	<caption>개발자 정의 데이터</caption>
	<colgroup>
		<col style="width:20%"/>
		<col style="width:80%"/>
	</colgroup>
	<tbody>
		<?php if ($_r['forward_is']=="y") {?>
		<tr>
			<th colspan="2"><b style="color:brown;">포워딩 중인 페이지입니다. 데이터 설정은 가능하나 실제 페이지가 노출되진 않습니다.</b></th>
		</tr>
		<?php } ?>
		<tr>
			<th><p>페이지 명</p></th>
			<td><b><?php echo $_c['label'];?></b></td>
		</tr>
		<tr>
			<th><p>META 설정</p></th>
			<td>
				<label><input name="meta_common_is" value="y" onclick="toggle_data('meta_common_is',this)" type="radio" <?php echo $meta_common_is_y;?>><span> 공통 데이터</span> </label>
				<label><input name="meta_common_is" value="n" onclick="toggle_data('meta_common_is',this)" type="radio" <?php echo $meta_common_is_n;?>><span> 개별 설정</span> </label>
			</td>
		</tr>
		<tr class="tr-meta-data" style="display:<?php echo $tr_meta_data;?>;">
			<th><p>페이지 제목</p></th>
			<td><input type="text" name="meta_title" value="<?php echo $_r['meta_title'];?>" /></td>
		</tr>
		<tr class="tr-meta-data" style="display:<?php echo $tr_meta_data;?>;">
			<th><p>페이지 요약<br />(60자이내)</p></th>
			<td ><textarea name="meta_desc"><?php echo $_r['meta_desc'];?></textarea></td>
		</tr>
		<tr class="tr-meta-data" style="display:<?php echo $tr_meta_data;?>;">
			<th><p>페이지 키워드<br />(공백없이 쉼표로 구분)</p></th>
			<td><textarea name="meta_keyword"><?php echo $_r['meta_keyword'];?></textarea></td>
		</tr>
		<tr class="tr-meta-data" style="display:<?php echo $tr_meta_data;?>;">
			<th><p>대표 이미지 URL<br />(도메인 제외)</p></th>
			<td><input type="text" name="meta_main_img" value="<?php echo $_r['meta_main_img'];?>" /></td>
		</tr>
	</tbody>
</table>
</form>
<div class="rt_button_wrap rt_tar mb20">
	<a href="javascript:page_form_submit('meta_form','');" class="rt_bg_blue">정보 수정</a>
</div>

<div class="rt_bot_box rt_dash_top">
	<h1>이용안내</h1>
	<p><em>-</em><span class="rt_mint">기본 설정은 공통 데이터 설정</span>입니다. 공통 데이터의 설정은 좌측 메뉴의 <span class="rt_mint">공통 환경 설정</span> 메뉴에서 할 수 있습니다.</p>
	<p><em>-</em><span class="rt_mint">개별 설정으로 SEO를 세팅</span>하면 <span class="rt_yellow">페이지마다 다른 데이터</span>를 설정할 수 있습니다.</p>
</div>

<br />
