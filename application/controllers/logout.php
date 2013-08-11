<?php

class Logout extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		session_start();
		if(isset($_SESSION['user'])===false){
			$config=array(
				'code'=>2000,
				'data'=>''
			);
			$this->load->view('ajax/error',$config);
		}
		unset($_SESSION['user']);
		session_destroy();
	}
}