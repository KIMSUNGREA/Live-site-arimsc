
function img_delete(seq) {
	if (confirm("이미지를 삭제하시겠습니까?")) {
		$("#rt_ifrm").attr("src",rt_path['adm']+"/popup/popup/update.php?mode=imgdel&seq="+seq);
	}
}

function popup_delete(seq) {
	if (seq) {
		if (confirm("팝업을 삭제하시겠습니까?")) {
			$("#rt_ifrm").attr("src",rt_path['adm']+"/popup/popup/update.php?mode=delete&seq="+seq);
		}
	} else {
		rt_alert("시스템문제로 처리되지 않았습니다");
	}
}

function formtpl_delete(seq) {

	if (seq) {
		if (confirm("글쓰기 폼 템플릿을 삭제하시겠습니까?")) {
			$("#rt_ifrm").attr("src",rt_path['adm']+"/popup/formtpl/update.php?mode=delete&seq="+seq);
		}
	}
}

function formtpl_chg(part, seq) {

	if (seq && part) {
		$("#rt_ifrm").attr("src",rt_path['adm']+"/popup/formtpl/update.php?mode=chgord&part="+part+"&seq="+seq);
	} else {
		alert("시스템문제로 처리되지 않았습니다");
	}
}

function formtpl_apply(seq, formid) {
	$.ajax({
		url: rt_path['adm']+"/popup/formtpl/update.php",
		type: "POST",
		data: {'mode':'gettpl','seq':seq},
		success: function(data) {
			se2_paste_html(formid, data);
		}
	});
}

;(function($) {
	$(function() {

		var f = document.dataform;
		var path_cur_pos = rt_path['adm']+"/"+rt_layout['dr'];

		$("#btn-move-list").click(function (){
			location.href = path_cur_pos+"/?sd=popup&cf=list";
		});

		$("#btn-move-form").click(function (){
			location.href = path_cur_pos+"/?sd=popup&cf=form";
		});

		$("#btn-submit").click(function (){
			if (rt_chk_form('required')) {
				if (f.content_type.value == "") {
					alert("팝업 콘텐츠 타입을 이미지 혹은 HTML 중 선택해 주세요");
				} else {
					if (f.content_type.value == "html") {
						se2_editor_contents("content_html");
					}
					f.submit();
				}
			}
		});

		$("#con_type_img").click(function (){
			$("#tr_img1").show();
			$("#tr_img2").show();
			$("#tr_img3").show();
			$("#tr_img4").show();
			$("#tr_img5").show();
			$("#tr_html").hide();
			f.content_type.value = 'img';
		});

		$("#con_type_html").click(function (){
			$("#tr_html").show();
			$("#tr_img1").hide();
			$("#tr_img2").hide();
			$("#tr_img3").hide();
			$("#tr_img4").hide();
			$("#tr_img5").hide();
			$("#num").val(1);
			f.content_type.value = 'html';
		});

		$("#btn-list").click(function (){
			window.location.href = path_cur_pos+"/?sd=formtpl&cf=list";
		});

		$("#btn-formtpl-ins").click(function (){
			var form = document.ins_form;
			if(rt_chk_form('required')){
				form.submit();
			}
		});

		$("#btn-form-submit").click(function (){
			var form = document.data_form;

			se2_editor_contents("content");
			if(rt_chk_form('required')){
				form.submit();
			}
		});

		$("#btn-tpl").click(function (){
			if ($("#area-tpl").css("display")=="none") {
				$("#area-tpl").slideDown(200);
			} else {
				$("#area-tpl").slideUp(200);
			}
		});

		$("#sdate,#edate").datepicker({
			monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
			dateFormat: 'yy-mm-dd',
			buttonText: '달 력',
			prevText: '이전달',
			nextText: '다음달'
		});

		$("#btn-popup-pos").click(function (){

			if (f.size_w.value == "") {
				alert("팝업의 가로 사이즈를 정확히 입력해 주세요");
				f.size_w.focus();
			} else if (f.size_h.value == "") {
				alert("팝업의 세로 사이즈를 정확히 입력해 주세요");
				f.size_h.focus();
			} else {
				var seq = (f.seq.value)?f.seq.value:0;
				window.open(rt_path['adm']+'/popup/popup/rt-pp/?popw='+f.size_w.value+'&poph='+f.size_h.value+"&posx="+f.pos_x.value+"&posy="+f.pos_y.value+"&seq="+seq,'_blank','scrollbars=yes,resizable=yes,width=1400,height=800');
			}

		});

		if (f.mode.value == "insert") {
			$("#con_type_img").trigger("click");
		}
	});
})(jQuery);
