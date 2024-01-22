<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 게시판 댓글 관리
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if( !class_exists("rtboard_cmt") )
{
	class rtboard_cmt extends board
	{
		//----------------------------------------------------------------------------------------------

		var $cmt_db_tbl = "RT_RTBOARD_CMT";

		//----------------------------------------------------------------------------------------------

		/**
		* 게시판 생성자
		*
		* @param	integer					$ai_page_num		:	페이지 수
		* @param	integer					$ai_page_block		:	블럭 수
		*/

		function rtboard_cmt($ai_page_num=10, $ai_page_block=10)
		{
			$this->board("RT_RTBOARD_CMT", $ai_page_num, $ai_page_block);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 댓글 등록
		*
		* @param	array				$aa_data		:	연관 배열 형태의 데이터
		* @return	boolean
		*/

		function cmt_insert($aa_data)
		{
			$r = $this->dbo->fetch("SELECT MAX(ref) AS ref FROM ".$this->cmt_db_tbl);

			$aa_data['ref'			] = $r['ref'] + 1;
			$aa_data['re_step'		] = 0;
			$aa_data['re_level'		] = 0;

			$res = $this->dbo->insert($this->cmt_db_tbl, $aa_data);
			$this->insert_seq = $this->dbo->insert_id;
			return ($res) ? true : false;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 댓글의 댓글 달기
		*
		* @param	array				$aa_data		:	연관 배열 형태의 데이터
		* @return	boolean
		*/
		function cmt_reply($aa_data)
		{
			$this->dbo->query("UPDATE ".$this->cmt_db_tbl." SET re_step=re_step+1 WHERE ref='".$aa_data['ref']."' AND re_step > ".$aa_data['re_step']." AND post_seq='".$aa_data['post_seq']."'");

			$aa_data['re_step'		] = $aa_data['re_step'] + 1;
			$aa_data['re_level'		] = $aa_data['re_level'] + 1;

			return $this->dbo->insert($this->cmt_db_tbl, $aa_data);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 댓글 수정
		*
		* @param	array				$aa_data		:	연관 배열 형태의 데이터
		* @param	string				$as_where		:	where sql
		* @return	boolean
		*/

		function cmt_update($aa_data, $as_where="")
		{
			return $this->dbo->update($this->cmt_db_tbl, $aa_data, $as_where);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 댓글 리스트 페이징(프론트)
		*
		* @param	string				$page_name		:	게시판 페이징 출력
		* @return	string
		*/

		function comment_page_index($page_name)
		{
			$this->add_url = "&".$this->add_url;
			$ret_val = "<p class='paging'>";
			if ($this->total_block <= $this->block) $this->last_page = $this->total_pages;
			if ($this->block > 1) {
				$go_page = $this->first_page;
				$ret_val.= "<a href='".$page_name."?cpg=1".$this->add_url."' class='direction prev'><span> &lt;&lt; </span></a><a href='".$page_name."?cpg=".$go_page.$this->add_url."' class='direction prev'><span> &lt; </span></a>";
			} else {
				$go_page = $this->pages - 1;
				if ($go_page > 0) {
					$ret_val.= "<a href='".$page_name."?cpg=1".$this->add_url."' class='direction prev'><span> &lt;&lt; </span></a><a href='".$page_name."?cpg=".$go_page.$this->add_url."' class='direction prev'><span> &lt; </span></a>";
				} else {
					$ret_val.= "<a href='".$page_name."?cpg=1".$this->add_url."' class='direction prev'><span> &lt;&lt; </span></a><a href='".$page_name."?cpg=1".$this->add_url."' class='direction prev'><span> &lt; </span></a>";
				}
			}

			for ($i = $this->first_page + 1; $i <= $this->last_page; $i++) {
				if ($this->pages == $i) {
					$ret_val.= "<strong>".$i."</strong>";
				} else {
					$ret_val.= "<a href='".$page_name."?cpg=".$i.$this->add_url."'>".$i."</a>";
				}
			}

			if($this->last_page == 0) {
				$ret_val.= "<strong>1</strong>";
			}

			if($this->block < $this->total_block) {
				$go_page = $this->last_page + 1;
				$ret_val.= "<a href='".$page_name."?cpg=".$go_page.$this->add_url."' class='direction next'><span> &gt; </span></a><a href='".$page_name."?cpg=".$this->total_pages.$this->add_url."' class='direction next'><span> &gt;&gt; </span></a>";
			} else {
				$go_page = $this->pages + 1;
				if ($go_page > $this->total_pages) {
					$ret_val.= "<a href='".$page_name."?cpg=".$this->total_pages.$this->add_url."' class='direction next'><span> &gt; </span></a><a href='".$page_name."?cpg=".$this->total_pages.$this->add_url."' class='direction next'><span> &gt;&gt; </span></a>";
				} else {
					$ret_val.= "<a href='".$page_name."?cpg=".$go_page.$this->add_url."' class='direction next'><span> &gt; </span></a><a href='".$page_name."?cpg=".$this->total_pages.$this->add_url."' class='direction next'><span> &gt;&gt; </span></a>";
				}
			}

			$ret_val.= "</p>";

			return $ret_val;
		}

		//----------------------------------------------------------------------------------------------
	}
}
?>
