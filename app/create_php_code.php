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