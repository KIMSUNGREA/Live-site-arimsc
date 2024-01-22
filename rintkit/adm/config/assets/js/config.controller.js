
;(function($) {
	$(function() {

		$("#btn-submit").click(function (){

			var f = document.dataform;

			if (rt_chk_form('required')) {
				if ($('#ssl_y').is(':checked')) {
					if ($('#ssl_port').val() != "") {
						f.submit();
					} else {
						alert ('SSL PORT를 입력해 주세요.');
						$('#ssl_port').focus();
					}
				} else {
					f.submit();
				}
			}
		});

	});
})(jQuery);
