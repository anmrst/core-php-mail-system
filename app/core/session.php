<?php
//session_start();


	class Session{
	
		public static function set_session(){
				
				if(isset($_COOKIE['id'])){
				$_SESSION['login'] = true;
                $_SESSION['uid'] = $_COOKIE['id'];
                $_SESSION['username'] = $_COOKIE['username'];
                $_SESSION['email'] = $_COOKIE['email'];
                $_SESSION['name'] = $_COOKIE['name'];
				$_SESSION['image'] = $_COOKIE['image'];
			
                }
			}
		public static function set_token($token){
				//print_r($token);
				$_SESSION['token'] = $token;
				//print_r($_SESSION['token']); die;
		}
		
		public static function check_session(){
				//print_r($_SESSION['login']);
			//print_r("anmol");die;
				if(isset($_SESSION['login'])){
					//print_r("anmol");die;
					return true;

				}
				else{
					return false;
				}
			}		
		public static function del_session(){
			session_unset();
			session_destroy();
			}

		public static function update_session($a){
			//echo $a; 
			$_SESSION['name'] = $a;
			//print_r($_SESSION['name']);die;
		}

		public static function update_session1($a){
			//echo $a; 
			$_SESSION['image'] = $a;
			//print_r($_SESSION['name']);die;
		}
	}

	//Session::set_session();
?>