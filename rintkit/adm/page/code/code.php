<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<div class="rt_s_tit clearfix">
	<p>01<span></span></p>
	<h1>페이지 별 링크 소스</h1>
</div>
<table class="rt_data_table mb30">
<caption>페이지 별 링크</caption>
<colgroup>
	<col width="20%" />
	<col width="20%" />
	<col width="30%" />
	<col width="30%" />
</colgroup>
<tbody>
<tr>
	<th><p>페이지 코드</p></th>
	<th><p>페이지 명</p></th>
	<th><p>기본 URL</p></th>
	<th><p>모바일 URL</p></th>
</tr>
<?php for ($m = 0; $m < count($data); $m++) { ?>
<tr>
	<th><p><?php echo $data[$m]['code'];?></p></th>
	<td style="<?php echo ($data[$m]['parent']!='0')?"background-color:#fff":"background-color:#fafafa";?>"><?php echo $data[$m]['label'];?></td>
	<td style="<?php echo ($data[$m]['parent']!='0')?"background-color:#fff":"background-color:#fafafa";?>">&lt?php echo rt_page_link("<?php echo $data[$m]['code'];?>");?&gt</td>
	<td style="<?php echo ($data[$m]['parent']!='0')?"background-color:#fff":"background-color:#fafafa";?>">&lt?php echo rt_page_link("<?php echo $data[$m]['code'];?>","m");?&gt</td>
</tr>
<?php } ?>
</tbody>
</table>

<div class="rt_s_tit clearfix">
	<p>02<span></span></p>
	<h1>메타(META) 데이터 연동 소스</h1>
</div>
<table class="rt_data_table mb30">
<caption>메타 데이터 연동 소스</caption>
<colgroup>
	<col width="20%" />
	<col width="30%" />
	<col width="20%" />
	<col width="30%" />
</colgroup>
<tbody>
<tr>
	<th><p>페이지 제목</p></th>
	<td><p>&lt?php echo $__pg['meta_title'];?&gt</p></td>
	<th><p>페이지 요약 설명</p></th>
	<td><p>&lt?php echo $__pg['meta_desc'];?&gt</p></td>
</tr>
<tr>
	<th><p>페이지 키워드</p></th>
	<td><p>&lt?php echo $__pg['meta_keyword'];?&gt</p></td>
	<th><p>페이지 대표 이미지</p></th>
	<td><p>&lt?php echo $__pg['main_url'];?&gt</p></td>
</tr>
</tbody>
</table>

<div class="rt_s_tit clearfix">
	<p>03<span></span></p>
	<h1>페이지 별 개발자 설정 데이터</h1>
</div>
<table class="rt_data_table mb30">
	<caption>페이지 별 개발자 설정 데이터</caption>
	<colgroup>
		<col width="20%" />
		<col width="30%" />
		<col width="20%" />
		<col width="30%" />
	</colgroup>
	<tbody>
		<tr>
			<th rowspan="5"><p>전체 공통 데이터</p></th>
			<td>
				데이터 1 : &lt?php echo $__pg['c_data1'];?&gt
			</td>
			<th rowspan="5"><p>페이지 별 개발자 설정 데이터</p></th>
			<td>데이터 1 : &lt?php echo $__pg['u_data1'];?&gt</td>
		</tr>
		<tr>
			<td>데이터 2 : &lt?php echo $__pg['c_data2'];?&gt</td>
			<td>데이터 2 : &lt?php echo $__pg['u_data2'];?&gt</td>
		</tr>
		<tr>
			<td>데이터 3 : &lt?php echo $__pg['c_data3'];?&gt</td>
			<td>데이터 3 : &lt?php echo $__pg['u_data3'];?&gt</td>
		</tr>
		<tr>
			<td>데이터 4 : &lt?php echo $__pg['c_data4'];?&gt</td>
			<td>데이터 4 : &lt?php echo $__pg['u_data4'];?&gt</td>
		</tr>
		<tr>
			<td>데이터 5 : &lt?php echo $__pg['c_data5'];?&gt</td>
			<td>데이터 5 : &lt?php echo $__pg['u_data5'];?&gt</td>
		</tr>
	</tbody>
</table>


<div class="rt_bot_box">
	<h1>이용 안내</h1>
	<p><em>-</em>페이지 간 링크를 작성할 때 위의 소스를 활용하여 작성하면 <span class="rt_mint">관리자에서 링크를 통합 관리</span>할 수 있습니다</p>
	<p><em>-</em>사이트 맵으로 등록된 페이지의 링크 정보이며 사이트 맵으로 등록되지 않은 페이지는 연동되지 않습니다.</p>
	<p>링크 작성 예시) &lta href="<span class="rt_mint">&lt?php echo rt_page_link("company");?&gt</span>"&gt콘텐츠&lt/a&gt</p>
	<p><em>-</em>메타소스 작성 시 HTML 구문 내에 위 소스를 예시와 같은 방식으로 삽입해 주세요.</p>
	<p>메타 작성 예시) &lt meta name="description" content="<span class="rt_mint">&lt?php echo $__pg['meta_desc'];?&gt</span>"&gt</p>
	<p><em>-</em>관리자에서 페이지 별로 사용할 데이터를 세팅할 수 있습니다.</p>
	<p>페이지 공통 데이터 : <span class="rt_mint">모든 페이지에서 활용할 수 있는 범용성 데이터</span>입니다.(<span class="rt_mint">공통 데이터 메뉴</span>)</p>
	<p>페이지 별 데이터 : <span class="rt_mint">설정된 페이지에서만 사용하는 데이터</span>입니다.(<span class="rt_mint">페이지 설정 메뉴</span>)</p>
</div>