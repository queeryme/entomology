<?php

class Css extends CI_Controller{
	public function __construct(){
		parent::__construct();
		session_start();
		$this->load->model('jquery_ui','jq_ui');
	}
	public function index(){
		$params=array('JQ'=>$this->jq_ui->get_params());
		$this->load->view('css',$params);
		if(isset($_SESSION['user']))
			$params['user']=$_SESSION['user'];
		$this->load->view('css/menu.php',$params);
		$this->load->view('css/loader.php',$params);
		if(isset($_SESSION['user'])){
			$this->load->view('css/user.php',$params);
			$this->load->view('css/taxon.php',$params);
		}
		else{
			$this->load->view('css/login.php',$params);
		}
	}
	public function jquery_ui(){
		$params=$this->jq_ui->get_params();
		$this->load->view('jquery-ui',array('JQ'=>$params));
	}
}