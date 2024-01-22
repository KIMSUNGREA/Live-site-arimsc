<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: 카테고리 정보 관리용 클래스, 주로 '/rintkit/plugin/dtree/dtree.js'와 조합하여 활용
// 주의			: 코드 추가시 상위 카테고리가 없다면 상위 카테고리 코드는 -1로 입력함
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if( !class_exists("category") )
{
	class category
	{
		//----------------------------------------------------------------------------------------------

		var $dbo			= NULL;
		var $db_tbl			= "RT_CATEGORY";

		var $groupcode		= 'BASIC';	//카테고리 종류 구분용 필드
		var $listdata		= array();

		//단일 레코드의 처리를 위한 변수
		var $record			= array('groupcode'	=>'',
									'code'		=>'',
									'parent'	=>'',
									'sort'		=>0,
									'label'		=>'');

		//카테고리 정보 레코드 리스트, fetch_list 통해 배열형태로 전달받는 것을 가정함
		var $record_list	= array();
		var $data			= array();

		//----------------------------------------------------------------------------------------------

		/**
		* 생성자
		*
		* @param	string				$as_groupcode		:	카테고리 종류 구분용 필드
		*/

		function category($as_groupcode='BASIC')
		{
			global $dbo,$rt_conf_db;

			$this->dbo			= $dbo;
			$this->rt_conf_db	= $rt_conf_db;
			$this->groupcode	= $as_groupcode;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* DB상 레코드 추가, setRecord(...) 를 통한 입력용 데이터 초기화를 먼저 진행하여야 함
		*
		* @return	boolean
		*/

		function dbInsert()
		{
			$res = $this->dbo->insert($this->db_tbl, $this->record);

			//순서를 재 정렬함
			if($res)
				$this->dbSortReset($this->record['parent'], $this->record['groupcode']);

			return ($res) ? true : false;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* DB상 레코드 추가, setRecord(...) 를 통한 입력용 데이터 초기화를 먼저 진행하여야 함
		*
		* @return	boolean
		*/

		function dbUpdate()
		{
			$res = $this->dbo->update($this->db_tbl, $this->record, "(groupcode='" . $this->record['groupcode'] . "') AND (code='" . $this->record['code'] . "')");

			//순서를 재 정렬함
			if($res)
				$this->dbSortReset($this->record['parent'], $this->record['groupcode']);

			return ($res) ? true : false;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* DB상 레코드를 특정위치에 끼워넣기
		*
		* @param	String				$as_code			:	코드
		* @param	String				$as_parent			:	삽입될 위치의 상위분류 코드
		* @param	Integer				$ai_sort			:	삽입될 위치
		* @param	String				$as_groupcode		:	그룹코드
		* @return	boolean
		*/

		function dbUpdatePosition($as_code, $as_parent, $ai_sort=1, $as_groupcode=null)
		{
			$this->groupcode = is_null($as_groupcode) ? $this->groupcode : $as_groupcode;

			//삽입될 위치를 확보함
			$query = "
				UPDATE ".$this->db_tbl." SET sort=sort+1
				WHERE `groupcode`='" . $this->groupcode . "' AND `parent`='" . $as_parent . "' AND `sort` >= '" . $ai_sort . "'";
			$res = $this->dbo->query($query);

			//자신을 끼워넣기 처리함
			$query = "
				UPDATE ".$this->db_tbl." SET `parent`='" . $as_parent . "', sort='" . $ai_sort . "'
				WHERE `groupcode`='" . $this->groupcode . "' AND `code`='" . $as_code . "'";

			$res = $this->dbo->query($query);

			//순서를 재 정렬함
			if($res)
				$this->dbSortReset($as_parent, $this->groupcode);

			return ($res) ? true : false;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* DB상 레코드 조회
		*/

		function dbLoadCategory($as_groupcode=null)
		{
			$this->groupcode = is_null($as_groupcode) ? $this->groupcode : $as_groupcode;
			$query = "SELECT * FROM ".$this->db_tbl." WHERE (groupcode='" . $this->groupcode . "') ORDER BY parent, sort";
			$this->setList($this->dbo->fetch_list($query));
		}

		//----------------------------------------------------------------------------------------------

		/**
		* DB상 레코드 순서 재정렬 쿼리 : 상위 코드가 같은 데이터에 대한 순서 자동정렬
		*
		* @param	String				$as_parent			:	상위분류 코드
		* @param	String				$as_groupcode		:	그룹코드
		* @return	boolean
		*/

		function dbSortReset($as_parent, $as_groupcode=null)
		{
			$as_groupcode = is_null($as_groupcode) ? $this->groupcode : $as_groupcode;

			$query = "
				UPDATE ".$this->db_tbl." AS target
					INNER JOIN (
						SELECT @rownum:=@rownum+1 AS RNO, A.*
						FROM
						(SELECT * FROM ".$this->db_tbl." WHERE `groupcode`='" . $as_groupcode . "' AND `parent`='" . $as_parent . "' ORDER BY `sort`, `code`) AS A,
						(SELECT @rownum:=0) AS B
					) tmp
					ON target.groupcode = tmp.groupcode
						AND target.code = tmp.code
				SET	target.sort = tmp.RNO";

			$res = $this->dbo->query($query);
			return ($res) ? true : false;
		}



		//----------------------------------------------------------------------------------------------

		/**
		* 레코드 설정 : 단일 레코드에 대한 값을 적용하기 위한 인터페이스
		*
		* @param	String				$as_label			:	라벨
		* @param	String				$as_parent			:	상위분류 코드
		* @param	Integer				$ai_sort			:	분류 위치
		* @param	String				$as_code			:	자신의 코드
		* @param	String				$as_groupcode		:	그룹코드
		*/

		function setRecord($as_label, $as_parent="", $ai_sort=0, $as_code=null, $as_groupcode=null) {
			$this->record['label'		] = trim($as_label);
			$this->record['parent'		] = $as_parent;
			$this->record['sort'		] = $ai_sort;
			$this->record['code'		] = (is_null($as_code) ? time() : $as_code);
			$this->record['groupcode'	] = (is_null($as_groupcode) ? $this->groupcode : $as_groupcode);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* DB 레코드 별도 적용 : 다른 함수/클래스를 통해 DB레코드 값을 조회한 경우에 적용하기 위한 인터페이스
		*
		* @param	Array				$aa_list		:	필드명과 데이터로 구성된 배열
		* @return	Integer								:	데이터 개수
		*/

		function setList($aa_list) {
			$this->record_list = $aa_list;
			return count($this->record_list);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 카테고리 리스트 출력
		*
		* @param	String				$code		:	선택된 페이지 이하의 리스트를 목록으로 나열
		* @param	Integer				$depth		:	카테고리 깊이 카운트
		* @return									:	데이터 개수
		*/

		function setCateList($code, $depth=0) {

			$depth++;

			$query = "SELECT * FROM ".$this->db_tbl." WHERE (groupcode='" . $this->groupcode . "') AND parent='".$code."' ORDER BY sort";
			$r = $this->dbo->fetch_list($query);

			$cnt = count($r);

			if ($cnt > 0) {
				for ($m = 0; $m < $cnt; $m++) {
					$this->listdata['code'][] = $r[$m]['code'];
					$this->listdata['label'][] = $r[$m]['label'];
					$this->listdata['parent'][] = $r[$m]['parent'];
					$this->listdata['depth'][] = $depth;

					//하위 Depth 탐색
					$this->setCateList($r[$m]['code'],$depth);
				}
			} else {
				return false;
			}
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 현재 카테고리 기준 상위 카테고리 정보 출력
		*
		* @param	String				$code		:	검토할 카테고리 코드
		*/

		function getCateInfo($code) {

			//현재 카테고리 검색
			$nowc = $this->dbo->fetch("SELECT * FROM ".$this->db_tbl." WHERE (groupcode='" . $this->groupcode . "') AND code='".$code."'");

			$this->data[] = $nowc['label'];

			if ($nowc['parent'] == "0") {

				return false;

			} else {

				//부모 카테고리 검색
				$schc = $this->dbo->fetch("SELECT * FROM ".$this->db_tbl." WHERE (groupcode='" . $this->groupcode . "') AND code='".$nowc['parent']."'");

				//상위 Depth 탐색
				$this->getCateInfo($schc['code'], $ctArr);
			}
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 특정 레코드의 값을 반환, js/sql 출력을 위해 홑따옴표에 대한 파싱처리 진행
		*
		* @param	Integer				$ai_index		:	데이터 레코드 키
		* @param	String				$as_field		:	필드명
		* @return	String		:	데이터
		*/

		function getField($ai_index, $as_field) {
			if(count($this->record_list) < $ai_index)
				return '';

			return str_replace("'", "\'", $this->record_list[$ai_index][$as_field]);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* '/rintkit/plugin/dtree/dtree.js' 용 javascript 출력
		*
		* @param	String					$as_dTree_instance		:	javascript 인스턴스 명칭
		* @param	Array					$as_link				:	링크페이지
		*/

		function getPageJSCode($as_dTree_instance, $as_link="#;")
		{
			//js코드출력
			$rtn = "";
			$linkurl = "";

			//최상위 설정
			$domain = (empty($this->rt_conf_db['domain']))?"domain":$this->rt_conf_db['domain'];
			$rtn .= $as_dTree_instance.".add('0','-1','".$domain."','".$as_link."&code=0');\r\n";

			for($m=0; $m < count($this->record_list); $m++)
			{
				$_c = $this->dbo->fetch("SELECT * FROM RT_PAGE WHERE pcode='".$this->getField($m, 'code')."'");

				if ($_c['use_is'] == "y" && $_c['forward_is'] == "y") {
					$addstr = "[F] ";
				} else if ($_c['use_is'] == "n") {
					$addstr = "[X] ";
				} else {
					$addstr = "";
				}

				$linkurl = $as_link."&code=".$this->getField($m, 'code');
				$rtn .= $as_dTree_instance.".add('" . $this->getField($m, 'code')."','".$this->getField($m, 'parent')."','".$addstr.$this->getField($m, 'label')."','".$linkurl."');\r\n";
			}

			return $rtn;
		}

		//----------------------------------------------------------------------------------------------
	}
}
?>