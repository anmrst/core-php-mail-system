<?php
require_once 'header.php';
$email = $_SESSION['email'];
          
          $i = new message();
          
          
        $sent = $i->user_sentbox($email);
        //print_r($sent);
require_once 'create.php';

require_once 'sidebar.php';
//print_r($_SESSION);




?>


  

<div style="width: 80%; float: right">
    <table class="table table-inbox table-hover">
                            <tbody>
                            <?php 
                           $z="";
                              foreach($sent as $key)
                              {  //print_r($sent); 
                                if( $z != $key['parentid']) {
                                $s = DB::user_sentbox_query1($key['msgid']);
                                print_r($s);
                                /*foreach ($s as $k) {
                                */
                                 //print_r($s); 
                              /*     $a=count($s);
                                  print_r($a);
                                  echo "<br>";
                              */
                                //}
                                //print_r($s);
                                ?>
                              <tr class="read">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show."><?php 
                                                                           if(count($s) >1){ 
                                                                            
                                                                              for($x=0 ; $x<count($s); $x++){
                                                                                if($x > 1){
                                                                                  $add = count($s) - ($x);
                                                                                  echo "(" ."<b>". $add ."</b>". ")";
                                                                                  break;
                                                                                 }
                                                                                 if($x==count($s)-1) {
                                                                                     echo $s[$x]['to_ccid'];}
                                                                                 else {echo $s[$x]['to_ccid'] . ",";}

                                                                                  
                                                                              }
                                                                            }
                                                                            else echo $s['0']['to_ccid'] ?></td>
                                  <td class="view-message "><?php echo $key['subject']; ?> </td>
                                  <!-- c -->
                                  <td class="view-message"><a href="viewmessage.php/?id= <?php echo $key['msgid']; ?>  "> View Message </a></td>
                                  <td class="view-message  text-right"><?php echo $key['time'] ." " .$key['date']; ?></td>
                              </tr>
                             <?php }
                             $z = $key['parentid']; }
                             
                              ?> 
            </tbody>
        </table>
    </div>


<?php
{



//print_r($_POST);
if(isset($_POST['to'])){
  if(Input::exists()){
        $validate = new Validate();
        $validation = $validate->check($_POST, array());
}
/*            'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'users'

            ),
            'password' => array(
                'required' => true,
                'min' => 6,
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            ),
            'name' => array(
                'required' => true,
                'min' => 2,
                'max'=> 20
            ),
        ));
*/    
  
        if($validation->passed()){
            $from1 = $_SESSION['email'];
            $id = $_SESSION['uid'];
            //echo(Input::get('to') . "<br>" . Input::get('cc') . "<br>" . Input::get('subject') . "<br>" . Input::get('message') . "<br>" . $from);die;
            $msg = new message();

            $from = $msg->message_save( Input::get('subject'), Input::get('message') , $from1 , $id );
            $to = $msg->recipent_save(Input::get('to') , Input::get('cc'));
           
        }
        else {
            /*print_r($validation->errors());*/
            foreach ($validation->errors() as $error) {
                ?>
                
               <div style="color: red">
                <?php echo "$error . <br>"; ?>
            </div>
        
        <?php
            }
        }
    }
   
  
/*$to = $_POST['to'];
$cc = $_POST['cc'];
$sub = $_POST['subject'];
$msg = $_POST['message'];*/
//$to = $_POST['to'];
//echo $from;
//echo $to . "<br>" . $cc . "<br>" . $sub . "<br>" . $msg;die;
/*
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
*/


/*$sql = "INSERT INTO recipent (child)
VALUES ('$to')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}*/

//$conn->close();


}




?>

