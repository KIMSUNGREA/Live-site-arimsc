<?php include "../../_head.php"; ?>
        <section class="cont1">
            <div class="sub_wrap">
                <div class="tit">
                    <h2>ABOUT ARIM</h2>
                    <span>공지사항</span>
                </div>
                <ul class="sub_menu_list">
                    <li>
                        <a href="sub_about.php">회사소개</a>
                    </li>
                    <li>
                        <a href="technology.php">특허 및 인증</a>
                    </li>
                    <li>
                        <a href="contactus.php">Contact us</a>
                    </li>
					<li>
                        <a href="notice.php" class="on">공지사항</a>
                    </li>
                </ul>
            </div>
        </section>

        <section class="rivew_guide">
            <div class="sub_wrap">

				<?php rt_app("rtboard","display",array("notice"));?>

            </div>
        </section>

<?php include "../../_tail.php"; ?>