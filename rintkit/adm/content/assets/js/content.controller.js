
function img_delete(seq, num) {
	if (confirm("이미지를 삭제하시겠습니까?")) {
		$("#rt_ifrm").attr("src",rt_path['adm']+"/content/content/update.php?mode=imgdel&seq="+seq+"&num="+num);
	}
}

function content_delete(seq) {
	if (seq) {
		if (confirm("콘텐츠를 삭제하시겠습니까?")) {
			$("#rt_ifrm").attr("src",rt_path['adm']+"/content/content/update.php?mode=delete&seq="+seq);
		}
	} else {
		rt_alert("시스템문제로 처리되지 않았습니다");
	}
}

;(function($) {
	$(function() {

		var f = document.dataform;
		var path_cur_pos = rt_path['adm']+"/"+rt_layout['dr'];

		$("#btn-move-list").click(function (){
			window.location.href = path_cur_pos+"/?sd=content";
		});

		$("#btn-move-form").click(function (){
			location.href = path_cur_pos+"/?sd=content&cf=form";
		});

		$("#btn-submit").click(function (){
			if (rt_chk_form('required')) {
				if (f.content_type.value == "") {
					alert("콘텐츠 타입을 이미지 혹은 HTML 중 선택해 주세요");
				} else {
					f.submit();
				}
			}
		});

		$("input[name=login_is]").click(function (){

			var type = f.content_type.value;

			if ($(this).val() == "y") {
				if (type == "img") {
					$("#tr_img2").show();$("#tr_html2").hide();
				} else {
					$("#tr_img2").hide();$("#tr_html2").show();
				}
			} else {
				if (type == "img") {
					$("#tr_img2").hide();$("#tr_html2").hide();
				} else {
					$("#tr_img2").hide();$("#tr_html2").hide();
				}
			}
		});

		$("#con_type_img").click(function (){
			$("#tr_login").show();
			$("#tr_img1").show();
			if ($("input[name=login_is]:checked").val()=="y") {
				$("#tr_img2").show();
			} else {
				$("#tr_img2").hide();
			}
			$("#tr_img3").show();
			$("#tr_html1").hide();
			$("#tr_html2").hide();
			f.content_type.value = 'img';
		});

		$("#con_type_html").click(function (){
			$("#tr_login").show();
			$("#tr_img1").hide();
			$("#tr_img2").hide();
			$("#tr_img3").hide();
			$("#tr_html1").show();
			if ($("input[name=login_is]:checked").val()=="y") {
				$("#tr_html2").show();
			} else {
				$("#tr_html2").hide();
			}
			f.content_type.value = 'html';
		});

		$("input[name=link_is]").click(function (){
			if ($(this).val() == "y") {
				$("#tr_img3").show();
			} else {
				$("#tr_img3").hide();
			}
		});

		$('.rt_toggle_tr_trigger').click(function(){
			$(this).parents().next('.rt_toggle_tr').find('.blind').slideToggle().parents().siblings('.rt_toggle_tr').find('.blind').slideUp();
		});
	});
})(jQuery);