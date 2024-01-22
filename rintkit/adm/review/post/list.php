<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<!-- 리스트 -->
<form name="search_form" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="hidden" name="sd" value="<?php echo $env->_get['sd'];?>">
<input type="hidden" name="cf" value="<?php echo $env->_get['cf'];?>">
<div class="rt_search_wrap rt_tar">
	<select name="search">
		<option value="title" <?php echo ($env->_get['search']=="title")?"selected":"";?>>문구1</option>
	</select>
	<input type="text" value="<?php echo $env->_get['searchstring'];?>" name="searchstring" />
	<span class="rt_button_wrap"><a href="#;" id="btn-search" class="rt_btn_gray btn_s">검색</a></span>
</div>
</form>


<table class="rt_list_table">
	<caption> 게시판</caption>
	<colgroup>
		<col width="10%" />
		<!-- <col width="10%" /> -->
		<col width="15%" />
		<col width="" />
		<col width="15%" />
	</colgroup>
	<thead>
		<tr>
			<th><p>번호</p></th>
			<!-- <th><p>출력순서</p></th> -->
			<th><p>이미지</p></th>
			<th><p>문구</p></th>
			<th><p>관리</p></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$_url = RTW_ADM."/".$__dr;
		$num = $cls_board->list_rec_cnt;
		$_l = $cls_board->get_list("ord ASC");
		if (!empty($_l)) {
			for ($i = 0; $i < count($_l); $i++) {
		?>
			<tr>
				<td><p><?php echo $num;?></p></td>
				<!-- <td><p>
					<input type="text" onblur="chgord(<?php echo $_l[$i]['seq'];?>,this.value);" style="width:50px;height:24px;text-align:center;border:1px solid #ccc;" value="<?php echo $_l[$i]['ord'];?>">
				</p></td> -->
				<td>
					<a href="<?php echo $_url;?>/?sd=post&cf=form&seq=<?php echo $_l[$i]['seq'];?><?php echo $add_sch_url;?>">
					<?php
					if ($_l[$i]['file1_new']) {
						?><img src="<?php echo $_l[$i]['file_subdir'];?>/<?php echo $_l[$i]['file1_new'];?>" style="max-width:60px;" /><?
					} else {
						?><img src="/assets/images/no_cont.png" style="max-width:60px;" /><?
					}
					?>
					</a>
				</td>
				<td class="rt_tal">
					<p><a href="<?php echo $_url;?>/?sd=post&cf=form&seq=<?php echo $_l[$i]['seq'];?>"><b><?php echo $_l[$i]['title'];?></b></a></p><br>
					<p><a href="<?php echo $_url;?>/?sd=post&cf=form&seq=<?php echo $_l[$i]['seq'];?>"><?php echo $_l[$i]['title2'];?></a></p>
				</td>
				<td>
					<p>
						<div class="rt_button_wrap">
							<a href="<?php echo $_url;?>/?sd=post&cf=form&seq=<?php echo $_l[$i]['seq'];?>" class="rt_btn_blue" style="padding:5px 10px;">수정</a>
							<a href="#;" class="rt_btn_red" onclick="btn_delete(<?php echo $_l[$i]['seq'];?>);" style="padding:5px 10px;">삭제</a>
						</div>
					</p>
				</td>
			</tr>
		<?php
				$num--;
			}
		} else {
		?>
			<tr>
				<td colspan="3" style="height:100px;"><p>데이터가 없습니다.</p></td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>

<div class="rt_button_wrap clearfix rt_tar">
	<a href="<?php echo $_url;?>/?sd=post&cf=form" class="rt_btn_blue" target="">신규 등록</a>
</div>

<?php echo $cls_board->put_page_num($_SERVER['PHP_SELF'])?>

<form name="move_form" method="post" action="<?php echo $__sc?>/update.php" method="post" target="rt_ifrm">
	<input type="hidden" name="mode" value="select_move">
	<input type="hidden" name="category" value="">
	<input type="hidden" name="seqstr" value="">
	<input type="hidden" name="pg" value="<?php echo $env->_get['pg'];?>">
	<input type="hidden" name="search" value="<?php echo $env->_get['search'];?>">
	<input type="hidden" name="searchstring" value="<?php echo $env->_get['searchstring'];?>">
</form>

<form name="delete_form" method="post" action="<?php echo $__sc?>/update.php" method="post" target="rt_ifrm">
	<input type="hidden" name="mode" value="select_delete">
	<input type="hidden" name="seq" value="">
</form>

<script>
function btn_delete(val) {

	var form = document.delete_form;

	if (confirm("삭제된 데이터는 복구할 수 없습니다. 삭제하시겠습니까?"))
	{
		form.seq.value=val;
		form.submit();
	}
}

function chgord(seq, val) {

	$.ajax({
		url: "/rintkit/adm/review/post/update.php",
		type: "POST",
		data: {'mode':'ordup', 'seq':seq, 'val':val},
		success: function(data){
			eval(data);
			if (nchk == "OK") {
				//location.reload();
			}
		}
	});
}

;(function($) {
	$(function() {

		$("#btn-search").click(function () {
			document.search_form.submit();
		});
	});
})(jQuery);
</script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>
