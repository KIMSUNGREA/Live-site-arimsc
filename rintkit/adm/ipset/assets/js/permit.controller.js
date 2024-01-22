function goInsSubmit()
{
	var isSubmit = true;
	for(var i=1; i < 4; i++)
	{
		if($("input[name=ip"+i+"]").val() == "")
		{
			alert("IP를 입력해 주세요");
			$("input[name=ip"+i+"]").focus();
			return false;
		}
	}
	$("input[name=type]").each(function (){
		
		if($(this).attr("checked"))
		{
			if($("input[name=ip4]").val() == "" && $(this).val() == "O")
			{
				alert("IP를 입력해 주세요");
				$("input[name=ip4]").focus();
				isSubmit = false;
			}
		}
	});
	if(isSubmit) $("form[name=dataform]").submit();
}

function goDel(seq)
{
	if (seq) {
		if(confirm("해당 IP를 삭제하시겠습니까?"))
		{
			$("#rt_ifrm").attr("src",rt_path['adm']+"/ipset/ipset/update.php?delKey="+seq);
		}
	} else {
		rt_alert("시스템문제로 처리되지 않았습니다");
	}
}

;(function($) {
	$(function() {

		$("#stO").click(function (){
			$("#sel_O").html('');
			$("#sel_B").html('<input type="text" name="ip4" class="rt-input" maxlength="3" style="width:50px;">');
		});

		$("#stB").click(function (){
			$("#sel_O").html('');
			$("#sel_B").html('*');
		});

	});
})(jQuery);