
function delete_field(seq)
{
	var form = document.dataform;
	var bcode = form.bcode.value;

	if (confirm("선택하신 폼 필드를 삭제하시겠습니까?")) {
		$("#rt_ifrm").attr("src",rt_path['app']+"/admin/field/update.php?mode=delete&bcode="+bcode+"&seq="+seq);
	}
}

;(function($) {
	$(function() {

		var form = document.dataform;
		var bcode = form.bcode.value;

		$("#btn-insert").click(function (){
			location.href = "?appcode=rtboard&sd=admin-field&bcode="+bcode;
		});

		$(".ftype").click(function (){

			if ($(this).val() == "text") {
				$("#trSizeW").show();
				$("#trSizeH").hide();
				$("#trData").hide();
				$("#trReq").show();
				$("#trReqData").show();
			}

			if ($(this).val() == "checkbox" || $(this).val() == "radio" || $(this).val() == "select") {
				$("#trSizeW").hide();
				$("#trSizeH").hide();
				$("#trData").show();
				$("#trReq").hide();
				$("#trReqData").hide();
			}

			if ($(this).val() == "textarea") {
				$("#trSizeW").show();
				$("#trSizeH").show();
				$("#trData").hide();
				$("#trReq").show();
				$("#trReqData").show();
			}
		});

		$("#btn-form-submit").click(function (){
			if(rt_chk_form('required')){
				form.submit();
			}
		});
	});
})(jQuery);