<?php /* Template_ 2.2.7 2017/03/11 00:47:03 /home/rintkit.com/new/app/rtboard/template/norm.layout.reponsive.reply.html 000009730 */ 
$TPL_추가필드_1=empty($TPL_VAR["추가필드"])||!is_array($TPL_VAR["추가필드"])?0:count($TPL_VAR["추가필드"]);
$TPL_첨부파일_1=empty($TPL_VAR["첨부파일"])||!is_array($TPL_VAR["첨부파일"])?0:count($TPL_VAR["첨부파일"]);?>
<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.');}?>
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
		<input type="hidden" name="ref" value="<?php echo $TPL_VAR["포스트"]["ref"]?>">
		<input type="hidden" name="re_step" value="<?php echo $TPL_VAR["포스트"]["re_step"]?>">
		<input type="hidden" name="re_level" value="<?php echo $TPL_VAR["포스트"]["re_level"]?>">
		<input type="hidden" name="category" value="<?php echo $TPL_VAR["포스트"]["분류"]?>">
		<input type="hidden" name="webeditor_is" value="<?php echo $TPL_VAR["웹에디터사용"]?>">
		<div class="rt-rwd-form-area">

			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1>원글 제목</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<?php echo $TPL_VAR["포스트"]["제목"]?>

					</div>
				</div>
			</div>

			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1><span class="rt-rwd-star">*</span> 이름</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<input type="text" name="name" class="required" msg="이름을 정확히 입력해 주세요" style="width:200px;"/>
					</div>
				</div>
			</div>

<?php if(!$TPL_VAR["로그인여부"]){?>
<?php if($TPL_VAR["mode"]=='insert'){?>
			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1><span class="rt-rwd-star">*</span> 비밀번호</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<input type="password" name="post_pw" class="required" msg="비밀번호를 정확히 입력해 주세요" style="width:200px;"/>
					</div>
				</div>
			</div>
<?php }else{?>
			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1>비밀번호</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<input type="password" name="post_pw" style="width:200px;" /> * 입력 시 비밀번호가 변경됩니다.
					</div>
				</div>
			</div>
<?php }?>
<?php }?>

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
					<h1><span class="rt-rwd-star">*</span> 제목</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<input type="text" name="subject"  class="required" msg="제목을 정확히 입력해 주세요" />
					</div>
				</div>
			</div>

			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1><span class="rt-rwd-star">*</span> 내용</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<textarea name="content" id="content" style="<?php if($TPL_VAR["웹에디터사용"]=='y'){?>display:none;<?php }?>"></textarea>
					</div>
				</div>
			</div>

<?php if($TPL_VAR["목록이미지사용"]=='y'){?>
			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1>대표(목록) 이미지</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<p><input type="file" class="" value="" name="list_img" /></p>
					</div>
				</div>
			</div>
			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1>대표 이미지 설정</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<label><input type="radio" name="list_img_cont_is" value="n" checked="checked"> <span class="rt_txt">목록 이미지로만 사용</span></label>
						<label><input type="radio" name="list_img_cont_is" value="y"> <span class="rt_txt">본문 상단에 출력</span></label>
					</div>
				</div>
			</div>
<?php }?>

<?php if($TPL_첨부파일_1){foreach($TPL_VAR["첨부파일"] as $TPL_V1){?>
			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1>첨부파일</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<input type="file" class="" value="" name="file<?php echo $TPL_V1["파일번호"]?>" />
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
		<!-- 약관 시작 -->
<?php if($TPL_VAR["약관여부"]=='y'){?>
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
		<!-- 약관 끝 -->
	</div>
	<!-- 폼 끝 -->
	<!-- 버튼 시작 -->
	<div class="rt-button rt-button-tac">
		<a href="#;" style="cursor: pointer;"  id="btn-list">목록으로</a>
		<a href="#;" style="cursor: pointer;" id="btn-form-submit">답글 작성</a>
	</div>
	<!-- 버튼 끝 -->
</div>
<!-- 반응형 게시판 끝 -->

<form name="conf_form">
	<input type="hidden" name="login_is" value="<?php echo $TPL_VAR["로그인여부"]?>">
	<input type="hidden" name="webeditor_is" value="<?php echo $TPL_VAR["웹에디터사용"]?>">
	<input type="hidden" name="assent_term_is" value="<?php echo $TPL_VAR["약관여부"]?>">
</form>
<?php if($TPL_VAR["웹에디터사용"]=='y'){?>
<script src="<?php echo RTW_PLUGIN;?>/SE2.8.2.O12056/js/HuskyEZCreator.js" type="text/javascript"></script>
<script src="<?php echo RTW_ASSETS;?>/js/se2.editor.js" type="text/javascript"></script>
<?php }?>
<script type="text/javascript">
<?php if($TPL_VAR["웹에디터사용"]=='y'){?>
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "content",
	sSkinURI: "<?php echo RTW_PLUGIN;?>/SE2.8.2.O12056/SmartEditor2Skin.html",
	htParams : {
		bUseToolbar : true,			//툴바
		bUseVerticalResizer : true,	//입력창 크기 조절바
		bUseModeChanger : true		//모드 탭
	},
	fOnAppLoad : function(){
		oEditors.getById["content"].setDefaultFont("나눔고딕", "10");
	}
});
<?php }?>

;(function($) {
	$(function() {
		rt_get_capcha();
	});
})(jQuery);
</script>


<!-- PC CSS //-->
<link href="<?php echo $TPL_VAR["path_css"]?>/rtboard.norm.responsive.css" type="text/css" rel="stylesheet"/>

<script src="<?php echo $TPL_VAR["path_theme"]?>/user/js/rtboard.theme.norm.user.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>