<?php
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); } 

require_once RT_DOC_ROOT.RTW_ADM."/popup/popup/inc.common.menu.php";
?>

<table class="rt_list_table">
	<caption>팝업관리</caption>
	<colgroup>
		<col style="width:5%"/>
		<col style="width:8%"/>
		<col style="width:41%"/>
		<col style="width:12%"/>
		<col style="width:12%"/>
		<col style="width:12%"/>
		<col style="width:10%"/>
	</colgroup>
	<thead>
		<tr>
			<th><p>번호</p></th>
			<th><p>사용 여부</p></th>
			<th><p>팝업 제목</p></th>
			<th><p>시작일</p></th>
			<th><p>마감일</p></th>
			<th><p>등록일</p></th>
			<th><p>관리</p></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$_url = RTW_ADM."/".$__dr;
	$num = count($_list);
	if ($num > 0) {
		for ($m = 0; $m < count($_list); $m++) {
			$regdate = substr($_list[$m]['regdate'],0,10);
				?>
		<tr>
			<td><p><?php echo $num?></p></td>
			<td><p><?=($_list[$m]['is_view'] == 'y') ? "<b class='rt-text-red '>사용중</b>" : "<b class='rt-text-blue '>미사용</b>";?></p></td>
			<td class="rt_tal"><p><a href="<?php echo $_url;?>/?sd=popup&cf=form&seq=<?php echo $_list[$m]['seq'];?>"><?php echo $_list[$m]['title'];?></a></p></td>
			<td><p><?php echo $_list[$m]['date_start'];?></p></td>
			<td><p><?php echo $_list[$m]['date_end'];?></p></td>
			<td><p><?php echo $regdate;?></p></td>
			<td><p class="rt_button_wrap rt_tac"><a href="javascript:popup_delete(<?php echo $_list[$m]['seq'];?>);" class="rt_btn_red btn_in">삭제</a></p></td>
		</tr>
			<?
		$num--;
		}

	} else {

		?>
		<tr>
			<td class="rt-text-c f-s" colspan="7" style="padding:50px;">데이터가 없습니다</td>
		</tr>
		<?
	}?>
	</tbody>
</table>
<div class="rt_button_wrap rt_tar mb25">
	<a href="#;" id="btn-move-form" class="rt_btn_blue">팝업 등록</a>
</div>
<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em>팝업 노출안될 시 <span class="rt_mint">게시 마감일, 팝업 이용여부</span> 설정을 확인해 주세요</p>
	<p><em>-</em><span class="rt_mint">모바일 팝업</span>은 가장 최근에 등록된 팝업 1개만 노출됩니다.</p>
</div>

<script src="assets/js/popup.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>