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
                        <a href="/page/s2/sub_photo_reivew.php?ct=포토후기">포토후기</a>
                    </li>
                    <li>
                        <a href="/page/s2/sns_reivew.php?ct=SNS후기">SNS후기</a>
                    </li>
		    <li>
                        <a href="/page/s3/freebie.php" class="on">사은품신청</a>
                    </li>
                </ul>
            </div>
        </section>
        <section class="sub_main_cont">
            <div class="sub_wrap">

                <div class="com_reivew_list">
                    <div class="tit">
                        <h4>사은품 신청</h4>
						<!-- <a href="/page/s3/freebie.php?cf=form" class="review_btn">사은품 신청</a> -->
                    </div>
                    <?php rt_app("rtboard","display",array("req"));?>
		    
                </div>
            </div>
        </section>
<?php include "../../_tail.php"; ?>