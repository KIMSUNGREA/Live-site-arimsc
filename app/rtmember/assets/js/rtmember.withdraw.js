
function rt_get_capcha(part)
{
	var form = document.data_form;

	//보안코드 설정
	$.ajax({
		url: rt_path['rtmember']+"/user/update.php",
		type: "POST",
		data: {mode: 'capcha',"part":part},
		success: function( data ) {
			eval(data);
			$("#capcha_str").html(rand_str);
		}
	});
}

;(function($) {
	$(function() {

		$("#btn-form-submit").click(function (){

			var f = document.withdraw_form;

			if (rt_chk_form('required')) {
				if (confirm("회원을 탈퇴하시겠습니까?")) {
					f.submit();
				}
			}
		});

		rt_get_capcha('draw');
	});
})(jQuery);