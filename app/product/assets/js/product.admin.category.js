
function popup_data_open(code, skin) {

	$(".rt_popup_wrap").show().children().eq(0).show().siblings('.rt_popup_con').hide();
	$("html,body").css("overflow-y","hidden");

	$.ajax({
		url: rt_path['app']+"/"+rt_layout['sd']+"/update.php",
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

function category_delete(code) {
	if (code) {
		if (confirm("분류를 삭제하시겠습니까?")) {
			$("#rt_ifrm").attr("src",rt_path['app']+"/"+rt_layout['sd']+"/update.php?mode=category_delete&code="+code);
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

function use_is_data(val) {

	var type_en = $("input[name=type_en]:checked").val();

	if (val == "y") {
		$(".tr_type").show();
		toggle_data("type_en", type_en);
	} else {
		$(".tr_type").hide();
		$(".tr_type_img").hide();
		$(".tr_type_html").hide();
	}
}

function toggle_data(part, val) {

	if (part == "type_en") {
		if (val == "none") {
			$(".tr_type_img").hide();
			$(".tr_type_html").hide();
		} else if (val == "img") {
			$(".tr_type_img").show();
			$(".tr_type_html").hide();
		} else if (val == "html") {
			$(".tr_type_img").hide();
			$(".tr_type_html").show();
		}
	} else if (part == "auth_en") {
		if (val == "common") {
			$(".tr_auth").hide();
		} else if (val == "each") {
			$(".tr_auth").show();
		}
	}
}

;(function($) {
	$(function() {

	});
})(jQuery);