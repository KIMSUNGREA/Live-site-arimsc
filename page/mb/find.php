<style>
.rt-rwd-login-box input[type="text"],
.rt-rwd-login-box input[type="password"]{width:100%;height:55px;line-height:55px;padding:0 5px;font-size:13px !important;background-color:#f9f9f9;border:1px solid #d8d8d8;font-family: inherit; font-size: inherit; width:100% !important;}
.rt-rwd-login-box .rt-rwd-login-send{display:block;text-align:center;height:55px;line-height:55px;font-size:20px;color:#1d4ca1;background:#fff; border:2px solid #1d4ca1; transition: .25s; width:100% !important; float: right; margin-right: 0;}

</style>


<?php include_once("../../_head.php");?>
<!-- 서브 컨텐츠 박스 STR -->
<div class="s6">
	<article class="s61">
		<div class="con2">
			<div class="w640">
				<div class="tit_wrap mb30">
					<h3 class="txt48 ff_gmarket blue fw500 tac">LOGIN ARIM SCIENCE</h3>
					<p class="txt24 fw500 lh15 mt20 tac" style="color:#4a4a4a;">Happy Life, Clean Air<bR>
깨끗한 공기에서 아림사이언스에서 확인하세요!</p>
				</div>
				<div class="rt-content">
			      <?php rt_app("rtmember","display",array("find"));?> 
		        </div>
			</div>
		</div>
	</article>
</div>
<!-- 서브 컨텐츠 박스 END -->
<?php include_once("../../_tail.php");?>