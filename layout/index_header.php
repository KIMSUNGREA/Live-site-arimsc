<header class="main_index">
            <div class="main_wrap">
                <div class="header_flex_box">
                    <h1>
                        <a href="/index.php" class="main_logo">
                            <img src="/assets/images/header_logo.png" alt="아림 로고">
                        </a>
                    </h1>
                    <nav class="pc_menu pc">
                        <ul>
                            <li class="fist">
                                <a href="/page/s1/RA-300.php">PRODUCT</a>
                                <ul class="main_sub_menu">
                                    <li>
                                        <a href="/page/s1/RA-300.php">ArimAir RA300</a>
                                    </li>
                                    <li>
                                        <a href="/page/s1/RA-201.php">ArimAir RA201</a>
                                    </li>
                                    <li>
                                        <a href="/page/s1/OA-200.php">ArimAir OA200</a>
                                    </li>
                                    <li>
                                        <a href="/page/s1/OA-100.php">ArimAir OA100</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="/page/s3/sub_event.php">REVIEW</a>
                                <ul class="main_sub_menu">
                                    <li>
                                        <a href="/page/s2/best_review.php">베스트 후기</a>
                                    </li>
                                    <li>
                                        <a href="/page/s2/sub_photo_reivew.php?ct=포토후기">포토후기</a>
                                    </li>
                                    <li>
                                        <a href="/page/s2/sns_reivew.php?ct=SNS후기">SNS후기</a>
                                    </li>
				    <li>
                                        <a href="/page/s3/freebie.php">사은품신청</a>
                                    		      </li>
                                </ul>
                            </li>
                            <li>
                                <a href="/page/s3/event.php">EVENT</a>
                            </li>
                            <li>
                                <a href="/page/s4/sub_about.php">ARIM SCIENCE</a>
                                <ul class="main_sub_menu">
                                    <li>
                                        <a href="/page/s4/sub_about.php">회사소개</a>
                                    </li>
                                    <li>
                                        <a href="/page/s4/technology.php">특허 및 인증</a>
                                    </li>
                                    <li>
                                        <a href="/page/s4/contactus.php">Contact us</a>
                                    </li>
				    <li>
                                        <a href="/page/s4/notice.php">공지사항</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="https://smartstore.naver.com/arimair_/products/8430127904" target="_blank">STORE</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="login_box pc">
                        <?php if ($cls_rtm->is_login()) { ?>
                        <a href="/page/mb/mypage.php">MyPage</a> <a href="/app/rtmember/user/logout.php">Logout</a>
						<?php } else { ?>
						<a href="/page/mb/login.php">Login</a>
						<a href="/page/mb/join.php">Join Us</a>
						<?php } ?>
                    </div>
                    <div class="mob_menu mob">
                        <input type="checkbox" id="menuicon">
                        <label for="menuicon" class="ham_menu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
	    <nav class="m_menu mob">
                    <div class="login mob">
						<?php if ($cls_rtm->is_login()) { ?>
                        <a href="/page/mb/mypage.php">MyPage</a>
			<a href="/app/rtmember/user/logout.php">Logout</a>
						<?php } else { ?>
						<a href="/page/mb/login.php">로그인</a>
						<a href="/page/mb/join.php">회원가입</a>
						<a href="https://smartstore.naver.com/arimair_/products/8430127904" target="_blank">STORE</a>
						<?php } ?>
                    </div>
                    <div class="new_menu_box">
			<ul class="b_menu">
                            <li class="line">
                                <a href="/page/s1/RA-300.php">PRODUCT</a>
                            </li>
                            <li>
                                <a href="/page/s3/sub_event.php">REVIEW</a>
                            </li>
                           <li>
                                <a href="/page/s3/event.php">EVENT</a>
                            </li>
                            <li>
                                <a href="/page/s4/sub_about.php">ARIM SCIENCE</a>
                            </li>
                    	</ul>
			<div class="s_menu_list">
				<ul class="s_menu num1 show">
                            <li class="center">
                                <a href="/page/s1/RA-300.php">ArimAir RA300</a>
                            </li>
                            <li class="center">
                                 <a href="/page/s1/RA-201.php">ArimAir RA201</a>
                            </li>
                            <li class="center">
                                 <a href="/page/s1/OA-200.php">ArimAir OA200</a>
                             </li>
                             <li class="center">
                                 <a href="/page/s1/OA-100.php">ArimAir OA100</a>
                             </li>
                    	</ul>
			<ul class="s_menu num2">
			    <li>
                                <a href="/page/s3/sub_event.php">구매후기 이벤트</a>
                            </li>
                            <li>
                                <a href="/page/s2/best_review.php">베스트 후기</a>
                            </li>
                            <li>
                                 <a href="/page/s2/sub_photo_reivew.php?ct=포토후기">포토후기</a>
                            </li>
                            <li>
                                 <a href="/page/s2/sns_reivew.php?ct=SNS후기">SNS후기</a>
                             </li>
                             <li>
                                 <a href="/page/s3/freebie.php">사은품신청</a>
                             </li>
                    	</ul>
			<ul class="s_menu num4">
                             <li>
                                 <a href="/page/s4/sub_about.php">회사소개</a>
                                    	        </li>
                                    	        <li>
                                        	 <a href="/page/s4/technology.php">특허 및 인증</a>
                                    	        </li>
                                    	        <li>
                                        	 <a href="/page/s4/contactus.php">Contact us</a>
                                               </li>
		  	         <li>
                                        	 <a href="/page/s4/notice.php">공지사항</a>
                                               </li>
                    	</ul>
			</div>
					    </div>
                </nav>
        </header>