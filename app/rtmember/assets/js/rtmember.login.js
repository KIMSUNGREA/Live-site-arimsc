
;(function($) {
	$(function() {

		$("#btn-login").click(function (){
			if (rt_chk_form("required")) {
				document.login_form.submit();
			}
		});

		//접속 시 포커스 설정
		if ($("#userid").val()) {
			$("#userpw").focus();
		} else {
			$("#userid").focus();
		}

		//엔터 입력 처리
		$("#userid, #userpw").keydown(function (e){
			if(e.which == "13"){
				$("#btn-login").trigger("click");
			}
		});
	});
})(jQuery);