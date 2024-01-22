<?php /* Template_ 2.2.7 2016/07/14 10:39:04 /home/rintkit.com/dev/app/rtmember/template/mobile.rtmember.mypage.html 000004350 */ 
$TPL_추가필드_1=empty($TPL_VAR["추가필드"])||!is_array($TPL_VAR["추가필드"])?0:count($TPL_VAR["추가필드"]);?>
<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.');}?>
<div class="rt-member-wrap">
	<div class="rt-member-container">
		<h1 class="rt-info-required">마이페이지</h1>
		<!-- <form name="mypage_form" action="<?php echo $TPL_VAR["path_user"]?>/update.php" method="post" target="rt_ifrm">
		<input type="hidden" name="mode" value="insert">
		<input type="hidden" name="path_user" value="<?php echo $TPL_VAR["path_user"]?>">
		<input type="hidden" name="php_self" value="<?php echo $TPL_VAR["php_self"]?>"> -->
		<table class="rt-mypage">
			<colgroup>
				<col width="30%"/>
				<col width="*"/>
			</colgroup>
			<tbody>
				<tr>
					<th>연동 SNS</th>
					<td>
					<a href="#;" class="rt-sns-show"><?php echo $TPL_VAR["회원"]["홈페이지로그인"]?></a>&nbsp;
<?php if($TPL_VAR["회원"]["네이버아이디"]==""){?><a href="#;" id="" onclick="sns_login('<?php echo $TPL_VAR["회원"]["네이버아이디로그인"]?>');"><?php }?><?php echo $TPL_VAR["회원"]["네이버로그인"]?></a>&nbsp;
<?php if($TPL_VAR["회원"]["카카오아이디"]==""){?><a href="#;" id="" onclick="sns_login('<?php echo $TPL_VAR["회원"]["카카오아이디로그인"]?>');"><?php }?><?php echo $TPL_VAR["회원"]["카카오로그인"]?></a>&nbsp;
<?php if($TPL_VAR["회원"]["페이스북아이디"]==""){?><a href="#;" id="" onclick="sns_login('<?php echo $TPL_VAR["회원"]["페이스북아이디로그인"]?>');"><?php }?><?php echo $TPL_VAR["회원"]["페이스북로그인"]?></a>
					</td>
				</tr>
<?php if($TPL_VAR["회원"]["SNS회원"]=="n"){?>
				<tr>
					<th>아이디</th>
					<td><?php echo $TPL_VAR["회원"]["아이디"]?></td>
				</tr>
<?php }?>
				<tr>
					<th>이름</th>
					<td><?php echo $TPL_VAR["회원"]["이름"]?></td>
				</tr>
				<tr>
					<th>이메일</th>
					<td><?php echo $TPL_VAR["회원"]["이메일"]?></td>
				</tr>
				<tr>
					<th>메일링 동의</th>
					<td><?php echo $TPL_VAR["회원"]["메일수신"]?></td>
				</tr>
				<tr>
					<th>연락처</th>
					<td><?php echo $TPL_VAR["회원"]["전화번호"]?></td>
				</tr>
				<tr class="rt-tr-last">
					<th>SMS 수신동의</th>
					<td><?php echo $TPL_VAR["회원"]["SMS수신"]?></td>
				</tr>
			</tbody>
		</table>

<?php if($TPL_VAR["추가필드여부"]=='y'){?>
		<h1 class="rt-info-required">추가정보</h1>
		<table class="rt-mypage">
			<colgroup>
				<col width="30%"/>
				<col width="*"/>
			</colgroup>
			<tbody>
<?php if($TPL_추가필드_1){foreach($TPL_VAR["추가필드"] as $TPL_V1){?>
				<tr>
					<th><?php echo $TPL_V1["필드명"]?></th>
					<td><?php echo $TPL_V1["데이터"]?></td>
				</tr>
<?php }}?>
			</tbody>
		</table>
<?php }?>

		<div class="rt-button-wrap">
			<a href="?cf=modify" class="rt-join-button">회원 정보 수정</a>
			<a href="?cf=withdraw" class="rt-join-button rt-find-button">회원 탈퇴</a>
		</div>
	</div>
</div>

<div id="rt-sns-login-wrap">
	<div class="rt-op-box"></div>
	<form name="dataform" method="post" action="/app/rtmember/user/update.php" target="rt_ifrm">
	<input type="hidden" name="mode" value="h_login" />
	<div class="snsWrap2">
		<div class="header">
			<a href="<?php echo $TPL_VAR["page_join"]?>" class="join-button">회원가입</a>
		</div>
		<div class="formWrap">
			<div class="input-box">
				<input type="text" placeholder="아이디" name="user_id" class="required" msg="아이디를 입력해 주세요."/>
				<input type="password" placeholder="패스워드" name="user_pw" class="required" msg="비밀번호를 입력해 주세요."/>
			</div>
			<div class="login-box">
				<a href="#;" id="btn-submit">로그인</a>
			</div>
		</div>
	</div>
	</form>
</div>

<script src="<?php echo $TPL_VAR["path_assets"]?>/js/rtmember.mypage.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $TPL_VAR["path_assets"]?>/css/rt_member_mobile.css" />

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>