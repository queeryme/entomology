<?php

class PersonModel extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function search(){
	}
	public function insert($first_name,$last_name,$address,$contact){
		$data=array(
			'first_name'=>$first_name,
			'last_name'=>$last_name,
			'address'=>$address,
			'contact'=>$contact
		);
		$this->db->insert('person',$data);
		return $this->last_insert_id();
				
	}
	private function last_insert_id(){
		$this->db->select('last_insert_id() as LAST_INSERT_ID',false);
		$query=$this->db->get();
		$result=$query->result_array();
		$row=$result[0];
		$id=$row['LAST_INSERT_ID'];
		return $id;
	}
	public function query_like($like='',$page=1){
		$max_items=4;
		$no_data=array('page'=>0,'max'=>0,'results'=>array());
		if($page<=0)return  $no_data;
		
		if($like==NULL)$like='';//nonstrict equalitity
		$this->db->select(
			"concat(first_name,' ',last_name) as text,".
			"p_id as value",false);
		$this->db->like("concat(first_name,' ',last_name)",$like);
		$query=$this->db->get('person',$max_items,($page-1)*$max_items);
		
		$this->db->select(
			"concat(first_name,' ',last_name) as text,".
			"p_id as value",false);
		$this->db->like("concat(first_name,' ',last_name)",$like);
		$query2=$this->db->get('person');
		if($page>1&&$query->num_rows()===0){
			$page=1;
			$this->db->select(
				"concat(first_name,' ',last_name) as text,".
				"p_id as value",false);
			if($like==NULL)$like='';//nonstrict equalitity
			$this->db->like("concat(first_name,' ',last_name)",$like);
			$query=$this->db->get('person',$max_items,($page-1)*$max_items);
		}
		
		if($query->num_rows()===0)
			return $no_data;
			
		$rows=$query2->num_rows();
		$pages=ceil($rows/$max_items);
		$rows=$query2->num_rows();
		$current_page=$page;
		
		return array(
			'page'=>$current_page,
			'max'=>$pages,
			'results'=>$query->result_array()
		);
	}
	public function query($p_id){
		$query=$this->db->get_where('person',array('p_id'=>$p_id));
		if($query->num_rows()===0)return NULL;
		$result=$query->result_array();
		$row=$result[0];
		return $row;
	}
	
}