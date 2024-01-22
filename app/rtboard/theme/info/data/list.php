<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php
if ($env->_get['bcode']) {
	require_once RT_DOC_ROOT.$_def['path_app']."/theme/".$_bdinfo['theme']."/inc.common.menu.php";
}
?>

<!-- 리스트 -->
<form name="search_form" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="hidden" name="appcode" value="<?php echo $env->_get['appcode'];?>">
<input type="hidden" name="sd" value="<?php echo $env->_get['sd'];?>">
<input type="hidden" name="bcode" value="<?php echo $env->_get['bcode'];?>">
<div class="rt_search_wrap rt_tar">
	<div class="rt_button_wrap rt_fll">
		<select name="" id="bcode" onchange="document.move_form.bcode.value=$(this).val();">
			<option value="">게시판 선택</option>
			<?php 
			for ($m = 0 ; $m <count($_board_info) ; $m++) { 
				if ($_board_info[$m]['bcode'] != $env->_get['bcode']) { ?>
					<option value="<?php echo $_board_info[$m]['bcode'];?>"><? echo $_board_info[$m]['name'];?></option>
				<?php 
				}
			} ?>
		</select>
		<a href="javascript:select_move();" class="rt_btn_orange btn_s">선택 게시물 이동</a>
	</div>
	<select name="search">
		<option value="subject" <?php echo ($env->_get['search']=="subject")?"selected":"";?>>제목</option>
		<option value="content" <?php echo ($env->_get['search']=="content")?"selected":"";?>>본문</option>
		<option value="subjcont" <?php echo ($env->_get['search']=="subjcont")?"selected":"";?>>제목+본문</option>
		<option value="name" <?php echo ($env->_get['search']=="name")?"selected":"";?>>작성자</option>
	</select>
	<input type="text" value="<?php echo $env->_get['searchstring'];?>" name="searchstring" />
	<span class="rt_button_wrap"><a href="#;" id="btn-search" class="rt_btn_gray btn_s">검색</a></span>
</div>
</form>

<table class="rt_list_table">
	<caption> 게시판</caption>
	<colgroup>
		<col width="50px" />
		<col width="70px" />
		<?php if ($_conf['category_is'] == "y") { ?>
		<col width="150px" />
		<?php } ?>
		<?php if ($_conf['list_img_is'] == "y") { ?>
		<col width="70px" />
		<?php } ?>
		<col width="*" />
		<col width="140px" />
		<col width="120px" />
		<col width="70px" />
	</colgroup>
	<thead>
		<tr>
			<th><p><input type="checkbox" id="select_all" /></p></th>
			<th><p>번호</p></th>
			<?php if ($_conf['category_is'] == "y") { ?>
			<th><p>분류</p></th>
			<?php } ?>
			<?if ($_conf['list_img_is'] == "y") {?>
			<th><p>이미지</p></th>
			<?php } ?>
			<th><p>제목</p></th>
			<th><p>이름</p></th>
			<th><p>날짜</p></th>
			<th><p>조회</p></th>
		</tr>
	</thead>
	<tbody>
		<?php for ($i = 0; $i < count($_ntc); $i++) {?>
		<tr>
			<td><p><input type="checkbox" name="select_seq[]" class="select_post" value="<?php echo $_ntc[$i]['seq'];?>" /></p></td>
			<td><p><b>공지</b></p></td>
			<?if ($_conf['category_is'] == "y") {?>
			<td><p><b>공지</b></p></td>
			<?}?>
			<?if ($_conf['list_img_is'] == "y") {?>
			<td><p><img src="<?php echo $_ntc[$i]['list_img_src'];?>" style="width:50px;height:50px;" /></p></td>
			<?}?>
			<td class="rt_tal">
				<p>
					<a href="<?php echo $_ntc[$i]['viewpage'];?>"><?php echo $_ntc[$i]['subject'];?></a>
					<?php if ($_conf['comment_is'] == "y" && $_ntc[$i]['cmtcnt'] > 0) {?>
					<b>( <?php echo $_ntc[$i]['cmtcnt'];?> )</b>
					<?php }?>
					&nbsp;
					<?php echo $_ntc[$i]['file'];?> <?php echo $_ntc[$i]['new'];?>
				</p>
			</td>
			<td><p><?php echo $_ntc[$i]['name'];?></p></td>
			<td><p><?php echo $_ntc[$i]['reg_date'];?></p></td>
			<td><p><?php echo $_ntc[$i]['hits'];?></p></td>
		</tr>
		<?php }?>

		<?php
		if (!empty($_l)) {
			for ($i = 0; $i < count($_l); $i++) {
		?>
			<tr>
				<td><p><input type="checkbox" name="select_seq[]" class="select_post" value="<?php echo $_l[$i]['seq'];?>" /></p></td>
				<td><p><?php echo $_l[$i]['no'];?></p></td>
				<?if ($_conf['category_is'] == "y") {?>
				<td><p><?php echo $_l[$i]['category'];?></p></td>
				<?}?>
				<?if ($_conf['list_img_is'] == "y") {?>
				<td><p><img src="<?php echo $_l[$i]['list_img_src'];?>" style="width:50px;height:50px;" /></p></td>
				<?}?>
				<td class="rt_tal">
					<p>
						<a href="<?php echo $_l[$i]['viewpage'];?>"><?php echo ($_l[$i]['use_is'] == "n") ? "<span style='color:red'>[노출제한] </span>" : "";?><?php echo $_l[$i]['subject'];?></a>
						<?php if ($_conf['comment_is'] == "y" && $_l[$i]['cmtcnt'] > 0) {?>
						<b>( <?php echo $_l[$i]['cmtcnt'];?> )</b>
						<?php }?>
						&nbsp;
						<?php echo $_l[$i]['file'];?> <?php echo $_l[$i]['new'];?>
					</p>
				</td>
				<td><p><?php echo $_l[$i]['name'];?></p></td>
				<td><p><?php echo $_l[$i]['reg_date'];?></p></td>
				<td><p><?php echo $_l[$i]['hits'];?></p></td>
			</tr>
		<?php
			}
		} else {
		?>
			<tr>
				<td colspan="<?php echo $_no_data_colspan;?>" style="height:100px;"><p>데이터가 없습니다.</p></td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>

<div class="rt_button_wrap clearfix">
	<a href="javascript:select_delete();" class="rt_btn_red">선택삭제</a>
	<div class="rt_flr">
		<a href="<?php echo RTW_ADM;?>/app/?appcode=rtboard&sd=theme-info-data&cf=form&bcode=<?php echo $env->_get['bcode'];?>" class="rt_btn_blue">글 쓰기</a>
	</div>
</div>

<?php echo $cls_board->put_page_num($_SERVER['PHP_SELF'])?>

<form name="delete_form" method="post" action="<?php echo $_def['path_app'];?>/<?php echo $__sd;?>/update.php" method="post" target="rt_ifrm">
	<input type="hidden" name="mode" value="select_delete">
	<input type="hidden" name="seqstr" value="">
	<input type="hidden" name="pg" value="<?php echo $env->_get['pg'];?>">
	<input type="hidden" name="search" value="<?php echo $env->_get['search'];?>">
	<input type="hidden" name="searchstring" value="<?php echo $env->_get['searchstring'];?>">
</form>

<form name="move_form" method="post" action="<?php echo $_def['path_app'];?>/<?php echo $__sd;?>/update.php" method="post" target="rt_ifrm">
	<input type="hidden" name="mode" value="select_move">
	<input type="hidden" name="bcode" value="">
	<input type="hidden" name="seqstr" value="">
	<input type="hidden" name="pg" value="<?php echo $env->_get['pg'];?>">
	<input type="hidden" name="search" value="<?php echo $env->_get['search'];?>">
	<input type="hidden" name="searchstring" value="<?php echo $env->_get['searchstring'];?>">
</form>

<script src="<?php echo $_def['path_section'];?>/js/rtboard.theme.info.data.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>