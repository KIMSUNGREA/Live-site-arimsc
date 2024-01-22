function rt_get_capcha(part)
{
	//보안코드 설정
	$.ajax({
		url: rt_path['rtmember']+"/user/update.php",
		type: "POST",
		data: {"mode": "capcha","part":part},
		success: function( data ) {
			eval(data);
			$("#capcha_str_"+part).html(rand_str);
		}
	});
}

;(function($) {
	$(function() {

		rt_get_capcha('id');
		rt_get_capcha('pw');

		$("#btn-find-id").click(function () {

			if ($("#findid_name").val() == "") {
				alert("회원명을 입력해 주세요.");
				$("#findid_name").focus();
			} else if ($("#findid_email").val() == "") {
				alert("이메일을 입력해 주세요.");
				$("#findid_email").focus();
			} else if ($("#sec_code").val() == "") {
				alert("보안문자를 입력해 주세요.");
				$("#sec_code").focus();
			} else {
				$.ajax({
					url: rt_path['rtmember']+"/user/update.php",
					type: "POST",
					data: {"mode": "findid","findid_name": $("#findid_name").val(),"findid_email": $("#findid_email").val(),"sec_code": $("#sec_code").val()},
					success: function( data ) {
						eval(data);
						if (chkres == 'y' && sec_code == 'y') {
							alert("메일로 회원님의 아이디를 발송해 드렸습니다.");
							$("#findid_name").val('');
							$("#findid_email").val('');
							$("#sec_code").val('');
						} else if (sec_code == 'n') {
							alert("보안문자가 맞지 않습니다.");
						}else {
							alert("가입된 회원정보가 없습니다.");
						}
					}
				});
			}
		});

		$("#btn-find-pw").click(function () {

			if ($("#findpw_name").val() == "") {
				alert("회원명을 입력해 주세요");
				$("#findpw_name").focus();
			} else if ($("#findpw_id").val() == "") {
				alert("회원 아이디(이메일)를 입력해 주세요");
				$("#findpw_id").focus();
			} else if ($("#sec_code2").val() == "") {
				alert("보안문자를 입력해 주세요.");
				$("#sec_code2").focus();
			} else {
				$.ajax({
					url: rt_path['rtmember']+"/user/update.php",
					type: "POST",
					data: {"mode": "findpw","findpw_name": $("#findpw_name").val(),"findpw_id": $("#findpw_id").val(),"sec_code": $("#sec_code2").val()},
					success: function( data ) {
						eval(data);
						if (chkres == 'y' && sec_code == 'y') {
							alert("메일로 회원님의 임시 비밀번호를 발송해 드렸습니다.");
							//$("#findpw_name").val('');
							//$("#findpw_id").val('');
							//$("#sec_code2").val('');
						} else if (sec_code == 'n') {
							alert("보안문자가 맞지 않습니다.");
						} else {
							alert(chkres+"가입된 회원정보가 없습니다.");
						}
					}
				});
			}
		});
	});
})(jQuery);