
function delete_list(obj) {
	$(obj).parent().parent().remove();
}

;(function($) {
	$(function() {

		var f = document.data_form;
		var path_cur_pos = rt_path['adm']+"/"+rt_layout['dr'];

		$("#btn-submit").click(function (){
			f.submit();
		});

	});
})(jQuery);
