<?php
@error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );

session_start();

header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
header("Content-Type: text/html; charset=UTF-8");
header("Progma:no-cache");
header("Cache-Control:no-cache,must-revalidate");

require_once "lib/common.lib.php";

if($_POST[mode]=='dmake')
{
	check_dir($_POST[newdname], "디렉토리");
	if(file_exists($_POST[BASEPATH].$_POST[SUBPATH].$_POST[newdname]))
	{
		echo"<script>alert(\"같은이름의 디렉토리가 있습니다\"); history.go(-1);</script>";
		exit;
	}
	@mkdir($_POST[BASEPATH].$_POST[SUBPATH].$_POST[newdname], 0755);
	@chmod($_POST[BASEPATH].$_POST[SUBPATH].$_POST[newdname], 0777);
	?>
<script>
window.alert('디렉토리를 추가하였습니다!');
window.location='webftp.php?SUBPATH=<?=$_POST[SUBPATH]?>';
</script>
	<?
	exit;
}
elseif($_POST[mode]=='rename')
{
	check_name($_POST[name], "");
	if(file_exists($_POST[BASEPATH].$_POST[SUBPATH].$_POST[name]))
	{
		echo"<script>alert(\"같은이름이 있습니다\"); history.go(-1);</script>";
		exit;
	}
	rename($_POST[BASEPATH].$_POST[SUBPATH].$_POST[oname], $_POST[BASEPATH].$_POST[SUBPATH].$_POST[name]);
	?>
<script>
window.alert('이름을 변경 하였습니다!');
window.location='webftp.php?SUBPATH=<?=$_POST[SUBPATH]?>';
</script>
	<?
	exit;
}
elseif($_GET[mode]=='fdelete_check')
{
	if(file_exists($_GET[BASEPATH].$_GET[SUBPATH].$_GET[rmfile]))
	{
		@unlink($_GET[BASEPATH].$_GET[SUBPATH].$_GET[rmfile]);
		?>
<script>
window.alert('파일을 삭제하였습니다!');
window.location='webftp.php?SUBPATH=<?=$_GET[SUBPATH]?>';
</script>
		<?
		exit;
	}
	else
	{
		echo"<script>alert(\"파일이 존재하지 않습니다\"); history.go(-1);</script>";
		exit;
	}
}
elseif($_GET[mode]=='rmdir_check')
{
	if(file_exists($_GET[BASEPATH].$_GET[SUBPATH].$_GET[rmdir]))
	{
		if(deldir($_GET[BASEPATH].$_GET[SUBPATH].$_GET[rmdir]))
		{
			?>
<script>
window.alert('디렉토리를 삭제하였습니다!');
window.location='webftp.php?SUBPATH=<?=$_POST[SUBPATH]?>';
</script>
			<?
		}
		else
		{
			echo"<script>alert(\"삭제중 오류 발생\"); history.go(-1);</script>";
		}
		exit;
	}
	else
	{
		echo"<script>alert(\"삭제중 오류 발생\"); history.go(-1);</script>";
		exit;
	}
}
elseif($_POST[mode]=='multi_del')
{
	if (count($_POST[obj_check])<1)
	{
		echo "<script>alert ('파일 또는 폴더를 하나 이상 선택해주세요'); history.go(-1);</script>";
		exit;
	}
	while($tmp_mfc=each($_POST[obj_check]))
	{
		if(file_exists($_POST[BASEPATH].$_POST[SUBPATH].$tmp_mfc[1]))
		{
			if (is_dir($_POST[BASEPATH].$_POST[SUBPATH].$tmp_mfc[1]))
			{
				deldir($_POST[BASEPATH].$_POST[SUBPATH].$tmp_mfc[1]);
			}
			else
			{
				unlink($_POST[BASEPATH].$_POST[SUBPATH].$tmp_mfc[1]);
			}
		}
		else
		{
			echo "<script>alert ('".$tmp_mfc[1]."파일(디렉토리)이 존재하지 않습니다'); history.go(-1);</script>";
			exit;
		}
	}
	?>
<script>
window.alert('파일(디렉토리)를 삭제하였습니다!');
window.location='webftp.php?SUBPATH=<?=$_POST[SUBPATH]?>';
</script>
	<?
	exit;
}
elseif($_POST[mode]=='filemake')
{
	if (count($_FILES[userfile][tmp_name])<1)
	{
		echo "<script>alert ('파일을 하나 이상 올려주세요'); history.go(-1);</script>";
		exit;
	}
	for ($i = 0; $i < count($_FILES[userfile][tmp_name]); $i++)
	{
		if (is_uploaded_file($_FILES[userfile][tmp_name][$i]))
		{
			$ext = strrchr($_FILES[userfile][name][$i], '.');
			$tName = substr($_FILES[userfile][name][$i], 0, strlen($_FILES[userfile][name][$i]) - strlen($ext));
			$saveFileName = $tName . $ext;
			$j = 0;
			while (file_exists($_POST[BASEPATH].$_POST[SUBPATH].$saveFileName))
			{
				$j++;
				$saveFileName =  $tName . $j . $ext;
			}
			@copy($_FILES[userfile][tmp_name][$i], $_POST[BASEPATH].$_POST[SUBPATH].$saveFileName);
			@chmod($_POST[BASEPATH].$_POST[SUBPATH].$saveFileName, 0777);
			@unlink($_FILES[userfile][tmp_name][$i]);
		}
	}
	?>
<script>
window.alert('파일 전송이 완료되었습니다.');
window.location='webftp.php?SUBPATH=<?=$_POST[SUBPATH]?>';
</script>
	<?
	exit;
}

//현재 파일 기준으로 최상위 디렉토리 설정
$BASEPATH = "../../../";
$SUBPATH = ($_GET[SUBPATH] && substr($_GET[SUBPATH],0,1) != '.' && substr($_GET[SUBPATH],0,1) != '/')?$_GET[SUBPATH]:"";

$__d=ereg_replace("/rintkit/plugin/webftp/webftp.php","",$_SERVER[PHP_SELF]);
$FULL_PATH = "http://" . $_SERVER[HTTP_HOST]."/".$__d;

$FileSize = '';
$FileSum = '';

$_fileArr = getFileEntry($BASEPATH.$SUBPATH);

echo "<pre>";
//print_r($_fileArr);
echo "</pre>";
?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>웹FTP 업로드</title>
	<link rel="stylesheet" href="assets/css/imgupload.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script language="javascript">
	<!--
	function check_open()
	{
		if(ns0.style.display == "none")
		{
			modify_form.ch_skin.checked = true;
			ns0.style.display = "block";
			ns1.style.display = "block";
			ns2.style.display = "block";
		}
		else
		{
			modify_form.ch_skin.checked = false;
			ns0.style.display = "none";
			ns1.style.display = "none";
			ns2.style.display = "none";
		}
	}

	function modify_open(name)
	{
		modify_form.ch_skin.checked = true;
		ns0.style.display = "block";
		ns1.style.display = "block";
		ns2.style.display = "block";
		modify_form.oname.value = name;
	}

	function selectFile(selDir, selFile)
	{
		var fullPath = "<?=$FULL_PATH?>";
		var elVisible;
		var urlText = "";
		var ratio = 1;
		var vFile = false;
		var subUrl = selDir + selFile;

		if (selFile.match(/\.(gif|jpg|bmp|png)$/i))
		{
			vFile = true;
			elVisible = new Image();
			elVisible.src = fullPath + selDir + selFile;
			elVisible.border = 0;
		}
		else if (selFile.match(/\.(swf|mpeg|mpg|asf)$/i))
		{
			vFile = true;
			elVisible = document.createElement("<EMBED>");
			elVisible.src = fullPath + selDir + selFile;
			elVisible.width = 350;
			elVisible.height = 300;
		}
/*
		if (vFile)
		{
			var objViewArea = document.all("viewArea");
			objViewArea.swapNode(elVisible);
			elVisible.id = "viewArea";
			if (elVisible.width > 550)
			{
				ratio = elVisible.height / elVisible.width ;
				elVisible.width = 550;
				elVisible.height = 550 * ratio;
			}
		}
		urlText = fullPath + selDir + selFile;
*/
		if (vFile){
			$("#viewArea").attr("src",elVisible.src);
		}
		$("#id_url").text(elVisible.src);
		//document.all("id_url").value = elVisible.src;
	}

	function selectAll()
	{
		for (var i=0;i<document.selectform.elements.length;i++)
		{
			var target = document.selectform.elements[i];
			if(target.name == 'obj_check[]' && target.checked==false)
			{
				target.click();
			}
		}
	}

	function deSelectAll()
	{
		for (var i=0;i<document.selectform.elements.length;i++)
		{
			var target = document.selectform.elements[i];
			if(target.name == 'obj_check[]' && target.checked==true)
			{
				target.click();
			}
		}
	}

	function copyitem()
	{
		var IE=(document.all)?true:false;
		var txt = $("#id_url").text();
		if(!txt) {
			alert('복사할 URL이 없습니다.');
		} else {
			if (IE) {
				window.clipboardData.setData("Text",txt);
				alert('복사가 되었습니다.\n\n원하는 위치에서 붙여넣기를 하세요.');
			} else {
				alert("이 주소를 드래그하여 선택한후 Ctrl+C를 눌러 복사하세요");
			}
		}
	}

	var fileHTML = null;
	function addUploadFile()
	{
		var objTbody, objRow, objCell;
		if (fileHTML == null)
		{
			fileHTML = document.all.id_form_file[0].outerHTML;
		}
		objTbody = document.all("id_add_table");
		objRow = objTbody.insertRow();
		objCell = objRow.insertCell();
		objCell.insertAdjacentHTML("AfterBegin", fileHTML);
	}
	//-->
	</script>
</head>
<body>
	<div id="wrap">
		<h1 class="title">FILE MANAGER</h1>
		<div class="con cfix">
			<div class="left">
				<h2 class="tit">현재폴더 : <?=$SUBPATH?"./".$SUBPATH:"."?></h2>
				<form name="selectform" method="post" action='<?= $_SERVER[PHP_SELF]?>'>
				<input type="hidden" name="mode" value="multi_del">
				<input type="hidden" name="BASEPATH" value="<?= $BASEPATH?>">
				<input type="hidden" name="SUBPATH" value="<?= $SUBPATH?>">
				<div class="left_center">
					<table class="left_table">
						<caption>파일선택</caption>
						<thead>
							<tr>
								<th class="col1">*</th>
								<th class="col2"></th>
								<th class="col3">이름</th>
								<th class="col4">크기</th>
								<th class="col5">바뀐날짜</th>
								<th class="col6"></th>
							</tr>
						</thead>
						<tbody>
							<?php
							if($SUBPATH)
							{
								$_xd = explode("/", $SUBPATH);
								for($_r=0; $_r<count($_xd)-2;$_r++)
								{
									$_sub[] = $_xd[$_r];
								}
								$_SUBPATH = count($_sub)?implode("/",$_sub):"";
							?>
							<tr>
								<td class="col1"></td>
								<td class="col2"><img src="assets/img/ico_folder.gif" alt="폴더"></td>
								<td class="col3"><a href="<?= $_SERVER[PHP_SELF]?>?SUBPATH=<?= $_SUBPATH?>/">..</a></td>
								<td class="col4"></td>
								<td class="col5"></td>
								<td class="col6"></td>
							</tr>
								<?php
							}
							sort($_fileArr[dir]);
							for($i=0; $i<count($_fileArr[dir]); $i++)
							{
								?>
							<tr>
								<td class="col1"><?=$_fileArr[dir][$i][no]?></td>
								<td class="col2"><img src="assets/img/ico_folder.gif" alt="폴더"></td>
								<td class="col3"><?=$_fileArr[dir][$i][name]?></td>
								<td class="col4"><?=$_fileArr[dir][$i][size]?></td>
								<td class="col5"><?=$_fileArr[dir][$i][lasttime]?></td>
								<td class="col6"><?=$_fileArr[dir][$i][rename]?><?=$_fileArr[dir][$i][del]?></td>
							</tr>
								<?php
							}
							sort($_fileArr[file]);
							for($i=0; $i<count($_fileArr[file]); $i++)
							{
								?>
							<tr>
								<td class="col1"><?=$_fileArr[file][$i][no]?></td>
								<td class="col2"><?=$_fileArr[file][$i][icon]?></td>
								<td class="col3"><?=$_fileArr[file][$i][name]?></td>
								<td class="col4"><?=$_fileArr[file][$i][size]?>B</td>
								<td class="col5"><?=$_fileArr[file][$i][lasttime]?></td>
								<td class="col6"><?=$_fileArr[file][$i][rename]?><?=$_fileArr[file][$i][del]?></td>
							</tr>
								<?php
							}
							?>
						</tbody>
					</table>
				</div>
				<div class="left_bottom">
					<p class="btn_wrap"><a href="javascript:selectAll();">전체선택</a> <a href="javascript:deSelectAll();">선택해제</a> <!-- <a href="javascript:return confirm('선택한 파일을 모두 삭제하시겠습니까?')">선택삭제</a> --></p>
					<p class="right_txt"><span class="txt_color_red"><?= $FileSum?number_format($FileSum):""?></span> Files <span class="txt_color_red"><?= intval($FileSize/1024)?number_format($FileSize/1024):$FileSize?></span> <?= intval($FileSize/1024)?"K":""?>B</p>
				</div>
				</form>
			</div>
			<div class="right">
				<h2 class="tit">선택 파일 URL 보기</h2>
				<div class="right_con">
					<div class="right_top mb10">
						<div class="file_url">
							<div class="input_wrap">
								<p class="input_box" id="id_url" style="height:25px;line-height:25px;"></p>
								<p class="btn btn_wrap"><a href="javascript:copyitem()">URL 복사</a></p>
							</div>
						</div>
						<!-- <div class="file_img">
							<p class="img"><img src="assets/img/default_img.gif" id="viewArea" alt="파일미리보기"></p>
						</div> -->
					</div>

					<h2 class="tit">파일 추가하기</h2>
					<div class="right_bottom">
						<div class="input_wrap input_wrap2">
							<!-- 파일업로드 -->
					
							<!-- //파일업로드 -->
						 </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
