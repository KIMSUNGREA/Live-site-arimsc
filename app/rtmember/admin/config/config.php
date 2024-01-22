<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<form name="dataform" action="<?=$_def['path_app']."/".$__sd?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="<?=$__cfg['mode']?>">
<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>솔루션 공통소스</h1>
</div>
<table class="rt_field_table mb10">
	<caption>연동 설정</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tr>
		<th><p>솔루션 공통소스</p></th>
		<td>
			<span class="rt_txt">
				&lt;?php<br />
				require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";<br />
				require_once RT_ROOT."/engine.php";<br /><br />
				//페이지 환경설정<br />
				require_once RT_DOC_ROOT.$_rt_page['app_path']."/page_conf.php";<br />
				?>
			</span><br />
		</td>
	</tr>
</table>

<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>회원가입 모듈 연동소스</h1>
</div>
<table class="rt_field_table mb10">
	<caption>회원가입 모듈 연동소스</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tr>
		<th><p>PC 연동소스</p></th>
		<td>
			<span class="rt_txt rt_brown">&lt;?php rt_app("rtmember","display",array("join"));?></span><br />
		</td>
		<th><p>모바일 연동소스</p></th>
		<td>
			<span class="rt_txt rt_brown">&lt;?php rt_app("rtmember","display",array("join","mobile"));?></span><br />
		</td>
	</tr>
	<tr>
		<th><p>PC 설치 페이지</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo $r['join_set_page'];?>" name="join_set_page" /></td>
		<th><p>모바일 설치 페이지</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo $r['join_set_mobile_page'];?>" name="join_set_mobile_page" /></td>
	</tr>
</table>

<div class="rt_s_tit clearfix">
	<p>03<span></span></p>
	<h1>로그인 모듈 연동소스</h1>
</div>
<table class="rt_field_table mb10">
	<caption>로그인 모듈 연동소스</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tr>
		<th><p>PC 연동소스</p></th>
		<td>
			<span class="rt_txt rt_brown">&lt;?php rt_app("rtmember","display",array("login"));?></span><br />
		</td>
		<th><p>모바일 연동소스</p></th>
		<td>
			<span class="rt_txt rt_brown">&lt;?php rt_app("rtmember","display",array("login","mobile"));?></span><br />
		</td>
	</tr>
	<tr>
		<th><p>PC 설치 페이지</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo $r['login_set_page'];?>" name="login_set_page" /></td>
		<th><p>모바일 설치 페이지</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo $r['login_set_mobile_page'];?>" name="login_set_mobile_page" /></td>
	</tr>
</table>

<div class="rt_s_tit clearfix">
	<p>04<span></span></p>
	<h1>마이페이지 모듈 연동소스</h1>
</div>
<table class="rt_field_table mb10">
	<caption>마이페이지 모듈 연동소스</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tr>
		<th><p>PC 연동소스</p></th>
		<td>
			<span class="rt_txt rt_brown">&lt;?php rt_app("rtmember","display",array("mypage"));?></span><br />
		</td>
		<th><p>모바일 연동소스</p></th>
		<td>
			<span class="rt_txt rt_brown">&lt;?php rt_app("rtmember","display",array("mypage","mobile"));?></span><br />
		</td>
	</tr>
	<tr>
		<th><p>PC 설치 페이지</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo $r['mypage_set_page'];?>" name="mypage_set_page" /></td>
		<th><p>모바일 설치 페이지</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo $r['mypage_set_mobile_page'];?>" name="mypage_set_mobile_page" /></td>
	</tr>
</table>

<div class="rt_s_tit clearfix">
	<p>05<span></span></p>
	<h1>계정찾기 모듈 연동소스</h1>
</div>
<table class="rt_field_table mb10">
	<caption>계정찾기 모듈 연동소스</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tr>
		<th><p>PC 연동소스</p></th>
		<td>
			<span class="rt_txt rt_brown">&lt;?php rt_app("rtmember","display",array("find"));?></span><br />
		</td>
		<th><p>모바일 연동소스</p></th>
		<td>
			<span class="rt_txt rt_brown">&lt;?php rt_app("rtmember","display",array("find","mobile"));?></span><br />
		</td>
	</tr>
	<tr>
		<th><p>PC 설치 페이지</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo $r['find_set_page'];?>" name="find_set_page" /></td>
		<th><p>모바일 설치 페이지</p></th>
		<td><input type="text" class="rt_input_txt" value="<?php echo $r['find_set_mobile_page'];?>" name="find_set_mobile_page" /></td>
	</tr>
</table>
</form>

<div class="rt_button_wrap rt_tar">
	<a href="#;" id="btn-form-submit" class="rt_btn_blue">설정 변경</a>
</div>

<script src="<?php echo $_def['path_assets'];?>/js/rtmember.admin.login.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>