<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<div class="rt_left_ban_wrap clearfix">
	<div class="rt_left_ban_con">
		<div class="rt_button_wrap mb10"><a href="#;" id="btn-insert" class="bth_b rt_btn_orange">새 필드 추가</a></div>
		<ul class="rt_field_wrap">
		<?php
		$form_cnt = count($_fl);
		if ($form_cnt > 0) {
			for ($m = 0; $m < $form_cnt; $m++) {

				if ($_fl[$m]['is_use'] == "y") {
					$is_use = "<font color='orange'>[ON]</font>";
				} else {
					$is_use = "<font color='#999999'>[OFF]</font>";
				}
				if ($_fl[$m]['is_require'] == "y") {
					$str_require = "<font color='red'>[필수]</font>";
				} else {
					$str_require = "";
				}
				?>
			<li class="rt_field_con clearfix">
				<p class="rt_txt"><a href="<?php echo $_def['path_app'];?>/<?php echo $__sd;?>/update.php?mode=chgord&formnum=<?php echo $_fl[$m]['formnum'];?>&type=u" target="rt_ifrm"><img src="<?php echo $_def['path_assets'];?>/img/up_btn.png" alt="위로" /></a><a href="<?php echo $_def['path_app'];?>/<?php echo $__sd;?>/update.php?mode=chgord&formnum=<?php echo $_fl[$m]['formnum'];?>&type=d" target="rt_ifrm" style="margin-left:3px;"><img src="<?php echo $_def['path_assets'];?>/img/down_btn.png" alt="아래로" /></a> <?php echo $_fl[$m]['name'];?> <?php echo $is_use;?> <?php echo $str_require;?></p>
				<div class="rt_ico_wrap">
					<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=<?php echo $env->_get['sd'];?>&seq=<?php echo $_fl[$m]['seq'];?>" title="수정"><img src="<?php echo $_def['path_assets'];?>/img/sawtooth_ico.png" alt="톱니" /></a>
					<a href="javascript:delete_field(<?php echo $_fl[$m]['seq']?>);" title="삭제"><img src="<?php echo $_def['path_assets'];?>/img/trash.png" alt="쓰레기통" /></a>
				</div>
			</li>
			<?php
			}
		}
		?>
		</ul>
	</div>

	<form name="dataform" action="<?php echo $_def['path_app'];?>/<?php echo $__sd;?>/update.php" method="post" target="rt_ifrm">
	<input type="hidden" name="mode" value="<?php echo $_def['mode'];?>">
	<input type="hidden" name="seq" value="<?php echo $_f['seq'];?>">
	<table class="rt_field_table mb10">
		<caption>필드 추가하기</caption>
		<colgroup>
			<col style="width:15%"/>
			<col style="width:85%"/>
		</colgroup>
		<tr>
			<th><p>필드 명</p></th>
			<td>
				<input type="text" class="rt_input_txt required" value="<?php echo $_f['name'];?>" name="name" msg="필드명을 입력해 주세요" />
			</td>
		</tr>
		<tr>
			<th><p>필드 형태</p></th>
			<td>
				<div class="rt_type_wrap">
					<label>
						<p><input type="radio" name="type" value="text" <?php echo $type_text;?> class="ftype" />텍스트</p>
						<img src="<?php echo $_def['path_assets'];?>/img/field1.png" alt="필드 형태" />
					</label>
					<label>
						<p><input type="radio" name="type" value="checkbox" <?php echo $type_checkbox;?> class="ftype" />체크박스(중복선택)</p>
						<img src="<?php echo $_def['path_assets'];?>/img/field2.png" alt="필드 형태" />
					</label>
					<label>
						<p><input type="radio" name="type" value="radio" <?php echo $type_radio;?> class="ftype" />라디오박스(택1)</p>
						<img src="<?php echo $_def['path_assets'];?>/img/field3.png" alt="필드 형태" />
					</label>
					<label>
						<p><input type="radio" name="type" value="select" <?php echo $type_select;?> class="ftype" />셀렉트박스(택1)</p>
						<img src="<?php echo $_def['path_assets'];?>/img/field4.png" alt="필드 형태" />
					</label>
					<label>
						<p><input type="radio" name="type" value="textarea" <?php echo $type_textarea;?> class="ftype" />장문 텍스트박스</p>
						<img src="<?php echo $_def['path_assets'];?>/img/field5.png" alt="필드 형태" />
					</label>
				</div>
			</td>
		</tr>
		<tr id="trSizeW" style="display:<?php echo $trSizeWDisplay?>">
			<th><p>필드 가로 사이즈</p></th>
			<td>
				<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_f['size_w'];?>" name="size_w" /> px
			</td>
		</tr>
		<tr id="trSizeH" style="display:<?php echo $trSizeHDisplay?>">
			<th><p>필드 세로 사이즈</p></th>
			<td>
				<input type="text" class="rt_input_txt rt_w40" value="<?php echo $_f['size_h'];?>" name="size_h" /> px
			</td>
		</tr>
		<tr id="trData" style="display:<?php echo $trDataDisplay?>">
			<th><p>필드 옵션</p></th>
			<td>
				<textarea name="data"><?php echo $_f['data'];?></textarea>
				<span class="rt_txt rt_blue">예시) 서울,부산,대구,대전 등 각 옵션을 쉼표(,)로 구분하여 공백없이 단어를 입력해 주세요.</span>
			</td>
		</tr>
		<tr id="trReq" style="display:<?php echo $trReqDisplay?>">
			<th><p>필수 여부</p></th>
			<td>
				<label><input name="is_require" value="y" type="radio" <?php echo $is_require_y;?>><span>사용함</span></label>
				<label><input name="is_require" value="n" type="radio" <?php echo $is_require_n;?>><span>사용하지 않음</span></label>
			</td>
		</tr>
		<tr id="trReqData" style="display:<?php echo $trReqData?>">
			<th><p>필수 입력 메시지</p></th>
			<td>
				<input type="text" class="rt_input_txt" value="<?php echo $_f['require_text'];?>" name="require_text" />
			</td>
		</tr>
		<tr>
			<th><p>사용 여부</p></th>
			<td>
				<label><input name="is_use" value="y" type="radio" <?php echo $is_use_y;?>><span>사용함</span></label>
				<label><input name="is_use" value="n" type="radio" <?php echo $is_use_n;?>><span>사용하지 않음</span></label>
			</td>
		</tr>
		<?php if ($_def['mode'] == "modify") { ?>
		<tr>
			<th><p>CSS Class</p></th>
			<td>
				<span style="color:#CC3D3D;"><b>.rtmember-add-css-<?php echo $_f['seq'];?></b></span> (이 필드에 부여된 CSS Class 명입니다.)
			</td>
		</tr>
		<tr>
			<th><p>CSS 작성 예시</p></th>
			<td>
				<p style="line-height:20px;">
					.rtmember-add-css-<?php echo $_f['seq'];?>  {<br />
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;font-size:12px;<br />
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;padding:5px;<br />
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;color:#999999;<br />
					}
				</p>
			</td>
		</tr>
		<?php } else { ?>
		<tr>
			<th><p>CSS 설정</p></th>
			<td><span style="color:#CC3D3D;">필드를 등록하시면 해당 필드에 대해 별도 설정가능한 CSS Class가 부여됩니다.</span></td>
		</tr>
		<?php } ?>
	</table>
	</form>

	<?php if ($_def['mode'] == "modify") { ?>
	<div class="rt_button_wrap tar"><a href="#;" id="btn-form-submit" class="rt_btn_blue">정보 변경</a></div>
	<?php } else { ?>
	<div class="rt_button_wrap tar"><a href="#;" id="btn-form-submit" class="rt_btn_blue">새 필드 추가</a></div>
	<?php } ?>
</div>
<br />
<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em><span class="rt_red">주의)</span> 운영되고 있는 상태의 필드를 <span class="rt_mint">삭제</span>하거나 <span class="rt_mint">필드형태</span>를 바꾸면 저장되어 있던 데이터는 삭제되고 복구할 수 없습니다.</p>
</div>

<script src="<?php echo $_def['path_assets'];?>/js/rtmember.admin.field.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>