<?php
//----------------------------------------------------------------------------------------------
ini_set("memory_limit",-1);
require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ROOT."/engine.php";

//----------------------------------------------------------------------------------------------

//웹에디터 업로드 이미지 사이즈(최대 가로 수치 입력(px), 세로는 상대 비율로 설정됨)
$_img_cut_widht = 700;

//----------------------------------------------------------------------------------------------

rt_load_component("thumbnail");

//----------------------------------------------------------------------------------------------

// default redirection
$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if(bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];
	
	$filename_ext = strtolower(array_pop(explode('.',$name)));
	$allow_file = array("jpg", "png", "bmp", "gif");
	
	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$name;
	} else {
		$uploadDir = '../../upload/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}
		
		$fn = rt_set_new_file_name($_FILES['Filedata']['name']);
		$newPath = $uploadDir.$fn;

		@move_uploaded_file($tmp_name, $newPath);

		//이미지 사이즈 조절(환경설정)
		$wpath = RTW_PLUGIN."/SE2.8.2.O12056/upload/";
		$arrtmp = rt_get_relative_size($wpath.$fn, $_img_cut_widht, 1000);

		if ($arrtmp['width'] > $_img_cut_widht) {
			$cls_thumb = new thumbnail();
			$newname = $cls_thumb->resize_image_webeditor($uploadDir, $fn, $arrtmp['width'], $arrtmp['height']);
		} else {
			$newname = $fn;
		}

		$url .= "&bNewLine=true";
		$url .= "&sFileName=".urlencode($newname);
		$url .= "&sFileURL=".RTW_PLUGIN."/SE2.8.2.O12056/upload/".urlencode($newname);
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}
	
header('Location: '. $url);
?>