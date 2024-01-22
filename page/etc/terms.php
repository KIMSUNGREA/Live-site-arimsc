<?php include_once('../../_head.php');?>


<style type="text/css">
.privacyCake_div {width:100%;overflow:hidden;}
#privacyTab{}
#privacyTab .privacy-pagination {overflow:hidden;border-bottom:1px solid #c0c2bd;}
#privacyTab .privacy-pagination:after{display:block;clear:both;content:"";}
#privacyTab .privacy-pagination > li{float:left;width:50%;}
#privacyTab .privacy-pagination > li.pl0{padding-left:0 !important;}
#privacyTab .privacy-pagination > li > a{display:block;width:100%;min-height:22px;font-size:18px;letter-spacing:-1px;padding:15px 0;font-weight:400;background-color:#c0c2bd;color:#555;text-align:center;cursor:pointer;}
#privacyTab .privacy-pagination > li > a:hover,
#privacyTab .privacy-pagination > li > a.active{background-color:#1b70ce;color:#fff;}
#privacyTab .rt-tabs-wrap .rt-tabs{margin-bottom:50px;display:none;}
#privacyTab .rt-tabs-wrap .rt-tabs > h2{font-size:24px;border-bottom:3px solid #2e2a2b;margin:30px 0 20px;padding-bottom:20px;color:#595959;}
#privacyTab .rt-tabs-wrap .rt-tabs .rt-textarea-wrap{padding-left:15px;border:1px solid #a9a9a9;border-right:0;}
#privacyTab .rt-tabs-wrap .rt-tabs textarea{width:100%;height:680px;text-indent:10px;padding:15px 0;border:0;overflow-y:scroll; line-height:150%; font-size:15px; border-left:1px solid #fff; color:#666;}
#privacyTab .rt-tabs-wrap .rt-tabs.show{display:block;}
</style>


	<div class="rt-content">
		<!-- 이용약관 STR -->
		<div class="privacyCake_div">
			<div id="privacyTab">
				<ul class="privacy-pagination">
					<li class="pl0" ><a class="<?php echo ($_GET['tab']=="1")?"active":""?>" href="/page/etc/terms.php?tab=1">이용약관</a></li>
					<li><a href="/page/etc/terms.php?tab=2" class="<?php echo ($_GET['tab']=="2")?"active":""?>">개인정보취급방침</a></li>
				</ul>
				<div class="rt-tabs-wrap">
					<div id="tabs-1" class="rt-tabs <?php echo ($_GET['tab']=="1")?"show":""?>" >
						<h2>이용약관</h2>
						<div class="rt-textarea-wrap">
							<textarea readonly="readonly">
1. 수집하는 개인정보 항목
성명, 국적, 주소, 보훈 및 장애인 대상여부, 전화번호, 휴대전화번호, 학력, 성적, 병역, 경력, 해외 체류경험 및 연수활동, 사회활동, 어학 및 기타자격, 수상경력, 취미, 특기, 자기소개

2. 수집 및 이용 목적
채용전형의 진행, 진행단계별 결과 등 채용정보 안내 및 인재풀 구성

3. 개인정보의 보유 및 이용 기간
지원서상에 작성하신 개인정보는 회사의 인재채용을 위한 인재풀로 활용될 예정으로 채용전형 결과 통보일로부터 6개월까지 보관됩니다. 
지원자께서 삭제를 요청하실 경우 해당 개인정보는 삭제됩니다.
							</textarea>
						</div>
					</div>
					<div id="tabs-2" class="rt-tabs <?php echo ($_GET['tab']=="2")?"show":""?>">
						<h2>개인정보취급방침</h2>
						<div class="rt-textarea-wrap">
							<textarea readonly="readonly">
1. 수집하는 개인정보 항목
성명, 국적, 주소, 보훈 및 장애인 대상여부, 전화번호, 휴대전화번호, 학력, 성적, 병역, 경력, 해외 체류경험 및 연수활동, 사회활동, 어학 및 기타자격, 수상경력, 취미, 특기, 자기소개

2. 수집 및 이용 목적
채용전형의 진행, 진행단계별 결과 등 채용정보 안내 및 인재풀 구성

3. 개인정보의 보유 및 이용 기간
지원서상에 작성하신 개인정보는 회사의 인재채용을 위한 인재풀로 활용될 예정으로 채용전형 결과 통보일로부터 6개월까지 보관됩니다. 
지원자께서 삭제를 요청하실 경우 해당 개인정보는 삭제됩니다.
							</textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 이용약관 END-->
	</div>
<script type="text/javascript">
jQuery(function($){
	//tab type control
	$('.privacy-pagination li a').click(function(){
		tmp=$('.privacy-pagination a').index($(this));
		$(this).addClass('active');
		$(this).parents().siblings().children().removeClass('active');
		$('.rt-tabs-wrap .rt-tabs').eq(tmp).show().siblings().hide();
	})
})
</script>
<?php include_once('../../_tail.php');?>