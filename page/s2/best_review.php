<?php include "../../_head.php"; ?>
        <section class="cont1">
            <div class="sub_wrap">
                <div class="tit">
                    <h2>BEST REVIEW</h2>
                    <span>베스트 후기</span>
                </div>
                <ul class="sub_menu_list">
                    <li>
                        <a href="/page/s2/sub_best_rivew.php" class="on">베스트후기</a>
                    </li>
                    <li>
                        <a href="/page/s2/sub_photo_reivew.php?ct=포토후기">포토후기</a>
                    </li>
                    <li>
                        <a href="/page/s2/sns_reivew.php?ct=SNS후기">SNS후기</a>
                    </li>
		    <li>
                        <a href="/page/s3/freebie.php">사은품 신청</a>
                    </li>
                </ul>
            </div>
        </section>
        <section class="sub_main_cont">
            <div class="sub_wrap">
                <div class="main_box hei">
                    <img src="/assets/images/best_review_img.png" alt="">
                    <div class="main_tit df">
                        <div class="text1" data-aos="fade-up" data-aos-duration="3000"><img src="/assets/images/sub_img_tit.png" alt=""></div>
                        <div class="text2" data-aos="fade-up" data-aos-duration="3000" data-aos-delay="500"><img src="/assets/images/sub_img_tit2.png" alt=""></div>
                    </div>
                </div>
                <div class="com_reivew_list">
                    <div class="tit">
                        <h4>베스트 후기</h4>
                    </div>
					<?php rt_app("rtboard","display",array("review"));?>
                </div>
            </div>
        </section>
<?php include "../../_tail.php"; ?>