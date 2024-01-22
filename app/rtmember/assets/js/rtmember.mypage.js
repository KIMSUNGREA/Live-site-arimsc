
;(function($) {
	$(function() {
		$('#btn-submit').click(function(){
			if (rt_chk_form('required')) {
				document.dataform.submit();
			}
		})
	});
})(jQuery);