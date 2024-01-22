<?php /* Template_ 2.2.8 2017/03/11 00:47:00 /home/rintkit.com/new/app/product/template/product.view.html 000006163 */ 
$TPL_제품분류_1=empty($TPL_VAR["제품분류"])||!is_array($TPL_VAR["제품분류"])?0:count($TPL_VAR["제품분류"]);
$TPL_상세이미지_1=empty($TPL_VAR["상세이미지"])||!is_array($TPL_VAR["상세이미지"])?0:count($TPL_VAR["상세이미지"]);?>
<!--conbody-->
<div class="rt_product_wrap">

	<!-- 제품소개 페이저 시작 -->
	<div class="rt_product_pager_wrap">
		<div class="rt_product_pager_con">
			<div class="rt_product_pager_tit">
				<h1>제품분류</h1>
			</div>
			<ul class="rt_product_pager_box rt_product_pager_box5">
<?php if($TPL_제품분류_1){foreach($TPL_VAR["제품분류"] as $TPL_V1){?>
				<li class="rt_depth1_wrap <?php echo $TPL_V1["active"]?>"><a href="?c=<?php echo $TPL_V1["분류코드"]?>" class="rt_depth1"><span>-</span><?php echo $TPL_V1["분류명"]?></a></li>
<?php }}?>
			</ul>
		</div>
	</div>
	<!-- 제품소개 페이저 끝 -->

	<!-- 제품소개 뷰 시작 -->
<?php if($TPL_VAR["제품정보"]["페이지구성"]=='field'){?>
	<div class="rt_product_view_wrap">
		<ul class="rt_product_view_info_wrap">
			<li class="rt_product_view_thumb_wrap">
				<a href="#;" class="rt_product_view_thumb">
					<img src="<?php echo $TPL_VAR["상세이미지"][ 0]["이미지경로"]?>" alt="상품이미지" />
				</a>
			</li>
			<li class="rt_product_view_info_con">
				<h1 class="rt_product_view_info_tit"><?php echo $TPL_VAR["제품정보"]["제품명"]?></h1>
				<div class="rt_product_list_info_wrap">
					<table class="rt_product_list_info">
						<caption>제품정보</caption>
						<colgroup>
							<col width="90px"/>
							<col width="*"/>
						</colgroup>
						<tr>
							<th><p><?php echo $TPL_VAR["제품정보"]["옵션명1"]?></p></th>
							<td><p><?php echo $TPL_VAR["제품정보"]["옵션1"]?></p></td>
						</tr>
						<tr>
							<th><p><?php echo $TPL_VAR["제품정보"]["옵션명2"]?></p></th>
							<td><p><?php echo $TPL_VAR["제품정보"]["옵션2"]?></p></td>
						</tr>
						<tr>
							<th><p><?php echo $TPL_VAR["제품정보"]["옵션명3"]?></p></th>
							<td><p><?php echo $TPL_VAR["제품정보"]["옵션3"]?></p></td>
						</tr>
						<tr>
							<th><p><?php echo $TPL_VAR["제품정보"]["옵션명4"]?></p></th>
							<td><p><?php echo $TPL_VAR["제품정보"]["옵션4"]?></p></td>
						</tr>
						<tr>
							<th><p><?php echo $TPL_VAR["제품정보"]["가상옵션명1"]?></p></th>
							<td><p><?php echo $TPL_VAR["제품정보"]["가상옵션1"]?></p></td>
						</tr>
						<tr>
							<th><p><?php echo $TPL_VAR["제품정보"]["가상옵션명2"]?></p></th>
							<td><p><?php echo $TPL_VAR["제품정보"]["가상옵션2"]?></p></td>
						</tr>
						<tr>
							<th><p><?php echo $TPL_VAR["제품정보"]["가상옵션명3"]?></p></th>
							<td><p><?php echo $TPL_VAR["제품정보"]["가상옵션3"]?></p></td>
						</tr>
					</table>
				</div>

				<div class="rt_product_info_thumb_wrap">
					<div class="rt_product_info_thumb_con">
<?php if($TPL_상세이미지_1){foreach($TPL_VAR["상세이미지"] as $TPL_V1){?>
						<a href="#;"><img src="<?php echo $TPL_V1["썸네일이미지경로"]?>" data="<?php echo $TPL_V1["이미지경로"]?>" alt="제품 썸네일" /></a>
<?php }}?>
					</div>
				</div>
				<div class="rt_product_view_info_pager">
					<a href="<?php echo $TPL_VAR["제품정보"]["이전제품링크"]?>" class="rt_product_view_prev"><span>이전</span></a>
					<a href="<?php echo $TPL_VAR["목록가기링크"]?>" class="rt_product_view_list_go"><span>목록</span></a>
					<a href="<?php echo $TPL_VAR["제품정보"]["다음제품링크"]?>" class="rt_product_view_next"><span>다음</span></a>
				</div>
			</li>
		</ul>
		<div class="rt_produc_view_substance_wrap">
			<div class="rt_produc_view_substance">
<?php if($TPL_VAR["제품정보"]["상세이미지본문사용"]=='y'){?>
<?php if($TPL_상세이미지_1){foreach($TPL_VAR["상세이미지"] as $TPL_V1){?>
				<img src="<?php echo $TPL_V1["이미지경로"]?>" alt="제품 썸네일" />
<?php }}?>
<?php }?>
			<?php echo $TPL_VAR["제품정보"]["상세내용"]?>

			</div>
		</div>
	</div>
<?php }?>

<?php if($TPL_VAR["제품정보"]["페이지구성"]=='img'){?>
	<div class="rt_product_view_wrap rt_product_view_wrap2">
<?php if($TPL_VAR["제품정보"]["콘텐츠이미지"]){?>
		<img src="<?php echo $TPL_VAR["제품정보"]["콘텐츠이미지경로"]?>" />
		<div class="rt_product_view_info_pager">
			<a href="<?php echo $TPL_VAR["목록가기링크"]?>" class="rt_product_view_list_go"><span>목록</span></a>
		</div>
<?php }?>
	</div>
<?php }?>

<?php if($TPL_VAR["제품정보"]["페이지구성"]=='html'){?>
	<div class="rt_product_view_wrap rt_product_view_wrap2">
		<?php echo $TPL_VAR["제품정보"]["페이지HTML"]?>

		<div class="rt_product_view_info_pager">
			<a href="<?php echo $TPL_VAR["목록가기링크"]?>" class="rt_product_view_list_go"><span>목록</span></a>
		</div>
	</div>
<?php }?>
	<!-- 제품소개 뷰 끝 -->
</div>
<!--//conbody-->

<!-- 반응형 CSS STR-->
<link href="<?php echo $TPL_VAR["path_assets"]?>/css/rt_product.css" type="text/css" rel="stylesheet"/>
<!-- 반응형 CSS END-->

<script type="text/javascript">
jQuery(function($){
	$('.rt_product_nav_con a').click(function(){
		$(this).parent().addClass('active').siblings().removeClass('active');
	});
	$('.rt_depth1_wrap .rt_depth1').click(function(){
		$(this).parent().addClass('active').siblings().removeClass('active');
	});
	$('.rt_product_info_thumb_wrap a').click(function(){
		var img_src = $(this).children().attr('data');
		$('.rt_product_view_thumb img').attr('src',img_src);
	});
	$('.rt_product_view_pager_wrap a').click(function(){
		var tmp = $(this).index();
		$(this).addClass('active').siblings().removeClass('active');
		$('.rt_produc_view_substance_wrap .rt_produc_view_substance').eq(tmp).show().siblings().hide();
	})
})
</script>