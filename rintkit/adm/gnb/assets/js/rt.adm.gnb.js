
function menu_delete(seq) {
	if (confirm("메뉴를 삭제하시겠습니까?")) {
		$("#rt_ifrm").attr("src",rt_layout['sc']+"/update.php?mode=delete&seq="+seq);
	}
}

function menu_chg(part, seq) {

	if (seq && part) {
		$("#rt_ifrm").attr("src",rt_layout['sc']+"/update.php?mode=chgord&part="+part+"&seq="+seq);
	} else {
		alertify.alert("시스템문제로 처리되지 않았습니다");
	}
}

;(function($) {
	$(function() {
		$("#btn-list").click(function (){
			location.href = rt_path['adm']+"/gnb/?sd=gnb";
		});

		$("#btn-gnb-ins").click(function (){
			var form = document.ins_form;
			if(rt_chk_form('required')){
				form.submit();
			}
		});

		$("#btn-form-submit").click(function (){
			var form = document.data_form;
			if(rt_chk_form('required')){
				form.submit();
			}
		});
	});
})(jQuery);