<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php
if ($env->_get['bcode']) {
	require_once RT_DOC_ROOT.$_def['path_app']."/theme/".$_bdinfo['theme']."/inc.common.menu.php";
}
?>

<form name="data_form">
<input type="hidden" name="bcode" value="<?php echo $env->_get['bcode'];?>">
<input type="hidden" name="seq" value="<?php echo $r['seq'];?>">
<input type="hidden" name="pg" value="<?php echo $env->_get['pg'];?>">
<input type="hidden" name="search" value="<?php echo $env->_get['search'];?>">
<input type="hidden" name="searchstring" value="<?php echo $env->_get['searchstring'];?>">
<table class="rt_data_table">
<caption>게시물 상세보기</caption>
<colgroup>
	<col style="width:15%"/>
	<col style="width:85%"/>
</colgroup>
	<tbody>
	<?php if ($_conf['category_is'] == "y" && $r['notice_is'] == "n") { ?>
	<tr>
		<th><p>글 분류</p></th>
		<td><p><?php echo $r['category'];?></p></td>
	</tr>
	<?php } ?>
	<tr>
		<th><p>이름</p></th>
		<td><p><?php echo $r['name'];?></p></td>
	</tr>
	<?php for ($m = 0; $m < count($_fset); $m++) { ?>
	<tr>
		<th><p><?php echo $_fset[$m]['name'];?></p></th>
		<td><p><?php echo stripslashes($cls_board->formset_data($_fset[$m], $sz));?></p></td>
	</tr>
	<?php }?>
	<tr>
		<th><p>제목</p></th>
		<td><p><?php echo $r['subject'];?></p></td>
	</tr>
	<tr>
		<th><p>내용</p></th>
		<td class="rt_substance">
			<?php if ($_conf['list_img_is'] == "y" && $r['list_img_cont_is'] == "y") {?>
			<p><img src="<?php echo $r['list_img_dir'];?><?php echo $r['list_img_new'];?>" style="max-width:1000px;" alt=""></p>
			<?php } ?>
			<?php
			if (count($attc_arr) > 0) {
				for ($m = 0; $m < count($attc_arr); $m++) {
					if (rt_is_image($attc_arr[$m]['file_new'],$attc_arr[$m]['path_base'].$attc_arr[$m]['path_sub'])) {
					?>
					<p><img src="<?php echo $attc_arr[$m]['path_base'].$attc_arr[$m]['path_sub'].$attc_arr[$m]['file_new'];?>" style="max-width:1000px;" alt=""></p>
					<?php
					}
				}
			}?>
			<p><?php echo $r['content'];?></p>
		</td>
	</tr>
	<?php if ($_conf['list_img_is'] == "y") { ?>
	<tr>
		<th><p>대표(목록) 이미지</p></th>
		<td><p><img src="<?php echo $r['list_img_src'];?>" style="width:100px;" /></p></td>
	</tr>
	<?php }?>
	<?php
	if (count($attc_arr) > 0) {
		for ($m = 0; $m < count($attc_arr); $m++) {
			if (!empty($attc_arr[$m]['file_ori'])) {
				$filesize = rt_get_file_unit_format($attc_arr[$m]['file_size']);
		?>
	<tr>
		<th><p>첨부다운</p></th>
		<td>
			<p><a href="<?php echo $_def['path_theme'];?>/data/download.php?mode=download&bcode=<?php echo $env->_get['bcode'];?>&seq=<?php echo $r['seq'];?>&file_num=<?php echo $attc_arr[$m]['file_num'];?>" target="rt_ifrm" class="mt10"><?php echo $attc_arr[$m]['file_ori'];?> (<?php echo $filesize?>)</a></p>
			<p class="rt_button_wrap">
				<a href="<?php echo $_def['path_theme'];?>/data/download.php?mode=download&bcode=<?php echo $env->_get['bcode'];?>&seq=<?php echo $r['seq'];?>&file_num=<?php echo $attc_arr[$m]['file_num'];?>" class="rt_btn_blue btn_in" target="rt_ifrm">다운로드</a>
			</p>
		</td>
	</tr>
			<?php
			}
		}
	}?>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar mb25">
	<a href="#;" id="btn-delete" class="rt_btn_red">글 삭제</a>
	<a href="#;" id="btn-modify" class="rt_btn_blue">글 수정</a>
	<a href="#;" id="btn-list" class="rt_btn_gray">목록가기</a>
</div>

<?php if ($_conf['comment_is'] == "y") {?>
<form name="cmt_insert_form" method="post" action="<?php echo $_def['path_app'];?>/<?php echo $__sd?>/update.php" target="rt_ifrm">
<input type="hidden" name="mode" value="cmt_insert">
<input type="hidden" name="post_seq" value="<?php echo $r['seq'];?>">
<input type="hidden" name="bcode" value="<?php echo $env->_get['bcode'];?>">
<table class="rt_reply_table mb10">
	<caption>댓글 등록</caption>
	<colgroup>
		<col width="115px"/>
		<col width="*"/>
	</colgroup>
	<thead>
		<tr>
			<th colspan="2">
				<p><img src="<?php echo $_def['path_assets'];?>/img/reply_ico.png" alt="댓글아이콘" />댓글</p>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th><p>이름</p></th>
			<td><input type="text" class="rt_w250 cmt_ins_required" value="<?php echo $_conf['default_name'];?>" name="name" msg="이름을 입력해 주세요" /></td>
		</tr>
		<tr>
			<th><p>내용</p></th>
			<td>
				<textarea name="content" class="cmt_ins_required" style="height:80px;" msg="내용을 입력해 주세요"></textarea>
				<div class="rt_button_wrap rt_tar">
					<a href="#;" id="btn-cmt-submit" class="rt_btn_blue btn_in">댓글 등록</a>
				</div>
			</td>
		</tr>
	</tbody>
</table>
</form>

<?php if ($cmt) {?>
<div class="rt_reply_comment_area mb25">
	<?php for ($m = 0; $m < count($cmt); $m++) { ?>
	<?php if ($cmt[$m]['re_level'] > 0) {?> 
	<div class="rt_reply_re_wrap">
	<?php } else { ?>
	<div class="rt_reply_comment_wrap">
	<?php } ?>
		<div class="rt_reply_comment_hd clearfix">
			<?php if ($cmt[$m]['re_level'] > 0) {?> 
			<img src="<?php echo $_def['path_assets'];?>/img/reply_comment_ico.png" alt="화살표" class="reply_comment_ico">
			<?php } ?>
			<span>이름 : <?php echo $cmt[$m]['name'];?></span>
			<span>날짜 : <?php echo $cmt[$m]['reg_date'];?></span>
			<div class="rt_button_wrap rt_tar">
				<?php if ($cmt[$m]['re_level'] < 1) {?> 
				<a href="#;" class="rt_btn_blue btn_in rt_reply_comment">답글</a>
				<?php } ?>
				<a href="javascript:cmt_delete('<?php echo $cmt[$m]['seq'];?>');" class="rt_btn_red btn_in">삭제</a>
			</div>
		</div>
		<div class="rt_reply_comment_body">
			<p><?php echo $cmt[$m]['content'];?></p>
		</div>
		<div class="rt_reply_comment_form">
			<form name="cmt_reply_form<?php echo $cmt[$m]['seq'];?>" method="post" action="<?php echo $_def['path_app'];?>/<?php echo $__sd;?>/update.php" target="rt_ifrm">
			<input type="hidden" name="mode" value="cmt_reply">
			<input type="hidden" name="seq" value="<?php echo $cmt[$m]['seq'];?>">
			<input type="hidden" name="bcode" value="<?php echo $cmt[$m]['bcode'];?>">
			<input type="hidden" name="post_seq" value="<?php echo $cmt[$m]['post_seq'];?>">
			<table class="rt_reply_table">
				<caption>댓글 등록</caption>
				<colgroup>
					<col width="115px">
					<col width="*">
				</colgroup>
				<tbody>
					<tr>
						<th><p><img src="<?php echo $_def['path_assets'];?>/img/reply_comment_ico.png" alt="화살표" class="reply_comment_ico">이름</p></th>
						<td><input type="text" class="rt_w250 required" value="<?php echo $_conf['default_name'];?>" name="name" msg="이름을 입력해 주세요" /></td>
					</tr>
					<tr>
						<th><p>내용</p></th>
						<td>
							<textarea name="content" class="required" msg="내용을 입력해 주세요"></textarea>
							<div class="rt_button_wrap rt_tar">
								<a href="javascript:document.cmt_reply_form<?php echo $cmt[$m]['seq'];?>.submit();" class="rt_btn_blue btn_in">댓글 등록</a>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			</form>
		</div>
	</div>
	<?php } ?>
</div>
<?php } else { ?>
<div style="width:100%;height:100px;background-color:#fafafa;text-align:center;padding-top:40px;">등록된 댓글이 없습니다.</div>
<?php } ?>
<?php
if ($cmt) {
	echo $cls_cmt->comment_page_num($_SERVER['PHP_SELF']);
}
?>

<?php } ?>

<script src="<?php echo $_def['path_section'];?>/js/rtboard.theme.info.data.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>