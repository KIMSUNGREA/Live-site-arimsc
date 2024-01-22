<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<form name="data_form" action="<?php echo $_def['path_app']."/".$__sd;?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="<?=$__cfg['mode']?>">
<input type="hidden" name="opt_seq" value="<?=$_r['opt_seq']?>">
<table class="rt_field_table mb10">
	<caption>옵션 세트 폼</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tr>
		<th><p>옵션 세트 명</p></th>
		<td>
			<input type="text" class="rt_input_txt required" value="<?php echo $_r['opt_name'];?>" name="opt_name" msg="세트명을 입력해 주세요" />
		</td>
	</tr>
	<tr>
		<th><p>옵션명 1</p></th>
		<td>
			<input type="text" class="rt_input_txt" value="<?php echo $_r['opt_field1'];?>" name="opt_field1" />
		</td>
	</tr>
	<tr>
		<th><p>옵션명 2</p></th>
		<td>
			<input type="text" class="rt_input_txt" value="<?php echo $_r['opt_field2'];?>" name="opt_field2" />
		</td>
	</tr>
	<tr>
		<th><p>옵션명 3</p></th>
		<td>
			<input type="text" class="rt_input_txt" value="<?php echo $_r['opt_field3'];?>" name="opt_field3" />
		</td>
	</tr>
	<tr>
		<th><p>옵션명 4</p></th>
		<td>
			<input type="text" class="rt_input_txt" value="<?php echo $_r['opt_field4'];?>" name="opt_field4" />
		</td>
	</tr>
	<tr>
		<th><p>가상 옵션</p></th>
		<td>
			<div class="rt_button_wrap">
				<a href="#;" id="btn-add-page" class="rt_btn_orange">+ 가상 옵션 추가</a>
			</div>
			<br />
			<table class="rt_field_table" id="data_table">
			<caption>가상 옵션 설정</caption>
			<colgroup>
				<col width="100px" />
				<col width="" />
			</colgroup>
			<tbody>
			<tr>
				<th><p>삭제</p></th>
				<th><p>옵션 명</p></th>
			</tr>
			<?php for ($m = 0; $m < count($vopt); $m++) {?>
			<tr>
				<td><div class="rt_button_wrap"><a href="javascript:;" onclick="delete_vopt(this)" class="rt_btn_red btn_in">삭제</a></div></td>
				<td><input type="text" class="rt_input_txt required" value="<?php echo $vopt[$m];?>" name="vopt[]" msg="옵션명을 입력해 주세요" /></td>
			</tr>
			<?php } ?>
			</tbody>
			</table>
		</td>
	</tr>
</table>
</form>

<div class="rt_button_wrap rt_tar mb10">
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">정보 변경</a>
	<a href="#;" id="btn-list" class="rt_btn_gray">목록 가기</a>
</div>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em><span class="rt_mint">옵션명 데이터가 없으면 제품 등록 시 옵션이 출력되지 않습니다.</span></p>
	<p><em>-</em>가상 옵션의 <span class="rt_mint">추가/삭제</span>는 저장 전까지 실제 저장되지 않습니다.</p>
</div>

<script src="<?php echo $_def['path_assets'];?>/js/product.admin.option.js" type="text/javascript"></script>

<iframe name="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>