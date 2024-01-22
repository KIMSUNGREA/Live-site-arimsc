<?
if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

require_once RT_DOC_ROOT.RTW_ADM."/popup/popup/inc.common.menu.php";
?>

<table class="rt_data_table mb25">
	<caption>설치 소스</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>솔루션 공통소스</p></th>
			<td>
				&lt;?php<br />
				require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";<br />
				require_once RT_ROOT."/engine.php";<br /><br />

				//페이지 환경설정<br />
				require_once RT_DOC_ROOT.$_rt_page['app_path']."/page_conf.php";<br />
				?>
			</td>
		</tr>
		<tr>
			<th><p>팝업 연동 소스</p></th>
			<td>
				&lt;?php include_once(RT_DOC_ROOT.$_rt_popup['app_path'].'/inc.popup.php');?>
			</td>
		</tr>
	</tbody>
</table>
<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em><span class="rt_mint">솔루션 공통 소스</span>는 모든 페이지의 최상단에 포함되어 있어야 합니다.</p>
	<p><em>-</em>메인페이지 &lt;/body>태그 위에 <span class="rt_mint">팝업 연동 소스</span>를 복사해 삽입해 주세요.</p>
</div>