<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="data_form" action="<?php echo $__sc?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="<?php echo $__cfg['mode']?>">
<input type="hidden" name="grp_seq" value="<?php echo $_r['grp_seq']?>">
<table class="rt_data_table">
	<caption>콘텐츠 그룹관리</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>그룹 명</p></th>
			<td>
				<input type="text" class="rt_input_txt required" value="<?php echo $_r['grp_name'];?>" name="grp_name" msg="그룹명을 입력해 주세요" />
			</td>
		</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar mb25">
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">정보 변경</a>
	<a href="#;" id="btn-list" class="rt_btn_gray">목록 가기</a>
</div>

<div class="rt_bot_box">
	<h1>이용안내</h1>
	<p><em>-</em><span class="rt_mint">기본 그룹</span>은 삭제되지 않습니다.</p>
</div>

<script src="assets/js/group.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>