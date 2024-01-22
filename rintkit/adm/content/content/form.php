<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<form name="dataform" action="<?php echo $__sc?>/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?php echo $__cfg['mode'];?>">
<input type="hidden" name="seq" value="<?php echo $env->_get['seq'];?>">
<input type="hidden" name="content_type" value="<?php echo $_r['content_type'];?>">

<table class="rt_data_table">
	<caption>콘텐츠 등록</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>그룹</p></th>
			<td>
				<select class="rt_input_txt rt_w250 required" name="grp_seq" msg="그룹을 설정해 주세요">
					<option value="">그룹을 선택해 주세요</option>
					<?php for ($m = 0; $m < count($grp); $m++) {?>
					<option value="<?php echo $grp[$m]['grp_seq']?>" <?=($grp[$m]['grp_seq'] == $_r['grp_seq'])?"selected":""?>><?php echo $grp[$m]['grp_name']?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<th><p>콘텐츠 명</p></th>
			<td>
				<input type="text" class="rt_input_txt required" value="<?php echo $_r['title'];?>" name="title" msg="콘텐츠 명을 입력해 주세요." />
			</td>
		</tr>
		<tr>
			<th><p>콘텐츠 타입</p></th>
			<td>
				<p class="rt_button_wrap rt_tac">
					<a href="#;" id="con_type_img" class="rt_btn_purple btn_in rt_fll">이미지</a>
					<a href="#;" id="con_type_html" class="rt_btn_purple btn_in rt_fll">HTML</a>
				</p>
			</td>
		</tr>
		<tr id="tr_login" style="display:<?php echo ($__cfg['mode'] == "modify")?"":"none";?>;">
			<th>로그인 구분</th>
			<td>
				<label><input type="radio" name="login_is" id="login_is_y" value="y" <?php echo $login_is_y;?> /><span <?php echo $login_is_class_y;?>>사용함</span></label>
				<label><input type="radio" name="login_is" id="login_is_n" value="n" <?php echo $login_is_n;?> /><span <?php echo $login_is_class_n;?>>사용안함</span></label>
			</td>
		</tr>
		<tr id="tr_img1" style="display:<?php echo ($_r['content_type'] == "img")?"":"none";?>;">
			<th>이미지</th>
			<td colspan="3">
				<input type="file" id="" class="rt_w250 rt_fll" name="file1" />
				<?php if ($_r['file1_new']) { ?>
				<span class="rt_button_wrap rt_tac">
					<a href="javascript:img_delete(<?php echo $_r['seq'];?>, 1);" id="con_type_img" class="rt_btn_red btn_in">이미지 삭제</a>
				</span>
				<?php } ?>
				<?php if (!$_r['file1_new']) { ?>
				<p class="rt_green" style="margin-top:5px;margin-left:5px">※ 이미지가 없으면 출력되지 않습니다.</p>
				<?php } else { ?>
				<img src="<?php echo $_r['file_subdir'];?>/<?php echo $_r['file1_new'];?>" style="display:block;margin:10px 0;max-width:300px; max-heigth:400px;" />
				<?php } ?>
			</td>
		</tr>
		<tr id="tr_img2" style="display:<?php if ($_r['content_type'] == "img" && $_r['login_is'] == "y") {}else{echo "none";}?>;">
			<th>로그인 후 이미지</th>
			<td colspan="3">
				<input type="file" id="" class="rt_w250 rt_fll" name="file2" />
				<?php if ($_r['file2_new']) { ?>
				<span class="rt_button_wrap rt_tac">
					<a href="javascript:img_delete(<?php echo $_r['seq'];?>, 2);" id="con_type_img" class="rt_btn_red btn_in">이미지 삭제</a>
				</span>
				<?php } ?>
				<?php if (!$_r['file2_new']) { ?>
				<p class="rt_green" style="margin-top:5px;margin-left:5px">※ 이미지가 없으면 출력되지 않습니다.</p>
				<?php } else { ?>
				<img src="<?php echo $_r['file_subdir'];?>/<?php echo $_r['file2_new'];?>" style="display:block;margin:10px 0;max-width:300px; max-heigth:400px;" />
				<?php } ?>
			</td>
		</tr>
		<tr id="tr_img3" style="display:<?php echo ($_r['content_type'] == "img")?"":"none"?>;">
			<th>링크 URL</th>
			<td colspan="3">
				<input type="text" class="rt-input" value="<?php echo $_r['href'];?>" name="href" />
			</td>
		</tr>
		<tr id="tr_html1" style="display:<?php echo ($_r['content_type'] == "html")?"":"none";?>;">
			<th>HTML</th>
			<td colspan="3">
				<textarea name="html1" rows="" title="" class="rt-input" style="height:150px;"><?php echo htmlspecialchars_decode(stripslashes($_r['html1']));?></textarea>
			</td>
		</tr>
		<tr id="tr_html2" style="display:<?php if ($_r['content_type'] == "html" && $_r['login_is'] == "y") {}else{echo "none";}?>;">
			<th>로그인 후 HTML</th>
			<td colspan="3">
				<textarea name="html2" rows="" title="" class="rt-input" style="height:150px;"><?php echo htmlspecialchars_decode(stripslashes($_r['html2']));?></textarea>
			</td>
		</tr>
	</tbody>
</table>
</form>


<div class="rt_button_wrap rt_tar mb25">
	<?php if ($__cfg['mode'] == "insert") {?>
	<a href="#;" id="btn-submit" class="rt_btn_blue">새 콘텐츠 등록</a>
	<?php } else { ?>
	<a href="#;" id="btn-submit" class="rt_btn_blue">정보 변경</a>
	<?php } ?>
	<a href="#;" id="btn-move-list" class="rt_btn_gray">목록 가기</a>
</div>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em>로그인 구분을 설정하면 <span class="rt_yellow">로그인 전과 로그인 후의 콘텐츠</span>를 각각 다르게 설정할 수 있습니다.</p>
</div>


<script src="assets/js/content.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>