<?php
require_once 'init.php';
/*$db1= new dbConnect();*/
$a = Session::check_session();
//print_r($a);die;
if($a == true){
header("Location: dashboard.php");

} ?>
<!DOCTYPE html>
                <html>
                <head>
                  <meta name="viewport" content="width=device-width, initial-scale=1">
                  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                </head>
                <body>
<?php
if(isset($_GET['msg'])){
print_r($_GET['msg']);
}
//print_r($_SESSION['token']);
if(isset($_POST['login'])){
    if(Input::exists()){

        //Session::set_token($_POST['token2']);
        $table = "users";
            $data = array( "username" => Input::get('username_login'),
                            "password" => Input::get('password'),
                             );

    $user =DB::Login($table, $data);
    
    
}
}
if(isset($_POST['register'])){
    if(Input::exists()){

        //Session::set_token($_POST['token1']);

        
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'users'

            ),
            'email' => array(
                'required' => true,
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

        if($validation->passed()){
            $table = "users";
            $data = array( "username" => Input::get('username'),
                            "password" => Input::get('password'),
                            'email' => Input::get('email'),
                            'name' => Input::get('name'),

                             );
            DB::UserRegister($table , $data);
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
<script>
$(document).ready(function(){
    $("#loginb").click(function(){
        $("#registerdiv").hide();
        $("#logindiv").show();
    });
    $("#registerb").click(function(){
        $("#logindiv").hide();
        $("#registerdiv").show();
        

    });
});
</script>

<div class="head">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                
            </div>
            <div class="col-md-3">
                <h2 id= "registerb"> <button> REGISTER </button> </h2>   
            </div>
            <div class="col-md-3">
                <h2 id = "loginb"> <button> LOGIN </button> </h2>
            </div>
        </div>
    </div>
</div>
<div id ="registerdiv">
    <div class="container">
        <div class="row">
        <div class="col-md-3"></div>
            <div class="col-md-6">
        
                <h3> REGISTER </h3>

                <form action="" method="post" id="register">
                    <input type="name" name="name" class="form-control" value="<?php echo Input::get('name'); ?>" placeholder="name">
                    <br>
                    <input type="text" class="form-control" name="username" value="<?php echo Input::get('username'); ?>" placeholder="username">
                    <br>
                    <input type="text" class="form-control" name="email" value="<?php echo Input::get('email'); ?>" placeholder="email">
                    <br>
                    <input type="password" name="password" class="form-control" value="<?php echo Input::get('password'); ?>" placeholder="password">
                    <br>
                    <input type="password" name="password_again" class="form-control" value="<?php echo Input::get('password_again'); ?>" placeholder="password_again">
                    <br>
                    
                    <input type="number" name="token" value="<?php $a= Token::generate_token();  Session::set_token($a); echo $a; ?>" placeholder="name" hidden><br>
                   <input type="submit" class="btn btn-default" name="register" value="Sign up"/>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="logindiv" style="display: none;">
    <div class="container">
            <div class="row">
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-6">
                    <h3>LOGIN</h3>

                    <form action="" method="post" id="login">
                        <input type="text" class="form-control" name="username_login" placeholder="username">
                        <br>
                        <input type="password" class="form-control" name="password" placeholder="password">
                        <!-- <input type="number" name="token2"  placeholder="name" hidden><br> -->
                        <br>
                        <input type="submit" class="btn btn-default" name="login" value="Login"/>


                    </form>
                </div>
        </div>
    </div>
</div>
</body>
</html>
