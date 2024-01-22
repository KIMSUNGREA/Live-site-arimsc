<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>
<style>
	.rt_data_table tbody tr td a {display: inline-block; width: 60px; text-align: center; height: 33px; line-height: 33px; background-color: #666; color: #fff; border-radius:5px;}
	.rt_data_table tbody tr td #address1 {width: auto; min-width:300px;}
	.rt_data_table tbody tr td .edu-date-1,
	.rt_data_table tbody tr td .edu-date-2,
	.rt_data_table tbody tr td .edu-date-3,
	.rt_data_table tbody tr td .edu-date-4,
	.rt_data_table tbody tr td .edu-date-5 {width: auto;}
</style>
<form name="dataform" action="<?php echo $__sc?>/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?php echo $__cfg['mode'];?>">
<input type="hidden" name="seq" value="<?php echo $env->_get['seq'];?>">

<table class="rt_data_table">
	<caption>등록</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th>문구1</th>
			<td>
				<input type="text" name="title" class="required" msg="문구1을 입력해주세요." value="<?php echo $_r['title'];?>">
			</td>
		</tr>
		<tr>
			<th>문구2</th>
			<td>
				<input type="text" name="title2" class="required" msg="문구를 입력해주세요." value="<?php echo $_r['title2'];?>">
			</td>
		</tr>
		<tr>
			<th>링크URL</th>
			<td>
				<input type="text" name="link_url" class="required" msg="URL을 입력해주세요." value="<?php echo $_r['link_url'];?>">
			</td>
		</tr>
		<tr>
			<th>이미지</th>
			<td>
				<input type="file" name="file1">
				<?php if ($_r['file1_new']) {?>
				<img src="<?php echo $_r['file_subdir'];?>/<?php echo $_r['file1_new'];?>" style="max-width:200px;">
				<a href="javascript:img_delete(<?php echo $_r['seq'];?>, 1)" class="rt_btn_red"> 삭제 </a>
				<?php } ?>
			</td>
		</tr>
	</tbody>
</table>
</form>


<div class="rt_button_wrap rt_tar mb25">
	<?php if ($__cfg['mode'] == "insert") {?>
	<a href="#;" id="btn-submit" class="rt_btn_blue">등록</a>
	<?php } else { ?>
	<a href="#;" id="btn-submit" class="rt_btn_blue">정보 변경</a>
	<a href="#;" class="rt_btn_red" style="background-color:red;color:#fff;" onclick="btn_delete(<?php echo $_r['seq'];?>);">삭제</a>
	<?php } ?>
	<a href="#;" id="btn-move-list" class="rt_btn_gray">목록 가기</a>
</div>

<form name="delete_form" method="post" action="<?php echo $__sc?>/update.php" method="post" target="rt_ifrm">
	<input type="hidden" name="mode" value="select_delete">
	<input type="hidden" name="seq" value="">
</form>

<script type="text/javascript">
function img_delete(seq,num) {
	if (confirm("이미지를 삭제하시겠습니까?")) {
		$("#rt_ifrm").attr("src","/rintkit/adm/review/post/update.php?mode=imgdel&seq="+seq+"&num="+num);
	}
}

function btn_delete(val) {

	var form = document.delete_form;

	if (confirm("삭제된 데이터는 복구할 수 없습니다. 삭제하시겠습니까?"))
	{
		form.seq.value=val;
		form.submit();
	}
}
;(function($) {
	$(function() {

		var form = document.dataform;
		var path_cur_pos = rt_path['adm']+"/"+rt_layout['dr'];

		$("#btn-move-list").click(function (){
			location.href = path_cur_pos+"/?sd=post&cf=list";
		});

		$("#btn-submit").click(function (){
			if (rt_chk_form('required')) {
				form.submit();
			}
		});
	});
})(jQuery);
</script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>