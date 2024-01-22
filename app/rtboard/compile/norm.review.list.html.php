<?php /* Template_ 2.2.8 2023/12/04 16:57:00 /www_root/app/rtboard/template/norm.review.list.html 000000985 */ 
$TPL_리스트_1=empty($TPL_VAR["리스트"])||!is_array($TPL_VAR["리스트"])?0:count($TPL_VAR["리스트"]);?>
<ul class="com_list">
<?php if($TPL_리스트_1){foreach($TPL_VAR["리스트"] as $TPL_V1){?>
		<li>
<?php if($TPL_V1["분류"]=='포토후기'){?>
			<a href="<?php echo $TPL_V1["상세페이지링크"]?>">
<?php }else{?>
			<a href="<?php echo $TPL_V1["SNS주소"]?>" target="_blank">
<?php }?>
				<figure>
					<img src="<?php echo $TPL_V1["목록이미지경로"]?>" alt="">
				</figure>
				<figcaption>
					<?php echo $TPL_V1["별점"]?>

					<p><?php echo $TPL_V1["작성자"]?></p>
					<span><?php echo $TPL_V1["줄임제목"]?></span>
				</figcaption>
			</a>
		</li>
<?php }}?>
	</ul>

	<?php echo $TPL_VAR["페이지인덱스"]?>


	<link href="<?php echo $TPL_VAR["path_css"]?>/rtboard.norm.responsive.css" type="text/css" rel="stylesheet"/>