<?php include "../../_head.php"; ?>
        <section class="cont1">
            <div class="sub_wrap">
                <div class="tit_box" data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-duration="1000">
                    <h2>환경부 성능 인증 1등급</h2>
                    <p>ArimAir <b>RA201</b></p>
                </div>
                <figure class="fig_box">
                    <img src="/assets/images/RA_201.png" class="img_ab ra_201 pc" alt="">
                    <img src="/assets/images/RA_201_ch.png" class="mob" alt="">
                </figure>
                <ul class="epl pc" data-aos="fade-up" data-aos-duration="3000">
                    <li>6가지 실내 공기질 정보 실시간 측정</li>
                    <li>어디서나 아림에어 앱으로 실시간 모니터링 가능</li>
                    <li>유해물질수치 설정 단계 이상 측정 시 실시간 알림</li>
                    <li>심플한 디자인, 미니멀한 사이즈로 더욱 편리한 사용성</li>
                    <li>영유아가정, 산후조리원, 어린이집, 실내놀이터 등 대상</li>
                </ul>
                <div class="item_btn">
                    <button class="enrollment" onclick="location.href='/page/s2/sub_photo_reivew.php?ct=포토후기&cf=form'">구매후기 쓰기</button>
                    <button class="buy" onclick="window.open('https://smartstore.naver.com/arimair_/products/8430139040');">제품 구매하기</button>
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
					$_t = $dbo->fetch("SELECT COUNT(seq) AS cnt FROM RT_RTBOARD_NORM WHERE bcode='review' AND pdt_model='RA201' AND auth_en='y'");
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
                        <img src="/assets/images/RA_201_sub.png" alt="">
                    </figure>
                    <figcaption>
                        <h3>좋은 공기를 위한 솔루션! 아림에어</h3>
                        <p>공기 속 보이지 않는 유해물질 아림에어가 보여드리겠습니다.</p>
                    </figcaption>
                </div>
                <div class="item_spec">
                    <img src="/assets/images/RA_201_s.png" alt="" data-aos="fade-up" data-aos-duration="3000">
                    <h4 data-aos="fade-up" data-aos-duration="3000" data-aos-delay="500">ArimAir <b>RA201</b></h4>
                    <p data-aos="fade-up" data-aos-duration="3000" data-aos-delay="1000">
                        실내에도 라돈, VOC 등 보이지 않는 유해물질이 존재합니다.<br>
                        <b>아림에어는 보이지 않는 유해물질을 수치로 보여드립니다.</b><br>
                        아림에어로 실시간 유해물질을 확인하여<br>
                        실내공기질을 관리하십시오.
                    </p>
                </div>
		<div class="sub_wrap">
                <div class="point">
                    <h4 data-aos="fade-up" data-aos-duration="3000">POINT 01</h4>
                    <p data-aos="fade-up" data-aos-duration="3000">
                        RA201은 <b>라돈, 초미세먼지, VOCs, 이산화탄소,</b> 온·습도까지<br class="pc"> 
                        6가지 실내 공기 정보를 동시에 측정하는 실내용 측정기 입니다. 
                    </p>
                    <dl>
                        <dt data-aos="fade-right" data-aos-easing="ease-in-sine"><img src="/assets/images/RA_201_list1.png" alt=""></dt>
                        <dd data-aos="fade-left" data-aos-easing="ease-in-sine">
                            <dl class="icon">
                                <dt class="img_size"><img src="/assets/images/RA_list1_icon1.png" alt=""></dt>
                                <dd class="text_size">
                                    <h5>라돈(RADON)</h5>
                                    <span>
                                        건축자재, 가구 등에 쓰이는 물질에서 발생<br class="pc">
                                        1급 발암물질로 알려짐
                                    </span>
                                </dd>
                            </dl>
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
                                <dt class="img_size"><img src="/assets/images/RA_list1_icon3.png" alt=""></dt>
                                <dd class="text_size">
                                    <h5>VOCs(휘발성유기화학물)</h5>
                                    <span>
                                        건축자재, 가구 등에 쓰이는 물질에서 발생<br class="pc">
                                        아토피 유발
                                    </span>
                                </dd>
                            </dl>
                            <dl class="icon">
                                <dt class="img_size"><img src="/assets/images/RA_list1_icon4.png" alt=""></dt>
                                <dd class="text_size">
                                    <h5>이산화탄소</h5>
                                    <span>
                                        환기가 오랜 시간 안했을 때 실내에 쌓임<br class="pc">
                                        집중력 저하, 나른해지는 현상
                                    </span>
                                </dd>
                            </dl>
                        </dd>
                    </dl>
                </div>
                <div class="point">
                    <h4 data-aos="fade-up" data-aos-duration="3000">POINT 02</h4>
                    <p data-aos="fade-up" data-aos-duration="3000">
                        아림에어 전용 앱을 통해 실내 공기질 측정 결과를<br class="pc"> 
                        누구나 알기 쉽게 숫자로 보여주고, 대처방법까지 알려드립니다. 
                    </p>
                    <dl class="order">
                        <dt data-aos="fade-right" data-aos-easing="ease-in-sine"><img src="/assets/images/RA_list2.png" alt=""></dt>
                        <dd data-aos="fade-left" data-aos-easing="ease-in-sine">
                            <dl>
                                <dd>
                                    <h5>01. 실시간 공기질 확인</h5>
                                    <span>
                                        아림에어 전용 모바일앱을 통해 24시간 언제, 어디서나<br class="pc">
                                        간편하게 유해물질 정보를 확인할 수 있습니다.
                                    </span>
                                </dd>
                            </dl>
                            <dl>
                                <dd>
                                    <h5>02. 알림설정 및 서비스</h5>
                                    <span>
                                        실내 공기질을 실시간으로 측정하여 유해물질이 설정수치 이상으로<br class="pc">
                                        높아지면 아림에어 전용 앱으로 알림을 전송합니다.
                                    </span>
                                </dd>
                            </dl>
                            <dl>
                                <dd>
                                    <h5>03. 실시간 및 과거기록 확인</h5>
                                    <span>
                                        설치한 공간의 실시간 공기질 수치는 물론이고<br class="pc">
                                        일간, 주간, 월간 과거 기록을 보여드립니다. 
                                    </span>
                                </dd>
                            </dl>
                        </dd>
                    </dl>
                </div>
                <div class="point">
                    <h4 data-aos="fade-up" data-aos-duration="3000">POINT 03</h4>
                    <p data-aos="fade-up" data-aos-duration="3000">
                        아림에어의 기술력으로 만들어 환경부 간이측정기<br class="pc"> 
                        성능인증제에서 1등급을 획득한 우수한 제품입니다. 
                    </p>
                    <dl>
                        <dt data-aos="fade-right" data-aos-easing="ease-in-sine"><img src="/assets/images/RA_201_list3.png" alt=""></dt>
                        <dd data-aos="fade-left" data-aos-easing="ease-in-sine">
                            <div class="list3_text_box">
                                <p>환경부 라돈 간이측정기 성능인증 1등급(제 PIA-02-2022-1호)</p>
                                <p>환경부 미세먼지 간이측정기 성능인증 1등급(제 KTR-2022-07호)</p>
                                <p>환경부 이산화탄소 간이측정기 성능인증 1등급(제 PIA-01-2023-19호)</p>
                                <ul>
                                    <li>• 환경부 녹색기술 인증(인증번호 : 제 GT-22-01507호)</li>
                                    <li>• 환경부 녹색기술제품 확인(확인번호: 제 GTP-23-03340호)</li>
                                    <li>• KC 전자파 적합 등록(등록번호 : R-R-iAR-RA201)</li>
                                    <li>• 품질인증(Q-마크) 지정 제품(KTC, R74-2021-001)</li>
                                    <li>• 라돈, 초미세먼지 포함 실내 공기질 6종 실시간 측정</li>
                                    <li>• 실내 공기질 오염 단계에 따른 상태 표시 무드등</li>
                                    <li>• 전용 모바일 앱에서 실시간 데이터 및 분석 데이터 확인 가능</li>
                                </ul>
                                <img src="/assets/images/RA_mark.png" alt="">
                            </div>
                        </dd>
                    </dl>
                </div>
		</div>
                <div class="point m_b">
                    <h4 data-aos="fade-up" data-aos-duration="3000">POINT 04</h4>
                    <p data-aos="fade-up" data-aos-duration="3000">
                        심플한 디자인과 작은 사이즈로 거실, 침실,<br> 
                        아이방 등 실내공간 어디서나 사용하기 편리합니다. 
                    </p>
                    <dl data-aos="fade-up" data-aos-duration="3000">
                        <dt><img src="/assets/images/RA_201_list4.png" alt=""></dt>
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
                    <th>ArimAir RA201</th>
                </thead>
                <tbody>
                    <tr>
                        <td>측정항목</td>
                        <td>PM2.5, 라돈, TVOC, CO2, 온도, 습도</td>
                    </tr>
                    <tr>
                        <td>PM2.5 측정 범위(정확도)</td>
                        <td>0 – 1,000 ㎍/㎥<br>
                            (공인 정확도 88.9% @0-200㎍/㎥)</td>
                    </tr>
                    <tr>
                        <td>라돈 측정 범위 (정확도)</td>
                        <td>7 – 3,700 Bq/㎥<br>
                            (공인 정확도 88.9%)</td>
                    </tr>
                    <tr>
                        <td>CO2 측정 범위 (정확도)</td>
                        <td>0 – 40,000 ppm<br>
                            (공인 정확도 74% @400-2,000ppm)</td>
                    </tr>
                    <tr>
                        <td>VOC 측정 범위 (정확도)</td>
                        <td>0 – 1,000 ppm<br>
                            (정확도 ±15%)</td>
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
                        <td>92 x 92 x 110mm<br>
                            (W x L x H)</td>
                    </tr>
                    <tr>
                        <td>제품 중량</td>
                        <td>< 400g</td>
                    </tr>
                    <tr>
                        <td>정격전압</td>
                        <td>DC 5V, 10W</td>
                    </tr>
                    <tr>
                        <td>인터페이스</td>
                        <td>Wi-Fi</td>
                    </tr>
                    <tr>
                        <td>연동 서비스</td>
                        <td>전용 모바일 앱 (Android, iOS)<br>
                            (협의하에 웹사이트 연동 가능)</td>
                    </tr>
                </tbody>
            </table>
        </div>
	</div>
	</div>
        <div class="pro_common num3">
            <div class="sub_wrap">
            <div class="com_reivew_list">

                    <ul class="com_list">

			<?php
			$_l = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_NORM WHERE bcode='review' AND pdt_model='RA201' AND auth_en='y' ORDER BY seq DESC LIMIT 16");
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