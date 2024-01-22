<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php
if ($env->_get['bcode']) {
	require_once RT_DOC_ROOT.$_def['path_app']."/theme/".$_bdinfo['theme']."/inc.common.menu.php";
}
?>

<form name="data_form" action="<?php echo $_def['path_app'];?>/<?php echo $__sd;?>/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?php echo $_def['mode'];?>">
<input type="hidden" name="bcode" value="<?php echo $env->_get['bcode'];?>">
<input type="hidden" name="seq" value="<?php echo $r['seq'];?>">
<input type="hidden" name="pg" value="<?php echo $env->_get['pg'];?>">
<input type="hidden" name="search" value="<?php echo $env->_get['search'];?>">
<input type="hidden" name="searchstring" value="<?php echo $env->_get['searchstring'];?>">
<input type="hidden" name="path_files" value="<?php echo $_def['path_files'];?>">
<input type="hidden" name="webeditor_is" value="<?php echo $_conf['webeditor_is'];?>">
<input type="hidden" name="ctgr" value="<?php echo $env->_get['ctgr'];?>">

<table class="rt_data_table">
<caption>게시판 설정 정보</caption>
<colgroup>
	<col width="15%" />
	<col width="35%" />
	<col width="15%" />
	<col width="35%" />
</colgroup>
	<tbody>
	<tr>
		<th rowspan="2"><p>BEST후기</p></th>
		<td colspan="3">
			<p>
				<label><input type="radio" name="best_en" value="y" <?php echo $best_en_y;?>> <span class="rt_txt">설정</span></label>
				<label><input type="radio" name="best_en" value="n" <?php echo $best_en_n;?>> <span class="rt_txt">미설정</span></label>
			</p>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<p>베스트 후기 설정 시 해당 회원에게 사은품신청권 1개가 즉시 발행되며 재설정 시 동일 시리얼번호로 중복발행되지 않습니다.</p>
		</td>
	</tr>
	<?php if ($_conf['category_is'] == "y") { ?>
	<tr>
		<th><p>글 분류</p></th>
		<td colspan="3">
			<p class="rt_fln">
				<select name="category" class="rt_w250">
					<option value="">글 분류 선택</option>
					<?php foreach ($category_arr as $k => $v) {?>
					<option value="<?php echo $v?>" <?=($v == $r['category'])?"selected":""?>><?php echo $v?></option>
					<?php }?>
				</select>
			</p>
		</td>
	</tr>
	<?php }?>
	<tr>
		<th><p>이름</p></th>
		<td colspan="3"><p class="rt_fln"><input name="name" class="rt_input_txt rt_w250 required" type="text" value="<?php echo $r['name'];?>" msg="이름을 입력해 주세요"></p></td>
	</tr>
	<?for ($m = 0; $m < count($_fset); $m++){?>
	<tr>
		<th><p><?php echo $_fset[$m]['name'];?></p></th>
		<td colspan="3"><p class="rt_fln"><?php echo stripslashes($cls_board->formset($_fset[$m], $sz, true));?></p></td>
	</tr>
	<?}?>
	<tr>
		<th><p>제목</p></th>
		<td colspan="3"><p class="rt_fln"><input name="subject" class="rt_input_txt required" type="text" value="<?php echo $r['subject'];?>" msg="제목을 입력해 주세요" /></p></td>
	</tr>
	<tr>
		<th><p>별점</p></th>
		<td colspan="3">
			<p class="rt_fln">
				<select name="rating_en" class="rt_w250">
					<option value="">별점 선택</option>
					<option value="5" <?php echo ($r['rating_en'] == "5")?"selected":""?>>5점</option>
					<option value="4" <?php echo ($r['rating_en'] == "4")?"selected":""?>>4점</option>
					<option value="3" <?php echo ($r['rating_en'] == "3")?"selected":""?>>3점</option>
					<option value="2" <?php echo ($r['rating_en'] == "2")?"selected":""?>>2점</option>
					<option value="1" <?php echo ($r['rating_en'] == "1")?"selected":""?>>1점</option>
				</select>
			</p>
		</td>
	</tr>
	<?php if ($_conf['webeditor_is'] == "y") { ?>
	<tr>
		<th><p>내용</p></th>
		<td colspan="3">
			<div class="rt_button_wrap mb10">
				<a href="#;" id="btn-tpl" class="rt_btn_gray btn_s">글쓰기 템플릿</a>
			</div>
			<div id="area-tpl" class="mb10" style="display:none;">
				<table class="rt_data_table">
				<caption>글쓰기 템플릿 목록</caption>
				<colgroup>
					<col width="15%" />
					<col width="85%" />
				</colgroup>
				<tbody>
				<?php for ($m = 0; $m < count($formtpl_arr); $m++) { ?>
				<tr>
					<th>
						<p>
							<div class="rt_button_wrap">
								<a href="javascript:formtpl_apply('<?php echo $formtpl_arr[$m]['seq'];?>','content');" class="rt_btn_orange">본문 삽입</a>
							</div>
						</p>
					</th>
					<td><p><?php echo $formtpl_arr[$m]['title'];?></p></td>
				</tr>
				<?php } ?>
				</table>
			</div>
			<textarea name="content" id="content" class="required" style="height:350px;width:100%;display:none;" msg="내용을 입력해 주세요"><?php echo $r['content'];?></textarea>
		</td>
	</tr>
	<?php } else { ?>
	<tr>
		<th><p>내용</p></th>
		<td colspan="3">
			<textarea name="content" class="required" style="height:350px;width:100%;" msg="내용을 입력해 주세요"><?php echo $r['content'];?></textarea>
		</td>
	</tr>
	<?php } ?>

	<?php if ($env->_get['bcode'] == "review") { ?>
	<!-- <tr>
		<th><p>제품 모델</p></th>
		<td>
			<p class="rt_fln">
				<select name="pdt_model" class="rt_w250">
					<option value="">모델 선택</option>
					<?php foreach ($__model as $k => $v) {?>
					<option value="<?php echo $k?>" <?php echo ($k == $r['pdt_model'])?"selected":"";?>><?php echo $v?></option>
					<?php }?>
				</select>
			</p>
		</td>
		<th><p>시리얼넘버</p></th>
		<td><p class="rt_fln"><input name="serial_num" class="rt_input_txt rt_w250" type="text" value="<?php echo $r['serial_num'];?>"></p></td>
	</tr>
	<tr>
		<th><p>추천인코드</p></th>
		<td><p class="rt_fln"><input name="recode" class="rt_input_txt rt_w250" type="text" value="<?php echo $r['recode'];?>"></p></td>
		<th><p>승인여부</p></th>
		<td>
			<p>
				<label><input type="radio" name="auth_en" value="n" <?php echo $auth_en_n?>> <span class="rt_txt">미승인</span></label>
				<label><input type="radio" name="auth_en" value="y" <?php echo $auth_en_y?>> <span class="rt_txt">승인</span></label>
			</p>
		</td>
	</tr> -->
	<?php } ?>

	<!-- <tr>
		<th><p>비밀번호</p></th>
		<td colspan="3"><p class="rt_fln"><input type="password" name="post_pw" class="rt_w250" value=""></p></td>
	</tr> -->
	<?php if ($_conf['list_img_is'] == "y") { ?>
	<tr>
		<th><p>대표(목록) 이미지<br />(jpg, gif)</p></th>
		<td colspan="3">
			<p class="rt_fln"><input type="file" class="rt_input_txt rt_w250" value="" name="list_img" /></p>
			<?php if ($r['list_img_new']) {?>
			<p class="rt_fln"><label><input type="checkbox" name="list_img_del_is" id="list_img_del_is" value="y" /><span class="rt_txt rt_red"> [<?php echo $r['list_img_ori'];?>] 체크 시 첨부파일 삭제</span></label></p>
			<?}?>
		</td>
	</tr>
	<?php } ?>
	<?php
	for ($m = 1; $m <= $_conf['upload_cnt']; $m++) {
		?>
	<tr>
		<th><p>첨부파일<?php echo $m;?></p></th>
		<td colspan="3">
			<p><input type="file" class="rt_input_txt rt_w250" value="" name="file<?php echo $m;?>" /></p>
			<?php if ($attc_arr[$m]['file_new']) {?>
			<p><label><input type="checkbox" name="attc_del<?php echo $m?>_is" value="y" /><span class="rt_txt rt_red"> [<?php echo $attc_arr[$m]['file_ori'];?>] 첨부파일 삭제</span></label></p>
			<?php } ?>
		</td>
	</tr>
		<?php
	}?>
	<!-- <tr>
		<th><p>공지사항</p></th>
		<td>
			<p><label><input type="checkbox" name="notice_is" id="notice_is" value="y" <?php echo $notice_is_y?>> <span class="rt_txt">공지사항 설정</span></label></p>
		</td>
		<th><p>노출여부</p></th>
		<td>
			<p>
				<label><input type="radio" name="use_is" value="y" <?php echo $use_is_y?>> <span class="rt_txt">노출함</span></label>
				<label><input type="radio" name="use_is" value="n" <?php echo $use_is_n?>> <span class="rt_txt">노출안함</span></label>
			</p>
		</td>
	</tr> -->
	<tr>
		<th><p>등록일</th>
		<td><p class="rt_fln"><input type="text" name="reg_date" id="reg_date" class="rt_input_txt rt_w250" value="<?php echo $r['reg_date'];?>" readonly /></p></td>
		<th><p>수정일</th>
		<td><p class="rt_fln"><input type="text" name="mod_date" id="mod_date" class="rt_input_txt rt_w250" value="<?php echo $r['mod_date'];?>" readonly /></p></td>
	</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar mb25">
	<?php if ($_def['mode'] == "modify") {?>
	<a href="#;" id="btn-delete" class="rt_btn_red">삭제</a>
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">글 수정</a>
	<?php } else {?>
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">글 등록</a>
	<?php }?>
	<a href="#;" id="btn-list" class="rt_btn_gray">목록가기</a>
</div>

<?php if ($_conf['webeditor_is'] == "y") { ?>
<!-- SE2 WEB Editor //-->
<script src="<?php echo RTW_PLUGIN?>/SE2.8.2.O12056/js/HuskyEZCreator.js" type="text/javascript"></script>
<script src="<?php echo RTW_ASSETS?>/js/se2.editor.js" type="text/javascript"></script>
<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "content",
	sSkinURI: "<?php echo RTW_PLUGIN?>/SE2.8.2.O12056/SmartEditor2Skin.html",
	fOnAppLoad : function(){
		oEditors.getById["content"].setDefaultFont("나눔고딕", "10");
	}
});
</script>
<?php } ?>

<form name="conf_form">
	<input type="hidden" name="webeditor_is" id="webeditor_is" value="<?php echo $_conf['webeditor_is'];?>" />
</form>

<script src="<?php echo $_def['path_section'];?>/js/rtboard.theme.norm.data.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>