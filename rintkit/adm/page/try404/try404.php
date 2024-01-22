<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<div class="rt_s_gnb">
	<a href="<?php echo RTW_ADM;?>/page/?sd=forward" class="rt_depth1">유입자 화면이동 규칙</a>
	<a href="<?php echo RTW_ADM;?>/page/?sd=match" class="rt_depth1">404 페이지 매칭</a>
	<a href="<?php echo RTW_ADM;?>/page/?sd=try404" class="rt_depth1 rt_active">404 요청 URL</a>
	<a href="<?php echo RTW_ADM;?>/page/?sd=source" class="rt_depth1">화면이동(고정) 링크소스</a>
</div>

<table class="rt_field_table mb30">
	<caption>404 요청 URL</caption>
	<colgroup>
		<col width="45%" />
		<col width="45%" />
		<col width="15%" />
		<col width="15%" />
	</colgroup>
	<tr>
		<th><p>요청 파일명</p></th>
		<th><p>요청 URL</p></th>
		<th><p>요청 수</p></th>
		<th><p>관리</p></th>
	</tr>
	<?php for ($m = 0; $m < count($_r); $m++) {?>
	<tr>
		<td><?php echo $_r[$m]['try_file'];?></td>
		<td><?php echo $_r[$m]['try_url'];?></td>
		<td><?php echo $_r[$m]['try_cnt'];?></td>
		<td>
			<div class="rt_button_wrap rt_tac">
				<a href="javascript:delete_page(<?php echo $_r[$m]['seq'];?>);" class="rt_btn_red btn_in">삭제</a>
			</div>
		</td>
	</tr>
	<?php } ?>
</table>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em><span class="rt_mint">404 요청 URL이란</span> 실제 서버(홈페이지)에 존재하지 않은 페이지나 이미지 등을 요청했던 내역을 말합니다.</p>
	<p><em>-</em><span class="rt_mint">존재하지 않는 파일</span>에 대한 요청을 이 페이지에서 확인하여 <span class="rt_mint">페이지 최적화 작업</span>에 활용할 수 있습니다.</p>
	<p><em>-</em><span class="rt_mint">존재하지 않는 페이지</span>에 대한 요청을 확인하여 <span class="rt_mint">페이지를 제공하거나 포워딩하는 작업</span>에 참고할 수 있습니다..</p>
</div>

<script src="assets/js/page.try404.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>