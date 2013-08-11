<?php

class MY_Exception extends Exception{


	static $codeList = array(
	
   0=>"Default Exception.",
   1=>"Code not found Exception.",
	 
//1000 - 2000 : Common MY_Table Exception
1100=>"Invalid Table Name."
		);
		
	function __construct(
			$code=0,
			Exception $previous = NULL){
		$message="";
		if(isset(self::$codeList[$code])===false)
		$code=0;
		
		parent::__construct(self::$codeList[$code],$code,$previous);
	}
}
echo preg_match_all("/[a-z|$]{1,}/i",'test');