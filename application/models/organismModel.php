<?php
class OrganismModel extends CI_Model{
	public static $lookup=array(
		'k'=>'kingdom',
		'p'=>'phylum',
		'c'=>'class',
		'o'=>'order',
		'f'=>'family',
		'g'=>'genus',
		's'=>'species'
	);
	public static $singleton;
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		OrganismModel::$singleton=$this;
	}
	public function insert($o_type,$p_id,$author_dt,$name,$parent_o_id){
		$data=array(
			'o_type'=>$o_type,
			'p_id'=>$p_id,
			'author_dt'=>$author_dt);
		if($o_type!=='s')
			$data['name']=$name;
		$this->db->insert('organism',$data);
		
		$this->db->select('last_insert_id() as LAST_INSERT_ID',false);
		$query=$this->db->get();
		$result=$query->result_array();
		$row=$result[0];
		$o_id=$row['LAST_INSERT_ID'];
				
		$data=array('o_id'=>$o_id);
		if($o_type!=='k')
			$data['parent_o_id']=$parent_o_id;
		if($o_type==='s')
			$data['name']=$name;
		
		//also insert into child table
		$table_name='o_'.OrganismModel::$lookup[$o_type];
		$this->db->insert($table_name,$data);
	}
	public function update($o_id=1,$data){
		$row=$this->query($o_id);
		
		$list=array('p_id','author_dt');
		if($row['o_type']!=='s')
			array_push($list,'name');
		
		$update=array();
		foreach($data as $key=>$value){
			if(array_search($key,$list)===TRUE)
				$update[$key]=$value;
		}
		
		$this->db->where('o_id',$o_id);
		$this->db->update('organism',$update);
		
		//update the child table
		$list=array('parent_o_id');
		if($row['o_type']==='s')
			array_push($list,'name');
		
		$update=array();
		foreach($data as $key=>$value){
			if(array_search($key,$list)===TRUE)
				$update[$key]=$value;
		}
		
		$table_name='o_'.Organism::$lookup[$row['o_type']];
		$this->db->where('o_id',$o_id);
		$this->db->update($table_name,$update);
		
	}
	public function delete($o_id){
		$this->db->delete('organism',array('o_id'=>$o_id));
	}
	public function delete_batch($data){
		$data=array_filter(array_values($data),'is_int');
		$this->db->where_in('o_id',$data);
		$this->db->delete('organism');
	}
	public function query($o_id=1){
		return $this->basicQuery('o_id',$o_id);
	}
	public function query_name($name="animalia"){
		return $this->basicQuery('name',$name);
	}
	private function basicQuery($query_column,$query_value){
		$data=array($query_column=>$query_value);
		
		$query=$this->db->get_where('organism',$data);
		if($query->num_rows()===0)
			return NULL;
		$result=$query->result_array();
		$row=$result[0];
		
		$o_type=$row['o_type'];
		$data=array('o_id'=>$row['o_id']);
		$table_name='o_'.OrganismModel::$lookup[$o_type];
		
		$query=$this->db->get_where($table_name,$data);
		$result=$query->result_array();
		$row2=$result[0];
		
		return array_merge($row,$row2);
	}
	
	public function query_like($like,$page,$o_type,$parent_o_id){
		$max_items=4;
		
		if($like==NULL)$like='';//nonstrict equalitity
		$this->db->like('name',$like);
		if($parent_o_id!==NULL)$this->db->where('parent_o_id',$parent_o_id);
		$this->db->where('o_type',$o_type);
		$this->db->select('name,o_id');
		$query=$this->db->get('full_'.OrganismModel::$lookup[$o_type],$max_items,($page-1)*$max_items);
		
		$this->db->like('name',$like);
		if($parent_o_id!==NULL)$this->db->where('parent_o_id',$parent_o_id);
		$this->db->where('o_type',$o_type);
		$this->db->select('name,o_id');
		$query2=$this->db->get('full_'.OrganismModel::$lookup[$o_type]);
		//requery data with start page if querying from page>1 returns nothing
		if($page>1&&$query->num_rows()===0){
			$page=1;
			if($like==NULL)$like='';//nonstrict equalitity
			$this->db->like('name',$like);
			if($parent_o_id!==NULL)$this->db->where('parent_o_id',$parent_o_id);
			$this->db->where('o_type',$o_type);
			$this->db->select('name,o_id');
			$query=$this->db->get('full_'.OrganismModel::$lookup[$o_type],$max_items,($page-1)*$max_items);
		}
		else if($query->num_rows()===0)return NULL;
		
		$rows=$query2->num_rows();
		$pages=ceil($rows/$max_items);
		$current_page=$page;
		$return=array(
			'pages'=>$pages,
			'rows'=>$rows,
			'current_page'=>$page,
			'results'=>$query->result_array());
		return $return;
	}
	
	//this is 100times slower than a single query though still fast because of indexing
	public function query_up($o_id=1){
		$return=array();
	
		$row=$this->query($o_id);
		$return[$row['o_type']]=$row;
		
		while($row!==NULL&&isset($row['parent_o_id'])){
			$row=$this->query($row['parent_o_id']);
			$return[$row['o_type']]=$row;
		}
		return array_reverse($return);
	}
	
}

function valid_parent_o_id($parent_o_id=0,$o_type=''){
	$organismCtrlr=Organism::$singleton;
	$organismModel=OrganismModel::$singleton;
	
	$parent_organism=$organismModel->query($parent_o_id);
	
	$keys=array_keys(OrganismModel::$lookup);
	$key=array_search($o_type,$keys);
	
	return $parent_organism&&$key-1>0&&$parent_organism['o_type']==$keys[$key-1];
}
function valid_pseudo_date($date){
	return (
		DateTime::createFromFormat('MMMM yyyy',$date)||
		DateTime::createFromFormat('MMMM dd, yyyy',$date)||
		DateTime::createFromFormat('MMMM dd,yyyy',$date)||
		DateTime::createFromFormat('dd-MM-yyyy',$date)||
		DateTime::createFromFormat('yyyy',$date)||
		DateTime::createFromFormat('dd/MM/yyyy',$date))!=false?true:false;
}
function is_unique_species($name){
	$organismCtrlr=Organism::$singleton;
	$organismCtrlr;
	$organismModel=OrganismModel::$singleton;
	$organism=$organismModel->query_name($name);
	$parent_o_id=$organismCtrlr->input->post('parent_o_id');
	
	return $organism&&$organism['parent_o_id']===$parent_o_id;
}
function valid_o_type($o_type){
	return isset(OrganismModel::$lookup[$o_type]);
}




