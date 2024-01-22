
function group_delete(grp_seq) {

	if (grp_seq) {
		if (confirm("게시판 그룹을 삭제하시겠습니까?")) {
			$("#rt_ifrm").attr("src",rt_path['app']+"/admin/group/update.php?mode=delete&grp_seq="+grp_seq);
		}
	}
}

function group_chg(part, seq) {

	if (seq && part) {
		$("#rt_ifrm").attr("src",rt_path['app']+"/admin/group/update.php?mode=chgord&part="+part+"&grp_seq="+seq);
	} else {
		alert("시스템문제로 처리되지 않았습니다");
	}
}

;(function($) {
	$(function() {

		$("#btn-list").click(function (){
			location.href = rt_path['adm']+"/app/?appcode=rtboard&sd=admin-group";
		});

		$("#btn-group-ins").click(function (){
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