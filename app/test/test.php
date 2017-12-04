?>
<?php
//session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "10am";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$a =array();
$qr = "SELECT user_name FROM userinfo";
$r = $conn->query($qr);
while ($row = $r->fetch_assoc()) {
	//print_r($row);
	$a[] = $row['user_name']; 
}
//print_r($a);
?>
<input type="text" name="asdasd" list="languages">
<datalist id="languages">
	<?php foreach ($a as $k ) {
	?>
  <option value=" <?php echo $k; ?>">
<?php } ?>  
</datalist>