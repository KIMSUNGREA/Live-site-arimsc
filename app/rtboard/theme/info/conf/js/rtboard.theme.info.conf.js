
;(function($) {
	$(function() {

		$("#btn-form-submit").click(function (){
			var form = document.dataform;
			if(rt_chk_form('required')){
				form.submit();
			}
		});

		$("input[name=category_is]").click(function (){
			if ($(this).val()=="y") {
				$("#tr-category-data").show();
			} else {
				$("#tr-category-data").hide();
			}
		});
	});
})(jQuery);