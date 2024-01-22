jQuery(function($){

	var f = document.dataform;

	$(".rt_pp_drag_box").draggable({
		drag: function() {
			var x_pos = $('.rt_pp_point').offset().left -0.5;
			var y_pos = $('.rt_pp_point').offset().top - 45;
			var pos_r = $('.rt_pp_center_bar').offset().left;
			var sum = x_pos - pos_r;
			$('.rt_pp_hd .rt_pp_x span').text(sum);
			$('.rt_pp_hd .rt_pp_y span').text(y_pos);

			f.pos_x.value = sum - 1;
			f.pos_y.value = y_pos;
		},
	}).resizable({
		minHeight : 200,
		minWidth: 200,
		resize: function( event, ui ) {
			$("#popw").val(ui.size.width);
			$("#poph").val(ui.size.height);

			$("#sim_size_x").text(ui.size.width);
			$("#sim_size_y").text(ui.size.height);
		}
	});

	$("#btn-size-apply").click(function () {
		$(".rt_pp_drag_box").width($("#popw").val());
		$(".rt_pp_drag_box").height($("#poph").val());
	});

	$("#btn-apply").click(function () {
		opener.document.dataform.pos_x.value = f.pos_x.value;
		opener.document.dataform.pos_y.value = f.pos_y.value;

		if (f.pop_w.value != $("#popw").val() || f.pop_h.value != $("#poph").val()) {
			if (confirm("팝업 사이즈가 변경되었습니다. 변경된 내용을 반영하겠습니까?")) {
				opener.document.dataform.size_w.value = $("#popw").val();
				opener.document.dataform.size_h.value = $("#poph").val();
			}
		}
		self.close();
	});

	$("#btn-size-reset").click(function () {
		$(".rt_pp_drag_box").width(opener.document.dataform.size_w.value);
		$(".rt_pp_drag_box").height(opener.document.dataform.size_h.value);
	});
});