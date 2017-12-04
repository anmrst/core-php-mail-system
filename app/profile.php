<?php
//session_start();
require_once 'init.php';
require_once 'header.php';
require_once 'sidebar.php';

//print_r($_SESSION);
$a = Session::check_session();
if($a == true){

}
else {
	header('Location:index.php');

}

//echo "something here";die;
if(isset($_POST['update'])){
    if(Input::exists()){

        //Session::set_token($_POST['token1']);

        
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            
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

        if($validation->passed()){
            $table = "users";
            $data = array( 
                            "password" => Input::get('password'),
                            
                            'name' => Input::get('name'),

                             );
            $id = $_SESSION['uid'];
            //echo $id;die;
            DB::UserUpdate($table , $data , $id);
        }
        else {
            /*print_r($validation->errors());*/
            foreach ($validation->errors() as $error) {
                echo "$error . <br>";
            }
        }
    }   
    }

//echo "sadasddda";
    if(isset($_POST['img_upload'])){
    $target_dir = "uploads/dp/";
$target_file = date('d-m-Y-H-i-s').'-'.$_FILES['file_upload']['name'];
print_r($target_file);
$filePath = $target_dir . date('d-m-Y-H-i-s').'-'.$_FILES['file_upload']['name'];
$uploadOk = 1;
$imageFileType = pathinfo($filePath,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["file_upload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists

// Check file size
if ($_FILES["file_upload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $filePath)) {
        echo "<br>" . "<br>";
        echo "<br>" . "<br>";
        echo "<br>" . "<br>";

        echo "The file ". basename( $_FILES["file_upload"]["name"]). " has been uploaded.";
        $table = "users";
            $data = array( 
                            "image" => $target_file
                            
                            

                             );
            $id = $_SESSION['uid'];
            //echo $id;die;
            DB::UserUpdate1($table , $data , $id);
    } else {
        echo "<br>" . "<br>";echo "<br>" . "<br>";echo "<br>" . "<br>";
        echo "Sorry, there was an error uploading your file.";
    }
}
    }

?>
	
		<div style="width: 38%; float: left; margin-left: 2%">
<h1> Update Profile </h1>
<form action="" method="post" id="update">
    <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username'] ?>" placeholder="username" readonly>
    <br>
    <input type="text" class="form-control" name="email" value="<?php echo $_SESSION['email'] ?>" placeholder="email" readonly>
    <br>
    <input type="password" name="password" class="form-control" placeholder="password">
    <br>
    <input type="password" name="password_again" class="form-control" placeholder="password_again">
    <br>
    <input type="name" name="name" class="form-control" value="<?php echo $_SESSION['name']; ?>" placeholder="name"><br>
    <input type="number" name="token" value="<?php $a= Token::generate_token();  Session::set_token($a); echo $a; ?>" placeholder="name" hidden><br>
   <input type="submit" name="update" class="btn btn-default" value="update"/>
</form>
</div>
<div style="width: 35%; float: right;" class="text-center">

    <h3>Upload Image :</h3>
    
    <img src=" <?php if(isset($_SESSION['image'])) { echo "http://localhost/hestabit/app/uploads/dp/" . $_SESSION['image'] ; } else echo "dummy.jpg" ?> " class="img-circle" height="150" width="200"> 
    <form action="" method="post" enctype="multipart/form-data">
    
    <input type="file" name="file_upload">
    <button type="submit" class="btn btn-default" name="img_upload"> Upload Image </button>
</form>
	</div>


</body>
</html>