<?php
require_once 'init.php';
if(isset($_SESSION)){

}else {
session_start();
}
class Validate {
	 private $_passed = false,
	 $_errors = array(),
	 $_db = null;

	 public function __construct(){
	 	$this->_db = DB::getInstance();

	 }
	 public function check($source, $items = array()) {
	 	/*print_r($source);
	 	echo ($_SESSION['token']);
	 	die;*/
	 /*	if($source['token'] == $_SESSION['token'])
	 	{*/
	 	foreach ($items as $item => $rules ) {
	 		foreach ($rules as $rule => $rule_value) {
	 			//echo"{$item} {$rule} must be {$rule_value} <br>";
	 			$value= trim($source[$item]);
	 			//$item = escape($item);
	 			//echo "$value";
	 			if($rule === 'required' && empty($value)){
	 				$this->addError("{$item} is required");
	 			} else {
	 				switch ($rule) {
	 					case 'min':
	 							if (strlen($value) < $rule_value) {
	 								 $this->addError("{$item} must be a min of {$rule_value} characters.");
	 							}
	 						break;
	 					
	 					case 'max':
	 						if (strlen($value) >  $rule_value) {
	 								 $this->addError("{$item} must be a max of {$rule_value} characters.");
	 							}
	 						break;
	 					case 'matches':
	 						/*print_r($value);
	 						print_r($rule_value);
	 						print_r($source[$rule_value]);*/

	 							if($value != $source[$rule_value]){
	 								 $this->addError("{$rule_value} does not match $item");
	 							}
	 						break;
	 					
	 					case 'unique':
	 							/*print_r($rule_value);
	 							echo"<br>";
	 							print_r($item);
	 							echo"<br>";
	 							print_r($value);
	 							echo"<br>";*/

	 							$user = DB::isUserExist($rule_value , $item , $value);

	 							if($user == true){ 
	 								if($item == "email"){
	 									$this->addError("{$value} this email already exists");
	 								}
	 								else
	 								$this->addError("{$value} this username already exists");
	 							}
	 							/*$check = $this->_db->get($rule_value, array($item, '=' , $value));
	 							if($check->count()){
	 								 $this->addError("{$item} already exists.");
	 							}*/

	 						break;
	 					
	 					default:
	 						# code...
	 						break;
	 				}

	 			}
	 		}
	 		
	 	}
	 /*}
	 else{
	 	$this->addError("This form is from invalid source");
	 }*/
	 	if(empty($this->_errors)){
	 			$this->_passed = true;
	 		}
	 		return $this;

	 }
	 private function addError($error){
	 	$this->_errors[]= $error;
	 }

	 public function errors()
	 {
	 	return $this->_errors;
	 }
	 public function passed(){
	 	return $this->_passed;
	 }
} 
?>