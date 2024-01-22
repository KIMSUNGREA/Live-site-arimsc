<?php /* Template_ 2.2.8 2023/11/06 16:23:57 /www_root/app/rtboard/template/info.notice.list.html 000005952 */ 
$TPL_글분류_1=empty($TPL_VAR["글분류"])||!is_array($TPL_VAR["글분류"])?0:count($TPL_VAR["글분류"]);
$TPL_공지글_1=empty($TPL_VAR["공지글"])||!is_array($TPL_VAR["공지글"])?0:count($TPL_VAR["공지글"]);
$TPL_리스트_1=empty($TPL_VAR["리스트"])||!is_array($TPL_VAR["리스트"])?0:count($TPL_VAR["리스트"]);?>
<style>
	.rt-rwd-list-con {padding: 15px 220px 15px 100px;}
	@media all and (max-width:768px){
		.rt-rwd-list-con {padding: 10px;}
	}
</style>
<div class="rt-rwd-notice-wrap">
	<div class="rt-rwd-list-top">
		<p class="total">총 게시물 : <?php echo $TPL_VAR["게시물수"]?></p>
		<!-- 검색폼 STR -->
		<div class="rt-rwd-search-wrap">
			<form name="search_form" method="get" action="">
			<input type="hidden" name="pcd" value="<?php echo $TPL_VAR["페이지코드"]?>">
			<input type="hidden" name="screen" value="<?php echo $TPL_VAR["이동화면"]?>">
				<div class="rt-rwd-search-select-wrap" style="display: none;">
<?php if($TPL_VAR["분류사용"]=='y'){?>
					<select class="rt-rwd-search-select" name="ct">
						<option value="">분류 선택</option>
<?php if($TPL_글분류_1){foreach($TPL_VAR["글분류"] as $TPL_V1){?>
						<option value="<?php echo $TPL_V1["분류명"]?>" <?php echo $TPL_V1["selected"]?>><?php echo $TPL_V1["분류명"]?></option>
<?php }}?>
					</select>
<?php }?>
				</div>
				<div class="rt-rwd-search-select-wrap">
					<select class="rt-rwd-search-select" name="search">
						<option value="subjcont">제목+내용</option>
						<option value="subject">제목</option>
						<option value="content">내용</option>
					</select>
				</div>
				<div class="rt-rwd-search-input-wrap">
					<input type="text" name="searchstring" class="rt-rwd-search-input" value="<?php echo $TPL_VAR["검색어"]?>"/>
				</div>
				<a href="javascript:document.search_form.submit();" class="rt-rwd-search-send"><img src="/assets/images/sub/icon_sch.png" alt="검색" width="17"></a>
			</form>
		</div>
		<!-- 검색폼 END -->
	</div>
	<!-- 게시판 리스트 STR -->
	<div class="rt-rwd-list-wrap">
		<div class="rt-rwd-list-con rt-rwd-list-con-head rt-rwd-list-norm-con clearfix">
			<div class="rt-rwd-list-num"><p>번호</p></div>
<?php if($TPL_VAR["분류사용"]=='y'){?>
			<div class="rt-rwd-list-cate"><p>분류</p></div>
			<style>
			.rt-rwd-list-con {padding: 15px 220px 15px 160px;}
			@media all and (max-width:768px){
				.rt-rwd-list-con {padding: 10px;}
			}
		</style>
<?php }?>
			<div class="rt-rwd-list-subject"><p>제목</p></div>
			<div class="rt-rwd-list-type-wrap clearfix">
				<div class="rt-rwd-list-type-con clearfix">
					<div class="rt-rwd-list-type rt-rwd-list-type-file">
						<p>첨부</p>
					</div>
					<div class="rt-rwd-list-type rt-rwd-list-type-day">
						<p>날짜</p>
					</div>
				</div>
			</div>
		</div>
<?php if($TPL_공지글_1){foreach($TPL_VAR["공지글"] as $TPL_V1){?>
		<div class="rt-rwd-list-con rt-rwd-list-norm-con clearfix">
			<div class="rt-rwd-list-num"><p>공지</p></div>
<?php if($TPL_VAR["분류사용"]=='y'&&$TPL_V1["분류"]!=''){?>
			<div class="rt-rwd-list-cate"><p><?php echo $TPL_V1["분류"]?></p></div>
<?php }?>
			<div class="rt-rwd-list-subject">
				<a href="<?php echo $TPL_V1["상세페이지링크"]?>">
<?php if($TPL_VAR["목록이미지사용"]=='y'){?>
					<img src="<?php echo $TPL_V1["목록이미지경로"]?>" style="width:50px;height:50px;" class="rt-rwd-thumb"/>
<?php }?>
					<?php echo $TPL_V1["줄임제목"]?>

				</a>
			</div>
			<div class="rt-rwd-list-type-wrap clearfix">
				<div class="rt-rwd-list-type-con clearfix">
<?php if($TPL_V1["첨부파일여부"]){?>
					<div class="rt-rwd-list-type rt-rwd-list-type-file">
						<p><img src="/assets/images/sub/icon_file.png" alt="첨부파일"></p>
					</div>
<?php }?>
					<div class="rt-rwd-list-type rt-rwd-list-type-day">
						<p><?php echo $TPL_V1["작성일"]?></p>
					</div>
				</div>
			</div>
		</div>
<?php }}?>

<?php if($TPL_VAR["게시물수"]> 0){?>
<?php if($TPL_리스트_1){foreach($TPL_VAR["리스트"] as $TPL_V1){?>
		<div class="rt-rwd-list-con rt-rwd-list-norm-con clearfix">
			<div class="rt-rwd-list-num"><p><?php echo $TPL_V1["번호"]?></p></div>
<?php if($TPL_VAR["분류사용"]=='y'&&$TPL_V1["분류"]!=''){?>
			<div class="rt-rwd-list-cate"><p><?php echo $TPL_V1["분류"]?></p></div>
<?php }?>
			<div class="rt-rwd-list-subject">
				<a href="<?php echo $TPL_V1["상세페이지링크"]?>">
<?php if($TPL_VAR["목록이미지사용"]=='y'){?>
					<img src="<?php echo $TPL_V1["목록이미지경로"]?>" style="width:50px;height:50px;" class="rt-rwd-thumb"/>
<?php }?>
					<?php echo $TPL_V1["줄임제목"]?>

				</a>
			</div>
			<div class="rt-rwd-list-type-wrap clearfix">
				<div class="rt-rwd-list-type-con clearfix">
<?php if($TPL_V1["첨부파일여부"]){?>
					<div class="rt-rwd-list-type rt-rwd-list-type-file">
						<p><img src="/assets/images/sub/icon_file.png" alt="첨부파일"></p>
					</div>
<?php }?>
					<div class="rt-rwd-list-type rt-rwd-list-type-day">
						<p><?php echo $TPL_V1["작성일"]?></p>
					</div>
				</div>
			</div>
		</div>
<?php }}?>
<?php }else{?>
			<div class="rt-rwd-list-nosearch clearfix">
			등록된 글이 없습니다.
		</div>
<?php }?>

	</div>
	<!-- 게시판 리스트 END -->

	<!--페이지네이션 STR-->
	<?php echo $TPL_VAR["페이지인덱스"]?>

	<!--페이지네이션 END-->

	<!-- 반응형 CSS STR-->
	<script src="<?php echo $TPL_VAR["path_theme"]?>/user/js/rtboard.theme.info.user.js" type="text/javascript"></script>
	<!-- 반응형 CSS END-->
</div>

<link rel="stylesheet" href="/assets/css/board.css?v=<?php echo time();?>"/>