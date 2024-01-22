<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<div class="rt_search_wrap">
	<select class="rt_w250" name="bcode" onchange="location.href='?appcode=rtboard&sd=admin-comment&bcode='+$(this).val()">
		<option value="">전체 게시판</option>
		<?php for ($m = 0; $m < count($_b); $m++) { ?>
		<option value="<?php echo $_b[$m]['bcode'];?>" <?php echo ($_b[$m]['bcode']==$env->_get['bcode'])?"selected":"";?>><?php echo $_b[$m]['name'];?></option>
		<?php } ?>
	</select>
</div>

<div class="rt_reply_comment_area mb25">
<?php if (count($cmt) > 0) { ?>
	<?php for ($m = 0; $m < count($cmt); $m++) { ?>
	<?php if ($cmt[$m]['re_level'] > 0) {?> 
	<div class="rt_reply_re_wrap">
	<?php } else { ?>
	<div class="rt_reply_comment_wrap">
	<?php } ?>
		<div class="rt_reply_comment_hd clearfix">
			<?php if ($cmt[$m]['re_level'] > 0) {?> 
			<img src="<?php echo $_def['path_assets'];?>/img/reply_comment_ico.png" alt="화살표" class="reply_comment_ico">
			<?php } else { ?>
			<span class="rt_bold mr0"><?php echo $board_name[$cmt[$m]['bcode']];?></span>
			<span class="rt_bar"></span>
			<?php } ?>
			<span>이름 : <?php echo $cmt[$m]['name'];?></span>
			<span>날짜 : <?php echo $cmt[$m]['reg_date'];?></span>
			<div class="rt_button_wrap rt_tar">
				<?php if ($cmt[$m]['re_level'] < 1) {?> 
				<a href="#;" class="rt_btn_blue btn_in rt_reply_comment">답글</a>
				<?php } ?>
				<a href="javascript:cmt_delete('<?php echo $cmt[$m]['seq'];?>');" class="rt_btn_red btn_in">삭제</a>
				<a href="<?php echo RTW_ADM;?>/app/?appcode=rtboard&sd=theme-<?php echo $board_theme[$cmt[$m]['bcode']];?>-data&cf=view&bcode=<?php echo $cmt[$m]['bcode'];?>&seq=<?php echo $cmt[$m]['post_seq'];?>" class="rt_btn_gray btn_in">게시물보기</a>
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
<?php } else { ?>
	<div style="height:200px;text-align:center;background-color:#fafafa;padding:90px;">
	등록된 댓글이 없습니다.
	</div>
<?php } ?>
</div>

<?php
if ($cmt) {
	echo $cls_cmt->comment_page_num($_SERVER['PHP_SELF']);
}
?>
<br />
<div class="rt_bot_box">
	<h1>이용안내</h1>
	<p><em>-</em>댓글을 클릭하면 <span class="rt_mint">해당 게시판의 게시물로 이동</span>합니다.</p>
</div>

<script src="<?php echo $_def['path_section'];?>/js/rtboard.admin.comment.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>