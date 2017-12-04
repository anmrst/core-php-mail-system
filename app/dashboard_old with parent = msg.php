
<?php
require_once 'header.php';
$email = $_SESSION['email'];
			    
			    $i = new message();
			    $inbox = $i->user_inbox($email);
			    //print_r($inbox);
			    //echo "<hr>";
			    	foreach ($inbox as $key) {
			    		$msgid = $key['msgid'];
			    		//print_r($msgid);
			    		//echo "<br>";
			    	
			    $inbox_msg[] = $i->user_inbox_detail($msgid);
			    
			    //print_r($inbox_msg);die;
			} 
			   // print_r($inbox_msg); 
			   // echo "<hr>";
			    /*foreach ($inbox_msg as $k) {
			    	//print_r($k);die;
			    	$p_id[]= $k['parentid'];
			    }
			    print_r($p_id);die;*/

			    //$p = $inbox_msg['0']['parentid'];
			    //echo"<br" . $p;
			    //echo "QQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQ";
			    //echo $p;
			    //echo "<br>";
			    //$parentid = $i->parentid_msg($p);

			  	/*$b = new message();
				$sent = $b->user_sentbox($email);
				*/

?>

<?php
require_once 'sidebar.php';
//print_r($_SESSION);
require_once 'create.php';
/*if(isset($_PO['search_box'])) {
$xx = $_GET['search'];
print_r($xx);
}*/

?>


	
<div style="width: 80%; float: right">


  <div class="inbox-head">
                          <h3>Inbox</h3>
                          <form action="#" class="pull-right position">
                              <div class="input-append">
                                <form>
                                  <input type="text" class="sr-input" name="search" placeholder="Search Mail">
                                  <button class="btn sr-btn" type="submit" name="search_box"><i class="fa fa-search"></i></button>
                                </form>
                              </div>
                          </form>
                      </div>
                      <div class="inbox-body">
                         <div class="mail-option">
                             <div class="chk-all">
                                 <input type="checkbox" class="mail-checkbox mail-group-checkbox">
                                 <div class="btn-group">
                                     <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
                                         All
                                         <i class="fa fa-angle-down "></i>
                                     </a>
                                     <ul class="dropdown-menu">
                                         <li><a href="#"> None</a></li>
                                         <li><a href="#"> Read</a></li>
                                         <li><a href="#"> Unread</a></li>
                                     </ul>
                                 </div>
                             </div>

                             <div class="btn-group">
                                 <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
                                     <i class=" fa fa-refresh"></i>
                                 </a>
                             </div>
                             <div class="btn-group hidden-phone">
                                 <a data-toggle="dropdown" href="#" class="btn mini blue" aria-expanded="false">
                                     More
                                     <i class="fa fa-angle-down "></i>
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                     <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                     <li class="divider"></li>
                                     <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                 </ul>
                             </div>
                           

                             <ul class="unstyled inbox-pagination">
                                 <li><span>1-50 of 234</span></li>
                                 <li>
                                     <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                                 </li>
                                 <li>
                                     <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                                 </li>
                             </ul>
                         </div>
                          
                      </div>
  <!-- <input id="skills" size="50"> -->
    <table class="table table-inbox table-hover">
                            <tbody>

                           <?php 
                           static $z=0;
                           //print_r($inbox_msg);die;
                           if(isset($inbox_msg)) {
                           	$flag=0;
                              foreach($inbox_msg as $key)
                              {  //print_r($key['msgid']);
                          		//echo"<hr>";
                          		//print_r($key['parentid']);
                          		//echo "<hr>";
                          		//die;
                                if($key['msgid'] == $key['parentid']) {
                                	//print_r("something here");	die;
                                	$z= $key['parentid'];
                                	//$flag=1;
                                ?>
                              <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show."><?php echo $key['fromid']; ?></td>
                                  <td class="view-message "><a href="viewmessage.php/?id= <?php echo $key['msgid']; ?> "><?php echo $key['subject']; ?> </a></td>
                                  <!-- <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td> -->
                                  <!-- <td class="view-message"><a href="viewmessage.php/?id= <?php //echo $key['msgid']; ?> "> View Message </a></td> -->
                                  <td class="view-message  text-right"><?php echo $key['time'] ." " .$key['date']; ?></td>
                              </tr>
                <?php }  
                				//$z= $inbox_msg['0']['parentid'];
                					//if($flag == 0){
                				 //$z = $key['parentid'];
                          		 //print_r($key['parentid']);
                          		 //echo "<hr>";
                          		 //print_r($z);die;
                               		 if($z == $key['parentid']) {
                                		//$flag=1;
                                		 }
                                		else{
                                ?>
                              <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show."><?php echo $key['fromid']; ?></td>
                                  <td class="view-message "><a href="viewmessage.php/?id= <?php echo $key['msgid']; ?>  "><?php echo $key['subject']; ?> </a> </td>
                                  <!-- <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td> -->
                                 <!--  <td class="view-message"><a href="viewmessage.php/?id= <?php //echo $key['msgid']; ?>  "> View Message </a></td> -->
                                  <td class="view-message  text-right"><?php echo $key['time'] ." " .$key['date']; ?></td>
                              </tr>

                <?php $z=$key['parentid'];   } 
            }  /*}*/ } else echo "<h2>" . "NO MESSAGES" . "</h2>"   ?> 

            </tbody>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>


<?php
{
//print_r($_POST['files']);die;
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
          //print_r($_FILES['files']);die;
          $files[] = $_FILES['files']['name'];
          //print_r($_FILES['files']['name']);
          $attach = implode(",", $_FILES['files']['name']);
          //print_r($a);die;
           //$attach= implode(',' ,$files[] );
           //print_r($attach); die;
            $from1 = $_SESSION['email'];
            $id = $_SESSION['uid'];
      	    //echo(Input::get('to') . "<br>" . Input::get('cc') . "<br>" . Input::get('subject') . "<br>" . Input::get('message') . "<br>" . $from);die;
            $msg = new message();

            $from = $msg->message_save( Input::get('subject'), Input::get('message') , $from1 , $id, $attach );
            $to = $msg->recipent_save(Input::get('to') , Input::get('cc'));

            if(count($_FILES['files']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['files']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['files']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
                $shortname = $_FILES['files']['name'][$i];
                //print_r($shortname); die;
                //save the url and the file
                $filePath = "uploads/" . $_FILES['files']['name'][$i];

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
   
}
?>


