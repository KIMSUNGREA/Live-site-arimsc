<?php /* Template_ 2.2.8 2017/03/11 00:47:03 /home/rintkit.com/new/app/rtboard/template/info.layout.sumup.list.responsive.html 000003715 */ 
$TPL_글분류_1=empty($TPL_VAR["글분류"])||!is_array($TPL_VAR["글분류"])?0:count($TPL_VAR["글분류"]);
$TPL_리스트_1=empty($TPL_VAR["리스트"])||!is_array($TPL_VAR["리스트"])?0:count($TPL_VAR["리스트"]);?>
<!-- 반응형 게시판 시작 -->
<div class="rt-rwd-notice-wrap">
	<!-- 검색폼 시작 -->
	<div class="rt-rwd-search-wrap">
	<form name="search_form" method="get" action="<?php echo $TPL_VAR["php_self"]?>">
	<input type="hidden" name="pcd" value="<?php echo $TPL_VAR["페이지코드"]?>">
	<input type="hidden" name="screen" value="<?php echo $TPL_VAR["이동화면"]?>">
		<div class="rt-rwd-search-select-wrap">
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
				<option value="subject">제목</option>
				<option value="content">내용</option>
				<option value="subjcont">제목+내용</option>
				<option value="name">작성자</option>
			</select>
		</div>
		<div class="rt-rwd-search-input-wrap">
			<input type="text" name="searchstring" class="rt-rwd-search-input" value="<?php echo $TPL_VAR["검색어"]?>"/>
		</div>
		<a href="javascript:document.search_form.submit();" class="rt-rwd-search-send">검색</a>
	</form>
	</div>
	<!-- 검색폼 끝 -->
	<!-- 썸업 게시판 리스트 시작 -->
	<div class="rt-rwd-thumb-wrap clearfix">
<?php if($TPL_VAR["리스트"]){?>
<?php if($TPL_리스트_1){foreach($TPL_VAR["리스트"] as $TPL_V1){?>
			<div class="rt-rwd-thumb-con clearfix">
				<div class="rt-rwd-thumb-left">
					<a href="<?php echo $TPL_V1["상세페이지링크"]?>"><img src="<?php echo $TPL_V1["목록이미지경로"]?>" alt="썸네일" /></a>
				</div>
				<div class="rt-rwd-thumb-right">
					<p class="rt-rwd-thumb-subject"><?php if($TPL_VAR["분류사용"]=='y'&&$TPL_V1["분류"]){?>[<?php echo $TPL_V1["분류"]?>]&nbsp;&nbsp;<?php }?><a href="<?php echo $TPL_V1["상세페이지링크"]?>"><?php echo $TPL_V1["줄임제목"]?><?php if($TPL_VAR["댓글사용"]=='y'&&$TPL_V1["댓글수"]> 0){?>[<?php echo $TPL_V1["댓글수"]?>]<?php }?></a></p>
					<p class="rt-rwd-thumb-substance"><?php echo $TPL_V1["줄임본문"]?></p>
					<div class="rt-rwd-thumb-data-wrap clearfix">
						<div class="rt-rwd-thumb-data">
							<p><span class="rt-rwd-thumb-data-m">작성자 : </span><?php echo $TPL_V1["작성자"]?></p>
						</div>
						<div class="rt-rwd-thumb-data">
							<p><span class="rt-rwd-thumb-data-m">등록일 : </span><?php echo $TPL_V1["작성일"]?></p>
						</div>
						<div class="rt-rwd-thumb-data">
							<p><span class="rt-rwd-thumb-data-m">조회수 : </span><?php echo $TPL_V1["조회수"]?></p>
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
	<?php echo $TPL_VAR["페이지인덱스"]?>

	<!-- 썸업 게시판 리스트 끝 -->
</div>
<!-- 반응형 게시판 끝 -->

<!-- 반응형 CSS STR-->
<link href="<?php echo $TPL_VAR["path_css"]?>/rtboard.info.responsive.css" type="text/css" rel="stylesheet"/>
<!-- 반응형 CSS END-->