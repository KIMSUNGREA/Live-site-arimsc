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

		rt_get_capcha('join');

		$("#agr-all").click(function (){
			if ($(this).is(":checked")) {
				$("#agr1").prop("checked", true);
				$("#agr2").prop("checked", true);
			} else {
				$("#agr1").prop("checked", false);
				$("#agr2").prop("checked", false);
			}
		});

		/* step1 */
		$("#btn-agree").click(function (){
			var ischk1 = $("#agr1").is(":checked");
			var ischk2 = $("#agr2").is(":checked");
			if(!ischk1){
				alert("이용약관에 동의를 하셔야 회원가입 진행이 가능합니다");
			}else if(!ischk2){
				alert("개인정보수집방침에 동의를 하셔야 회원가입 진행이 가능합니다");
			}else{
				document.agree_form.submit();
			}
		});

		/* step2 */
		$("#btn-id-check").click(function () {

			var f = document.join_form;
			var path_user = f.path_user.value;
 			if (!f.user_id.value) {
				alert("아이디를 입력해 주세요");
				f.id_check.value = "";
				f.user_id.focus();
			} else {
				$.post(path_user+"/update.php", {
					'mode':'check_id',
					'user_id':f.user_id.value
				},function(data){
					eval(data);
					if (chkres) {
						alert("사용 가능한 ID입니다.");
						f.id_check.value = "y";
					} else {
						alert("사용할 수 없는 ID입니다.");
						f.user_id.value = "";
						f.id_check.value = "";
					}
				});
			}
		});

		$("#user_id").click(function () {
			document.join_form.id_check.value = "n";
			document.join_form.user_id.value = "";
		});

		$("#btn-form-submit").click(function (){

			var f = document.join_form;
			var path_user = f.path_user.value;
			var check_phone = $("#phone1").val()+$("#phone2").val()+$("#phone3").val();

			if (rt_chk_form('required')) {
				if ((f.user_pw.value != f.user_pw_re.value) || !f.user_pw.value || !f.user_pw_re.value) {
					alert("비밀번호를 정확히 입력해 주세요");
					f.user_pw.focus();
				} else {

					if (!$("#agr1").is(":checked") || !$("#agr2").is(":checked")) {
						alert("회원약관과 개인정보취급방침에 동의해 주세요.");
					} else {
						if ($("#join_check").val() == 'n')
						{
							$("#btn-form-submit").hide();
							$("#join_check").val('y');
							f.submit();
						} else {
							alert ("처리중입니다.");
						}
					}
				}
			}
		});

		$("#btnPhoneAuth").click(function (){
			if($("#phone1").val() == "") {
				alert("휴대폰 번호를 정확히 입력해 주세요");
				$("#phone1").focus();
			} else if($("#phone2").val() == "") {
				alert("휴대폰 번호를 정확히 입력해 주세요");
				$("#phone2").focus();
			} else if($("#phone3").val() == "") {
				alert("휴대폰 번호를 정확히 입력해 주세요");
				$("#phone3").focus();
			} else {
				var phone = $("#phone1").val()+"-"+$("#phone2").val()+"-"+$("#phone3").val();
				if(confirm("입력하신 "+phone+"가 본인 휴대폰이 맞습니까?")) {

					$.post(rt_path['rtmember']+"/user/ajax.phone_auth.php", { 'phone': phone },function(data){
						eval(data);
						alert("인증번호가 발송되었습니다. 인증번호를 정확히 입력해 주세요");
						authnum = setauthnum;

						$("#auth").show();
					});
				}
			}
		});

		$("#btnCheckAuthNum").click(function (){
			var userinput = $("#userinput_num").val();
			if(authnum != userinput) {
				alert("인증번호가 맞지 않습니다. 정확히 입력해 주세요");
				$("#userinput_num").focus();
			} else {
				alert("인증되었습니다.");
				document.join_form.sms_auth_num.value = $("#phone1").val()+$("#phone2").val()+$("#phone3").val();
				document.join_form.is_sms_auth.value = "y";
				$("#auth").hide();
			}
		});
	});
})(jQuery);