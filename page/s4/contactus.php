<?php include "../../_head.php"; ?>
        <section class="cont1">
            <div class="sub_wrap">
                <div class="tit">
                    <h2>ABOUT ARIM</h2>
                    <span>오시는 길</span>
                </div>
                <ul class="sub_menu_list">
                    <li>
                        <a href="sub_about.php">회사소개</a>
                    </li>
                    <li>
                        <a href="technology.php">특허 및 인증</a>
                    </li>
                    <li>
                        <a href="contactus.php" class="on">Contact us</a>
                    </li>
					<li>
                        <a href="notice.php">공지사항</a>
                    </li>
                </ul>
            </div>
        </section>
        <section class="rivew_guide">
            <div class="sub_wrap">
                <div class="sub_tit">
                    <h3>CONTACT US</h3>
                </div>
                <div class="sub_absence">
                </div>
                <div class="kakao_map">
		    <div id="daumRoughmapContainer1701422821241" class="root_daum_roughmap root_daum_roughmap_landing" style="width: 100%;"></div>
                    <div class="map_info">
                        <dl>
                            <dt>Address</dt>
                            <dd class="txt16 fw300">대전 대덕구 대화로106번길 66<br>펜타플렉스 918호</dd>
                        </dl>
                        <dl>
                            <dt>E-mail</dt>
                            <dd class="txt16 ff_gmarket">arimsc@arimsc.com</dd>
                        </dl>
                        <dl>
                            <dt>Tel</dt>
                            <dd class="txt16 ff_gmarket">042·389·0059</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </section>
        <section class="send">
            <div class="sub_wrap">
                <div class="send_box">
                    <img src="/assets/images/contect.jpg" alt="">
                    <div class="contact_box">
                    <form name="dataform" action="/page/s4/send_mail.php" method="post" target="rt_ifrm">
                    <input type="hidden" name="mode" value="inquiry">
                            <div class="name">
                                <p>Your Name(*)</p>
                                <input type="text" name="name">
                            </div>
                            <div class="email">
                                <p>Your Email(*)</p>
                                <input type="text" name="email">
                            </div>
                            <div class="subject">
                                <p>Subject</p>
                                <input type="text" name="subject">
                            </div>
                            <div class="message">
                                <p>Message</p>
                                <textarea name="contents"></textarea>
                            </div>
                    </form>
                    <a href="javascript:gomail();">SEND</a>
                    </div>
                </div>
            </div>
        </section>

<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
<!-- 카카오맵 -->
<script charset="UTF-8">
	new daum.roughmap.Lander({
		"timestamp" : "1701422821241",
		"key" : "2h2ut",
		//"mapWidth" : "",
		"mapHeight" : "840"
	}).render();

	function gomail() {
		var f = document.dataform;
		if (f.name.value == "") {
			alert("성함을 입력해 주세요.");
			f.name.focus();
		} else if (f.email.value == "") {
			alert("이메일을 입력해 주세요.");
			f.email.focus();
		} else if (f.subject.value == "") {
			alert("제목을 입력해 주세요.");
			f.subject.focus();
		} else if (f.contents.value == "") {
			alert("문의내용을 입력해 주세요.");
			f.contents.focus();
		} else {
			f.submit();
		}
	}
	AOS.init();
</script>
<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>
		<?php include "../../_tail.php"; ?>