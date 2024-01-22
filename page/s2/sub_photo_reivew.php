<?php include "../../_head.php"; ?>
        <section class="cont1">
            <div class="sub_wrap">
                <div class="tit">
                    <h2>PHOTO REVIEW</h2>
                    <span>포토 후기</span>
                </div>
                <ul class="sub_menu_list">
                    <li>
                        <a href="/page/s2/best_review.php">베스트후기</a>
                    </li>
                    <li>
                        <a href="/page/s2/sub_photo_reivew.php?ct=포토후기" class="on">포토후기</a>
                    </li>
                    <li>
                        <a href="/page/s2/sns_reivew.php?ct=SNS후기">SNS후기</a>
                    </li>
		    <li>
                        <a href="/page/s3/freebie.php">사은품신청</a>
                    </li>
                </ul>
            </div>
        </section>
        <section class="sub_main_cont">
            <div class="sub_wrap">
                <div class="main_box max" style="display:<?php echo ($env->_get['cf'])?"none":"";?>;">
                    <div class="back_g"></div>
                    <div class="main_tit wid">
                        <h3 class="df">
                            구매 후기 이벤트 참가 방법
                        </h3>
                        <ul class="clc">
                            <li data-aos="fade-up" data-aos-duration="3000" data-aos-delay="0">
                                <figure>
                                    <img src="/assets/images/sub_m_img1.png" alt="">
                                </figure>
                                <figcaption>
                                    <p>
                                        모델과 <b>시리얼넘버 확인</b> 후<br>
                                        아림에어 회원 가입
                                    </p>
                                </figcaption>
                            </li>
                            <li data-aos="fade-up" data-aos-duration="3000" data-aos-delay="500">
                                <figure>
                                    <img src="/assets/images/sub_m_img2.png" alt="">
                                </figure>
                                <figcaption>
                                    <p>
                                        구매후기 버튼을 클릭 후<br>
                                        <b>사용후기 작성</b>
                                    </p>
                                </figcaption>
                            </li>
                            <li data-aos="fade-up" data-aos-duration="3000" data-aos-delay="1000">
                                <figure>
                                    <img src="/assets/images/sub_m_img3.png" alt="">
                                </figure>
                                <figcaption>
                                    <p>
                                        후기작성 완료 후<br>
                                        <b>30일 이내 사은품 신청</b>
                                    </p>
                                </figcaption>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="com_reivew_list">
					<?php if ($_GET['cf'] != "form") { ?>
					<a href="/page/s2/sub_photo_reivew.php?ct=포토후기&cf=form&screen=pc" class="review_btn">포토후기 쓰기</a>
					<?php } ?>
                    <div class="tit">
                        <h4>포토후기</h4>
                    </div>
                    <?php rt_app("rtboard","display",array("review"));?>
                </div>
            </div>
        </section>
<?php include "../../_tail.php"; ?>