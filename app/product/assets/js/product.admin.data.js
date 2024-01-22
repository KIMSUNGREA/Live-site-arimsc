
function product_delete(seq,pg) {

	var schurl = "";
	if (pg) {
		schurl+= "&pg="+pg;
	}

	if (confirm("이 제품을 삭제하시겠습니까?")) {
		$("#rt_ifrm").attr("src",rt_path['app']+"/admin/data/update.php?mode=delete&seq="+seq+schurl);
	}
}

function formtpl_apply(seq, formid) {
	$.ajax({
		url: rt_path['app']+"/admin/formtpl/update.php",
		type: "POST",
		data: {'mode':'gettpl','seq':seq},
		success: function(data) {
			se2_paste_html(formid, data);
		}
	});
}

function toggle_data(part, val) {

	if (part == "type_en") {
		if (val == "img") {
			$(".type_en_img").show();
			$(".type_en_html").hide();
			$(".type_en_field").hide();
		} else if (val == "html") {
			$(".type_en_img").hide();
			$(".type_en_html").show();
			$(".type_en_field").hide();
		} else if (val == "field") {
			$(".type_en_img").hide();
			$(".type_en_html").hide();
			$(".type_en_field").show();
		}
	}
}

function delete_vopt(obj) {
	$(obj).parent().parent().parent().remove();
}

function ord_chg(part, seq, schcate) {

	if (seq && part) {
		$("#rt_ifrm").attr("src",rt_path['app']+"/admin/data/update.php?mode=chgord&part="+part+"&seq="+seq+"&schcate="+schcate);
	} else {
		alert("시스템문제로 처리되지 않았습니다");
	}
}

;(function($) {
	$(function() {

		var f = document.dataform;
		var path_cur_pos = rt_path['adm']+"/"+rt_layout['dr'];

		$("#btn-search").click(function (){
			document.search_form.submit();
		});

		$("#btn-tpl").click(function (){
			if ($("#area-tpl").css("display")=="none") {
				$("#area-tpl").slideDown(200);
			} else {
				$("#area-tpl").slideUp(200);
			}
		});

		$("#btn-move-list").click(function (){

			var addsch = "";
			if (f.searchstring.value) { addsch+= "&search="+f.search.value+"&searchstring="+f.searchstring.value; }
			if (f.schcate.value) { addsch+= "&schcate="+f.schcate.value; }
			if (f.pg.value) { addsch+= "&pg="+f.pg.value; }
			location.href = path_cur_pos+"/?appcode=product&sd="+f.sd.value+"&cf=list"+addsch;
		});

		$("#btn-form-submit").click(function (){
			var form = document.dataform;

			if ($("input[name=type_en]:checked").val() == "field") {
				se2_editor_contents("detail_cont");
				if (rt_chk_form('required')){
					form.submit();
				}
			} else {
				if (form.cate.value == "") {
					alert("분류를 입력해 주세요");
				} else if (form.cate.value == "") {
					alert("제품명을 입력해 주세요");
				} else {
					form.submit();
				}
			}
		});

		$("#btn-add-page").click(function (){
			var addtbl = "<tr>";
			addtbl+= "<td><div class='rt_button_wrap'><a href='javascript:;' onclick='delete_vopt(this)' class='rt_btn_red btn_in'>삭제</a></div></td>";
			addtbl+= "<td><input type='text' class='rt_input_txt required' value='' name='vopt_tit[]' msg='옵션명을 입력해 주세요' /></td>";
			addtbl+= "<td><input type='text' class='rt_input_txt required' value='' name='vopt_val[]' msg='옵션데이터를 입력해 주세요' /></td>";
			addtbl+= "</tr>";
			$("#data_table").append(addtbl);
		});

		$("#reg_date,#mod_date").datepicker({
			monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
			dateFormat: 'yy-mm-dd',
			buttonText: '달 력',
			prevText: '이전달',
			nextText: '다음달'
		});
	});
})(jQuery);