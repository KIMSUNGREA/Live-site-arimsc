
function delete_page(seq) {
	if (confirm("선택한 데이터를 삭제하시겠습니까?")) {
		$("#rt_ifrm").attr("src",rt_layout['sc']+"/update.php?mode=delete&seq="+seq);
	}
}