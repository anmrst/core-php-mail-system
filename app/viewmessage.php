<?php
require_once 'header.php';

require_once 'create.php';

require_once 'sidebar.php';
require_once 'create_php_code.php';
/*print_r($actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");*/


$email = $_SESSION['email'];

if(isset($_GET['del'])){
  $delete = $_GET['del'];
  $p = new message();
  $p->delete($delete, $email);
}
if(isset($_GET['del2'])){
  $delete = $_GET['del2'];
  $p = new message();
  $p->delete1($delete, $email);
}

$flag = 0;
//print_r($_SESSION);
          $b="";
          $i = new message();
          //$inbox = $i->user_inbox($email);
          //print_r($inbox);
          //echo "<br>";die;
          $key = $_GET['id'];
          //print_r($key);die;
          $i->msg_read_status($key ,$email);  
            
          $inbox_msg = $i->user_inbox_detail($key);
          //print_r($inbox_msg);
          //print_r($inbox_msg['parentid']);
          
          /*print_r($inbox_msg);
          echo "<hr>";*/
          $s = $i->user_inbox_detail1($key);
          /*echo "<hr>";
          print_r($s);*/
          $t = $i->user_inbox_detail2($inbox_msg['parentid']);
         /* echo "<br>";
          print_r($t);*/
          /*foreach ($t as $value) {
            echo "<hr>";
            $s = $i->user_inbox_detail1($value['msgid']);      
            $s1[] = $s;        
            //print_r($s); die;
            echo "<br>";
          }
          print_r($s1);*/
          //$c = count($s);
          //print_r($c);
          //print_r($inbox_msg);
          /*$b = new message();
        $sent = $b->user_sentbox($email);
        */
//print_r($_SESSION);
/*
if(isset($_POST['to1'])){
print_r($_POST);die;
//print_r("asdbhasdvhasvgasdghasdgvsd");die;
}*/


//print_r($_POST);

   




if(isset($_POST['submit3'])){
  //print_r($_POST); die;
  
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
          //print_r($_POST);die;
          //$files[] = $_FILES['files']['name'];
          //print_r($_FILES['files']['name']);
          $attach = implode(",", $_FILES['files3']['name']);
          //print_r("submit3");
          //print_r($attach);die;

            $from1 = $_SESSION['email'];
            $id = $_SESSION['uid'];
            //echo(Input::get('to') . "<br>" . Input::get('cc') . "<br>" . Input::get('subject') . "<br>" . Input::get('message') . "<br>" . $from);die;
            $msg = new message();

            $from = $msg->forward_save( Input::get('subject3'), Input::get('message3') ,Input::get('parentid3'),Input::get('messageid3'), $from1 , $id , $attach);
            $to = $msg->reply_recipent_save(Input::get('to3') , Input::get('cc3'));
            if(count($_FILES['files3']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['files3']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['files3']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
                $shortname = $_FILES['files3']['name'][$i];
                //print_r($shortname); die;
                //save the url and the file
                $filePath = "uploads/" . $_FILES['files3']['name'][$i];

                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $shortname;
                    //insert into db 
                    //use $shortname for the filename
                    //use $filePath for the relative url to the file

                }
              }
        }
    }
           
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



if(isset($_POST['submit1'])){
  
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
          //print_r($_POST);die;
         // print_r('submit1');die;
            $from1 = $_SESSION['email'];
            $id = $_SESSION['uid']; 
            $attach = implode(",", $_FILES['files1']['name']);
            //echo(Input::get('to') . "<br>" . Input::get('cc') . "<br>" . Input::get('subject') . "<br>" . Input::get('message') . "<br>" . $from);die;
            $msg = new message();

            $from = $msg->reply_save( Input::get('subject1'), Input::get('message1') ,Input::get('parentid1'), $from1 , $id, $attach);
            $to = $msg->reply_recipent_save(Input::get('to1') , Input::get('cc1'));
            if(count($_FILES['files1']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['files1']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['files1']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
                $shortname = $_FILES['files1']['name'][$i];
                //print_r($shortname); die;
                //save the url and the file
                $filePath = "uploads/" . $_FILES['files1']['name'][$i];

                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $shortname;
                    //insert into db 
                    //use $shortname for the filename
                    //use $filePath for the relative url to the file

                }
              }
        }
    }
           
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
    if(isset($_POST['submit2'])){

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
          //print_r($_POST);
          //print_r("submit2");die;
          //print_r($_FILES);die;
          $attach = implode(",", $_FILES['files2']['name']);
          //print_r($attach);die;
            $from1 = $_SESSION['email'];
            $id = $_SESSION['uid'];
            //echo(Input::get('to') . "<br>" . Input::get('cc') . "<br>" . Input::get('subject') . "<br>" . Input::get('message') . "<br>" . $from);die;
            $msg = new message();

            $from = $msg->reply_save( Input::get('subject2'), Input::get('message2') ,Input::get('parentid2'), $from1 , $id, $attach);
            $to = $msg->reply_recipent_save(Input::get('to2') , Input::get('cc2'));
           
            if(count($_FILES['files2']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['files2']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['files2']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
                $shortname = $_FILES['files2']['name'][$i];
                //print_r($shortname); die;
                //save the url and the file
                $filePath = "uploads/" . $_FILES['files2']['name'][$i];

                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $shortname;
                    //insert into db 
                    //use $shortname for the filename
                    //use $filePath for the relative url to the file

                }
              }
        }
    }
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
   

?>


  
<div style="width: 80%; float: right">
  

 
  
  <style type="text/css">
  .modalcover {
    
    position: absolute;
    top: 0;
    left : 19%;
    opacity: 1;
    z-index = 1050;
    background-color: grey;
    display: none;
    width: 500px;
    color: white;
}
</style>



<div style="width: 90%; margin-left: 5%;">
  
  <?php $flag =0;
  $i =new message();
          //print_r($t);
          foreach ($t as $value) { 
            
            //print_r($value); 
            //echo "<hr>";
            if($value['fromid'] != $email){
              $flag=1;
            }
            else if($value['fromid'] == $email){
              $flag=0;
              if($value['del'] == 1)
              {
                $flag =1;
              }
            }
            //echo "<hr>";
           //print_r($value);
            $s = $i->user_inbox_detail1($value['msgid']);
            /*echo "<hr>";
            print_r($s);*/
            foreach ($s as $ky) {
             // print_r($ky);
              if($email == $ky['to_ccid'])
              {
                $flag=0;
              
              if($ky['del'] == 1)
              {
                $flag=1;
              }
            } 
            }//die;
            //echo "<hr>";
            //print_r($s);die;
            /*echo "<br>";
            echo "<br>";
            print_r($s); die;*/
          if($flag == 1) {

          }
          else {  
            //print_r($value);
            
            if($email == $value['fromid']) {
            static $a=0;
            print_r($value);
          ?>

  <!-- Left-aligned media object -->
  
  <div class="media" style="position: relative; ">
        <div> 
              <?php //print_r($s);?>
              <a data-toggle="collapse" href="<?php echo "#collapse" . $a ;?>">
          <i class="fa fa-share-square-o" aria-hidden="true"></i>

                  <h3 class="media-heading" style="display: inline"> <?php foreach ($s as $sent) {

                                                  if($sent['status'] == 0){
                                                    $name = DB::user_inbox_detail_user($sent['to_ccid']);
                                                echo $name['name'] ."&lt;" . $sent['to_ccid'] ."&gt;". "," ;}
                                                  }; ?> 
                  </h3>
              </a>

              
            
        </div>
        <div class="panel-collapse collapse in" id="<?php echo "collapse" . $a; ?>">
            <div class="media-left">

              <?php $x=0; foreach($s as $c) { if($c['status'] == 0){$x++;}  } if($x>1) { echo '<i class="fa fa-users" aria-hidden="true"></i>
';} else if($x == 1) {$name = DB::user_inbox_detail_user($c['to_ccid']);  ?>



              <img src="<?php if($name['image']!="") {echo"http://localhost/hestabit/app/uploads/dp/".$name['image'];} else echo"http://localhost/hestabit/app/dummy.jpg"; ?>" class="media-object" style="width:60px">
              <?php } ?>
            </div>

            <div class="media-body" style="min-height: 350px;" >
              <h4 class="media-heading" style="display: inline;">To : <?php foreach ($s as $sent) {
                                                echo $sent['to_ccid'] . "," ;
                                                  }; ?> 
                       </h4>          
                   <?php  //  print_r($s); ?>
              <div class="dropdown" style="display: inline; padding: ">
                <button class="btn btn-default dropdown-toggle" style="padding: 0px 6px;" type="button" data-toggle="dropdown">
                <span class="caret"></span></button>
                <ul class="dropdown-menu" style="left: unset; right:0;">
                  <li> To : <?php // print_r($s);die;
                                  
                                      if(count($s) >1){ 
                                                                
                                         for($x=0; $x<count($s); $x++){
                                          //print_r($x);
                                            if($x==count($s)-1) {
                                              if ($s[$x]['status'] == 0) {
                                                //print_r($s[$x]['to_ccid']);
                                                if($email == $s[$x]['to_ccid']){

                                                echo $s[$x]['to_ccid'] . "(me)";
                                                }
                                                else
                                                echo $s[$x]['to_ccid'];
                                            } 
                                              }
                                            else {
                                              if ($s[$x]['status'] == 0) {
                                                if($email == $s[$x]['to_ccid']){

                                                echo $s[$x]['to_ccid'] . "(me)" . ",";
                                                }
                                                else
                                                echo $s[$x]['to_ccid'] . ",";

                                              //echo $s[$x]['to_ccid'] . ",";}
                                              } 
                                          }
                                        }
                                        }
                                        else 
                                          if($s['0']['status'] == 0)
                                            {
                                              if($email == $s['0']['to_ccid'])
                                                {echo $s['0']['to_ccid'] . "(me)";
                                                 }
                                              else
                                              echo $s['0']['to_ccid']; } ?>      
                           
                       </li> 
                       <br>
                       <?php //print_r($s); die; 
                       foreach ($s as $key ) {
                             if($key['status'] == 1){
                              $flag=1;
                             }
                           } 
                            if($flag == 1){ ?>
                            
                  <li>
                    Cc:
                  <?php //print_r($s);die;
                                  
                                      if(count($s) >1){ 
                                                                
                                         for($x=0 ; $x<count($s); $x++){
                                          
                                            if($x==count($s)-1) {
                                              if ($s[$x]['status'] == 1) {
                                                if($email == $s[$x]['to_ccid']){

                                                echo $s[$x]['to_ccid'] . "(me)";
                                                }
                                                else 
                                                echo $s[$x]['to_ccid'];
                                            }}
                                            else {
                                              if ($s[$x]['status'] == 1) {
                                                echo $s[$x]['to_ccid'] . ",";} }
                                          
                                        }
                                        }
                                        else 
                                          if($s['0']['status'] == 1)
                                            {echo $s['0']['to_ccid']; } ?>  
                           </li> 
                           <br>
                           <?php } ?>

                  
                  <li>
                    Subject : <?php  echo $value['subject']; ?>
                  </li>
                  
                </ul>
              </div> 
              <h5 class="media-heading"> <!-- Subject : -->
                  <span>
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-default"><a href="#myModal2<?php echo $a;?>" data-toggle="modal"><i class="fa fa-reply" aria-hidden="true"></i>
</a></button>
                            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                              <span class="caret">
                                </span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#myModal2<?php echo $a;?>" data-toggle="modal"><i class="fa fa-reply" aria-hidden="true">Reply</i></a></li>
                                <li><a href="#myModal3" data-toggle="modal">Forward</a></li>
                                <?php
                                //print_r($value); 
                                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
                                <li><a href="<?php echo $actual_link . "&del2=" . $value['msgid'];?>">Delete</a></li>
                                <li class="divider"></li> 
                                <?php if(count($s)>1) {?>
                                <li><a data-toggle = "modal" href="#myModal1<?php echo $a;?>"> <i class="fa fa-reply-all" aria-hidden="true">Reply to all</i></a></li>
                                <?php }?>
                            </ul>
                        </div>
                  </span>
              </h5> 
                <!-- <p><?php  //echo $value['subject']; ?></p> -->
                <h5 class="media-heading"> <?php echo "sent at " .$value['time'] ." on ". $value['date']  ;?> </h5>
                <h5 class="media-heading"> Message : </h5>
                <p style="word-break: break-all;"><?php echo $value['body']; 
                //print_r($value);
                ?> </p>
                <?php if($value['attachment'] != "") {?>
        <h4> Attachments : </h4>
        <?php $ab= explode(',', $value['attachment']);

        foreach ($ab as $attach) {
        //print_r($attach);die; ?>
          <p> <i class="fa fa-download" aria-hidden="true"></i> <a href="http://localhost/hestabit/app/uploads/<?php echo $attach; ?>" download> <?php echo $attach;?>   </a></p>
        <?php } } ?>
        <?php include "reply2.php"; ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>  
            </div>

        </div>
        
  </div>
  <?php $a++; } 
  else { 
    static $b=100; 
    //print_r($value); 
    if($value['fwd'] == 0) { ?> 

  <hr>
  
  <!-- Right-aligned media object -->
  <div class="media" style="position: relative;">
    <div> 
              <a data-toggle="collapse" href="<?php echo "#collapse" . $b ; ?>">
                <i class="fa fa-reply" aria-hidden="true"></i>

                  <h3 class="media-heading" style="display: inline">From : <?php $name=DB::user_inbox_detail_user($value['fromid']); echo $name['name']."&lt;" . $value['fromid'] . "&gt;"; ?>   
                  </h3>
              </a>
              <?php print_r($s);
              echo "<hr>";
              print_r(count($s));
              echo "<hr>";

              ?>

        </div>
        <div class="panel-collapse collapse in" id="<?php echo "collapse" . $b ?>">
    <div class="media-body" style="min-height: 300px;">
      <h4 class="media-heading" style="display: inline">To: me  <div class="dropdown" style="display: inline">
                <button class="btn btn-default dropdown-toggle" style="padding: 0px 6px;" type="button" data-toggle="dropdown">
                <span class="caret"></span></button>
                <ul class="dropdown-menu" style=" padding: 5px;">
                  <li> To : <?php  //print_r($value);die;
                                  
                                      if(count($s) >1){ 
                                                                
                                         for($x=0; $x<count($s); $x++){
                                          //print_r($x);
                                            if($x==count($s)-1) {
                                              if ($s[$x]['status'] == 0) {
                                                //print_r($s[$x]['to_ccid']);
                                                if($email == $s[$x]['to_ccid']){

                                                echo $s[$x]['to_ccid'] . "(me)";
                                                }
                                                else
                                                echo $s[$x]['to_ccid'];
                                            } 
                                              }
                                            else {
                                              if ($s[$x]['status'] == 0) {
                                                if($email == $s[$x]['to_ccid']){

                                                echo $s[$x]['to_ccid'] . "(me)" . ",";
                                                }
                                                else
                                                echo $s[$x]['to_ccid'] . ",";

                                              //echo $s[$x]['to_ccid'] . ",";}
                                              } 
                                          }
                                        }
                                        }
                                        else 
                                          if($s['0']['status'] == 0)
                                            {
                                              if($email == $s['0']['to_ccid'])
                                                {echo $s['0']['to_ccid'] . "(me)";
                                                 }
                                              else
                                              echo $s['0']['to_ccid']; } ?>      
                           
                       </li> 
                       <br>
                       <?php //print_r($s); die; 
                       foreach ($s as $key ) {
                             if($key['status'] == 1){
                              $flag=1;
                             }
                           } 
                            if($flag == 1){ ?>
                            
                  <li>
                    Cc:
                  <?php //print_r($s);die;
                                  
                                      if(count($s) >1){ 
                                                                
                                         for($x=0 ; $x<count($s); $x++){
                                          
                                            if($x==count($s)-1) {
                                              if ($s[$x]['status'] == 1) {
                                                if($email == $s[$x]['to_ccid']){

                                                echo $s[$x]['to_ccid'] . "(me)";
                                                }
                                                else 
                                                echo $s[$x]['to_ccid'];
                                            }}
                                            else {
                                              if ($s[$x]['status'] == 1) {
                                                echo $s[$x]['to_ccid'] . ",";} }
                                          
                                        }
                                        }
                                        else 
                                          if($s['0']['status'] == 1)
                                            {echo $s['0']['to_ccid']; } ?>  
                           </li> 
                           <br>
                           <?php } ?>

                  
                  <li>
                    Subject : <?php  echo $value['subject']; ?>
                  </li>
                  
                </ul>
              </div></h4> 
              <h5 class="media-heading"> <!-- Subject : -->
                  <span>
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-default"><a href="#myModal2<?php echo $b; ?>" data-toggle="modal"><i class="fa fa-reply" aria-hidden="true"></i>
</a></button>
                            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                              <span class="caret">
                                </span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#myModal2" data-toggle="modal"><i class="fa fa-reply" aria-hidden="true">Reply</i></a></li>
                                <li><a href="#myModal3" data-toggle="modal">Forward</a></li>
                                <?php
                                //print_r($value); 
                                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
                                <li><a href="<?php echo $actual_link . "&del=" . $value['msgid'];?>">Delete</a></li>
                                <li class="divider"></li>
                                <?php if( count($s)>1) {?>
                                <li><a data-toggle = "modal" href="#myModal1<?php echo $b;?>"> <i class="fa fa-reply-all" aria-hidden="true">Reply to all</i></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                  </span>

              </h5> 
      <h5 class="media-heading"> <?php echo "recieved at " .$value['time'] ." on ". $value['date'] ;?> </h5>
      <h5 class="media-heading"> Message : </h5>
        <p  style="word-break: break-all;"><?php echo $value['body']; 
        //print_r($value);?> 
        </p>
        <?php if($value['attachment'] != "") {?>
        <h4> Attachments : </h4>
        <?php $at= explode(',', $value['attachment']);

        foreach ($at as $attach) {
        //print_r($attach);die; ?>
          <p> <i class="fa fa-download" aria-hidden="true"></i> <a href="http://localhost/hestabit/app/uploads/<?php echo $attach; ?>" download> <?php echo $attach;?>   </a></p>
        <?php } } ?>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    <div class="media-right">

      <img src="<?php if($name['image']!= "") echo "http://localhost/hestabit/app/uploads/dp/" . $name['image'] ; else echo "http://localhost/hestabit/app/dummy.jpg";?>" class="media-object" style="width:60px">
    </div>
    <?php include "reply.php"; ?>


   <br>
   <br> 
   <br>
  </div>
  </div>

  <?php } else {  ?> <div class="media" style="position: relative;">
    <div> 
              <a data-toggle="collapse" href="<?php echo "#collapse" . $b ; ?>">
                <i class="fa fa-reply" aria-hidden="true"></i>

                  <h3 class="media-heading" style="display: inline">From : <?php $name=DB::user_inbox_detail_user($value['fromid']); echo $name['name']."&lt;" . $value['fromid'] . "&gt;"; ?>   
                  </h3>
              </a>
              
        </div> 

        <div class="panel-collapse collapse in" id="<?php echo "collapse" . $b ?>">
    <div class="media-body" style="min-height: 300px;">
      <h4 class="media-heading" style="display: inline">To: me  <div class="dropdown" style="display: inline">
                <button class="btn btn-default dropdown-toggle" style="padding: 0px 6px;" type="button" data-toggle="dropdown">
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li> To : <?php // print_r($s);die;
                                  
                                      if(count($s) >1){ 
                                                                
                                         for($x=0; $x<count($s); $x++){
                                          //print_r($x);
                                            if($x==count($s)-1) {
                                              if ($s[$x]['status'] == 0) {
                                                //print_r($s[$x]['to_ccid']);
                                                if($email == $s[$x]['to_ccid']){

                                                echo $s[$x]['to_ccid'] . "(me)";
                                                }
                                                else
                                                echo $s[$x]['to_ccid'];
                                            } 
                                              }
                                            else {
                                              if ($s[$x]['status'] == 0) {
                                                if($email == $s[$x]['to_ccid']){

                                                echo $s[$x]['to_ccid'] . "(me)" . ",";
                                                }
                                                else
                                                echo $s[$x]['to_ccid'] . ",";

                                              //echo $s[$x]['to_ccid'] . ",";}
                                              } 
                                          }
                                        }
                                        }
                                        else 
                                          if($s['0']['status'] == 0)
                                            {
                                              if($email == $s['0']['to_ccid'])
                                                {echo $s['0']['to_ccid'] . "(me)";
                                                 }
                                              else
                                              echo $s['0']['to_ccid']; } ?>      
                           
                       </li> 
                       <br>
                       <?php //print_r($s); die; 
                       foreach ($s as $key ) {
                             if($key['status'] == 1){
                              $flag=1;
                             }
                           } 
                            if($flag == 1){ ?>
                            
                  <li>
                    Cc:
                  <?php //print_r($s);die;
                                  
                                      if(count($s) >1){ 
                                                                
                                         for($x=0 ; $x<count($s); $x++){
                                          
                                            if($x==count($s)-1) {
                                              if ($s[$x]['status'] == 1) {
                                                if($email == $s[$x]['to_ccid']){

                                                echo $s[$x]['to_ccid'] . "(me)";
                                                }
                                                else 
                                                echo $s[$x]['to_ccid'];
                                            }}
                                            else {
                                              if ($s[$x]['status'] == 1) {
                                                echo $s[$x]['to_ccid'] . ",";} }
                                          
                                        }
                                        }
                                        else 
                                          if($s['0']['status'] == 1)
                                            {echo $s['0']['to_ccid']; } ?>  
                           </li> 
                           <br>
                           <?php } ?>

                  
                  <li>
                    Subject : <?php  echo $value['subject']; ?>
                  </li>
                  
                </ul>
              </div></h4> 
              <h5 class="media-heading"> <?php echo "recieved at " .$value['time'] ." on ". $value['date'] ;?> </h5>
           
              <h5 class="media-heading"> Message : </h5>
        <p><?php echo $value['body']; ?> 
        </p>
         <?php if($value['attachment'] != "") {?>
        <h4> Attachments : </h4>
        <?php $b= explode(',', $value['attachment']);

        foreach ($b as $attach) {
        //print_r($attach);die; ?>
          <p> <i class="fa fa-download" aria-hidden="true"></i> <a href="http://localhost/hestabit/app/uploads/<?php echo $attach; ?>" download> <?php echo $attach;?>   </a></p>
        <?php } } ?>


              <pre> ---------------- Forwarded Message ---------------------------- </pre>
              <?php // echo $value['fwd'] . "<br>";

                 $s1 = $i->user_inbox_detail($value['fwd']);
            /*echo "<hr>";     

            print_r($s1); */ 
            $s2 = $i->user_inbox_detail1($value['fwd']);
            echo "<hr>";
            print_r($s2); ?>
              <h5> From : <?php echo $s1['fromid']; ?>  </h5>
              <h5 class="media-heading"> <?php echo "at " .$s1['time'] ." on ". $s1['date'] ;?> </h5>
              <h5> To : <?php echo $s2['0']['to_ccid']; ?>  </h5>
              <h5> Message forwarded was : <?php echo $s1['body']; ?></h5>
               <?php if($s1['attachment'] != "") {?>
        <h4> Attachments : </h4>
        <?php $b= explode(',', $s1['attachment']);

        foreach ($b as $attach) {
        //print_r($attach);die; ?>
          <p> <i class="fa fa-download" aria-hidden="true"></i> <a href="http://localhost/hestabit/app/uploads/<?php echo $attach; ?>" download> <?php echo $attach;?>   </a></p>
        <?php } } ?>

              <h5 class="media-heading"> <!-- Subject : -->
                  <span>
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-default"><a href="#myModal2" data-toggle="modal"><i class="fa fa-reply" aria-hidden="true"></i>
</a></button>
                            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                              <span class="caret">
                                </span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#myModal2" data-toggle="modal"><i class="fa fa-reply" aria-hidden="true">Reply</i></a></li>
                                <li><a href="#myModal3" data-toggle="modal">Forward</a></li>
                                <li><a href="#">Delete</a></li>
                                <li class="divider"></li>
                                <li><a data-toggle = "modal" href="#myModal1"> <i class="fa fa-reply-all" aria-hidden="true">Reply to all</i></a></li>
                            </ul>
                        </div>
                  </span>

              </h5> 
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal2" class="modal fade" style="display: none;">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                          <h4 class="modal-title">Reply</h4>
                                      </div>
                                      <div class="modal-body">
                                          <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">To</label>
                                                  <div class="col-lg-10">
                                                      <input type="email" placeholder="" value="<?php echo $value['fromid'] ;?>" id="inputEmail1" name="to2" class="form-control" list="emails" multiple readonly>
                                                      <!-- <datalist id="emails">
                                                        <?php// foreach ($users as $user ) {
                                                        ?>
                                                        <option value=" <?php //echo $user; ?>">
                                                      <?php //} ?>  
                                                      </datalist> -->
                                                  </div>
                                              </div>
                                              
                                              <div class="form-group" >
                                                  <label class="col-lg-2 control-label">Subject</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" placeholder=""  value ="<?php  if((stripos($inbox_msg['subject'], "RE: ") !== false)){
    echo  $inbox_msg['subject'];
  }
  else {
    echo "RE: " . $inbox_msg['subject'];
  } ?> " id="inputPassword1" name="subject2" class="form-control" readonly>
                                                      <input type="text" name="parentid2" value="<?php echo $inbox_msg['parentid'];?>" hidden>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Message</label>
                                                  <div class="col-lg-10">
                                                      <textarea rows="10" cols="30" class="form-control" id="" name="message2"></textarea>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <div class="col-lg-offset-2 col-lg-10">
                                                      <span class="btn green fileinput-button">
                                                        <i class="fa fa-plus fa fa-white"></i>
                                                        <span>Attachment</span>
                                                        <input type="file" name="files2[]" multiple>
                                                      </span>
                                                      <button class="btn btn-send" type="submit" name="submit2">Send</button>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->

      
      
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    <div class="media-right">

      <img src="<?php if($name['image']!= "") echo "http://localhost/hestabit/app/uploads/dp/" . $name['image'] ; else echo "http://localhost/hestabit/app/dummy.jpg";?>" class="media-object" style="width:60px">
    </div>

   <br>
   <br> 
   <br>
  </div>
  </div> <?php } }
  $b++;
  }
  }
?>
<?php  require_once 'reply.php'; ?>
</div>
</div>




