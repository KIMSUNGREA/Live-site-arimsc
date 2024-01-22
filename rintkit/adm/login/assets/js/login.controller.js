;(function($) {
	$(function() {

		$("#btnSubmit").click(function () {
			if (rt_chk_form("required")) {
				document.login_form.submit();
			}
		}).css("cursor","pointer");

		$("input").keydown(function (e){
			if(e.which == "13"){
				$("#btnSubmit").trigger("click");
			}
		});

		if ($("#adm_id").val() == "") {
			$("#adm_id").focus();
		} else {
			$("#adm_pw").focus();
		}

	});
})(jQuery);