<?php
class Organism extends CI_Controller{
	public static $singleton;
	
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('organismModel','organism');
		$this->load->model('personModel','person');
		Organism::$singleton=$this;
	}
	public function index(){
		$filter=$this->input->post('filter');
		$page=$this->input->post('page');
		$parent_o_id=NULL;
		if($this->input->post('parent_o_id'))
			$parent_o_id=$this->input->post('parent_o_id');
		$o_type=$this->input->post('o_type');
			
		if($filter===''||$filter==NULL)$filter=NULL;
		if($parent_o_id==NULL)$parent_o_id=NULL;
		if($page==0)$page=1;
		
		echo json_encode($this->organism->query_like($filter,$page,$o_type,$parent_o_id));
	}
	public function insertWithNewPerson(){
		if($this->_validateInsertWithNewPerson()==false)
			return;
		
		$p_id=$this->_insertPerson();
		$o_type=$this->input->post('o_type');
		$parent_o_id=$this->input->post('parent_o_id');
		$author_dt=$this->input->post('author_dt');
		$name=$this->input->post('name');
		$parent_organism=$this->organism->query('parent_o_id');
		
		$this->organism->insert($o_type,$p_id,$author_dt,$name,$parent_o_id);
	}
	private function _validateInsertWithNewPerson(){
	
		$this->form_validation->set_rules('o_type','o_type','required|valid_o_type');
		$this->form_validation->set_rules('author_dt','author_dt','valid_pseudo_date');
		
		//this will still work since we are not directly using o_type as an input
		$o_type=$this->input->post('o_type');
		
		if($o_type=='k');//ignore parent_o_id if it's a kingdom
		else{
			//this is a possible security breach for XSS attack.
			//we manage o_type so that an invalid one will be neutralized
			
			if(isset(OrganismModel::$lookup[$o_type])==false)
				$o_type='';
			
			$this->form_validation->set_rules('parent_o_id',
				'parent_o_id','integer|required|valid_parent_o_id['.$o_type.']');
			
		}
			
		if($o_type=='s') 
			$this->form_validation->set_rules('name','name',
				'required|alpha|is_unique[organism.name]|is_unique_species');
		else 
			$this->form_validation->set_rules('name','name',
				'required|alpha|is_unique[organism.name]|is_unique[o_species.name]');
		
		$is_valid=$this->form_validation->run();
		
		if($is_valid==false){
			$data=array(
				'o_type'=>form_error('o_type'),
				'parent_o_id'=>form_error('parent_o_id'),
				'author_dt'=>form_error('author_dt'),
				'parent_o_id'=>form_error('parent_o_id'),
				'name'=>form_error('name')
			);
			$this->load->view('ajax/error',array('code'=>1501,'data'=>$data));
			return false;
		}
		return true;
	}
	private function _validateInsert(){
		$this->form_validation->set_rules('o_type','o_type','required|valid_o_type');
		$this->form_validation->set_rules('author_dt','author_dt','valid_pseudo_date');
	
		$o_type=$this->input->post('o_type');
		
		if($o_type=='k');//ignore parent_o_id if it's a kingdom
		else{
			//this is a possible security breach for XSS attack.
			//we manage o_type so that an invalid one will be neutralized
			if(isset(OrganismModel::$lookup[$o_type])==false)
				$o_type='';
			
			//this essentialy calls a callback just to enable the second parameter
			//crappy but this is how codeIgniter works
			$this->form_validation->set_rules('parent_o_id',
				'parent_o_id','integer|required|callback__valid_parent_o_id['.$o_type.']');
		}
		
		if($o_type=='s') 
			$this->form_validation->set_rules('name','name',
				'required|alpha|is_unique[organism.name]|is_unique_species');
		else 
			$this->form_validation->set_rules('name','name',
				'required|alpha|is_unique[organism.name]|is_unique[o_species.name]');
		
		$is_valid=$this->form_validation->run();
		
		if($is_valid==false){
			$data=array(
				'o_type'=>form_error('o_type'),
				'parent_o_id'=>form_error('parent_o_id'),
				'author_dt'=>form_error('author_dt'),
				'parent_o_id'=>form_error('parent_o_id'),
				'name'=>form_error('name')
			);
			$this->load->view('ajax/error',array('code'=>1501,'data'=>$data));
			return false;
		}
		return true;
	}
	
	//turns this into a private method to clientsyet public to the system
	private function _valid_parent_o_id($parent_o_id,$o_type){
		if(valid_parent_o_id($parent_o_id,$o_type)==false){
			return false;
		}
		return true;
	}
	public function insert(){
		if($this->_validateInsert()==false)
					return;
		$o_type=$this->input->post('o_type');
		$parent_o_id=$this->input->post('parent_o_id');
		$p_id=$this->input->post('p_id');
		$author_dt=$this->input->post('author_dt');
		$name=$this->input->post('name');
		$person=NULL;
		
		//we don't validate P_ID well. just ignore it if invalid
		
		//if there is a P_ID, check if that P_ID exist
		$person=$this->person->query($p_id);
		if($person===NULL)$p_id=NULL;
			$p_id=NULL;
		$this->organism->insert($o_type,$p_id,$author_dt,$name,$parent_o_id);
		
	}
	private function _insertPerson(){
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		$address=$this->input->post('address');
		$contact=$this->input->post('contact');
		$p_id=$this->person->insert($first_name,$last_name,$address,$contact);
		return $p_id;
	}
}















