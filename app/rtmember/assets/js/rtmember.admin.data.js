
function member_delete(seq,pg) {

	var path_cur_pos = rt_path['adm']+"/"+rt_layout['dr'];

	if (!pg) {pg = 1;}

	if (confirm("이 회원을 삭제하시겠습니까?")) {

		$.post(rt_path['app']+"/admin/data/update.php", {
			'mode':'delete',
			'seq':seq
		},function(data){
			eval(data);
			if (chkres) {
				location.href=path_cur_pos+"/?appcode=rtmember&sd=admin-data&cf=list&pg="+pg;
			} else {
				alert("시스템문제로 삭제되지 않았습니다.");
			}
		});
	}
}

function set_approval(flag,seq,pg) {
	
	var path_cur_pos = rt_path['adm']+"/"+rt_layout['dr'];

	if (!pg) {pg = 1;}

	if (confirm("회원상태를 변경하시겠습니까?")) {
		$.post(rt_path['app']+"/admin/data/update.php", {
			'mode':'approval',
			'seq':seq,
			'en':flag
		},function(data){
			eval(data);
			if (chkres) {
				location.href=path_cur_pos+"/?appcode=rtmember&sd=admin-data&cf=list&pg="+pg;
			} else {
				alert("시스템문제로 삭제되지 않았습니다.");
			}
		});
	}
}

;(function($) {
	$(function() {

		var f = document.dataform;
		var path_cur_pos = rt_path['adm']+"/"+rt_layout['dr'];

		$("#btn-move-list").click(function (){

			var addsch = "";
			if (f.searchstring.value) {
				var addsch = "&search="+f.search.value+"&searchstring="+f.searchstring.value;
			}
			if (f.buy_en.value) {
				addsch+= "&buy_en="+f.buy_en.value;
			}
			location.href = path_cur_pos+"/?appcode=rtmember&sd="+f.sd.value+"&cf=list&pg="+f.pg.value+addsch;
		});

		$("#btn-move-modify").click(function (){

			var addsch = "";
			if (f.searchstring.value) {
				var addsch = "&search="+f.search.value+"&searchstring="+f.searchstring.value;
			}
			if (f.buy_en.value) {
				addsch+= "&buy_en="+f.buy_en.value;
			}
			location.href = path_cur_pos+"/?appcode=rtmember&sd="+f.sd.value+"&cf=form&seq="+f.seq.value+"&pg="+f.pg.value+addsch;
		});

		$("#btn-move-insert").click(function (){
			location.href = path_cur_pos+"/?appcode=rtmember&sd="+f.sd.value+"&cf=form&pg="+f.pg.value;
		});

		$("#btn-submit").click(function (){
			f.submit();
		});

		$("#btn-search").click(function (){
			document.search_form.submit();
		});

		$("#btn-form-submit").click(function (){
			if (rt_chk_form('required')) {
				if (f.mode.value=="insert" && f.id_check.value != "y") {
					alert("아이디 체크를 해주세요");
					f.user_id.focus();
				} else if (f.mode.value=="insert" && ((f.user_pw.value != f.user_pw_re.value) || !f.user_pw.value || !f.user_pw_re.value)) {
					alert("비밀번호를 정확히 입력해 주세요");
					f.user_pw.focus();
				} else {
					f.submit();
				}
			}
		});

		$("#btn-id-check").click(function () {

			if (!f.user_id.value) {
				alert("아이디를 입력해 주세요");
				f.id_check.value = "";
				f.user_id.focus();
			} else {
				$.post(rt_path['app']+"/admin/data/update.php", {
					'mode':'check_id',
					'user_id':f.user_id.value
				},function(data){
					eval(data);
					if (chkres) {
						alert("사용 가능한 ID입니다.");
						f.id_check.value = "y";
					} else {
						alert("이미 등록된 ID입니다.");
						f.id_check.value = "";
					}
				});
			}
		});

		$("#reg_date,#mod_date,#withdraw_date,#blockout_date,#rest_date").datepicker({
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