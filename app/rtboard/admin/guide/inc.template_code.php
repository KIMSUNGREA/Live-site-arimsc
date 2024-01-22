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
	<div class="tit_wrap clearfix">
		<h1 class="tit rt_fll mt5">템플릿 코드</h1>
		<div class="rt_button_wrap rt_fll">
			<a href="#;" class="rt_btn_dark btn_s">정보형 (info)</a>
			<a href="#;" class="rt_btn_gray btn_s">일반형 (norm)</a>
			<a href="#;" class="rt_btn_gray btn_s">질답형 (qna)</a>
		</div>
	</div>
	<div class="rt_tem_code_area">
		<ul class="rt_tem_code_con clearfix">
			<li class="rt_button_wrap">
				<a href="#;" class="bth_b rt_btn_dark">전체</a>
				<a href="#;" class="bth_b">공통</a>
				<a href="#;" class="bth_b">LIST</a>
				<a href="#;" class="bth_b">VIEW</a>
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
							<th rowspan="2"><p>{로그인여부}</p></th>
							<td><p>로그인 여부 권한 (로그인중 : true, 비회원 : false)</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">&lt;!--{? 로그인여부 }-->
									<span class="pl15">
										로그인 상태일 때 출력할 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">&lt;!--{? 로그인여부 }-->
									<span class="pl15">
										로그인 상태일 때 출력할 HTML 소스
									</span>
								&lt;!--{:}-->
									<span class="pl15">
										로그인되지 않은 상태일 때 출력할 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
							</td>
						</tr>
						<tr>
							<th><p>{회원아이디}</p></th>
							<td><p>현재 로그인한 회원아이디, 비회원은 출력안함</p></td>
						</tr>
						<tr>
							<th><p>{회원이름}</p></th>
							<td><p>현재 로그인한 회원명, 비회원은 출력안함</p></td>
						</tr>
						<tr>
							<th><p>{게시판명}</p></th>
							<td><p>게시판 명</p></td>
						</tr>
						<tr>
							<th><p>{게시판코드}</p></th>
							<td><p>게시판 코드 ex)notice</p></td>
						</tr>
						<tr>
							<th><p>{검색어}</p></th>
							<td><p>게시판 검색어 출력</p></td>
						</tr>
						<tr>
							<th rowspan="2"><p>{분류사용}</p></th>
							<td><p>게시판 분류 사용여부 (사용 : y, 사용안함 : n)</p></td>
						</tr>
						<tr>
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
							<th rowspan="2"><p>{댓글사용}</p></th>
							<td><p>댓글 사용여부 (사용 : y, 사용안함 : n)</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">&lt;!--{? 댓글사용 == 'y' }-->
									<span class="pl15">
										출력할 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">&lt;!--{? 댓글사용 == 'y' }-->
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
							<th rowspan="2"><p>{목록이미지사용}</p></th>
							<td><p>목록(대표)이미지 사용여부 (사용 : y, 사용안함 : n)</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">&lt;!--{? 목록이미지사용 == 'y' }-->
									<span class="pl15">
										출력할 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">&lt;!--{? 목록이미지사용 == 'y' }-->
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
							<th rowspan="2"><p>{댓글이용권한}</p></th>
							<td><p>현재 접속자의 댓글이용권한 여부 (권한있음 : true, 권한없음 : false)</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">&lt;!--{? 댓글이용권한 }-->
									<span class="pl15">
										권한이 있을 때 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">&lt;!--{? 댓글이용권한 }-->
									<span class="pl15">
										권한이 있을 때 HTML 소스
									</span>
								&lt;!--{:}-->
									<span class="pl15">
										권한이 없을 때 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
							</td>
						</tr>
						<tr>
							<th><p>{pg}</p></th>
							<td><p>게시판 리스트 페이지 인덱스 번호</p></td>
						</tr>
						<tr>
							<th><p>{php_self}</p></th>
							<td><p>현재 페이지명 ex)/sub/index.php</p></td>
						</tr>
						<tr>
							<th><p>{path_theme}</p></th>
							<td><p>APP의 현재 테마 디렉토리 경로 ex)/app/rtboard/theme/info</p></td>
						</tr>
					</table>
				</div>
				<div class="rt_tem_tb_wrap">
					<div class="rt_s_tit clearfix">
						<p>02<span></span></p>
						<h1>LIST</h1>
					</div>
					<table class="rt_tem_tb">
						<caption>템플릿 코드 | LIST</caption>
						<colgroup>
							<col style="width:120px;"/>
							<col style="width:465px;"/>
						</colgroup>
						<tr>
							<th rowspan="2"><p>글분류</p></th>
							<td><p>글분류 데이터 출력 셀렉트박스</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;select name="ct">
									<span class="pl15">
										&lt;option value="">분류 선택&lt;/option>
										<br />&lt;!--{@ 글분류}-->
										<br />&lt;option value="{글분류.분류명}" {글분류.selected}>{글분류.분류명}&lt;/option>
										<br />&lt;!--{/}-->
									</span>
								&lt;/select>
								</p>
								<p class="rt_bold">[글분류 하위 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{글분류.분류명}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>분류명 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{글분류.selected}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>현재 선택된 분류에 selected 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{글분류.onclass}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>현재 선택된 분류에 class에 on 을 출력 ex) class="{글분류.onclass}"</p>
							</td>
						</tr>
						<tr>
							<th rowspan="2"><p>게시판 공지 목록</p></th>
							<td><p>게시판 리스트의 공지글 출력부</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;!--{@ 공지글}-->
									<span class="pl15">
										&lt;tr>
										<span class="pl15">
											&lt;td>공지&lt;/td>
											&lt;td class="title">
											<span class="pl15">
												&lt;a href="{공지글.상세페이지링크}">{공지글.줄임제목}&lt;/a> {공지글.첨부아이콘}{공지글.새글아이콘}
											</span>
											&lt;/td>
											<br />&lt;td>{공지글.작성일}&lt;/td>
											<br />&lt;td>{공지글.조회수}&lt;/td>
										</span>
										&lt;/tr>
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[공지글 하위 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.번호}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글번호 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.분류}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글의 분류명 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.제목}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글의 제목 전체 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.줄임제목}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시판의 환경설정에서 설정한 길이만큼만 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 명 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.가림작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 명의 뒤에서 두번째 글자를 * 처리하여 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.회원아이디}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자의 아이디 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.본문}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글의 본문 전체 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.줄임본문}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시판의 환경설정에서 설정한 길이만큼만 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.작성일}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 작성일 출력(형식 : 0000.00.00)</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.조회수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 조회수 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.등록아이피}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성 시 IP 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.상세페이지링크}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>상세페이지 링크 정보 출력
									<span class="rt_bold">[사용안내]</span>
									<span class="rt_green mb5">&lt;a href="{공지글.상세페이지링크}">{공지글.제목}&lt;/a></span>
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.목록이미지경로}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>목록이미지의 링크 정보<br />해당 게시판의 환경설정에 따라 썸네일나 원본이미지를 출력
									<span class="rt_bold">[사용안내]</span>
									<span class="rt_green mb5">&lt;img src="{공지글.목록이미지경로}" /></span>
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.새글아이콘}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>새 글 아이콘 출력<br />새 글 기준은 해당 게시판의 환경설정에서 설정</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.첨부파일여부}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글에 첨부파일이 있는지 여부 (첨부있음 : true, 첨부없음 : false)
									<span class="rt_bold">[사용안내1]</span>
									<span class="rt_green mb5">
										&lt;!--{? 공지글.첨부파일여부 }-->
										<span class="pl15">첨부된 파일이 있을 때 HTML 소스</span>
										&lt;!--{/}-->
									</span>
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.첨부아이콘}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>첨부파일이 있을 시 아이콘 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>개별 추가 필드</p>
								<p class="rt_dash_txt"><span class="dash">-</span>필드관리에서 추가한 필드 데이터 출력
									<span class="rt_bold">[사용형식]</span>
									<span class="rt_green mb5">
										{공지글.추가_[필드명]}
									</span>
									<span class="rt_bold">[사용예시]</span>
									<span class="rt_green mb5">
										{공지글.추가_필드명1}<br />
										{공지글.추가_필드명2}<br />
										{공지글.추가_필드명3}
									</span>
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.댓글수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글에 등록된 댓글수 출력</p>
							</td>
						</tr>
						<tr>
							<th rowspan="2"><p>게시판 목록</p></th>
							<td><p>게시판 리스트의 데이터 출력부</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;!--{@ 리스트}-->
									<span class="pl15">
										&lt;tr>
										<span class="pl15">
											&lt;td>{리스트.번호}&gt;/td>
											&lt;td class="title">
											<span class="pl15">
												&lt;a href="{리스트.상세페이지링크}">{리스트.줄임제목}&gt;/a> {리스트.첨부아이콘}{리스트.새글아이콘}
											</span>
											&lt;/td>
											<br />&lt;td>{리스트.작성일}&lt;/td>
											<br />&lt;td>{리스트.조회수}&lt;/td>
										</span>
										&lt;/tr>
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[리스트 하위 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.번호}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글번호 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.분류}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글의 분류명 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.제목}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글의 제목 전체 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.줄임제목}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시판의 환경설정에서 설정한 길이만큼만 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 명 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.가림작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 명의 뒤에서 두번째 글자를 * 처리하여 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.회원아이디}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자의 아이디 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.본문}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글의 본문 전체 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.줄임본문}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시판의 환경설정에서 설정한 길이만큼만 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.작성일}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 작성일 출력(형식 : 0000.00.00)</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.조회수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 조회수 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.등록아이피}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성 시 IP 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.상세페이지링크}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>상세페이지 링크 정보 출력</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;a href="{리스트.상세페이지링크}">{리스트.제목}&lt;/a></p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.목록이미지경로}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>목록이미지의 링크 정보<br />해당 게시판의 환경설정에 따라 썸네일나 원본이미지를 출력</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;img src="{리스트.목록이미지경로}" /></p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.새글아이콘}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>새 글 아이콘 출력<br/>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.첨부파일여부}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글에 첨부파일이 있는지 여부 (첨부있음 : true, 첨부없음 : false)</p>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">
									&lt;!--{? 리스트.첨부파일여부 }-->
									<span class="pl15">첨부된 파일이 있을 때 HTML 소스</span>
									&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">
									&lt;!--{? 리스트.첨부파일여부 }-->
									<span class="pl15">첨부된 파일이 있을 때 HTML 소스</span>
									&lt;!--{:}-->
									<span class="pl15">첨부된 파일이 없을 때 HTML 소스</span>
									!--{/}-->
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.첨부아이콘}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>첨부파일이 있을 시 아이콘 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>개별 추가 필드</p>
								<p class="rt_dash_txt"><span class="dash">-</span>필드관리에서 추가한 필드 데이터 출력</p>
								<p class="rt_bold">[사용형식]</p>
								<p class="rt_green mb5">{리스트.추가_[필드명]}</p>
								<p class="rt_bold">[사용예시]</p>
								<p class="rt_green mb5">{리스트.추가_필드명1}<br />{리스트.추가_필드명2}<br />{리스트.추가_필드명3}</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.댓글수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글에 등록된 댓글수 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{페이지인덱스}	</p>
								<p class="rt_dash_txt"><span class="dash">-</span>게시판의 페이징 그룹 출력</p>
							</td>
						</tr>
					</table>
				</div>
				<div class="rt_tem_tb_wrap">
					<div class="rt_s_tit clearfix">
						<p>03<span></span></p>
						<h1>VIEW</h1>
					</div>
					<table class="rt_tem_tb">
						<caption>템플릿 코드 | VIEW</caption>
						<colgroup>
							<col style="width:120px;"/>
							<col style="width:465px;"/>
						</colgroup>
						<tr>
							<th rowspan="2"><p>상세 페이지</p></th>
							<td><p>게시판 상세정보 출력부</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용형식]</p>
								<p class="rt_green mb5">{포스트.[필드명]}</p>
								<p class="rt_bold">[포스트 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.고유키}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시물의 번호</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.분류}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>게시물 분류명</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.아이디}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 아이디</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 이름</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.제목}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>게시물 제목 전체</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.내용}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>게시물 본문 전체</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.작성일}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 등록일</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.수정일}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 최종 수정일</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.조회수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 조회수</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.아이피}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 최초 등록 아이피</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.공지여부}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>현재 게시물의 공지설정 여부 (공지중 : y, 미공지 : n)</p>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">
								&lt;!--{? 포스트.공지여부 == 'y' }-->
									<span class="pl15">출력할 HTML 소스</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">
								&lt;!--{? 포스트.공지여부 == 'y' }-->
									<span class="pl15">사용 때 HTML 소스</span>
								&lt;!--{:}-->
									<span class="pl15">사용안할 때 HTML 소스</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.목록이미지경로}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>목록이미지의 링크 정보<br />등록된 원본이미지를 출력</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;img src="{포스트.목록이미지경로}" /></p>
								<p class="rt_dot_txt"><span class="dot"></span>이전글/다음글</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">
								&lt;ul>
									<span class="pl15">&lt;li>&lt;a href="{포스트.다음글링크}">{포스트.다음글제목}&lt;/a>&lt;/li></span>
									<span class="pl15">&lt;li>&lt;a href="{포스트.이전글링크}">{포스트.이전글제목}&lt;/a>&lt;/li></span>
								&lt;/ul>
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>추가 필드 리스트</p>
								<p class="rt_dash_txt"><span class="dash">-</span>필드관리에서 추가한 필드&데이터를 리스트 형태로 출력</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">
								&lt;ul>
									<span class="pl15">
									&lt;!--{@ 추가필드}-->
										<span class="pl15">&lt;li>{추가필드.필드명} : {추가필드.데이터}&lt;/li></span>
									&lt;!--{/}-->
									</span>
								&lt;/ul>
								</p>
								<p class="rt_bold">[추가필드 하위 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{추가필드.필드명}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>추가 필드명 출력, 환경설정의 필드관리에 입력된 필드명을 그대로 사용</p>
								<p class="rt_dot_txt"><span class="dot"></span>{추가필드.데이터}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 필드에 입력된 데이터 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>추가 필드 단일</p>
								<p class="rt_dash_txt"><span class="dash">-</span>필드관리에서 추가한 필드의 데이터를 개별(단일) 출력</p>
								<p class="rt_bold">[사용형식]</p>
								<p class="rt_green mb5">{포스트.추가_[필드명]}</p>
								<p class="rt_bold">[사용예시]</p>
								<p class="rt_green mb5">{포스트.추가_테스트필드1}<br />{포스트.추가_테스트필드2}</p>
							</td>
						</tr>
						<tr>
							<th rowspan="2"><p>댓글 목록</p></th>
							<td><p>게시판 상세정보 댓글 출력부</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용형식]</p>
								<p class="rt_green mb5">{댓글.[필드명]}</p>
								<p class="rt_bold">[댓글 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.고유키}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시물의 번호</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.아이디}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 아이디</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 이름</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.내용}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>댓글 본문 전체</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.작성일}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 등록일</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.작성시간}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 등록 시간</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.아이피}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 최초 등록 아이피</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글페이지인덱스}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>댓글목록의 페이징 그룹 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{전체댓글수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시물의 전체 댓글 개수</p>
							</td>
						</tr>
						<tr>
							<th rowspan="2"><p>첨부파일</p></th>
							<td><p>첨부파일 리스트 출력</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">
								&lt;ul>
									<span class="pl15">
									&lt;!--{@ 첨부파일}-->
										<span class="pl15">&lt;li>첨부다운 : &lt;a href="{첨부파일.다운로드링크}" target="rt_ifrm">{첨부파일.파일명}&lt;/a>&lt;/li></span>
									&lt;!--{/}-->
									</span>
								&lt;/ul>
								</p>
								<p class="rt_bold">[첨부파일 하위 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{첨부파일.파일명}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>첨부파일의 실 파일명</p>
								<p class="rt_dot_txt"><span class="dot"></span>{첨부파일.파일경로}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>첨부파일의 실 업로드 경로(파일명 포함)</p>
								<p class="rt_dot_txt"><span class="dot"></span>{첨부파일.다운로드링크}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>다운로드 링크</p>
							</td>
						</tr>
					</table>
				</div>
			</li>
		</ul>
		<ul class="rt_tem_code_con blind clearfix">
			<li class="rt_button_wrap">
				<a href="#;" class="bth_b rt_btn_dark">전체</a>
				<a href="#;" class="bth_b">공통</a>
				<a href="#;" class="bth_b">LIST</a>
				<a href="#;" class="bth_b">VIEW</a>
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
							<th rowspan="2"><p>{로그인여부}</p></th>
							<td><p>로그인 여부 권한 (로그인중 : true, 비회원 : false)</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">&lt;!--{? 로그인여부 }-->
									<span class="pl15">
										로그인 상태일 때 출력할 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">&lt;!--{? 로그인여부 }-->
									<span class="pl15">
										로그인 상태일 때 출력할 HTML 소스
									</span>
								&lt;!--{:}-->
									<span class="pl15">
										로그인되지 않은 상태일 때 출력할 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
							</td>
						</tr>
						<tr>
							<th><p>{회원아이디}</p></th>
							<td><p>현재 로그인한 회원아이디, 비회원은 출력안함</p></td>
						</tr>
						<tr>
							<th><p>{회원이름}</p></th>
							<td><p>현재 로그인한 회원명, 비회원은 출력안함</p></td>
						</tr>
						<tr>
							<th><p>{게시판명}</p></th>
							<td><p>게시판 명</p></td>
						</tr>
						<tr>
							<th><p>{게시판코드}</p></th>
							<td><p>게시판 코드 ex)notice</p></td>
						</tr>
						<tr>
							<th><p>{검색어}</p></th>
							<td><p>게시판 검색어 출력</p></td>
						</tr>
						<tr>
							<th rowspan="2"><p>{분류사용}</p></th>
							<td><p>게시판 분류 사용여부 (사용 : y, 사용안함 : n)</p></td>
						</tr>
						<tr>
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
							<th rowspan="2"><p>{댓글사용}</p></th>
							<td><p>댓글 사용여부 (사용 : y, 사용안함 : n)</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">&lt;!--{? 댓글사용 == 'y' }-->
									<span class="pl15">
										출력할 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">&lt;!--{? 댓글사용 == 'y' }-->
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
							<th rowspan="2"><p>{목록이미지사용}</p></th>
							<td><p>목록(대표)이미지 사용여부 (사용 : y, 사용안함 : n)</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">&lt;!--{? 목록이미지사용 == 'y' }-->
									<span class="pl15">
										출력할 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">&lt;!--{? 목록이미지사용 == 'y' }-->
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
							<th rowspan="2"><p>{댓글이용권한}</p></th>
							<td><p>현재 접속자의 댓글이용권한 여부 (권한있음 : true, 권한없음 : false)</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">&lt;!--{? 댓글이용권한 }-->
									<span class="pl15">
										권한이 있을 때 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">&lt;!--{? 댓글이용권한 }-->
									<span class="pl15">
										권한이 있을 때 HTML 소스
									</span>
								&lt;!--{:}-->
									<span class="pl15">
										권한이 없을 때 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
							</td>
						</tr>
						<tr>
							<th><p>{pg}</p></th>
							<td><p>게시판 리스트 페이지 인덱스 번호</p></td>
						</tr>
						<tr>
							<th><p>{php_self}</p></th>
							<td><p>현재 페이지명 ex)/sub/index.php</p></td>
						</tr>
						<tr>
							<th><p>{path_theme}</p></th>
							<td><p>APP의 현재 테마 디렉토리 경로 ex)/app/rtboard/theme/info</p></td>
						</tr>
					</table>
				</div>
				<div class="rt_tem_tb_wrap">
					<div class="rt_s_tit clearfix">
						<p>02<span></span></p>
						<h1>LIST</h1>
					</div>
					<table class="rt_tem_tb">
						<caption>템플릿 코드 | LIST</caption>
						<colgroup>
							<col style="width:120px;"/>
							<col style="width:465px;"/>
						</colgroup>
						<tr>
							<th rowspan="2"><p>글분류</p></th>
							<td><p>글분류 데이터 출력 셀렉트박스</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;select name="ct">
									<span class="pl15">
										&lt;option value="">분류 선택&lt;/option>
										<br />&lt;!--{@ 글분류}-->
										<br />&lt;option value="{글분류.분류명}" {글분류.selected}>{글분류.분류명}&lt;/option>
										<br />&lt;!--{/}-->
									</span>
								&lt;/select>
								</p>
								<p class="rt_bold">[글분류 하위 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{글분류.분류명}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>분류명 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{글분류.selected}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>현재 선택된 분류에 selected 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{글분류.onclass}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>현재 선택된 분류에 class에 on 을 출력 ex) class="{글분류.onclass}"</p>
							</td>
						</tr>
						<tr>
							<th rowspan="2"><p>게시판 공지 목록</p></th>
							<td><p>게시판 리스트의 공지글 출력부</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;!--{@ 공지글}-->
									<span class="pl15">
										&lt;tr>
										<span class="pl15">
											&lt;td>공지&lt;/td>
											&lt;td class="title">
											<span class="pl15">
												&lt;a href="{공지글.상세페이지링크}">{공지글.줄임제목}&lt;/a> {공지글.첨부아이콘}{공지글.새글아이콘}
											</span>
											&lt;/td>
											<br />&lt;td>{공지글.작성일}&lt;/td>
											<br />&lt;td>{공지글.조회수}&lt;/td>
										</span>
										&lt;/tr>
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[공지글 하위 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.번호}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글번호 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.분류}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글의 분류명 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.제목}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글의 제목 전체 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.줄임제목}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시판의 환경설정에서 설정한 길이만큼만 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 명 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.가림작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 명의 뒤에서 두번째 글자를 * 처리하여 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.회원아이디}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자의 아이디 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.본문}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글의 본문 전체 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.줄임본문}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시판의 환경설정에서 설정한 길이만큼만 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.작성일}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 작성일 출력(형식 : 0000.00.00)</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.조회수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 조회수 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.등록아이피}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성 시 IP 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.상세페이지링크}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>상세페이지 링크 정보 출력
									<span class="rt_bold">[사용안내]</span>
									<span class="rt_green mb5">&lt;a href="{공지글.상세페이지링크}">{공지글.제목}&lt;/a></span>
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.목록이미지경로}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>목록이미지의 링크 정보<br />해당 게시판의 환경설정에 따라 썸네일나 원본이미지를 출력
									<span class="rt_bold">[사용안내]</span>
									<span class="rt_green mb5">&lt;img src="{공지글.목록이미지경로}" /></span>
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.새글아이콘}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>새 글 아이콘 출력<br />새 글 기준은 해당 게시판의 환경설정에서 설정</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.첨부파일여부}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글에 첨부파일이 있는지 여부 (첨부있음 : true, 첨부없음 : false)
									<span class="rt_bold">[사용안내1]</span>
									<span class="rt_green mb5">
										&lt;!--{? 공지글.첨부파일여부 }-->
										<span class="pl15">첨부된 파일이 있을 때 HTML 소스</span>
										&lt;!--{/}-->
									</span>
									<span class="rt_bold">[사용안내2]</span>
									<span class="rt_green mb5">
										&lt;!--{? 공지글.첨부파일여부 }-->
										<span class="pl15">첨부된 파일이 있을 때 HTML 소스</span>
										&lt;!--{:}-->
										<span class="pl15">첨부된 파일이 없을 때 HTML 소스</span>
										&lt;!--{/}-->
									</span>
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.첨부아이콘}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>첨부파일이 있을 시 아이콘 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>개별 추가 필드</p>
								<p class="rt_dash_txt"><span class="dash">-</span>필드관리에서 추가한 필드 데이터 출력
									<span class="rt_bold">[사용형식]</span>
									<span class="rt_green mb5">
										{공지글.추가_[필드명]}
									</span>
									<span class="rt_bold">[사용예시]</span>
									<span class="rt_green mb5">
										{공지글.추가_필드명1}<br />
										{공지글.추가_필드명2}<br />
										{공지글.추가_필드명3}
									</span>
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>{공지글.댓글수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글에 등록된 댓글수 출력</p>
							</td>
						</tr>
						<tr>
							<th rowspan="2"><p>게시판 목록</p></th>
							<td><p>게시판 리스트의 데이터 출력부</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;!--{@ 리스트}-->
									<span class="pl15">
										&lt;tr>
										<span class="pl15">
											&lt;td>{리스트.번호}&gt;/td>
											&lt;td class="title">
											<span class="pl15">
												&lt;a href="{리스트.상세페이지링크}">{리스트.줄임제목}&gt;/a> {리스트.첨부아이콘}{리스트.새글아이콘}
											</span>
											&lt;/td>
											<br />&lt;td>{리스트.작성일}&lt;/td>
											<br />&lt;td>{리스트.조회수}&lt;/td>
										</span>
										&lt;/tr>
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[리스트 하위 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.번호}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글번호 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.분류}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글의 분류명 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.제목}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글의 제목 전체 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.줄임제목}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시판의 환경설정에서 설정한 길이만큼만 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 명 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.가림작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 명의 뒤에서 두번째 글자를 * 처리하여 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.회원아이디}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자의 아이디 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.본문}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글의 본문 전체 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.줄임본문}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시판의 환경설정에서 설정한 길이만큼만 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.작성일}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 작성일 출력(형식 : 0000.00.00)</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.조회수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 조회수 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.등록아이피}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성 시 IP 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.상세페이지링크}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>상세페이지 링크 정보 출력</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;a href="{리스트.상세페이지링크}">{리스트.제목}&lt;/a></p>
								<p class="rt_dot_txt"><span class="dot"></span>{쓰기페이지링크}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>쓰기페이지 링크 정보 출력</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;a href="{쓰기페이지링크}">글쓰기&lt;/a></p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.목록이미지경로}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>목록이미지의 링크 정보<br />해당 게시판의 환경설정에 따라 썸네일나 원본이미지를 출력</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;img src="{리스트.목록이미지경로}" /></p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.새글아이콘}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>새 글 아이콘 출력<br/>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.첨부파일여부}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글에 첨부파일이 있는지 여부 (첨부있음 : true, 첨부없음 : false)</p>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">
									&lt;!--{? 리스트.첨부파일여부 }-->
									<span class="pl15">첨부된 파일이 있을 때 HTML 소스</span>
									&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">
									&lt;!--{? 리스트.첨부파일여부 }-->
									<span class="pl15">첨부된 파일이 있을 때 HTML 소스</span>
									&lt;!--{:}-->
									<span class="pl15">첨부된 파일이 없을 때 HTML 소스</span>
									!--{/}-->
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.첨부아이콘}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>첨부파일이 있을 시 아이콘 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>개별 추가 필드</p>
								<p class="rt_dash_txt"><span class="dash">-</span>필드관리에서 추가한 필드 데이터 출력</p>
								<p class="rt_bold">[사용형식]</p>
								<p class="rt_green mb5">{리스트.추가_[필드명]}</p>
								<p class="rt_bold">[사용예시]</p>
								<p class="rt_green mb5">{리스트.추가_필드명1}<br />{리스트.추가_필드명2}<br />{리스트.추가_필드명3}</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.답글공백}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>답글을 안으로 넣어 주는 빈 이미지 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.댓글수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글에 등록된 댓글수 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{페이지인덱스}	</p>
								<p class="rt_dash_txt"><span class="dash">-</span>게시판의 페이징 그룹 출력</p>
							</td>
						</tr>
					</table>
				</div>
				<div class="rt_tem_tb_wrap">
					<div class="rt_s_tit clearfix">
						<p>03<span></span></p>
						<h1>VIEW</h1>
					</div>
					<table class="rt_tem_tb">
						<caption>템플릿 코드 | VIEW</caption>
						<colgroup>
							<col style="width:120px;"/>
							<col style="width:465px;"/>
						</colgroup>
						<tr>
							<th rowspan="2"><p>상세 페이지</p></th>
							<td><p>게시판 상세정보 출력부</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용형식]</p>
								<p class="rt_green mb5">{포스트.[필드명]}</p>
								<p class="rt_bold">[포스트 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.고유키}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시물의 번호</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.분류}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>게시물 분류명</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.아이디}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 아이디</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 이름</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.제목}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>게시물 제목 전체</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.내용}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>게시물 본문 전체</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.작성일}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 등록일</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.수정일}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 최종 수정일</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.조회수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 조회수</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.아이피}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 최초 등록 아이피</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.공지여부}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>현재 게시물의 공지설정 여부 (공지중 : y, 미공지 : n)</p>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">
								&lt;!--{? 포스트.공지여부 == 'y' }-->
									<span class="pl15">출력할 HTML 소스</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">
								&lt;!--{? 포스트.공지여부 == 'y' }-->
									<span class="pl15">사용 때 HTML 소스</span>
								&lt;!--{:}-->
									<span class="pl15">사용안할 때 HTML 소스</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.목록이미지경로}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>목록이미지의 링크 정보<br />등록된 원본이미지를 출력</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;img src="{포스트.목록이미지경로}" /></p>
								<p class="rt_dot_txt"><span class="dot"></span>추가 필드 리스트</p>
								<p class="rt_dash_txt"><span class="dash">-</span>필드관리에서 추가한 필드&데이터를 리스트 형태로 출력</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">
								&lt;ul>
									<span class="pl15">
									&lt;!--{@ 추가필드}-->
										<span class="pl15">&lt;li>{추가필드.필드명} : {추가필드.데이터}&lt;/li></span>
									&lt;!--{/}-->
									</span>
								&lt;/ul>
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>추가 필드 단일</p>
								<p class="rt_dash_txt"><span class="dash">-</span>필드관리에서 추가한 필드의 데이터를 개별(단일) 출력</p>
								<p class="rt_bold">[사용형식]</p>
								<p class="rt_green mb5">{포스트.추가_[필드명]}</p>
								<p class="rt_bold">[사용예시]</p>
								<p class="rt_green mb5">{포스트.추가_테스트필드1}<br />{포스트.추가_테스트필드2}</p>
							</td>
						</tr>
						<tr>
							<th rowspan="2"><p>댓글 목록</p></th>
							<td><p>게시판 상세정보 댓글 출력부</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용형식]</p>
								<p class="rt_green mb5">{댓글.[필드명]}</p>
								<p class="rt_bold">[댓글 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.고유키}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시물의 번호</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.아이디}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 아이디</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 이름</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.내용}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>댓글 본문 전체</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.작성일}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 등록일</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.작성시간}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 등록 시간</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.아이피}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 최초 등록 아이피</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글페이지인덱스}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>댓글목록의 페이징 그룹 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{전체댓글수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시물의 전체 댓글 개수</p>
							</td>
						</tr>
						<tr>
							<th rowspan="2"><p>첨부파일</p></th>
							<td><p>첨부파일 리스트 출력</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">
								&lt;ul>
									<span class="pl15">
									&lt;!--{@ 첨부파일}-->
										<span class="pl15">&lt;li>첨부다운 : &lt;a href="{첨부파일.다운로드링크}" target="rt_ifrm">{첨부파일.파일명}&lt;/a>&lt;/li></span>
									&lt;!--{/}-->
									</span>
								&lt;/ul>
								</p>
								<p class="rt_bold">[첨부파일 하위 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{첨부파일.파일명}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>첨부파일의 실 파일명</p>
								<p class="rt_dot_txt"><span class="dot"></span>{첨부파일.파일경로}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>첨부파일의 실 업로드 경로(파일명 포함)</p>
								<p class="rt_dot_txt"><span class="dot"></span>{첨부파일.다운로드링크}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>다운로드 링크</p>
							</td>
						</tr>
					</table>
				</div>
			</li>
		</ul>
		<ul class="rt_tem_code_con blind clearfix">
			<li class="rt_button_wrap">
				<a href="#;" class="bth_b rt_btn_dark">전체</a>
				<a href="#;" class="bth_b">공통</a>
				<a href="#;" class="bth_b">LIST</a>
				<a href="#;" class="bth_b">FORM VIEW</a>
				<a href="#;" class="bth_b">VIEW</a>
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
							<th rowspan="2"><p>{로그인여부}</p></th>
							<td><p>로그인 여부 권한 (로그인중 : true, 비회원 : false)</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">&lt;!--{? 로그인여부 }-->
									<span class="pl15">
										로그인 상태일 때 출력할 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">&lt;!--{? 로그인여부 }-->
									<span class="pl15">
										로그인 상태일 때 출력할 HTML 소스
									</span>
								&lt;!--{:}-->
									<span class="pl15">
										로그인되지 않은 상태일 때 출력할 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
							</td>
						</tr>
						<tr>
							<th><p>{회원아이디}</p></th>
							<td><p>현재 로그인한 회원아이디, 비회원은 출력안함</p></td>
						</tr>
						<tr>
							<th><p>{회원이름}</p></th>
							<td><p>현재 로그인한 회원명, 비회원은 출력안함</p></td>
						</tr>
						<tr>
							<th><p>{게시판명}</p></th>
							<td><p>게시판 명</p></td>
						</tr>
						<tr>
							<th><p>{게시판코드}</p></th>
							<td><p>게시판 코드 ex)notice</p></td>
						</tr>
						<tr>
							<th><p>{검색어}</p></th>
							<td><p>게시판 검색어 출력</p></td>
						</tr>
						<tr>
							<th rowspan="2"><p>{분류사용}</p></th>
							<td><p>게시판 분류 사용여부 (사용 : y, 사용안함 : n)</p></td>
						</tr>
						<tr>
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
							<th rowspan="2"><p>{댓글사용}</p></th>
							<td><p>댓글 사용여부 (사용 : y, 사용안함 : n)</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">&lt;!--{? 댓글사용 == 'y' }-->
									<span class="pl15">
										출력할 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">&lt;!--{? 댓글사용 == 'y' }-->
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
							<th rowspan="2"><p>{목록이미지사용}</p></th>
							<td><p>목록(대표)이미지 사용여부 (사용 : y, 사용안함 : n)</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">&lt;!--{? 목록이미지사용 == 'y' }-->
									<span class="pl15">
										출력할 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">&lt;!--{? 목록이미지사용 == 'y' }-->
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
							<th rowspan="2"><p>{댓글이용권한}</p></th>
							<td><p>현재 접속자의 댓글이용권한 여부 (권한있음 : true, 권한없음 : false)</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">&lt;!--{? 댓글이용권한 }-->
									<span class="pl15">
										권한이 있을 때 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">&lt;!--{? 댓글이용권한 }-->
									<span class="pl15">
										권한이 있을 때 HTML 소스
									</span>
								&lt;!--{:}-->
									<span class="pl15">
										권한이 없을 때 HTML 소스
									</span>
								&lt;!--{/}-->
								</p>
							</td>
						</tr>
						<tr>
							<th><p>{pg}</p></th>
							<td><p>게시판 리스트 페이지 인덱스 번호</p></td>
						</tr>
						<tr>
							<th><p>{php_self}</p></th>
							<td><p>현재 페이지명 ex)/sub/index.php</p></td>
						</tr>
						<tr>
							<th><p>{path_theme}</p></th>
							<td><p>APP의 현재 테마 디렉토리 경로 ex)/app/rtboard/theme/info</p></td>
						</tr>
					</table>
				</div>
				<div class="rt_tem_tb_wrap">
					<div class="rt_s_tit clearfix">
						<p>02<span></span></p>
						<h1>LIST</h1>
					</div>
					<table class="rt_tem_tb">
						<caption>템플릿 코드 | LIST</caption>
						<colgroup>
							<col style="width:120px;"/>
							<col style="width:465px;"/>
						</colgroup>
						<tr>
							<th rowspan="2"><p>글분류</p></th>
							<td><p>글분류 데이터 출력 셀렉트박스</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;select name="ct">
									<span class="pl15">
										&lt;option value="">분류 선택&lt;/option>
										<br />&lt;!--{@ 글분류}-->
										<br />&lt;option value="{글분류.분류명}" {글분류.selected}>{글분류.분류명}&lt;/option>
										<br />&lt;!--{/}-->
									</span>
								&lt;/select>
								</p>
								<p class="rt_bold">[글분류 하위 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{글분류.분류명}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>분류명 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{글분류.selected}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>현재 선택된 분류에 selected 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{글분류.onclass}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>현재 선택된 분류에 class에 on 을 출력 ex) class="{글분류.onclass}"</p>
							</td>
						</tr>
						<tr>
							<th rowspan="2"><p>게시판 목록</p></th>
							<td><p>게시판 리스트의 데이터 출력부</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;!--{@ 리스트}-->
									<span class="pl15">
										&lt;tr>
										<span class="pl15">
											&lt;td>{리스트.번호}&gt;/td>
											&lt;td class="title">
											<span class="pl15">
												&lt;a href="{리스트.상세페이지링크}">{리스트.줄임제목}&gt;/a> {리스트.첨부아이콘}{리스트.새글아이콘}
											</span>
											&lt;/td>
											<br />&lt;td>{리스트.작성일}&lt;/td>
											<br />&lt;td>{리스트.조회수}&lt;/td>
										</span>
										&lt;/tr>
									</span>
								&lt;!--{/}-->
								</p>
								<p class="rt_bold">[리스트 하위 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.번호}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글번호 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.분류}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글의 분류명 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.제목}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글의 제목 전체 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.줄임제목}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시판의 환경설정에서 설정한 길이만큼만 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 명 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.가림작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 명의 뒤에서 두번째 글자를 * 처리하여 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.회원아이디}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자의 아이디 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.본문}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글의 본문 전체 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.줄임본문}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시판의 환경설정에서 설정한 길이만큼만 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.작성일}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 작성일 출력(형식 : 0000.00.00)</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.조회수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 조회수 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.등록아이피}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성 시 IP 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.상세페이지링크}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>상세페이지 링크 정보 출력</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;a href="{리스트.상세페이지링크}">{리스트.제목}&lt;/a></p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.목록이미지경로}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>목록이미지의 링크 정보<br />해당 게시판의 환경설정에 따라 썸네일나 원본이미지를 출력</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;img src="{리스트.목록이미지경로}" /></p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.새글아이콘}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>새 글 아이콘 출력<br/>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.첨부파일여부}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글에 첨부파일이 있는지 여부 (첨부있음 : true, 첨부없음 : false)</p>
								<p class="rt_bold">[사용안내1]</p>
								<p class="rt_green mb5">
									&lt;!--{? 리스트.첨부파일여부 }-->
									<span class="pl15">첨부된 파일이 있을 때 HTML 소스</span>
									&lt;!--{/}-->
								</p>
								<p class="rt_bold">[사용안내2]</p>
								<p class="rt_green mb5">
									&lt;!--{? 리스트.첨부파일여부 }-->
									<span class="pl15">첨부된 파일이 있을 때 HTML 소스</span>
									&lt;!--{:}-->
									<span class="pl15">첨부된 파일이 없을 때 HTML 소스</span>
									!--{/}-->
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.첨부아이콘}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>첨부파일이 있을 시 아이콘 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>개별 추가 필드</p>
								<p class="rt_dash_txt"><span class="dash">-</span>필드관리에서 추가한 필드 데이터 출력</p>
								<p class="rt_bold">[사용형식]</p>
								<p class="rt_green mb5">{리스트.추가_[필드명]}</p>
								<p class="rt_bold">[사용예시]</p>
								<p class="rt_green mb5">{리스트.추가_필드명1}<br />{리스트.추가_필드명2}<br />{리스트.추가_필드명3}</p>
								<p class="rt_dot_txt"><span class="dot"></span>{리스트.댓글수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 글에 등록된 댓글수 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{페이지인덱스}	</p>
								<p class="rt_dash_txt"><span class="dash">-</span>게시판의 페이징 그룹 출력</p>
							</td>
						</tr>
					</table>
				</div>
				<div class="rt_tem_tb_wrap">
					<div class="rt_s_tit clearfix">
						<p>03<span></span></p>
						<h1>FORM VIEW</h1>
					</div>
					<table class="rt_tem_tb">
						<caption>템플릿 코드 | FORM VIEW</caption>
						<colgroup>
							<col style="width:120px;"/>
							<col style="width:465px;"/>
						</colgroup>
						<tr>
							<th rowspan="2"><p>폼/상세 페이지</p></th>
							<td><p>게시판 상세정보 출력부</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용형식]</p>
								<p class="rt_green mb5">{포스트.[필드명]}</p>
								<p class="rt_bold">[포스트 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.고유키}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시물의 번호</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.분류}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>게시물 분류명</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.아이디}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 아이디</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 이름</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.제목}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>게시물 제목 전체</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.내용}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>게시물 본문 전체</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.작성일}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 등록일</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.수정일}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 최종 수정일</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.조회수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 조회수</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.아이피}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 최초 등록 아이피</p>
								<p class="rt_dot_txt"><span class="dot"></span>{포스트.목록이미지경로}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>목록이미지의 링크 정보<br />등록된 원본이미지를 출력</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">&lt;img src="{포스트.목록이미지경로}" /></p>
								<p class="rt_dot_txt"><span class="dot"></span>이전글/다음글</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">
								&lt;ul>
									<span class="pl15">&lt;li>&lt;a href="{포스트.다음글링크}">{포스트.다음글제목}&lt;/a>&lt;/li></span>
									<span class="pl15">&lt;li>&lt;a href="{포스트.이전글링크}">{포스트.이전글제목}&lt;/a>&lt;/li></span>
								&lt;/ul>
								</p>
								<p class="rt_dot_txt"><span class="dot"></span>추가 필드 리스트</p>
								<p class="rt_dash_txt"><span class="dash">-</span>필드관리에서 추가한 필드&데이터를 리스트 형태로 출력</p>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">
								&lt;ul>
									<span class="pl15">
									&lt;!--{@ 추가필드}-->
										<span class="pl15">&lt;li>{추가필드.필드명} : {추가필드.데이터}&lt;/li></span>
									&lt;!--{/}-->
									</span>
								&lt;/ul>
								</p>
								<p class="rt_bold">[추가필드 하위 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{추가필드.필드명}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>추가 필드명 출력, 환경설정의 필드관리에 입력된 필드명을 그대로 사용</p>
								<p class="rt_dot_txt"><span class="dot"></span>{추가필드.데이터}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 필드에 입력된 데이터 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>추가 필드 단일</p>
								<p class="rt_dash_txt"><span class="dash">-</span>필드관리에서 추가한 필드의 데이터를 개별(단일) 출력</p>
								<p class="rt_bold">[사용형식]</p>
								<p class="rt_green mb5">{포스트.추가_[필드명]}</p>
								<p class="rt_bold">[사용예시]</p>
								<p class="rt_green mb5">{포스트.추가_테스트필드1}<br />{포스트.추가_테스트필드2}</p>
							</td>
						</tr>
					</table>
				</div>
				<div class="rt_tem_tb_wrap">
					<div class="rt_s_tit clearfix">
						<p>04<span></span></p>
						<h1>VIEW</h1>
					</div>
					<table class="rt_tem_tb">
						<caption>템플릿 코드 | VIEW</caption>
						<colgroup>
							<col style="width:120px;"/>
							<col style="width:465px;"/>
						</colgroup>
						<tr>
							<th rowspan="2"><p>댓글 목록</p></th>
							<td><p>게시판 상세정보 댓글 출력부</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용형식]</p>
								<p class="rt_green mb5">{댓글.[필드명]}</p>
								<p class="rt_bold">[댓글 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.고유키}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시물의 번호</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.아이디}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 아이디</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.작성자}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>작성자 이름</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.내용}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>댓글 본문 전체</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.작성일}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 등록일</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.작성시간}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 등록 시간</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글.아이피}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>글 최초 등록 아이피</p>
								<p class="rt_dot_txt"><span class="dot"></span>{댓글페이지인덱스}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>댓글목록의 페이징 그룹 출력</p>
								<p class="rt_dot_txt"><span class="dot"></span>{전체댓글수}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>해당 게시물의 전체 댓글 개수</p>
							</td>
						</tr>
						<tr>
							<th rowspan="2"><p>첨부파일</p></th>
							<td><p>첨부파일 리스트 출력</p></td>
						</tr>
						<tr>
							<td>
								<p class="rt_bold">[사용안내]</p>
								<p class="rt_green mb5">
								&lt;ul>
									<span class="pl15">
									&lt;!--{@ 첨부파일}-->
										<span class="pl15">&lt;li>첨부다운 : &lt;a href="{첨부파일.다운로드링크}" target="rt_ifrm">{첨부파일.파일명}&lt;/a>&lt;/li></span>
									&lt;!--{/}-->
									</span>
								&lt;/ul>
								</p>
								<p class="rt_bold">[첨부파일 하위 템플릿 코드]</p>
								<p class="rt_dot_txt"><span class="dot"></span>{첨부파일.파일명}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>첨부파일의 실 파일명</p>
								<p class="rt_dot_txt"><span class="dot"></span>{첨부파일.파일경로}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>첨부파일의 실 업로드 경로(파일명 포함)</p>
								<p class="rt_dot_txt"><span class="dot"></span>{첨부파일.다운로드링크}</p>
								<p class="rt_dash_txt"><span class="dash">-</span>다운로드 링크</p>
							</td>
						</tr>
					</table>
				</div>
			</li>
		</ul>
	</div>
</div>
</body>
</html>