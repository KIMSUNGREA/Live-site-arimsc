<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php
if ($env->_get['bcode']) {
	require_once RT_DOC_ROOT.$_def['path_app']."/theme/".$_bdinfo['theme']."/inc.common.menu.php";
}
?>

<form name="data_form" action="<?php echo $_def['path_app'];?>/<?php echo $__sd;?>/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
<input type="hidden" name="mode" value="reply">
<input type="hidden" name="bcode" value="<?php echo $env->_get['bcode'];?>">
<input type="hidden" name="seq" value="<?php echo $r['seq'];?>">
<input type="hidden" name="pg" value="<?php echo $env->_get['pg'];?>">
<input type="hidden" name="search" value="<?php echo $env->_get['search'];?>">
<input type="hidden" name="searchstring" value="<?php echo $env->_get['searchstring'];?>">
<input type="hidden" name="path_files" value="<?php echo $_def['path_files'];?>">
<table class="rt_data_table">
<caption>게시판 설정 정보</caption>
<colgroup>
	<col width="150px" />
	<col width="" />
</colgroup>
	<tbody>
	<?php if ($_conf['category_is'] == "y") { ?>
	<tr>
		<th><p>글 분류</p></th>
		<td><p><?php echo $r['category'];?></p></td>
	</tr>
	<?php } ?>
	<tr>
		<th><p>이름</p></th>
		<td><p><?php echo $r['name'];?></p></td>
	</tr>
	<tr>
		<th><p>휴대폰</p></th>
		<td><p><?php echo $r['phone'];?></p></td>
	</tr>
	<?php for ($m = 0; $m < count($_fset); $m++) { ?>
	<tr>
		<th><p><?php echo $_fset[$m]['name'];?></p></th>
		<td><p><?php echo stripslashes($cls_board->formset_data($_fset[$m], $sz));?></p></td>
	</tr>
	<?php } ?>
	<tr>
		<th><p>제목</p></th>
		<td><p><?php echo $r['subject'];?></p></td>
	</tr>
	<!-- <tr>
		<th><p>문의 내용</p></th>
		<td class="rt_substance"><p><?php echo $r['content'];?></p></td>
	</tr> -->
	<?php
	if (count($attc_arr) > 0) {
		for ($m = 0; $m < count($attc_arr); $m++) {
			if (!empty($attc_arr[$m]['file_ori'])) {
				$filesize = rt_get_file_unit_format($attc_arr[$m]['file_size']);
		?>
	<tr>
		<th><p>첨부다운</p></th>
		<td>
			<p class="mt5"><a href="<?php echo $_def['path_theme'];?>/data/download.php?mode=download&bcode=<?php echo $env->_get['bcode'];?>&seq=<?php echo $r['seq'];?>&file_num=<?php echo $attc_arr[$m]['file_num'];?>" target="rt_ifrm"><?php echo $attc_arr[$m]['file_ori'];?> (<?php echo $filesize?>)</a></p>
			<p class="rt_button_wrap">
				<a href="<?php echo $_def['path_theme'];?>/data/download.php?mode=download&bcode=<?php echo $env->_get['bcode'];?>&seq=<?php echo $r['seq'];?>&file_num=<?php echo $attc_arr[$m]['file_num'];?>" class="rt_btn_blue btn_in" target="rt_ifrm">다운로드</a>
			</p>
		</td>
	</tr>
			<?php
			}
		}
	}?>
	<tr>
		<th><p>등록(신청)일</p></th>
		<td><p><?php echo $r['reg_date'];?></p></td>
	</tr>
	<!-- <tr>
		<th><p>수정일</p></th>
		<td><p><?php echo $r['mod_date'];?></p></td>
	</tr> -->
	<tr>
		<th><p style="color:brown;">사은품 지급</p></th>
		<td>
			<p>
				<label><input type="radio" name="give_en" value="y" <?php echo $give_en_y?>> <span class="rt_txt">지급완료</span></label>
				<label><input type="radio" name="give_en" value="n" <?php echo $give_en_n?>> <span class="rt_txt">미지급</span></label>
			</p>
		</td>
	</tr>
	<tr>
		<th><p style="color:brown;">답변 상태</p></th>
		<td>
			<p>
				<label><input type="radio" name="reply_is" value="y" <?php echo $reply_is_y?>> <span class="rt_txt">답변완료</span></label>
				<label><input type="radio" name="reply_is" value="n" <?php echo $reply_is_n?>> <span class="rt_txt">답변대기</span></label>
			</p>
		</td>
	</tr>
	<?php if ($_conf['webeditor_is'] == "y") { ?>
	<tr>
		<th><p style="color:brown;">답글 작성</p></th>
		<td>
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
								<a href="javascript:formtpl_apply('<?php echo $formtpl_arr[$m]['seq'];?>','content_reply');" class="rt_btn_orange">본문 삽입</a>
							</div>
						</p>
					</th>
					<td><p><?php echo $formtpl_arr[$m]['title'];?></p></td>
				</tr>
				<?php } ?>
				</table>
			</div>
			<textarea name="content_reply" id="content_reply" class="required" style="height:350px;width:100%;display:none;" msg="내용을 입력해 주세요"><?php echo $r['content_reply'];?></textarea>
		</td>
	</tr>
	<?php } else { ?>
	<tr>
		<th><p style="color:brown;">답글 작성</p></th>
		<td>
			<textarea name="content_reply" class="required" style="height:350px;width:100%;" msg="내용을 입력해 주세요"><?php echo $r['content_reply'];?></textarea>
		</td>
	</tr>
	<?php } ?>
	<tr>
		<th>답변일</th>
		<td><input type="text" name="reply_date" id="reply_date" class="rt_input_txt rt_w250" value="<?php echo $r['reply_date'];?>" readonly /></td>
	</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar mb25">
	<a href="#;" id="btn-reply-submit" class="rt_btn_blue">답글 저장</a>
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
	elPlaceHolder: "content_reply",
	sSkinURI: "<?php echo RTW_PLUGIN?>/SE2.8.2.O12056/SmartEditor2Skin.html",
	fOnAppLoad : function(){
		oEditors.getById["content_reply"].setDefaultFont("나눔고딕", "10");
	}
});
</script>
<?php } ?>

<form name="conf_form">
	<input type="hidden" name="webeditor_is" id="webeditor_is" value="<?php echo $_conf['webeditor_is'];?>">
</form>

<script src="<?php echo $_def['path_section'];?>/js/rtboard.theme.qna.data.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>