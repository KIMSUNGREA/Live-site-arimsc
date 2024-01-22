<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="ins_form" method="post" action="<?php echo $__sc;?>/update.php" target="rt_ifrm">
<input type="hidden" name="mode" value="insert">
<div class="rt_search_wrap">
	<input type="text" class="required" value="" name="s_name" msg="추가할 소스명을 입력해 주세요" />
	<span class="rt_button_wrap"><a href="#;" id="btn-source-ins" class="rt_btn_purple btn_s">새 소스 추가</a></span>
</div>
</form>

<table class="rt_list_table">
	<caption>스크립트 목록</caption>
	<colgroup>
		<col width="120px" />
		<col width="120px" />
		<col width="" />
		<col width="150px" />
	</colgroup>
	<thead>
		<tr>
			<th><p>번호</p></th>
			<th><p>스크립트</p></th>
			<th><p>소스 명</p></th>
			<th><p>관리</p></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$num = count($_list);
	if ($num > 0) {
		for ($m = 0; $m < count($_list); $m++) {
				?>
		<tr>
			<td><p><?php echo $num;?></p></td>
			<td>
				<p class="rt_button_wrap rt_tac">
					<a href="#;" class="rt_btn_purple btn_in rt_toggle_tr_trigger">스크립트</a>
				</p>
			</td>
			<td class="rt_tal"><p><a href="<?php echo RTW_ADM;?>/source/?sd=source&cf=form&seq=<?php echo $_list[$m]['seq'];?>"><?php echo $_list[$m]['name'];?></a></p></td>
			<td>
				<p class="rt_button_wrap rt_tac">
					<a href="<?=RTW_ADM?>/source/?sd=source&cf=form&seq=<?php echo $_list[$m]['seq'];?>" class="rt_btn_blue btn_in">설정</a>
					<?php if ($_list[$m]['grp_seq'] != "1") { ?>
					<a href="javascript:source_delete(<?php echo $_list[$m]['seq'];?>);" class="rt_btn_red btn_in">삭제</a>
					<?php } ?>
				</p>
			</td>
		</tr>
		<tr class="rt_toggle_tr">
			<td colspan="4">
				<div class="blind">
					<p class="rt_red">* 연동 스크립트</p>
					<p class="mb10">&lt;?php rt_source(<?php echo $_list[$m]['seq'];?>);?></p>
				</div>
			</td>
		</tr>
			<?
		$num--;
		}

	} else {
		?>
		<tr>
			<td colspan="4" style="padding:50px;">데이터가 없습니다</td>
		</tr>
		<?
	}?>
	</tbody>
</table>


<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em>위 스크립트를 홈페이지에 한번 설정해 두면 FTP 연결없이 이 곳에서 소스를 관리할 수 있습니다.</p>
</div>


<!-- JS Controller //-->
<script src="assets/js/rt.adm.source.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>