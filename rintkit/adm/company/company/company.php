<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="data_form" action="<?php echo $__sc;?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="modify">
<table class="rt_field_table mb10">
	<caption>회사 정보 설정</caption>
	<colgroup>
		<col style="width:15%">
		<col style="width:35%">
		<col style="width:15%">
		<col style="width:35%">
	</colgroup>
	<tbody>
		<tr>
			<th><p>회사명</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['company'];?>" name="company" />
			</td>
			<th><p>사이트 명</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['website'];?>" name="website" />
			</td>
		</tr>
		<tr>
			<th><p>대표자명</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['ceo_nm'];?>" name="ceo_nm" />
			</td>
			<th><p>대표전화</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['comp_tel'];?>" name="comp_tel" />
			</td>
		</tr>
		<tr>
			<th><p>팩스</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['comp_fax'];?>" name="comp_fax" />
			</td>
			<th><p>이메일</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['comp_email'];?>" name="comp_email" />
			</td>
		</tr>
		<tr>
			<th><p>회사주소</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['comp_addr'];?>" name="comp_addr" />
			</td>
			<th><p>사업자번호</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['comp_number1'];?>" name="comp_number1" />
			</td>
		</tr>
		<tr>
			<th><p>법인번호</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['comp_number2'];?>" name="comp_number2" />
			</td>
			<th><p>통신판매번호</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['comp_number3'];?>" name="comp_number3" />
			</td>
		</tr>
		<tr>
			<th><p>업태</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['comp_type1'];?>" name="comp_type1" />
			</td>
			<th><p>종목</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_r['comp_type2'];?>" name="comp_type2" />
			</td>
		</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar mb25">
	<a href="#;" id="btn-submit" class="rt_btn_blue">정보 변경</a>
</div>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em>설정된 정보는 <span class="rt_mint">각 종 이메일 스킨 </span>등에 활용됩니다.</p>
	<p><em>-</em><span class="rt_mint">홈페이지에 프로그램이 연동되어 있지 않으면</span> 이곳에서 변경하여도 홈페이지에 <span class="rt_yellow">반영되지 않습니다.</span></p>
</div>

<script src="assets/js/company.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>