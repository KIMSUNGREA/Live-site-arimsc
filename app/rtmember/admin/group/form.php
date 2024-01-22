<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<form name="data_form" action="<?=$_def['path_app']."/".$__sd?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="<?=$__cfg['mode']?>">
<input type="hidden" name="grp_seq" value="<?=$_r['grp_seq']?>">
<table class="rt_field_table mb10">
	<caption>회원목록 폼</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tr>
		<th><p>그룹 명</p></th>
		<td>
			<input type="text" class="rt_input_txt required" value="<?php echo $_r['grp_name'];?>" name="grp_name" msg="그룹명을 입력해 주세요" />
		</td>
	</tr>
</table>
</form>

<div class="rt_button_wrap rt_tar">
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">정보 변경</a>
	<a href="#;" id="btn-list" class="rt_btn_gray">목록 가기</a>
</div>

<script src="<?php echo $_def['path_assets'];?>/js/rtmember.admin.group.js" type="text/javascript"></script>

<iframe name="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>