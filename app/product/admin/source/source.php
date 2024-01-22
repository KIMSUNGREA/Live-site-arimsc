<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>공통 소스(필수)</h1>
</div>
<table class="rt_data_table">
	<caption>게시판 연동</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>솔루션 공통소스</p></th>
			<td>
				<p>
				&lt;?php<br />
				require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";<br />
				require_once RT_ROOT."/engine.php";<br /><br />

				//페이지 환경설정<br />
				require_once RT_DOC_ROOT.$_rt_page['app_path']."/page_conf.php";<br />
				?>
				</p>
			</td>
		</tr>
	</tbody>
</table>

<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>제품 모듈 연동</h1>
</div>
<table class="rt_data_table">
	<caption>제품 모듈 연동</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>제품 모듈 연동소스</p></th>
			<td>
				<p>&lt;?php rt_app("product","display");?></p>
			</td>
		</tr>
	</tbody>
</table>

<div class="rt_s_tit clearfix">
	<p>03<span></span></p>
	<h1>위젯 연동</h1>
</div>
<table class="rt_data_table">
	<caption>위젯 연동</caption>
	<colgroup>
		<col style="width:15%"/>
		<col style="width:85%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><p>위젯 연동 소스</p></th>
			<td>
				<p>&lt;?php rt_product_widget("스킨파일명");?></p>
			</td>
		</tr>
		<tr>
			<th><p>위젯 연동 가이드</p></th>
			<td>
				<p>1. /app/product/widget/ 디렉토리에 사용할 스킨을 별도로 복사하여 활용해 주세요.<br />2. 웹페이지의 위젯이 필요한 위치에 위젯 연동 소스를 삽입해 주세요.<br />3. 사용할 스킨의 파일명을 위젯 연동 소스에 삽입해 주세요.<br />[EX] &lt;?php rt_product_widget("skin.list.php");?></p>
			</td>
		</tr>
	</tbody>
</table>
<div class="rt_bot_box">
	<h1>이용안내</h1>
	<p><em>-</em><span class="rt_mint">솔루션 공통 소스</span>는 모든 페이지의 최상단에 포함되어 있어야 합니다.</p>
	<p><em>-</em>웹페이지의 적절한 위치에 <span class="rt_mint">연동 소스</span>를 복사해 삽입해 주세요.</p>
	<p><em>-</em>웹페이지의 필요한 위치에 <span class="rt_mint">위젯 연동 소스</span>를 복사해 삽입해 주세요.</p>
</div>