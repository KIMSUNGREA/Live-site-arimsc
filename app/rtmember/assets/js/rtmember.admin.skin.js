
function code_view_close() {
	$("#template-code").bPopup().close();
}

;(function($) {
	$(function() {

		var f = document.dataform;

		$("#btn-form-submit").click(function (){
			if (rt_chk_form('required')) {
				f.submit();
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