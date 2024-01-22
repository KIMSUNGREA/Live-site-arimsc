
function form_submit() {
	document.dataform.submit();
}

;(function($) {
	$(function() {

		$("input[name=meta_common_is]").click(function (){
			if ($(this).val() == "y") {
				$(".tr-meta-data").hide();
			} else {
				$(".tr-meta-data").show();
			}
		});

	});
})(jQuery);