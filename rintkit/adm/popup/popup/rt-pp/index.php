<?php
//-------------------------------------------------------------------------------------------------

require_once "../../../engine.php";

//-------------------------------------------------------------------------------------------------

if (empty($env->_get['popw']) || empty($env->_get['poph'])) {
	?><script>
		alert("올바른 접속이 아닙니다.");
		self.close();
	</script><?
	exit;
}

if (is_numeric($env->_get['seq']) && $env->_get['seq'] > 0) {
	$r = $dbo->fetch("SELECT * FROM RT_POPUP WHERE seq='".$env->_get['seq']."'");
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=1280" />

	<title>팝업위치설정</title>

	<link rel="stylesheet" href="assets/css/rt-pp.css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.11.1.js"></script>
	<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<style>
	.rt_pp_drag_box {display:none;height:<?php echo $env->_get['poph'];?>px;}
	</style>

	<script>
	jQuery(function($){
		var init_popw = <?php echo $env->_get['popw'];?>;
		var init_poph = <?php echo $env->_get['poph'];?>;
		var init_posx = <?php echo $env->_get['posx'];?>;
		var init_posy = <?php echo $env->_get['posy'];?>;
		var apply_posx = ($(window).width() / 2  - 8) + init_posx;
		$(".rt_pp_drag_box").css({
			"width":init_popw,
			"height":init_poph,
			"left":apply_posx,
			"top":init_posy
		}).show();
	});
	</script>
	<script src="assets/js/rt-pp.js"></script>

</head>
<body>
	<div class="rt_pp_hd">
		<h2>팝업 설정</h2>
		<p>가로 사이즈 : <input type="text" id="popw" class="rt_input_txt" value="<?php echo $env->_get['popw'];?>" style="width:40px;text-align:center;line-height:16px;" /></p>
		<p>가로 사이즈 : <input type="text" id="poph" class="rt_input_txt" value="<?php echo $env->_get['poph'];?>" style="width:40px;text-align:center;line-height:16px;" /></p>
		<a href="#;" id="btn-size-apply" class="result gray">사이즈 반영</a>
		<p class="rt_pp_x">X : <span id="pos_x"><?php echo $env->_get['posx'];?></span>px</p>
		<p class="rt_pp_y">Y : <span id="pos_y"><?php echo $env->_get['posy'];?></span>px</p>
		<a href="#;" id="btn-apply" class="result">팝업 정보 적용</a>
		<a href="#;" onclick="self.close();" class="close">닫기</a>
	</div>
	<div id="wrap">
		<div class="rt_pp_wrap">
			<div class="rt_pp_bg"></div>
			<div class="rt_pp_drag_box">
				<p class="rt_pp_point"></p>
				<div class="wrap">
					<span class="rt_border">
						<span class="top"></span>
						<span class="right"></span>
						<span class="bot"></span>
						<span class="left"></span>
					</span>
					<h2 class="tit">TARGET POPUP</h2>
					<p id="pop_cont" class="txt">
						가로 : <span id="sim_size_x"><?php echo $env->_get['popw'];?></span> px<br />
						세로 : <span id="sim_size_y"><?php echo $env->_get['poph'];?></span> px
						<span class="btn_wrap">
							<a href="#;" class="btn" id="btn-size-reset">사이즈 리셋</a>
						</span>
					</p>
					<p class="txt2">밑의 버튼을 잡고 움직여보세요!</p>
				</div>
			</div>
			<div class="rt_pp_center_bar"></div>
		</div>
		<iframe src="/index.php?popseq=<?php echo $env->_get['seq'];?>" width="100%" frameborder="0"></iframe>
	</div>

	<form name="dataform">
		<input type="hidden" name="pop_w" value="<?php echo $env->_get['popw'];?>">
		<input type="hidden" name="pop_h" value="<?php echo $env->_get['poph'];?>">
		<input type="hidden" name="pos_x" value="<?php echo $env->_get['posx'];?>">
		<input type="hidden" name="pos_y" value="<?php echo $env->_get['posy'];?>">
	</form>
</body>
</html>