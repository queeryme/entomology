<?php
class Login extends CI_Controller{
	private $max_attempts=3;
	private $wait_time=180;//seconds
	public function __construct(){
		parent::__construct();
		session_start();
	}
	public function index(){
		$this->load->view('templates/header');
		if(isset($_SESSION['user'])){
			redirect(base_url().'home');
		}
		else{
			echo '<div class=test2></div>';
			$this->load->view('login');
		}
		return;
	}
}