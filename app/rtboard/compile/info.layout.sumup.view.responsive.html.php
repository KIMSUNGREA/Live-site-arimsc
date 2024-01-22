<?php /* Template_ 2.2.8 2017/03/11 00:47:03 /home/rintkit.com/new/app/rtboard/template/info.layout.sumup.view.responsive.html 000010398 */ 
$TPL_추가필드_1=empty($TPL_VAR["추가필드"])||!is_array($TPL_VAR["추가필드"])?0:count($TPL_VAR["추가필드"]);
$TPL_첨부파일_1=empty($TPL_VAR["첨부파일"])||!is_array($TPL_VAR["첨부파일"])?0:count($TPL_VAR["첨부파일"]);
$TPL_댓글_1=empty($TPL_VAR["댓글"])||!is_array($TPL_VAR["댓글"])?0:count($TPL_VAR["댓글"]);?>
<!-- 반응형 게시판 시작 -->
<div class="rt-rwd-notice-wrap">
	<!-- 뷰 시작 -->
	<div class="rt-rwd-view-wrap">
		<div class="rt-rwd-view-head">
			<h1 class="rt-rwd-view-head-title"><?php if($TPL_VAR["분류사용"]=='y'&&$TPL_VAR["포스트"]["분류"]){?>[<?php echo $TPL_VAR["포스트"]["분류"]?>] <?php }?><?php echo $TPL_VAR["포스트"]["제목"]?></h1>
			<div class="rt-rwd-view-data-wrap">
				<span class="rt-rwd-view-data">작성자 : <?php echo $TPL_VAR["포스트"]["작성자"]?></span>
				<span class="rt-rwd-view-data">작성일 : <?php echo $TPL_VAR["포스트"]["작성일"]?></span>
				<span class="rt-rwd-view-data">조회수 : <?php echo $TPL_VAR["포스트"]["조회수"]?></span>
			</div>
		</div>
		<div class="rt-rwd-view-body">
<?php if($TPL_VAR["포스트"]["대표이미지사용여부"]=='y'){?>
			<img src="<?php echo $TPL_VAR["포스트"]["목록이미지경로"]?>" alt="">
<?php }?>
			<p><?php echo $TPL_VAR["포스트"]["내용"]?></p>
		</div>
		<div class="rt-rwd-view-footer">
<?php if($TPL_추가필드_1){foreach($TPL_VAR["추가필드"] as $TPL_V1){?>
			<div class="rt-rwd-view-pager">
				<div class="rt-rwd-view-pager-title"><h1><?php echo $TPL_V1["필드명"]?></h1></div>
				<div class="rt-rwd-view-pager-list"><a><?php echo $TPL_V1["데이터"]?></a></div>
			</div>
<?php }}?>
<?php if($TPL_첨부파일_1){foreach($TPL_VAR["첨부파일"] as $TPL_V1){?>
			<div class="rt-rwd-view-pager">
				<div class="rt-rwd-view-pager-title"><h1>첨부파일<img src="<?php echo $TPL_VAR["path_theme"]?>/user/files/ico_file.png" alt="" /></h1></div>
				<div class="rt-rwd-view-pager-list"><a href="<?php echo $TPL_V1["다운로드링크"]?>" target="rt_ifrm"><?php echo $TPL_V1["파일명"]?></a>&nbsp;&nbsp;<a href="<?php echo $TPL_V1["다운로드링크"]?>" target="rt_ifrm"><img src="<?php echo $TPL_VAR["path_theme"]?>/user/files/download.png" alt=""  /></a> <span class="count"><?php echo $TPL_V1["다운로드수"]?>회</span></div>
			</div>
<?php }}?>
			<div class="rt-rwd-view-pager">
				<div class="rt-rwd-view-pager-title"><h1>다음글</h1></div>
				<div class="rt-rwd-view-pager-list"><a href="<?php echo $TPL_VAR["포스트"]["다음글링크"]?>"><?php echo $TPL_VAR["포스트"]["다음글제목"]?></a></div>
			</div>
			<div class="rt-rwd-view-pager">
				<div class="rt-rwd-view-pager-title"><h1>이전글</h1></div>
				<div class="rt-rwd-view-pager-list"><a href="<?php echo $TPL_VAR["포스트"]["이전글링크"]?>"><?php echo $TPL_VAR["포스트"]["이전글제목"]?></a></div>
			</div>
		</div>
	</div>
	<!-- 뷰 끝 -->
	<!-- 버튼 시작 -->
	<div class="rt-button rt-button-tar">
		<a href="#;" style="cursor: pointer;" id="btn-list">목록</a>
	</div>
	<!-- 버튼 끝 -->


<?php if($TPL_VAR["댓글사용"]=='y'){?>
		<!-- 댓글 시작 -->
		<div class="rt-rwd-reply-wrap">
			<!-- 댓글 폼 시작 -->
			<div class="rt-rwd-reply-form-wrap clearfix">
			<form name="cmt_insert_form" method="post" action="<?php echo $TPL_VAR["path_theme"]?>/user/update.php"target="rt_ifrm">
				<input type="hidden" name="mode" value="cmt_insert">
				<input type="hidden" name="post_seq" value="<?php echo $TPL_VAR["포스트"]["고유키"]?>">
				<input type="hidden" name="id" value="<?php echo $TPL_VAR["회원아이디"]?>">
				<input type="hidden" name="bcode" value="<?php echo $TPL_VAR["게시판코드"]?>">
				<input type="hidden" name="php_self" value="<?php echo $TPL_VAR["php_self"]?>">
				<div class="rt-rwd-reply-form-hd clearfix">
					<div class="rt-rwd-reply-form-user rt-rwd-reply-form-user-left"><span class="rt-rwd-reply-form-tit">이름 : </span><input type="text" name="name" class="rt-rwd-reply-user required" placeholder="이름을 입력하세요." msg="이름을 입력해 주세요" value="<?php echo $TPL_VAR["회원이름"]?>"/></div>
<?php if(!$TPL_VAR["로그인여부"]){?>
					<div class="rt-rwd-reply-form-user rt-rwd-reply-form-user-right"><span class="rt-rwd-reply-form-tit">패스워드 : </span><input type="password" name="pwd" id="pwd" class="rt-rwd-reply-user required" placeholder="비밀번호를 입력하세요." msg="비밀번호를 입력해 주세요" /></div>
<?php }?>
				</div>
				<div class="rt-rwd-reply-form-con">
					<textarea name="content" class="rt-rwd-reply-form required" placeholder="댓글을 입력하세요." msg="댓글 내용을 입력해 주세요"></textarea>
<?php if($TPL_VAR["댓글이용권한"]){?>
					<a href="#;" class="rt-rwd-reply-send" id="btn-cmt-submit"><span>등록</span></a>
<?php }else{?>
					<a href="#;" class="rt-rwd-reply-send" onclick="alert('이용권한이 없습니다.')"><span>등록</span></a>
<?php }?>
				</div>
			</form>
			</div>
			<!-- 댓글 폼 끝 -->
			<!-- 댓글 리스트 시작 -->
			<div class="rt-rwd-reply-list-wrap">
<?php if($TPL_댓글_1){foreach($TPL_VAR["댓글"] as $TPL_V1){?>
<?php if($TPL_V1["re_level"]== 0){?>
				<div class="rt-rwd-reply-list-con">
<?php }?>
<?php if($TPL_V1["re_level"]!= 0){?>
					<div class="rt-rwd-reply-comment-wrap">
						<div class="rt-rwd-reply-comment-con">
<?php }?>
							<p class="rt-rwd-reply-id clearfix"><?php echo $TPL_V1["작성자"]?>

<?php if($TPL_VAR["로그인여부"]&&$TPL_VAR["회원아이디"]==$TPL_V1["아이디"]){?>
							<a href="#;" class="rt-rwd-reply-delete" onclick="cmt_my_delete(<?php echo $TPL_V1["고유키"]?>)">삭제</a>
<?php }else{?>
							<a href="#;" class="rt-rwd-reply-delete">삭제</a>
<?php }?>
							</p>
							<div class="rt-rwd-reply-delete-password-wrap clearfix">
								<div class="rt-rwd-reply-delete-password-form">
									<input type="password" class="rt-rwd-reply-delete-password" placeholder="비밀번호를 입력해주세요." name="del_pwd_<?php echo $TPL_V1["고유키"]?>" id="del_pwd_<?php echo $TPL_V1["고유키"]?>" msg="패스워드을 입력해 주세요"/>
									<a href="javascript:cmt_delete(<?php echo $TPL_V1["고유키"]?>)" class="rt-rwd-reply-delete-password-send">입력</a>
								</div>
								<a href="#;" class="rt-rwd-reply-delete-password-cancle">취소</a>
							</div>
							<p class="rt-rwd-reply-date"><?php echo $TPL_V1["작성일"]?></p>
							<p class="rt-rwd-reply-substance"><?php echo $TPL_V1["내용"]?></p>
<?php if($TPL_V1["re_level"]== 0){?>
							<a href="#;" class="rt-rwd-reply-comment">답글입력</a>
<?php }?>
<?php if($TPL_V1["re_level"]!= 0){?>
						</div>
					</div>
<?php }?>
					<!-- 답글 입력 시작 -->
					<div class="rt-rwd-reply-form-wrap rt-rwd-reply-toggle clearfix">
						<div class="rt-rwd-reply-form-hd clearfix">
							<div class="rt-rwd-reply-form-user rt-rwd-reply-form-user-left"><span class="rt-rwd-reply-form-tit">이름 : </span><input type="text" class="rt-rwd-reply-user" placeholder="이름을 입력하세요." name="name_<?php echo $TPL_V1["고유키"]?>" id="name_<?php echo $TPL_V1["고유키"]?>" msg="이름을 입력해 주세요" value="<?php echo $TPL_VAR["회원이름"]?>" /></div>
<?php if(!$TPL_VAR["로그인여부"]){?>
							<div class="rt-rwd-reply-form-user rt-rwd-reply-form-user-right"><span class="rt-rwd-reply-form-tit">패스워드 : </span><input type="password" class="rt-rwd-reply-user" placeholder="비밀번호를 입력하세요." name="name" id="pwd_<?php echo $TPL_V1["고유키"]?>" msg="패스워드을 입력해 주세요"/></div>
<?php }?>
						</div>
						<div class="rt-rwd-reply-form-con">
							<textarea class="rt-rwd-reply-form" placeholder="댓글을 입력하세요." name="content_<?php echo $TPL_V1["고유키"]?>" id="content_<?php echo $TPL_V1["고유키"]?>"></textarea>
<?php if($TPL_VAR["댓글이용권한"]){?>
							<a href="#;" class="rt-rwd-reply-send" onclick="cmt_submit(<?php echo $TPL_V1["고유키"]?>);"><span>등록</span></a>
<?php }else{?>
							<a href="#;" class="rt-rwd-reply-send" onclick="alert('이용권한이 없습니다.');"><span>등록</span></a>
<?php }?>
						</div>
					</div>
					<!-- 답글 입력 끝 -->
<?php if($TPL_V1["re_level"]== 0){?>
				</div>
<?php }?>
<?php }}?>
			</div>
			<!-- 댓글 리스트 끝 -->
		</div>
		<!-- 댓글 끝 -->
<?php }?>
</div>
<!-- 반응형 게시판 끝 -->

<form name="cmt_use_form" method="post" action="<?php echo $TPL_VAR["path_theme"]?>/user/update.php" target="rt_ifrm">
	<input type="hidden" name="mode" value="cmt_reply" />
	<input type="hidden" name="seq" value="" />
	<input type="hidden" name="id" value="<?php echo $TPL_VAR["회원아이디"]?>" />
	<input type="hidden" name="name" value="<?php echo $TPL_VAR["회원이름"]?>" />
	<input type="hidden" name="pwd" value="" />
	<input type="hidden" name="bcode" value="<?php echo $TPL_VAR["게시판코드"]?>">
	<input type="hidden" name="content" value="" />
	<input type="hidden" name="php_self" value="<?php echo $TPL_VAR["php_self"]?>">
</form>

<form name="data_form">
	<input type="hidden" name="pg" value="<?php echo $TPL_VAR["pg"]?>">
	<input type="hidden" name="pcd" value="<?php echo $TPL_VAR["페이지코드"]?>">
	<input type="hidden" name="ct" value="<?php echo $TPL_VAR["검색분류"]?>">
	<input type="hidden" name="screen" value="<?php echo $TPL_VAR["이동화면"]?>">
	<input type="hidden" name="search" value="<?php echo $TPL_VAR["search"]?>">
	<input type="hidden" name="searchstring" value="<?php echo $TPL_VAR["searchstring"]?>">
</form>

<!-- 반응형 CSS STR-->
<link href="<?php echo $TPL_VAR["path_css"]?>/rtboard.info.responsive.css" type="text/css" rel="stylesheet"/>
<!-- 반응형 CSS END-->

<script src="<?php echo $TPL_VAR["path_theme"]?>/user/js/rtboard.theme.info.user.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>