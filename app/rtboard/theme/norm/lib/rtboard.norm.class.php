<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 커뮤니티형 게시판 컨트롤러
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if( !class_exists("rtboard_norm") )
{
	class rtboard_norm extends board
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

		function rtboard_norm($ai_page_num=10, $ai_page_block=10)
		{
			$this->board("RT_RTBOARD_NORM", $ai_page_num, $ai_page_block);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 포스트에 첨부된 파일의 정보를 회신
		*
		* @param	string					$as_bcode			:	게시판 코드
		* @param	integer					$ai_seq				:	고유키
		* @return	array
		*/

		function get_attc_info($as_bcode, $ai_seq)
		{
			$r = $this->dbo->fetch_list("SELECT * FROM RT_RTBOARD_FILES WHERE bcode='".$as_bcode."' AND post_seq='".$ai_seq."' ORDER BY file_num ASC");

			if (count($r) > 0) {
				$r['result'		] = true;
				$r['data'		] = $r;
			} else {
				$r['result'		] = false;
			}

			return $r;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* View 페이지에서 다음글
		*
		* @param	integer					$ai_seq			:	현재 보는 글의 고유키
		* @param	string					$as_bcode		:	현재 보는 글의 고유키
		* @return	array
		*/

		function next_post($ai_seq, $as_bcode)
		{
			$q = "SELECT * FROM ".$this->db_tbl." WHERE seq > ".$ai_seq." AND bcode='".$as_bcode."' AND notice_is='n' ORDER BY seq ASC LIMIT 1";
			$tmp_arr = $this->dbo->fetch($q);

			if (is_numeric($tmp_arr['seq'])) {
				$r['result'		] = true;
				$r['seq'		] = $tmp_arr['seq'];
				$r['subject'	] = $tmp_arr['subject'];
			} else {
				$r['subject'	] = "다음 글이 없습니다.";
				$r['result'		] = false;
			}

			return $r;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* View 페이지에서 이전글
		*
		* @param	integer					$ai_seq			:	현재 보는 글의 고유키
		* @param	string					$as_bcode		:	현재 보는 글의 고유키
		* @return	array
		*/

		function prev_post($ai_seq, $as_bcode)
		{
			$q = "SELECT * FROM ".$this->db_tbl." WHERE seq < ".$ai_seq." AND bcode='".$as_bcode."' AND notice_is='n' ORDER BY seq DESC LIMIT 1";
			$tmp_arr = $this->dbo->fetch($q);

			if (is_numeric($tmp_arr['seq'])) {
				$r['result'		] = true;
				$r['seq'		] = $tmp_arr['seq'];
				$r['subject'	] = $tmp_arr['subject'];
			} else {
				$r['subject'	] = "이전 글이 없습니다.";
				$r['result'		] = false;
			}

			return $r;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* View 페이지 접속시 조회수 업데이트
		*
		* @param	integer					$ai_seq				:	글의 고유키
		* @param	string					$as_field			:	조회수 필드
		* @return	Boolean
		*/

		function hits_update($ai_seq, $as_field)
		{
			$q = "UPDATE ".$this->db_tbl." SET ".$as_field." = ".$as_field."+1  WHERE seq='".$ai_seq."' LIMIT 1";
			return ($this->dbo->query($q)) ? true : false;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 게시판 리스트 페이징
		*
		* @param	string				$page_name		:	게시판 페이징 출력
		* @return	string
		*/

		function page_index_old($page_name)
		{
			$this->add_url = "&".$this->add_url;
			$ret_val = "<div class='rt-page-index'>";
			if ($this->total_block <= $this->block) $this->last_page = $this->total_pages;
			if ($this->block > 1) {
				$go_page = $this->first_page;
				$ret_val.= "<a href='".$page_name."?pg=1".$this->add_url."' class='prev prev-all'>&lt;&lt;</a> <a href='".$page_name."?pg=".$go_page.$this->add_url."' class='prev'>&lt;</a>";
			} else {
				$go_page = $this->pages - 1;
				if ($go_page > 0) {
					$ret_val.= "<a href='".$page_name."?pg=1".$this->add_url."' class='prev prev-all'>&lt;&lt;</a> <a href='".$page_name."?pg=".$go_page.$this->add_url."' class='prev'>&lt;</a>";
				} else {
					$ret_val.= "<a href='".$page_name."?pg=1".$this->add_url."' class='prev prev-all'>&lt;&lt;</a> <a href='".$page_name."?pg=1".$this->add_url."' class='prev'>&lt;</a>";
				}
			}

			for ($i = $this->first_page + 1; $i <= $this->last_page; $i++) {
				if ($this->pages == $i) {
					$ret_val.= " <a href='#;' class='on'>".$i."</a>";
				} else {
					$ret_val.= " <a href='".$page_name."?pg=".$i.$this->add_url."'>".$i."</a>";
				}
			}

			if($this->last_page == 0) {
				$ret_val.= " <a href='#;' class='on'>1</a>";
			}

			if($this->block < $this->total_block) {
				$go_page = $this->last_page + 1;
				$ret_val.= " <a href='".$page_name."?pg=".$go_page.$this->add_url."' class='next'>&gt;</a> <a href='".$page_name."?pg=".$this->total_pages.$this->add_url."' class='next next-all'>&gt;&gt;</a>";
			} else {
				$go_page = $this->pages + 1;
				if ($go_page > $this->total_pages) {
					$ret_val.= " <a href='".$page_name."?pg=".$this->total_pages.$this->add_url."' class='next'>&gt;</a> <a href='".$page_name."?pg=".$this->total_pages.$this->add_url."' class='next next-all'>&gt;&gt;</a>";
				} else {
					$ret_val.= " <a href='".$page_name."?pg=".$go_page.$this->add_url."' class='next'>&gt;</a> <a href='".$page_name."?pg=".$this->total_pages.$this->add_url."' class='next next-all'>&gt;&gt;</a>";
				}
			}

			$ret_val.= "</div>";

			return $ret_val;
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
			$this->add_url = "&".$this->add_url;
			$ret_val = "<ul class='page_num'>";
			if ($this->total_block <= $this->block) $this->last_page = $this->total_pages;
			if ($this->block > 1) {
				$go_page = $this->first_page;
				$ret_val.= "<li><a href='".$page_name."?pg=".$go_page.$this->add_url."' class='left_btn'><img src='/assets/images/page_num_l.png'></a></li>";
			} else {
				$go_page = $this->pages - 1;
				if ($go_page > 0) {
					$ret_val.= "<li><a href='".$page_name."?pg=".$go_page.$this->add_url."' class='left_btn'><img src='/assets/images/page_num_l.png'></a></li>";
				} else {
					$ret_val.= "<li><a href='".$page_name."?pg=1".$this->add_url."' class='left_btn'><img src='/assets/images/page_num_l.png'></a></li>";
				}
			}

			for ($i = $this->first_page + 1; $i <= $this->last_page; $i++) {
				if ($this->pages == $i) {
					$ret_val.= "<li><a href='#;' class='on'>".$i."</a></li>";
				} else {
					$ret_val.= "<li><a href='".$page_name."?pg=".$i.$this->add_url."'>".$i."</a></li>";
				}
			}

			if($this->last_page == 0) {
				$ret_val.= "<a href='#;' class='on'>1</a>";
			}

			if($this->block < $this->total_block) {
				$go_page = $this->last_page + 1;
				$ret_val.= "<li><a href='".$page_name."?pg=".$go_page.$this->add_url."' class='right_btn'><img src='/assets/images/page_num_r.png'></a></li>";
			} else {
				$go_page = $this->pages + 1;
				if ($go_page > $this->total_pages) {
					$ret_val.= "<li><a href='".$page_name."?pg=".$this->total_pages.$this->add_url."' class='right_btn'><img src='/assets/images/page_num_r.png'></a></li>";
				} else {
					$ret_val.= "<li><a href='".$page_name."?pg=".$go_page.$this->add_url."' class='right_btn'><img src='/assets/images/page_num_r.png'></a></li>";
				}
			}

			$ret_val.= "</ul>";

			return $ret_val;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 폼 필드 출력 관리
		*
		* @param	array				$field			:	세팅된 필드 정보
		* @param	array				$data			:	입력된 필드 데이터
		* @param	boolean				$is_adm			:	관리자 모드 여부
		* @param	boolean				$is_data		:	필드 출력 시 설정데이터 출력 여부
		* @return	string
		**/


		function formset($field, $data, $is_adm=false, $is_data=true)
		{
			$seq = $field['seq'];
			$fieldname = "rtfeild_".$field['bcode']."_".$seq;

			/* Common var */
			if ($is_adm) {
				$req_addcls = "rt-input ";
			} else {
				$req_addcls = "rt-common-field";
			}

			if ($field['is_require']=="y") {
				$req_addcls.= " required";
				$req_msg = "msg='".$field['require_text']."'";
			} else {
				$req_addcls.="";$req_msg="";
			}
			$class = "rtboard-add-css-".$field['bcode']."-".$field['seq'];

			$size_h = "";
			if ($field['size_h'] > 0) {
				$size_h = "height:".$field['size_h']."px;";
			}

			$size_w = "";
			if ($field['size_w'] > 0) {
				$size_w = "width:".$field['size_w']."px;";
			}

			if (!$is_data) {
				$data[$seq]['val'] = "";
			}

			$ptr = "";
			switch ($field['type'])
			{
				case "text"	:

					$ptr.= "<input type='text' name='".$fieldname."' value='".$data[$seq]['val']."' style='".$size_w."' class='".$req_addcls." ".$class."' ".$req_msg.">";
				break;

				case "checkbox"	:

					$data_arr = explode(",", $field['data']);

					foreach ($data_arr as $k => $v) {
						$checked = ($data[$seq]['val'][$k] == $v)?"checked":"";
						$ptr.= "<label><input type='checkbox' name='".$fieldname."_".$k."' value='".$v."' ".$checked."> ".$v."</label> ";
					}
				break;

				case "radio"	:

					$data_arr = explode(",", $field['data']);

					foreach ($data_arr as $k => $v) {
						$checked = ($data[$seq]['val'] == $v)?"checked":"";
						$ptr.= "<label><input type='radio' name='".$fieldname."' value='".$v."' ".$checked." > ".$v."</label> ";
					}
				break;

				case "select"	:

					$data_arr = explode(",", $field['data']);

					$ptr.= "<select name='".$fieldname."' class='".$req_addcls." ".$class."' ".$req_msg.">";
					foreach ($data_arr as $k => $v) {
						$selected = ($data[$seq]['val'] == $v)?"selected":"";
						$ptr.= "<option value='".$v."' ".$selected.">".$v."</option>";
					}
					$ptr.= "</select>";

				break;

				case "textarea"	:

					$ptr.= "<textarea name='".$fieldname."' style='".$size_w.$size_h."' class='".$req_addcls." ".$class."' ".$req_msg.">".$data[$seq]['val']."</textarea>";
				break;
			}
			return $ptr;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 폼 데이터 출력 관리
		*
		* @param	array				$field			:	세팅된 필드 정보
		* @param	array				$data			:	입력된 필드 데이터
		* @return	string
		**/

		function formset_data($field, $data)
		{
			$ptr = "";
			$seq = $field['seq'];
			if ($field['type'] == "checkbox") {
				$ptr_arr = array();
				if (count($data[$seq]['val']) > 0) {
					foreach ($data[$seq]['val'] as $k => $v) {
						$ptr_arr[] = $v;
					}
					$ptr = join(",", $ptr_arr);
				}
			} else {
				$ptr.= $data[$seq]['val'];
			}

			return $ptr;
		}

		//----------------------------------------------------------------------------------------------
	}
}
?>
