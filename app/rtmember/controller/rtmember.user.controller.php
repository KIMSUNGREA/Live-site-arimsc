<?php
//-----------------------------------------------------------------------------------------
// 프로그램		: RINT-KIT
// 제작			: 린트킷(rintkit.com)
// 버전			: 1.0
// 인코딩		: UTF-8
// 설명			: RTMEMBER User controller
//-----------------------------------------------------------------------------------------

if (defined('RINTKIT') === FALSE) { exit('잘못된 경로입니다.'); }

//-----------------------------------------------------------------------------------------

if (!class_exists("rtmember_user"))
{
	class rtmember_user
	{
		var $env, $dbo, $app, $id, $nm, $gr, $_rtm_conf, $cls_pg;

		//----------------------------------------------------------------------------------------------

		function rtmember_user() {

			global $env, $dbo, $rt_app, $_rtm_conf, $cls_pg;

			$this->env = $env;
			$this->dbo = $dbo;
			$this->cls_pg = $cls_pg;
			$this->tbl = "RT_RTMEMBER";

			$this->id = "";
			$this->nm = "";
			$this->gr = "";
			$this->type = "";

			//APP 정보
			$this->app = $rt_app;
			$this->_rtm_conf = $_rtm_conf;

			//세션 등록
			$this->id = $this->env->_session['RT_USER_ID'];
			$this->nm = $this->env->_session['RT_USER_NM'];
			$this->gr = $this->env->_session['RT_USER_GR'];
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 회원 로그인 여부
		 */

		function is_login() {
			return (empty($this->id)) ? false : true;
		}

		//----------------------------------------------------------------------------------------------

        /**
         * curl 통신용
         * api 호출용
         *
         * @param      $url 호출 URL
         * @param null $headers header
         * @return bool|string
         */
        private function getHttp($url, $headers=null)
        {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($ch);

            curl_close($ch);

            return $result;
        }

		//----------------------------------------------------------------------------------------------

		/** 
		 * 로그인 처리
		 *
		 * @param		string				$as_id				:	회원 아이디
		 * @param		string				$as_pw				:	회원 비밀번호
		 * @return		boolean
		 */

		function login($as_id, $as_pw) {

			if (empty($as_id)) {
				rt_js_msg("아이디를 입력해 주세요", "parent"); exit;
			} else if (empty($as_pw)) {
				rt_js_msg("비밀번호를 입력해 주세요", "parent"); exit;
			}

			//받은 비밀번호 암호화
			$encode_pw = rt_password($as_pw);

			//회원 검색
			$r = $this->dbo->fetch("SELECT * FROM ".$this->tbl." WHERE user_id='".$as_id."' AND user_pw='".$encode_pw."' LIMIT 1");

			if (empty($r['user_id'])) {

				rt_js_msg("정보를 찾을 수 없습니다. ID/PW를 다시 확인해 주세요.", "parent"); exit;

			} else {

				//베스트후기 선정 알림
				if ($r['review_alarm'] == "y") {
					$this->dbo->query("UPDATE RT_RTMEMBER SET review_alarm='n' WHERE user_id='".$r['user_id']."'");
					rt_js_msg("알림) 고객님의 후기가 베스트후기에 선정되었습니다.\\n사은품 신청을 해주세요.");
				}

				//차단된 회원
				if ($r['blockout_en'] == "y") {
					rt_js_msg("이용할 수 없는 계정정보입니다", "parent"); exit;
				}

				//탈퇴처리된 회원
				if ($r['withdraw_en'] == "y") {
					rt_js_msg("가입된 계정이 없는 정보입니다", "parent"); exit;
				}

				//휴면 회원
				if ($r['rest_en'] == "y") {
					
					//회원 아이디 메일 발송
					rt_load_component("smtp");

					$cls_email = new smtp_class();

					$rest_arr = array();
					$rest_arr['user_id'] = $r['user_id'];
					$rest_arr['user_nm'] = $r['user_nm'];
					$rest_arr['email'] = $r['email'];
					$cls_email->member_rest($rest_arr);

					rt_js_msg("휴면 계정입니다. 가입된 E-mail로 휴면 계정 해지 메일이 전송되었습니다.");
					exit;
				}

				//관리자 승인
				if ($this->_rtm_conf['mb_approval_en'] == "y") {
					if ($r['approval_en'] == "n") {
						rt_js_msg("관리자의 승인 후 로그인이 가능합니다", "parent"); exit;
					}
				}

				//아이디 등록
				$this->id = $r['user_id'];
				$this->nm = $r['user_nm'];
				$this->gr = $r['mgroup'];

				//세션 등록
				$_SESSION['RT_USER_ID'] = $r['user_id'];
				$_SESSION['RT_USER_NM'] = $r['user_nm'];
				$_SESSION['RT_USER_GR'] = $r['mgroup'];

				//회원정보 업데이트
				$udata['login_date'] = date("Y-m-d H:i:s");//로그 시간 기록
				$this->dbo->update("RT_RTMEMBER", $udata, "user_id='".$this->id."'");

				return true;
			}
		}

		function login_sns($as_id, $as_type) {

			if (empty($as_id)) {
				rt_js_msg("아이디를 입력해 주세요", "parent"); exit;
			}

			//회원 검색
			$r = $this->dbo->fetch("SELECT * FROM ".$this->tbl." WHERE user_id='".$as_id."' AND lgubun='".$as_type."' LIMIT 1");

			if (empty($r['user_id'])) {
				rt_js_msg("가입된 계정이 없는 정보입니다", "parent"); exit;
			} else {

				//베스트후기 선정 알림
				if ($r['review_alarm'] == "y") {
					$this->dbo->query("UPDATE RT_RTMEMBER SET review_alarm='n' WHERE user_id='".$r['user_id']."'");
					rt_js_msg("(알림) 고객님의 후기가 베스트후기에 선정되었습니다.\\n사은품 신청을 해주세요.");
				}

				//차단된 회원
				if ($r['blockout_en'] == "y") {
					rt_js_msg("이용할 수 없는 계정정보입니다", "parent"); exit;
				}

				//탈퇴처리된 회원
				if ($r['withdraw_en'] == "y") {
					rt_js_msg("가입된 계정이 없는 정보입니다", "parent"); exit;
				}

				//휴면 회원
				if ($r['rest_en'] == "y") {

					//회원 아이디 메일 발송
					rt_load_component("smtp");

					$cls_email = new smtp_class();

					$rest_arr = array();
					$rest_arr['user_id'] = $r['user_id'];
					$rest_arr['user_nm'] = $r['user_nm'];
					$rest_arr['email'] = $r['email'];
					$cls_email->member_rest($rest_arr);

					rt_js_msg("휴면 계정입니다. 가입된 E-mail로 휴면 계정 해지 메일이 전송되었습니다.");
					exit;
				}

				//관리자 승인
				if ($this->_rtm_conf['mb_approval_en'] == "y") {
					if ($r['approval_en'] == "n") {
						rt_js_msg("관리자의 승인 후 로그인이 가능합니다", "parent"); exit;
					}
				}

				//아이디 등록
				$this->id = $r['user_id'];
				$this->nm = $r['user_nm'];
				$this->gr = $r['mgroup'];

				//세션 등록
				$_SESSION['RT_USER_ID'] = $r['user_id'];
				$_SESSION['RT_USER_NM'] = $r['user_nm'];
				$_SESSION['RT_USER_GR'] = $r['mgroup'];

				//회원정보 업데이트
				$udata['login_date'] = date("Y-m-d H:i:s");//로그 시간 기록
				$this->dbo->update("RT_RTMEMBER", $udata, "user_id='".$this->id."'");

				return true;
			}
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 로그아웃 페이지 링크 출력
		 */

		function logout_page() {

			return $this->app['app_path']."/user/logout.php";
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 로그아웃 처리
		 */

		function logout() {

			//로그 기록
			$this->member_log("out", $this->id);

			$_SESSION['RT_USER_ID'] = "";
			$_SESSION['RT_USER_NM'] = "";
			$_SESSION['RT_USER_GR'] = "";
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 현재 로그인한 회원 정보 가져오기
		 */

		function get_member_info() {
			return $this->dbo->fetch("SELECT * FROM ".$this->tbl." WHERE user_id='".$this->id."' LIMIT 1");
		}

		//----------------------------------------------------------------------------------------------

		/** 
		 * 회원 로그인/아웃 로그 데이터
		 */

		function member_log($class, $userid) {

			//최근 로그 데이터
			$equipment = (rt_mobile_is())?"mobile":"pc";
			$day = date("Y-m-d");
			$reg_year = (int)date("Y");
			$reg_month = (int)date("m");
			$reg_day = (int)date("d");
			$reg_hour = (int)date("G");

			$log['user_id'		] = $userid;
			$log['class'		] = $class;
			$log['user_ip'		] = $this->env->_server['REMOTE_ADDR'];
			$log['equipment'	] = $equipment;
			$log['reg_date'		] = date("Y-m-d H:i:s");
			$this->dbo->insert("RT_RTMEMBER_LATELY_LOG", $log);

			//최근 로그 30일 이전 것은 삭제
			$cut_date = rt_get_prev_date(30);
			$this->dbo->query("DELETE FROM RT_RTMEMBER_LATELY_LOG WHERE reg_date < '".$cut_date."'");

			//누적 로그 데이터
			$log_arr = $this->dbo->fetch("SELECT * FROM RT_RTMEMBER_LOG WHERE class='".$class."' AND equipment='".$equipment."' AND reg_year='".$reg_year."' AND reg_month='".$reg_month."' AND reg_day='".$reg_day."' AND reg_hour='".$reg_hour."'");

			if ($log_arr['cnt'] > 0) {
				$new_cnt = $log_arr['cnt'] + 1;
				$log2['cnt'] = $new_cnt;
				$this->dbo->update("RT_RTMEMBER_LOG", $log2, "class='".$class."' AND equipment='".$equipment."' AND reg_year='".$reg_year."' AND reg_month='".$reg_month."' AND reg_day='".$reg_day."' AND reg_hour='".$reg_hour."'");
			} else {
				$log2['class'		] = $class;
				$log2['equipment'	] = $equipment;
				$log2['reg_year'	] = $reg_year;
				$log2['reg_month'	] = $reg_month;
				$log2['reg_day'		] = $reg_day;
				$log2['reg_hour'	] = $reg_hour;
				$this->dbo->insert("RT_RTMEMBER_LOG", $log2);
			}
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 임시 비밀번호 생성
		*
		* @return	string
		*/
		function get_new_password()
		{
			$r = "";
			$str = explode(",","A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,0,1,2,3,4,5,6,7,8,9");
			shuffle($str);
			$r .= $str[17].$str[2].$str[10].$str[4].$str[5].$str[15];

			return $r;
		}

		//----------------------------------------------------------------------------------------------

		/**
		* 폼 필드 출력 관리
		*
		* @param	array				$field			:	세팅된 필드 정보
		* @param	array				$data			:	입력된 필드 데이터
		* @param	boolean				$is_adm			:	관리자 모드 여부
		* @return	string
		**/


		function formset($field, $data, $is_adm=false)
		{
			$seq = $field['seq'];
			$fieldname = "rtfeild_".$seq;

			/* Common var */
			if ($is_adm) {
				$req_addcls = "rt-input ";
			}
			if ($field['is_require']=="y") {
				$req_addcls.= " required";
				$req_msg = "msg='".$field['require_text']."'";
			} else {
				$req_addcls.="";$req_msg="";
			}
			$class = "rtmember-add-css-".$field['seq'];

			$size_h = "";
			if ($field['size_h'] > 0) {
				$size_h = "height:".$field['size_h']."px;";
			}

			$size_w = "";
			if ($field['size_w'] > 0) {
				$size_w = "width:".$field['size_w']."px;";
			}

			$ptr = "";
			switch ($field['type'])
			{
				case "text"	:

					$ptr.= "<input type='text' name='".$fieldname."' value='".$data[$seq]['val']."' style='".$size_w."' class='".$req_addcls."' ".$req_msg.">";
				break;

				case "checkbox"	:

					$data_arr = explode(",", $field['data']);

					if (!$is_adm) {
						$ptr.= "<span class='".$req_addcls."'>";
					}
					foreach ($data_arr as $k => $v) {
						$checked = ($data[$seq]['val'][$k] == $v)?"checked":"";
						$ptr.= "<label><input type='checkbox' name='".$fieldname."_".$k."' value='".$v."' ".$checked."> ".$v."</label> ";
					}
					if (!$is_adm) {
						$ptr.= "</span>";
					}
				break;

				case "radio"	:

					$data_arr = explode(",", $field['data']);

					if (!$is_adm) {
						$ptr.= "<span class='".$req_addcls."'>";
					}
					foreach ($data_arr as $k => $v) {
						$checked = ($data[$seq]['val'] == $v)?"checked":"";
						$ptr.= "<label><input type='radio' name='".$fieldname."' value='".$v."' ".$checked." > ".$v."</label> ";
					}
					if (!$is_adm) {
						$ptr.= "</span>";
					}
				break;

				case "select"	:

					$data_arr = explode(",", $field['data']);

					$ptr.= "<select name='".$fieldname."' style='".$size_w."' class='".$req_addcls."' ".$req_msg.">";
					foreach ($data_arr as $k => $v) {
						$selected = ($data[$seq]['val'] == $v)?"selected":"";
						$ptr.= "<option value='".$v."' ".$selected.">".$v."</option>";
					}
					$ptr.= "</select>";

				break;

				case "textarea"	:

					$ptr.= "<textarea name='".$fieldname."' style='".$size_w.$size_h."' class='".$req_addcls."' ".$req_msg.">".$data[$seq]['val']."</textarea>";
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
			} else if ($field['type'] == "textarea") {
				$ptr.= nl2br($data[$seq]['val']);
			} else {
				$ptr.= $data[$seq]['val'];
			}

			return $ptr;
		}

		//----------------------------------------------------------------------------------------------

	}
}
?>