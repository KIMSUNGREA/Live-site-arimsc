<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<div class="rt_search_wrap">
	<form name="search_form" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<input type="hidden" name="appcode" value="<?php echo $env->_get['appcode'];?>">
	<input type="hidden" name="sd" value="<?php echo $env->_get['sd'];?>">
	<input type="hidden" name="pg" value="<?php echo $env->_get['pg'];?>">
	<select name="search">
		<option value="user_id" <?php echo ($env->_get['search']=="user_id")?"selected":"";?>>아이디</option>
		<option value="user_nm" <?php echo ($env->_get['search']=="user_nm")?"selected":"";?>>이름</option>
		<option value="email" <?php echo ($env->_get['search']=="email")?"selected":"";?>>이메일</option>
	</select>
	<input type="text" value="<?php echo $env->_get['searchstring'];?>" name="searchstring" />
	<span class="rt_button_wrap"><a href="#;" id="btn-search" class="rt_btn_gray btn_s">검색</a></span>
	</form>
</div>


<table class="rt_list_table">
	<caption>회원목록</caption>
	<colgroup>
		<col style="width:6%"/>
		<?php if ($conf['mb_approval_en'] == "y") { ?>
		<col style="width:10%"/>
		<?php } ?>
		<col style="width:10%"/>
		<col style=""/>
		<col style="width:20%"/>
		<!-- <col style="width:10%"/> -->
		<col style="width:10%"/>
		<col style="width:15%"/>
	</colgroup>
	<thead>
		<tr>
			<th><p>번호</p></th>
			<?php if ($conf['mb_approval_en'] == "y") { ?>
			<th><p>승인</p></th>
			<?php } ?>
			<th><p>그룹</p></th>
			<th><p>아이디</p></th>
			<th><p>이름</p></th>
			<!-- <th><p>연락처</p></th> -->
			<th><p>가입일</p></th>
			<th><p>정보관리</p></th>
		</tr>
	</thead>
	<tbody>
	<?php
	if ($cls_mem->list_rec_cnt > 0)
	{
		$num = $cls_mem->list_rec_cnt;
		$_l = $cls_mem->get_list("seq DESC");
		for ($i = 0; $i < count($_l); $i++)
		{
			foreach($_l[$i] as $k => $v) $_l[$i][$k] = stripslashes($v);

			$reg_date = substr($_l[$i]['reg_date'],0,10);
			$viewpage = "?sd=rtmember&cf=view&seq=".$_l[$i]['seq']."&pg=".$env->_get['pg'].$add_sch_url;
			$user_id = $_l[$i]['user_id'];

			//아이콘 설정
			$_l[$i]['new'] = (rt_is_new_post($_l[$i]['reg_date'], 1)) ? " <img src='".$_def['path_assets']."/img/board_new.png' />":"";

			if ($_l[$i]['withdraw_en'] == "y") {
				$mgroup = "<span style='color:#ff0000;'>탈퇴</span>";
			} else {
				$mgroup = $grp_cfg[$_l[$i]['mgroup']];
			}
			?>
		<tr>
			<td><p><?php echo $num;?></p></td>
			<?php if ($conf['mb_approval_en'] == "y") { ?>
			<td>
				<p class="rt_button_wrap rt_tac">
					<?php if ($_l[$i]['approval_en'] == "y") { ?>
						<a href="#;" onclick="set_approval('n',<?php echo $_l[$i]['seq'];?>,'<?php echo $env->_get['pg'];?>')" class="rt_btn_gray btn_in">완료</a>
					<?php } else { ?>
						<a href="#;" onclick="set_approval('y',<?php echo $_l[$i]['seq'];?>,'<?php echo $env->_get['pg'];?>')" class="rt_btn_red btn_in">미승인</a>
					<?php } ?>
				</p>
			</td>
			<?php } ?>
			<td><p><?php echo $mgroup;?></p></td>
			<td><p><a href="<?php echo $base_url;?>?<?php echo $cls_mem->add_url;?>&cf=view&seq=<?php echo $_l[$i]['seq'];?>"><?php echo $user_id;?></a><?php echo $_l[$i]['new'];?></p></td>
			<td><p><a href="<?php echo $base_url;?>?<?php echo $cls_mem->add_url;?>&cf=view&seq=<?php echo $_l[$i]['seq'];?>"><?php echo $_l[$i]['user_nm'];?></a></p></td>
			<!-- <td><p><?php echo $_l[$i]['phone'];?></p></td> -->
			<td><p><?php echo $reg_date;?></p></td>
			<td>
				<p class="rt_button_wrap rt_tac">
					<a href="<?php echo $base_url;?>?<?php echo $cls_mem->add_url;?>&cf=form&seq=<?php echo $_l[$i]['seq'];?>" class="rt_btn_blue btn_in">수정</a>
					<a href="#;" onclick="member_delete(<?php echo $_l[$i]['seq'];?>,'<?php echo $env->_get['pg'];?>')" class="rt_btn_red btn_in">삭제</a>
				</p>
			</td>
		</tr>
			<?
		$num--;
		}
	} else {
		?>
		<tr>
			<td colspan="6" style="padding:50px;">데이터가 없습니다</td>
		</tr>
		<?
	}?>
	</tbody>
</table>

<?php echo $cls_mem->put_page_num($_SERVER['PHP_SELF']);?>

<script src="<?php echo $_def['path_assets'];?>/js/rtmember.admin.data.js?ver=001" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>