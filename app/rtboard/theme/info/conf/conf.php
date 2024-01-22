<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php
if ($env->_get['bcode']) {
	require_once RT_DOC_ROOT.$_def['path_app']."/theme/".$_bdinfo['theme']."/inc.common.menu.php";
}
?>

<form name="dataform" action="<?php echo $_def['path_app']."/".$__sd?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="<?php echo $_def['mode'];?>">
<input type="hidden" name="bcode" value="<?php echo $env->_get['bcode'];?>">

<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>기본 환경 설정</h1>
</div>
<table class="rt_data_table">
	<caption>게시판 이용권한 설정</caption>
	<colgroup>
		<col style="width:15%" />
		<col style="width:35%" />
		<col style="width:15%" />
		<col style="width:35%" />
	</colgroup>
	<tbody>
	<tr>
		<th><p>글 분류 여부</p></th>
		<td colspan="3">
			<p>
				<label><input type="radio" name="category_is" value="y" <?php echo $category_is_y;?>> 노출함</label>
				<label><input type="radio" name="category_is" value="n" <?php echo $category_is_n;?>> 노출안함</label>
			</p>
		</td>
	</tr>
	<tr id="tr-category-data" <?php if($_r['category_is']=="n"){?>style="display:none;"<?}?>>
		<th><p>글 분류</p></th>
		<td colspan="3">
			<input type="text" class="rt_input_txt" value="<?php echo $_r['category_data'];?>" name="category_data" id="category_data" />
			<p class="rt_brown">글 분류를 공백없이 쉼표로 구분하여 입력해 주세요. ex) 구분1,구분2...</p>
		</td>
	</tr>
	<tr>
		<th><p>댓글 사용 여부</p></th>
		<td>
			<p>
				<label><input type="radio" name="comment_is" value="y" <?php echo $comment_is_y;?>> 사용함</label>
				<label><input type="radio" name="comment_is" value="n" <?php echo $comment_is_n;?>> 사용안함</label>
			</p>
		</td>
		<th><p>관리자 기본 작성자명</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w250" value="<?php echo $_r['default_name'];?>" name="default_name" />
		</td>
	</tr>
	<tr>
		<th><p>목록 제목 길이</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['subject_cut_length'];?>" name="subject_cut_length" />
			<p class="rt_brown rt_fln">출력할 제목길이를 입력해 주세요(기본 수치 50)</p>
		</td>
		<th><p>목록 제목 길이(모바일)</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['subject_cut_length_m'];?>" name="subject_cut_length_m" />
			<p class="rt_brown rt_fln">출력할 제목길이를 입력해 주세요(기본 수치 50)</p>
		</td>
	</tr>
	<tr>
		<th><p>업로드 파일 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['upload_cnt'];?>" name="upload_cnt" /> 개
			<p class="rt_brown rt_fln">0개로 설정하시면 노출되지 않습니다.</p>
		</td>
		<th><p>업로드 제한 용량(MB)</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['upload_size_limit'];?>" name="upload_size_limit" /> MB
			<p class="rt_brown rt_fln">등록페이지에서 한번에 전송되는 총합의 전송 제한 용량을 MB 단위로 입력해 주세요.</p>
		</td>
	</tr>
	<tr>
		<th><p>업로드 파일 기능</p></th>
		<td colspan="3">
			<label><input type="checkbox" name="upfile_cont_is" value="y" <?php echo $upfile_cont_is_y;?>> 업로드 파일이 이미지면 본문 상단에 고정 출력</label>
		</td>
	</tr>
	<tr>
		<th><p>새 글 기준(일)</p></th>
		<td colspan="3">
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['post_new_period'];?>" name="post_new_period" /> 일
			<p class="rt_brown rt_fln">새 글로 표시할 등록일 이후 기간을 일자로 입력해 주세요</p>
		</td>
	</tr>
	</tbody>
</table>

<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>게시물 출력 수</h1>
</div>
<table class="rt_data_table">
	<caption>기본 환경 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tbody>
	<tr>
		<th><p>PC 스킨 게시물 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['page_cnt'];?>" name="page_cnt" /> 개
		</td>
		<th><p>PC 스킨 페이지 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['block_cnt'];?>" name="block_cnt" /> 페이지
		</td>
	</tr>
	<tr>
		<th><p>모바일 스킨 게시물 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['page_cnt_mobile'];?>" name="page_cnt_mobile" /> 개
		</td>
		<th><p>모바일 스킨 페이지 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['block_cnt_mobile'];?>" name="block_cnt_mobile" /> 개
		</td>
	</tr>
	<tr>
		<th><p>관리자 모드 게시물 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['page_cnt_admin'];?>" name="page_cnt_admin" /> 개
		</td>
		<th><p>관리자 모드 페이지 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['block_cnt_admin'];?>" name="block_cnt_admin" /> 개
		</td>
	</tr>
	</tbody>
</table>

<div class="rt_s_tit clearfix">
	<p>03<span></span></p>
	<h1>갤러리형 테마(개발자용)</h1>
</div>
<table class="rt_data_table">
	<caption>기본 환경 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tbody>
	<tr>
		<th><p>갤러리 테마 사용</p></th>
		<td colspan="3">
			<p>
				<label><input type="radio" name="gallery_is" value="y" <?php echo $gallery_is_y;?>> 사용함</label>
				<label><input type="radio" name="gallery_is" value="n" <?php echo $gallery_is_n;?>> 사용안함</label>
			</p>
		</td>
	</tr>
	<tr>
		<th><p>PC 갤러리 게시물 수</p></th>
		<td>
			<p class="rt_fln">
				행 <input type="text" class="rt_input_txt rt_w40" value="<?php echo $page_cnt_gallery[0]?>" name="page_cnt_gallery1" />
				<em> x </em>
				열 <input type="text" class="rt_input_txt rt_w40" value="<?php echo $page_cnt_gallery[1]?>" name="page_cnt_gallery2" />
			</p>
			<p class="rt_brown rt_fln">갤러리 형태의 스킨 사용 시 출력 개수를 [행,열]로 공백없이 입력해 주세요</p>
		</td>
		<th><p>모바일 갤러리 게시물 수</p></th>
		<td>
			<p class="rt_fln">
				행 <input type="text" class="rt_input_txt rt_w40" value="<?php echo $page_cnt_gallery_mobile[0]?>" name="page_cnt_gallery_mobile1" />
				<em> x </em>
				열 <input type="text" class="rt_input_txt rt_w40" value="<?php echo $page_cnt_gallery_mobile[1]?>" name="page_cnt_gallery_mobile2" />
			</p>
			<p class="rt_brown rt_fln">갤러리 형태의 스킨 사용 시 출력 개수를 [행,열]로 공백없이 입력해 주세요</p>
		</td>
	</tr>
	</tbody>
</table>

<div class="rt_s_tit clearfix">
	<p>04<span></span></p>
	<h1>대표(목록) 이미지(개발자용)</h1>
</div>
<table class="rt_data_table">
	<caption>기본 환경 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>사용 여부</p></th>
			<td>
				<p>
					<label><input type="radio" name="list_img_is" value="y" <?php echo $list_img_is_y;?>> 사용함</label>
					<label><input type="radio" name="list_img_is" value="n" <?php echo $list_img_is_n;?>> 사용안함</label>
				</p>
			</td>
			<th><p>목록 썸네일 사용</p></th>
			<td>
				<p>
					<label><input type="radio" name="list_img_thumb_is" value="y" <?php echo $list_img_thumb_is_y;?>> 사용함</label>
					<label><input type="radio" name="list_img_thumb_is" value="n" <?php echo $list_img_thumb_is_n;?>> 사용안함</label>
				</p>
			</td>
		</tr>
		<tr>
			<th><p>썸네일 사이즈(px)</p></th>
			<td colspan="3">
				<p>
					가로 <input type="text" class="rt_input_txt rt_w40" name="list_img_thumb_w" value="<?php echo $_r['list_img_thumb_w'];?>" />
					<em> x </em>
					세로 <input type="text" class="rt_input_txt rt_w40" name="list_img_thumb_h" value="<?php echo $_r['list_img_thumb_h'];?>" />
				</p>
			</td>
		</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar mb25">
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">설정 변경</a>
</div>

<div class="rt_bot_box">
	<h1>이용안내</h1>
	<p><em>-</em><span class="rt_mint">관리자 기본 작성명</span>은 관리자에서 글작성 시 기본으로 출력됩니다. 서비스명, 회사명 등으로 설정하면 편리합니다.</p>
</div>

<script src="<?php echo $_def['path_section'];?>/js/rtboard.theme.info.conf.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>