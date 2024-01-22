
function delete_page(seq) {
	if (confirm("선택한 페이지를 삭제하시겠습니까?")) {
		$("#rt_ifrm").attr("src",rt_layout['sc']+"/update.php?mode=delete&seq="+seq);
	}
}

;(function($) {
	$(function() {

		var path_cur_pos = rt_path['adm']+"/"+rt_layout['dr'];

		$("#btn-add-page").click(function (){

			var f = document.ins_form;

			if (f.pg_target.value=="") {
				alert("접속시도 페이지를 입력해 주세요");
				f.pg_target.focus();
			} else if (f.pg_forward.value=="") {
				alert("강제로 이동할 페이지를 입력해 주세요");
				f.pg_forward.focus();
			} else {
				f.submit();
			}
		});

	});
})(jQuery);
