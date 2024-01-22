<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: MySQL 연동 유틸
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (!class_exists("dbo_class")) {

	class dbo_class extends mysql_driver_class {

		var $drv;
		var $insert_id;


		//----------------------------------------------------------------------------------------------

		/**
		* 생성자
		*/

		function dbo_class() {

			$this->drv = new mysql_driver_class();
		}

		//----------------------------------------------------------------------------------------------

		/**
		* DB 레코드 입력
		*
		* @param	String				$db_table	:	대상 테이블명
		* @param	Array				$data		:	필드명과 데이터로 구성된 배열
		* @param	Boolen				$debug		:	디버그 여부
		* @return	Boolen
		*/

		function insert($db_table, $data, $debug=false) {

			foreach ($data as $key => $value) {
				$fields		.= "`".$this->sift($key)."`,";
				$field_vals	.= "'".$this->sift($value)."',";
			}
			$fields			= substr($fields, 0, strlen($fields)-1);
			$field_vals		= substr($field_vals, 0, strlen($field_vals)-1);
			$qry = "INSERT INTO ".$db_table." (".$fields.") VALUES (".$field_vals.")";

			if ($debug) {echo $qry."<br />";exit;}

			$res = $this->query($qry);
			$this->insert_id = $this->last_insert_id();

			return ($res) ? true : false;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* DB 데이터 업데이트
		*
		* @param	String				$db_table	:	대상 테이블명
		* @param	Array				$data		:	필드명과 데이터로 구성된 배열
		* @param	String				$where		:	업데이트 조건 필드
		* @param	Boolen				$debug		:	디버그 여부
		* @return	Boolen
		*/

		function update($db_table, $data, $where="", $debug=false) {

			foreach ($data as $key => $value) {
				$fields.= "`".$key."`='".$this->sift($value)."',";
			}
			$fields = substr($fields, 0, strlen($fields)-1);

			if ($fields) {
				if ($where) {
					$qry = "UPDATE ".$db_table." SET ".$fields." WHERE ".$where;
				} else {
					$qry = "UPDATE ".$db_table." SET ".$fields;
				}
			}

			if($debug) echo $qry."<br />";

			return ($this->query($qry)) ? true : false;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* select : single record
		*
		* @param	string				$query			:	DB 쿼리
		* @param	string				$arr_type		:	Array 세팅 타입, array or row
		* @param	boolen				$prt			:	디버그 여부
		* @return	array
		*/
		function fetch($query, $arr_type="array", $prt=false) {

			if($prt) echo $query."<br />";

			$this->query($query);

			if ($arr_type == "array") {
				$r =  @mysql_fetch_assoc($this->result_set);
			} else if ($arr_type == "row") {
				$r =  @mysql_fetch_row($this->result_set);
			}

			return $r;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 데이터 목록 가져오기
		*/
		function fetch_list($query, $prt=false) {

			if($prt) echo $query."<br />";

			$r = array();
			$this->query($query);
			for($m=0; $m < $this->num_rows(); $m++) {
				for($k=0; $k < $this->num_fields(); $k++) {
					$r[$m][$this->field_name($k)] = $this->result($m,$this->field_name($k));
				}
			}

			return $r;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 쿼리 데이터 입력 전 처리
		*/
		function sift($data) {

			return mysql_real_escape_string(htmlspecialchars($data));
		}

		//----------------------------------------------------------------------------------------------
	}

}
?>
