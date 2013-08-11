<?php

class Person extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('personModel','Person');
	}
	public function filter(){
		$filter=$this->input->post('filter');
		$page=$this->input->post('page');
		if($page<=0)$page=1;
		echo json_encode($this->Person->query_like($filter,$page));
	}
}