
function favicon_delete(seq) {
	if (confirm("파비콘을 삭제하시겠습니까?")) {
		$("#rt_ifrm").attr("src",rt_path['adm']+"/page/conf/update.php?mode=icondel");
	}
}

;(function($) {
	$(function() {

		$("#btn-submit").click(function (){
			document.dataform.submit();
		});
	});
})(jQuery);