
/** 
 * 다음 필드 커서 자동이동
 * 
 * @param String		cls					: 클래스명
 *
 * autoTab(object, 문자수, event)"
 * ex) onKeyUp="return autoTab(this,3, event);"
 */

var isNN = (navigator.appName.indexOf("Netscape")!=-1);
function rt_auto_tab(input,len, e) {

	var keyCode = (isNN) ? e.which : e.keyCode; 
	var filter = (isNN) ? [0,8,9] : [0,8,9,16,17,18,37,38,39,40,46];
	if(input.value.length >= len && !containsElement(filter,keyCode)) {
		input.value = input.value.slice(0, len);
		input.form[(getIndex(input)+1) % input.form.length].focus();
	}
	function containsElement(arr, ele) {
		var found = false, index = 0;
		while(!found && index < arr.length)
			if(arr[index] == ele)
			found = true; 
			else
			index++;
		return found;
	}
	function getIndex(input) {
		var index = -1, i = 0, found = false;
		while (i < input.form.length && index == -1)
			if (input.form[i] == input)index = i;
			else i++;
		return index;
	}
	return true;
}

/** 
 * 필수 필드 체크
 * 
 * 특정 클래스가 폼함된 폼요소의 유효성 체크
 */

function rt_chk_form(cls) {

	var auth = true;
	var cnt = 0;
	var inputtype = "";

	$("."+cls).each(function () {

		inputtype = $(this).attr("type");

		if (inputtype == "checkbox") {
			if (!$(this).is(":checked")) {
				alert($(this).attr("msg"));
				auth = false;
				return false;
			}
		} else {
			if ($(this).val()=="") {
				$(this).focus();
				alert($(this).attr("msg"));
				auth = false;
				return false;
			}
		}

		cnt++;
	});
	
	return auth;
}


/**
 * 쿠키 설정
 * 
 * @param String		name					: 쿠키명
 * @param String		value					: 저장 데이터
 * @param String		expiredays				: 쿠키 만료일
 */

function rt_set_cookie(name, value, expiredays) {

	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";";
}


/**
 * 쿠키 데이터 가져오기
 * 
 * @param String		name					: 쿠키명
 */

function rt_get_cookie(name) {

	var nameOfCookie = name + "=";
	var x = 0;
	while (x <= document.cookie.length)
	{
		var y = (x+nameOfCookie.length);
		if (document.cookie.substring( x, y ) == nameOfCookie) {
			if ((endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
					endOfCookie = document.cookie.length;
					return unescape( document.cookie.substring( y, endOfCookie ) );
		}
		
		x = document.cookie.indexOf( " ", x ) + 1;
		
		if (x == 0)
			break;
	}
	return "";
}


/**
 * 쿠키 삭제
 * 
 * @param String		name					: 쿠키명
 */

function rt_del_cookie(name) {
	rt_set_cookie(name, '', time()-3600, '/');
}

/**
 * 오픈 팝업
 * 
 * @param String		fpath						: 경로를 포함하는 파일명
 * @param String		width					: 팝업 가로 사이즈
 * @param String		height					: 팝업 세로 사이즈
 */

function rt_win_open(fpath, width, height) {
	window.open(fpath,'nwin','toolbar=no,menubar=no,location=no,directions=no, scrollbars=no,status=no,width='+width+',height='+height); 
}


/**
 * 모바일 여부 확인
 */

function rt_is_mobile() {
	var mobileKeyWords = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Mobile', 'Symbian', 'Opera Mobi', 'Opera Mini', 'IEmobile');
	for (var word in mobileKeyWords){if (navigator.userAgent.match(mobileKeyWords[word]) != null){var pMobile = true;}}
}

/**
 * PHP의 implode 내장함수를 JS로 구현
 * 원문 : http://locutus.io/php/strings/implode/
 */

function js_implode (glue, pieces) {
	//  discuss at: http://locutus.io/php/implode/
	// original by: Kevin van Zonneveld (http://kvz.io)
	// improved by: Waldo Malqui Silva (http://waldo.malqui.info)
	// improved by: Itsacon (http://www.itsacon.net/)
	// bugfixed by: Brett Zamir (http://brett-zamir.me)
	//   example 1: implode(' ', ['Kevin', 'van', 'Zonneveld'])
	//   returns 1: 'Kevin van Zonneveld'
	//   example 2: implode(' ', {first:'Kevin', last: 'van Zonneveld'})
	//   returns 2: 'Kevin van Zonneveld'

	var i = ''
	var retVal = ''
	var tGlue = ''

	if (arguments.length === 1) {
		pieces = glue
		glue = ''
	}

	if (typeof pieces === 'object') {
		for (i in pieces) {
			retVal += tGlue + pieces[i]
			tGlue = glue
		}
		return retVal
	}

	return pieces
}