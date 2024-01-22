<script>
$(function(){
	// event slider
	var swiper1 = new Swiper(".event_slider", {
		loop: true,
		autoplay: {
			delay: 3000,
			disableOnInteraction: true // 쓸어 넘기거나 버튼 클릭 시 자동 슬라이드 정지.
		}
	});

	$(".swiper-container").each(function(index, element){
		var $this = $(this);
		$this.addClass('instance-' + index);

		var swiper2 = new Swiper('.instance-' + index, {
			observer: true,
			observeParents: true,
			slidesPerView : 5,
			navigation: {
				nextEl: $('.instance-' + index).siblings('.swiper-button-next'),
				prevEl: $('.instance-' + index).siblings('.swiper-button-prev'),
			},
			scrollbar: {
				el: $('.instance-' + index).siblings('.swiper-scrollbar'),
				hide: false,
			},
			watchOverflow: true
		});
	});

});


</script>
<style>
.mySwiper {
    position: relative;
    width: 100%;
}

</style>   



  <section class="cont">
        <div class="main_wrap">
            <div class="cont_text" data-aos="fade-right" data-aos-offset="100" data-aos-easing="ease-in-sine">
                 <h2>EVENT</h2>
                 <p>제품 등록하고 선물받기 | 제품 추천하고 상품권 받자!</p>
             </div>
            
             <div class="swiper event_slider mySwiper">
                <div class="swiper-wrapper">
                 <div class="swiper-slide">
                 <div class="event_list">
                    <h4 data-aos="fade-right" data-aos-easing="ease-in-sine" style="background-color:#2565e4;">아림에어 EVENT01</h4>
                    <figure>
                        <img src="/assets/images/event_img1.png" alt="" class="event_img" data-aos="fade-left" data-aos-easing="ease-in-sine">
                    </figure>
                    <p data-aos="fade-right" data-aos-easing="ease-in-sine">
                        아림에어<br>
                        고객리뷰 이벤트
                    </p>
                    <span data-aos="fade-right" data-aos-easing="ease-in-sine">
                        아림에어 제품을 구매하셨나요?<br>
                        홈페이지 구매후기를 남겨주시면 구매후기 선물은 물론<br>
                        베스트 후기로 선정 시 3만원 상품권까지 드립니다.
                    </span>
                    <a href="/page/s3/event.php?cf=view&seq=8&pg=1" class="more_view_b" data-aos="fade-right" data-aos-easing="ease-in-sine">더보기</a>
                </div>
             </div>
                
             <div class="swiper-slide">
                 <div class="event_list">
                    <h4 data-aos="fade-right" data-aos-easing="ease-in-sine">아림에어 EVENT02</h4>
                    <figure>
                        <img src="/assets/images/event_img.png" alt="" class="event_img" data-aos="fade-left" data-aos-easing="ease-in-sine">
                    </figure>
                    <p data-aos="fade-right" data-aos-easing="ease-in-sine">
                        아림 에어<br>
                        고객 추천이벤트
                    </p>
                    <span data-aos="fade-right" data-aos-easing="ease-in-sine">
                        아림에어 제품에 만족하셨나요?<br>
                        홈페이지에 제품 등록 후 추천인 코드를 받아 추천해 주세요!<bR>
                        추천받으신 분이 제품을 구매하시면 4만원 상품권 증정합니다.
                    </span>
                    <a href="/page/s3/event.php?cf=view&seq=9&pg=1" class="more_view_b" data-aos="fade-right" data-aos-easing="ease-in-sine">더보기</a>
                </div>
             </div>
            
           </div>
           </div>
            </div>
        </section>
        
 