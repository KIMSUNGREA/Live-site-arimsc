
;(function($) {
	$(function() {

		$("#btn-form-submit").click(function (){
			var form = document.dataform;
			if(rt_chk_form('required')){
				form.submit();
			}
		});
	});
})(jQuery);