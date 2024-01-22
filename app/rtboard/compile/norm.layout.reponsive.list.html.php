<?php /* Template_ 2.2.8 2017/03/11 00:47:03 /home/rintkit.com/new/app/rtboard/template/norm.layout.reponsive.list.html 000006437 */ 
$TPL_글분류_1=empty($TPL_VAR["글분류"])||!is_array($TPL_VAR["글분류"])?0:count($TPL_VAR["글분류"]);
$TPL_공지글_1=empty($TPL_VAR["공지글"])||!is_array($TPL_VAR["공지글"])?0:count($TPL_VAR["공지글"]);
$TPL_리스트_1=empty($TPL_VAR["리스트"])||!is_array($TPL_VAR["리스트"])?0:count($TPL_VAR["리스트"]);?>
<!-- 반응형 게시판 시작 -->
<div class="rt-rwd-notice-wrap">
	<!-- 검색폼 시작 -->
	<div class="rt-rwd-search-wrap">
	<form name="search_form" method="get" action="<?php echo $TPL_VAR["php_self"]?>">
	<input type="hidden" name="pcd" value="<?php echo $TPL_VAR["페이지코드"]?>">
	<input type="hidden" name="screen" value="<?php echo $TPL_VAR["이동화면"]?>">
		<div class="rt-rwd-search-select-wrap">
<?php if($TPL_VAR["분류사용"]=='y'){?>
			<select class="rt-rwd-search-select" name="ct">
				<option value="">분류 선택</option>
<?php if($TPL_글분류_1){foreach($TPL_VAR["글분류"] as $TPL_V1){?>
				<option value="<?php echo $TPL_V1["분류명"]?>" <?php echo $TPL_V1["selected"]?>><?php echo $TPL_V1["분류명"]?></option>
<?php }}?>
			</select>
<?php }?>
		</div>
		<div class="rt-rwd-search-select-wrap">
			<select class="rt-rwd-search-select" name="search">
				<option value="subject">제목</option>
				<option value="content">내용</option>
				<option value="subjcont">제목+내용</option>
				<option value="name">작성자</option>
			</select>
		</div>
		<div class="rt-rwd-search-input-wrap">
			<input type="text" name="searchstring" class="rt-rwd-search-input" value="<?php echo $TPL_VAR["검색어"]?>"/>
		</div>
		<a href="javascript:document.search_form.submit();" class="rt-rwd-search-send">검색</a>
	</form>
	</div>
	<!-- 검색폼 끝 -->
	<!-- 게시판 리스트 시작 -->
	<div class="rt-rwd-list-wrap">
<?php if($TPL_VAR["리스트"]){?>

		<div class="rt-rwd-list-con rt-rwd-list-con-head rt-rwd-list-norm-con clearfix">
			<div class="rt-rwd-list-num"><p>번호</p></div>
			<div class="rt-rwd-list-subject"><p>제목</p></div>
			<div class="rt-rwd-list-type-wrap clearfix">
				<div class="rt-rwd-list-type-con clearfix">
					<div class="rt-rwd-list-type rt-rwd-list-type-writer">
						<p>작성자</p>
					</div>
					<div class="rt-rwd-list-type rt-rwd-list-type-day">
						<p>등록일</p>
					</div>
					<div class="rt-rwd-list-type rt-rwd-list-type-date">
						<p>조회수</p>
					</div>
				</div>
			</div>
		</div>

<?php if($TPL_공지글_1){foreach($TPL_VAR["공지글"] as $TPL_V1){?>
		<div class="rt-rwd-list-con rt-rwd-list-sign-con clearfix">
			<div class="rt-rwd-list-num"><p>공지</p></div>
			<div class="rt-rwd-list-subject">
				<a href="<?php echo $TPL_V1["상세페이지링크"]?>">
<?php if($TPL_VAR["목록이미지사용"]=='y'){?>
					<img src="<?php echo $TPL_V1["목록이미지경로"]?>" style="width:50px;height:50px;" class="rt-rwd-thumb"/>
<?php }?>
<?php if($TPL_VAR["분류사용"]=='y'&&$TPL_V1["분류"]!=''){?>[<?php echo $TPL_V1["분류"]?>]&nbsp;<?php }?>
					<?php echo $TPL_V1["줄임제목"]?>

				</a>&nbsp;
<?php if($TPL_VAR["댓글사용"]=='y'&&$TPL_V1["댓글수"]> 0){?>[<?php echo $TPL_V1["댓글수"]?>]<?php }?>
				<?php echo $TPL_V1["첨부아이콘"]?><?php echo $TPL_V1["새글아이콘"]?>

			</div>
			<div class="rt-rwd-list-type-wrap clearfix">
				<div class="rt-rwd-list-type-con clearfix">
					<div class="rt-rwd-list-type rt-rwd-list-type-writer">
						<p><span class="rt-rwd-list-type-m">작성자 : </span><?php echo $TPL_V1["작성자"]?></p>
					</div>
					<div class="rt-rwd-list-type">
						<p><span class="rt-rwd-list-type-m">등록일 : </span><?php echo $TPL_V1["작성일"]?></p>
					</div>
					<div class="rt-rwd-list-type rt-rwd-list-type-date">
						<p><span class="rt-rwd-list-type-m">조회수 : </span><?php echo $TPL_V1["조회수"]?></p>
					</div>
				</div>
			</div>
		</div>
<?php }}?>

<?php if($TPL_리스트_1){foreach($TPL_VAR["리스트"] as $TPL_V1){?>
		<div class="rt-rwd-list-con rt-rwd-list-norm-con clearfix">
			<div class="rt-rwd-list-num"><p><?php echo $TPL_V1["번호"]?></p></div>
			<div class="rt-rwd-list-subject">
				<a href="<?php echo $TPL_V1["상세페이지링크"]?>">
<?php if($TPL_VAR["목록이미지사용"]=='y'){?>
					<img src="<?php echo $TPL_V1["목록이미지경로"]?>" style="width:50px;height:50px;" class="rt-rwd-thumb"/>
<?php }?>
<?php if($TPL_V1["답글공백"]){?> <?php echo $TPL_V1["답글공백"]?> RE : <?php }?>
<?php if($TPL_VAR["분류사용"]=='y'&&$TPL_V1["분류"]!=''){?>[<?php echo $TPL_V1["분류"]?>]&nbsp;<?php }?>
					<?php echo $TPL_V1["줄임제목"]?>

				</a>&nbsp;
<?php if($TPL_VAR["댓글사용"]=='y'&&$TPL_V1["댓글수"]> 0){?>[<?php echo $TPL_V1["댓글수"]?>]<?php }?>
				<?php echo $TPL_V1["첨부아이콘"]?><?php echo $TPL_V1["새글아이콘"]?>

			</div>
			<div class="rt-rwd-list-type-wrap clearfix">
				<div class="rt-rwd-list-type-con clearfix">
					<div class="rt-rwd-list-type rt-rwd-list-type-writer">
						<p><span class="rt-rwd-list-type-m">작성자 : </span><?php echo $TPL_V1["작성자"]?></p>
					</div>
					<div class="rt-rwd-list-type">
						<p><span class="rt-rwd-list-type-m">등록일 : </span><?php echo $TPL_V1["작성일"]?></p>
					</div>
					<div class="rt-rwd-list-type rt-rwd-list-type-date">
						<p><span class="rt-rwd-list-type-m">조회수 : </span><?php echo $TPL_V1["조회수"]?></p>
					</div>
				</div>
			</div>
		</div>
<?php }}?>
<?php }else{?>
		<div class="rt-rwd-list-nosearch clearfix">
			등록된 글이 없습니다.
		</div>
<?php }?>
	</div>
	<!-- 게시판 리스트 끝 -->
	<!--페이지네이션 STR-->
	<?php echo $TPL_VAR["페이지인덱스"]?>

	<!--페이지네이션 END-->
	<!-- PC CSS STR-->
	<link href="<?php echo $TPL_VAR["path_css"]?>/rtboard.norm.responsive.css" type="text/css" rel="stylesheet"/>
	<!-- PC CSS END-->
	<!-- 버튼 시작 -->
	<div class="rt-button rt-button-tar">
		<a href="#;" style="cursor: pointer;" onclick="location.href='<?php echo $TPL_VAR["쓰기페이지링크"]?>'">글쓰기</a>
	</div>
	<!-- 버튼 끝 -->
</div>
<!-- 반응형 게시판 끝 -->