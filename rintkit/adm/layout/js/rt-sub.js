jQuery(function($){
	$('.rt_tem_code_con .rt_button_wrap a').click(function(){
		var tmp = $(this).index() - 1;
		$(this).addClass('rt_btn_dark').siblings().removeClass('rt_btn_dark');
		if(tmp == '-1'){
			$(this).parent().next().children().show();
		} else {
			$(this).parent().next().children().eq(tmp).show().siblings().hide();
		}
	});
	$('.rt_tem_code_wrap .tit_wrap .rt_button_wrap a').click(function(){
		var tmp = $(this).index();
		$(this).addClass('rt_btn_dark').siblings().removeClass('rt_btn_dark').addClass('rt_btn_gray');
		$('.rt_tem_code_area .rt_tem_code_con').eq(tmp).show().siblings().hide();
	});
	$('#masorny_wrap').masonry({
		 // set itemSelector so .grid-sizer is not used in layout
		itemSelector: '#masorny_wrap > div,#masorny_wrap > div',
		// use element for option
		columnWidth: '#masorny_wrap > div',
		percentPosition: true
	});
	$(document).ready(function(){
		$('.rt_pager_admin_area .rt_popup_open').click(function(){
			$(this).parent().siblings('.rt_popup_wrap').show();
		});
	});
});