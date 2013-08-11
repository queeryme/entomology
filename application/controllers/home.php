<?php

class Home extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		session_start();
	}
	public function index(){
		$data=array();
		
		if(!isset($_SESSION['user'])){
			$this->_guestView();
			return;
		}
		
		/**********USER VIEW***********/
		$user=$_SESSION['user'];
		
		$data=array('user'=>$user);
		$this->load->view('templates/header',$data);
		$this->load->view('user',array('user'=>$user));
		
		$this->load->model('organismModel');
		$this->load->view('breadcrumb');
		
		if($user['u_type']==='a')
			$this->_adminView();
		else if($user['u_type']==='c') 
			$this->_collectorView();
		
	}
	public function _adminView(){
		
	}
	public function _collectorView(){
		
	}
	public function _guestView(){
		$this->load->view('templates/header');
		$this->load->view('login');
	}
}