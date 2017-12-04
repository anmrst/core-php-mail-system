<?php
require_once 'file:///C:/xampp/htdocs/hestabit/app/init.php';


class DB{
  private static $_instance = null;
  private $conn,
          $stmt,
          $_error = false,
          $_results,
          $_count = 0;
          private function __construct(){
            $this->conn = new mysqli(Config::get('mysqli/host') ,Config::get('mysqli/user') ,Config::get('mysqli/password') , Config::get('mysqli/db')  );
              
                    if ($this->conn->connect_error) {
                        die("Connection failed: " . $this->conn->connect_error);
                    } 
                    else 
                        {}
                        
                          
        }     

        public static function getInstance(){
            if(!isset(self::$_instance)){
                self::$_instance = new DB();

            }
            return self::$_instance;
        }   

       public function UserRegister($username, $password,$email, $name){

                $a = DB::getInstance();
                $password = md5($password);
            
                $qr = "INSERT INTO users(username, password, email, name) values('".$username."','".$password."','".$email."' , '".$name."')" or die(mysql_error());

                if ($a->conn->query($qr) === TRUE) {
                    echo "Registration successful";
                        } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                                        }   
               
             
        }

        /*public function query($sql, $params=array()){
            $this->_error = false;
            if($this->stmt = $this->conn->prepare($sql)){
                
                if(count($params)){
                    foreach ($params as $param ) {
                       
                        $this->stmt->bind_param('ss', $param);
                        
                    }
                }
                if($this->stmt->execute()){
                    //echo "success";die;
                    $this->stmt->bind_result($a ,$b, $c, $d, $e);
                    $this->stmt->fetch();
                    echo $a . $b . $c .$d .$e;
                    print_r($this->stmt);
                    
                }
            }
        }*/
        public function action($action ,$table, $where = array() ){
            if(count($where) === 3){
                $operators = array('=','>','<','>=', '<=');

                $field    = $where[0];
                $opeartor = $where[1];
                $value    = $where[2];
                if(in_array($opeartor, $operators)){
                    $sql = "{$action} FROM   ";
                }
            }
        }
        public function get($table ,$where = array() ){

        }



        public static function isUserExist($emailid){
             $a = DB::getInstance();
            $qr = "SELECT * FROM users WHERE email = '".$emailid."'";
            
             $result = mysqli_query($a->conn,$qr);

             if ($result->num_rows>0) {
                
                return true;
                          }
                          else{
                            
                            return false;
                            
                          }
            
        }
    

        public static function Login($emailid, $password){
                $b= md5($password);
                $a = DB::getInstance();
          
           

                $qr = "SELECT * FROM users WHERE email = '$emailid' and password='$b' ";

                $result = $a->conn->query($qr);
        
                if ($result->num_rows == 1)
                    { $row = $result->fetch_assoc();

                        Cookie::set_cookie($row);
                        Session::set_session($row);
                        header("Location: dashboard.php");
                    
                    } 
                    else {
                        echo "password/email doesnot match";
                    }

        }

}

?>