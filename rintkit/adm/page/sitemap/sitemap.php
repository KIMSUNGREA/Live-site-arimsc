<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<div class="rt_pager_admin_hd mb10 clearfix">
	<?php if ($cls_adm->auth_code == "master") { ?>
	<div class="rt_button_wrap clearfix rt_fll">
		<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','ins1depth');" class="rt_btn_purple btn_s">+최상위 페이지 추가</a>
	</div>
	<?php } ?>
	<p class="rt_red rt_bold mt5">※ 아이콘 안내</p>
	<p class="rt_menu_modify mt5">페이지 정보수정</p>
	<?php if ($cls_adm->auth_code == "master") { ?>
	<p class="rt_menu_move mt5">페이지 이동</p>
	<?php } ?>
</div>
<div class="rt_pager_admin_area">
	<ul class="rt_depth_area">
		<li class="rt_depth_cover">

			<?php for ($m = 0; $m < count($data); $m++) { ?>
			<div class="rt_depth_wrap rt_depth<?php echo $data[$m]['depth'];?> clearfix">
				<div class="rt_popup_trigger">
					<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','conf');" class="rt_ico rt_popup_open" title="페이지 정보수정"><img src="<?php echo RTW_LAYOUT;?>/images/sub/menu_modify.png" alt="톱니바퀴" /></a>
					<?php if ($cls_adm->auth_code == "master") { ?>
					<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','move');" class="rt_ico rt_popup_open" title="페이지 이동"><img src="<?php echo RTW_LAYOUT;?>/images/sub/menu_move.png" alt="화살표" /></a>
					<?php } ?>
				</div>
				<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','conf');" class="rt_subject"><?php echo $data[$m]['label'];?> <?php echo $data[$m]['fw_str'];?> <?php echo $data[$m]['use_str'];?></a>
				<div class="rt_pager_option rt_popup_trigger rt_button_wrap clearfix">
					<?php if ($cls_adm->auth_code == "master") { ?>
					<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','page_insert');" class="rt_popup_open btn_in">+하위 페이지 추가</a>
					<?php } ?>
					<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','layout');" class="rt_popup_open btn_in">레이아웃/콘텐츠</a>
					<?php if ($cls_adm->auth_code == "master") { ?>
					<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','userdata');" class="rt_popup_open btn_in">개발자 데이터 설정</a>
					<?php } ?>
					<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','seo');" class="rt_popup_open btn_in">SEO (META)</a>
					<?php if ($cls_adm->auth_code == "master") { ?>
					<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','code');" class="rt_popup_open btn_in">연동 소스</a>
					<a href="#;" onclick="javascript:page_delete('<?php echo $data[$m]['code'];?>');" class="rt_delete rt_btn_red btn_in">삭제</a>
					<?php } ?>
				</div>
			</div>
			<?php } ?>

		</li>
	</ul>

	<div class="rt_popup_wrap">
		<div class="rt_popup_con" id="popup_data"></div>
		<a href="javascript:popup_data_close();" class="rt_popup_close"><img src="<?php echo RTW_LAYOUT;?>/images/sub/popup_close_ico.jpg" alt="닫기" /></a>
	</div>
</div>

<script src="assets/js/page.sitemap.controller.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>
