
;(function($) {
	$(function() {

		var f = document.dataform;

		$("#btn-form-submit").click(function (){
			if (rt_chk_form('required')) {
				f.submit();
			}
		});
	});
})(jQuery);