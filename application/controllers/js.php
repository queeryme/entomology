<?php

class Js extends CI_Controller{
	public function __construct(){
		parent::__construct();
		session_start();
	}
	public function index(){
		$this->load->view('js');
		$this->load->view('js/jquery-rp-searchbox');
		$this->load->view('js/jquery-rp-validate');
		$this->load->view('js/menu');
		$this->load->view('js/taxon');
	}
}