<?php if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }?>

<?php require_once RT_DOC_ROOT.$_def['path_app']."/admin/inc.common.menu.php";?>

<div class="rt_search_wrap">
	<form name="search_form" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<input type="hidden" name="appcode" value="<?php echo $env->_get['appcode'];?>">
	<input type="hidden" name="sd" value="<?php echo $env->_get['sd'];?>">
	<input type="hidden" name="pg" value="<?php echo $env->_get['pg'];?>">
	<select name="schcate" style="width:150px;">
		<option value="">분류 선택</option>
		<?php
		for ($m = 0; $m < count($cls_ct->listdata['code']); $m++) {
			$addstr = "";
			if ($cls_ct->listdata['parent'][$m] != '0') {
				for ($i = 1; $i < $cls_ct->listdata['depth'][$m]; $i++) {$addstr.= " ─ ";}
			}
			?>
			<option value="<?php echo $cls_ct->listdata['code'][$m];?>" <?php echo ($cls_ct->listdata['code'][$m] == $env->_get['schcate'])?"selected":"";?>><?php echo $addstr.$cls_ct->listdata['label'][$m];?></option>
			<?
		} ?>
	</select>
	<select name="search">
		<option value="pdt_name" <?php echo ($env->_get['search']=="pdt_name")?"selected":"";?>>제품명</option>
	</select>
	<input type="text" value="<?php echo $env->_get['searchstring'];?>" name="searchstring" />
	<span class="rt_button_wrap"><a href="#;" id="btn-search" class="rt_btn_gray btn_s">검색</a></span>
	</form>
</div>

<table class="rt_list_table">
	<caption>제품 목록</caption>
	<colgroup>
		<?php if (empty($env->_get['searchstring'])) {?>
		<col style="width:80px;"/>
		<?php } ?>
		<col style="width:100px;"/>
		<col style="width:200px;"/>
		<col style="width:100px;"/>
		<col style=""/>
		<col style="width:150px;"/>
	</colgroup>
	<thead>
		<tr>
			<?php if (empty($env->_get['searchstring'])) {?>
			<th><p>순서</p></th>
			<?php } ?>
			<th><p>번호</p></th>
			<th><p>분류</p></th>
			<th><p>이미지</p></th>
			<th><p>제품명</p></th>
			<th><p>정보관리</p></th>
		</tr>
	</thead>
	<tbody>
	<?php
	if ($cls_pdt->list_rec_cnt > 0)
	{
		$num = $cls_pdt->list_rec_cnt;
		$_l = $cls_pdt->get_list("ord DESC");
		for ($i = 0; $i < count($_l); $i++)
		{
			foreach($_l[$i] as $k => $v) $_l[$i][$k] = stripslashes($v);

			$reg_date = substr($_l[$i]['reg_date'],0,10);
			$viewpage = "?sd=product&cf=view&seq=".$_l[$i]['seq']."&pg=".$env->_get['pg'].$add_sch_url;

			//아이콘 설정
			$_l[$i]['new'] = (rt_is_new_post($_l[$i]['reg_date'], $_conf['post_new_period'])) ? " <img src='".$_def['path_assets']."/img/board_new.png' />":"";

			//목록이미지
			$_img_src = $_l[$i]['list_img_dir'];
			if ($_l[$i]['list_img_thumb']) {
				$_img_src.= "thumb/".$_l[$i]['list_img_thumb'];
			} else if ($_l[$i]['list_img_new']) {
				$_img_src.= $_l[$i]['list_img_new'];
			} else {
				$_img_src = "";
			}
			?>
		<tr>
			<?php if (empty($env->_get['searchstring'])) {?>
			<td>
				<p class="rt_ico_wrap">
					<a href="#;" onclick="ord_chg('up','<?php echo $_l[$i]['seq'];?>','<?php echo $env->_get['schcate'];?>')" class="rt_arrow rt_up">위로</a>
					<a href="#;" onclick="ord_chg('down','<?php echo $_l[$i]['seq'];?>','<?php echo $env->_get['schcate'];?>')" class="rt_arrow rt_down">아래로</a>
				</p>
			</td>
			<?php } ?>
			<td><p><?php echo $num;?></p></td>
			<td><p><?php echo $_c[$_l[$i]['cate']]?></p></td>
			<td><p><img src="<?php echo $_img_src;?>" style="width:60px;height:60px;"></p></td>
			<td class="rt_tal"><p><a href="<?php echo $base_url;?>?<?php echo $cls_pdt->add_url;?>&cf=form&seq=<?php echo $_l[$i]['seq'];?>"><?php echo $_l[$i]['pdt_name'];?></a><?php echo $_l[$i]['new']?></p></td>
			<td>
				<p class="rt_button_wrap rt_tac">
					<a href="<?php echo $base_url;?>?<?php echo $cls_pdt->add_url;?>&cf=form&seq=<?php echo $_l[$i]['seq'];?>" class="rt_btn_blue btn_in">수정</a>
					<a href="#;" onclick="product_delete(<?php echo $_l[$i]['seq'];?>,'<?php echo $env->_get['pg'];?>')" class="rt_btn_red btn_in">삭제</a>
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

<?php echo $cls_pdt->put_page_num($_SERVER['PHP_SELF']);?>
<br />
<div class="rt_bot_box">
	<h1>이용안내</h1>
	<p><em>-</em><span class="rt_mint">검색어가 있는 검색 결과</span>에서는 <span class="rt_yellow">순서변경 기능이 활성화되지 않습니다.</span> </p>
</div>

<script src="<?php echo $_def['path_assets'];?>/js/product.admin.data.js" type="text/javascript"></script>

<iframe name="rt_ifrm" id="rt_ifrm" style="width:100%;height:700px;display:none;"></iframe>