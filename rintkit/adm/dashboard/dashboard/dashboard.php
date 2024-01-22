<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>
<div class="rt_content_container m0">

	<div class="rt_m_body clearfix" id="masorny_wrap">
		<div class="rt_m_33">
			<div class="rt_m_box rt_shadow">
				<h1 class="rt_m_bar_tit">사이트 요약</h1>
				<div class="rt_site_summary clearfix">
					<p class="rt_site_summary_txt">사이트 명</p>
					<div class="rt_button_wrap">
						<span><?php echo $rt_conf_db['adm_title'];?></span>
					</div>
				</div>
				<div class="rt_site_summary clearfix">
					<p class="rt_site_summary_txt">도메인</p>
					<div class="rt_button_wrap">
						<span><?php echo $rt_conf_db['domain'];?></span>
					</div>
				</div>

				<div class="rt_site_summary clearfix">
					<p class="rt_site_summary_txt">회원정책</p>
					<div class="rt_button_wrap">
						<div class="rt_check_wrap">
							<?php if ($__mem_conf_is) {?>
							<span class="rt_red">관리자승인</span>
							<?php } else { ?>
							<span class="rt_blue">자동승인</span>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="rt_m_33">
			<div class="rt_m_box rt_shadow">
				<h1 class="rt_m_bar_tit">회원요약</h1>
				<div class="rt_bar_letter_wrap">
					<h1 class="rt_subject"><a href="#;">전체 회원 <?php echo $member_total_cnt;?>명</a></h1>
				</div>
				<div class="rt_bar_letter_wrap">
					<h1 class="rt_subject"><a href="#;">오늘 가입 회원 <?php echo $member_today_cnt;?>명</a></h1>
				</div>
				<div class="rt_bar_letter_wrap">
					<h1 class="rt_subject"><a href="#;">오늘 로그인 회원 <?php echo $member_today_login;?>명</a></h1>
				</div>
			</div>
		</div>
		
		<?php for ($m = 0; $m < count($bbs_list); $m++) { ?>
		<div class="rt_m_33">
			<div class="rt_m_box rt_shadow">
				<h1 class="rt_m_bar_tit"><?php echo $bbs_list[$m]['name']?></h1>
				<?php for ($d = 0; $d < count($bbs_data[$m]); $d++) {?>
				<div class="rt_bar_letter_wrap">
					<h1 class="rt_subject"><a href="<?php echo RTW_ADM?>/app/?appcode=rtboard&sd=theme-<?php echo $bbs_list[$m]['theme'];?>-data&cf=view&bcode=<?php echo $bbs_data[$m][$d]['bcode']?>&seq=<?php echo $bbs_data[$m][$d]['seq']?>"><?php echo rt_str_length_cut(stripslashes($bbs_data[$m][$d]['subject']),32,"..")?></a><p class="rt_writer"><?php echo $bbs_data[$m][$d]['name'];?></p></h1>
				</div>
				<?php }?>
			</div>
		</div>
		<?php }?>
	</div>
</div>