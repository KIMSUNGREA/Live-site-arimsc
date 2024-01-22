<?php
//-----------------------------------------------------------------------------------------
// 프로그램			: RINT-KIT
// 제작				: 린트킷(rintkit.com)
// 버전				: 1.0
// 인코딩			: UTF-8
// 설명				: PRODUCT LEFT SKIN - TYPE 1
//					: 이 스킨은 좌단 메뉴에 2차분류까지만 출력가능합니다.
//					  좌단 메뉴에서 3차이상 출력해야 하는 경우 별도의 스킨을 제작해야 합니다.
//					: 복사 후 환경설정을 변경하여 사용합니다.
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-----------------------------------------------------------------------------------------
/**
 * 환경 설정(수정 O)
 */
//-----------------------------------------------------------------------------------------

$_wg_conf = array();

$_wg_conf['setpage'] = "/page/s5/s_1.php"; //제품 모듈 설치 페이지 URL을 입력해 주세요.

//-----------------------------------------------------------------------------------------
/**
 * 프로그램 설정(수정 X)
 */
//-----------------------------------------------------------------------------------------

//현재 선택 분류
if (empty($env->_get['c'])) {
	$tmpq = $dbo->fetch("SELECT * FROM RT_CATEGORY WHERE groupcode='PRODUCT' AND parent='0' ORDER BY sort ASC LIMIT 1");
	$autoct = $dbo->fetch("SELECT * FROM RT_CATEGORY WHERE groupcode='PRODUCT' AND parent='".$tmpq['code']."' ORDER BY sort ASC LIMIT 1");
	$_wg_conf['cate'] = $autoct['code'];
} else {
	$_wg_conf['cate'] = $env->_get['c'];
}

// 선택 분류 데이터 세팅
$nowct = $dbo->fetch("SELECT * FROM RT_CATEGORY WHERE groupcode='PRODUCT' AND code='".$_wg_conf['cate']."'");

//분류 데이터 세팅
$_wg_ct1 = array(); //1차 분류 데이터
$_wg_ct2 = array(); //2차 분류 데이터
$ct1 = $dbo->fetch_list("SELECT * FROM RT_CATEGORY WHERE groupcode='PRODUCT' AND parent='0' ORDER BY sort ASC");
for ($m = 0; $m < count($ct1); $m++) {
	$_wg_ct1[$m]['1차분류코드'] = $ct1[$m]['code'];
	$_wg_ct1[$m]['1차분류명'] = $ct1[$m]['label'];
	$_wg_ct1[$m]['1차분류활성'] = ($nowct['parent']==$ct1[$m]['code'])?"active":"";

	$ct2 = $dbo->fetch_list("SELECT * FROM RT_CATEGORY WHERE groupcode='PRODUCT' AND parent='".$ct1[$m]['code']."' ORDER BY sort ASC");
	for ($j = 0; $j < count($ct2); $j++) {
		$_wg_ct2[$ct2[$j]['parent']][$j]['2차분류코드'] = $ct2[$j]['code'];
		$_wg_ct2[$ct2[$j]['parent']][$j]['2차분류명'] = $ct2[$j]['label'];
	}
}

//-----------------------------------------------------------------------------------------
/**
 * 이하 스킨 HTML(사용자 설정 - 수정 O)
 */
//-----------------------------------------------------------------------------------------
?>

<div class="rt_product_menu_wrap">
	<div class="rt_product_tit"><h1>제품 소개</h1></div>
	<ul class="rt_product_menu_con">
		<?php
		for ($m = 0; $m < count($_wg_ct1); $m++) {
			?>
		<li class="rt_depth1_wrap <?php echo $_wg_ct1[$m]['1차분류활성'];?>"><a href="#;" class="rt_depth1"><span class="rt_depth1_txt"><?php echo $_wg_ct1[$m]['1차분류명'];?></span></a>
			<ul class="rt_depth2_wrap">
			<?php
			$_p = $_wg_ct1[$m]['1차분류코드'];
			for ($j = 0; $j < count($_wg_ct2[$_p]); $j++) {
				?><li class="rt_depth2_con"><a href="<?php echo $_wg_conf['setpage'];?>?c=<?php echo $_wg_ct2[$_p][$j]['2차분류코드']?>" class="rt_depth2">- <?php echo $_wg_ct2[$_p][$j]['2차분류명'];?></a></li><?php
			}
			?>
			</ul>
		</li>
			<?php
		} ?>
	</ul>
</div>

<script type="text/javascript">
jQuery(function($){
	$('.rt_product_menu_con .rt_depth1').click(function(){
		$(this).parent().siblings().children('.rt_depth1').removeClass('active');
		$(this).parent().siblings().children('.rt_depth2_wrap').slideUp();
		$(this).toggleClass('active');
		$(this).next().stop().slideToggle();
	})
})
</script>