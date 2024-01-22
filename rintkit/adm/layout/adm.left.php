<div id="aside">
	<div class="rt_aside_bg">
		<div class="rt_aisde_arrow"><a href="#;"><img src="<?php echo RTW_LAYOUT;?>/images/common/aside_arrow.png" alt="화살표" /></a></div>
	</div>
	<ul class="rt_aside_wrap">
		<li class="rt_aside_depth1_wrap">
			<a href="//<?php echo $rt_conf_db['domain'];?>" target="_blank" class="rt_aside_s"></a>
			<a href="//<?php echo $rt_conf_db['domain'];?>" target="_blank" class="rt_aside_depth1 rt_font">내 홈페이지
				<span class="rt_aside_ico"><img src="<?php echo RTW_LAYOUT;?>/images/common/aside_homepage.png" alt="아이콘" /></span>
			</a>
		</li>
		<li class="rt_aside_depth1_wrap <?php echo $__lnb_dashboard_on;?>">
			<a href="<?php echo RTW_ADM;?>/dashboard/?sd=dashboard" class="rt_aside_s"></a>
			<a href="<?php echo RTW_ADM;?>/dashboard/?sd=dashboard" class="rt_aside_depth1 rt_font <?php echo $__lnb_dashboard_on;?>">대시보드
				<span class="rt_aside_ico"><img src="<?php echo RTW_LAYOUT;?>/images/common/aside_home.png" alt="아이콘" /></span>
			</a>
		</li>
		<li class="rt_aside_depth1_wrap <?php echo $__lnb_account_on;?>">
			<a href="#;" class="rt_aside_s"></a>
			<a href="#;" class="rt_aside_depth1 rt_font <?php echo $__lnb_account_on;?>">관리자 관리<span class="rt_aside_ico"><img src="<?php echo RTW_LAYOUT;?>/images/common/aside_people.png" alt="아이콘" /></span></a>
			<div class="rt_aside_depth2_wrap">
				<?php if ($cls_adm->auth_code == "master") { ?>
				<a href="<?php echo RTW_ADM;?>/account/?sd=master" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_account_master_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>마스터 계정 정보</span>
				</a>
				<?php } ?>
				<a href="<?php echo RTW_ADM;?>/account/?sd=account" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_account_account_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>관리자 계정 정보</span>
				</a>
			</div>
		</li>
		<li class="rt_aside_depth1_wrap <?php echo $__lnb_app_rtmember_on;?>">
			<a href="#;" class="rt_aside_s"></a>
			<a href="#;" class="rt_aside_depth1 rt_font <?php echo $__lnb_app_rtmember_on;?>">회원 관리<span class="rt_aside_ico"><img src="<?php echo RTW_LAYOUT;?>/images/common/aside_peoples.png" alt="아이콘" /></span></a>
			<div class="rt_aside_depth2_wrap">
				<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-data" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_app_rtmember_admin_data_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>전체회원</span>
				</a>
				<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-data&buy_en=n" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_app_rtmember_admin_data_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>일반회원</span>
				</a>
				<a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-data&buy_en=y" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_app_rtmember_admin_data_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>구매회원</span>
				</a>
				<!-- <a href="<?php echo RTW_ADM;?>/app/?appcode=rtmember&sd=admin-data&cf=form" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_app_rtmember_admin_data_form_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>회원 수기 등록</span>
				</a> -->
			</div>
		</li>
		<?php if ($cls_adm->auth_code == "master") { ?>
		<li class="rt_aside_depth1_wrap <?php echo $__lnb_app_rtboard_on;?>">
			<a href="#;" class="rt_aside_s"></a>
			<a href="#;" class="rt_aside_depth1 rt_font <?php echo $__lnb_app_rtboard_on;?>">게시판 관리<span class="rt_aside_ico"><img src="<?php echo RTW_LAYOUT;?>/images/common/aside_tv.png" alt="아이콘" /></span></a>
			<div class="rt_aside_depth2_wrap">
				<a href="<?php echo RTW_ADM;?>/app/?appcode=rtboard&sd=admin-board" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_app_rtboard_admin_board_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>게시판 리스트</span>
				</a>
				<a href="<?php echo RTW_ADM;?>/app/?appcode=rtboard&sd=admin-board&cf=form" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_app_rtboard_admin_board_form_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>게시판 추가</span>
				</a>
				<a href="<?php echo RTW_ADM;?>/app/?appcode=rtboard&sd=admin-group" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_app_rtboard_admin_group_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>게시판 그룹 관리</span>
				</a>
			</div>
		</li>
		<?php } else { ?>
		<li class="rt_aside_depth1_wrap <?php echo ($env->_get['bcode']=="notice" || $env->_get['bcode']=="event")?"active":"";?>">
			<a href="#;" class="rt_aside_s"></a>
			<a href="#;" class="rt_aside_depth1 rt_font">게시판 관리<span class="rt_aside_ico"><img src="<?php echo RTW_LAYOUT;?>/images/common/aside_tv.png" alt="아이콘" /></span></a>
			<div class="rt_aside_depth2_wrap">
				<a href="/rintkit/adm/app/?appcode=rtboard&sd=theme-info-data&bcode=notice" class="rt_aside_depth2 rt_font_s <?php echo ("notice" == $env->_get['bcode'])?"class='on'":"";?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>공지사항</span>
				</a>
				<a href="/rintkit/adm/app/?appcode=rtboard&sd=theme-info-data&bcode=event" class="rt_aside_depth2 rt_font_s <?php echo ("event" == $env->_get['bcode'])?"class='on'":"";?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>이벤트게시판</span>
				</a>
			</div>
		</li>
		<li class="rt_aside_depth1_wrap <?php echo (($env->_get['appcode']=="rtboard") && ($env->_get['bcode']!="notice" && $env->_get['bcode']!="event"))?"active":"";?>">
			<a href="#;" class="rt_aside_s"></a>
			<a href="#;" class="rt_aside_depth1 rt_font">후기 관리<span class="rt_aside_ico"><img src="<?php echo RTW_LAYOUT;?>/images/common/aside_tv.png" alt="아이콘" /></span></a>
			<div class="rt_aside_depth2_wrap">
				<a href="/rintkit/adm/app/?appcode=rtboard&sd=theme-norm-data&bcode=review&ctgr=포토후기" class="rt_aside_depth2 rt_font_s <?php echo ("review" == $env->_get['bcode'])?"class='on'":"";?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>구매후기</span>
				</a>
				<a href="/rintkit/adm/app/?appcode=rtboard&sd=theme-norm-data&bcode=review&best=y" class="rt_aside_depth2 rt_font_s <?php echo ("review" == $env->_get['bcode'] && $env->_get['best']=="y")?"class='on'":"";?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>베스트후기</span>
				</a>
				<a href="/rintkit/adm/app/?appcode=rtboard&sd=theme-qna-data&bcode=req" class="rt_aside_depth2 rt_font_s <?php echo ("req" == $env->_get['bcode'])?"class='on'":"";?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>사은품신청목록</span>
				</a>
				<a href="/rintkit/adm/app/?appcode=rtboard&sd=theme-qna-data&bcode=req&give=y" class="rt_aside_depth2 rt_font_s <?php echo ("req" == $env->_get['bcode'])?"class='on'":"";?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>사은품지급목록</span>
				</a>
			</div>
		</li>
		<?php } ?>
		<li class="rt_aside_depth1_wrap <?php echo $__lnb_page_on;?>">
			<a href="#;" class="rt_aside_s"></a>
			<a href="#;" class="rt_aside_depth1 rt_font <?php echo $__lnb_page_on;?>">사이트 관리<span class="rt_aside_ico"><img src="<?php echo RTW_LAYOUT;?>/images/common/aside_page.png" alt="아이콘" /></span></a>
			<div class="rt_aside_depth2_wrap">
				<?php if ($cls_adm->auth_code == "master") { ?>
				<a href="<?php echo RTW_ADM;?>/page/?sd=sitemap" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_page_sitemap_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>사이트 관리</span>
				</a>
				<?php } ?>
				<a href="<?php echo RTW_ADM;?>/page/?sd=conf" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_page_conf_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>사이트 관리</span>
				</a>
				<?php if ($cls_adm->auth_code == "master") { ?>
				<a href="<?php echo RTW_ADM;?>/page/?sd=forward" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_page_forward_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>포워딩 환경 설정</span>
				</a>
				<a href="<?php echo RTW_ADM;?>/page/?sd=code" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_page_code_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>전체 연동 소스</span>
				</a>
				<?php } ?>
			</div>
		</li>
		<!-- <li class="rt_aside_depth1_wrap <?php echo $__lnb_content_on;?>">
			<a href="#;" class="rt_aside_s"></a>
			<a href="#;" class="rt_aside_depth1 rt_font <?php echo $__lnb_content_on;?>">디자인 콘텐츠 관리<span class="rt_aside_ico"><img src="<?php echo RTW_LAYOUT;?>/images/common/aside_bulb.png" alt="아이콘"/></span></a>
			<div class="rt_aside_depth2_wrap">
				<a href="<?php echo RTW_ADM;?>/content/?sd=content" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_content_content_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>콘텐츠 리스트</span>
				</a>
				<a href="<?php echo RTW_ADM;?>/content/?sd=group" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_content_group_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>콘텐츠 그룹 관리</span>
				</a>
			</div>
		</li> -->
		<li class="rt_aside_depth1_wrap <?php echo $__lnb_popup_on;?>">
			<a href="#;" class="rt_aside_s"></a>
			<a href="#;" class="rt_aside_depth1 rt_font <?php echo $__lnb_popup_on;?>">팝업 관리<span class="rt_aside_ico"><img src="<?php echo RTW_LAYOUT;?>/images/common/aside_popup.png" alt="아이콘"/></span></a>
			<div class="rt_aside_depth2_wrap">
				<a href="<?php echo RTW_ADM;?>/popup/?sd=popup&cf=list" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_popup_popup_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>팝업 관리</span>
				</a>
				<a href="<?php echo RTW_ADM;?>/popup/?sd=formtpl&cf=list" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_popup_formtpl_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>팝업 템플릿 관리</span>
				</a>
			</div>
		</li>
		<?php if ($cls_adm->auth_code == "master") { ?>
		<li class="rt_aside_depth1_wrap <?php echo $__lnb_appsetup_on;?>">
			<a href="<?php echo RTW_ADM;?>/appsetup/?sd=applist&cf=list" class="rt_aside_s"></a>
			<a href="<?php echo RTW_ADM;?>/appsetup/?sd=applist&cf=list" class="rt_aside_depth1 rt_font <?php echo $__lnb_appsetup_on;?>">APP 관리<span class="rt_aside_ico"><img src="<?php echo RTW_LAYOUT;?>/images/common/aside_app.png" alt="아이콘"/></span></a>
		</li>
		<?php } ?>
		<!-- <li class="rt_aside_depth1_wrap <?php echo $__lnb_confs_on;?>">
			<a href="#;" class="rt_aside_s"></a>
			<a href="#;" class="rt_aside_depth1 rt_font <?php echo $__lnb_confs_on;?>">환경 설정<span class="rt_aside_ico"><img src="<?php echo RTW_LAYOUT;?>/images/common/aside_set.png" alt="아이콘"/></span></a>
			<div class="rt_aside_depth2_wrap">
				<?php if ($cls_adm->auth_code == "master") { ?>
				<a href="<?php echo RTW_ADM;?>/company/?sd=company" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_company_company_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>회사 정보 설정</span>
				</a>
				<a href="<?php echo RTW_ADM;?>/source/?sd=source" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_source_source_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>외부 소스 관리</span>
				</a>
				<a href="<?php echo RTW_ADM;?>/ipset/" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_ipset_list_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>관리자 접속IP 관리</span>
				</a>
				<a href="<?php echo RTW_ADM;?>/config/?sd=config" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_config_config_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>시스템 환경 정보</span>
				</a>
				<?php } ?>
				<a href="<?php echo RTW_ADM;?>/gnb/?sd=gnb" class="rt_aside_depth2 rt_font_s <?php echo $__lnb_gnb_gnb_on;?>">
					<span class="rt_aside_depth2_txt"><span class="rt_dot"></span>관리자 상단 메뉴 설정</span>
				</a>
			</div>
		</li> -->
		<li class="rt_aside_depth1_wrap rt_aside_depth1_logout">
			<a href="<?php echo RTW_ADM;?>/login/logout.php" class="rt_aside_s"><img src="<?php echo RTW_LAYOUT;?>/images/common/logout_ico.png" alt="아이콘" /></a>
			<a href="<?php echo RTW_ADM;?>/login/logout.php" class="rt_aside_depth1 rt_font">LOGOUT
				<span class="rt_aside_ico"><img src="<?php echo RTW_LAYOUT;?>/images/common/logout_ico.png" alt="아이콘" /></span>
			</a>
		</li>
	</ul>
</div>