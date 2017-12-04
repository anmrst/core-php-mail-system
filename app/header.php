<?php
//session_start();

//require_once 'create.php';
require_once 'init.php';
$a = Session::check_session();
//print_r($_SESSION);die;
if($a == true){

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
} ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- w3 css modal --><meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> <!-- till here-->
<!-- font awesome --> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- till here -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="http://localhost/hestabit/app/style.css">
  <link rel="stylesheet" type="text/css" href="http://localhost/hestabit/app/style1.css">
</head>
<body>
                         
                      
	<!-- <div style="float:right; ">
		<a href="http://localhost/hestabit/app/profile.php"><input type="button" name="update" value="update"></a>
		<a href="http://localhost/hestabit/app/logout.php"><input type="button" name="logout" value="logout"></a>
		<a href="../delete.php"><input type="button" name="logout" value="delete account"></a>
	</div>
 -->
	




<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="http://localhost/hestabit/app">Home</a></li>
      <!-- <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
      </li> -->
      <li><a href="#">Page 2</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->
      <!-- <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->

      <li class="dropdown">

    <a href="#" data-toggle="dropdown" >Profile
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="http://localhost/hestabit/app/profile.php">Update</a></li>
      <li><a href="../delete.php">Delete A/c</a></li>
      <li><a href="http://localhost/hestabit/app/logout.php">Logout</a></li>
    </ul>
  </li>
  <li><a href="http://localhost/hestabit/app/profile.php"> <?php if(isset($_SESSION['image'])) { ?> <img src="<?php echo "http://localhost/hestabit/app/uploads/dp/" . $_SESSION['image'];?> " height= "30" width = "30" > <?php  } else { ?>   <span class="glyphicon glyphicon-user" style="width: 30px; height: 30px;"></span> <?php } ?> </a> </li>
    </ul>
  </div>
</nav>
<br>
<br>
<br>
<div class="text-center" style="clear: both">
		<h2> welcome <?php echo $_SESSION['name']; ?> </h2>
		<h3> your username is <?php echo $_SESSION['username']; ?> </h3>
		<h3> your email is <?php echo $_SESSION['email']; ?> </h3>
		<!-- <?php //print_r($_SESSION['uid']); ?> -->
		<!-- <h3> your email is <?php //echo $_SESSION['token'] ?> </h3> -->
	</div>
  


