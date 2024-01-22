<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<div class="rt_s_gnb">
	<a href="<?php echo RTW_ADM;?>/page/?sd=forward" class="rt_depth1">유입자 화면이동 규칙</a>
	<a href="<?php echo RTW_ADM;?>/page/?sd=match" class="rt_depth1">404 페이지 매칭</a>
	<a href="<?php echo RTW_ADM;?>/page/?sd=try404" class="rt_depth1">404 요청 URL</a>
	<a href="<?php echo RTW_ADM;?>/page/?sd=source" class="rt_depth1 rt_active">화면이동(고정) 링크소스</a>
</div>

<table class="rt_data_table mb30">
	<caption>화면고정 링크소스</caption>
	<colgroup>
		<col style="width:15%">
		<col style="width:85%">
	</colgroup>
	<tr>
		<th><p>솔루션 공통소스</p></th>
		<td><span>
			&lt;?php<br />
			require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";<br />
			require_once RT_ROOT."/engine.php";<br /><br />

			//페이지 환경설정<br />
			require_once RT_DOC_ROOT.$_rt_page['app_path']."/page_conf.php";<br />
			?>
		</span></td>
	</tr>
	<tr>
		<th><p>PC -> 모바일 링크</p></th>
		<td><span>&lt;a href="&lt;?php echo rt_switch_link("mobile");?&gt;" target="rt_common"&gt;모바일버전&lt;/a&gt;</span></td>
	</tr>
	<tr>
		<th><p>모바일 -> PC 링크</p></th>
		<td><span>&lt;a href="&lt;?php echo rt_switch_link("pc");?&gt;" target="rt_common"&gt;PC버전&lt;/a&gt;</span></td>
	</tr>
</table>
<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em>A 태그의 타켓은 <span class="rt_mint">rt_common</span>으로 설정해 주세요</p>
	<p><em>-</em><span class="rt_mint">href, target </span>외의 설정은 자유롭게 하셔도 됩니다.</p>
	<p><em>-</em>링크 테스트 전 <span class="rt_mint">포워딩 설정</span>이 알맞게 되어 있는지 확인해 주세요</p>
</div>