<?php 
//require_once 'init.php';
date_default_timezone_set("Asia/Kolkata");
class message{
		public $obj;
		public $msg;
		public $reply;

		public function __constructor(){
			$this->obj = DB::getinstance();
		}

		public function get_users_list(){
			$table = "users";
			$list = DB::get_users_query($table);
			//print_r($list);die;
			return $list;
		}

		public function message_save($subject , $message , $from , $id, $attach ){
			$date = date("Y/m/d");
			$time = date("H:i:s");
			$msgid = $id . date("d") . date("s") ;
			$parentid = $msgid;

			$this->msg = $msgid;

			$data = array(
				'msgid' => $msgid,
				'parentid' => $parentid,
				'fromid' => $from,
				'subject' => $subject,
				'body' => $message,
				'date' => $date,
				'time' => $time,
				'attachment' => $attach

			);
			$table = "message";
			DB::message_save_query($data, $table);
		}

		public function recipent_save($to, $cc){
			$msgid = $this->msg;
			$to = trim($to);
			$to1 = explode(',', $to);
			$table = "recipent";
			if(!empty($cc)) {
				$cc= trim($cc);
				$cc1 = explode(',', $cc);
				
			
            	DB::recipent_save_query($to1 , $cc1, $table , $msgid);
        	}
        	else {

        		DB::recipent_save_query($to1 ,'', $table , $msgid);
        	}
		}

		public function user_sentbox($email){
				//print_r($email);
			$table ='message';
			$sent = DB::user_sentbox_query($table,$email);	
			return($sent);
			$sent1= $sent;
			//print_r($sent);
			
			
		}	

		public function user_inbox($email){
			$table='recipent';
			$inbox = DB::user_inbox_query($table,$email);
			//print_r($inbox);
			return $inbox;
		}
		public function user_inbox_detail($msgid){
			$table = "message";
			$inbox_detail = DB::user_inbox_detail_query($msgid, $table);
			return $inbox_detail;
		}
		public function user_inbox_detail2($msgid){
			$table = "message";
			$inbox_detail = DB::user_inbox_detail_query2($msgid, $table);
			return $inbox_detail;
		}
		public function user_inbox_detail1($msgid){
			$table = "recipent";
			$detail = DB::user_inbox_detail_query1($msgid,$table);
			return $detail;

		}
		public function reply_save($subject, $message, $parentid, $from, $id, $attach){
			$date = date("Y/m/d");
			$time = date("H:i:s");
			$msgid = $id . date("d") . date("s") ;
			$this->reply = $msgid;
				$data = array( 
				'msgid' => $msgid,
				'parentid' => $parentid,
				'fromid' => $from,
				'subject' => $subject,
				'body' => $message,
				'date' => $date,
				'time' => $time,
				'attachment' => $attach
			);
			$table = "message";
			DB::reply_save_query($data, $table);
		}
		public function forward_save($subject, $message, $parentid, $fwd ,$from, $id, $attach){
			$date = date("Y/m/d");
			$time = date("H:i:s");
			$msgid = $id . date("d") . date("s") ;
			$this->reply = $msgid;
				$data = array( 
				'msgid' => $msgid,
				'parentid' => $parentid,
				'fromid' => $from,
				'subject' => $subject,
				'body' => $message,
				'date' => $date,
				'time' => $time,
				'fwd' => $fwd,
				'attachment' => $attach
			);
			$table = "message";
			DB::reply_save_query($data, $table);
		}

		public function reply_recipent_save($to, $cc){
			$msgid = $this->reply;
			$to = trim($to);
			$to1 = explode(',', $to);
			$table = "recipent";
			if(!empty($cc)) {
				$cc= trim($cc);
				$cc1 = explode(',', $cc);
				
			
            	DB::reply_recipent_save_query($to1 , $cc1, $table , $msgid);
        	}
        	else {

        		DB::reply_recipent_save_query($to1 ,'', $table , $msgid);
        	}
		}

		public function parentid_msg($p){
			$table = "message";
			$p_id = DB::parentid_msg_query($table,$p);
		}

		public function delete($delete, $email)
			{
			$table = "recipent";
			$del = DB::delete1($table,$delete, $email);
		}

		public function delete1($delete, $email)
			{
			$table = "message";
			$del = DB::delete2($table,$delete, $email);
		}		

		public function user_trashbox_message($email){
				//print_r($email);
			$table ='message';
			$sent = DB::user_thrashbox_query($table,$email);	
			return($sent);
			//$sent1= $sent;
			//print_r($sent);
			
			
		}
		public function user_trashbox_recipent($email){
				//print_r($email);
			$table ='recipent';
			$sent = DB::user_thrashbox_query2($table,$email);	
			return($sent);
			//$sent1= $sent;
			//print_r($sent);
			
			
		}
		public function restore_msg1($msgid, $email){
				//print_r($email);
			$table ='recipent';
			$sent = DB::restore_msg_query1($table,$msgid, $email);	
			//return($sent);
			//$sent1= $sent;
			//print_r($sent);
			
			
		}

		public function restore_msg2($msgid, $email){
				//print_r($email);
			$table ='message';
			$sent = DB::restore_msg_query2($table,$msgid, $email);	
			//return($sent);
			//$sent1= $sent;
			//print_r($sent);
			
			
		}	
		public function msg_read_status($msgid, $email){
			$table = 'recipent';
			DB::msg_read_status_query($table, $msgid ,$email);
		}
		public function user_read_status_check($msgid , $email){
			$table='recipent';
			$value = DB::user_read_status_check_query($table,$msgid,$email);
			return $value;
		}

		public function multiple_delete($boxes , $email){
			$table = 'recipent';
			DB::multiple_delete_query($table, $boxes, $email);

		}

}
/*$a = new message();
$a->xyz(10);
$a->kbc();*/