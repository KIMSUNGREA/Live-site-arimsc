<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>기본 정보</h1>
</div>

<form name="dataform" action="<?php echo $__sc?>/update.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="<?php echo $__cfg['mode'];?>">
<input type="hidden" name="seq" value="<?php echo $env->_get['seq'];?>">
<input type="hidden" name="sd" value="<?php echo $env->_get['sd'];?>">
<input type="hidden" name="search" value="<?php echo $env->_get['search'];?>">
<input type="hidden" name="searchstring" value="<?php echo $env->_get['searchstring'];?>">
<input type="hidden" name="pg" value="<?php echo $env->_get['pg'];?>">
<input type="hidden" name="buy_en" value="<?php echo $env->_get['buy_en'];?>">
<table class="rt_field_table mb10">
	<caption>회원수기입력</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:35%"/>
		<col style="width:15%"/>
		<col style="width:35%"/>
	</colgroup>
	<tr>
		<th><p>아이디</p></th>
		<td><?php echo $_r['user_id'];?></td>
		<th><p>이름</p></th>
		<td><?php echo $_r['user_nm'];?></td>
	</tr>
	<tr>
		<th><p>이메일</p></th>
		<td><?php echo $_r['email'];?></td>
		<th><p>전화번호</p></th>
		<td><?php echo $_r['phone'];?></td>
	</tr>
	<tr>
		<th><p>메일링</p></th>
		<td><?php echo ($_r['email_en']=="y")?"동의함":"동의안함"?></td>
		<th><p>SMS수신</p></th>
		<td><?php echo ($_r['sms_en']=="y")?"동의함":"동의안함"?></td>
	</tr>
	<tr>
		<th><p>회원분류</p></th>
		<td><?php echo $grp_cfg[$_r['mgroup']];?></td>
		<th><p>추천인코드</p></th>
		<td><?php echo $_r['recode'];?></td>
	</tr>
	<tr>
		<th>휴면여부</th>
		<td><?php echo ($_r['rest_en']=="y")?"<font color='#ff0000'>휴면회원</font>":"<font color='#0000ff'>활동회원</font>"?></td>
		<th>휴면 처리일</th>
		<td><?php echo $_r['rest_date'];?></td>
	</tr>
	<tr>
		<th>로그인차단</th>
		<td><?php echo ($_r['blockout_en']=="y")?"<font color='#ff0000'>접속차단</font>":"<font color='#0000ff'>접속허용</font>"?></td>
		<th>로그인 차단일</th>
		<td><?php echo $_r['blockout_date'];?></td>
	</tr>
	<tr>
		<th>탈퇴여부</th>
		<td><?php echo ($_r['withdraw_en']=="y")?"<font color='#ff0000'>탈퇴회원</font>":"<font color='#0000ff'>활동회원</font>"?></td>
		<th>탈퇴 처리일</th>
		<td><?php echo $_r['withdraw_date'];?></td>
	</tr>
	<tr>
		<th>가입일</th>
		<td><?php echo $_r['reg_date'];?></td>
		<th>수정일</th>
		<td><?php echo $_r['mod_date'];?></td>
	</tr>
</table>

<?php if (count($_fset) > 0) { ?>
<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>추가 정보</h1>
</div>

<table class="rt_field_table mb10">
<caption>회원 추가정보</caption>
<colgroup>
	<col width="15%" />
	<col width="" />
</colgroup>
<tbody>
<tr>
	<th colspan="4">추가 정보</th>
</tr>
<?php for ($m = 0; $m < count($_fset); $m++) { ?>
<tr>
	<th style="min-width:100px;"><?php echo $_fset[$m]['name'];?></th>
	<td><?php echo $cls_mem->formset_data($_fset[$m], $sz)?></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
</form>

<div class="rt_button_wrap rt_tar">
	<a href="javascript:member_delete(<?php echo $env->_get['seq'];?>,'');" class="rt_btn_red">회원 삭제</a>
	<a href="#;" id="btn-move-modify" class="rt_btn_blue">정보 수정</a>
	<a href="#;" id="btn-move-list" class="rt_btn_gray">목록 가기</a>
</div>

<script src="<?php echo $_def['path_assets'];?>/js/rtmember.admin.data.js?ver=001" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>