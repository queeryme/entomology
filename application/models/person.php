<?php

class Person extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function search(){
	}
	public function query_filter($like){
		$max_items=4;
		if($like==NULL)$like='';//nonstrict equalitity
		$this->db->like("concat(first_name,' ',last_name)",$like);
		$query=$this->db->get('person');
		if($query->num_rows()===0)return NULL;
	}
	public function query($p_id){
		$query=$this->db->get_where('person',array('p_id'=>$p_id));
		if($query->num_rows()===0)return NULL;
		$result=$query->result_array();
		$row=$result[0];
		return $row;
	}
	
}