<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<div class="rt_search_wrap">
<form name="ins_form" method="post" action="<?=$_def['path_app']."/".$__sd?>/update.php" target="rt_ifrm">
<input type="hidden" name="mode" value="insert">
	<input type="text" class="rt-input required" value="" name="grp_name" msg="추가할 그룹명을 입력해 주세요" />
	<span class="rt_button_wrap"><a href="#;" id="btn-group-ins" class="rt_btn_purple btn_s">새 그룹 추가</a></span>
</form>
</div>
<table class="rt_list_table">
	<caption>회원목록</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:65%"/>
		<col style="width:20%"/>
	</colgroup>
	<thead>
		<tr>
			<th><p>순서</p></th>
			<th><p>그룹명</p></th>
			<th><p>관리</p></th>
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
					<a href="javascript:group_chg('up','<?php echo $_list[$m]['grp_seq'];?>')" class="rt_arrow rt_up">위로</a>
					<a href="javascript:group_chg('down','<?php echo $_list[$m]['grp_seq'];?>')" class="rt_arrow rt_down">아래로</a>
				</p>
			</td>
			<td class="rt_tal"><p><a href="<?php echo RTW_ADM;?>/app/?appcode=<?php echo $env->_get['appcode'];?>&sd=<?php echo $env->_get['sd'];?>&cf=form&grp_seq=<?php echo $_list[$m]['grp_seq'];?>"><?php echo ($_list[$m]['grp_seq'] == "1")?"[기본] ":"";?><?php echo $_list[$m]['grp_name'];?></a></p></td>
			<td>
				<p class="rt_button_wrap rt_tac">
					<a href="<?php echo RTW_ADM;?>/app/?appcode=<?php echo $env->_get['appcode'];?>&sd=<?php echo $env->_get['sd'];?>&cf=form&grp_seq=<?php echo $_list[$m]['grp_seq'];?>" class="rt_btn_blue btn_in">수정</a>
					<?php if ($_list[$m]['grp_seq'] != "1") { ?>
					<a href="#;" onclick="group_delete(<?=$_list[$m]['grp_seq']?>);" class="rt_btn_red btn_in">삭제</a>
					<?php } ?>
				</p>
			</td>
		</tr>
		<?
	}?>
	</tbody>
</table>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em><span class="rt_mint">그룹의 추가/삭제</span>후에는 게시판의 권한 등 연계되는 기능을 동시에 설정해 주세요.</p>
</div>

<!-- JS Controller //-->
<script src="<?php echo $_def['path_assets'];?>/js/rtmember.admin.group.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>