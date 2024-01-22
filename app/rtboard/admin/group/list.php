<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="ins_form" method="post" action="<?php echo $_def['path_app']."/".$__sd;?>/update.php" target="rt_ifrm">
<input type="hidden" name="mode" value="insert">
<div class="rt_search_wrap">
	<input type="text" class="required" value="" name="grp_name" msg="추가할 그룹명을 입력해 주세요" />
	<span class="rt_button_wrap"><a href="#;" id="btn-group-ins" class="rt_btn_purple btn_s">새 그룹 추가</a></span>
</div>
</form>

<table class="rt_list_table">
	<caption>게시판 그룹관리</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:75%"/>
		<col style="width:10%"/>
	</colgroup>
	<thead>
		<tr>
			<th><p>순서</p></th>
			<th><p>그룹 명</p></th>
			<th><p>정보 관리</p></th>
		</tr>
	</thead>
	<tbody>
	<?php
	for ($m = 0; $m < count($_list); $m++)
	{
		?>
		<tr>
			<td>
				<p class="rt_ico_wrap">
					<a href="#;" onclick="group_chg('up','<?php echo $_list[$m]['grp_seq'];?>')" class="rt_arrow rt_up">위로</a>
					<a href="#;" onclick="group_chg('down','<?php echo $_list[$m]['grp_seq'];?>')" class="rt_arrow rt_down">아래로</a>
				</p>
			</td>
			<td class="rt_tal"><p><a href="<?=RTW_ADM?>/app/?appcode=<?php echo $env->_get['appcode'];?>&sd=<?php echo $env->_get['sd'];?>&cf=form&grp_seq=<?php echo $_list[$m]['grp_seq'];?>"><?php echo ($_list[$m]['grp_seq'] == "1")?"[기본] ":"";?><?php echo $_list[$m]['grp_name'];?></a></p></td>
			<td>
				<p class="rt_button_wrap rt_tac">
					<a href="<?=RTW_ADM?>/app/?appcode=<?php echo $env->_get['appcode'];?>&sd=<?php echo $env->_get['sd'];?>&cf=form&grp_seq=<?php echo $_list[$m]['grp_seq'];?>" class="rt_btn_blue btn_in">수정</a>
					<?php if ($_list[$m]['grp_seq'] != "1") { ?>
					<a href="#;" onclick="group_delete(<?php echo $_list[$m]['grp_seq'];?>);" class="rt_btn_red btn_in">삭제</a>
					<?php } ?>
				</p>
			</td>
		</tr>
		<?php
	}?>
	</tbody>
</table>

<div class="rt_bot_box">
	<h1>이용안내</h1>
	<p><em>-</em><span class="rt_mint">기본 그룹</span>은 삭제되지 않습니다.</p>
	<p><em>-</em>좌측의 화살표 버튼을 클릭하면 <span class="rt_mint">그룹의 출력순서</span>를 변경할 수 있습니다.</p>
</div>

<script src="<?php echo $_def['path_section'];?>/js/rtboard.admin.group.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>