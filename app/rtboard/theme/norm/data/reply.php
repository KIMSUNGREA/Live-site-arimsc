<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php
if ($env->_get['bcode']) {
	require_once RT_DOC_ROOT.$_def['path_app']."/theme/".$_bdinfo['theme']."/inc.common.menu.php";
}
?>

<form name="data_form" action="<?php echo $_def['path_app']?>/<?php echo $__sd?>/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?php echo $_def['mode']?>">
<input type="hidden" name="bcode" value="<?php echo $env->_get['bcode']?>">
<input type="hidden" name="seq" value="<?php echo $r['seq']?>">
<input type="hidden" name="pg" value="<?php echo $env->_get['pg']?>">
<input type="hidden" name="search" value="<?php echo $env->_get['search']?>">
<input type="hidden" name="searchstring" value="<?php echo $env->_get['searchstring']?>">
<input type="hidden" name="path_files" value="<?php echo $_def['path_files']?>">
<input type="hidden" name="ref" value="<?php echo $r['ref']?>">
<input type="hidden" name="re_step" value="<?php echo $r['re_step']?>">
<input type="hidden" name="re_level" value="<?php echo $r['re_level']?>">
<input type="hidden" name="webeditor_is" value="<?php echo $_conf['webeditor_is'];?>">

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
		<th><p>원글 제목</p></th>
		<td colspan="3"><p class="rt_fln"><?php echo $r['subject'];?></p></td>
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
		<td colspan="3"><p class="rt_fln"><input name="name" class="rt_input_txt rt_w250 required" type="text" value="" msg="이름을 입력해 주세요"></p></td>
	</tr>
	<?for ($m = 0; $m < count($_fset); $m++){?>
	<tr>
		<th><p><?php echo $_fset[$m]['name'];?></p></th>
		<td colspan="3"><p class="rt_fln"><?php echo stripslashes($cls_board->formset($_fset[$m], $sz, true, false));?></p></td>
	</tr>
	<?}?>
	<tr>
		<th><p>제목</p></th>
		<td colspan="3"><p class="rt_fln"><input name="subject" class="rt_input_txt required" type="text" value="" msg="제목을 입력해 주세요" /></p></td>
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
			<textarea name="content" id="content" class="required" style="height:350px;width:100%;display:none;" msg="내용을 입력해 주세요"></textarea>
		</td>
	</tr>
	<?php } else { ?>
	<tr>
		<th><p>내용</p></th>
		<td colspan="3">
			<textarea name="content" class="required" style="height:350px;width:100%;" msg="내용을 입력해 주세요"></textarea>
		</td>
	</tr>
	<?php } ?>
	<tr>
		<th><p>비밀번호</p></th>
		<td colspan="3"><p class="rt_fln"><input type="password" name="post_pw" class="rt_w250" value=""></p></td>
	</tr>
	<?php if ($_conf['list_img_is'] == "y") { ?>
	<tr>
		<th><p>대표(목록) 이미지<br />(jpg, gif)</p></th>
		<td>
			<p class="rt_fln"><input type="file" class="rt_input_txt rt_w250" value="" name="list_img" /></p>
		</td>
		<th><p>대표(목록) 이미지 설정</p></th>
		<td>
			<p>
				<label><input type="radio" name="list_img_cont_is" value="n" checked="checked"> <span class="rt_txt">목록 이미지로만 사용</span></label>
				<label><input type="radio" name="list_img_cont_is" value="y"> <span class="rt_txt">본문 상단에 출력</span></label>
			</p>
		</td>
	</tr>
	<?php } ?>
	<?php
	for ($m = 1; $m <= $_conf['upload_cnt']; $m++) {
		?>
	<tr>
		<th><p>첨부파일<?=$m?></p></th>
		<td colspan="3">
			<p><input type="file" class="rt_input_txt rt_w250" value="" name="file<?php echo $m?>" /></p>
		</td>
	</tr>
		<?php
	}?>
	<tr>
		<th><p>공지사항</p></th>
		<td>
			<p><label><input type="checkbox" name="notice_is" id="notice_is" value="y"> <span class="rt_txt">공지사항 설정</span></label></p>
		</td>
		<th><p>노출여부</p></th>
		<td>
			<p>
				<label><input type="radio" name="use_is" value="y" checked="checked"> <span class="rt_txt">노출함</span></label>
				<label><input type="radio" name="use_is" value="n"> <span class="rt_txt">노출안함</span></label>
			</p>
		</td>
	</tr>
	<tr>
		<th><p>등록일</th>
		<td><p class="rt_fln"><input type="text" name="reg_date" id="reg_date" class="rt_input_txt rt_w250" value="" readonly /></p></td>
		<th><p>수정일</th>
		<td><p class="rt_fln"><input type="text" name="mod_date" id="mod_date" class="rt_input_txt rt_w250" value="" readonly /></p></td>
	</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar mb25">
	<a href="#;" id="btn-view" class="rt_btn_gray">원글 가기</a>
	<a href="#;" id="btn-reply-submit" class="rt_btn_blue">답글 등록</a>
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
	<input type="hidden" name="webeditor_is" id="webeditor_is" value="<?php echo $_conf['webeditor_is'];?>">
</form>

<script src="<?php echo $_def['path_section']?>/js/rtboard.theme.norm.data.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>