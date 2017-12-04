<?php
//session_start();
//print_r($_SESSION['name']);
require_once 'init.php';
$a = Session::check_session();
//print_r($a);die;
if($a == true){

//print_r($_SESSION['name']);
}
else {
//print_r($_SESSION['name']);
			//print_r("adsadsfd");die;
		//print_r($_COOKIE['id']);die;
	if(isset($_COOKIE['id'])){
		Session::set_session();

	}
	else {
	header('Location:index.php');
	}
}
//print_r($_SESSION['name']);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  	.table-inbox tr td {
    padding: 12px !important;
}
	.table-inbox tr.unread td {
    background: none repeat scroll 0 0 #f7f7f7;
    font-weight: 600;
}
  </style>
</head>
<body>

	<div style="float:right; ">
		<a href="profile.php"><input type="button" name="update" value="update"></a>
		<a href="logout.php"><input type="button" name="logout" value="logout"></a>
		<a href="delete.php"><input type="button" name="logout" value="delete account"></a>
	</div>

	<div class="text-center" style="clear: both">
		<h2> welcome <?php echo $_SESSION['name']; ?> </h2>
		<h3> your username is <?php echo $_SESSION['username']; ?> </h3>
		<!-- <?php //print_r($_SESSION['uid']); ?> -->
		<!-- <h3> your email is <?php //echo $_SESSION['token'] ?> </h3> -->
	</div>

	<div style="width: 20%; height: 500px; background-color: #d9edf7; float: left; position: fixed;" class="text-center">
		<ul class="list-group">
  <li class="list-group-item list-group-item-info">Create</li>
  <li class="list-group-item list-group-item-info">Inbox</li>
  <li class="list-group-item list-group-item-info">Sent</li>
  <li class="list-group-item list-group-item-info">Trash</li>
</ul>
	</div>

	<div style="width: 80%; float: right">
		<table class="table table-inbox table-hover">
                            <tbody>
                            <?php	$a=10;
                            	for($i=0; $i<$a ; $i++)
                            	{ ?>
                              <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">PHPClass</td>
                                  <td class="view-message ">Added a new class: Login Class Fast Site</td>
                                  <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                  <td class="view-message  text-right">9:27 AM</td>
                              </tr>
								<?php } ?>


<?php
//print_r($_POST);
if(isset($_POST['to'])){
	$from = $_SESSION['username'];
$to = $_POST['to'];
$cc = $_POST['cc'];
$sub = $_POST['subject'];
$msg = $_POST['message'];
//$to = $_POST['to'];
//echo $to . "<br>" . $cc . "<br>" . $sub . "<br>" . $msg;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO message (parent, subject,messageBody)
VALUES ('$from', '$sub' , '$msg')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "INSERT INTO recipent (child)
VALUES ('$to')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


}




?>

