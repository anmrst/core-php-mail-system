<?php 
require_once 'init.php';

	$a= Session::check_session();
	if($a == true) {

		Cookie::del_cookie();
		Session::del_session();
		header('Location: index.php');
	}
	else{
		header('Location: index.php');
	}