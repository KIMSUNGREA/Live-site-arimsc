<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<form name="dataform" action="<?php echo $_def['path_app']."/".$__sd;?>/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?php echo $__cfg['mode'];?>">
<input type="hidden" name="seq" value="<?php echo $env->_get['seq'];?>">
<input type="hidden" name="sd" value="<?php echo $env->_get['sd'];?>">
<input type="hidden" name="search" value="<?php echo $env->_get['search'];?>">
<input type="hidden" name="searchstring" value="<?php echo $env->_get['searchstring'];?>">
<input type="hidden" name="pg" value="<?php echo $env->_get['pg'];?>">
<input type="hidden" name="schcate" value="<?php echo $env->_get['schcate'];?>">
<table class="rt_field_table mb10">
	<caption>제품 정보</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tr>
		<th><p>분류 설정</p></th>
		<td>
			<select name="cate" class="rt_input_txt required" msg="분류를 설정해 주세요">
				<option value="">분류를 선택해 주세요</option>
				<?php
				for ($m = 0; $m < count($cls_ct->listdata['code']); $m++) {
					$addstr = "";
					if ($cls_ct->listdata['parent'][$m] != '0') {
						for ($i = 1; $i < $cls_ct->listdata['depth'][$m]; $i++) {$addstr.= " ─ ";}
					}
					?>
					<option value="<?php echo $cls_ct->listdata['code'][$m];?>" <?php echo ($cls_ct->listdata['code'][$m] == $_r['cate'])?"selected":"";?>><?php echo $addstr.$cls_ct->listdata['label'][$m];?></option>
					<?
				} ?>
			</select>
		</td>
		<th><p>제품명 *</p></th>
		<td><input type="text" class="rt_input_txt required" value="<?php echo $_r['pdt_name'];?>" name="pdt_name" msg="제품명을 입력해 주세요" /></td>
	</tr>
	<tr>
		<th><p>목록 이미지<br />(jpg, gif)</p></th>
		<td colspan="3">
			<p class="rt_fll"><input type="file" class="rt_input_txt rt_w250" value="" name="list_img" /></p>
			<?php if ($_r['list_img_new']) {?>
			<div class="rt_thumb_view_ico_wrap rt_fll">
				<a href="#;" class="rt_thumb_view_ico">
					<img src="<?php echo RTW_LAYOUT;?>/images/sub/search_img.png" alt="돋보기" />
				</a>
				<img src="<?php echo $_r['list_img_dir'].$_r['list_img_new'];?>" style="max-height:250px;" class="rt_thumb_view_con" >
			</div>
			<p class="clearfix rt_fll mt10"><label><input type="checkbox" name="list_img_del_is" value="y" /><span class="rt_txt rt_green"> [<?php echo $_r['list_img_ori'];?>] 체크 시 첨부파일 삭제</span></label></p>
			<?}?>
		</td>
	</tr>
	<tr>
		<th><p>페이지 구성</p></th>
		<td colspan="3">
			<label><input type="radio" name="type_en" onclick="toggle_data('type_en', 'field')" <?php echo $type_field;?> value="field" /> 필드 설정</label>
			<label><input type="radio" name="type_en" onclick="toggle_data('type_en', 'img')" <?php echo $type_img;?> value="img" /> 이미지 설정</label>
			<label><input type="radio" name="type_en" onclick="toggle_data('type_en', 'html')" <?php echo $type_html;?> value="html" /> HTML 설정</label>
		</td>
	</tr>
</table>

<table class="rt_field_table mb10 type_en_img" style="display:<?php echo $type_en_img;?>;">
	<caption>제품 정보</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tr>
		<th><p>콘텐츠 이미지</p></th>
		<td colspan="3">
			<p class="rt_fln"><input type="file" class="rt_input_txt rt_w250" value="" name="pdt_img" /></p>
			<?php if ($_r['pdt_img_new']) {?>
			<p class="rt_fln">
				<p class="mb10"><img src="<?php echo $_r['pdt_img_dir'].$_r['pdt_img_new'];?>" style="max-height:250px;"></p>
				<label><input type="checkbox" name="pdt_img_del_is" id="pdt_img_del_is" value="y" /><span class="rt_txt rt_green"> [<?php echo $_r['pdt_img_ori'];?>] 체크 시 첨부파일 삭제</span></label>
			</p>
			<?}?>
		</td>
	</tr>
</table>

<table class="rt_field_table mb10 type_en_html" style="display:<?php echo $type_en_html;?>;">
	<caption>제품 정보</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tr>
		<th><p>페이지 HTML</p></th>
		<td colspan="3">
			<textarea name="pdt_html" style="height:300px;"><?php echo rt_dbstr_decode($_r['pdt_html'],"html");?></textarea>
		</td>
	</tr>
</table>

<table class="rt_field_table mb10 type_en_field" style="display:<?php echo $type_en_field;?>;">
	<caption>제품 정보</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tr>
		<th><p>옵션 설정</p></th>
		<td colspan="3">
			<table class="rt_field_table">
			<caption>옵션 설정</caption>
			<colgroup>
				<col width="250px" />
				<col width="" />
			</colgroup>
			<tbody>
			<tr>
				<th><p>옵션 명</p></th>
				<th><p>옵션 데이터</p></th>
			</tr>
			<tr>
				<td><input type="text" class="rt_input_txt" value="<?php echo $_r['opt_tit1'];?>" name="opt_tit1" /></td>
				<td><input type="text" class="rt_input_txt rt_full" value="<?php echo $_r['opt1'];?>" name="opt1" /></td>
			</tr>
			<tr>
				<td><input type="text" class="rt_input_txt" value="<?php echo $_r['opt_tit2'];?>" name="opt_tit2" /></td>
				<td><input type="text" class="rt_input_txt rt_full" value="<?php echo $_r['opt2'];?>" name="opt2" /></td>
			</tr>
			<tr>
				<td><input type="text" class="rt_input_txt" value="<?php echo $_r['opt_tit3'];?>" name="opt_tit3" /></td>
				<td><input type="text" class="rt_input_txt rt_full" value="<?php echo $_r['opt3'];?>" name="opt3" /></td>
			</tr>
			<tr>
				<td><input type="text" class="rt_input_txt" value="<?php echo $_r['opt_tit4'];?>" name="opt_tit4" /></td>
				<td><input type="text" class="rt_input_txt rt_full" value="<?php echo $_r['opt4'];?>" name="opt4" /></td>
			</tr>
			</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<th><p>가상(추가) 옵션</p></th>
		<td colspan="3">
			<div class="rt_button_wrap">
				<a href="#;" id="btn-add-page" class="rt_btn_orange">+ 옵션 추가</a>
			</div>
			<br />
			<table class="rt_field_table" id="data_table">
			<caption>옵션 설정</caption>
			<colgroup>
				<col width="100px" />
				<col width="250px" />
				<col width="" />
			</colgroup>
			<tbody>
			<tr>
				<th><p>삭제</p></th>
				<th><p>옵션 명</p></th>
				<th><p>옵션 데이터</p></th>
			</tr>
			<?php for ($m = 0; $m < count($vopt_tit); $m++) {?>
			<tr>
				<td><div class="rt_button_wrap"><a href="javascript:;" onclick="delete_vopt(this)" class="rt_btn_red btn_in">삭제</a></div></td>
				<td><input type="text" class="rt_input_txt required" value="<?php echo $vopt_tit[$m];?>" name="vopt_tit[]" msg="옵션명을 입력해 주세요" /></td>
				<td><input type="text" class="rt_input_txt required rt_full" value="<?php echo $vopt_val[$m];?>" name="vopt_val[]" msg="옵션데이터를 입력해 주세요" /></td>
			</tr>
			<?php } ?>
			</tbody>
			</table>
		</td>
	</tr>
	<?php
	for ($m = 1; $m <= $_conf['upload_img_cnt']; $m++) {
		?>
	<tr>
		<th><p>제품 이미지<?php echo $m;?></p></th>
		<td colspan="3">
			<p class="rt_fll"><input type="file" class="rt_input_txt rt_w250" value="" name="img_file<?php echo $m;?>" /></p>
			<?php if ($attc_img_arr[$m]['file_new']) {?>
			<div class="rt_thumb_view_ico_wrap rt_fll">
				<a href="#;" class="rt_thumb_view_ico">
					<img src="<?php echo RTW_LAYOUT;?>/images/sub/search_img.png" alt="돋보기" />
				</a>
				<img src="<?php echo $attc_img_arr[$m]['path_base'].$attc_img_arr[$m]['path_sub'].$attc_img_arr[$m]['file_new'];?>" style="max-height:250px;" class="rt_thumb_view_con" >
			</div>
			<p class="clearfix rt_fll mt10"><label><input type="checkbox" name="img_del<?php echo $m;?>_is" value="y" /><span class="rt_txt rt_green"> [<?php echo $attc_img_arr[$m]['file_ori'];?>] 이미지 삭제</span></label></p>
			<?php } ?>
		</td>
	</tr>
		<?php
	}?>
	<tr>
		<th><p>제품 이미지<br />본문 상단에 출력</p></th>
		<td colspan="3">
			<label><input type="radio" name="detail_img_cont_is" <?php echo $detail_img_cont_is_n;?> value="n" /> 사용 안함</label>
			<label><input type="radio" name="detail_img_cont_is" <?php echo $detail_img_cont_is_y;?> value="y" /> 사용 함</label>
		</td>
	</tr>
	<tr>
		<th><p>상세 내용</p></th>
		<td colspan="3">
			<div class="rt_button_wrap mb10">
				<a href="#;" id="btn-tpl" class="rt_btn_gray btn_s">상용 템플릿 적용</a>
			</div>
			<div id="area-tpl" class="mb10" style="display:none;">
				<table class="rt_data_table">
				<caption>상용 템플릿 목록</caption>
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
								<a href="javascript:formtpl_apply('<?php echo $formtpl_arr[$m]['seq'];?>','detail_cont');" class="rt_btn_orange">본문 삽입</a>
							</div>
						</p>
					</th>
					<td><p><?php echo $formtpl_arr[$m]['title'];?></p></td>
				</tr>
				<?php } ?>
				</table>
			</div>
			<textarea name="detail_cont" id="detail_cont" class="required" style="height:350px;width:100%;display:none;" msg="내용을 입력해 주세요"><?php echo rt_dbstr_decode($_r['detail_cont']);?></textarea>
		</td>
	</tr>
	<?php
	for ($m = 1; $m <= $_conf['upload_file_cnt']; $m++) {
		?>
	<tr>
		<th><p>첨부파일<?php echo $m;?></p></th>
		<td colspan="3">
			<p><input type="file" class="rt_input_txt rt_w250" value="" name="attc_file<?php echo $m;?>" /></p>
			<?php if ($attc_file_arr[$m]['file_new']) {?>
			<p><label><input type="checkbox" name="attc_del<?php echo $m;?>_is" value="y" /><span class="rt_txt rt_green"> [<?php echo $attc_file_arr[$m]['file_ori'];?>] 첨부파일 삭제</span></label></p>
			<?php } ?>
		</td>
	</tr>
		<?php
	}?>
	<tr>
		<th><p>등록일</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo ($_r['reg_date']!="0000-00-00")?$_r['reg_date']:""?>" name="reg_date" id="reg_date" /></td>
		<th><p>수정일</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo ($_r['mod_date']!="0000-00-00")?$_r['mod_date']:""?>" name="mod_date" id="mod_date" /></td>
	</tr>
</table>
</form>

<div class="rt_button_wrap rt_tar">
	<?php if ($__cfg['mode'] == "modify") { ?>
	<a href="javascript:product_delete(<?php echo $env->_get['seq'];?>,'<?php echo $env->_get['pg'];?>');" class="rt_btn_red">제품 삭제</a>
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">정보 수정</a>
	<?php } else { ?>
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">제품 등록</a>
	<?php } ?>
	<a href="#;" id="btn-move-list" class="rt_btn_gray">목록 가기</a>
</div>

<!-- SE2 WEB Editor //-->
<script src="<?php echo RTW_PLUGIN?>/SE2.8.2.O12056/js/HuskyEZCreator.js" type="text/javascript"></script>
<script src="<?php echo RTW_ASSETS?>/js/se2.editor.js" type="text/javascript"></script>
<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "detail_cont",
	sSkinURI: "<?php echo RTW_PLUGIN?>/SE2.8.2.O12056/SmartEditor2Skin.html",
	fOnAppLoad : function(){
		oEditors.getById["detail_cont"].setDefaultFont("나눔고딕", "10");
	}
});
</script>

<script src="<?php echo $_def['path_assets'];?>/js/product.admin.data.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>