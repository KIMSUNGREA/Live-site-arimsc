
;(function($) {
	$(function() {

		$("#btn_submit").click(function (){

			var f = document.data_form;

			if (rt_chk_form('required')) {

				if (f.adm_pwd_new.value != f.adm_pwd_new_re.value) {

					f.adm_pwd_new.value = "";
					f.adm_pwd_new_re.value = "";
					f.adm_pwd_new.focus();

					alert("비밀번호가 맞지 않습니다");

				} else {

					f.submit();
				}

			}
		});
	});
})(jQuery);