<?php

#
# Example PHP server-side script for generating
# responses suitable for use with jquery-tokeninput
#

# Connect to the database
//mysql_pconnect("host", "username", "password") or die("Could not connect");
//mysql_select_db("database") or die("Could not select database");
$dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'login_db';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    print_r($db);
# Perform the query
$query = sprintf("SELECT email from users WHERE email LIKE '%%% . $_GET['q'] .%%' ", mysqli_real_escape_string($db,$_GET["q"]));
print_r($query);
$arr = array();
$rs = mysqli_query($db, $query);

# Collect the results
while($obj = mysqli_fetch_object($rs)) {
    $arr[] = $obj;
}

# JSON-encode the response
$json_response = json_encode($arr);

# Optionally: Wrap the response in a callback function for JSONP cross-domain support
if($_GET["callback"]) {
    $json_response = $_GET["callback"] . "(" . $json_response . ")";
}

# Return the response
echo $json_response;

?>
