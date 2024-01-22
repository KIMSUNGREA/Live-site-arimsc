
function code_view_close() {
	$("#template-code").bPopup().close();
}
;(function($) {
	$(function() {

		$("#btn-form-submit").click(function () {
			var form = document.dataform;
			if(rt_chk_form('required')){
				form.submit();
			}
		});

		$("#btn-code-view").click(function () {
			$('#template-code').bPopup({
				opacity: 0.6,
				position: [0, 20] //x, y
			});
		});

		$("#btn-reference-link").click(function () {
			window.open('http://www.xtac.net/tutorial1/', 'reference_link');
		}).css("cursor","pointer");

	});
})(jQuery);