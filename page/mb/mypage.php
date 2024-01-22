<?php
include_once("../../_head.php");

$user = $cls_rtm->get_member_info();
?>
<!-- 서브 컨텐츠 박스 STR -->

        <section class="cont1">
            <div class="sub_wrap">
                <div class="tit">
                    <h2 class="mp">MY PAGE</h2>
                    <span>마이페이지</span>
                </div>
                <div class="user_name">
                    <p><?php echo $user['user_nm'];?>님 환영합니다.</p>
                </div>
                <div class="info_list">
                    <div class="user_info">
                        <div class="common_box">
                            <div class="info_tit">
                                <h3>회원정보</h3>
                            </div>
                            <div class="text_list_box">
                                <p>- 아이디 : <span><?php echo $user['user_id'];?></span></p>
                                <p>- 가입일 : <span><?php echo substr($user['reg_date'],0,10);?></span></p>
                                <p>- 내 추천인 코드 : <b><?php echo $user['recode'];?></b><a href="javascript:copyClipboard('<?php echo $user['recode'];?>')">코드복사하기</a></p>
                            </div>
                            <a href="/page/mb/mymodi.php?cf=modify">비밀정보 변경하기</a>
                        </div>
                    </div>
                    <div class="product_info">
                        <div class="common_box">
                            <div class="info_tit">
                                <h3>제품정보</h3>
                            </div>
                            <div class="text_list_box">
							<?php
							$c = $dbo->fetch_list("SELECT * FROM RT_COUPON WHERE user_id='".$user['user_id']."' AND coupon_type='a'");
							if (count($c) > 0) {
								for ($m = 0; $m < count($c); $m++) {
									?>
								<div style="background-color:#fafafa;padding:20px 5px 5px 20px;margin-top:5px;max-width:500px;">
									<p>모델명 : <span><?php echo $c[$m]['pdt_model'];?></span></p>
									<p>시리얼넘버 : <span><?php echo $c[$m]['serial_num'];?></span></p>
								</div>
									<?php
								}
							} else {
								?>
                                <p>등록된 제품이 없습니다.</p>
                                <p class="bul">구매하신 제품의 리뷰를 남겨주시면 사은품과 추천인 이벤트에 참여할 수 있습니다.</p>
								<?php
							}?>
                            </div>
                            <a href="/page/s2/sub_photo_reivew.php?ct=포토후기&cf=form&screen=pc">구매후기 작성하기</a>
                        </div>
                    </div>
                    <div class="proposal_info">
                        <div class="common_box">
                            <div class="info_tit">
                                <h3>사은품 신청</h3>
                            </div>
                            <ul class="proposal_list">
							<?php
							$cnta = $dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_COUPON WHERE user_id='".$user['user_id']."' AND coupon_type='a' AND use_is='n'");
							$cntb = $dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_COUPON WHERE user_id='".$user['user_id']."' AND coupon_type='b' AND use_is='n'");
							$cntc = $dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_COUPON WHERE user_id='".$user['user_id']."' AND coupon_type='c' AND use_is='n'");
							?>
                                <li>
                                    <figure><img src="/assets/images/mypage_list1.png" alt=""></figure>
                                    <figcaption>
                                        <p>구매후기 사은품 신청 <span><?php echo number_format($cnta['cnt']);?></span>개 보유</p>
                                    </figcaption>
                                </li>
                                <li>
                                    <figure><img src="/assets/images/mypage_list2.png" alt=""></figure>
                                    <figcaption>
                                        <p>추천인 이벤트 사은품 <span><?php echo number_format($cntb['cnt']);?></span>개 보유</p>
                                    </figcaption>
                                </li>
                                <li>
                                    <figure><img src="/assets/images/mypage_list3.png" alt=""></figure>
                                    <figcaption>
                                        <p>베스트리뷰 사은품 신청 <span><?php echo number_format($cntc['cnt']);?></span>개 보유</p>
                                    </figcaption>
                                </li>
                            </ul>
                            <a href="/page/s3/freebie.php?cf=form">사은품 신청하기</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!-- 서브 컨텐츠 박스 END -->

<script>
function copyClipboard(text){
	$("#copyTarget").text(text);
	copyToClipboard('#copyTarget');
}

function copyToClipboard(element) {
	 var $temp = $("<input>");
	  $("body").append($temp);
	  $temp.val($(element).text()).select();
	  document.execCommand("copy");
	  $temp.remove();

	  alert("추천인코드가 복사되었습니다.");
}

;(function($) {
	$(function() {
		var agent = navigator.userAgent.toLowerCase();

		if( agent.indexOf('android') > -1 ) {
			// 안드로이드인 경우
		}else if( agent.indexOf("iphone") > -1 || agent.indexOf("ipad") > -1 || agent.indexOf("ipod") > -1 ) {
			// IOS인 경우
		}else{
			// 기타
		}
	});
})(jQuery);
</script>
<?php include_once("../../_tail.php");?>
