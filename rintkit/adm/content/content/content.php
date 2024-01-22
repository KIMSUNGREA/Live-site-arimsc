<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<table class="rt_list_table">
	<caption>콘텐츠 목록</caption>
	<colgroup>
		<col style="width:8%"/>
		<col style="width:12%"/>
		<col style="width:12%"/>
		<col style="width:12%"/>
		<col style="width:44%"/>
		<col style="width:12%"/>
	</colgroup>
	<thead>
		<tr>
			<th><p>번호</p></th>
			<th><p>스크립트</p></th>
			<th><p>로그인 연동</p></th>
			<th><p>그룹</p></th>
			<th><p>콘텐츠 명</p></th>
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
			<td><p><?php echo $num;?></p></td>
			<td>
				<p class="rt_button_wrap rt_tac">
					<a href="#;" class="rt_btn_purple btn_in rt_toggle_tr_trigger">스크립트</a>
				</p>
			</td>
			<td><p class="rt_blue"><?php echo ($_list[$m]['login_is'] == 'y') ? "<b class='rt-text-red '>사용함</b>" : "<b class='rt-text-blue '>사용안함</b>";?></p></td>
			<td><p class="rt_gray"><?php echo $_list[$m]['grp_name'];?></p></td>
			<td class="rt_tal"><p>[<?php echo strtoupper($_list[$m]['content_type']);?>]<span class="rt_gray"><a href="<?php echo $_url?>/?sd=content&cf=form&seq=<?php echo $_list[$m]['seq'];?>"><?php echo $_list[$m]['title'];?></a></span></p></td>
			<td>
				<p class="rt_button_wrap rt_tac">
					<a href="javascript:content_delete(<?php echo $_list[$m]['seq'];?>);" class="rt_btn_red btn_in">삭제</a>
				</p>
			</td>
		</tr>
		<tr class="rt_toggle_tr">
			<td colspan="6">
				<div class="blind">
					<p class="rt_red">* HTML 출력</p>
					<p class="mb10">&lt;?php echo rt_content(<?php echo $_list[$m]['seq'];?>,"html");?></p>
					<p class="rt_red">* IMAGE 경로(img tag src)</p>
					<p class="mb10">&lt;?php echo rt_content(<?php echo $_list[$m]['seq'];?>,"path");?></p>
					<p class="rt_red">* LINK URL(a tag href)</p>
					<p>&lt;?php echo rt_content(<?php echo $_list[$m]['seq'];?>,"href");?></p>
				</div>
			</td>
		</tr>
			<?
		$num--;
		}

	} else {
		?>
		<tr>
			<td colspan="7" style="padding:50px;">데이터가 없습니다</td>
		</tr>
		<?
	}?>
	</tbody>
</table>

<div class="rt_button_wrap mb25 rt_tar">
	<a href="#;" id="btn-move-form" class="rt_btn_blue">콘텐츠 등록</a>
</div>
<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em>해당 콘텐츠의 스크립트 소스를 복사하여 웹페이지에 한번만 삽입하면 관리자에서 계속 설정이 가능합니다.</p>
	<p><em>-</em> 스크립트 출력 데이터에 맞게 활용해 주세요.<br />소스 작성 예 : &lt;img src="<span class="rt_yellow">&lt;?php rt_content(1,'path');?></span>" /> | 이미지 경로 출력
		<br />소스 작성 예 : &lt;p><span class="rt_yellow">&lt;?php rt_content(1,'html');?></span>&lt;/p> | HTML 소스 출력
		<br />소스 작성 예 : &lt;a href="<span class="rt_yellow">&lt;?php rt_content(1,'href');?></span>"&lt;/a> | 링크 경로 출력</p>
</div>

<script src="assets/js/content.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>