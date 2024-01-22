//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 팝업 출력 JS
//-----------------------------------------------------------------------------------------

/* popup obj S */
__rt_popup = function (agDivId) {
	this.divID			= agDivId;			//생성할 팝업 DIV ID
	this.addPosX		= "0";				//(가로축)px 단위로 입력, minus(-) 값은 중앙에서 왼쪽으로 이동
	this.addPosY		= "0";				//(세로축)px 단위로 입력(최솟값 0)
	this.pageWidth		= "0";
};

__rt_popup.prototype.config = function (agX, agY) {
	this.addPosX = agX;
	this.addPosY = agY;
};

__rt_popup.prototype.resetPosition = function () {
	var targetID;

	this.resetPageWidth();

	targetID = document.getElementById(this.divID).style;
	if (this.pageWidth < contentWidth) {
		targetID.left = ((parseInt(contentWidth) / 2) + parseInt(this.addPosX))+"px";
	} else {
		targetID.left = ((parseInt(this.pageWidth) / 2) + parseInt(this.addPosX))+"px";
	}
	targetID.top = this.addPosY+"px";
};

__rt_popup.prototype.resetPageWidth = function () {
	this.pageWidth = this.getClientWidth();
};

__rt_popup.prototype.getClientWidth = function () {
	return document.body.clientWidth;
};
/* popup obj E */

function div_popup_close(agDivId)
{
	rt_set_cookie(agDivId, "Y", 1);
	document.getElementById(agDivId).style.display = "none";
}

function show_popup(arr)
{
	var cookieVal = "";
	for (key in arr) {
		cookieVal = rt_get_cookie(key);
		if (cookieVal != "Y") {
			eval(key+'.resetPosition()');
			document.getElementById(key).style.display = "block";
		}
	}
}

/* 오브젝트 생성 */
var temp_var = Array();
for (key in div_popup) {
	temp_var = div_popup[key].split(",");

	eval('var '+key+' = new __rt_popup("'+key+'");');
	eval(key+'.config("'+temp_var[0]+'","'+temp_var[1]+'");');
}

;(function($) {
	$(function() {

		/* 이벤트 설정 */
		$(window).resize(function () {
			for (key in div_popup) {
				eval(key+'.resetPosition()');
			}
		});
		show_popup(div_popup);
	});
})(jQuery);