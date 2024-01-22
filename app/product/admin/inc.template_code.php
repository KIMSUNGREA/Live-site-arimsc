<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="imagetoolbar" content="no">
	<meta name="viewport" content="width=1280" />
	<meta name="author" content="RINT">

	<title>린트킷 관리자</title>

	<link href="/rintkit/adm/layout/css/style.css" rel="stylesheet" type="text/css"/>

	<script src="/rintkit/adm/layout/js/jquery-1.11.1.min.js" type="text/javascript"></script>
	<script src="/rintkit/adm/layout/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	
	<link href="/rintkit/adm/layout/js/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<script src="/rintkit/adm/layout/js/jquery-ui.min.js" type="text/javascript"></script>

	<script src="/rintkit/adm/layout/js/jquery.bxslider.js" type="text/javascript"></script>
	<script src="/rintkit/adm/layout/js/rt-common.js" type="text/javascript"></script>
	<script src="/rintkit/adm/layout/js/rt-sub.js" type="text/javascript"></script>

	<!-- plugin : http://dinbror.dk/bpopup/ //-->
	<script src="/rintkit/plugin/bpopup/jquery.bpopup.min.js"></script>

	<!-- 린트킷 관리자 전역변수 //-->
	<script type="text/javascript">
	var rt_path = Array();
	rt_path['root'] = "/rintkit";
	rt_path['adm'] = "/rintkit/adm";
	
	var rt_layout = Array();
	rt_layout['dr'] = "admin";
	rt_layout['sd'] = "admin";
	rt_layout['sc'] = "admin";
	rt_layout['cf'] = "admin";
	</script>
</head>
<div class="rt_tem_code_wrap">
	<h1 class="tit">템플릿 코드</h1>
	<ul class="rt_tem_code_con clearfix">
		<li class="rt_button_wrap">
			<a href="#;" class="bth_b rt_btn_dark">전체</a>
			<a href="#;" class="bth_b">공통</a>
			<a href="#;" class="bth_b">리스트</a>
			<a href="#;" class="bth_b">상세페이지</a>
		</li>
		<li class="rt_tem_code_box">
			<div class="rt_tem_tb_wrap">
				<div class="rt_s_tit clearfix">
					<p>01<span></span></p>
					<h1>공통</h1>
				</div>
				<table class="rt_tem_tb">
					<caption>템플릿 코드 | 공통</caption>
					<colgroup>
						<col style="width:120px;"/>
						<col style="width:465px;"/>
					</colgroup>
					<tr>
						<th><p>제품 분류</p></th>
						<td>
							<p class="rt_bold">[사용안내1]</p>
							<p class="rt_green mb5">&lt;!--{? 분류사용 == 'y' }-->
								<span class="pl15">
									출력할 HTML 소스
								</span>
							&lt;!--{/}-->
							</p>
							<p class="rt_bold">[사용안내2]</p>
							<p class="rt_green mb5">&lt;!--{? 분류사용 == 'y' }-->
								<span class="pl15">
									사용 때 HTML 소스
								</span>
							&lt;!--{:}-->
								<span class="pl15">
									사용안할 때 HTML 소스
								</span>
							&lt;!--{/}-->
							</p>
						</td>
					</tr>
					<tr>

					</tr>
					</tr>
					<tr>
						<th><p>{page_login}</p></th>
						<td><p>로그인 모듈이 설치된 페이지 위치(연동설정 탭에서 설정가능), ex)/page/s1/s1.php</p></td>
					</tr>
					<tr>
						<th><p>{page_mypage}</p></th>
						<td><p>마이페이지 모듈이 설치된 페이지 위치(연동설정 탭에서 설정가능), ex)/page/s1/s1.php</p></td>
					</tr>
					<tr>
						<th><p>{page_find}</p></th>
						<td><p>계정찾기 모듈이 설치된 페이지 위치(연동설정 탭에서 설정가능), ex)/page/s1/s1.php</p></td>
					</tr>
				</table>
			</div>
			<div class="rt_tem_tb_wrap">
				<div class="rt_s_tit clearfix">
					<p>02<span></span></p>
					<h1>로그인</h1>
				</div>
				<table class="rt_tem_tb">
					<caption>템플릿 코드 | 로그인</caption>
					<colgroup>
						<col style="width:120px;"/>
						<col style="width:465px;"/>
					</colgroup>
					<tr>
						<th><p>{prepage}</p></th>
						<td><p>로그인후 이동할 페이지 정보</p></td>
					</tr>
				</table>
			</div>
			<div class="rt_tem_tb_wrap">
				<div class="rt_s_tit clearfix">
					<p>03<span></span></p>
					<h1>STEP1</h1>
				</div>
				<table class="rt_tem_tb">
					<caption>템플릿 코드 | STEP1</caption>
					<colgroup>
						<col style="width:120px;"/>
						<col style="width:465px;"/>
					</colgroup>
					<tr>
						<th><p>{agreement1_title}</p></th>
						<td><p>첫번째 약관 타이틀</p></td>
					</tr>
					<tr>
						<th><p>{agreement1_txt}</p></th>
						<td><p>첫번째 약관 내용</p></td>
					</tr>
					<tr>
						<th><p>{agreement2_title}</p></th>
						<td><p>두번째 약관 타이틀</p></td>
					</tr>
					<tr>
						<th><p>{agreement2_txt}</p></th>
						<td><p>두번째 약관 내용</p></td>
					</tr>
				</table>
			</div>
			<div class="rt_tem_tb_wrap">
				<div class="rt_s_tit clearfix">
					<p>04<span></span></p>
					<h1>STEP2</h1>
				</div>
				<table class="rt_tem_tb">
					<caption>템플릿 코드 | STEP2</caption>
					<colgroup>
						<col style="width:120px;"/>
						<col style="width:465px;"/>
					</colgroup>
					<tr>
						<th rowspan="2"><p>메일리스트</p></th>
						<td><p>메일리스트 데이터 출력 셀렉트박스</p></td>
					</tr>
					<tr>
						<td>
							<p class="rt_bold">[사용안내]</p>
							<p class="rt_green mb5">&lt;select>
								<span class="pl15">
									&lt;option value="">선택&lt;/option>
									<br />&lt;!--{@ 메일리스트}-->
									<br />&lt;option value="{메일리스트.도메인}" >{메일리스트.도메인}&lt;/option>
									<br />&lt;!--{/}-->
								</span>
							&lt;/select>
							</p>
							<p class="rt_bold">[메일리스트 하위 템플릿 코드]</p>
							<p class="rt_dot_txt"><span class="dot"></span>{메일리스트.도메인}</p>
							<p class="rt_dash_txt"><span class="dash">-</span>도메인 주소 출력</p>
						</td>
					</tr>
					<tr>
						<th rowspan="2"><p>국번리스트</p></th>
						<td><p>국번리스트 데이터 출력 셀렉트박스</p></td>
					</tr>
					<tr>
						<td>
							<p class="rt_bold">[사용안내]</p>
							<p class="rt_green mb5">&lt;select>
								<span class="pl15">
									&lt;option value="">선택&lt;/option>
									<br />&lt;!--{@ 국번리스트}-->
									<br />&lt;option value="{국번리스트.국번}" >{국번리스트.국번}&lt;/option>
									<br />&lt;!--{/}-->
								</span>
							&lt;/select>
							</p>
							<p class="rt_bold">[국번리스트 하위 템플릿 코드]</p>
							<p class="rt_dot_txt"><span class="dot"></span>{국번리스트.국번}</p>
							<p class="rt_dash_txt"><span class="dash">-</span>국번 출력</p>
						</td>
					</tr>
					<tr>
						<th rowspan="2"><p>추가 필드 리스트</p></th>
						<td><p>필드관리에서 추가한 필드&데이터를 리스트 형태로 출력</p></td>
					</tr>
					<tr>
						<td>
							<p class="rt_bold">[사용안내]</p>
							<p class="rt_green mb5">&lt;ul>
								<span class="pl15">
									&lt;!--{@ 추가필드}-->
										<span class="pl30">&lt;li>{추가필드.필드명} : {추가필드.데이터}</li></span>
									<br />&lt!--{/}-->
								</span>
							&lt;/ul>
							</p>
							<p class="rt_bold">[추가필드 하위 템플릿 코드]</p>
							<p class="rt_dot_txt"><span class="dot"></span>{추가필드.필드명}</p>
							<p class="rt_dash_txt"><span class="dash">-</span>추가 필드명 출력, 환경설정의 필드관리에 입력된 필드명을 그대로 사용</p>
							<p class="rt_dot_txt"><span class="dot"></span>{추가필드.데이터}<br />
							<p class="rt_dash_txt"><span class="dash">-</span>해당 필드에 입력된 데이터 출력</p>
						</td>
					</tr>
					<tr>
						<th rowspan="2"><p>{추가필드여부}</p></th>
						<td><p>추가필드의 출력 여부 (출력 : y, 미출력 : n)</p></td>
					</tr>
					<tr>
						<td>
							<p class="rt_bold">[사용안내1]</p>
							<p class="rt_green mb5">&lt;!--{? 추가필드여부 == 'y' }-->
								<span class="pl15">출력할 HTML 소스</span>
							&lt;!--{/}-->
							</p>
							<p class="rt_bold">[사용안내2]</p>
							<p class="rt_green mb5">&lt;!--{? 추가필드여부 == 'y' }-->
								<span class="pl15">사용 때 HTML 소스</span>
							&lt;!--{:}-->
								<span class="pl15">사용안할 때 HTML 소스</span>
							&lt;!--{/}-->
							</p>
						</td>
					</tr>
				</table>
			</div>
			<div class="rt_tem_tb_wrap">
				<div class="rt_s_tit clearfix">
					<p>05<span></span></p>
					<h1>STEP3</h1>
				</div>
				<table class="rt_tem_tb">
					<caption>템플릿 코드 | STEP3</caption>
					<colgroup>
						<col style="width:120px;"/>
						<col style="width:465px;"/>
					</colgroup>
					<tr>
						<th><p>{가입아이디}</p></th>
						<td><p>가입완료된 회원 아이디</p></td>
					</tr>
				</table>
			</div>
			<div class="rt_tem_tb_wrap">
				<div class="rt_s_tit clearfix">
					<p>06<span></span></p>
					<h1>마이페이지 (정보수정)</h1>
				</div>
				<table class="rt_tem_tb">
					<caption>템플릿 코드 | 마이페이지 (정보수정)</caption>
					<colgroup>
						<col style="width:120px;"/>
						<col style="width:465px;"/>
					</colgroup>
					<tr>
						<th rowspan="2"><p>마이페이지<br />(정보수정)</p></th>
						<td><p>회원 상세정보 출력부</p></td>
					</tr>
					<tr>
						<td>
							<p class="rt_bold">[사용형식]</p>
							<p class="rt_green mb5">{회원.[필드명]}</p>
							<p class="rt_bold">[회원 템플릿 코드]</p>
							<p class="rt_dot_txt"><span class="dot"></span>{회원.아이디}</p>
							<p class="rt_dash_txt"><span class="dash">-</span>가입된 회원 아이디</p>
							<p class="rt_dot_txt"><span class="dot"></span>{회원.이름}</p>
							<p class="rt_dash_txt"><span class="dash">-</span>가입된 회원명</p>
							<p class="rt_dot_txt"><span class="dot"></span>{회원.이메일}</p>
							<p class="rt_dash_txt"><span class="dash">-</span>회원 이메일</p>
							<p class="rt_dot_txt"><span class="dot"></span>{회원.전화번호}</p>
							<p class="rt_dash_txt"><span class="dash">-</span>전화번호(휴대폰)</p>
							<p class="rt_dot_txt"><span class="dot"></span>{회원.메일수신}</p>
							<p class="rt_dash_txt"><span class="dash">-</span>동의함, 동의안함 중 문구 출력</p>
							<p class="rt_dot_txt"><span class="dot"></span>{회원.SMS수신}</p>
							<p class="rt_dash_txt"><span class="dash">-</span>동의함, 동의안함 중 문구 출력</p>
							<p class="rt_dot_txt"><span class="dot"></span>{회원.가입일}</p>
							<p class="rt_dash_txt"><span class="dash">-</span>회원 가입일자</p>
							<p class="rt_dot_txt"><span class="dot"></span>{회원.수정일}</p>
							<p class="rt_dash_txt"><span class="dash">-</span>회원 정보 최종 수정일</p>
							<p class="rt_dot_txt"><span class="dot"></span>추가 필드 리스트</p>
							<p class="rt_dash_txt"><span class="dash">-</span>필드관리에서 추가한 필드&데이터를 리스트 형태로 출력</p>
							<p class="rt_bold">[사용안내]</p>
							<p class="rt_green mb5">&lt;ul>
								<span class="pl15">&lt;!--{@ 추가필드}--></span>
								<span class="pl30">&lt;li>{추가필드.필드명} : {추가필드.데이터}</li></span>
								<span class="pl15">&lt;!--{/}--></span>
							&lt;/ul>
							</p>
							<p class="rt_bold">[추가필드 하위 템플릿 코드]</p>
							<p class="rt_dot_txt"><span class="dot"></span>{추가필드.필드명}</p>
							<p class="rt_dash_txt"><span class="dash">-</span>추가 필드명 출력, 환경설정의 필드관리에 입력된 필드명을 그대로 사용</p>
							<p class="rt_dot_txt"><span class="dot"></span>{추가필드.데이터}</p>
							<p class="rt_dash_txt"><span class="dash">-</span>해당 필드에 입력된 데이터 출력</p>
							<p class="rt_dot_txt"><span class="dot"></span>{추가필드여부}</p>
							<p class="rt_dash_txt"><span class="dash">-</span>추가필드의 출력 여부 (출력 : y, 미출력 : n)</p>
							<p class="rt_bold">[사용안내1]</p>
							<p class="rt_green mb5">&lt;!--{? 추가필드여부 == 'y' }-->
								<span class="pl15">출력할 HTML 소스</span>
							&lt;!--{/}-->
							</p>
							<p class="rt_bold">[사용안내2]</p>
							<p class="rt_green mb5">&lt;!--{? 추가필드여부 == 'y' }-->
								<span class="pl15">사용 때 HTML 소스</span>
							&lt;!--{:}-->
								<span class="pl15">사용안할 때 HTML 소스</span>
							&lt;!--{/}-->
							</p>
						</td>
					</tr>
				</table>
			</div>
		</li>
	</ul>
</div>
</body>
</html>