<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: MySQL 연동 드라이버
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

if (!class_exists("mysql_driver_class")) {

	class mysql_driver_class {

		var $conn		= null;
		var $dbconfig	= array();
		var $connected	= 0;
		var $query		= '';
		var $reference	= 0;
		var $result_set = null;

		//----------------------------------------------------------------------------------------------

		/**
		* 생성자 : MySQL 접속 정보 설정
		*/

		function mysql_driver_class() {

			require_once "mysql.driver.config.php";

			$this->dbconfig = $_cfg_db;
			$this->db_connect();
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 다중 인스턴스 연결 설정
		*/

		function db_connect() {

			if (0 == $this->reference) {
				$this->conn = $this->connect($this->dbconfig['host'].":".$this->dbconfig['port'], $this->dbconfig['user'], $this->dbconfig['pass']);
				$this->select_db($this->dbconfig['name']);
				$this->reference++;
			}
		}

		//----------------------------------------------------------------------------------------------

		/**
		* MySQL 연동
		* 
		* @return	object
		*/

		function connect($db_name, $db_user, $db_pass) {

			$this->conn = @mysql_connect($db_name, $db_user, $db_pass) or $this->error('현재 사용자가 많아 서버 접속이 원할하지 않습니다!',$this->_error());
			return $this->conn;

		}

		//----------------------------------------------------------------------------------------------

		/**
		* 작업 DB 선택
		* 
		* @return	array
		*/

		function select_db($db_name) {

			$r = @mysql_select_db($db_name) or $this->error('DB에 접속하지 못했습니다.',$this->_error());

			//UTF-8 인코딩 설정
			@mysql_query("set names utf8");

			return $r;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 쿼리 실행
		* 
		* @return	resource
		*/

		function query($query) {
			$this->result_set = @mysql_query($query);
			return $this->result_set;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 실행된 쿼리 리소스로 부터 개수 리턴
		* 
		* @return	integer
		*/

		function rows_count($query) {
			$this->result_set = $this->query($query);
			return $this->num_rows();
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 실행된 쿼리 리소스로 부터 데이터 리턴
		*/

		function result($row, $fields) {

			if ($this->num_rows()) {
				$r = @mysql_result($this->result_set, $row, $fields);
			} else {
				$r = 0;
			}

			return $r;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* result 인자와 관련된 점유 메모리를 해제
		* 
		* @return	boolean
		*/

		function free_result() {
			return @mysql_free_result($this->result_set);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 테이블의 특정 필드명 반환
		* 
		* @return	string
		*/

		function field_name($field_index) {
			return @mysql_field_name($this->result_set,$field_index);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 테이블의 필드 개수 반환
		* 
		* @return	integer
		*/

		function num_fields() {
			return @mysql_num_fields($this->result_set);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* Insert한 레코드의 id를 반환
		* 
		* @return	integer
		*/

		function last_insert_id() {
			return @mysql_insert_id();
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 실행된 쿼리 개수 리턴
		* 
		* @return	integer
		*/

		function num_rows() {
			return @mysql_num_rows($this->result_set);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 특수문자 이스케이프 후 반환
		* 
		* @return	string
		*/

		function query_escape($str) {
			return mysql_real_escape_string($str);
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 쿼리 에러 출력
		* 
		* @return	string
		*/

		function error($custom_msg, $db_msg='') {

			echo "<!--
				$custom_msg <br />
				$db_msg
				-->";
			exit;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 인스턴스 종료, 메모리 반환
		* 
		* @return	boolean
		*/

		function close() {

			$this->reference--;

			if (0 == $this->reference) {

				if (is_resource($this->result_set)) $this->free_result();
				$this->close();
			}
		}

		//----------------------------------------------------------------------------------------------
	}

}
?>
