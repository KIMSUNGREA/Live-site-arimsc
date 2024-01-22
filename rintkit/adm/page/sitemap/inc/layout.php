<?php
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//분류 정보 세팅
$cls_ct->dbLoadCategory();


//카테고리 정보
if (empty($env->_post['code'])) {
	$_c = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND parent='0' AND sort=1");
	$env->_post['code'] = $_c['code'];
} else {
	$_c = $dbo->fetch("SELECT * FROM ".$cls_ct->db_tbl." WHERE groupcode='".$cls_ct->groupcode."' AND code='".$env->_post['code']."'");
}

//페이지 데이터 레코드
$_r = $dbo->fetch("SELECT * FROM RT_PAGE WHERE pcode='".$_c['code']."'");

//라디오형 데이터 세팅
${"cont_type_en_".$_r['cont_type_en']} = "checked='checked'";
${"cont_type_m_en_".$_r['cont_type_m_en']} = "checked='checked'";

//display
if ($_r['cont_type_en'] == "img") {
	$tr_cont_img = "";
	$tr_cont_html = "none";
	$tr_cont_board = "none";
	$tr_cont_member = "none";
} else if ($_r['cont_type_en'] == "html") {
	$tr_cont_img = "none";
	$tr_cont_html = "";
	$tr_cont_board = "none";
	$tr_cont_member = "none";
} else if ($_r['cont_type_en'] == "board") {
	$tr_cont_img = "none";
	$tr_cont_html = "none";
	$tr_cont_board = "";
	$tr_cont_member = "none";
} else if ($_r['cont_type_en'] == "member") {
	$tr_cont_img = "none";
	$tr_cont_html = "none";
	$tr_cont_board = "none";
	$tr_cont_member = "";
}

if ($_r['cont_type_m_en'] == "img") {
	$tr_cont_img_m = "";
	$tr_cont_html_m = "none";
	$tr_cont_board_m = "none";
	$tr_cont_member_m = "none";
} else if ($_r['cont_type_m_en'] == "html") {
	$tr_cont_img_m = "none";
	$tr_cont_html_m = "";
	$tr_cont_board_m = "none";
	$tr_cont_member_m = "none";
} else if ($_r['cont_type_m_en'] == "board") {
	$tr_cont_img_m = "none";
	$tr_cont_html_m = "none";
	$tr_cont_board_m = "";
	$tr_cont_member_m = "none";
} else if ($_r['cont_type_m_en'] == "member") {
	$tr_cont_img_m = "none";
	$tr_cont_html_m = "none";
	$tr_cont_board_m = "none";
	$tr_cont_member_m = "";
}

//레이아웃 파일 리스트
$tpl_dir = RT_DOC_ROOT.$_app['app_path']."/layout";
$tpl_files = rt_template_list($tpl_dir);

//게시판 목록
$_bl = $dbo->fetch_list("SELECT * FROM RT_RTBOARD AS b LEFT JOIN RT_RTBOARD_GROUP AS bg ON (b.gseq=bg.grp_seq) WHERE b.state='on' ORDER BY bg.grp_ord ASC, b.name ASC");
?>
<form name="dataform1" action="<?php echo RTW_ADM;?>/page/sitemap/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
<input type="hidden" name="mode" value="content">
<input type="hidden" name="code" value="<?php echo $env->_post['code'];?>">
<h1 class="tit">페이지 레이아웃/콘텐츠</h1>
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>PC 페이지</h1>
</div>
<table class="rt_data_table">
	<caption>페이지 레이아웃 정보</caption>
	<colgroup>
		<col style="width:20%"/>
		<col style="width:80%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>스킨 디렉토리 경로</p></th>
			<td>
				<p><?php echo $_app['app_path'];?>/layout/</p>
			</td>
		</tr>
		<tr>
			<th><p>레이아웃 상단 스킨</p></th>
			<td>
				<select name="layout_skin_head">
					<option value="">레이아웃 파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $_r['layout_skin_head'])?"selected":"";?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<th><p>레이아웃 하단 스킨</p></th>
			<td>
				<select name="layout_skin_footer">
					<option value="">레이아웃 파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $_r['layout_skin_footer'])?"selected":"";?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<th><p>콘텐츠 타입</p></th>
			<td>
				<label><input name="cont_type_en" value="img" onclick="toggle_data('cont_type_en',this)" type="radio" <?php echo $cont_type_en_img;?>> 이미지</label>
				<label><input name="cont_type_en" value="html" onclick="toggle_data('cont_type_en',this)" type="radio" <?php echo $cont_type_en_html;?>> HTML</label>
				<label><input name="cont_type_en" value="board" onclick="toggle_data('cont_type_en',this)" type="radio" <?php echo $cont_type_en_board;?>> 게시판</label>
				<label><input name="cont_type_en" value="member" onclick="toggle_data('cont_type_en',this)" type="radio" <?php echo $cont_type_en_member;?>> 회원서비스</label>
			</td>
		</tr>
		<tr class="tr-cont-img" style="display:<?php echo $tr_cont_img;?>;">
			<th><p>콘텐츠 이미지</p></th>
			<td>
				<input type="file" class="rt_input_txt rt_w250" value="" name="cont_img" />
				<?php if ($_r['cont_img']) {?>
				<p class="rt_fln">
					<label><input type="checkbox" name="cont_img_del_is" id="cont_img_del_is" value="y" /><span class="rt_txt rt_green"> 체크 시 첨부파일 삭제</span></label>
					<p class="mb10"><img src="<?php echo $_app['app_path'];?>/upload/<?php echo $_r['cont_img'];?>" style="max-width:550px;" /></p>
				</p>
				<?php } ?>
			</td>
		</tr>
		<tr class="tr-cont-html" style="display:<?php echo $tr_cont_html;?>;">
			<th><p>콘텐츠 내용</p></th>
			<td>
				<textarea name="cont_html" style="height:300px;"><?php echo rt_dbstr_decode($_r['cont_html'],"html");?></textarea>
			</td>
		</tr>
		<tr class="tr-cont-board" style="display:<?php echo $tr_cont_board;?>;">
			<th><p>게시판 선택</p></th>
			<td>
				<select name="board_code">
					<option value="">게시판을 선택해 주세요</option>
					<?php
					for ($m = 0; $m < count($_bl); $m++) {
						?>
						<option value="<?php echo $_bl[$m]['bcode'];?>" <?php echo ($_bl[$m]['bcode'] == $_r['board_code'])?"selected":"";?>>[<?php echo $_bl[$m]['grp_name'];?>] <?php echo $_bl[$m]['name'];?></option>
						<?
					} ?>
				</select>
			</td>
		</tr>
		<tr class="tr-cont-member" style="display:<?php echo $tr_cont_member;?>;">
			<th><p>회원 서비스 선택</p></th>
			<td>
				<select name="member_code">
					<option value="">회원모듈을 선택해 주세요</option>
					<option value="join" <?php echo ($_r['member_code'] == "join")?"selected":"";?>>회원가입</option>
					<option value="login" <?php echo ($_r['member_code'] == "login")?"selected":"";?>>로그인</option>
					<option value="mypage" <?php echo ($_r['member_code'] == "mypage")?"selected":"";?>>마이페이지</option>
					<option value="find" <?php echo ($_r['member_code'] == "find")?"selected":"";?>>계정찾기</option>
				</select>
			</td>
		</tr>
	</tbody>
</table>
</form>
<div class="rt_button_wrap rt_tar mb20">
	<a href="javascript:page_form_submit('dataform1','');" class="rt_bg_blue">정보 수정</a>
</div>

<form name="dataform2" action="<?php echo RTW_ADM;?>/page/sitemap/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
<input type="hidden" name="mode" value="content_m">
<input type="hidden" name="code" value="<?php echo $env->_post['code'];?>">
<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>모바일 페이지</h1>
</div>
<table class="rt_data_table">
	<caption>모바일 페이지 레이아웃 정보</caption>
	<colgroup>
		<col style="width:20%"/>
		<col style="width:80%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>스킨 디렉토리 경로</p></th>
			<td>
				<p><?php echo $_app['app_path'];?>/layout/</p>
			</td>
		</tr>
		<tr>
			<th><p>레이아웃 상단 스킨</p></th>
			<td>
				<select name="layout_skin_head_m">
					<option value="">레이아웃 파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $_r['layout_skin_head_m'])?"selected":"";?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<th><p>레이아웃 하단 스킨</p></th>
			<td>
				<select name="layout_skin_footer_m">
					<option value="">레이아웃 파일을 선택해 주세요</option>
					<?php foreach ($tpl_files as $k => $v) {?>
					<option value="<?php echo $v;?>" <?php echo ($v == $_r['layout_skin_footer_m'])?"selected":"";?>><?php echo $v;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<th><p>콘텐츠 타입</p></th>
			<td>
				<label><input name="cont_type_m_en" value="img" onclick="toggle_data('cont_type_m_en',this)" type="radio" <?php echo $cont_type_m_en_img;?>><span> 이미지</span> </label>
				<label><input name="cont_type_m_en" value="html" onclick="toggle_data('cont_type_m_en',this)" type="radio" <?php echo $cont_type_m_en_html;?>><span> HTML</span> </label>
				<label><input name="cont_type_m_en" value="board" onclick="toggle_data('cont_type_m_en',this)" type="radio" <?php echo $cont_type_m_en_board;?>><span> 게시판</span> </label>
				<label><input name="cont_type_m_en" value="member" onclick="toggle_data('cont_type_m_en',this)" type="radio" <?php echo $cont_type_m_en_member;?>><span> 회원서비스</span> </label>
			</td>
		</tr>
		<tr class="tr-cont-img-m" style="display:<?php echo $tr_cont_img_m;?>;">
			<th><p>콘텐츠 이미지</p></th>
			<td>
				<input type="file" class="rt_input_txt rt_w250" value="" name="cont_img_m" />
				<?php if ($_r['cont_img_m']) {?>
				<p class="rt_fln">
					<label><input type="checkbox" name="cont_img_m_del_is" id="cont_img_m_del_is" value="y" /><span class="rt_txt rt_green"> 체크 시 첨부파일 삭제</span></label>
					<p class="mb10"><img src="<?php echo $_app['app_path'];?>/upload/<?php echo $_r['cont_img_m'];?>" style="max-width:550px;" /></p>
				</p>
				<?php } ?>
			</td>
		</tr>
		<tr class="tr-cont-html-m" style="display:<?php echo $tr_cont_html_m;?>;">
			<th><p>콘텐츠 내용</p></th>
			<td>
				<textarea name="cont_html_m" style="height:300px;"><?php echo rt_dbstr_decode($_r['cont_html_m'],"html");?></textarea>
			</td>
		</tr>
		<tr class="tr-cont-board-m" style="display:<?php echo $tr_cont_board_m;?>;">
			<th><p>게시판 선택</p></th>
			<td>
				<select name="board_code_m">
					<option value="">게시판을 선택해 주세요</option>
					<?php
					for ($m = 0; $m < count($_bl); $m++) {
						?>
						<option value="<?php echo $_bl[$m]['bcode'];?>" <?php echo ($_bl[$m]['bcode'] == $_r['board_code_m'])?"selected":"";?>>[<?php echo $_bl[$m]['grp_name'];?>] <?php echo $_bl[$m]['name'];?></option>
						<?
					} ?>
				</select>
			</td>
		</tr>
		<tr class="tr-cont-member-m" style="display:<?php echo $tr_cont_member_m;?>;">
			<th><p>회원 서비스 선택</p></th>
			<td>
				<select name="member_code_m">
					<option value="">회원모듈을 선택해 주세요</option>
					<option value="join" <?php echo ($_r['member_code_m'] == "join")?"selected":"";?>>회원가입</option>
					<option value="login" <?php echo ($_r['member_code_m'] == "login")?"selected":"";?>>로그인</option>
					<option value="mypage" <?php echo ($_r['member_code_m'] == "mypage")?"selected":"";?>>마이페이지</option>
					<option value="find" <?php echo ($_r['member_code_m'] == "find")?"selected":"";?>>계정찾기</option>
				</select>
			</td>
		</tr>
	</tbody>
</table>
</form>
<div class="rt_button_wrap rt_tar mb20">
	<a href="javascript:page_form_submit('dataform2','');" class="rt_bg_blue">정보 수정</a>
</div>

<div class="rt_bot_box rt_dash_top">
	<h1>이용안내</h1>
	<p><em>-</em>레이아웃 스킨은 FTP에서 다운로드하여 수정 활용하거나 새 스킨으로 만들어서 적용할 수 있습니다. </p>
	<p><em>-</em><span class="rt_mint">HTML</span>콘텐츠 내용에 <span class="rt_mint">링크 적용 소스</span>는 적용되지 않습니다. 직접 URL을 입력해 주세요.</p>
</div>

<br />
