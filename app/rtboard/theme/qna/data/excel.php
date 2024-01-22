<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";

//파일명
$file_name = iconv("UTF-8","EUC-KR","사은품_미지급_목록_".date("Ymdhis").".xls");

header("Content-type: application/vnd.ms-excel"); 
//header("Content-charset=utf-8");
header("Content-Disposition: attachment; filename=$file_name" ); 
?>
<meta http-equiv="Content-Type" content="application/vnd.ms-excel;charset=utf-8"> 
<style>
table{
	width: 400px;
	border: 1px solid #CDCDCD;
	border-collapse: collapse;
	margin:0;
	font-size: 11px;
	font-family:'나눔고딕',NanumGothic,"dotum";
	text-align: center;
}
tr{
	height:30px;
}
th{
	font-weight:normal;
	background-color:#EEEEEE;
	border-bottom: 1px solid #CDCDCD;
	border-right: 1px solid #CDCDCD;
	text-align:center;
}

td{
	padding: 5px;
	border-bottom:1px solid lightgrey;
	border-right: 1px solid #CDCDCD;
	vertical-align:middle;
	text-align:left;
	color:#666666;
}
</style>
<table>

	<thead>
	<tr>
		<th><p>번호</p></th>
		<th><p>성명</p></th>
		<th><p>휴대폰</p></th>
		<th><p>등록일</p></th>
	</tr>
	</thead>
	<tbody>
	<?php
	$_l = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_QNA WHERE bcode='req' AND give_en='n' ORDER BY seq DESC");
	$num = 1;
	for ($i = 0 ; $i < count($_l) ; $i++) {
	?>
	<tr>
		<td><p><?php echo $num;?></p></td>
		<td><p><?php echo $_l[$i]['name'];?></p></td>
		<td style=mso-number-format:'\@'><p><?php echo $_l[$i]['phone'];?></p></td>
		<td><p><?php echo date("Y.m.d", strtotime($_l[$i]['reg_date']));?></p></td>
	</tr>
	<?php
		$num++;
	}
	?>
	</tbody>
</table>
