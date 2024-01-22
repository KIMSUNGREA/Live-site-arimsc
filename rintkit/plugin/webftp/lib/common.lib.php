<?php
function getFileEntry($dir = '')
{
	global $BASEPATH, $SUBPATH, $FileSize, $FileSum;

	if (empty($dir))
	{
		$dir = '.';
	}
	$objDir = dir($dir);			// 디렉토리 읽어오기
	$arrEntry[dir] = array();		// 디렉토리저장
	$arrEntry[file] = array();		// 파일저장
	$m=0;
	$n=0;
	while ($entry = $objDir->read())
	{
		if ($entry == '.' || $entry == '..')
		{
			continue;
		}
		else if (is_dir("{$dir}/{$entry}"))
		{
			$arrEntry[dir][$m][no] = "<input type=checkbox name='obj_check[]' value='$entry'>";
			$arrEntry[dir][$m][name] = "<a href='".$_SERVER[PHP_SELF]."?SUBPATH=".$SUBPATH.$entry."/'>".$entry."</a>";
			$arrEntry[dir][$m][size] = "";
			$arrEntry[dir][$m][lasttime] = date("n/d H:i", filemtime($dir."/".$entry));
			$arrEntry[dir][$m][rename] = "<img src=\"assets/img/ico_rename.gif\" border=\"0\" alt=\"이름바꾸기\" onClick=\"modify_open('".$entry."');\" style=\"cursor:pointer\">";
			$arrEntry[dir][$m][del] = "<a href='".$_SERVER[PHP_SELF]."?mode=rmdir_check&rmdir=".$entry."&BASEPATH=$BASEPATH&SUBPATH=$SUBPATH' onclick=\"return confirm('".$entry." 디렉토리를 삭제하시겠습니까?')\"><img src=\"assets/img/ico_delete.gif\" border=\"0\"></a>";

			$m++;
		}
		else
		{
			$filetype = explode(".", $entry);
			$filetype = $filetype[sizeof($filetype)-1];
			switch (strtolower($filetype))
			{
				case "gif": $fileicon="ico_gif.gif"; break;
				case "jpg": $fileicon="ico_jpg.gif"; break;
				case "bmp": $fileicon="ico_bmp.gif"; break;
				case "png": $fileicon="ico_png.gif"; break;
				case "swf": $fileicon="ico_swf.gif"; break;
				default: $fileicon="ico_default.gif"; break;
			}
			if (in_array (strtolower($filetype), array('gif','jpg','bmp','png','swf','zip')))
			{
				$arrEntry[file][$n][no] = "<input type=checkbox name='obj_check[]' value='".$entry."'>";
				$arrEntry[file][$n][icon] = "<img src='assets/img/$fileicon'>";
				$arrEntry[file][$n][name] = "<a href=\"javascript:selectFile('".substr($dir, 2)."','$entry')\">".$entry."</a>";
				$arrEntry[file][$n][size] = (filesize($dir."/".$entry)>1024)?number_format(filesize($dir."/".$entry)/1024)." K":number_format(filesize($dir."/".$entry))." ";
				$arrEntry[file][$n][lasttime] = date("n/d H:i", filemtime($dir."/".$entry));
				$arrEntry[file][$n][rename] = "<img src=\"assets/img/ico_rename.gif\" border=\"0\" alt=\"이름바꾸기\" onClick=\"modify_open('".$entry."');\" style=\"cursor:pointer\">";
				$arrEntry[file][$n][del] = "<a href='".$_SERVER[PHP_SELF]."?mode=fdelete_check&rmfile=".$entry."&BASEPATH=$BASEPATH&SUBPATH=$SUBPATH' onclick=\"return confirm('".$entry." 파일을 삭제하시겠습니까?')\"><img src=\"assets/img/ico_delete.gif\" border=\"0\" alt=\"삭제\"></a>";
				$FileSize = $FileSize+filesize($dir."/".$entry);
				$FileSum++;
				$n++;
			}
		}
	}
	$objDir->close();
	return $arrEntry;
}

function check_dir($a='', $b='')
{
	if(!(ereg("^[a-zA-Z0-9_]+$", $a)))
	{
		echo"<script>alert (\"".$b."이름은 영어 대,소문자와 숫자로만 가능합니다\"); history.go(-1);</script>";
		exit;
	}
}

function check_name($a='', $b='')
{
	if(!(ereg("^[._a-zA-Z0-9-]+.[a-zA-Z]+$", $a)) && !(ereg("^[a-zA-Z0-9_]+$", $a)))
	{
		echo"<script>alert (\"".$b."이름은 영어 대,소문자와 숫자로만 가능합니다\"); history.go(-1);</script>";
		exit;
	}
}

function deldir($dir)
{
	$handle = opendir($dir);
	while (false!==($FolderOrFile = readdir($handle)))
	{
		if($FolderOrFile != "." && $FolderOrFile != "..")
		{
			if(is_dir("$dir/$FolderOrFile"))
			{
				deldir("$dir/$FolderOrFile");
			}
			else
			{
				unlink("$dir/$FolderOrFile");
			}
		}
	}
	closedir($handle);
	if(rmdir($dir)) $success = true;
	return $success;
}
?>