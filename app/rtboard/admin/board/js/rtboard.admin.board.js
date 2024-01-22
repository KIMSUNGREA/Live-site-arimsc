
function board_delete(bseq) {
	if (bseq) {
		if (confirm("게시판을 삭제하시겠습니까?")) {
			var form = document.data_form;
			$("#rt_ifrm").attr("src",rt_path['app']+"/admin/board/update.php?mode=delete&sd="+form.sd.value+"&bseq="+bseq);
		}
	}
}

function set_theme_skin(theme)
{
	$.ajax({
		url: rt_path['app']+"/admin/board/update.php",
		type: "POST",
		data: {mode:'get_skin_list',theme:theme},
		success: function( data ) {
			$("#skin-area").html(data);
		}
	});
}

;(function($) {
	$(function() {

		$("#btn-list").click(function (){
			location.href = rt_path['adm']+"/app/?appcode=rtboard&sd=admin-board";
		});

		$("input[name=copy_skin]").click(function (){
				if ($(this).val() == "n") {

					var theme = $("input[name=theme]:checked").val();

					$("#tr-skin").show();
					set_theme_skin(theme);
				} else {
					$("#tr-skin").hide();
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