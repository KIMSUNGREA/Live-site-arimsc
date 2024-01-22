<?php /* Template_ 2.2.8 2023/12/07 13:32:23 /www_root/app/rtboard/template/qna.req.form.html 000007063 */ 
$TPL_추가필드_1=empty($TPL_VAR["추가필드"])||!is_array($TPL_VAR["추가필드"])?0:count($TPL_VAR["추가필드"]);
$TPL_첨부파일_1=empty($TPL_VAR["첨부파일"])||!is_array($TPL_VAR["첨부파일"])?0:count($TPL_VAR["첨부파일"]);?>
<!-- 반응형 게시판 시작 -->
<div class="rt-rwd-notice-wrap">
	<!-- 폼 시작 -->
	<div class="rt-rwd-form-wrap">
		<!-- 폼 필드 시작 -->
		<form name="data_form" action="<?php echo $TPL_VAR["acturl"]?>/user/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
		<input type="hidden" name="mode" value="<?php echo $TPL_VAR["mode"]?>">
		<input type="hidden" name="theme" value="<?php echo $TPL_VAR["테마코드"]?>">
		<input type="hidden" name="bcode" value="<?php echo $TPL_VAR["게시판코드"]?>">
		<input type="hidden" name="pcd" value="<?php echo $TPL_VAR["페이지코드"]?>">
		<input type="hidden" name="screen" value="<?php echo $TPL_VAR["이동화면"]?>">
		<input type="hidden" name="seq" value="<?php echo $TPL_VAR["포스트"]["고유키"]?>">
		<input type="hidden" name="pg" value="<?php echo $TPL_VAR["pg"]?>">
		<input type="hidden" name="ct" value="<?php echo $TPL_VAR["검색분류"]?>">
		<input type="hidden" name="search" value="<?php echo $TPL_VAR["검색키"]?>">
		<input type="hidden" name="searchstring" value="<?php echo $TPL_VAR["검색어"]?>">
		<input type="hidden" name="path_files" value="<?php echo $TPL_VAR["path_files"]?>">
		<input type="hidden" name="php_self" value="<?php echo $TPL_VAR["php_self"]?>">
		<input type="hidden" name="webeditor_is" value="<?php echo $TPL_VAR["웹에디터사용"]?>">
		<input type="hidden" name="name" value="<?php echo $TPL_VAR["회원이름"]?>">

		<div class="rt-rwd-form-area">

<?php if($TPL_추가필드_1){foreach($TPL_VAR["추가필드"] as $TPL_V1){?>
			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1><?php echo $TPL_V1["필드명"]?></h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<?php echo $TPL_V1["데이터"]?>

					</div>
				</div>
			</div>
<?php }}?>

			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1>신청가능횟수</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box" style="line-height:22px;">
						* newlab님의 사은품 신청가능횟수 총 <?php echo $TPL_VAR["신청가능횟수"]?>회<br>
						- 구매후기 사은품 <?php echo $TPL_VAR["구매후기신청횟수"]?>회<br>
						- 베스트후기 사은품 <?php echo $TPL_VAR["베스트신청횟수"]?>회<br>
						- 추천인 이벤트 <?php echo $TPL_VAR["추천인신청횟수"]?>회

					</div>
				</div>
			</div>

			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1><span class="rt-rwd-star">*</span> 제목</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<input type="text" name="subject" value="<?php echo $TPL_VAR["포스트"]["제목"]?>" class="required" msg="제목을 정확히 입력해 주세요" />
					</div>
				</div>
			</div>

			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1><span class="rt-rwd-star">*</span> 휴대폰 번호</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<input type="text" name="phone" value="<?php echo $TPL_VAR["포스트"]["휴대폰번호"]?>" class="required" msg="휴대폰번호를 정확히 입력해 주세요" style="width:200px;"/>
					</div>
				</div>
			</div>


<?php if($TPL_첨부파일_1){foreach($TPL_VAR["첨부파일"] as $TPL_V1){?>
			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1>첨부파일</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<p><input type="file" class="" value="" name="file<?php echo $TPL_V1["파일번호"]?>" /></p>
<?php if($TPL_V1["파일명"]){?>
						<p><label><input type="checkbox" value="y" name="attc_del<?php echo $TPL_V1["파일번호"]?>_is" /> 체크 시 삭제 [다운로드 : <a href="<?php echo $TPL_V1["다운로드링크"]?>" target="rt_ifrm"><?php echo $TPL_V1["파일명"]?></a>]</label></p>
<?php }?>
					</div>
				</div>
			</div>
<?php }}?>

<?php if(!$TPL_VAR["로그인여부"]){?>
<?php if($TPL_VAR["mode"]=='insert'||$TPL_VAR["mode"]=='reply'){?>
			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1>보안문자</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<p><span id="capcha_str"></span><a href="#;" class="rt-form-reflash" onclick="rt_get_capcha()">새로고침</a></p>
					</div>
				</div>
			</div>
			<div class="rt-rwd-form-con rt-rwd-non-title">
				<div class="rt-rwd-form-title">
					<h1></h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-310px-box rt-px-box">
						<input type="text" name="sec_code" placeholder="※ 보안문자를 입력해 주세요." />
					</div>
				</div>
			</div>
<?php }?>
<?php }?>
		</div>
		</form>
		<!-- 폼 필드 끝 -->

<?php if($TPL_VAR["약관여부"]=='y'&&$TPL_VAR["mode"]=='insert'){?>
		<div class="rt-rwd-form-agree-wrap">
			<h1 class="rt-rwd-form-agree-title">개인정보처리방침</h1>
			<div class="rt-rwd-form-agree-box">
				<textarea class="rt-rwd-form-agree" readonly="readonly"><?php echo $TPL_VAR["약관내용"]?></textarea>
			</div>
			<div class="rt-rwd-form-agree-label">
				<label><input type="checkbox" id="assent_term" /><span>동의합니다.</span></label>
			</div>
		</div>
<?php }?>
	</div>
	<!-- 폼 끝 -->

	<div class="rt-button rt-button-tac">
		<a href="#;" style="cursor: pointer;width:150px;"  id="btn-list">목록으로</a>
<?php if($TPL_VAR["mode"]=='insert'){?>
		<a href="#;" style="cursor: pointer;width:150px;" id="btn-form-submit" class="sec_btn">신청하기</a>
<?php }else{?>
			<a href="#;" style="cursor: pointer;" id="btn-form-submit">수정하기</a>
<?php }?>
	</div>

</div>
<!-- 반응형 게시판 끝 -->

<form name="conf_form">
	<input type="hidden" name="login_is" value="<?php echo $TPL_VAR["로그인여부"]?>">
	<input type="hidden" name="webeditor_is" value="<?php echo $TPL_VAR["웹에디터사용"]?>">
	<input type="hidden" name="assent_term_is" value="<?php echo $TPL_VAR["약관여부"]?>">
</form>

<script type="text/javascript">
;(function($) {
	$(function() {
	});
})(jQuery);
</script>


<!-- PC CSS //-->
<link href="<?php echo $TPL_VAR["path_css"]?>/rtboard.qna.responsive.css" type="text/css" rel="stylesheet"/>

<script src="<?php echo $TPL_VAR["path_theme"]?>/user/js/rtboard.theme.qna.user.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>