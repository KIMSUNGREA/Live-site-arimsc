<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php if ($rt_conf_db['ip_set_type'] == "P") { ?>
<form name="dataform" action="<?php echo $__sc?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="part" value="permit">
<input type="hidden" name="mode" value="insert">
<table class="rt_field_table mb10">
	<caption>IP 등록</caption>
	<colgroup>
		<col style="width:20%">
		<col style="width:40%">
		<col style="width:40%">
	</colgroup>
	<tbody>
		<tr>
			<th><p>IP 등록</p></th>
			<td>
				<label><input type="radio" name="type" id="stO" value="O" checked /><span>IP 1개</span></label>
				<label><input type="radio" name="type" id="stB" value="B" /><span>IP 대역</span></label>
			</td>
			<td>
				<input type="text" name="ip1" class="rt_input_txt rt_w40 required " maxlength="3" msg="IP를 입력해 주세요">
				<span class="rt_txt rt_dash">-</span>
				<input type="text" name="ip2" class="rt_input_txt rt_w40 required " maxlength="3" msg="IP를 입력해 주세요">
				<span class="rt_txt rt_dash">-</span>
				<input type="text" name="ip3" class="rt_input_txt rt_w40 required " maxlength="3" msg="IP를 입력해 주세요">
				<span class="rt_txt rt_dash">-</span>
				<span id="sel_O"><input type="text" name="ip4" class="rt_input_txt rt_w40" maxlength="3"></span>
				<span id="sel_B"></span>
				<span class="rt_button_wrap rt_tar">
					<a href="#;" onclick="goInsSubmit(this.form)" class="rt_btn_blue btn_in">추가</a>
				</span>
			</td>
		</tr>
	</tbody>
</table>
</form>
<?php } ?>

<table class="rt_list_table">
	<caption>IP 관리</caption>
	<colgroup>
		<col style="width:10%">
		<col style="width:10%">
		<col style="width:50%">
		<col style="width:15%">
		<col style="width:15%">
	</colgroup>
	<thead>
		<tr>
			<th><p>번호</p></th>
			<th><p>설정규칙</p></th>
			<th><p>설정된 IP</p></th>
			<th><p>등록일</p></th>
			<th><p>관리</p></th>
		</tr>
	</thead>
	<tbody>
	<?php
	if (count($_list) > 0) {

		$_url = RTW_ADM."/".$__dr;
		$num = count($_list);
		for ($m = 0; $m < count($_list); $m++) {
			$dateYmd = substr($_list[$m]["rdate"],0,10);
			$regdate = ($dateYmd == date("Y-m-d")) ? "<font color='red'>".substr($_list[$m]["rdate"],10,6)."</font>" : $dateYmd;
		?>
		<tr>
			<td><p><?php echo $num;?></p></td>
			<td>
				<p><?php echo ($_list[$m]["type"]=="O") ? "IP 1개":"IP 대역";?></p>
			</td>
			<td>
				<p><?php echo $_list[$m]["ip1"];?>.<?php echo $_list[$m]["ip2"];?>.<?php echo $_list[$m]["ip3"];?>.<?php echo ($_list[$m]["type"]=="O") ? $_list[$m]["ip4"] : "*";?></p>
			</td>
			<td><p><?php echo $regdate;?></p></td>
			<td>
				<p class="rt_button_wrap rt_tac">
					<a href="#;" onclick="goDel(<?php echo $_list[$m]["seq"];?>)" class="rt_btn_red btn_in">삭제</a>
				</p>
			</td>
		</tr>
		<?php
		$num--;
		}
	} else {
	?>
		<tr height="100">
			<td colspan="6">
				등록된 <b>IP규칙</b>이 없습니다.
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em>현재 <span class="rt_mint">IP 허용</span>설정을 사용 중입니다. 등록된 IP 외는 접근할 수 없습니다.</p>
	<p><em>-</em>IP 등록 시 <span class="rt_mint">IP 대역</span>으로 등록하시면 4번째 IP는 관계없이 3번째 IP까지만 체크합니다.</p>
</div>

<script src="assets/js/permit.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none"></iframe>
