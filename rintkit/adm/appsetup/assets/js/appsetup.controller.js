
function delete_data(code,path) {

	if (code) {
		if (confirm("데이터를 초기화 하시겠습니까?")) {
			$("#rt_ifrm").attr("src",rt_path['adm']+"/appsetup/applist/update.php?mode=delete_data&code="+code+"&path="+path);
		}
	} else {
		rt_alert("시스템문제로 처리되지 않았습니다");
	}
}

;(function($) {
	$(function() {

		var f = document.data_form;
		var path_cur_pos = rt_path['adm']+"/"+rt_layout['dr'];

		$("#btn-move-form").click(function (){
			location.href = path_cur_pos+"/?sd=applist&cf=form";
		});

		$("#btn-move-list").click(function (){
			window.location.href = path_cur_pos+"/?sd=applist&cf=list";
		});


		$("#btn-submit").click(function (){
			if (rt_chk_form('required')) {
				f.submit();
			}
		});

		$("#btn-delete").click(function () {

			if (confirm("이 APP을 삭제하시겠습니까?")) {
				f.mode.value = "delete";
				f.submit();
			}
		});

	});
})(jQuery);