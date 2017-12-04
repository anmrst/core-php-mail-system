<?php
class Cookie{


	public static function set_cookie($row = array()){
				//print_r($row);die;
                $cookie_name = 'id';
				$cookie_value = $row['id'];
				setcookie($cookie_name, $cookie_value, time() + 86400); // 86400 = 1 day

				$cookie_name = 'username';
				$cookie_value = $row['username'];
				setcookie($cookie_name, $cookie_value, time() + 86400); // 86400 = 1 day

				$cookie_name = 'name';
				$cookie_value = $row['name'];
				setcookie($cookie_name, $cookie_value, time() + 86400); // 86400 = 1 day

				$cookie_name = 'email';
				$cookie_value = $row['email'];
				setcookie($cookie_name, $cookie_value, time() + 86400); // 86400 = 1 day	
				//Cookie::check_cookie();
				
				$cookie_name = 'image';
				$cookie_value = $row['image'];
				setcookie($cookie_name, $cookie_value, time() + 86400); // 86400 = 1 day
				return $row;
	}

	public static function del_cookie(){

		
		 setcookie('id', '' , time() - 86400);
		  setcookie('username', '' , time() - 86400);
		  setcookie('name', '' , time() - 86400);
		   setcookie('email', '' , time() - 86400);

	}

	public static function check_cookie(){

	}
}
?>