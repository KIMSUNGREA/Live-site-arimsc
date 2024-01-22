
var path_cur_pos = rt_path['adm']+"/"+rt_layout['dr'];

function popup_data_open(code, skin) {

	$(".rt_popup_wrap").show().children().eq(0).show().siblings('.rt_popup_con').hide();
	$("html,body").css("overflow-y","hidden");

	$.ajax({
		url: path_cur_pos+"/sitemap/update.php",
		type: "POST",
		data: {'mode':'get_skin', 'code':code, 'skin':skin},
		beforeSend:function(){
			$("#popup_data").html("<img src='"+rt_path['adm']+"/layout/images/sub/ajax-loader.gif'/>");
		},
		success: function(data){
			$("#popup_data").html(data);
		}
	});
}

function popup_data_close() {
	$(".rt_popup_wrap").hide();
	$("html,body").css("overflow-y","visible");
	$("#popup_data").html('');
}

function page_delete(code) {
	if (code) {
		if (confirm("페이지를 삭제하시겠습니까?")) {
			$("#rt_ifrm").attr("src",rt_path['adm']+"/page/sitemap/update.php?mode=page_delete&code="+code);
		}
	} else {
		rt_alert("시스템문제로 처리되지 않았습니다");
	}
}

function page_form_submit(form,reqtxt) {

	if (reqtxt) {
		if (rt_chk_form(reqtxt)) {
			eval("document."+form+".submit();");
		}
	} else {
		eval("document."+form+".submit();");
	}
}

function toggle_data(part, obj) {

	if (part == "page_setting_en") {
		if (obj.value == "custom") {
			$(".tr-url-custom").show();
			$(".tr-url-auto").hide();
		} else {
			$(".tr-url-custom").hide();
			$(".tr-url-auto").show();
		}
	} else if (part == "forward_type_en") {
		if (obj.value == "page") {
			$(".tr-forward-url").hide();
			$(".tr-forward-page").show();
		} else {
			$(".tr-forward-url").show();
			$(".tr-forward-page").hide();
		}
	} else if (part == "forward_is") {
		if (obj.value == "n") {
			$(".tr-forward-en").hide();
			$(".tr-forward-url").hide();
			$(".tr-forward-page").hide();
		} else {
			$(".tr-forward-en").show();

			if ($("input[name=forward_type_en]").val() == "page") {
				$(".tr-forward-url").hide();
				$(".tr-forward-page").show();
			} else {
				$(".tr-forward-url").show();
				$(".tr-forward-page").hide();
			}
		}
	} else if (part == "cont_type_en") {
		if (obj.value == "img") {
			$(".tr-cont-img").show();
			$(".tr-cont-html").hide();
			$(".tr-cont-board").hide();
			$(".tr-cont-member").hide();
		} else if (obj.value == "html") {
			$(".tr-cont-img").hide();
			$(".tr-cont-html").show();
			$(".tr-cont-board").hide();
			$(".tr-cont-member").hide();
		} else if (obj.value == "board") {
			$(".tr-cont-img").hide();
			$(".tr-cont-html").hide();
			$(".tr-cont-board").show();
			$(".tr-cont-member").hide();
		} else if (obj.value == "member") {
			$(".tr-cont-img").hide();
			$(".tr-cont-html").hide();
			$(".tr-cont-board").hide();
			$(".tr-cont-member").show();
		}

	} else if (part == "cont_type_m_en") {
		if (obj.value == "img") {
			$(".tr-cont-img-m").show();
			$(".tr-cont-html-m").hide();
			$(".tr-cont-board-m").hide();
			$(".tr-cont-member-m").hide();
		} else if (obj.value == "html") {
			$(".tr-cont-img-m").hide();
			$(".tr-cont-html-m").show();
			$(".tr-cont-board-m").hide();
			$(".tr-cont-member-m").hide();
		} else if (obj.value == "board") {
			$(".tr-cont-img-m").hide();
			$(".tr-cont-html-m").hide();
			$(".tr-cont-board-m").show();
			$(".tr-cont-member-m").hide();
		} else if (obj.value == "member") {
			$(".tr-cont-img-m").hide();
			$(".tr-cont-html-m").hide();
			$(".tr-cont-board-m").hide();
			$(".tr-cont-member-m").show();
		}
	} else if (part == "meta_common_is") {
		if (obj.value == "y") {
			$(".tr-meta-data").hide();
		} else {
			$(".tr-meta-data").show();
		}
	}
}

;(function($) {
	$(function() {

	});
})(jQuery);