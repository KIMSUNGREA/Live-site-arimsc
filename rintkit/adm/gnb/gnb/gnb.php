<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="ins_form" method="post" action="<?php echo $__sc;?>/update.php" target="rt_ifrm">
<input type="hidden" name="mode" value="insert">
<div class="rt_search_wrap">
	<input type="text" class="required" name="new_menu_nm" msg="추가할 메뉴명을 입력해 주세요" />
	<span class="rt_button_wrap"><a href="#;" id="btn-gnb-ins" class="rt_btn_purple btn_s">새 메뉴 추가</a></span>
</div>
</form>

<table class="rt_list_table">
	<caption>상단 메뉴 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:45%"/>
		<col style="width:10%"/>
		<col style="width:10%"/>
		<col style="width:20%"/>
	</colgroup>
	<thead>
		<tr>
			<th><p>순서</p></th>
			<th><p>메뉴 명</p></th>
			<th><p>권한</p></th>
			<th><p>상태</p></th>
			<th><p>관리</p></th>
		</tr>
	</thead>
	<tbody>
	<?php
	for ($m = 0; $m < count($_list); $m++)
	{
		$menu_auth_str = ($_list[$m]['menu_auth_en']=="master") ? "마스터" : "관리자";
		$menu_use_is = ($_list[$m]['menu_en']=="y") ? "<p class='rt_blue'>사용함</p>" : "<p class='rt_red'>사용안함</p>";
		?>
		<tr>
			<td>
				<p class="rt_ico_wrap">
					<a href="javascript:menu_chg('up','<?php echo $_list[$m]['seq'];?>');" class="rt_arrow rt_up">위로</a>
					<a href="javascript:menu_chg('down','<?php echo $_list[$m]['seq'];?>');" class="rt_arrow rt_down">아래로</a>
				</p>
			</td>
			<td class="rt_tal"><p><a href="<?php echo RTW_ADM;?>/gnb/?sd=gnb&cf=form&seq=<?php echo $_list[$m]['seq'];?>"><?php echo $_list[$m]['menu_nm'];?></a></p></td>
			<td><p><?php echo $menu_auth_str;?></p></td>
			<td><p class="rt_blue"><?php echo $menu_use_is;?></p></td>
			<td>
				<p class="rt_button_wrap rt_tac">
					<a href="<?php echo RTW_ADM;?>/gnb/?sd=gnb&cf=form&seq=<?php echo $_list[$m]['seq'];?>" class="rt_btn_blue btn_in">설정</a>
					<?php if ($_list[$m]['grp_seq'] != "1") { ?>
					<a href="javascript:menu_delete(<?php echo $_list[$m]['seq'];?>);" class="rt_btn_red btn_in">삭제</a>
					<?php } ?>
				</p>
			</td>
		</tr>
		<?php
	}
	?>
	</tbody>
</table>


<!-- JS Controller //-->
<script src="assets/js/rt.adm.gnb.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>