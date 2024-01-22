<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="data_form" action="<?php echo $__sc;?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="modify">
<input type="hidden" name="seq" value="<?php echo $env->_get['seq'];?>">

<table class="rt_field_table mb10">
	<caption>메뉴 상세 정보</caption>
	<colgroup>
		<col width="15%" />
		<col width="" />
	</colgroup>
	<tbody>
	<tr>
		<th><p>메뉴 명</p></th>
		<td><input type="text" class="rt_input_txt required" value="<?php echo $_r['menu_nm']?>" name="menu_nm" msg="메뉴명을 입력해 주세요" /></td>
	</tr>
	<tr>
		<th><p>링크 타겟</p></th>
		<td>
			<label><input name="link_target_en" id="link-target-opt1" value="_self" type="radio" <?php echo $link_target_self;?>> 현재 창</label>
			<label><input name="link_target_en" id="link-target-opt2" value="_blank" type="radio" <?php echo $link_target_blank;?>> 새 창</label>
		</td>
	</tr>
	<tr>
		<th><p>링크 URI</p></th>
		<td>
			<input type="text" class="rt_input_txt" value="<?php echo $_r['link_uri'];?>" name="link_uri" />
		</td>
	</tr>
	<tr>
		<th><p>권한별 노출</p></th>
		<td>
			<label><input name="menu_auth_en" id="menu_auth_opt1" value="master" type="radio" <?php echo $menu_auth_master;?>> 마스터 전용</label>
			<label><input name="menu_auth_en" id="menu_auth_opt2" value="normal" type="radio" <?php echo $menu_auth_normal;?>> 일반 관리자</label>
		</td>
	</tr>
	<tr>
		<th><p>사용 여부</p></th>
		<td>
			<label><input name="menu_en" id="menu-opt1" value="y" type="radio" <?php echo $menu_y;?>> 사용함</label>
			<label><input name="menu_en" id="menu-opt2" value="n" type="radio" <?php echo $menu_n;?>> 사용하지 않음</label>
		</td>
	</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar mb20">
	<a href="javascript:menu_delete(<?php echo $_r['seq'];?>);" class="rt_btn_red">메뉴 삭제</a>
	<a href="#;" class="rt_btn_blue" id="btn-form-submit">정보 변경</a>
	<a href="#;" class="rt_btn_gray" id="btn-list">목록 가기</a>
</div>

<script src="assets/js/rt.adm.gnb.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>