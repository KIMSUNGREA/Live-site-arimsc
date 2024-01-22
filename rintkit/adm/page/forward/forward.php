<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<div class="rt_s_gnb">
	<a href="<?php echo RTW_ADM;?>/page/?sd=forward" class="rt_depth1 rt_active">유입자 화면이동 규칙</a>
	<a href="<?php echo RTW_ADM;?>/page/?sd=match" class="rt_depth1">404 페이지 매칭</a>
	<a href="<?php echo RTW_ADM;?>/page/?sd=try404" class="rt_depth1">404 요청 URL</a>
	<a href="<?php echo RTW_ADM;?>/page/?sd=source" class="rt_depth1">화면이동(고정) 링크소스</a>
</div>

<form name="data_form" action="<?php echo $__sc;?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="modify">
<table class="rt_data_table">
	<caption>포워딩 규칙 설정</caption>
	<colgroup>
		<col style="width:20%">
		<col style="width:20%">
		<col style="width:20%">
		<col style="width:20%">
		<col style="width:20%">
	</colgroup>
	<tr>
		<th><p>현재 접속 기기</p></th>
		<th><p>이동할 화면</p></th>
		<th><p>화면 고정 설정</p></th>
		<th><p>화면 강제 이동</p></th>
		<th><p>강제 이동할 화면</p></th>
	</tr>
	<tr>
		<td><strong>PC</strong></td>
		<td><strong>PC 화면</strong></td>
		<td><strong>설정 없음</strong></td>
		<td>
			<select id="fw1" name="fw1" class="rt-input selchange" data="1">
				<option value="x" <?php echo $fw1_x_selected?>>사용 안함</option>
				<option value="o" <?php echo $fw1_o_selected?>>화면 강제 이동</option>
			</select>
		</td>
		<td>
			<select id="ld1" name="ld1" class="rt-input ">
				<option value="">사용 안함 </option>
				<option value="pc" <?php echo $ld1_pc_selected?>>PC</option>
				<option value="mobile" <?php echo $ld1_mobile_selected?>>모바일</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>PC</strong></td>
		<td><strong>PC 화면</strong></td>
		<td><strong>PC 화면 고정</strong></td>
		<td>
			<select id="fw2" name="fw2" class="rt-input selchange" data="2">
				<option value="x" <?php echo $fw2_x_selected?>>사용 안함</option>
				<option value="o" <?php echo $fw2_o_selected?>>화면 강제 이동</option>
			</select>
		</td>
		<td>
			<select id="ld2" name="ld2" class="rt-input ">
				<option value="">사용 안함 </option>
				<option value="pc" <?php echo $ld2_pc_selected?>>PC</option>
				<option value="mobile" <?php echo $ld2_mobile_selected?>>모바일</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>PC</strong></td>
		<td><strong>PC 화면</strong></td>
		<td><strong>모바일 화면 고정</strong></td>
		<td>
			<select id="fw3" name="fw3" class="rt-input selchange" data="3">
				<option value="x" <?php echo $fw3_x_selected?>>사용 안함</option>
				<option value="o" <?php echo $fw3_o_selected?>>화면 강제 이동</option>
			</select>
		</td>
		<td>
			<select id="ld3" name="ld3" class="rt-input ">
				<option value="">사용 안함 </option>
				<option value="pc" <?php echo $ld3_pc_selected?>>PC</option>
				<option value="mobile" <?php echo $ld3_mobile_selected?>>모바일</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>PC</strong></td>
		<td><strong>모바일 화면</strong></td>
		<td><strong>설정 없음</strong></td>
		<td>
			<select id="fw4" name="fw4" class="rt-input selchange" data="4">
				<option value="x" <?php echo $fw4_x_selected?>>사용 안함</option>
				<option value="o" <?php echo $fw4_o_selected?>>화면 강제 이동</option>
			</select>
		</td>
		<td>
			<select id="ld4" name="ld4" class="rt-input ">
				<option value="">사용 안함 </option>
				<option value="pc" <?php echo $ld4_pc_selected?>>PC</option>
				<option value="mobile" <?php echo $ld4_mobile_selected?>>모바일</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>PC</strong></td>
		<td><strong>모바일 화면</strong></td>
		<td><strong>PC 화면 고정</strong></td>
		<td>
			<select id="fw5" name="fw5" class="rt-input selchange" data="5">
				<option value="x" <?php echo $fw5_x_selected?>>사용 안함</option>
				<option value="o" <?php echo $fw5_o_selected?>>화면 강제 이동</option>
			</select>
		</td>
		<td>
			<select id="ld5" name="ld5" class="rt-input ">
				<option value="">사용 안함 </option>
				<option value="pc" <?php echo $ld5_pc_selected?>>PC</option>
				<option value="mobile" <?php echo $ld5_mobile_selected?>>모바일</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>PC</strong></td>
		<td><strong>모바일 화면</strong></td>
		<td><strong>모바일 화면 고정</strong></td>
		<td>
			<select id="fw6" name="fw6" class="rt-input selchange" data="6">
				<option value="x" <?php echo $fw6_x_selected?>>사용 안함</option>
				<option value="o" <?php echo $fw6_o_selected?>>화면 강제 이동</option>
			</select>
		</td>
		<td>
			<select id="ld6" name="ld6" class="rt-input ">
				<option value="">사용 안함 </option>
				<option value="pc" <?php echo $ld6_pc_selected?>>PC</option>
				<option value="mobile" <?php echo $ld6_mobile_selected?>>모바일</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>Mobile</strong></td>
		<td><strong>PC 화면</strong></td>
		<td><strong>설정 없음</strong></td>
		<td>
			<select id="fw7" name="fw7" class="rt-input selchange" data="7">
				<option value="x" <?php echo $fw7_x_selected?>>사용 안함</option>
				<option value="o" <?php echo $fw7_o_selected?>>화면 강제 이동</option>
			</select>
		</td>
		<td>
			<select id="ld7" name="ld7" class="rt-input ">
				<option value="">사용 안함 </option>
				<option value="pc" <?php echo $ld7_pc_selected?>>PC</option>
				<option value="mobile" <?php echo $ld7_mobile_selected?>>모바일</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>Mobile</strong></td>
		<td><strong>PC 화면</strong></td>
		<td><strong>PC 화면 고정</strong></td>
		<td>
			<select id="fw8" name="fw8" class="rt-input selchange" data="8">
				<option value="x" <?php echo $fw8_x_selected?>>사용 안함</option>
				<option value="o" <?php echo $fw8_o_selected?>>화면 강제 이동</option>
			</select>
		</td>
		<td>
			<select id="ld8" name="ld8" class="rt-input ">
				<option value="">사용 안함 </option>
				<option value="pc" <?php echo $ld8_pc_selected?>>PC</option>
				<option value="mobile" <?php echo $ld8_mobile_selected?>>모바일</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>Mobile</strong></td>
		<td><strong>PC 화면</strong></td>
		<td><strong>모바일 화면 고정</strong></td>
		<td>
			<select id="fw9" name="fw9" class="rt-input selchange" data="9">
				<option value="x" <?php echo $fw9_x_selected?>>사용 안함</option>
				<option value="o" <?php echo $fw9_o_selected?>>화면 강제 이동</option>
			</select>
		</td>
		<td>
			<select id="ld9" name="ld9" class="rt-input ">
				<option value="">사용 안함 </option>
				<option value="pc" <?php echo $ld9_pc_selected?>>PC</option>
				<option value="mobile" <?php echo $ld9_mobile_selected?>>모바일</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>Mobile</strong></td>
		<td><strong>모바일 화면</strong></td>
		<td><strong>설정 없음</strong></td>
		<td>
			<select id="fw10" name="fw10" class="rt-input selchange" data="10">
				<option value="x" <?php echo $fw10_x_selected?>>사용 안함</option>
				<option value="o" <?php echo $fw10_o_selected?>>화면 강제 이동</option>
			</select>
		</td>
		<td>
			<select id="ld10" name="ld10" class="rt-input ">
				<option value="">사용 안함 </option>
				<option value="pc" <?php echo $ld10_pc_selected?>>PC</option>
				<option value="mobile" <?php echo $ld10_mobile_selected?>>모바일</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>Mobile</strong></td>
		<td><strong>모바일 화면</strong></td>
		<td><strong>PC 화면 고정</strong></td>
		<td>
			<select id="fw11" name="fw11" class="rt-input selchange" data="11">
				<option value="x" <?php echo $fw11_x_selected?>>사용 안함</option>
				<option value="o" <?php echo $fw11_o_selected?>>화면 강제 이동</option>
			</select>
		</td>
		<td>
			<select id="ld11" name="ld11" class="rt-input ">
				<option value="">사용 안함 </option>
				<option value="pc" <?php echo $ld11_pc_selected?>>PC</option>
				<option value="mobile" <?php echo $ld11_mobile_selected?>>모바일</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>Mobile</strong></td>
		<td><strong>모바일 화면</strong></td>
		<td><strong>모바일 화면 고정</strong></td>
		<td>
			<select id="fw12" name="fw12" class="rt-input selchange" data="12">
				<option value="x" <?php echo $fw12_x_selected?>>사용 안함</option>
				<option value="o" <?php echo $fw12_o_selected?>>화면 강제 이동</option>
			</select>
		</td>
		<td>
			<select id="ld12" name="ld12" class="rt-input ">
				<option value="">사용 안함 </option>
				<option value="pc" <?php echo $ld12_pc_selected?>>PC</option>
				<option value="mobile" <?php echo $ld12_mobile_selected?>>모바일</option>
			</select>
		</td>
	</tr>
</table>
</form>

<div class="rt_button_wrap rt_tar mb20">
	<a href="#;" id="btn-pc-seting" class="rt_btn_red">이동 규칙 사용안함 설정</a>
	<a href="#;" id="btn-seting-reset" class="rt_btn_orange">권장 세팅 설정</a>
	<a href="#;" id="btn-submit" class="rt_btn_blue">정보 변경</a>
</div>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em>모바일 구분 디렉토리는 도메인을 제외하고 슬래시(/)부터 디렉토리명만 입력합니다.(예시: /page/)</p>
	<p><em>-</em><span class="rt_mint">화면 고정 이란 </span><span class="rt_yellow">모바일웹에서 PC화면 보기</span>를 누르거나 <span class="rt_yellow">PC화면에서 모바일웹 보기</span>를 클릭한 상태인지에 대한 여부입니다.</p>
	<p><em>-</em>포워딩 페이지의 설정은 해당 케이스의 <span class="rt_mint">작동 선택 </span>설정 상태가 <span class="rt_mint">포워딩 상태</span>일 경우에만 작동합니다.</p>
	<p><em>-</em>포워딩할 페이지 정보는 <span class="rt_mint">페이지관리-사이트맵 관리</span>에서 설정할 수 있습니다.</p>
	<p><em>-</em>포워딩할 데이터가 설정되어 있지 않으면 <span class="rt_mint">현재 접속 기기에 따른 메인 페이지</span>로 이동합니다.</p>
	<p><em>-</em><span class="rt_red">주의) </span><span class="rt_yellow">포워딩 후 랜딩되는 페이지에서 이전 페이지의 포워딩 설정이 또 있으면 무한 반복으로 이동되어 페이지가 다운되는 현상이 있을 수 있습니다.</span></p>
</div>

<script src="assets/js/page.forward.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>