<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<table class="rt_list_table">
	<caption>APP목록</caption>
	<colgroup>
		<col style="width:5%"/>
		<col style="width:10%"/>
		<col style=""/>
		<col style="width:20%"/>
		<col style="width:10%"/>
		<col style="width:10%"/>
		<col style="width:10%"/>
	</colgroup>
	<thead>
		<tr>
			<th><p>플러그</p></th>
			<th><p>APP 코드</p></th>
			<th><p>APP 이름</p></th>
			<th><p>설치경로</p></th>
			<th><p>관리</p></th>
			<th><p>버전</p></th>
			<th><p>개발자</p></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$_url = RTW_ADM."/".$__dr;
		for ($m = 0; $m < count($_list); $m++) {
			$plug_str = ($_list[$m]['app_plug_en']=="on") ? "<font color='#0000ff'><b>IN</b></font>" : "<font color='#999999'>OUT</font>";
			?>
		<tr>
			<td><p><?php echo $plug_str;?></p></td>
			<td><p><a href="<?php echo $_url;?>/?sd=applist&cf=form&app_seq=<?php echo $_list[$m]['app_seq'];?>"><?php echo $_list[$m]['app_code'];?></a></p></td>
			<td style="text-align:left;padding-left:10px;"><p><a href="<?php echo $_url;?>/?sd=applist&cf=form&app_seq=<?php echo $_list[$m]['app_seq'];?>"><?php echo $_list[$m]['app_name'];?></a></p></td>
			<td style="text-align:left;padding-left:10px;"><p><a href="<?php echo $_url?>/?sd=applist&cf=form&app_seq=<?php echo $_list[$m]['app_seq'];?>"><?php echo $_list[$m]['app_path'];?></a></p></td>
			<td><p><span class="rt_button_wrap"><a href="javascript:delete_data('<?php echo $_list[$m]['app_code'];?>','<?php echo $_list[$m]['app_path'];?>')" class="rt_btn_red btn_in">초기화</a></span></p></td>
			<td><p><?php echo $_list[$m]['app_version'];?></p></td>
			<td><p><?php echo $_list[$m]['app_dever'];?></p></td>
		</tr>
			<?php
		}?>
	</tbody>
</table>
<div class="rt_button_wrap">
	<a href="#;" id="btn-move-form" class="rt_btn_blue">APP 등록</a>
</div>

<script src="assets/js/appsetup.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>
