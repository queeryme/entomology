<?php
class User extends CI_Model{
	
	//this cannot be loaded. it must be directly called
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function query($username,$password){
		$data=array('username'=>$username,'password'=>md5($password));
		$this->db->select('u_id,username,u_type,first_name,last_name,contact,address');
		$query=$this->db->get_where('user',$data);
		
		if($query->num_rows()===0)return NULL;
		$result=$query->result_array();
		$row=$result[0];
		return $row;
	}
}