<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="dataform" action="<?php echo $__sc?>/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?php echo $__cfg['mode'];?>">
<input type="hidden" name="seq" value="<?php echo $env->_get['seq'];?>">
<input type="hidden" name="content_type" value="<?php echo $_r['content_type'];?>">
<input type="hidden" id="num" value="">
<table class="rt_data_table">
	<caption>팝업 등록</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>팝업 제목</p></th>
			<td><input type="text" id="" class="rt_input_txt required" value="<?php echo $_r['title'];?>" name="title" msg="팝업 제목을 입력해 주세요." /></td>
			<th><p>사용 여부</p></th>
			<td>
				<label><input type="radio" name="is_view" value="y" <?php echo ($_r['is_view'] == "y" || $__cfg['mode'] == "insert") ? "checked" : "";?>/> 사용함</label>
				<label><input type="radio" name="is_view" value="n" <?php echo ($_r['is_view'] == 'n')?"checked":"";?>/> 사용하지 않음</label>
			</td>
		</tr>
		<tr>
			<th><p>팝업 위치/사이즈</p></th>
			<td colspan="3">
				<p class="rt_button_wrap">
					<a href="#;" class="rt_btn_orange btn_in" id="btn-popup-pos" title="새 창 열림">팝업 위치/사이즈 설정</a>
				</p>
			</td>
		</tr>
		<tr>
			<th><p>팝업 사이즈</p></th>
			<td>
				가로 <input type="text" class="rt_input_txt" value="<?php echo $_r['size_w'];?>" name="size_w" style="width:60px;" /> px, 세로 <input type="text" class="rt_input_txt" value="<?php echo $_r['size_h'];?>" name="size_h" style="width:60px;" /> px
			</td>
			<th><p>출력 위치</p></th>
			<td>
				<p>
					가로 <input type="text" class="rt_input_txt rt_w40 required" value="<?php echo $_r['pos_x'];?>" name="pos_x" msg="가로 출력위치를 입력해 주세요." id="pp_x" />
					<em>,</em>
					세로 <input type="text" class="rt_input_txt rt_w40 required" value="<?php echo $_r['pos_y'];?>" name="pos_y" msg="세로 출력위치를 입력해 주세요." id="pp_y" />
				</p>
			</td>
		</tr>
		<tr>
			<th><p>팝업 등록 콘텐츠</p></th>
			<td colspan="3">
				<p class="rt_button_wrap rt_tac">
					<a href="#;" id="con_type_img" class="rt_btn_purple btn_in rt_fll">이미지</a>
					<a href="#;" id="con_type_html" class="rt_btn_purple btn_in rt_fll">HTML</a>
				</p>
			</td>
		</tr>
		<tr id="tr_img1" style="display:<?php echo ($_r['content_type'] == "img")?"":"none";?>;">
			<th><p>팝업 이미지</p></th>
			<td colspan="3">
				<div class="clearfix">
					<input type="file" id="" class="rt_input_txt rt_fll" name="file1" style="width:300px;" />
					<?php if ($_r['file1_new']) { ?>
					<p class="rt_button_wrap">
						<a href="javascript:img_delete(<?php echo $_r['seq'];?>, 1)" id="con_type_html" class="rt_btn_red btn_s">이미지 삭제</a>
					</p>
				</div>
				<img src="<?php echo $_r['file_subdir'];?>/<?php echo $_r['file1_new'];?>" style="max-width:700px;" />
				<?php } ?>
			</td>
		</tr>
		<tr id="tr_img3" style="display:<?php echo ($_r['content_type'] == "img")?"":"none";?>;">
			<th><p>링크 사용여부</p></th>
			<td>
				<label><input type="radio" name="link_is" value="y" <?php echo ($_r['link_is'] == "y" || $__cfg['mode'] == "insert")?"checked":"";?>/> 사용함</label>
				<label><input type="radio" name="link_is" value="n" <?php echo ($_r['link_is'] == "n")?"checked":"";?>/> 사용안함</label>
			</td>
			<th><p>링크 타입</p></th>
			<td>
				<label><input type="radio" name="link_type" value="url" <?php echo ($_r['link_type'] == "url" || $__cfg['mode'] == "insert")?"checked":"";?>/> 통링크</label>
				<label><input type="radio" name="link_type" value="map" <?php echo ($_r['link_type'] == "map")?"checked":"";?>/> 이미지맵</label>
			</td>
		</tr>
		<tr id="tr_img4" style="display:<?php echo ($_r['content_type'] == "img")?"":"none";?>;">
			<th><p>통링크 URL</p></th>
			<td colspan="3">
				<input type="text" class="rt_input_txt" value="<?php echo $_r['link_url'];?>" name="link_url"/>
			</td>
		</tr>
		<tr id="tr_img5" style="display:<?php echo ($_r['content_type'] == "img")?"":"none";?>;">
			<th><p>이미맵 소스</p></th>
			<td colspan="3">
				<textarea name="link_map" class="rt_input_txt" style="height:150px;"><?php echo $_r['link_map'];?></textarea>
			</td>
		</tr>
		<tr id="tr_html" style="display:<?php echo ($_r['content_type'] == "html")?"":"none";?>;">
			<th>HTML 소스</th>
			<td colspan="3">
				<div class="rt_button_wrap mb10">
					<a href="#;" id="btn-tpl" class="rt_btn_gray btn_s">팝업 템플릿</a>
				</div>
				<div id="area-tpl" class="mb10" style="display:none;">
					<table class="rt_data_table">
					<caption>팝업 템플릿 목록</caption>
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
									<a href="javascript:formtpl_apply('<?php echo $formtpl_arr[$m]['seq'];?>','content_html');" class="rt_btn_orange">본문 삽입</a>
								</div>
							</p>
						</th>
						<td><p><?php echo $formtpl_arr[$m]['title'];?></p></td>
					</tr>
					<?php } ?>
					</table>
				</div>
				<textarea name="content_html" id="content_html" title="" class="rt_input_txt" style="height:500px; display:none;" ><?php echo $_r['content_html'];?></textarea>
			</td>
		</tr>
		<tr>
			<th><p>게시 시작일</p></th>
			<td>
				<input type="text" id="sdate" class="rt_input_txt rt_w250 required" value="<?php echo $_r['date_start'];?>" name="date_start" msg="게시일을 선택해 주세요." readonly/>
			</td>
			<th><p>게시 만료일</p></th>
			<td>
				<input type="text" id="edate" class="rt_input_txt rt_w250 required" value="<?php echo $_r['date_end'];?>" name="date_end" msg="만료일을 선택해 주세요." readonly/>
			</td>
		</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar mb25">
	<?php if ($__cfg['mode'] == "insert") {?>
	<a href="#;" id="btn-submit" class="rt_btn_blue">새 팝업 등록</a>
	<?php } else { ?>
	<a href="#;" id="btn-submit" class="rt_btn_blue">정보 변경</a>
	<?php } ?>
	<a href="#;" id="btn-move-list" class="rt_btn_gray">목록가기</a>
	
</div>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em>팝업 출력 위치는 가로(x),세로(y)의 수치를 입력하여 설정할 수 있습니다.</p>
	<p><em>-</em>가로 출력의 기준 위치는 <span class="rt_mint">브라우저 중앙이 0</span>이며<br />세로 출력의 기준 위치는 <span class="rt_mint">브라우저 최상단 0</span>입니다.</p>
	<p><em>-</em>가로 이동 시 양수를 입력하면 우측으로, 음수(-)를 입력하면 좌측으로 팝업이 이동합니다.<br />세로 이동 시 양수를 입력하면 그 수만큼 팝업이 상단에서 멀어지게 됩니다.</p>
	<p><em>-</em>세로 이동은 브라우저 상단이 0이므로 양수만 입력해 주셔야 합니다.</p>
</div>

<!-- SE2 WEB Editor //-->
<script src="<?php echo RTW_PLUGIN;?>/SE2.8.2.O12056/js/HuskyEZCreator.js" type="text/javascript"></script>
<script src="<?php echo RTW_ASSETS;?>/js/se2.editor.js" type="text/javascript"></script>
<script type="text/javascript">
var oEditors = [];
var type= "<?php echo $_r['content_type'];?>";
if (type =="html") {
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "content_html",
		sSkinURI: "<?php echo RTW_PLUGIN;?>/SE2.8.2.O12056/SmartEditor2Skin.html",
		fOnAppLoad : function(){
			oEditors.getById["content_html"].setDefaultFont("나눔고딕", "10");
		}
	});
} else {
	$("#con_type_html").click(function (){
		if ($('#num').val() != "1") {
			nhn.husky.EZCreator.createInIFrame({
				oAppRef: oEditors,
				elPlaceHolder: "content_html",
				sSkinURI: "<?php echo RTW_PLUGIN;?>/SE2.8.2.O12056/SmartEditor2Skin.html",
				fOnAppLoad : function(){
					oEditors.getById["content_html"].setDefaultFont("나눔고딕", "10");
				}
			});
		}
	});
}
</script>

<script src="assets/js/popup.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>