
function cmt_on_delete_form(seq) {

	var obj1 = $("#li_pwd_"+seq);
	var obj2 = $("#ul_reply_"+seq);

	(obj1.css("display") == "none") ? obj1.show() : obj1.hide();

	obj2.hide();
}

function cmt_on_reply_form(seq) {

	var obj1 = $("#li_pwd_"+seq);
	var obj2 = $("#ul_reply_"+seq);

	(obj2.css("display") == "none") ? obj2.show() : obj2.hide();

	obj1.hide();
}

function cmt_my_delete(seq) {

	var f = document.cmt_use_form;

	if (confirm("내 댓글을 삭제하시겠습니까?")) {
		f.mode.value = "cmt_delete";
		f.seq.value = seq;
		f.submit();
	}
}

function cmt_delete(seq) {

	var f = document.cmt_use_form;
	var pwd = $("#del_pwd_"+seq).val();

	if (pwd == "") {
		alert("패스워드를 입력해 주세요");
		$("#del_pwd_"+seq).focus();
	} else {
		if (confirm("댓글을 삭제하시겠습니까?")) {
			f.mode.value = "cmt_delete";
			f.seq.value = seq;
			f.pwd.value = pwd;
			f.submit();
		}
	}
}

function cmt_delete_area(seq) {

	if ($("#delform-"+seq).css("display")=="none") {
		$("#delform-"+seq).show();
	} else {
		$("#delform-"+seq).hide();
	}
}

function cmt_view_input_area(seq,part) {

	var f = document.cmt_use_form;

	if ($("#addform-"+seq).css("display")=="none") {
		$(".rs_member_answer_list .rs_member_answer_w").hide();
		$("#content_"+seq).val("");
		if (part == "reply") {
			f.mode.value = "cmt_reply";
			$("#addform-title-"+seq).text("답글쓰기");
		} else if (part == "modify") {
			f.mode.value = "cmt_modify";
			$("#content_"+seq).val($("#content-view-"+seq).text());
			$("#addform-title-"+seq).text("수정하기");
		}
		$("#addform-"+seq).show();
	} else {
		$("#addform-"+seq).hide();
	}
}

function cmt_submit(seq) {

	var f = document.cmt_use_form;
	var name = $("#name_"+seq).val();
	var pwd = $("#pwd_"+seq).val();

	var content = $("#content_"+seq).val();

	f.mode.value = "cmt_reply";
	
	if (name == "") {
		alert("작성자를 입력해 주세요");
		$("#name_"+seq).focus();
	} else if (pwd == "") {
		alert("패스워드를 입력해 주세요");
		$("#pwd_"+seq).focus();
	} else if (content == "") {
		alert("댓글을 입력해 주세요");
		$("#content_"+seq).focus();
	} else {
		f.seq.value = seq;
		f.name.value = name;
		f.pwd.value = pwd;
		f.content.value = content;
		f.submit();
	}
}

;(function($) {
	$(function() {

		$("#rt-view-con img").hide();

		$("#rt-view-con img").each(function (){
			var width = $(this).width();
			if(width > 350){
				$(this).attr("width","100%").show();
			} else {
				$(this).show();
			}
		});

		$("#btn-list").click(function () {

			var form = document.data_form;
			var pg = form.pg.value;
			var ct = form.ct.value;
			var pcd = form.pcd.value;
			var screen = form.screen.value;
			var search = form.search.value;
			var searchstring = form.searchstring.value;

			//URL 세팅
			var getqry = "";
			var qryarr = Array();
			if (pg) {qryarr['pg'] = "pg="+pg;}
			if (ct) {qryarr['ct'] = "ct="+ct;}
			if (pcd) {qryarr['pcd'] = "pcd="+pcd;}
			if (screen) {qryarr['screen'] = "screen="+screen;}
			if (searchstring) {qryarr['search'] = "search="+searchstring;}

			getqry = js_implode("&", qryarr);

			location.href = "?"+getqry;

		}).css("cursor","pointer");

		$("#btn-cmt-submit").click(function (){
			var form = document.cmt_insert_form;

			if(rt_chk_form('required')){
				form.submit();
			}
		});

		$('.faq_toggle .toggle-trigger').click(function(){
			$(this).next().slideToggle();
			$(this).parent().siblings().children().last().slideUp();
		})

		$('.rt-rwd-reply-comment,.rt-reply-comment').click(function(){
			$(this).parent().siblings().children('.rt-rwd-reply-toggle,.rt-reply-toggle').slideUp();
			$(this).next().slideToggle();
		});
		$('.rt-rwd-reply-delete,.rt-reply-delete').click(function(){
			var showCon = $(this).parent().next('.rt-rwd-reply-delete-password-wrap,.rt-reply-delete-password-wrap').css('display');
			if(showCon == 'block'){
				$('.rt-rwd-reply-delete-password-wrap,.rt-reply-delete-password-wrap').slideUp();
			}else {
				$('.rt-rwd-reply-delete-password-wrap,.rt-reply-delete-password-wrap').slideUp();
				$(this).parent().next('.rt-rwd-reply-delete-password-wrap,.rt-reply-delete-password-wrap').slideDown();
			}
		});
		$('.rt-rwd-reply-delete-password-cancle,.rt-reply-delete-password-cancle').click(function(){
			$('.rt-rwd-reply-delete-password-wrap,.rt-reply-delete-password-wrap').slideUp();
		});
		$('.rt-rwd-list-con .rt-rwd-list-subject').each(function(){
			var img_chk = $(this).find('.rt-rwd-thumb').css('display');
			var img_h = $(this).find('.rt-rwd-thumb').css('height');
			if (img_chk == "inline"){
				$(this).css({
					'height':img_h,
					'overflow':'hidden'
				});
				$(this).find('a').css({
					'display':'inline-block',
					'line-height':img_h
				});
			}
		});
		$(document).ready(function(){
			var imgChk = $('.rt-rwd-list-subject a img').css('display');
			if(imgChk == 'inline'){
				$('.rt-rwd-list-subject').css(
					'max-height','9999px'
				)
			}
		});
	});
})(jQuery);