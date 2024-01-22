<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="data_form" action="<?php echo $__sc;?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="<?php echo $__cfg['mode'];?>">
<input type="hidden" name="app_seq" value="<?php echo $env->_get['app_seq'];?>">
<table class="rt_data_table">
	<caption>APP추가</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>APP 이름</p></th>
			<td>
				<input type="text" class="required" value="<?php echo $_r['app_name'];?>" name="app_name" msg="APP명을 정확히 입력해 주세요" />
			</td>
		</tr>
		<tr>
			<th><p>APP 코드</p></th>
			<td>
				<input type="text" class="required" value="<?php echo $_r['app_code'];?>" name="app_code" msg="APP코드를 정확히 입력해 주세요" />
			</td>
		</tr>
		<tr>
			<th><p>업로드 위치</p></th>
			<td>
				<input type="text" class="required" value="<?php echo $_r['app_path'];?>" name="app_path" msg="APP 업로드 경로를 정확히 입려해 주세요" />
			</td>
		</tr>
		<tr>
			<th><p>버전</p></th>
			<td>
				<input type="text" value="<?php echo $_r['app_version'];?>" name="app_version" />
			</td>
		</tr>
		<tr>
			<th><p>개발자</p></th>
			<td>
				<input type="text" value="<?php echo $_r['app_dever'];?>" name="app_dever" />
			</td>
		</tr>
		<tr>
			<th><p>사용여부</p></th>
			<td>
				<p>
					<label><input name="app_plug_en" value="on" type="radio" <?php echo $app_plug_en_on;?>>사용함</label>
					<label><input name="app_plug_en" value="off" type="radio" <?php echo $app_plug_en_off;?>>사용하지 않음</label>
				</p>
			</td>
		</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar">
	<?php if ($__cfg['mode'] == "modify") { ?>
	<a href="#;" class="rt_btn_red" id="btn-delete">APP 삭제</a>
	<?php } ?>
	<a href="#;" class="rt_btn_blue" id="btn-submit">정보 등록</a>
	<a href="#;" class="rt_btn_gray" id="btn-move-list">목록 가기</a>
</div>

<script src="assets/js/appsetup.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>