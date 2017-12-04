<?php
session_start();

$GLOBALS['config'] = array(
	'mysqli' => array('host' =>'127.0.0.1',
		'user'=>'root',
		'password'=>'',
		'db'=>'login_db'
	),
	'remember' => array(
	 ),
	'session' => array(
		'session_name' => 'user'
	) 
);	
date_default_timezone_set("Asia/Kolkata");
spl_autoload_register( function($class){
	require_once'core/' . $class . '.php';
});
/*require_once 'classes/config.php'*/;
