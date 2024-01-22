<?php include "../../_head.php"; ?>
    <div class="popup_layer">
        <h3>제품 구매 상담</h3>
	<button class="c_btn"><img src="/assets/images/pop_cl.png"></button>
<form name="dataform" action="./sendmail.php" method="post" target="rt_ifrm">
<input type="hidden" name="mode" value="inquiry">
<input type="hidden" name="model" value="OA-200">
        <dl>
            <dt>이름</dt>
            <dd><input type="text" name="name"></dd>
        </dl>
        <dl>
            <dt>회사명</dt>
            <dd><input type="text" name="company"></dd>
        </dl>
        <dl>
            <dt>연락처</dt>
            <dd><input type="number" name="phone"></dd>
        </dl>
        <dl>
            <dt>이메일</dt>
            <dd><input type="text" name="email"></dd>
        </dl>
        <dl>
            <dt>문의내용</dt>
            <dd><textarea name="contents" style="font-size:16px;padding-top:14px;"></textarea></dd>
        </dl>
	<small>*연락처와 이메일을 정확하게 작성해야만 상담이 가능합니다.</small>
        <div class="ck_box">
            <input type="checkbox" id="agree">
            <p>개인정보처리방침내용에 동의합니다.</p>
        </div>
        <textarea class="ta2"><?php include_once "./term.txt"; ?></textarea>
</form>
        <button class="save" onclick="gomail();">작성완료</button>
    </div>


<script charset="UTF-8">
	function gomail() {
		var f = document.dataform;
		if (f.name.value == "") {
			alert("이름을 입력해 주세요.");
			f.name.focus();
		} else if (f.company.value == "") {
			alert("회사명을 입력해 주세요.");
			f.company.focus();
		} else if (f.phone.value == "") {
			alert("연락처를 입력해 주세요.");
			f.phone.focus();
		} else if (f.email.value == "") {
			alert("이메일을 입력해 주세요.");
			f.email.focus();
		} else if (f.contents.value == "") {
			alert("문의내용을 입력해 주세요.");
			f.contents.focus();
		} else {
			if ($("#agree").is(":checked")) {
				f.submit();
			} else {
				alert("개인정보처리방침에 동의해 주세요.");
			}
		}
	}
</script>
<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>

        <section class="cont1">
            <div class="sub_wrap">
                <div class="tit_box" data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-duration="1000">
                    <h2>환경부 성능 인증 1등급</h2>
                    <p>ArimAir <b>OA200</b></p>
                </div>
                <figure class="fig_box">
                    <img src="/assets/images/OA_200.png" class="img_ab oa_200" alt="">
                </figure>
                <ul class="epl pc" data-aos="fade-up" data-aos-duration="3000">
                    <li>실외 대기질정보 실시간 측정</li>
                    <li>전용 웹사이트에서 실시간 모니터링</li>
                    <li>함체부 없는 디자인으로 더욱 편리한 설치</li>
                    <li>스마트시티, 아파트, 산업단지 등 야외시설 대상</li>
                    <li>환경부 미세먼지 간이측정기 성능인증 1등급</li>
                </ul>
                <div class="item_btn">
                    <button class="enrollment" onclick="location.href='/page/s2/sub_photo_reivew.php?ct=포토후기&cf=form'">구매후기 쓰기</button>
                    <button class="buy">제품 구매상담</button>
                </div>
            </div>
        </section>
        <section class="cont2">
            <div class="sub_wrap">
                <ul class="tit_list">
                    <li class="on">
                        <a href="#;">제품 소개</a>
                    </li>
                    <li>
                        <a href="#;">제품 사양(SPEC)</a>
                    </li>
					<?php
					$_t = $dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_RTBOARD_NORM WHERE bcode='review' AND pdt_model='OA200' AND auth_en='y'");
					?>
                    <li>
                        <a href="#;">구매 후기(<?php echo number_format($_t['cnt']);?>)</a>
                    </li>
                </ul>
            </div>
        </section>
        <div class="pro_common num1 show">
        <section class="cont3"></section>
            <div class="sub_wrap no_padding">
                <div class="item_img_box">
                    <figure>
                        <img src="/assets/images/OA_200_sub.png" alt="">
                    </figure>
                    <figcaption>
                        <h3>좋은 공기를 위한 솔루션! 아림에어</h3>
                        <p>공기 속 보이지 않는 유해물질 아림에어가 보여드리겠습니다.</p>
                    </figcaption>
                </div>
                <div class="item_spec oa_200">
                    <img src="/assets/images/OA_200_s.png" alt="" data-aos="fade-up" data-aos-duration="3000">
                    <h4 data-aos="fade-up" data-aos-duration="3000" data-aos-delay="500">ArimAir <b>OA200</b></h4>
                    <p data-aos="fade-up" data-aos-duration="3000" data-aos-delay="1000">
                        <b>심각한 대기오염, 솔루션이 필요합니다.</b><br>
			아파트, 실외, 놀이터 등 지금 숨쉬고있는 대기상태가 어떤지 실시간으로 확인하십시오.<br>
                        초미세먼지, 오존, 이산화질소, 이산화황, 온 · 습도를 측정하여 실시간 대기상태를<br>
			4단계LED로 확인하거나 전용 모니터링 웹사이트에서 확인할 수 있습니다.
                    </p>
                </div>
		<div class="sub_wrap">
                <div class="point">
                    <h4 data-aos="fade-up" data-aos-duration="3000">POINT 01</h4>
                    <p data-aos="fade-up" data-aos-duration="3000">
                        OA200은 <b>초미세먼지, 오존, 이산화질소, 이산화황,</b> 온·습도까지<br class="pc"> 
                        실외 공기 정보를 동시에 측정하는 실외용 측정기 입니다.
                    </p>
                    <dl>
                        <dt data-aos="fade-right" data-aos-easing="ease-in-sine"><img src="/assets/images/OA_200_list1.png" alt=""></dt>
                        <dd data-aos="fade-left" data-aos-easing="ease-in-sine">
                            <dl class="icon">
                                <dt class="img_size"><img src="/assets/images/OA_100_list1_icon1.png" alt=""></dt>
                                <dd class="text_size">
                                    <h5>초미세먼지</h5>
                                    <span>
                                        외부유입 뿐 아니라 실내 요리 중에도 다량 발생<br class="pc">
                                        사람의 폐까지 깊숙하게 침투
                                    </span>
                                </dd>
                            </dl>
                            <dl class="icon">
                                <dt class="img_size"><img src="/assets/images/OA_100_list1_icon2.png" alt=""></dt>
                                <dd class="text_size">
                                    <h5>오존</h5>
                                    <span>
                                        기침, 메스꺼움 등을 유발하고 기관지염, 심장질환, <br class="pc">
                                        폐기종, 천식의 악화를 유발할 수 있음. 
                                    </span>
                                </dd>
                            </dl>
                            <dl class="icon">
                                <dt class="img_size"><img src="/assets/images/OA_100_list1_icon3.png" alt=""></dt>
                                <dd class="text_size">
                                    <h5>이산화질소</h5>
                                    <span>
                                        일산화질소보다 독성이 5~7배 강하며, 안구, 피부 자극을 유발하고<br class="pc">
                                        흡입시 기침, 호흡곤란, 과호흡, 두통, 폐이상 등을 일으킴
                                    </span>
                                </dd>
                            </dl>
                            <dl class="icon">
                                <dt class="img_size"><img src="/assets/images/OA_100_list1_icon4.png" alt=""></dt>
                                <dd class="text_size">
                                    <h5>이산화황</h5>
                                    <span>
                                        눈에 염증이 생기거나 호흡기 질환이 일어난다. <br class="pc">
                                        알레르기를 일으킬 수 있으며, 산성비 등이 대표적인 오염 현상
                                    </span>
                                </dd>
                            </dl>
                        </dd>
                    </dl>
                </div>
                <div class="point">
                    <h4 data-aos="fade-up" data-aos-duration="3000">POINT 02</h4>
                    <p data-aos="fade-up" data-aos-duration="3000">
                        실외 대기정보를 실시간으로 측정하고<br class="pc"> 
                        아림에어 전용 모니터링 웹사이트를 통해 확인할 수 있습니다. 
                    </p>
                    <dl class="order">
                        <dt data-aos="fade-right" data-aos-easing="ease-in-sine"><img src="/assets/images/OA_100_list2.png" alt=""></dt>
                        <dd data-aos="fade-left" data-aos-easing="ease-in-sine">
		     	    <dl>
                                <dd>
                                    <h5>01. 4단계 상태표시 LED</h5>
                                    <span>
                                        ArimAir OA200은 실시간 대기상태를<br class="pc">
                                        제품 하단 LED를 통해 4단계로 확인할 수 있습니다. 
                                    </span>
                                </dd>
                            </dl>
                            <dl>
                                <dd>
                                    <h5>02. 전용 모니터링 웹</h5>
                                    <span>
                                        실시간 및 과거 기록을 편하게 확인할 수 있는<br class="pc">
                                        전용 모니터링 웹서비스를 제공합니다.
                                    </span>
                                </dd>
                            </dl>
                            <dl>
                                <dd>
                                    <h5>03. 공기질 DB 제공</h5>
                                    <span>
                                        실시간 대기정보 및 누적 기록을 확인할 수 있고,<br class="pc">
                                        과거 기록을 데이터로 받아 볼 수 있습니다. 
                                    </span>
                                </dd>
                            </dl>
                        </dd>
                    </dl>
                </div>
                <div class="point oa_100">
                    <h4 data-aos="fade-up" data-aos-duration="3000">POINT 03</h4>
                    <p data-aos="fade-up" data-aos-duration="3000">
                        한국원자력연구원 패밀리 기업, 아림에어의 기술로 만들어<br class="pc"> 
                        환경부 성능 평가 1등급으로 우수성이 검증된 제품입니다. 
                    </p>
                    <dl>
                        <dt data-aos="fade-right" data-aos-easing="ease-in-sine"><img src="/assets/images/OA_100_list3.png" alt=""></dt>
                        <dd data-aos="fade-left" data-aos-easing="ease-in-sine">
                            <div class="list3_text_box">
                                <p>환경부 미세먼지 간이측정기 성능인증 1등급(제 KTR-2021-45호)</p>
                                <p>환경부 녹색기술 인증(인증번호 : 제 GT-22-01507호)</p>
                                <p>환경부 녹색기술제품 확인(확인번호: 제 GTP-23-03751호)</p>
                                <ul>
                                    <li>• KC 전자파 적합 등록(등록번호 : R-R-iAR-OA200M)</li>
                                    <li>• 품질인증(Q-마크) 지정 제품(KTC, R74-2021-001)</li>
                                    <li>• 초미세먼지 포함 대기유해물질 5종 및 온도, 습도, 기압 기본 측정</li>
                                    <li>• 대기유해물질 측정항목 변경 및 제거 가능(제작사 협의 사항)</li>
                                    <li>• 전용 모니터링 웹사이트에서 실시간 및 과거 기록 데이터 확인 가능</li>
                                    <li>• 과거 기록 데이터 다운로드 가능(제작사 협의 사항)</li>
                                </ul>
                                <img src="/assets/images/OA_mark.png" alt="">
                            </div>
                        </dd>
                    </dl>
                </div>
		</div>
		                <div class="point m_b">
                    <h4 data-aos="fade-up" data-aos-duration="3000">POINT 04</h4>
                    <p data-aos="fade-up" data-aos-duration="3000">
                        함부체가 없어 어디에나 설치 가능한 편리성<br> 
                        도시의 경관과도 잘 어우러지는 디지안(굿디자인 수상) 
                    </p>
                    <dl data-aos="fade-up" data-aos-duration="3000">
                        <dt><img src="/assets/images/OA_200_list4.png" alt=""></dt>
                    </dl>
                </div>

            </div>
        </section>
        </div>
        <div class="pro_common num2">
<div class="sub_wrap">
<h3>제품사양</h3>
        <div class="table_box">
            <table>
                <colgroup>
                    <col style="width: 30%;">
                    <col style="width: 70%;">
                </colgroup>
                <thead>
                    <th>구분</th>
                    <th>ArimAir OA200</th>
                </thead>
                <tbody>
                    <tr>
                        <td>측정항목</td>
                        <td>PM2.5, NO2*, SO2*, CO*, O3*, 온도, 습도</td>
                    </tr>
                    <tr>
                        <td>PM2.5 측정 범위(정확도)</td>
                        <td>0 – 1,000 ㎍/㎥<br>
                            (공인 정확도 86.5% @0-200㎍/㎥)</td>
                    </tr>
                    <tr>
                        <td>PM10 측정 범위 (정확도)</td>
                        <td>0 - 1,000 ㎍/㎥<br>
                            (정확도 ±10%)</td>
                    </tr>
                    <tr>
                        <td>NO2 측정 범위 (정확도)</td>
                        <td>0 – 1 ppm<br>
                            (정확도 ±15%)</td>
                    </tr>
                    <tr>
                        <td>SO2 측정 범위 (정확도)</td>
                        <td>0 – 1 ppm<br>
                            (정확도 ±15%)</td>
                    </tr>
                    <tr>
                        <td>CO 측정 범위 (정확도)</td>
                        <td>0 – 10 ppm<br>
                            (정확도 ±15%)</td>
                    </tr>
                    <tr>
                        <td>O3 측정 범위 (정확도)</td>
                        <td>0 – 1 ppm<br>
                            (정확도 ±15%)</td>
                    </tr>
                    <tr>
                        <td>대기압 측정 범위 (정확도)</td>
                        <td>300 – 1,200 hPa<br>
                            (정확도 ±0.06hPa)</td>
                    </tr>
                    <tr>
                        <td>온도 측정 범위 (정확도)</td>
                        <td>-40 – 125℃<br>
                            (정확도 ±0.1℃)</td>
                    </tr>
                    <tr>
                        <td>습도 측정 범위 (정확도)</td>
                        <td>0 – 100% R.H.<br>
                            (정확도 ±1.0% R.H.)</td>
                    </tr>
                    <tr>
                        <td>제품 크기</td>
                        <td>H243mm, Ø115mm</td>
                    </tr>
                    <tr>
                        <td>제품 중량</td>
                        <td>< 2,000g</td>
                    </tr>
                    <tr>
                        <td>정격전압</td>
                        <td>DC 9-24V(proper to 12V) / 15W</td>
                    </tr>
                    <tr>
                        <td>인터페이스</td>
                        <td>Wi-Fi, RS232, RS485, LTE</td>
                    </tr>
                    <tr>
                        <td>연동 서비스</td>
                        <td>전용 모니터링 웹사이트<br>
                            (협의하에 모바일앱 연동 가능)</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <small>*협의하에 다른 종류 또는 다른 범위 측정이 가능한 센서로 교체 가능</small>
	</div>
	</div>
        <div class="pro_common num3">
            <div class="sub_wrap">
            <div class="com_reivew_list">

                    <ul class="com_list">

			<?php
			$_l = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_NORM WHERE bcode='review' AND pdt_model='OA200' AND auth_en='y' ORDER BY seq DESC LIMIT 16");
			for ($i = 0; $i < count($_l); $i++) {

				if ($_l[$i]['list_img_new']) {
					$img_src = $_l[$i]['list_img_dir'].$_l[$i]['list_img_new'];
				} else {
					//이미지 없을 경우
					$img_src = "";
				}
				$regdate = substr($_l[$i]['reg_date'],0,10);
				?>
					<li>
                        <a href="/page/s2/sub_photo_reivew.php?cf=view&seq=<?php echo $_l[$i]['seq'];?>&ct=포토후기">
                            <figure>
                                <img src="<?php echo $img_src;?>" alt="">
                            </figure>
                            <figcaption>
                                <p><?php echo rt_str_length_cut($_l[$i]['subject'],30,"..");?></p>
                                <span><?php echo $regdate;?></span>
                            </figcaption>
                        </a>
                    </li>
				<?php
			}?>

                    </ul>
				<?php if ($_t['cnt'] > 0) {?>
                <div class="review_btn_box" style="margin-top:80px;">
					<a href="/page/s2/sub_photo_reivew.php?ct=포토후기" class="itme">+전체보기</a>
                </div>
				<?php } ?>
                </div>
            </div>
            </div>
        </div>
<?php include "../../_tail.php"; ?>