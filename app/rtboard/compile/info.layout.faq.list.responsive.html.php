<?php /* Template_ 2.2.8 2020/07/10 12:10:47 /home/admin2.co.kr/arim/app/rtboard/template/info.layout.faq.list.responsive.html 000003187 */ 
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
	<!-- FAQ 리스트 시작 -->
	<div class="rt-rwd-faq-list-wrap">
<?php if($TPL_VAR["리스트"]){?>
<?php if($TPL_리스트_1){foreach($TPL_VAR["리스트"] as $TPL_V1){?>
		<div class="rt-rwd-faq-list-con">
			<a href="#;" class="rt-rwd-faq-list rt-rwd-faq-list-q">
				<span class="rt-rwd-faq-ico">Q.</span>
				<div class="rt-rwd-faq-substance-q"><?php echo $TPL_V1["제목"]?></div>
			</a>
			<div class="rt-rwd-faq-list rt-rwd-faq-list-a">
				<span class="rt-rwd-faq-ico">A.</span>
				<div class="rt-rwd-faq-substance-a"><?php echo $TPL_V1["본문"]?></div>
			</div>
		</div>
<?php }}?>
<?php }else{?>
		<div class="rt-rwd-list-nosearch clearfix rt-bdb">
		등록된 글이 없습니다.
		</div>
<?php }?>
	</div>
	<!-- FAQ 리스트 끝 -->
	<?php echo $TPL_VAR["페이지인덱스"]?>

</div>

<!-- 반응형 CSS STR-->
<link href="<?php echo $TPL_VAR["path_css"]?>/rtboard.info.responsive.css" type="text/css" rel="stylesheet"/>
<!-- 반응형 CSS END-->


<script src="<?php echo $TPL_VAR["path_theme"]?>/user/js/rtboard.theme.info.user.js" type="text/javascript"></script>

<script>
	$(function(){
		$('.rt-rwd-faq-list-q').click(function(){
			$(this).parent().siblings().children('.rt-rwd-faq-list-a').slideUp();
			$(this).toggleClass('active').next().slideToggle();
		});
	})
</script>
<!-- 반응형 게시판 끝 -->