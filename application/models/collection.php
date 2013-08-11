<?php
class Collection extends CI_Model{
	public final static $lookup = array(
		'd'=>'damaged',
		's'=>'severge',
		'g'=>'good',
		'v'=>'very good',
		'p'=>'perfect'
	);
	
	public function __construct(){
		parent::__construct();
	}
	public function insert($data){
		$this->db->insert('collection',$data);
	}
	public function query($c_id,$columns='*'){
		$data=array('c_id'=>$c_id);
		$this->db->select($columns);
		$query=$this->db->get_where('collection',$data);
		if($query->num_rows()===0)return NULL;
		$result=$query->result();
		return $result[0];
	}
	public function update($c_id=1,$data){
		$this->db->where('c_id',$c_id);
		$this->db->update('collection',$data);
	}
	public function move($c_id,$o_id){
		$this->db->where('c_id',$c_id);
		$data=array('o_id'=>$o_id);
		$this->db->update('collection',$data);
	}
	public function query_list($o_id,$columns='*'){
		$data=array('o_id'=>$o_id);
		$this->db->select($columns);
		$query=$this->db->get_where('collection',$data);
		if($query->num_rows()===0)return NULL;
		return $query->result();
	}
	public function delete($c_id){
		$this->db->delete('collection',array('c_id'=>$c_id));
	}
	public function delete_batch($data){
		$data=array_filter(array_values($data),'is_int');
		$this->db->where_in('c_id',$data);
		$this->db->delete('collection');
	}
	
	
}