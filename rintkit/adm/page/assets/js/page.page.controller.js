
function page_tab_link(cf,code) {

	var path_cur_pos = rt_path['adm']+"/"+rt_layout['dr'];

	location.href = path_cur_pos+"/?sd=page&cf="+cf+"&code="+code;
}

function form_submit() {
	document.dataform.submit();
}

;(function($) {
	$(function() {

		var path_cur_pos = rt_path['adm']+"/"+rt_layout['dr'];

		//서브 메뉴 토글 탭
		$('.rt-tab-pager button').click(function(){
			var tabIdx = $('.rt-tab-pager button').index($(this));
			$('.rt-tab-pager button').eq(tabIdx).addClass('red').removeClass('gray').siblings().removeClass('red').addClass('gray');
			$('.rt-tab-wrap .rt-tab-list').eq(tabIdx).show().siblings().hide();
		});

		$("input[name=page_setting_en]").click(function (){
			if ($(this).val() == "custom") {
				$(".tr-url-custom").show();
				$(".tr-url-auto").hide();
			} else {
				$(".tr-url-custom").hide();
				$(".tr-url-auto").show();
			}
		});

		$("input[name=cont_type_en]").click(function (){
			if ($(this).val() == "img") {
				$(".tr-cont-img").show();
				$(".tr-cont-html").hide();
				$(".tr-cont-board").hide();
				$(".tr-cont-member").hide();
			} else if ($(this).val() == "html") {
				$(".tr-cont-img").hide();
				$(".tr-cont-html").show();
				$(".tr-cont-board").hide();
				$(".tr-cont-member").hide();
			} else if ($(this).val() == "board") {
				$(".tr-cont-img").hide();
				$(".tr-cont-html").hide();
				$(".tr-cont-board").show();
				$(".tr-cont-member").hide();
			} else if ($(this).val() == "member") {
				$(".tr-cont-img").hide();
				$(".tr-cont-html").hide();
				$(".tr-cont-board").hide();
				$(".tr-cont-member").show();
			}
		});

		$("input[name=cont_type_m_en]").click(function (){
			if ($(this).val() == "img") {
				$(".tr-cont-img-m").show();
				$(".tr-cont-html-m").hide();
				$(".tr-cont-board-m").hide();
				$(".tr-cont-member-m").hide();
			} else if ($(this).val() == "html") {
				$(".tr-cont-img-m").hide();
				$(".tr-cont-html-m").show();
				$(".tr-cont-board-m").hide();
				$(".tr-cont-member-m").hide();
			} else if ($(this).val() == "board") {
				$(".tr-cont-img-m").hide();
				$(".tr-cont-html-m").hide();
				$(".tr-cont-board-m").show();
				$(".tr-cont-member-m").hide();
			} else if ($(this).val() == "member") {
				$(".tr-cont-img-m").hide();
				$(".tr-cont-html-m").hide();
				$(".tr-cont-board-m").hide();
				$(".tr-cont-member-m").show();
			}
		});

		$("input[name=forward_type_en]").click(function (){
			if ($(this).val() == "page") {
				$(".tr-forward-url").hide();
				$(".tr-forward-page").show();
			} else {
				$(".tr-forward-url").show();
				$(".tr-forward-page").hide();
			}
		});

		$("input[name=forward_is]").click(function (){
			if ($(this).val() == "n") {
				$(".table-forward").hide();
			} else {
				$(".table-forward").show();
			}
		});
	});
})(jQuery);