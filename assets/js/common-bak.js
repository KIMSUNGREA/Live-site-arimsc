$(document).ready(function() {
	  AOS.init();
       //헤더 스크롤
$(window).scroll(function() {
    var hTop = $(this).scrollTop();
    var $header = $("header.main_index");
    var $loginBox = $("header.main_index .login_box");
    var $mobMenu = $(".mob_menu");
    var $pcMenuLinks = $("header.main_index .pc_menu > ul > li > a");
    var $mainLogoImg = $("header.main_index .main_logo img");
   

    if (hTop > 1) {
        $header.add($loginBox).add($mobMenu).add($pcMenuLinks).addClass("on");
        $mainLogoImg.attr("src", "/assets/images/footer_logo.png");
    } else {
        $header.add($loginBox).add($mobMenu).add($pcMenuLinks).removeClass("on");
        $mainLogoImg.attr("src", "/assets/images/header_logo.png");
    }
});

    // 모바일 햄버거 메뉴
    $(".ham_menu").click(function() {
        $(".m_menu").toggleClass("on");
    });

    // 모바일 메뉴 show
$(".b_menu li").click(function(){

    const num = $(this).index() + 1

    $(".s_menu").removeClass("show");
    $(".s_menu.num"+num).addClass("show");

    $(".b_menu li").removeClass("line");
    $(this).addClass("line");
})

// 프로덕트 페이지
$(".tit_list li").click(function(){

const sut = $(this).index() + 1

    $(".pro_common").removeClass("show");
    $(".pro_common.num"+sut).addClass("show");


$(".tit_list li").removeClass("on");
$(this).addClass("on");

})




    // PC 메뉴 hover시
    $('.pc_menu > ul > li').on('mouseenter', function() {
        $(this).children(".main_sub_menu").stop().slideDown();
    });

    $('.pc_menu > ul > li').on('mouseleave', function() {
        $(this).children(".main_sub_menu").stop().slideUp();
    });

    $(".m_menu > ul > li > span").click(function(){
        $(this).toggleClass("on");
        $(this).prev(".main_sub_menu").slideToggle()
    })
    var swiper = new Swiper(".mySwiper", {
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                },
		autoplay: {
   		delay: 5000,
    		disableOnInteraction: true // 쓸어 넘기거나 버튼 클릭 시 자동 슬라이드 정지.
  		}
            });

            $(document).ready(function () {
                $('.swiper-slide').eq(0).find('.text_box').addClass('on');
            });
    
            // 슬라이드 변경 시 클래스 추가 및 제거
            swiper.on('slideChange', function () {
                // 현재 슬라이드와 이전 슬라이드의 인덱스를 가져옵니다.
                var currentSlideIndex = swiper.activeIndex;
                var previousSlideIndex = swiper.previousIndex;
            
                // 현재 슬라이드와 이전 슬라이드에 클래스를 추가 및 제거합니다.
                // 2초 후에 클래스를 추가합니다.
            setTimeout(function () {
                $('.swiper-slide').eq(currentSlideIndex).find('.text_box').addClass('on');
            }, 1000); // 2초를 나타내는 2000 밀리초
                $('.swiper-slide').eq(previousSlideIndex).find('.text_box').removeClass('on');
            });

	//아림 소개 line
	$(function(){
        gsap.registerPlugin(ScrollTrigger);
        // offset.top
        var section_line = $(".history_line").offset().top;
        $(window).scroll(function(){
            var top = $(document).scrollTop() + ($(window).innerHeight()/1.2);
            var str01 = top - section_line;
            var str02 = Math.floor( str01 / $('.history_line').innerHeight() * 140 );
            var test = $('.history_line').innerHeight() * 140;
            console.log(str02);

            if(str02 >= 12){
                $('.his02').addClass('on');
                $('.line_on').css({height:15 + "%"});
            }else{
                $('.his02').removeClass('on');
                $('.line_on').css({height:0 + "%"});
        
            }
            if(str02 >= 25){
                $('.his03').addClass('on');
                $('.line_on').css({height:28 + "%"});
            }else{
                $('.his03').removeClass('on');
        
            }
            if(str02 >= 47){
                $('.his04').addClass('on');
                $('.line_on').css({height:43 + "%"});
            }else{
                $('.his04').removeClass('on');
        
            }
            if(str02 >= 56){
                $('.his05').addClass('on');
                $('.line_on').css({height:80 + "%"});
            }else{
                $('.his05').removeClass('on');
        
            }
            if(str02 >= 91){
                $('.his06').addClass('on');
                $('.line_on').css({height:100 + "%"});
            }
            else{
                $('.his06').removeClass('on');
        
            }
            $(".comm").removeClass("active");
            $(".comm.on").addClass('active');
        })
        });


//index포토후기
//const indexphoto = document.querySelector(".photo_rivew")
//gsap.from(indexphoto.children , {
//    opacity: 0,
//    y:10,
//    duration: 1,
//    delay: 1,
//    scrollTrigger: ".photo_rivew",
//    stagger: {
//        amount: 1
//    }
//})

$(".buy").click(function(){
            $(".popup_layer").fadeIn();
})
$(".c_btn, save").click(function(){
            $(".popup_layer").fadeOut();
})


});