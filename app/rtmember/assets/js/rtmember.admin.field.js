
function delete_field(seq)
{
	var form = document.dataform;

	if (confirm("선택하신 폼 필드를 삭제하시겠습니까?")) {
		$("#rt_ifrm").attr("src",rt_path['app']+"/admin/field/update.php?mode=delete&seq="+seq);
	}
}

;(function($) {
	$(function() {

		var form = document.dataform;

		$("#btn-insert").click(function (){
			location.href = "?appcode=rtmember&sd=admin-field";
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