
function select_delete() {

	var form = document.delete_form;
	var seqstr = "";
	var cnt = 0;

	$(".select_post").each(function () {

		if ($(this).is(":checked") == true) {
			seqstr+= $(this).val() + "/";
			cnt++;
		}
	});

	if (cnt < 1) {
		alert("삭제할 게시물을 한 개 이상 선택해 주세요");
	} else {
		if (confirm("선택한 데이터를 삭제하시겠습니까?")) {
			form.seqstr.value = seqstr;
			form.submit();
		}
	}
}

function select_move() {

	var form = document.move_form;
	var seqstr = "";
	var cnt = 0;

	$(".select_post").each(function () {

		if ($(this).is(":checked") == true) {
			seqstr+= $(this).val() + "/";
			cnt++;
		}
	});
	if (form.bcode.value != "") {
		if (cnt < 1) {
			alert("이동할 게시물을 한 개 이상 선택해 주세요");
		} else {
			if (confirm("선택한 데이터를 이동하시겠습니까?")) {
				form.seqstr.value = seqstr;
				form.submit();
			}
		}
	} else {
		alert ("이동할 게시판을 선택해 주세요.");
		$('#bcode').focus();
	}
}

function cmt_delete(seq) {

	if (confirm("이 댓글을 삭제하시겠습니까?")) {
		$("#rt_ifrm").attr("src",rt_path['app']+"/theme/qna/data/update.php?mode=cmt_delete&seq="+seq);
	}
}

function formtpl_apply(seq, formid) {
	$.ajax({
		url: rt_path['app']+"/admin/formtpl/update.php",
		type: "POST",
		data: {'mode':'gettpl','seq':seq},
		success: function(data) {
			se2_paste_html(formid, data);
		}
	});
}

;(function($) {
	$(function() {

		$("#select_all").click(function (){

			if ($(this).is(":checked") == true) {
				$(".select_post").attr("checked",true);
			} else {
				$(".select_post").attr("checked",false);
			}
		});

		$("#btn-cmt-reply").click(function (){

			var form = document.cmt_reply_form;
			if (form.name.value == "") {
				alert("작성자명을 입력해 주세요");
				form.name.focus();
			} else if (form.content.value == "") {
				alert("댓글내용을 입력해 주세요");
				form.content.focus();
			} else {
				form.submit();
				$("#comment_reply").bPopup().close();
			}
		});

		$("#btn-tpl").click(function (){
			if ($("#area-tpl").css("display")=="none") {
				$("#area-tpl").slideDown(200);
			} else {
				$("#area-tpl").slideUp(200);
			}
		});

		$("#btn-search").click(function (){
			document.search_form.submit();
		});

		$("#btn-list").click(function (){
			var form = document.data_form;
			var bcode = form.bcode.value;
			var pg = form.pg.value;

			var schurl = "";
			if (form.searchstring.value != "") {
				schurl+= "&search="+form.search.value+"&searchstring="+form.searchstring.value;
			}
			location.href = rt_path['adm']+"/app/?appcode=rtboard&sd=theme-qna-data&bcode="+bcode+"&pg="+pg+schurl;
		});

		$("#btn-modify").click(function (){
			var form = document.data_form;
			var bcode = form.bcode.value;
			var seq = form.seq.value;
			var pg = form.pg.value;

			var schurl = "";
			if (form.searchstring.value != "") {
				schurl+= "&search="+form.search.value+"&searchstring="+form.searchstring.value;
			}
			location.href = rt_path['adm']+"/app/?appcode=rtboard&sd=theme-qna-data&cf=form&bcode="+bcode+"&seq="+seq+"&pg="+pg+schurl;
		});

		$("#btn-view").click(function (){
			var form = document.data_form;
			var bcode = form.bcode.value;
			var seq = form.seq.value;
			var pg = form.pg.value;

			var schurl = "";
			if (form.searchstring.value != "") {
				schurl+= "&search="+form.search.value+"&searchstring="+form.searchstring.value;
			}
			location.href = rt_path['adm']+"/app/?appcode=rtboard&sd=theme-qna-data&cf=view&bcode="+bcode+"&seq="+seq+"&pg="+pg+schurl;
		});

		$("#btn-reply-form").click(function (){
			var form = document.data_form;
			var bcode = form.bcode.value;
			var seq = form.seq.value;
			var pg = form.pg.value;

			var schurl = "";
			if (form.searchstring.value != "") {
				schurl+= "&search="+form.search.value+"&searchstring="+form.searchstring.value;
			}
			location.href = rt_path['adm']+"/app/?appcode=rtboard&sd=theme-qna-data&cf=reply&bcode="+bcode+"&seq="+seq+"&pg="+pg+schurl;
		});

		$("#btn-delete").click(function (){
			var form = document.data_form;
			var bcode = form.bcode.value;
			var seq = form.seq.value;
			var pg = form.pg.value;

			var schurl = "";
			if (form.searchstring.value != "") {
				schurl+= "&search="+form.search.value+"&searchstring="+form.searchstring.value;
			}

			if (confirm("이 글을 삭제하시겠습니까?")) {
				$("#rt_ifrm").attr("src",rt_path['app']+"/theme/qna/data/update.php?mode=delete&bcode="+bcode+"&seq="+seq+"&pg="+pg+schurl);
			}
		});

		$("#btn-form-submit").click(function (){
			var form = document.data_form;
			var webeditor_is = $("#webeditor_is").val();

			if (webeditor_is == "y") {
				se2_editor_contents("content");
			}
			if(rt_chk_form('required')){
				form.submit();
			}
		});

		$("#btn-reply-submit").click(function (){
			var form = document.data_form;
			var webeditor_is = $("#webeditor_is").val();

			if (webeditor_is == "y") {
				se2_editor_contents("content_reply");
			}
			if(rt_chk_form('required')){
				form.submit();
			}
		});

		$("#btn-cmt-submit").click(function (){
			var form = document.cmt_insert_form;
			if(rt_chk_form('cmt_ins_required')){
				form.submit();
			}
		});

		$("#reg_date,#mod_date,#reply_date").datepicker({
			monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
			dateFormat: 'yy-mm-dd',
			buttonText: '달 력',
			prevText: '이전달',
			nextText: '다음달'
		});

		$('.rt_reply_comment').click(function(){
			$(this).parents().siblings('.rt_reply_comment_wrap').children('.rt_reply_comment_form').slideUp();
			$(this).parents().siblings('.rt_reply_comment_form').slideToggle();
		});
	});
})(jQuery);