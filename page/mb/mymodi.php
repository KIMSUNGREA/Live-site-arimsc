<?php include_once("../../_head.php");?>
<!-- 서브 컨텐츠 박스 STR -->
<div class="s6">
	<article class="s61">
		<div class="con2">
			<div class="w640">
				<div class="tit_wrap mb30">
					<h3 class="txt48 ff_gmarket blue fw500 tac">My Info</h3>
				</div>
				<div class="rt-content">
			<?php rt_app("rtmember","display",array("mypage"));?> 
		</div>
			</div>
		</div>
	</article>
</div>
<!-- 서브 컨텐츠 박스 END -->
<?php include_once("../../_tail.php");?>