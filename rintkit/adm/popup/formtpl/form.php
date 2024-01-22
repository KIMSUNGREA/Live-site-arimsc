<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="data_form" action="<?php echo $__sc;?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="<?php echo $__cfg['mode'];?>">
<input type="hidden" name="seq" value="<?php echo $_r['seq'];?>">
<table class="rt_data_table">
	<caption>팝업 템플릿 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>템플릿 제목</p></th>
			<td>
				<input type="text" class="rt_input_txt required" value="<?php echo $_r['title'];?>" name="title" msg="템플릿 제목을 입력해 주세요" />
			</td>
		</tr>
		<tr>
			<th><p>뎀플릿 데이터</p></th>
			<td>
				<textarea name="content" id="content" class="rt_input_txt required" style="height:500px;" msg="템플릿 데이터를 입력해 주세요"><?php echo $_r['content'];?></textarea>
			</td>
		</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar mb25">
	<a href="#;" id="btn-list" class="rt_btn_gray">목록 가기</a>
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">정보 변경</a>
</div>

<!-- SE2 WEB Editor //-->
<script src="<?php echo RTW_PLUGIN;?>/SE2.8.2.O12056/js/HuskyEZCreator.js" type="text/javascript"></script>
<script src="<?php echo RTW_ASSETS;?>/js/se2.editor.js" type="text/javascript"></script>
<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "content",
	sSkinURI: "<?php echo RTW_PLUGIN;?>/SE2.8.2.O12056/SmartEditor2Skin.html",
	fOnAppLoad : function(){
		oEditors.getById["content"].setDefaultFont("나눔고딕", "10");
	}
});
</script>

<script src="assets/js/popup.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>