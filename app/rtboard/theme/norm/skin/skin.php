<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php
if ($env->_get['bcode']) {
	require_once RT_DOC_ROOT.$_def['path_app']."/theme/".$_bdinfo['theme']."/inc.common.menu.php";
}
?>

<form name="dataform" action="<?php echo $_def['path_app']."/".$__sd;?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="<?php echo $_def['mode'];?>">
<input type="hidden" name="bcode" value="<?php echo $env->_get['bcode'];?>">
<input type="hidden" name="theme" value="<?php echo $_bdinfo['theme'];?>">
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>템플릿 코드</h1>
</div>
<table class="rt_data_table">
	<caption>스킨 설정 | 템플릿코드</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>템플릿 코드</p></th>
			<td>
				<p><span class="rt_button_wrap"><a href="#;" class="rt_btn_red btn_in" onclick="window.open('<?php echo $_def['path_admin'];?>/guide/inc.template_code.php','_blank','toolbar=no,scrollbars=no,resizable=no,top=0,right=0,width=1000,height=800')">템플릿 코드 보기</a></span></p>
			</td>
		</tr>
		<tr>
			<th><p>스킨 파일 경로</p></th>
			<td>
				<p><?php echo $_def['path_app'];?>/template/</p>
			</td>
		</tr>
		<tr>
			<th><p>CSS 파일 경로</p></th>
			<td>
				<p><span class="rt_bold">PC : </span><?php echo $_def['path_app'];?>/theme/<?php echo $_bdinfo['theme'];?>/user/css/rtboard.<?php echo $_bdinfo['theme'];?>.css</p>
				<p><span class="rt_bold">MOBILE : </span><?php echo $_def['path_app'];?>/theme/<?php echo $_bdinfo['theme'];?>/user/css/rtboard.<?php echo $_bdinfo['theme'];?>.mobile.css</p>
			</td>
		</tr>
	</tbody>
</table>

<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>PC 스킨</h1>
</div>
<table class="rt_data_table">
	<caption>스킨 설정 | PC 스킨</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>목록 페이지</p></th>
			<td>
				<select name="skin_pc_list">
					<option value="">템플릿파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $skin_arr['skin_pc_list'])?"selected":""?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
			<th><p>내용 보기 페이지</p></th>
			<td>
				<select name="skin_pc_view">
					<option value="">템플릿파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $skin_arr['skin_pc_view'])?"selected":""?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<th><p>쓰기 페이지</p></th>
			<td>
				<select name="skin_pc_form">
					<option value="">템플릿파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $skin_arr['skin_pc_form'])?"selected":""?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
			<th><p>답글 페이지</p></th>
			<td>
				<select name="skin_pc_reply">
					<option value="">템플릿파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $skin_arr['skin_pc_reply'])?"selected":""?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
	</tbody>
</table>

<div class="rt_s_tit clearfix">
	<p>03<span></span></p>
	<h1>모바일 스킨</h1>
</div>
<table class="rt_data_table">
	<caption>모바일 스킨</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>모바일 스킨</p></th>
			<td colspan="3">
				<p><label><input name="mobile_skin_is" value="y" type="radio" <?php echo $mobile_skin_is_y;?>> 사용함</label></p>
				<p><label><input name="mobile_skin_is" value="n" type="radio" <?php echo $mobile_skin_is_n;?>> 사용안함</label></p>
			</td>
		</tr>
		<tr>
			<th><p>목록 페이지</p></th>
			<td>
				<select name="skin_mobile_list">
					<option value="">템플릿파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $skin_arr['skin_mobile_list'])?"selected":""?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
			<th><p>내용 보기 페이지</p></th>
			<td>
				<select name="skin_mobile_view">
					<option value="">템플릿파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $skin_arr['skin_mobile_view'])?"selected":""?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<th><p>쓰기 페이지</p></th>
			<td>
				<select name="skin_mobile_form">
					<option value="">템플릿파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $skin_arr['skin_mobile_form'])?"selected":""?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
			<th><p>답글 페이지</p></th>
			<td>
				<select name="skin_mobile_reply">
					<option value="">템플릿파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $skin_arr['skin_mobile_reply'])?"selected":""?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
	</tbody>
</table>

<div class="rt_button_wrap rt_tar mb25">
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">설정 변경</a>
</div>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em>스킨파일(HTML)에서 템플릿 코드를 사용할 수 있습니다. <a href="#;" class="rt_mint" id="btn-reference-link">(고급 사용법 보기)</a></p>
	<p><em>-</em>템플릿 코드를 HTML 스킨 파일에 적절히 삽입하면 프로그램 데이터와 쉽게 연동할 수 있습니다.</p>
	<p><em>-</em><span class="rt_mint">반응형</span>으로 스킨을 제작하였을 경우 <span class="rt_mint">PC,모바일을 동일한 파일로 설정</span>해 주세요.</p>
</div>

<script src="<?php echo $_def['path_section'];?>/js/rtboard.theme.norm.skin.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>