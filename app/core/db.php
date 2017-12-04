<?php
require_once 'file:///C:/xampp/htdocs/hestabit/app/init.php';


class DB{
  private static $_instance = null;
  private $conn,
          $_query,
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

       public function UserRegister($table , $data =array()){

                $a = DB::getInstance();
                $data['password'] = md5($data['password']);
                $keys= array_keys($data);
                $values = array_values($data);
                
                $qr = "INSERT INTO ".$table." ( ".implode(",", $keys) . ") values( '". implode("','", array_values($data)) . "')" or die(mysql_error());
                //print_r($qr);die;
                if ($a->conn->query($qr) === TRUE) {
                    echo "Successfully Registered";
                        } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                                        }   
               
             
        }

         public function UserUpdate($table , $data =array() ,$id){
               // print_r("Wrong function");die;
                $a = DB::getInstance();
                $data['password'] = md5($data['password']);
                $keys= array_keys($data);
                $values = array_values($data);
                //print_r($keys);
                //echo "<br>";
                //print_r($values);

                $qr = "UPDATE ".$table." SET $keys[0]= ?, $keys[1]= ?  WHERE id = $id" or die(mysql_error());
                
                //print_r($qr);die;
                $stmt = $a->conn->prepare($qr);
                $stmt->bind_param('ss' , $values[0] , $values[1]);
                //print_r("prepare query  : ");
                //print_r($stmt); die;
                if($stmt->execute()){
                    //echo "success";die; 
                  //print_r($values[0]);
                  //echo $values[1];die;
                /*}
                if ($a->conn->query($qr) === TRUE) {*/
                    echo "Profile successfully updated";
                    Session::update_session($values[1]);
                    header('Location: dashboard.php');
                        } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                                        }   
                     
        }

        public function UserUpdate1($table , $data =array() ,$id){
                //print_r("rigth function"); die;
                $a = DB::getInstance();
                $keys= array_keys($data);
                $values = array_values($data);
                //print_r($keys);
                //echo "<br>";
                //print_r($values);

                $qr = "UPDATE ".$table." SET $keys[0]= ? WHERE id = $id" or die(mysql_error());
                
                //print_r($qr);die;
                $stmt = $a->conn->prepare($qr);
                $stmt->bind_param('s' , $values[0]);
                //print_r("prepare query  : ");
                //print_r($stmt); die;
                if($stmt->execute()){
                    //echo "success";die; 
                  //print_r($values[0]);
                  //echo $values[1];die;
                /*}
                if ($a->conn->query($qr) === TRUE) {*/
                    echo "Profile picture successfully updated";
                    Session::update_session1($values[0]);
                    header('Location: profile.php');
                        } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                                        }   
                     
        }


        public static function isUserExist($table , $field , $value){
             $a = DB::getInstance();
            $qr = "SELECT * FROM {$table} WHERE {$field} = '".$value."'";
            
             $result = mysqli_query($a->conn,$qr);
             /*print_r($result);*/
             if ($result->num_rows>0) {
                
                return true;
                          }
                          else{
                            
                            return false;
                            
                          }
            
        }
    

        public static function Login($table, $data =array()){
                $data['password']= md5($data['password']);
                $a = DB::getInstance();
                $keys= array_keys($data);
                $values = array_values($data);
                            $qr = "SELECT * FROM $table WHERE $keys[0] = '$values[0]' and $keys[1]= '$values[1]' ";
                
              //print_r($qr);
              
                $result = $a->conn->query($qr);
                  //print_r($result);die;
                if(!empty($result))
                {
                if ($result->num_rows == 1)
                    { $row = $result->fetch_assoc();

                        Cookie::set_cookie($row);
                        Session::set_session();
                        header("Location: dashboard.php");
                    
                    } }
                    else {
                        echo "password/email doesnot match";
                    }

        }

        public static function delete($id){
                $table = "users";
                $a = DB::getInstance();
                $qr = "DELETE FROM $table WHERE id = '$id'";
                if($a->conn->query($qr) == TRUE)
                {
                  echo "USER DELETED SUCCESSFULLY" ;
                  Cookie::del_cookie();
    Session::del_session();
    header('Location: index.php/?msg=User Successfully Deleted');
  
                } 
                else {
                  echo "ERROR DELETING USER";
                }


        }

        /*public static function message($data){
            $table = "message";
            $keys= array_keys($data);
            $values = array_values($data);
             $a = DB::getInstance();

            $qr = "INSERT INTO ".$table." ( ".implode(",", $keys) . ") values( '". implode("','", array_values($data)) . "')" or die(mysql_error());
            print_r($qr); 
            //$sql = "INSERT INTO message (parent, child, subject,messageBody) VALUES ('$from', '$to' ,'$sub' , '$msg')";

            if ($a->conn->query($qr) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }*/

        public static function get_users_query($table){
          $a = DB::getInstance();
          $qr = "SELECT email FROM $table" ;
          $result = $a->conn->query($qr);
          //print_r($result);die;
           while($row = mysqli_fetch_assoc($result)){
              $rows[] = $row['email'];
           }
           return $rows;
        }

        public static function message_save_query($data, $table){
          $a = DB::getInstance();
          $keys = array_keys($data);
          $valus = array_values($data);

          $qr = "INSERT INTO ".$table." ( ".implode(",", $keys) . ") values( '". implode("','", array_values($data)) . "')" or die(mysql_error());
          //print_r($qr);die;
          if($a->conn->query($qr) == TRUE)
          {
            echo "MESSAGE SENT SUCCESSFULLY";
          }
          else{
            echo "error in message dispatch";
          }
        }

        public static function recipent_save_query($to1 , $cc1, $table, $msgid){
          $a = DB::getInstance();
          //print_r(strlen($cc1))
            if(!empty($cc1)){
            
                  foreach ($to1 as $to ) {
                    $qr = "INSERT INTO ".$table." ( msgid , to_ccid , status) values('$msgid' , '$to' , 0)";
                        if($a->conn->query($qr) == TRUE){
                          //echo "data inserted";
                        }
                  }
                  foreach ($cc1 as $cc ) {
                    $qr = "INSERT INTO ".$table." ( msgid , to_ccid , status) values('$msgid' , '$cc' , 1)";
                        if($a->conn->query($qr) == TRUE){
                          //echo "data inserted";
                         }
                  }
              }
              else{
                foreach ($to1 as $to ) {
                    $qr = "INSERT INTO ".$table." ( msgid , to_ccid , status) values('$msgid' , '$to' , 0)";
                        if($a->conn->query($qr) == TRUE){
                          //echo "data inserted";
                        }
                  }
              }
        }

        public static function user_sentbox_query($table,$email){
          $a = DB::getInstance();
           $qr = "SELECT * FROM $table WHERE fromid = '$email' ORDER BY id DESC";
           //print_r($qr);
           $result = mysqli_query($a->conn, $qr);
           $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
           //print_r($row);
           return($row);
        }

        public static function user_sentbox_query1($msgid){
          $a = DB::getInstance();
          $table='recipent';
          $qr= "SELECT * FROM $table WHERE msgid='$msgid'";
          $result= mysqli_query($a->conn, $qr);
          //$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
          //$row = mysqli_fetch_array($result);
          while($row = mysqli_fetch_assoc($result)){
              $rows[] = $row;
           }


          //print_r($rows);
          //print_r(count($rows));
          //echo "<br>";
          return($rows);
        }

        public static function user_inbox_query($table,$email){
          $a= DB::getInstance();

          $qr = "SELECT * FROM $table WHERE to_ccid = '$email' ORDER BY id DESC";
           $result = mysqli_query($a->conn, $qr);
           //print_r($result);die;
           $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
           //print_r($row);die;
           return $row;

          

        }

        public static function user_inbox_detail_query($msgid, $table){
            $a = DB::getInstance();

            $qr = "SELECT * FROM $table WHERE msgid = '$msgid' ORDER BY date DESC, time DESC  ";
            //print_r($qr);die;
            $result = mysqli_query($a->conn, $qr);
            //print_r($result);  
            $row = mysqli_fetch_assoc($result);
            //echo "<hr>";
            //print_r($row);die;
           return $row;
        }                                                                                                                                                                                                                             
        public static function user_inbox_detail_query2($msgid, $table){
            $a = DB::getInstance();

            $qr = "SELECT * FROM $table WHERE parentid = '$msgid' ORDER BY date DESC, time DESC ";
            //print_r($qr);die;
            $result = mysqli_query($a->conn, $qr);
            //print_r($result);  
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
           //print_r($row);die;
           return $row;
        }

        public static function user_inbox_detail_user($email){
            $a = DB::getInstance();
            $table = "users";
            $qr = "SELECT * FROM $table WHERE email = '$email' ";
            //print_r($qr);die;
            $result = mysqli_query($a->conn, $qr);
            //print_r($result);  
            $row = mysqli_fetch_assoc($result);
           //print_r($row);die;
           return $row;
        }

        public static function user_inbox_detail_query1($msgid,$table){
          $a =  DB::getInstance();
          $qr = "SELECT * FROM $table WHERE msgid = '$msgid'";
          $result = mysqli_query($a->conn, $qr);
          $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
          //print_r($row);
          return $row;
        }

        public static function user_sentbox_detail($msgid){
          $a = DB::getInstance();
          $qr = "SELECT * FROM message WHERE msgid = '$msgid' ";
          $result = mysqli_query($a->conn, $qr);
          $row = mysqli_fetch_assoc($result);
          return $row;
        }

        public static function reply_save_query($data, $table){
          $a = DB::getInstance();
          $keys = array_keys($data);
          $valus = array_values($data);

          $qr = "INSERT INTO ".$table." ( ".implode(",", $keys) . ") values( '". implode("','", array_values($data)) . "')" or die(mysql_error());
          //print_r($qr);die;
          if($a->conn->query($qr) == TRUE)
          {
            echo "REPLY SENT SUCCESSFULLY";
          }
          else{
            echo "error in message dispatch reply";
          }
        }

        public static function reply_recipent_save_query($to1 , $cc1, $table, $msgid){
          $a = DB::getInstance();
          //print_r(strlen($cc1))
            if(!empty($cc1)){
            
                  foreach ($to1 as $to ) {
                    $qr = "INSERT INTO ".$table." ( msgid , to_ccid , status) values('$msgid' , '$to' , 0)";
                        if($a->conn->query($qr) == TRUE){
                          //echo "data inserted";
                        }
                  }
                  foreach ($cc1 as $cc ) {
                    $qr = "INSERT INTO ".$table." ( msgid , to_ccid , status) values('$msgid' , '$cc' , 1)";
                        if($a->conn->query($qr) == TRUE){
                          //echo "data inserted";
                         }
                  }
              }
              else{
                foreach ($to1 as $to ) {
                    $qr = "INSERT INTO ".$table." ( msgid , to_ccid , status) values('$msgid' , '$to' , 0)";
                        if($a->conn->query($qr) == TRUE){
                          //echo "data inserted";
                        }
                  }
              }
        }
        public static function parentid_msg_query($table, $p){
        $a = DB::getInstance();
        $qr = "SELECT * FROM $table WHERE parentid = '$p'  
        ORDER BY time ASC";
        //print_r($qr);
        $result = mysqli_query($a->conn, $qr);
        //print_r($result);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //print_r($row);
        }

        public static function delete1($table, $msgid, $email){
        $a = DB::getInstance();
        $qr = "UPDATE $table SET del = 1 WHERE msgid = $msgid AND to_ccid = '$email' ";
        //print_r($qr);
        //$result = mysqli_query($a->conn, $qr);
        if($a->conn->query($qr) == TRUE){
            echo '<script language="javascript">';
            echo 'alert("message moved to Trash")';
            echo '</script>';
        }
        else{
          echo "error in deletion";
        }
        //print_r($result);
        //$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //print_r($row);
        }

        public static function delete2($table, $msgid, $email){
        $a = DB::getInstance();
        $qr = "UPDATE $table SET del = 1 WHERE msgid = $msgid AND fromid = '$email' ";
        //print_r($qr);
        //$result = mysqli_query($a->conn, $qr);
        if($a->conn->query($qr) == TRUE){
            echo '<script language="javascript">';
            echo 'alert("message moved to Trash")';
            echo '</script>';
        }
        else{
          echo "error in deletion";
        }
        //print_r($result);
        //$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //print_r($row);
        }

        public static function user_thrashbox_query($table,$email){
          $a = DB::getInstance();
           $qr = "SELECT * FROM $table WHERE fromid = '$email' AND del =1 ORDER BY id DESC";
           //print_r($qr);
           $result = mysqli_query($a->conn, $qr);
           $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
           //print_r($row);
           return($row);
        }

        public static function user_thrashbox_query2($table,$email){
          $a = DB::getInstance();
           $qr = "SELECT * FROM $table WHERE to_ccid = '$email' AND del =1 ORDER BY id DESC";
           //print_r($qr);
           $result = mysqli_query($a->conn, $qr);
           $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
           //print_r($row);
           return($row);
        }

        public static function user_trashbox_query_detail($msgid){
          $a = DB::getInstance();
          $table = 'message';
           $qr = "SELECT * FROM $table WHERE msgid = $msgid ORDER BY id DESC";
           //print_r($qr);
           $result = mysqli_query($a->conn, $qr);
           $row = mysqli_fetch_assoc($result);
           //print_r($row);
           return($row);
        }
        public static function user_trashbox_query_detail2($msgid){
          $a = DB::getInstance();
          $table = 'recipent';
           $qr = "SELECT * FROM $table WHERE msgid = $msgid ORDER BY id DESC";
           //print_r($qr);
           $result = mysqli_query($a->conn, $qr);
           $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
           //print_r($row);
           return($row);
        }

        public static function restore_msg_query1($table, $msgid, $email){
          $a = DB::getInstance();
          $qr = "UPDATE $table SET del = 0 WHERE msgid = '$msgid' AND to_ccid ='$email' ";
          if($a->conn->query($qr) == TRUE){
            echo '<script language="javascript">';
            echo 'alert("message moved to Inbox")';
            echo '</script>';
        }
        else{
          echo "error in restore";
        }
        }

        public static function restore_msg_query2($table, $msgid){
          $a = DB::getInstance();
          $qr = "UPDATE $table SET del = 0 WHERE msgid = '$msgid' AND fromid = '$email' ";
          if($a->conn->query($qr) == TRUE){
            echo '<script language="javascript">';
            echo 'alert("message moved to Inbox")';
            echo '</script>';
        }
        else{
          echo "error in restore";
        }
        }

        public static function msg_read_status_query($table, $msgid, $email){
          $a = DB::getInstance();
          $qr = "UPDATE $table SET readstatus = 1 WHERE msgid = $msgid AND to_ccid = '$email' ";
          if($a->conn->query($qr) == TRUE) {

          }
          else {
            echo "error in read/unread status";
          }
        }

        public static function user_read_status_check_query($table,$msgid,$email){
          $a = DB::getInstance();
          if($msgid != ""){
          $qr = "SELECT * FROM $table WHERE msgid = $msgid AND to_ccid = '$email' ";
          //print_r($qr);
          $result = mysqli_query($a->conn, $qr);
          
          $row = mysqli_fetch_assoc($result);
          //print_r($row);
          return $row;
        }
        }

        public static function multiple_delete_query($table, $boxes, $email){
          $flag =0;
          $a = DB::getInstance();
          foreach ($boxes as $box) {
            $qr = "UPDATE $table SET del = 1 WHERE msgid = $box AND to_ccid = '$email' ";
            //print_r($qr);die;
            if ($a->conn->query($qr) == TRUE) {
              $flag=1;
            }
            else echo "error in multiple delete";
          }
          if($flag == 1){
            echo "<script> alert('message(s) moved to trash'); </script>";
          }
        }
}

?>