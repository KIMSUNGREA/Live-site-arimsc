<?php
//-------------------------------------------------------------------------------------------------
/*
 * 게시판 정보 업데이트
 * 
 * mode			: 데이터 처리 구분
 * 
 * insert		: 신규 게시판 등록
 * modify		: 게시판 정보 수정
 * delete		: 게시판 삭제
 */
//-------------------------------------------------------------------------------------------------

require_once $_SERVER['DOCUMENT_ROOT']."/_x_signpost.php";
require_once RT_ADM."/engine.php";

//-------------------------------------------------------------------------------------------------

$data = array();//DB 필드데이터

if ($env->_post['mode'] == "insert")
{
	//bcode 중복 처리
	$_r = $dbo->fetch("SELECT * FROM RT_RTBOARD WHERE bcode='".$env->_post['bcode']."'");
	if ($_r['bcode']) {
		rt_js_msg("게시판코드가 중복되었습니다");exit;
	}

	$data['bcode'	] = $env->_post['bcode'];
	$data['gseq'	] = $env->_post['gseq'];
	$data['name'	] = $env->_post['name'];
	$data['theme'	] = $env->_post['theme'];
	$data['state'	] = $env->_post['state'];

	if ($dbo->insert("RT_RTBOARD", $data)) {

		//APP 정보
		$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='rtboard'");

		//기본 템플릿 파일 디렉토리
		$tpl_dir_init = RT_DOC_ROOT.$_app['app_path']."/template_initial";

		//복사할 템플릿 디렉토리
		$tpl_dir = RT_DOC_ROOT.$_app['app_path']."/template";

		//기능 페이지 설정 목록
		require_once RT_DOC_ROOT.$_app['app_path']."/theme/".$env->_post['theme']."/lib/config.php";

		//기본 스킨 생성방식을 선택했을 경우 
		if ($env->_post['copy_skin'] == "y") {

			/* 스킨 복사 및 DB 데이터 세팅 S */
			foreach ($_cfg_use_func as $k => $v) {

				$skin_init = $tpl_dir_init."/".$env->_post['theme'].".".$v.".html";
				$skin_new =  $tpl_dir."/".$env->_post['theme'].".".$env->_post['bcode'].".".$v.".html";
				if (is_file($skin_init)) {
					copy($skin_init, $skin_new);
					@chmod($skin_new, 0777);
				}

				$szdata['skin_pc_'.$v] = $env->_post['theme'].".".$env->_post['bcode'].".".$v.".html";
				$szdata['skin_mobile_'.$v] = $env->_post['theme'].".".$env->_post['bcode'].".".$v.".html";
			}
			/* 스킨 복사 및 DB 데이터 세팅 E */

		} else if ($env->_post['copy_skin'] == "n") {

			//기존 스킨에서 선택하는 방식을 선택했을 경우
			foreach ($_cfg_use_func as $k => $v) {
				$szdata['skin_pc_'.$v] = $env->_post['skin_pc_'.$v];
				$szdata['skin_mobile_'.$v] = $env->_post['skin_mobile_'.$v];
			}
		}

		//게시판 기본 환경 설정 레코드 삽입
		$adata['bcode'			] = $env->_post['bcode'];
		$adata['skin_txt'		] = serialize($szdata);
		foreach ($_cfg_use_auth as $k => $v) {
			$adata['auth_'.$v] = 'a:1:{i:0;s:1:"0";}';
		}

		$dbo->insert("RT_RTBOARD_".strtoupper($env->_post['theme'])."_CONF", $adata);

		rt_js_move("새 게시판이 등록되었습니다.", "parent", "href", RTW_ADM."/app/?appcode=rtboard&sd=".$env->_post['sd']);
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}
}
else if ($env->_post['mode'] == "modify" && $env->_post['bcode'])
{
	$data['gseq'	] = $env->_post['gseq'];
	$data['name'	] = $env->_post['name'];
	$data['state'	] = $env->_post['state'];

	if ($dbo->update("RT_RTBOARD", $data, "bcode='".$env->_post['bcode']."'")) {
		rt_js_msg("정보가 변경되었습니다.");
	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

}
else if ($env->_post['mode'] == "get_skin_list" && $env->_post['theme'])
{
	//APP 정보
	$_app = $dbo->fetch("SELECT * FROM RT_APP WHERE app_code='rtboard'");

	//기능 페이지 설정 목록
	require_once RT_DOC_ROOT.$_app['app_path']."/theme/".$env->_post['theme']."/lib/config.php";

	//템플릿 파일 리스트
	$tpl_dir = RT_DOC_ROOT.$_app['app_path']."/template";
	$tpl_files = rt_template_list($tpl_dir);

	foreach ($_cfg_use_func as $k => $v) {
		$tit_v = strtoupper($v);
		?>
		<div class="rt_s_tit clearfix">
			<p><b><?php echo $tit_v;?></b> 스킨</p>
		</div>
		<p style="margin:5px 0px;float:none;">
			<select name="skin_pc_<?php echo $v;?>" class="rt-input" style="width:200px;">
				<option value=""><?php echo $tit_v;?> 스킨 선택</option>
				<?php foreach ($tpl_files as $sk => $sv) {?>
				<option value="<?=$sv?>"><?=$sv?></option>
				<?php }?>
			</select>

			<select name="skin_mobile_<?php echo $v;?>" class="rt-input" style="width:200px;">
				<option value=""><?php echo $tit_v;?> 모바일 스킨 선택</option>
				<?php foreach ($tpl_files as $sk => $sv) {?>
				<option value="<?=$sv?>"><?=$sv?></option>
				<?php }?>
			</select>
		</p>
		<?
	}
}
else if ($env->_get['mode'] == "delete" && is_numeric($env->_get['bseq']))
{
	$arr = $dbo->fetch("SELECT * FROM RT_RTBOARD WHERE bseq='".$env->_get['bseq']."'");

	if ($dbo->query("DELETE FROM RT_RTBOARD WHERE bseq='".$env->_get['bseq']."'")) {

		//게시판 환경 설정 레코드 삭제
		$dbo->query("DELETE FROM RT_RTBOARD_".strtoupper($arr['theme'])."_CONF WHERE bcode='".$arr['bcode']."'");

		//추가필드 데이터 삭제
		$dbo->query("DELETE FROM RT_RTBOARD_ADD_FIELD WHERE bcode='".$arr['bcode']."'");

		//게시판의 등록 게시물 삭제
		$dbo->query("DELETE FROM RT_RTBOARD_".strtoupper($arr['theme'])." WHERE bcode='".$arr['bcode']."'");

		//삭제할 첨부파일 정보
		$fr = $dbo->fetch_list("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$arr['bcode']."'");

		//실제 첨부파일 삭제
		for ($m = 0; $m < count($fr); $m++) {
			$target_file = RT_DOC_ROOT.$fr[$m]['path_base'].$fr[$m]['path_sub'].$fr[$m]['file_new'];
			if (is_file($target_file)) {
				@unlink($target_file);
			}
		}

		//첨부파일 등록 정보 삭제
		$dbo->query("DELETE FROM RT_RTBOARD_FILES WHERE bcode='".$r['bcode']."'");

		//게시판의 댓글 데이터 삭제
		$dbo->query("DELETE FROM RT_RTBOARD_CMT WHERE bcode='".$arr['bcode']."'");

		//게시판 스킨 파일은 삭제하지 않음(재사용의 여지)

		rt_js_move("", "parent", "href", RTW_ADM."/app/?appcode=rtboard&sd=".$env->_get['sd']);

	} else {
		rt_js_msg("시스템문제로 등록되지 않았습니다.");
	}

}
exit;
?>