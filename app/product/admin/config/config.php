<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<form name="dataform" action="<?php echo $_def['path_app']."/".$__sd;?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="modify">

<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>기본 환경 설정</h1>
</div>
<table class="rt_data_table">
	<caption>게시판 이용권한 설정</caption>
	<colgroup>
		<col style="width:15%" />
		<col style="width:35%" />
		<col style="width:15%" />
		<col style="width:35%" />
	</colgroup>
	<tbody>
	<tr>
		<th><p>목록 제품명 길이</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['subject_cut_length'];?>" name="subject_cut_length" />
			<p class="rt_brown rt_fln">출력할 제품명 길이를 입력해 주세요(기본 수치 50)</p>
		</td>
		<th><p>목록 제품명 길이(모바일)</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['subject_cut_length_m'];?>" name="subject_cut_length_m" />
			<p class="rt_brown rt_fln">출력할 제품명 길이를 입력해 주세요(기본 수치 50)</p>
		</td>
	</tr>
	<tr>
		<th><p>썸네일 사용</p></th>
		<td colspan="3">
			<p>
				<label><input type="radio" name="img_thumb_is" value="y" <?php echo $img_thumb_is_y;?>> 사용함</label>
				<label><input type="radio" name="img_thumb_is" value="n" <?php echo $img_thumb_is_n;?>> 사용안함</label>
			</p>
		</td>
	</tr>
	<tr>
		<th><p>목록 썸네일 사이즈(px)</p></th>
		<td>
			가로 <input type="text" class="rt_input_txt rt_w40" name="list_img_thumb_w" value="<?php echo $_r['list_img_thumb_w'];?>" />
			<em> x </em>
			세로 <input type="text" class="rt_input_txt rt_w40" name="list_img_thumb_h" value="<?php echo $_r['list_img_thumb_h'];?>" />
			<p class="rt_brown rt_fln">목록 이미지 등록 시 생성할 썸네일 사이즈를 입력합니다.</p>
		</td>
		<th><p>제품 썸네일 사이즈(px)</p></th>
		<td>
			가로 <input type="text" class="rt_input_txt rt_w40" name="pdt_img_thumb_w" value="<?php echo $_r['pdt_img_thumb_w'];?>" />
			<em> x </em>
			세로 <input type="text" class="rt_input_txt rt_w40" name="pdt_img_thumb_h" value="<?php echo $_r['pdt_img_thumb_h'];?>" />
			<p class="rt_brown rt_fln">제품 상세 이미지 등록 시 생성할 썸네일 사이즈를 입력합니다.</p>
		</td>
	</tr>
	<tr>
		<th><p>제품 이미지 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['upload_img_cnt'];?>" name="upload_img_cnt" /> 개
			<p class="rt_brown rt_fln">0개로 설정하시면 노출되지 않습니다.</p>
		</td>
		<th><p>첨부파일 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['upload_file_cnt'];?>" name="upload_file_cnt" /> 개
			<p class="rt_brown rt_fln">0개로 설정하시면 노출되지 않습니다.</p>
		</td>
	</tr>
	<tr>
		<th><p>새 등록 기준(일)</p></th>
		<td colspan="3">
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['post_new_period'];?>" name="post_new_period" /> 일
			<p class="rt_brown rt_fln">새 제제품으로 표시할 등록일 이후 기간을 일자로 입력해 주세요</p>
		</td>
	</tr>
	</tbody>
</table>

<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>제품 출력 수</h1>
</div>
<table class="rt_data_table">
	<caption>제품 출력 수</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tbody>
	<tr>
		<th><p>PC 스킨 게시물 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['page_cnt'];?>" name="page_cnt" /> 개
		</td>
		<th><p>PC 스킨 페이지 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['block_cnt'];?>" name="block_cnt" /> 페이지
		</td>
	</tr>
	<tr>
		<th><p>모바일 스킨 게시물 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['page_cnt_mobile'];?>" name="page_cnt_mobile" /> 개
		</td>
		<th><p>모바일 스킨 페이지 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['block_cnt_mobile'];?>" name="block_cnt_mobile" /> 페이지
		</td>
	</tr>
	<tr>
		<th><p>관리자 모드 게시물 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['page_cnt_admin'];?>" name="page_cnt_admin" /> 개
		</td>
		<th><p>관리자 모드 페이지 수</p></th>
		<td>
			<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_r['block_cnt_admin'];?>" name="block_cnt_admin" /> 페이지
		</td>
	</tr>
	</tbody>
</table>

<div class="rt_s_tit clearfix">
	<p>03<span></span></p>
	<h1>레이아웃 스킨 설정(개발자용)</h1>
</div>
<table class="rt_data_table">
	<caption>레이아웃 스킨 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tbody>
		<!--
		<tr>
			<th><p>템플릿 코드</p></th>
			<td colspan="3">
				<p><span class="rt_button_wrap"><a href="#;" class="rt_btn_red btn_in" onclick="window.open('<?php echo $_def['path_admin'];?>/inc.template_code.php','_blank','toolbar=no,scrollbars=no,resizable=no,top=0,right=0,width=1000,height=800')">템플릿 코드 보기</a></span></p>
			</td>
		</tr>
		//-->
		<tr>
			<th><p>스킨 파일 경로</p></th>
			<td>
				<p><?php echo $_def['path_app'];?>/template/</p>
			</td>
			<th><p>CSS 파일 경로</p></th>
			<td>
				<p><span class="rt_bold">PC : </span><?php echo $_def['path_assets'];?>/css/rt_member.css</p>
				<p><span class="rt_bold">MOBILE : </span><?php echo $_def['path_assets'];?>/css/rt_member_mobile.css</p>
			</td>
		</tr>
		<tr>
			<th><p>목록 페이지</p></th>
			<td>
				<select name="skin_list">
					<option value="">템플릿파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $_r['skin_list'])?"selected":""?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
			<th><p>상세 페이지</p></th>
			<td>
				<select name="skin_view">
					<option value="">템플릿파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $_r['skin_view'])?"selected":""?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<th><p>목록 페이지(모바일)</p></th>
			<td>
				<select name="skin_list_m">
					<option value="">템플릿파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $_r['skin_list_m'])?"selected":""?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
			<th><p>상세 페이지(모바일)</p></th>
			<td>
				<select name="skin_view_m">
					<option value="">템플릿파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $_r['skin_view_m'])?"selected":""?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
	</tbody>
</table>

<div class="rt_s_tit clearfix">
	<p>04<span></span></p>
	<h1>기본 이용권한 설정</h1>
</div>
<table class="rt_data_table">
	<caption>이용 권한 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>목록 접근 권한</p></th>
			<td>
				<p><label><input name="auth_list[]" id="auth_list_0" type="checkbox" value="0" <?php echo ($auth_list_arr[0]=="0")?"checked='checked'":""?>>비회원</label></p>
				<?php
				for ($m = 0; $m < count($mgrp); $m++) {
					$checked = "";
					if (count($auth_list_arr) > 0) {
						if (in_array($mgrp[$m]['grp_seq'], $auth_list_arr)) {
							$checked = "checked='checked'";
						}
					}
					?>
					<p><label><input name="auth_list[]" id="auth_list_<?php echo $mgrp[$m]['grp_seq'];?>" type="checkbox" value="<?php echo $mgrp[$m]['grp_seq'];?>" <?php echo $checked?>> <?php echo $mgrp[$m]['grp_name'];?></label></p>
					<?
				}?>
			</td>
		</tr>
		<tr>
			<th><p>상세 접근 권한</p></th>
			<td>
				<p><label><input name="auth_read[]" id="auth_read_0" type="checkbox" value="0" <?php echo ($auth_read_arr[0]=="0")?"checked='checked'":""?>>비회원</label></p>
				<?php
				for ($m = 0; $m < count($mgrp); $m++) {
					$checked = "";
					if (count($auth_read_arr) > 0) {
						if (in_array($mgrp[$m]['grp_seq'], $auth_read_arr)) {
							$checked = "checked='checked'";
						}
					}
					?>
					<p><label><input name="auth_read[]" id="auth_read_<?php echo $mgrp[$m]['grp_seq'];?>" type="checkbox" value="<?php echo $mgrp[$m]['grp_seq'];?>" <?php echo $checked?>> <?php echo $mgrp[$m]['grp_name'];?></label></p>
					<?
				}?>
			</td>
		</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar mb25">
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">설정 변경</a>
</div>

<div class="rt_bot_box">
	<h1>이용안내</h1>
	<p><em>-</em>기본이용권한 설정의 회원 그룹은 <span class="rt_mint">회원관리 &gt; 회원그룹관리</span> 메뉴에서 설정할 수 있습니다.</p>
</div>

<script src="<?php echo $_def['path_assets'];?>/js/product.admin.config.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>