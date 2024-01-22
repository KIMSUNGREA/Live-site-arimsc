<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<div class="rt_pager_admin_hd mb10 clearfix">
	<?php if ($cls_adm->auth_code == "master") { ?>
	<div class="rt_button_wrap clearfix rt_fll">
		<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','ins1depth');" class="rt_btn_purple btn_s">+최상위 분류 추가</a>
	</div>
	<?php } ?>
	<p class="rt_red rt_bold mt5">※ 아이콘 안내</p>
	<p class="rt_menu_modify mt5">분류 정보 수정</p>
	<?php if ($cls_adm->auth_code == "master") { ?>
	<p class="rt_menu_move mt5">분류 이동</p>
	<?php } ?>
</div>
<div class="rt_pager_admin_area">
	<ul class="rt_depth_area">
		<li class="rt_depth_cover">

			<?php for ($m = 0; $m < count($data); $m++) { ?>
			<div class="rt_depth_wrap rt_depth<?php echo $data[$m]['depth'];?> clearfix">
				<div class="rt_popup_trigger">
					<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','conf');" class="rt_ico rt_popup_open" title="분류 정보수정"><img src="<?php echo RTW_LAYOUT;?>/images/sub/menu_modify.png" alt="톱니바퀴" /></a>
					<?php if ($cls_adm->auth_code == "master") { ?>
					<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','move');" class="rt_ico rt_popup_open" title="분류 이동"><img src="<?php echo RTW_LAYOUT;?>/images/sub/menu_move.png" alt="화살표" /></a>
					<?php } ?>
				</div>
				<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','conf');" class="rt_subject">
					<?php echo $data[$m]['label'];?> <?php echo $data[$m]['fw_str'];?> <?php echo $data[$m]['use_str'];?>

					<?php if ($data[$m]['use_is']=="n") { ?>
						<span class='rt_red'>[사용 안함]</span>
					<?php } else { ?>
						<?php if ($data[$m]['type_en']=="img") { ?>
							<span class='rt_blue'>[개별 디자인-IMG]</span>
						<?php } else if ($data[$m]['type_en']=="html") { ?>
							<span class='rt_blue'>[개별 디자인-HTML]</span>
						<?php }?>

						<?php if ($data[$m]['auth_en']=="each") { ?><span class='rt_brown'>[개별 권한]</span><?php } ?>
					<?php } ?>
				</a>
				<div class="rt_pager_option rt_popup_trigger rt_button_wrap clearfix">
					<?php if ($cls_adm->auth_code == "master") { ?>
					<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','category_insert');" class="rt_popup_open btn_in">+하위 분류 추가</a>
					<?php } ?>
					<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','cateimg');" class="rt_popup_open btn_in">분류 대표 이미지</a>
					<a href="#;" onclick="javascript:popup_data_open('<?php echo $data[$m]['code'];?>','auth');" class="rt_popup_open btn_in">이용 권한 설정</a>
					<?php if ($cls_adm->auth_code == "master") { ?>
					<a href="#;" onclick="javascript:category_delete('<?php echo $data[$m]['code'];?>');" class="rt_delete rt_btn_red btn_in">삭제</a>
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

<div class="rt_bot_box mt10">
	<h1>이용안내</h1>
	<p><em>-</em>분류명 우측의 <span class="rt_mint">개별 디자인</span>이라는 표기는 해당 분류는 <span class="rt_mint">이미지나 HTML 구성되어 있는 페이지</span>라는 의미입니다.</p>
	<p><em>-</em>분류의 <span class="rt_mint">"사용 안함" 설정</span>은 <span class="rt_red">하위 메뉴의 설정과 연계되지 않습니다.</span> 분류별로 사용안함을 설정해 주세요.</p>
	<p><em>-</em><span class="rt_mint">분류 이동</span>은 <span class="rt_red">같은 분류 차수에서만 가능</span>하며 이동시 소속된 <span class="rt_mint">하위 메뉴도 같이 이동</span>됩니다.</p>
</div>

<script src="<?php echo $_def['path_assets'];?>/js/product.admin.category.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>
