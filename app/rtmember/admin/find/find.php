<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<div class="fixed-area">
	<form name="dataform" action="<?=$_def['path_app']."/".$__sd?>/update.php" method="post" target="rt_ifrm">
	<input type="hidden" name="mode" value="<?=$__cfg['mode']?>">
	<div class="rt-box-wrap top-line02 rt-grid-fixed-pc" style="min-width:768px;">
		<div class="rt-table-data01 s-xr">
			<table>
			<caption>계정찾기 환경설정</caption>
			<colgroup>
				<col width="20%" />
				<col width="" />
			</colgroup>
			<tbody>
			<tr>
				<th>계정찾기 스킨</th>
				<td>
					<div class="rt-box-100" style="padding:5px;color:#980000;">
						FTP PATH : <?=$_def['path_app']?>/template/
					</div>
					<div class="rt-box-50" style="padding:0px;">
						<label for="" class="rt-no-label">스킨설정</label>
						<select class="rt-input required" name="mb_skin_find" msg="템플릿 파일을 선택해 주세요">
							<option value="">템플릿파일을 선택해 주세요</option>
							<?php foreach ($tpl_files as $k => $v) {?>
							<option value="<?=$v?>" <?=($v == $r['mb_skin_find'])?"selected":""?>><?=$v?></option>
							<?php }?>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<th>계정찾기 이용수단</th>
				<td>
					<div class="rt-box-100" style="padding:0px;">
						<div class="rt-radios-box">
							<div class="rt-box-30"><label><input name="find_type_en" value="email" type="radio" <?=$find_type_en_email?>> 메일</label></div>
							<div class="rt-box-30"><label><input name="find_type_en" value="sms" type="radio" <?=$find_type_en_sms?>> SMS</label></div>
						</div>
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
	</div>
	</form>
</div>


<div class="rt-box-wrap rt-grid-start-mob">
	<div class="rt-box-7"><button type="button" id="btn-form-submit" class="rt-btn blue block">설정 변경</button></div>
</div>

<!-- JS Controller //-->
<script src="<?=$_def['path_assets']?>/js/rtmember.admin.find.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>