<?php /* Template_ 2.2.8 2023/12/04 16:43:39 /www_root/app/rtboard/template/norm.review.form.html 000011085 */ 
$TPL_제품모델_1=empty($TPL_VAR["제품모델"])||!is_array($TPL_VAR["제품모델"])?0:count($TPL_VAR["제품모델"]);
$TPL_첨부파일_1=empty($TPL_VAR["첨부파일"])||!is_array($TPL_VAR["첨부파일"])?0:count($TPL_VAR["첨부파일"]);?>
<!-- 반응형 게시판 시작 -->
<div class="rt-rwd-notice-wrap">
	<!-- 폼 시작 -->
	<div class="rt-rwd-form-wrap">
		<!-- 폼 필드 시작 -->
		<form name="data_form" action="<?php echo $TPL_VAR["acturl"]?>/user/update.php" method="post" target="rt_ifrm" enctype="multipart/form-data">
		<input type="hidden" name="mode" value="<?php echo $TPL_VAR["mode"]?>">
		<input type="hidden" name="theme" value="<?php echo $TPL_VAR["테마코드"]?>">
		<input type="hidden" name="pcd" value="<?php echo $TPL_VAR["페이지코드"]?>">
		<input type="hidden" name="screen" value="<?php echo $TPL_VAR["이동화면"]?>">
		<input type="hidden" name="bcode" value="<?php echo $TPL_VAR["게시판코드"]?>">
		<input type="hidden" name="seq" value="<?php echo $TPL_VAR["포스트"]["고유키"]?>">
		<input type="hidden" name="pg" value="<?php echo $TPL_VAR["pg"]?>">
		<input type="hidden" name="ct" value="<?php echo $TPL_VAR["검색분류"]?>">
		<input type="hidden" name="search" value="<?php echo $TPL_VAR["검색키"]?>">
		<input type="hidden" name="searchstring" value="<?php echo $TPL_VAR["검색어"]?>">
		<input type="hidden" name="path_files" value="<?php echo $TPL_VAR["path_files"]?>">
		<input type="hidden" name="php_self" value="<?php echo $TPL_VAR["php_self"]?>">
		<input type="hidden" name="webeditor_is" value="<?php echo $TPL_VAR["웹에디터사용"]?>">

		<input type="hidden" name="category" value="<?php echo $TPL_VAR["선택분류"]?>">
		<input type="hidden" name="name" value="<?php echo $TPL_VAR["회원이름"]?>">

		<div class="rt-rwd-form-area">

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
					<h1><span class="rt-rwd-star">*</span> 모델 선택</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-33-box">
						<select name="pdt_model" class="required" msg="제품모델을 선택해 주세요">
							<option value="">모델 선택</option>
<?php if($TPL_제품모델_1){foreach($TPL_VAR["제품모델"] as $TPL_V1){?>
							<option value="<?php echo $TPL_V1["모델코드"]?>" <?php echo $TPL_V1["selected"]?>><?php echo $TPL_V1["모델명"]?></option>
<?php }}?>
						</select>
					</div>
				</div>
			</div>

			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1><span class="rt-rwd-star">*</span> 제품 시리얼넘버</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<input type="text" name="serial_num" value="<?php echo $TPL_VAR["포스트"]["시리얼넘버"]?>" class="required" msg="시리얼넘버를 정확히 입력해 주세요" style="width:180px;" />
					</div>
					<!-- <p style="padding:0px 0px 0px 10px;"><br><br><br>※제품에 기재된 그대로 입력하시면 됩니다.ex) mm20381-293471</p> -->

				</div>
			</div>

			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1><span class="rt-rwd-star">*</span>별점 선택</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">

						<label>
							<input type="radio" name="rating_en" value="5" <?php if($TPL_VAR["포스트"]["별점"]=='5'||$TPL_VAR["mode"]=='insert'){?>checked<?php }?> style="margin-top:4px;">
							<img src="/assets/images/start.png">
							<img src="/assets/images/start.png">
							<img src="/assets/images/start.png">
							<img src="/assets/images/start.png">
							<img src="/assets/images/start.png">
						</label>&nbsp;&nbsp;&nbsp;&nbsp;

						<label>
							<input type="radio" name="rating_en" value="4" <?php if($TPL_VAR["포스트"]["별점"]=='4'){?>checked<?php }?> style="margin-top:4px;">
							<img src="/assets/images/start.png">
							<img src="/assets/images/start.png">
							<img src="/assets/images/start.png">
							<img src="/assets/images/start.png">
						</label>&nbsp;&nbsp;&nbsp;&nbsp;

						<label>
							<input type="radio" name="rating_en" value="3" <?php if($TPL_VAR["포스트"]["별점"]=='3'){?>checked<?php }?> style="margin-top:4px;">
							<img src="/assets/images/start.png">
							<img src="/assets/images/start.png">
							<img src="/assets/images/start.png">
						</label>&nbsp;&nbsp;&nbsp;&nbsp;

						<label>
							<input type="radio" name="rating_en" value="2" <?php if($TPL_VAR["포스트"]["별점"]=='2'){?>checked<?php }?> style="margin-top:4px;">
							<img src="/assets/images/start.png">
							<img src="/assets/images/start.png">
						</label>&nbsp;&nbsp;&nbsp;&nbsp;

						<label>
							<input type="radio" name="rating_en" value="1" <?php if($TPL_VAR["포스트"]["별점"]=='1'){?>checked<?php }?> style="margin-top:4px;">
							<img src="/assets/images/start.png">
						</label>

				</div>
			</div>

<?php if($TPL_VAR["선택분류"]=='포토후기'){?>
			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1><span class="rt-rwd-star">*</span> 내용</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<textarea name="content" id="content" style="<?php if($TPL_VAR["웹에디터사용"]=='y'){?>display:none;<?php }?>"><?php echo $TPL_VAR["포스트"]["내용"]?></textarea>
					</div>
				</div>
			</div>
<?php }else{?>
			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1><span class="rt-rwd-star">*</span> SNS주소 입력</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<input type="text" name="sns_url" value="<?php echo $TPL_VAR["포스트"]["SNS주소"]?>" class="required" msg="SNS주소를 입력해 주세요" />
					</div>
				</div>
			</div>
<?php }?>
			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1>대표(목록) 이미지</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<p><input type="file" value="" name="list_img" <?php if($TPL_VAR["mode"]=='insert'){?> class="required" msg="대표이미지를 선택해 주세요"<?php }?> /></p>
<?php if($TPL_VAR["포스트"]["목록이미지"]){?>
						<p><label><input type="checkbox" value="y" name="list_img_del_is" /> 체크 시 삭제 [<?php echo $TPL_VAR["포스트"]["목록이미지파일명"]?>]</label>
						</p>
<?php }?>
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

			<div class="rt-rwd-form-con">
				<div class="rt-rwd-form-title">
					<h1>추천인 코드</h1>
				</div>
				<div class="rt-rwd-form-box-wrap clearfix">
					<div class="rt-rwd-form-box rt-full-box">
						<input type="text" name="recode" value="<?php echo $TPL_VAR["포스트"]["추천인코드"]?>" style="width:180px;" />
					</div>
				</div>
			</div>

		</div>
		</form>
		<!-- 폼 필드 끝 -->

	</div>
	<!-- 폼 끝 -->

	<div class="rt-button rt-button-tac">
		<!--<a href="#;" style="cursor: pointer;"  id="btn-list">목록으로</a>-->
<?php if($TPL_VAR["mode"]=='insert'){?>
		<a href="#;" style="cursor: pointer;" id="btn-form-submit">등록하기</a>
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
<?php if($TPL_VAR["선택분류"]=='포토후기'){?>
<script src="<?php echo RTW_PLUGIN;?>/SE2.8.2.O12056/js/HuskyEZCreator.js" type="text/javascript"></script>
<script src="<?php echo RTW_ASSETS;?>/js/se2.editor.js" type="text/javascript"></script>
<?php }?>
<script type="text/javascript">
<?php if($TPL_VAR["선택분류"]=='포토후기'){?>
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
		$("#btn-form-submit").click(function (){
			var form = document.data_form;
			var conf = document.conf_form;

<?php if($TPL_VAR["선택분류"]=='포토후기'){?>
			if (form.webeditor_is.value == "y") {
				se2_editor_contents("content");
			}
<?php }?>

			if(rt_chk_form('required')) {

				if (form.mode.value == "insert" && conf.login_is.value != "1") {
					
					if (form.sec_code.value == "") {
						alert("보안코드가 맞지 않습니다.");
						$(".rt-button-tac").show();
						return false;
					}
				}

				if (form.mode.value == "insert" && conf.assent_term_is.value == "y") {
					if ($("#assent_term").is(":checked")) {
						$(".rt-button-tac").hide();
						form.submit();
					} else {
						alert("개인정보처리방침에 동의해 주세요");
						$(".rt-button-tac").show();
					}
				} else {
					$(".rt-button-tac").hide();
					form.submit();
				}
			}
		});
	});
})(jQuery);
</script>


<!-- PC CSS //-->
<link href="<?php echo $TPL_VAR["path_css"]?>/rtboard.norm.responsive.css" type="text/css" rel="stylesheet"/>

<script src="<?php echo $TPL_VAR["path_theme"]?>/user/js/rtboard.theme.norm.user.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>