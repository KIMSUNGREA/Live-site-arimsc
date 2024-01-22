<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php
if ($env->_get['bcode']) {
	require_once RT_DOC_ROOT.$_def['path_app']."/theme/".$_bdinfo['theme']."/inc.common.menu.php";
}
?>

<form name="data_form" action="<?php echo $_def['path_app']."/".$__sd?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="<?php echo $__cfg['mode']?>">
<input type="hidden" name="bcode" value="<?php echo $env->_get['bcode']?>">
<input type="hidden" name="sd" value="<?php echo $env->_get['sd']?>">
<table class="rt_data_table">
	<caption>게시판 연동</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>게시판 코드</p></th>
			<td>
				<?php if ($env->_get['bcode']) {?>
				<b><?php echo $_bdinfo['bcode']?></b>
				<?php } else {?>
				<input name="bcode" class="rt_input_txt required" type="text" value="<?php echo $_bdinfo['bcode']?>" msg="게시판 코드를 입력해 주세요">
				<p class="rt_green">* 영문과 숫자만 사용</p>
				<?php }?>
			</td>
			<th><p>게시판 그룹</p></th>
			<td>
				<select name="gseq" class="rt_input_txt required" msg="게시판 그룹을 선택해 주세요">
					<option value="">게시판 그룹 선택</option>
					<?php for ($m = 0; $m < count($_g); $m++) { ?>
					<option value="<?php echo $_g[$m]['grp_seq']?>" <?php echo ($_g[$m]['grp_seq']==$_bdinfo['gseq'])?"selected":""?>><?php echo $_g[$m]['grp_name']?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<th><p>게시판 이름</p></th>
			<td colspan="3">
				<input name="name" class="rt_input_txt" type="text" value="<?php echo $_bdinfo['name']?>" msg="게시판 이름을 선택해 주세요">
			</td>
		</tr>
		<tr>
			<th><p>게시판 테마</p></th>
			<td colspan="3" class="rt_img_label">
			<?php if ($env->_get['bcode']) {?>
				<label>
					<p><?php echo $_cfg_rtboard_theme[$_bdinfo['theme']]?> (<?php echo $_bdinfo['theme']?>)</p>
					<img src="<?php echo $_def['path_assets'];?>/img/thema_<?php echo $_bdinfo['theme'];?>.png" />
				</label>
			<?php } else { ?>
				<?php foreach ($_cfg_rtboard_theme as $k => $v) { ?>
				<label>
					<p><input type="radio" name="theme" value="<?php echo $k?>" <?php echo ($k=="info")?"checked='checked'":""?> onclick="set_theme_skin('<?php echo $k;?>')"><?php echo $v;?> (<?php echo $k;?>)</p>
					<img src="<?php echo $_def['path_assets'];?>/img/thema_<?php echo $k;?>.png" />
				</label>
				<?php } ?>
			<?php } ?>
			</td>
		</tr>
		<?php if (!$env->_get['bcode']) { ?>
		<tr>
			<th><p>스킨 설정</p></th>
			<td colspan="3">
				<p><label><input name="copy_skin" type="radio" value="y" checked="checked"> 새 기본 스킨파일을 생성합니다.</label></p>
				<p><label><input name="copy_skin" type="radio" value="n"> 기존 스킨 중 선택합니다.</label></p>
			</td>
		</tr>
		<tr id="tr-skin" style="display:none;">
			<th>스킨 선택</th>
			<td id="skin-area" colspan="3"></td>
		</tr>
		<?php } ?>
		<tr>
			<th><p>운용 상태</p></th>
			<td colspan="3">
				<p><label><input name="state" type="radio" value="on" <?php echo $state_on;?>> 사용함</label></p>
				<p><label><input name="state" type="radio" value="off" <?php echo $state_off;?>> 사용안함</label></p>
			</td>
		</tr>
	</tbody>
</table>
</form>

<div class="rt_button_wrap rt_tar">
	<?php if (empty($_bdinfo['bseq'])) {?>
	<a href="#;" id="btn-list" class="rt_btn_gray">목록 가기</a>
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">새 게시판 등록</a>
	<?php } else {?>
	<a href="#;" onclick="board_delete(<?=$_bdinfo['bseq']?>)" class="rt_btn_red">삭 제</a>
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">정보 변경</a>
	<?php }?>
</div>
<br />
<?php if ($env->_get['bcode']) { ?>
<div class="rt_bot_box">
	<h1>이용안내</h1>
	<p><em>-</em>게시판 생성 시 설정된 테마는 변경할 수 없습니다.</p>
	<p><em>-</em>게시판 삭제 시 해당 게시판의 모든 데이터가 삭제되며 <span class="rt_mint">FTP 상의 실제 스킨 파일</span>은 삭제되지 않습니다.</p>
</div>
<?php } else { ?>
<div class="rt_bot_box">
	<h1>이용안내</h1>
	<p><em>-</em>스킨 설정 방법으로 <span class="rt_mint">기본 스킨 생성</span> 방식을 선택하면 실제 HTML 스킨파일이 서버에 생성이 되며 FTP 로 다운로드하여 수정가능합니다.</p>
	<p><em>-</em>스킨 설정 방법으로 <span class="rt_mint">기존 스킨 선택</span> 방식을 선택하여 게시판을 생성한 뒤에도 <span class="rt_mint">스킨 설정 메뉴</span>에서 스킨을 언제든지 변경할 수 있습니다.</p>
</div>
<?php } ?>

<script src="<?php echo $_def['path_section'];?>/js/rtboard.admin.board.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>