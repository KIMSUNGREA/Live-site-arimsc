<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: product controller
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-----------------------------------------------------------------------------------------

if (!class_exists("product"))
{
	class product
	{
		var $env, $dbo, $app, $rtm, $rt_conf_db, $cls_pg, $pdt_conf, $cls_board, $cls_ct, $c;

		//----------------------------------------------------------------------------------------------

		function product() {

			global $env, $dbo, $rt_conf_db, $cls_rtm, $cls_pg;

			$this->env = $env;
			$this->dbo = $dbo;
			$this->tbl = "RT_PRODUCT";
			$this->rtm = $cls_rtm;
			$this->cls_pg = $cls_pg;
			$this->pdt_conf = $pdt_conf;
			$this->rt_conf_db = $rt_conf_db;

			//APP 정보
			$this->app = rt_app_info("product");

			//제품 환경 설정
			$this->pdt_conf = $this->dbo->fetch("SELECT * FROM RT_PRODUCT_CONF");

			//게시판
			rt_load_component("board");

			//페이지 출력 수 설정
			if ($this->cls_pg->conn_screen == "mobile") {
				$list_cnt = $this->pdt_conf['page_cnt_mobile'];
				$block_cnt = $this->pdt_conf['block_cnt_mobile'];
			} else {
				$list_cnt = $this->pdt_conf['page_cnt'];
				$block_cnt = $this->pdt_conf['block_cnt'];
			}

			$this->cls_board = new board($this->tbl, $list_cnt, $block_cnt);

			//분류 정보
			rt_load_component("category");
			$this->cls_ct = new category("PRODUCT");

			//보여질 분류코드 설정
			if (empty($env->_get['c'])) {
				$tmpq = $this->dbo->fetch("SELECT * FROM RT_CATEGORY WHERE groupcode='PRODUCT' AND parent='0' ORDER BY sort ASC LIMIT 1");
				$autoct = $this->dbo->fetch("SELECT * FROM RT_CATEGORY WHERE groupcode='PRODUCT' AND parent='".$tmpq['code']."' ORDER BY sort ASC LIMIT 1");
				$this->c = $autoct['code'];
			} else {
				$this->c = $env->_get['c'];
			}
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 스킨 출력
		 */

		function display() {

			$ct = $this->dbo->fetch("SELECT * FROM RT_CATEGORY WHERE groupcode='PRODUCT' AND code='".$this->c."'");
			$ct_conf = $this->dbo->fetch("SELECT * FROM RT_PRODUCT_CATE_CONF WHERE code='".$this->c."'");

			//분류 사용여부
			if ($ct_conf['use_is'] == "n") {
				rt_js_move("사용하지 않는 분류입니다.", "self", "href", "/");exit;
			}

			$this->cls_ct->getCateInfo($this->c);

			//템틀릿 컴포넌트 로드
			rt_load_component("tpl");
			$tpl = new tpl(RT_DOC_ROOT.$this->app['app_path']);

			//스킨 파일 설정
			if ($this->cls_pg->conn_screen == "mobile") {

				$skin_arr['skin_list'	] = $this->pdt_conf['skin_list_m'];
				$skin_arr['skin_view'	] = $this->pdt_conf['skin_view_m'];

			} else {

				$skin_arr['skin_list'	] = $this->pdt_conf['skin_list'];
				$skin_arr['skin_view'	] = $this->pdt_conf['skin_view'];
			}

			//데이터 세팅
			require_once RT_DOC_ROOT.$this->app['app_path']."/user/index.php";

			//스킨 세팅
			$tpl->define(array(
				'product' => $_def['skin']
			));

			//스킨 출력
			$tpl->print_("product");
		}

		//----------------------------------------------------------------------------------------------

		/**
		* View 페이지에서 다음 제품
		*
		* @param	integer					$ai_seq			:	현재 보는 글의 고유키
		* @param	string					$as_cate		:	제품 분류
		* @return	array
		*/

		function next_post($ai_seq, $as_cate)
		{
			$q = "SELECT * FROM ".$this->tbl." WHERE seq < ".$ai_seq." AND cate='".$as_cate."' ORDER BY ord DESC,reg_date ASC LIMIT 1";
			$tmp_arr = $this->dbo->fetch($q);

			if (is_numeric($tmp_arr['seq'])) {
				$r['result'		] = true;
				$r['seq'		] = $tmp_arr['seq'];
				$r['pdt_name'	] = $tmp_arr['pdt_name'];
			} else {
				$r['pdt_name'	] = "다음 글이 없습니다.";
				$r['result'		] = false;
			}

			return $r;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* View 페이지에서 이전 제품
		*
		* @param	integer					$ai_seq			:	현재 보는 글의 고유키
		* @param	string					$as_cate		:	제품 분류
		* @return	array
		*/

		function prev_post($ai_seq, $as_cate)
		{
			$q = "SELECT * FROM ".$this->tbl." WHERE seq > ".$ai_seq." AND cate='".$as_cate."' ORDER BY ord ASC,reg_date DESC LIMIT 1";
			$tmp_arr = $this->dbo->fetch($q);

			if (is_numeric($tmp_arr['seq'])) {
				$r['result'		] = true;
				$r['seq'		] = $tmp_arr['seq'];
				$r['pdt_name'	] = $tmp_arr['pdt_name'];
			} else {
				$r['pdt_name'	] = "이전 글이 없습니다.";
				$r['result'		] = false;
			}

			return $r;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 게시판 리스트 페이징
		*
		* @param	string				$page_name		:	게시판 페이징 출력
		* @return	string
		*/

		function page_index($page_name)
		{
			$this->cls_board->add_url = "&".$this->cls_board->add_url;
			$ret_val = "<div class='rt-page-index'>";
			if ($this->cls_board->total_block <= $this->cls_board->block) $this->cls_board->last_page = $this->cls_board->total_pages;
			if ($this->cls_board->block > 1) {
				$go_page = $this->cls_board->first_page;
				$ret_val.= "<a href='".$page_name."?pg=1".$this->cls_board->add_url."' class='prev prev-all'>&lt;&lt;</a> <a href='".$page_name."?pg=".$go_page.$this->cls_board->add_url."' class='prev'>&lt;</a>";
			} else {
				$go_page = $this->cls_board->pages - 1;
				if ($go_page > 0) {
					$ret_val.= "<a href='".$page_name."?pg=1".$this->cls_board->add_url."' class='prev prev-all'>&lt;&lt;</a> <a href='".$page_name."?pg=".$go_page.$this->cls_board->add_url."' class='prev'>&lt;</a>";
				} else {
					$ret_val.= "<a href='".$page_name."?pg=1".$this->cls_board->add_url."' class='prev prev-all'>&lt;&lt;</a> <a href='".$page_name."?pg=1".$this->cls_board->add_url."' class='prev'>&lt;</a>";
				}
			}

			for ($i = $this->cls_board->first_page + 1; $i <= $this->cls_board->last_page; $i++) {
				if ($this->cls_board->pages == $i) {
					$ret_val.= " <a href='#;' class='on'>".$i."</a>";
				} else {
					$ret_val.= " <a href='".$page_name."?pg=".$i.$this->cls_board->add_url."'>".$i."</a>";
				}
			}

			if($this->cls_board->last_page == 0) {
				$ret_val.= " <a href='#;' class='on'>1</a>";
			}

			if($this->cls_board->block < $this->cls_board->total_block) {
				$go_page = $this->cls_board->last_page + 1;
				$ret_val.= " <a href='".$page_name."?pg=".$go_page.$this->cls_board->add_url."' class='next'>&gt;</a> <a href='".$page_name."?pg=".$this->cls_board->total_pages.$this->cls_board->add_url."' class='next next-all'>&gt;&gt;</a>";
			} else {
				$go_page = $this->cls_board->pages + 1;
				if ($go_page > $this->cls_board->total_pages) {
					$ret_val.= " <a href='".$page_name."?pg=".$this->cls_board->total_pages.$this->cls_board->add_url."' class='next'>&gt;</a> <a href='".$page_name."?pg=".$this->cls_board->total_pages.$this->cls_board->add_url."' class='next next-all'>&gt;&gt;</a>";
				} else {
					$ret_val.= " <a href='".$page_name."?pg=".$go_page.$this->cls_board->add_url."' class='next'>&gt;</a> <a href='".$page_name."?pg=".$this->cls_board->total_pages.$this->cls_board->add_url."' class='next next-all'>&gt;&gt;</a>";
				}
			}

			$ret_val.= "</div>";

			return $ret_val;
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 접근 권한 설정
		*
		* @param	string					$auth_part		:	접근 권한 종류(func 명)
		* @param	string					$check_code		:	체크할 분류 코드
		* @return	array
		 */

		function check_auth($auth_part, $check_code) {

			$ct = $this->dbo->fetch("SELECT * FROM RT_PRODUCT_CATE_CONF WHERE code='".$check_code."'");

			if ($ct['auth_en'] == "each") {
				$arsz = unserialize(html_entity_decode($ct['auth_'.$auth_part]));
			} else if ($ct['auth_en'] == "common") {
				$arsz = unserialize(html_entity_decode($this->pdt_conf['auth_'.$auth_part]));
			}

			$auth_is = false;
			if (count($arsz) > 0) {

				if ($this->rtm->is_login()) {

					for ($m = 0; $m < count($arsz); $m++) {
						if ($arsz[$m] == $this->rtm->gr) {
							$auth_is = true;
						}
					}

				} else {
					$auth_is = (is_numeric($arsz[0]) && $arsz[0] == "0") ? true : false;
				}
			}

			return $auth_is;
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 초기화
		 */

		function reset_app() {

			if ($this->dbo->query("TRUNCATE TABLE RT_PRODUCT") && 
				$this->dbo->query("TRUNCATE TABLE RT_PRODUCT_OPTION") && 
				$this->dbo->query("TRUNCATE TABLE RT_PRODUCT_FILES") && 
				$this->dbo->query("TRUNCATE TABLE RT_PRODUCT_FORM_TPL")) {

				return true;
			} else {
				return false;
			}
		}

		//----------------------------------------------------------------------------------------------
	}

	$cls_pdt = new product(); 
}
?>