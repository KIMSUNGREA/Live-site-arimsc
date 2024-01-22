<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<div class="rt_search_wrap">
<form name="ins_form" method="post" action="<?php echo $_def['path_app']."/".$__sd;?>/update.php" target="rt_ifrm">
<input type="hidden" name="mode" value="insert">
	<input type="text" class="rt-input required" value="" name="opt_name" msg="추가할 세트명을 입력해 주세요" />
	<span class="rt_button_wrap"><a href="#;" id="btn-option-ins" class="rt_btn_purple btn_s">새 옵션 세트 추가</a></span>
</form>
</div>
<table class="rt_list_table">
	<caption>옵션 세트 목록</caption>
	<colgroup>
		<col style="width:150px;"/>
		<col style="width:100px;"/>
		<col style="width:;"/>
		<col style="width:200px;"/>
	</colgroup>
	<thead>
		<tr>
			<th><p>순서</p></th>
			<th><p>기본 설정</p></th>
			<th><p>그룹명</p></th>
			<th><p>관리</p></th>
		</tr>
	</thead>
	<tbody>
	<?php
	if (count($_list) > 0) {
		for ($m = 0; $m < count($_list); $m++)
		{
		?>
		<tr>
			<td>
				<p class="rt_ico_wrap">
					<a href="javascript:option_chg('up','<?php echo $_list[$m]['opt_seq'];?>')" class="rt_arrow rt_up">위로</a>
					<a href="javascript:option_chg('down','<?php echo $_list[$m]['opt_seq'];?>')" class="rt_arrow rt_down">아래로</a>
				</p>
			</td>
			<td>
				<label><input type="radio" name="default_en" value="y" <?php echo ($_list[$m]['default_en'] == "y")?"checked='checked'":"";?> onclick="default_setting(<?php echo $_list[$m]['opt_seq'];?>);"></label>
			</td>
			<td class="rt_tal">
				<p><a href="<?php echo RTW_ADM;?>/app/?appcode=<?php echo $env->_get['appcode'];?>&sd=<?php echo $env->_get['sd'];?>&cf=form&opt_seq=<?php echo $_list[$m]['opt_seq'];?>"><?php echo ($_list[$m]['default_en'] == "y")?"<span class='rt_red'>[기본]</span> ":"";?><?php echo $_list[$m]['opt_name'];?></a></p>
			</td>
			<td>
				<p class="rt_button_wrap rt_tac">
					<a href="<?php echo RTW_ADM;?>/app/?appcode=<?php echo $env->_get['appcode'];?>&sd=<?php echo $env->_get['sd'];?>&cf=form&opt_seq=<?php echo $_list[$m]['opt_seq'];?>" class="rt_btn_blue btn_in">수정</a>
					<a href="#;" onclick="option_delete(<?=$_list[$m]['opt_seq']?>);" class="rt_btn_red btn_in">삭제</a>
				</p>
			</td>
		</tr>
		<?
		}

	} else {
		?>
		<tr>
			<td colspan="4" style="height:150px;">등록된 데이터가 없습니다.</td>
		</tr>
		<?
	}
	?>
	</tbody>
</table>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em><span class="rt_mint">옵션 세트는</span> 제품 등록 시 <span class="rt_mint">기본으로 출력할 옵션 필드</span>를 미리 설정하는 기능입니다.</p>
	<p><em>-</em>기본 설정 세트의 <span class="rt_mint">라디오박스를 클릭</span>하면 즉시 설정이 됩니다.</p>
	<p><em>-</em>옵션 세트명을 클릭하면 해당 세트의 옵션을 수정할 수 있습니다.</p>
</div>

<!-- JS Controller //-->
<script src="<?php echo $_def['path_assets'];?>/js/product.admin.option.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>