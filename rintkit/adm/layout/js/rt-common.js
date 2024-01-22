jQuery(function($){
	$('.rt_aisde_arrow').click(function(){
		var aside_width = $('.rt_aside_wrap').css('width');
		if(aside_width == '240px'){
			$('.rt_aside_wrap,.rt_aside_bg').animate({width:'61px'});
			$('.rt_aisde_arrow img').animate({rotate: '32deg'});
			$('.rt_aisde_arrow img').animate({borderSpacing: -90 }, {step: function() {$(this).css('-webkit-transform','rotate(180deg)'); $(this).css('-moz-transform','rotate(180deg)');$(this).css('transform','rotate(180deg)');},duration:'slow'},'linear');
			$('.rt_aside_depth2_wrap').slideUp();
			$('.rt_aside_depth1').removeClass('rt_active');
			$('.rt_content_wrap').animate({paddingLeft:'95px'});
			$('.rt_aside_depth1_wrap .rt_aside_s').show();
			$('.rt_aside_wrap .rt_aside_depth1_wrap.rt_aside_depth1_logout .rt_aside_depth1').hide();
		} else{
			$('.rt_aside_wrap,.rt_aside_bg').animate({width:'240px'});
			$('.rt_aisde_arrow img').animate({borderSpacing: -90 }, {step: function() {$(this).css('-webkit-transform','rotate(0deg)'); $(this).css('-moz-transform','rotate(0deg)');$(this).css('transform','rotate(0deg)');},duration:'slow'},'linear');
			$('.rt_content_wrap').animate({paddingLeft:'275px'});
			$('.rt_aside_depth1_wrap .rt_aside_s').hide();
			$('.rt_aside_wrap .rt_aside_depth1_wrap.rt_aside_depth1_logout .rt_aside_depth1').show();
		}
	});
	$('.rt_aside_depth1').click(function(){
		var aside_width = $('.rt_aside_wrap').css('width');
		if(aside_width == '240px'){
			$(this).parent().siblings('.rt_aside_depth1_wrap').children('.rt_aside_depth2_wrap').slideUp();
			$(this).parent().siblings('.rt_aside_depth1_wrap').children('.rt_aside_depth1').removeClass('rt_active');
			$(this).next().stop().slideToggle();
			$(this).toggleClass('rt_active');
		}
	});
	$('.rt_hd_menu_wrap .rt_hd_menu')
	.on('mouseenter', function(e) {
			var parentOffset = $(this).offset(),
			relX = e.pageX - parentOffset.left,
			relY = e.pageY - parentOffset.top;
			$(this).find('span').css({top:relY, left:relX})
	})
	.on('mouseout', function(e) {
			var parentOffset = $(this).offset(),
			relX = e.pageX - parentOffset.left,
			relY = e.pageY - parentOffset.top;
		$(this).find('span').css({top:relY, left:relX})
	});
	$('[href=#]').click(function(){return false});

	$('label img').click(function(){
		$(this).prev().children('input').click();
	});
});
