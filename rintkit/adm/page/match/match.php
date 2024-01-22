<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<div class="rt_s_gnb">
	<a href="<?php echo RTW_ADM;?>/page/?sd=forward" class="rt_depth1">유입자 화면이동 규칙</a>
	<a href="<?php echo RTW_ADM;?>/page/?sd=match" class="rt_depth1 rt_active">404 페이지 매칭</a>
	<a href="<?php echo RTW_ADM;?>/page/?sd=try404" class="rt_depth1">404 요청 URL</a>
	<a href="<?php echo RTW_ADM;?>/page/?sd=source" class="rt_depth1">화면이동(고정) 링크소스</a>
</div>

<form name="ins_form" id="ins_form" method="post" action="<?php echo $__sc;?>/update.php" target="rt_ifrm">
<input type="hidden" name="mode" value="insert">
<table class="rt_field_table mb10">
	<caption>404 페이지 매칭</caption>
	<colgroup>
		<col width="10%" />
		<col width="30%" />
		<col width="30%" />
		<col width="15%" />
		<col width="15%" />
	</colgroup>
	<tr>
		<th><p>매칭 방식</p></th>
		<th><p>접속시도 페이지</p></th>
		<th><p>이동시킬 페이지</p></th>
		<th><p>페이지명</p></th>
		<th><p>관리</p></th>
	</tr>
	<tr>
		<td class="rt_tal">
			<select name="rule_en" class="rt_input_txt">
				<option value="all">전체 URL</option>
				<option value="page">페이지명</option>
			</select>
		</td>
		<td><input type="text" class="rt_input_txt" name="pg_target" /></td>
		<td><input type="text" class="rt_input_txt" name="pg_forward" /></td>
		<td><input type="text" class="rt_input_txt" name="pg_title" /></td>
		<td>
			<div class="rt_button_wrap rt_tac">
				<a href="#;" id="btn-add-page" class="rt_btn_orange btn_in">+ 페이지 추가</a>
			</div>
		</td>
	</tr>
</table>
</form>

<table class="rt_field_table mb30">
	<caption>404 페이지 매칭</caption>
	<colgroup>
		<col width="10%" />
		<col width="30%" />
		<col width="30%" />
		<col width="15%" />
		<col width="15%" />
	</colgroup>
	<tr>
		<th><p>매칭 방식</p></th>
		<th><p>접속시도 페이지</p></th>
		<th><p>이동시킬 페이지</p></th>
		<th><p>페이지명</p></th>
		<th><p>관리</p></th>
	</tr>
	<?php for ($m = 0; $m < count($_r); $m++) {?>
	<form name="data_form<?php echo $_r[$m]['seq'];?>" action="<?php echo $__sc;?>/update.php" method="post" target="rt_ifrm">
	<input type="hidden" name="mode" value="modify">
	<input type="hidden" name="seq" value="<?php echo $_r[$m]['seq'];?>">
	<tr>
		<td>
			<select name="rule_en" class="rt_input_txt">
				<option value="all" <?php echo ($_r[$m]['rule_en']=="all")?"selected":"";?>>전체 URL</option>
				<option value="page" <?php echo ($_r[$m]['rule_en']=="page")?"selected":"";?>>페이지명</option>
			</select>
		</td>
		<td><input type="text" class="rt_input_txt" value="<?php echo $_r[$m]['pg_target'];?>" name="pg_target" /></td>
		<td><input type="text" class="rt_input_txt" value="<?php echo $_r[$m]['pg_forward'];?>" name="pg_forward" /></td>
		<td><input type="text" class="rt_input_txt" value="<?php echo $_r[$m]['pg_title'];?>" name="pg_title" /></td>
		<td>
			<div class="rt_button_wrap rt_tac">
				<a href="javascript:delete_page(<?php echo $_r[$m]['seq'];?>);" class="rt_btn_red btn_in">삭제</a>
				<a href="javascript:data_form<?php echo $_r[$m]['seq'];?>.submit();" class="rt_btn_blue btn_in">수정</a>
			</div>
		</td>
	</tr>
	</form>
	<?php } ?>
</table>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em>매칭 패턴과 포워딩 페이지는 도메인까지의 정보를 제외하고 <span class="rt_mint">슬래시(/)를 포함한 URL 정보</span>만 입력합니다.</p>
	<p><em>-</em><span class="rt_mint">전체 URL 매칭</span>은 접속시도된 URL과 등록된 매칭 패턴이 <span class="rt_mint">정확히 일치하는 경우</span>에만 포워딩을 합니다.</p>
	<p><em>-</em><span class="rt_mint">페이지명 매칭</span>은 접속시도된 URL 중 <span class="rt_mint">파일명까지만 추출</span>하여 <span class="rt_mint">등록된 매칭 패턴 정보와 비교</span>하여 포워딩을 합니다.</p>
	<p><em>-</em>아래와 같은 방법으로 등록합니다.
		<br />접속시도된 URL 주소 예시 : <span class="rt_white">http://abc.com/dir1/dir2/file1.php?code=ab&agr=123</span>
		<br />매칭 패턴 작성 1 : <span class="rt_mint">/dir1/dir2/file1.php?code=ab&agr=123 </span><span class="rt_white">(전체URL 비교 필요 시)</span>
		<br />매칭 패턴 작성 2 : <span class="rt_mint">/dir1/dir2/file1.php </span><span class="rt_white">(페이지명만 비교하거나 추가URL 데이터가 필요 없는 일반 페이지일 경우)</span>
	</p>
	<p><em>-</em>매칭 작동 시 <span class="rt_mint">전체 URL 매칭</span>이 <span class="rt_mint">페이지명 매칭</span>보다 <span class="rt_mint">우선으로 작동</span>합니다.</p>
</div>

<script src="assets/js/page.match.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>