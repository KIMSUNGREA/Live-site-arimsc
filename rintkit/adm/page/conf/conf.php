<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="dataform" action="<?php echo $__sc;?>/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
<input type="hidden" name="mode" value="modify">
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>메타(META) 데이터 설정</h1>
</div>
<table class="rt_field_table mb10">
	<caption>메타(META) 데이터 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tr>
		<th><p>페이지 제목</p></th>
		<td>
			<input type="text" name="meta_title" value="<?php echo $_r['meta_title']?>" class="rt_input_txt" />
		</td>
	</tr>
	<tr>
		<th><p>페이지 요약<br />(60자이내)</p></th>
		<td>
			<textarea name="meta_desc"><?php echo $_r['meta_desc']?></textarea>
		</td>
	</tr>
	<tr>
		<th><p>페이지 키워드<br />(공백없이 쉼표로 구분)</p></th>
		<td>
			<textarea name="meta_keyword"><?php echo $_r['meta_keyword']?></textarea>
		</td>
	</tr>
	<tr>
		<th><p>대표 이미지 URL<br />(도메인 제외)</p></th>
		<td>
			<input type="text" name="meta_main_img" value="<?php echo $_r['meta_main_img']?>" class="rt_input_txt" />
		</td>
	</tr>
</table>
<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>네이버 웹사이트도구 - 사이트 인증</h1>
</div>
<table class="rt_field_table mb10">
	<caption>네이버 웹사이트도구 - 사이트 인증</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tr>
		<th><p>인증 태그</p></th>
		<td>
			<input type="text" name="meta_naver" value="<?php echo $_r['meta_naver']?>" class="rt_input_txt" />
		</td>
	</tr>
</table>
<div class="rt_s_tit clearfix">
	<p>03<span></span></p>
	<h1>파비콘 설정</h1>
</div>
<table class="rt_field_table mb10">
	<caption>파비콘 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tr>
		<th><p>파비콘 URL</p></th>
		<td>
			<input type="file" name="favicon" value="" class="rt_input_txt rt_w250" />
			<?php if (!$_r['shortcut_icon']) { ?>
			<p class="rt_green">※ 등록된 파비콘이 없으면 소스는 출력되지 않습니다.</p>
			<?php } else { ?>
			<img src="<?php echo $_app['app_path'];?>//upload/<?php echo $_r['shortcut_icon'];?>" class="rt_favicon"/>
			<?php } ?>

			<?php if ($_r['shortcut_icon']) { ?>
			<span class="rt_button_wrap"><a href="javascript:favicon_delete();" class="rt_btn_red btn_in">파비콘 삭제</a></span>
			<?php } ?>
		</td>
	</tr>
</table>
<div class="rt_s_tit clearfix">
	<p>04<span></span></p>
	<h1>모바일 설치 디렉토리</h1>
</div>
<table class="rt_field_table mb10">
	<caption>모바일 설치 디렉토리</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tr>
		<th><p>경로 입력<br />(도메인 제외)</p></th>
		<td>
			<input type="text" name="mobile_path" value="<?php echo $_r['mobile_path']?>" class="rt_input_txt" />
			<p class="rt_green">※ 디렉토리 끝에 슬래시(/)는 입력하지 않습니다.</p>
		</td>
	</tr>
</table>
</form>

<div class="rt_button_wrap rt_tar mb20">
	<a href="#;" id="btn-submit" class="rt_btn_blue">정보 변경</a>
</div>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p class="rt_yellow"><em>-</em>인덱스(INDEX) 페이지는 공통 설정이 적용됩니다.</p>
	<p><em>-</em>페이지 제목 : META의 <span class="rt_mint">TITLE</span> 데이터를 설정합니다.</p>
	<p><em>-</em>페이지 요약 : META의 <span class="rt_mint">DESCRIPTION </span>데이터를 설정합니다.</p>
	<p><em>-</em>페이지 키워드 : META의 <span class="rt_mint">KEYWORD</span> 데이터를 설정합니다.</p>
	<p><em>-</em>대표 이미지 URL : 페이지를 대표하는 이미지 URL을 설정합니다.(SNS 링크 등록 시 미리보기 이미지 등에서 활용됩니다.)</p>
	<p><em>-</em>인증 태그 : <span class="rt_mint">네이버 웹마스터 도구</span>에 최초 등록 시<span class="rt_mint"> 사이트인증을 위해 제공되는 메타태그</span>를 입력해 주세요.</p>
</div>

<script src="assets/js/page.conf.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>