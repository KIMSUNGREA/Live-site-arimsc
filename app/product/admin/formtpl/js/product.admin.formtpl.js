
function formtpl_delete(seq) {

	if (seq) {
		if (confirm("폼 템플릿을 삭제하시겠습니까?")) {
			$("#rt_ifrm").attr("src",rt_path['app']+"/admin/formtpl/update.php?mode=delete&seq="+seq);
		}
	}
}

function formtpl_chg(part, seq) {

	if (seq && part) {
		$("#rt_ifrm").attr("src",rt_path['app']+"/admin/formtpl/update.php?mode=chgord&part="+part+"&seq="+seq);
	} else {
		alert("시스템문제로 처리되지 않았습니다");
	}
}

;(function($) {
	$(function() {

		$("#btn-list").click(function (){
			location.href = rt_path['adm']+"/app/?appcode=product&sd=admin-formtpl";
		});

		$("#btn-formtpl-ins").click(function (){
			var form = document.ins_form;
			if(rt_chk_form('required')){
				form.submit();
			}
		});

		$("#btn-form-submit").click(function (){
			var form = document.data_form;

			se2_editor_contents("content");
			if(rt_chk_form('required')){
				form.submit();
			}
		});
	});
})(jQuery);