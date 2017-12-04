<?php
require_once('init.php');
session_start();
 //
db::delete($_SESSION['uid']);
 ?>