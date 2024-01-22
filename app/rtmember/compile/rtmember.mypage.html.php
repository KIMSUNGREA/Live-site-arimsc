<?php /* Template_ 2.2.8 2023/10/25 13:39:01 /www_root/app/rtmember/template/rtmember.mypage.html 000003337 */ 
$TPL_추가필드_1=empty($TPL_VAR["추가필드"])||!is_array($TPL_VAR["추가필드"])?0:count($TPL_VAR["추가필드"]);?>
<!-- 반응형 회원 시작 -->
<div class="rt-rwd-member-wrap">
	<!-- 마이페이지 시작 -->
	<div class="rt-rwd-mypage-wrap">
		<!-- 마이페이지 필드 시작 -->
<?php if($TPL_VAR["회원"]["아이디"]){?>
		<div class="rt-rwd-mypage-area">
<?php if($TPL_VAR["회원"]["회원등급"]=='1'){?>
			<div class="rt-rwd-mypage-con">
				<div class="rt-rwd-mypage-title">
					<h1>아이디</h1>
				</div>
				<div class="rt-rwd-mypage-box-wrap clearfix">
					<div class="rt-rwd-mypage-box rt-full-box">
						<p><?php echo $TPL_VAR["회원"]["아이디"]?></p>
					</div>
				</div>
			</div>
<?php }else{?>
			<div class="rt-rwd-mypage-con">
				<div class="rt-rwd-mypage-title">
					<h1>회원구분</h1>
				</div>
				<div class="rt-rwd-mypage-box-wrap clearfix">
					<div class="rt-rwd-mypage-box rt-full-box">
						<p>SNS</p>
					</div>
				</div>
			</div>
<?php }?>
			<div class="rt-rwd-mypage-con">
				<div class="rt-rwd-mypage-title">
					<h1>이름</h1>
				</div>
				<div class="rt-rwd-mypage-box-wrap clearfix">
					<div class="rt-rwd-mypage-box rt-full-box">
						<p><?php echo $TPL_VAR["회원"]["이름"]?></p>
					</div>
				</div>
			</div>
			<div class="rt-rwd-mypage-con">
				<div class="rt-rwd-mypage-title">
					<h1>이메일</h1>
				</div>
				<div class="rt-rwd-mypage-box-wrap clearfix">
					<div class="rt-rwd-mypage-box rt-full-box">
						<p><?php echo $TPL_VAR["회원"]["이메일"]?></p>
					</div>
				</div>
			</div>
			<div class="rt-rwd-mypage-con">
				<div class="rt-rwd-mypage-title">
					<h1>메일링 동의</h1>
				</div>
				<div class="rt-rwd-mypage-box-wrap clearfix">
					<div class="rt-rwd-mypage-box rt-full-box">
						<p><?php echo $TPL_VAR["회원"]["메일수신"]?></p>
					</div>
				</div>
			</div>
		</div>
<?php }?>
		<!-- 마이페이지 필드 끝 -->
		<!-- 추가필드 시작 -->
<?php if($TPL_VAR["추가필드여부"]=='y'){?>
		<div class="rt-rwd-mypage-area">
<?php if($TPL_추가필드_1){foreach($TPL_VAR["추가필드"] as $TPL_V1){?>
			<div class="rt-rwd-mypage-con">
				<div class="rt-rwd-mypage-title">
					<h1><?php echo $TPL_V1["필드명"]?></h1>
				</div>
				<div class="rt-rwd-mypage-box-wrap clearfix">
					<div class="rt-rwd-mypage-box rt-full-box">
						<p><?php echo $TPL_V1["데이터"]?></p>
					</div>
				</div>
			</div>
<?php }}?>
		</div>
<?php }?>
		<!-- 추가필드 끝 -->
	</div>
	<!-- 마이페이지 끝 -->
	<!-- 버튼 시작 -->
	<div class="rt-button rt-button-tac">
		<a href="<?php echo $TPL_VAR["page_modify"]?>">회원 정보 수정</a>
		<a href="<?php echo $TPL_VAR["page_withdraw"]?>">회원 탈퇴</a>
	</div>
	<!-- 버튼 끝 -->
</div>
<!-- 반응형 회원 끝 -->

<script src="<?php echo $TPL_VAR["path_assets"]?>/js/rtmember.mypage.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $TPL_VAR["path_assets"]?>/css/rt_member.css" />
<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>