<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exception_Manager{
	public final static $errors = array(
		0=>'Default Error Message',
		1000=>'All {0} attempt(s) are used already. Try logging in after {1}. '
	);
	
	public function __construct(){
		
	}
	public function get_exception($code,$data){
		if(!isset(Exception_Manager::$errors[$code]))
			return new Exception(Exception_Manager::$errors[0],0);
		$msg=Exception_Manager::$errors[$code];
		$err_msg_array=preg_split('/\{[0-9]{1,}\}/',$msg);
		$err_msg='';
		foreach($err_msg_array as $key=>$value){
			$err_msg_array.=$value.$data[$key];
		}
		return new Exception($err_msg,$code);
	}
}
