<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 게시판 컴포넌트
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if( !class_exists("board") )
{
	class board
	{
		//----------------------------------------------------------------------------------------------

		var $dbo			= NULL;
		var $env			= NULL;
		var $cls_pg			= NULL;
		var $db_tbl			= "";
		var $page_num		= 10;	//page_num
		var $page_block		= 10;	//page_block
		var $pages			= 1;	//pages
		var $total_pages;
		var $total_block;
		var $block;
		var $first_page;
		var $last_page;
		var $first;
		var $last;
		var $total_record_cnt;
		var $list_rec_cnt;
		var $add_search_qry;
		var $add_url;
		var $fix_where_qry	= "1=1";
		var $fix_url_val;
		var $insert_seq;

		//----------------------------------------------------------------------------------------------

		/**
		* 게시판 생성자
		*
		* @param	string					$as_db_tbl			:	DB 명
		* @param	integer					$ai_page_num		:	페이지 수
		* @param	integer					$ai_page_block		:	블럭 수
		*/

		function board($as_db_tbl, $ai_page_num=10, $ai_page_block=10)
		{
			global $dbo,$env,$cls_pg;

			$this->dbo			= $dbo;
			$this->env			= $env;
			$this->cls_pg		= $cls_pg;
			$this->db_tbl		= $as_db_tbl;
			$this->page_num		= $ai_page_num;
			$this->page_block	= $ai_page_block;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 게시판 리스트 구성 정보 세팅
		*/

		function init()
		{
			$this->add_url.= $this->fix_url_val;

			if ($this->env->_request['pcd']) {
				$this->add_url.= "&pcd=".$this->env->_request['pcd'];
			}

			if ($this->cls_pg->conn_screen == "mobile") {
				$this->add_url.= "&screen=mobile";
			}

			$this->set_total_record_cnt();

			if ($this->env->_get['cpg']) {
				$this->pages = (!$this->env->_get['cpg']) ? 1 : $this->env->_get['cpg'];
			} else {
				$this->pages = (!$this->env->_get['pg']) ? 1 : $this->env->_get['pg'];
			}
			$this->total_pages		= ceil($this->total_record_cnt / $this->page_num);
			$this->first			= $this->page_num * ($this->pages - 1);
			$this->last				= $this->pages * $this->page_num;
			$this->list_rec_cnt		= $this->total_record_cnt - $this->page_num * ($this->pages - 1); //id_num
			$this->total_block		= ceil($this->total_pages / $this->page_block);
			$this->block			= ceil($this->pages / $this->page_block);
			$this->first_page		= ($this->block - 1) * $this->page_block;
			$this->last_page		= $this->block * $this->page_block;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 게시판 리스트
		*
		* @param	string				$as_order_by		:	리스트 정렬 조건
		* @return	array
		*/

		function get_list($as_order_by="")
		{
			$order_by_qry = ($as_order_by) ? "ORDER BY ".$as_order_by : "";
			$query = "SELECT * FROM ".$this->db_tbl." WHERE ".$this->add_search_qry." ".$this->fix_where_qry." ".$order_by_qry." LIMIT ".$this->first.", ".$this->page_num;
			return $this->dbo->fetch_list($query);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 게시판 전체 데이터 개수
		*/

		function set_total_record_cnt()
		{
			$r = $this->dbo->fetch("SELECT COUNT(*) AS cnt FROM ".$this->db_tbl." WHERE ".$this->add_search_qry." ".$this->fix_where_qry);
			$this->total_record_cnt = $r['cnt'];
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 고정 쿼리 세팅
		*
		* @param	string					$as_qry			:	고정 쿼리 설정
		*/

		function set_fix_where_qry($as_qry) { $this->fix_where_qry = $as_qry; }

		//----------------------------------------------------------------------------------------------

		/**
		* 고정 URL 세팅
		*
		* @param	string					$as_url			:	고정 URL 설정
		*/

		function set_fix_url_val($as_url) { $this->fix_url_val = $as_url;}

		//----------------------------------------------------------------------------------------------

		/**
		* 레코드 추가
		*
		* @param	array				$aa_data		:	연관 배열 형태의 데이터
		* @return	boolean
		*/

		function insert($aa_data)
		{
			$res = $this->dbo->insert($this->db_tbl, $aa_data);
			$this->insert_seq = $this->dbo->insert_id;
			return ($res) ? true : false;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 데이터 수정
		*
		* @param	array				$aa_data		:	연관 배열 형태의 데이터
		* @param	string				$as_where		:	where sql
		* @return	boolean
		*/

		function update($aa_data, $as_where="")
		{
			return $this->dbo->update($this->db_tbl, $aa_data, $as_where);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 게시판 리스트 페이징
		*
		* @param	string				$page_name		:	게시판 페이징 출력
		* @return	string
		*/

		function put_page_num($page_name)
		{
			$this->add_url = "&".$this->add_url;
			$ret_val = "<div class='rt_pager'>";
			if ($this->total_block <= $this->block) $this->last_page = $this->total_pages;
			if ($this->block > 1) {
				$go_page = $this->first_page;
				$ret_val.= "<a href='".$page_name."?pg=1".$this->add_url."'>&lt;&lt;</a><a href='".$page_name."?pg=".$go_page.$this->add_url."'>&lt;</a>";
			} else {
				$go_page = $this->pages - 1;
				if ($go_page > 0) {
					$ret_val.= "<a href='".$page_name."?pg=1".$this->add_url."'>&lt;&lt;</a><a href='".$page_name."?pg=".$go_page.$this->add_url."'>&lt;</a>";
				} else {
					$ret_val.= "<a href='".$page_name."?pg=1".$this->add_url."'>&lt;&lt;</a><a href='".$page_name."?pg=1".$this->add_url."'>&lt;</a>";
				}
			}

			for ($i = $this->first_page + 1; $i <= $this->last_page; $i++) {
				if ($this->pages == $i) {
					$ret_val.= "<a href='#;' class='rt_active'>".$i."</a>";
				} else {
					$ret_val.= "<a href='".$page_name."?pg=".$i.$this->add_url."'>".$i."</a>";
				}
			}

			if($this->last_page == 0) {
				$ret_val.= "<a href='#;' class='rt_active'>1</a>";
			}

			if($this->block < $this->total_block) {
				$go_page = $this->last_page + 1;
				$ret_val.= "<a href='".$page_name."?pg=".$go_page.$this->add_url."'>&gt;</a><a href='".$page_name."?pg=".$this->total_pages.$this->add_url."'>&gt;&gt;</a>";
			} else {
				$go_page = $this->pages + 1;
				if ($go_page > $this->total_pages) {
					$ret_val.= "<a href='".$page_name."?pg=".$this->total_pages.$this->add_url."'>&gt;</a><a href='".$page_name."?pg=".$this->total_pages.$this->add_url."'>&gt;&gt;</a>";
				} else {
					$ret_val.= "<a href='".$page_name."?pg=".$go_page.$this->add_url."'>&gt;</a><a href='".$page_name."?pg=".$this->total_pages.$this->add_url."'>&gt;&gt;</a>";
				}
			}

			$ret_val.= "</div>";

			return $ret_val;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 댓글 리스트 페이징(관리자)
		*
		* @param	string				$page_name		:	게시판 페이징 출력
		* @return	string
		*/

		function comment_page_num($page_name)
		{
			$this->add_url = "&".$this->add_url;
			$ret_val = "<div class='rt_pager'>";
			if ($this->total_block <= $this->block) $this->last_page = $this->total_pages;
			if ($this->block > 1) {
				$go_page = $this->first_page;
				$ret_val.= "<a href='".$page_name."?cpg=1".$this->add_url."'>&lt;&lt;</a><a href='".$page_name."?cpg=".$go_page.$this->add_url."'>&lt;</a>";
			} else {
				$go_page = $this->pages - 1;
				if ($go_page > 0) {
					$ret_val.= "<a href='".$page_name."?cpg=1".$this->add_url."'>&lt;&lt;</a><a href='".$page_name."?cpg=".$go_page.$this->add_url."'>&lt;</a>";
				} else {
					$ret_val.= "<a href='".$page_name."?cpg=1".$this->add_url."'>&lt;&lt;</a><a href='".$page_name."?cpg=1".$this->add_url."'>&lt;</a>";
				}
			}

			for ($i = $this->first_page + 1; $i <= $this->last_page; $i++) {
				if ($this->pages == $i) {
					$ret_val.= "<a href='#;' class='rt_active'>".$i."</a>";
				} else {
					$ret_val.= "<a href='".$page_name."?cpg=".$i.$this->add_url."'>".$i."</a>";
				}
			}

			if($this->last_page == 0) {
				$ret_val.= "<a href='#;' class='rt_active'>1</a>";
			}

			if($this->block < $this->total_block) {
				$go_page = $this->last_page + 1;
				$ret_val.= "<a href='".$page_name."?cpg=".$go_page.$this->add_url."'>&gt;</a><a href='".$page_name."?cpg=".$this->total_pages.$this->add_url."'>&gt;&gt;</a>";
			} else {
				$go_page = $this->pages + 1;
				if ($go_page > $this->total_pages) {
					$ret_val.= "<a href='".$page_name."?cpg=".$this->total_pages.$this->add_url."'>&gt;</a><a href='".$page_name."?cpg=".$this->total_pages.$this->add_url."'>&gt;&gt;</a>";
				} else {
					$ret_val.= "<a href='".$page_name."?cpg=".$go_page.$this->add_url."'>&gt;</a><a href='".$page_name."?cpg=".$this->total_pages.$this->add_url."'>&gt;&gt;</a>";
				}
			}

			$ret_val.= "</div>";

			return $ret_val;
		}

		//----------------------------------------------------------------------------------------------
	}
}
?>
