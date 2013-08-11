<?php

class cssModel extends CI_Model{
	private $profiles;
	
	public function __construct(){
		parent::__construct();	
		$color['txColor1']='hsl(83, 100%, 51%)';
		$color[11]='hsl(65,100%,80%)';//a lighter version of 1
		$color[2]='hsl(34,78%,20%)';//a dark background
		$color[3]='white';
		$color[4]='black';
		$color[41]='hsla(0, 0%, 0%, 0.5)';
	}
	public function library($profile='default'){
		if(isset($this->profiles[$profile]))
			return $this->profiles[$profile];
		else
			return $this->profiles['default'];
	}
	public function getProfile(){
		return $this->profiles['default'];
	}
}