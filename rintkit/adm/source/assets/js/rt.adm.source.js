
function source_delete(seq) {
	if (confirm("소스를 삭제하시겠습니까?")) {
		$("#rt_ifrm").attr("src",rt_layout['sc']+"/update.php?mode=delete&seq="+seq);
	}
}

;(function($) {
	$(function() {
		$("#btn-list").click(function (){
			location.href = rt_path['adm']+"/source/?sd=source";
		});

		$("#btn-source-ins").click(function (){
			var form = document.ins_form;
			if(rt_chk_form('required')){
				form.submit();
			}
		});

		$("#btn-form-submit").click(function (){
			var form = document.data_form;
			if(rt_chk_form('required')){
				form.submit();
			}
		});

		$('.rt_toggle_tr_trigger').click(function(){
			$(this).parents().next('.rt_toggle_tr').find('.blind').slideToggle().parents().siblings('.rt_toggle_tr').find('.blind').slideUp();
		});
	});
})(jQuery);