
function cmt_delete(seq) {
	if (confirm("이 댓글을 삭제하시겠습니까?")) {
		$("#rt_ifrm").attr("src",rt_path['app']+"/admin/comment/update.php?mode=cmt_delete&seq="+seq);
	}
}

;(function($) {
	$(function() {

		$('.rt_reply_comment').click(function(){
			$(this).parents().siblings('.rt_reply_comment_wrap').children('.rt_reply_comment_form').slideUp();
			$(this).parents().siblings('.rt_reply_comment_form').slideToggle();
		});
	});
})(jQuery);