<?php /* Template_ 2.2.8 2023/11/06 16:23:09 /www_root/app/rtboard/template/info.notice.view.html 000003137 */ 
$TPL_첨부파일_1=empty($TPL_VAR["첨부파일"])||!is_array($TPL_VAR["첨부파일"])?0:count($TPL_VAR["첨부파일"]);?>
<div class="rt-rwd-notice-wrap">
	<div class="rt-rwd-view-wrap mb50">
		<div class="rt-rwd-view-head">
			<h1 class="rt-rwd-view-head-title"><?php echo $TPL_VAR["포스트"]["제목"]?></h1>
			<div class="rt-rwd-view-data-wrap">
				<span class="rt-rwd-view-data">＊등록일 : <?php echo $TPL_VAR["포스트"]["작성일"]?></span>
				<span class="rt-rwd-view-data">＊조회수 : <?php echo $TPL_VAR["포스트"]["조회수"]?>회</span>
			</div>
<?php if($TPL_첨부파일_1){foreach($TPL_VAR["첨부파일"] as $TPL_V1){?>
			<div class="rt-rwd-view-file-wrap">
				<p class="file_tit"><span>※ 첨부자료</span> <!-- <img src="/assets/images/sub/file_type_pdf.png" alt="PDF"> --></p>
				<p class="file_txt"><a href="<?php echo $TPL_V1["다운로드링크"]?>" target="rt_ifrm"><?php echo $TPL_V1["파일명"]?></a> &nbsp; <img src="/assets/images/sub/icon_file.png" alt="첨부파일 아이콘"></p>
			</div>
<?php }}?>
		</div>
		<div class="rt-rwd-view-body">
			<div class="con">
<?php if($TPL_VAR["포스트"]["대표이미지사용여부"]=='y'){?>
				<img src="<?php echo $TPL_VAR["포스트"]["목록이미지경로"]?>" alt="">
<?php }?>
				<p><?php echo $TPL_VAR["포스트"]["내용"]?></p>
			</div>
		</div>
	</div>
	<!-- 버튼 시작 -->
	<div class="rt-button rt-button-tar">
		<a href="#;" id="btn-list">목록</a>
	</div>
	<!-- 버튼 끝 -->
</div>


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
	<input type="hidden" name="screen" value="<?php echo $TPL_VAR["이동화면"]?>">
	<input type="hidden" name="ct" value="<?php echo $TPL_VAR["검색분류"]?>">
	<input type="hidden" name="search" value="<?php echo $TPL_VAR["search"]?>">
	<input type="hidden" name="searchstring" value="<?php echo $TPL_VAR["searchstring"]?>">
</form>

<script src="<?php echo $TPL_VAR["path_theme"]?>/user/js/rtboard.theme.info.user.js" type="text/javascript"></script>

<link rel="stylesheet" href="/assets/css/board.css?v=<?php echo time();?>"/>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>