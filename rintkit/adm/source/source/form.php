<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="data_form" action="<?php echo $__sc;?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="modify">
<input type="hidden" name="seq" value="<?php echo $env->_get['seq']?>">
<table class="rt_data_table">
	<caption>스크립트 관리</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>소스 명</p></th>
			<td>
				<input type="text" class="rt_input_txt required" value="<?php echo $_r['name'];?>" name="s_name" msg="소스명을 입력해 주세요" />
			</td>
		</tr>
		<tr>
			<th><p>사용여부</p></th>
			<td>
				<label><input name="use_en" value="y" type="radio" <?php echo $use_en_y;?>> 사용</label>
				<label><input name="use_en" value="n" type="radio" <?php echo $use_en_n;?>> 사용안함</label>
			</td>
		</tr>
		<tr>
			<th><p>소스 데이터</p></th>
			<td>
				<textarea name="source" style="height:150px;"><?php echo stripslashes($_r['source']);?></textarea>
			</td>
		</tr>
		<tr>
			<th><p>설치소스</p></th>
			<td>&lt;?php rt_source(<?php echo $_r['seq'];?>);?></td>
		</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar mb25">
	<a href="javascript:source_delete(<?php echo $_r['seq'];?>);" class="rt_btn_red">소스 삭제</a>
	<a href="#;" id="btn-list" class="rt_btn_gray">목록 가기</a>
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">정보 변경</a>
</div>

<script src="assets/js/rt.adm.source.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>