<?php /* Template_ 2.2.8 2023/10/25 13:39:01 /www_root/app/rtmember/template/rtmember.modify.html 000007035 */ 
$TPL_메일리스트_1=empty($TPL_VAR["메일리스트"])||!is_array($TPL_VAR["메일리스트"])?0:count($TPL_VAR["메일리스트"]);
$TPL_추가필드_1=empty($TPL_VAR["추가필드"])||!is_array($TPL_VAR["추가필드"])?0:count($TPL_VAR["추가필드"]);?>
<!-- 반응형 회원 시작 -->
<div class="rt-rwd-member-wrap">
	<!-- 폼 시작 -->
	<div class="rt-rwd-join-form-wrap">
		<!-- 폼 필드 시작 -->
		<form name="modify_form" action="<?php echo $TPL_VAR["ssl"]?><?php echo $TPL_VAR["path_user"]?>/update.php" method="post" target="rt_ifrm">
			<input type="hidden" name="mode" value="modify" />
			<input type="hidden" name="path_user" value="<?php echo $TPL_VAR["path_user"]?>" />
			<input type="hidden" name="php_self" value="<?php echo $TPL_VAR["php_self"]?>" />
			<input type="hidden" name="pcd" value="<?php echo $TPL_VAR["페이지코드"]?>" />
			<input type="hidden" name="screen" value="<?php echo $TPL_VAR["이동화면"]?>" />
			<input type="hidden" name="mgroup" value="<?php echo $TPL_VAR["회원"]["회원등급"]?>" />
			<h1 class="rt-rwd-join-form-agree-title rt-rwd-join-form-agree-title-bdn clearfix"><span class="rt-rwd-join-flr"><span class="rt-rwd-star">*</span> 필수입력사항</span></h1>
			<div class="rt-rwd-join-form-area">
<?php if($TPL_VAR["회원"]["회원등급"]=='1'){?>
				<div class="rt-rwd-join-form-con">
					<div class="rt-rwd-join-form-title">
						<h1>아이디 <span class="rt-rwd-star">* </span></h1>
					</div>
					<div class="rt-rwd-join-form-box-wrap clearfix">
						<div class="rt-rwd-join-form-box rt-310px-box rt-rwd-768-full-box">
							<p><?php echo $TPL_VAR["회원"]["아이디"]?></p>
						</div>
					</div>
				</div>
				<div class="rt-rwd-join-form-con">
					<div class="rt-rwd-join-form-title">
						<h1>비밀번호 <span class="rt-rwd-star">* </span></h1>
					</div>
					<div class="rt-rwd-join-form-box-wrap clearfix">
						<div class="rt-rwd-join-form-box rt-310px-box rt-rwd-768-full-box">
							<input type="password" value="" name="user_pw" />
						</div>
					</div>
				</div>
				<div class="rt-rwd-join-form-con">
					<div class="rt-rwd-join-form-title">
						<h1>비밀번호 확인 <span class="rt-rwd-star">* </span></h1>
					</div>
					<div class="rt-rwd-join-form-box-wrap clearfix">
						<div class="rt-rwd-join-form-box rt-310px-box rt-rwd-768-full-box">
							<input type="password" value="" name="user_pw_re" />
						</div>
						<div class="rt-rwd-join-form-box">
							<p><span class="rt-rwd-star">*</span> 비밀번호를 입력시 변경됩니다.</p>
						</div>
					</div>
				</div>
<?php }else{?>
				<div class="rt-rwd-join-form-con">
					<div class="rt-rwd-join-form-title">
						<h1>회원 구분</h1>
					</div>
					<div class="rt-rwd-join-form-box-wrap clearfix">
						<div class="rt-rwd-join-form-box rt-310px-box rt-rwd-768-full-box">
							SNS
						</div>
					</div>
				</div>
<?php }?>
				<div class="rt-rwd-join-form-con">
					<div class="rt-rwd-join-form-title">
						<h1>이름 <span class="rt-rwd-star">* </span></h1>
					</div>
					<div class="rt-rwd-join-form-box-wrap clearfix">
						<div class="rt-rwd-join-form-box rt-310px-box rt-rwd-768-full-box">
							<input type="text" class="required" value="<?php echo $TPL_VAR["회원"]["이름"]?>" name="user_nm" msg="이름을 정확히 입력해 주세요" />
						</div>
					</div>
				</div>
<?php if($TPL_VAR["회원"]["회원등급"]=='2'){?>
				<div class="rt-rwd-join-form-con">
					<div class="rt-rwd-join-form-title">
						<h1>이메일 <span class="rt-rwd-star">* </span></h1>
					</div>
					<div class="rt-rwd-join-form-box-wrap clearfix">
						<div class="rt-rwd-join-form-box rt-32-box">
							<input type="text" name="email_id" class="required" id="email_id" msg="메일을 정확히 입력해 주세요" value="<?php echo $TPL_VAR["회원"]["이메일아이디"]?>"/>
						</div>
						<div class="rt-rwd-join-form-box rt-4-box">
							<p class="rt-join-form-tac">@</p>
						</div>
						<div class="rt-rwd-join-form-box rt-32-box">
							<input type="text" id="email_domain" class="required" name="email_domain" msg="메일을 정확히 입력해 주세요" value="<?php echo $TPL_VAR["회원"]["이메일도메인"]?>"/>
						</div>
						<div class="rt-rwd-join-form-box rt-32-box">
							<select onchange="$('#email_domain').val($(this).val());">
								<option value="">직접입력</option>
<?php if($TPL_메일리스트_1){foreach($TPL_VAR["메일리스트"] as $TPL_V1){?>
								<option value="<?php echo $TPL_V1["도메인"]?>"><?php echo $TPL_V1["도메인"]?></option>
<?php }}?>
							</select>
						</div>
					</div>
				</div>
<?php }?>
				<div class="rt-rwd-join-form-con">
					<div class="rt-rwd-join-form-title">
						<h1>메일링 동의</h1>
					</div>
					<div class="rt-rwd-join-form-box-wrap clearfix">
						<div class="rt-rwd-join-form-box rt-full-box">
							<p>
								<label><input type="radio" value="y" name="email_en" <?php if($TPL_VAR["회원"]["메일수신"]=='y'){?>checked="checked"<?php }?> /> <span>예</span></label>
								<label><input type="radio" value="n" name="email_en" <?php if($TPL_VAR["회원"]["메일수신"]=='n'){?>checked="checked"<?php }?> /> <span>아니오</span></label>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- 폼 필드 끝 -->
			<!-- 추가 필드 시작 -->
<?php if($TPL_VAR["추가필드여부"]=='y'){?>
			<h1 class="rt-rwd-join-form-agree-title rt-rwd-join-form-agree-title-bdn">추가정보</h1>
			<div class="rt-rwd-join-form-area">
<?php if($TPL_추가필드_1){foreach($TPL_VAR["추가필드"] as $TPL_V1){?>
				<div class="rt-rwd-join-form-con">
					<div class="rt-rwd-join-form-title">
						<h1><?php echo $TPL_V1["필드명"]?></h1>
					</div>
					<div class="rt-rwd-join-form-box-wrap rt-full-box clearfix">
						<div class="rt-rwd-join-form-box rt-310px-box rt-rwd-768-full-box">
							<?php echo $TPL_V1["데이터"]?>

						</div>
					</div>
				</div>
<?php }}?>
			</div>
<?php }?>
			<!-- 추가 필드 끝 -->
		</form>
		<!-- 폼 필드 끝 -->
	</div>
	<!-- 폼 끝 -->
	<!-- 버튼 시작 -->
	<div class="rt-button rt-button-tac">
		<a href="#;" id="btn-form-submit">회원 정보 수정</a>
		<a href="<?php echo $TPL_VAR["page_mypage"]?>">돌아가기</a>
	</div>
	<!-- 버튼 끝 -->
</div>
<!-- 반응형 회원 끝 -->

<script src="<?php echo $TPL_VAR["path_assets"]?>/js/rtmember.modify.js?ver=<?php echo $TPL_VAR["캐시버전"]?>" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $TPL_VAR["path_assets"]?>/css/rt_member.css?ver=<?php echo $TPL_VAR["캐시버전"]?>" />
<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>