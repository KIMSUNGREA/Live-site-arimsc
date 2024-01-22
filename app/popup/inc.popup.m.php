<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 사용자 팝업 소스 출력(모바일)
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

$today = date("Y-m-d");
$arr_pop = $dbo->fetch("SELECT * FROM RT_POPUP WHERE is_view='y' AND date_start <= '".$today."' AND date_end >= '".$today."' ORDER BY seq DESC LIMIT 1");

if (is_numeric($arr_pop['seq'])) {
?>

<div class="m_popup_wrap">
	<div class="m_popup_con">
	<?php
	if ($arr_pop['content_type'] == "img") {
		if ($arr_pop['file1_new']) {
			if ($arr_pop['link_is']=="y") {

				if ($arr_pop['link_type']=="url") {

					?><img src="<?php echo $arr_pop['file_subdir'];?>/<?php echo $arr_pop['file1_new'];?>" border="0" onclick="location.href='<?php echo $arr_pop['link_url'];?>'"><?

				} else if ($arr_pop['link_type']=="map") {

					?>
					<img src="<?php echo $arr_pop['file_subdir'];?>/<?php echo $arr_pop['file1_new'];?>" border="0" usemap="#popmap<?php echo $arr_pop['seq'];?>">
					<map name="popmap<?php echo $arr_pop['seq'];?>" id="popmap<?php echo $arr_pop['seq'];?>">
					<?php echo $arr_pop['link_map'];?>
					</map>
					<?

				} else {

					?><img src="<?php echo $arr_pop['file_subdir'];?>/<?php echo $arr_pop['file1_new'];?>" border="0"><?
				}

			} else {

				?><img src="<?php echo $arr_pop['file_subdir'];?>/<?php echo $arr_pop['file1_new'];?>" border="0"><?
			}
		}
	} else if ($arr_pop['content_type'] == "html") {
		echo rt_dbstr_decode($arr_pop['content_html']);
	}
	?>
	</div>
	<div class="m_popup_foot clearfix">
		<div class="m_popup_close_day">
			<label>
				<input type="checkbox" />
				<span>오늘 하루 열지않기.</span>
			</label>
		</div>
		<div class="m_popup_close">
			<a href="#;">닫기 <span>X</span></a>
		</div>
	</div>
</div>

<?php } ?>