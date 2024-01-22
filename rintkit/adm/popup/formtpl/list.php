<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="ins_form" method="post" action="<?php echo $__sc;?>/update.php" target="rt_ifrm">
<input type="hidden" name="mode" value="insert">
<div class="rt_search_wrap">
	<input type="text" class="required" value="" name="title" msg="추가할 템플릿 제목을 입력해 주세요" />
	<span class="rt_button_wrap"><a href="#;" id="btn-formtpl-ins" class="rt_btn_purple btn_s">새 템플릿 추가</a></span>
</div>
</form>

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
			<th><p>템플릿명</p></th>
			<th><p>정보관리</p></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$_url = RTW_ADM."/".$__dr;
	for ($m = 0; $m < count($_list); $m++)
	{
		?>
		<tr>
			<td>
				<p class="rt_ico_wrap">
					<a href="javascript:formtpl_chg('up','<?php echo $_list[$m]['seq'];?>')" class="rt_arrow rt_up">위로</a>
					<a href="javascript:formtpl_chg('down','<?php echo $_list[$m]['seq'];?>')" class="rt_arrow rt_down">아래로</a>
				</p>
			</td>
			<td class="rt_tal"><p><a href="<?php echo $_url;?>/?sd=formtpl&cf=form&seq=<?php echo $_list[$m]['seq']?>"><?php echo $_list[$m]['title'];?></a></p></td>
			<td>
				<p class="rt_button_wrap rt_tac">
					<a href="<?php echo $_url;?>/?sd=formtpl&cf=form&seq=<?php echo $_list[$m]['seq'];?>" class="rt_btn_blue btn_in">수정</a>
					<a href="javascript:formtpl_delete(<?php echo $_list[$m]['seq'];?>);" class="rt_btn_red btn_in">삭제</a>
				</p>
			</td>
		</tr>
		<?php
	}?>
	</tbody>
</table>

<script src="assets/js/popup.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>