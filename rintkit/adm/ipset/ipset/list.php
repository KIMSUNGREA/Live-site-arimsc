<?if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<table class="rt_field_table mb10">
	<caption>IP 등록</caption>
	<colgroup>
			<col width="50px" />
			<col width="80px" />
			<col width="*" />
			<col width="100px" />
			<col width="60px" />
	</colgroup>
	<tbody>
		<tr>
			<th>번호</th>
			<th>설정규칙</th>
			<th>설정된 IP</th>
			<th>등록일</th>
			<th>관리</th>
		</tr>
		<tr>
			<td class="rt_tac" colspan="5" style="height:200px">현재 "<b>제한안함</b>"으로 설정되어 있습니다.</td>
		</tr>
	</tbody>
</table>

<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em>관리자 접속 IP제한 기능을 사용하시려면 환경설정에서 <span class="rt_mint">IP 차단</span>이나 <span class="rt_mint">IP 허용</span>으로 설정을 해주어야 합니다.</p>
	<p><em>-</em><span class="rt_mint">IP 차단 설정</span> : 모든 IP를 <span class="rt_mint">허용</span>하며 특정 IP만 접근 못하도록 <span class="rt_mint">차단</span>합니다.</p>
	<p><em>-</em><span class="rt_mint">IP 허용 설정</span> : 모든 IP를 <span class="rt_mint">차단</span>하며 특정 IP만 접근할 수 있도록 <span class="rt_mint">허용</span>합니다.</p>
</div>