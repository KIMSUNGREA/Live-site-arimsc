
function option_delete(opt_seq) {

	if (opt_seq) {
		if (confirm("옵션을 삭제하시겠습니까?")) {
			$("#rt_ifrm").attr("src",rt_path['app']+"/admin/option/update.php?mode=delete&opt_seq="+opt_seq);
		}
	} else {
		rt_alert("시스템문제로 처리되지 않았습니다");
	}
}

function option_chg(part, seq) {

	if (seq && part) {
		$("#rt_ifrm").attr("src",rt_path['app']+"/admin/option/update.php?mode=chgord&part="+part+"&opt_seq="+seq);
	} else {
		rt_alert("시스템문제로 처리되지 않았습니다");
	}
}

function default_setting(seq) {

	if (seq) {
		$("#rt_ifrm").attr("src",rt_path['app']+"/admin/option/update.php?mode=defaultset&opt_seq="+seq);
	} else {
		rt_alert("시스템문제로 처리되지 않았습니다");
	}
}

function delete_vopt(obj) {
	$(obj).parent().parent().parent().remove();
}

;(function($) {
	$(function() {

		$("#btn-list").click(function (){
			location.href = rt_path['adm']+"/app/?appcode=product&sd=admin-option";
		});

		$("#btn-option-ins").click(function (){
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

		$("#btn-add-page").click(function (){
			var addtbl = "<tr>";
			addtbl+= "<td><div class='rt_button_wrap'><a href='javascript:;' onclick='delete_vopt(this)' class='rt_btn_red btn_in'>삭제</a></div></td>";
			addtbl+= "<td><input type='text' class='rt_input_txt required' value='' name='vopt[]' msg='옵션명을 입력해 주세요' /></td>";
			addtbl+= "</tr>";
			$("#data_table").append(addtbl);
		});
	});
})(jQuery);