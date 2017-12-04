
<?php
date_default_timezone_set("Asia/Kolkata");
echo "Today is " . date("Y/m/d") . "<br>";
echo "The time is " . date("H:i:s") . "<br>";
$id= 4;
$a =   $id . date("d") . date("s") ;
print_r($a);

?>
