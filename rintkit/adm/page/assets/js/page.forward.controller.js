
;(function($) {
	$(function() {

		var f = document.data_form;
		var path_cur_pos = rt_path['adm']+"/"+rt_layout['dr'];

		$("#btn-submit").click(function (){
			if (rt_chk_form('required')) {
				f.submit();
			}
		});

		//권장 세팅 초기화 데이터
		$("#btn-seting-reset").click(function (){
			$("#fw1").val("x");$("#ld1").val("");
			$("#fw2").val("x");$("#ld2").val("");
			$("#fw3").val("x");$("#ld3").val("");
			$("#fw4").val("o");$("#ld4").val("pc");
			$("#fw5").val("o");$("#ld5").val("pc");
			$("#fw6").val("x");$("#ld6").val("");
			$("#fw7").val("o");$("#ld7").val("mobile");
			$("#fw8").val("x");$("#ld8").val("");
			$("#fw9").val("o");$("#ld9").val("mobile");
			$("#fw10").val("x");$("#ld10").val("");
			$("#fw11").val("o");$("#ld11").val("pc");
			$("#fw12").val("x");$("#ld12").val("");
		});

		//모바일 사용안함 세팅
		$("#btn-pc-seting").click(function (){
			$("#fw1").val("x");$("#ld1").val("");
			$("#fw2").val("x");$("#ld2").val("");
			$("#fw3").val("x");$("#ld3").val("");
			$("#fw4").val("x");$("#ld4").val("");
			$("#fw5").val("x");$("#ld5").val("");
			$("#fw6").val("x");$("#ld6").val("");
			$("#fw7").val("x");$("#ld7").val("");
			$("#fw8").val("x");$("#ld8").val("");
			$("#fw9").val("x");$("#ld9").val("");
			$("#fw10").val("x");$("#ld10").val("");
			$("#fw11").val("x");$("#ld11").val("");
			$("#fw12").val("x");$("#ld12").val("");
		});

		$(".selchange").change(function (){
			var data = $(this).attr("data");
			if ($(this).val() == "x") {
				$("#ld"+data+" option:eq(0)").attr("selected", "selected");
			}
		});

	});
})(jQuery);
