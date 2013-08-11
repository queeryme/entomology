<?php ;
class Organism extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		session_start();
		$this->load->model('organismModel','organism');
		$this->load->model('personModel','person');
	}
	
	private function index(){
		$data=array();
		
		if(!isset($_SESSION['user'])){
			$this->_guestView();
			return;
		}
		
		/**********USER VIEW***********/
		$user=$_SESSION['user'];
		
		$data=array('user'=>$user);
		$this->load->view('templates/header',$data);
		$this->load->view('user',array('user'=>$user));
		$this->load->view('menu');
		$data=$this->person->query_like();
		$this->load->view('taxon',array('persons'=>$data));
	}
	
	public function _guestView(){
		$this->load->view('templates/header');
		$this->load->view('login');
		$this->load->view('menu');
	}
	
	public function query_name($name){
		$this->index();
		
		$row=$this->organism->query_name($name);
		//if the data wasn't found
		if($row==NULL){
			show_404();
			return;
		}
		$this->load->view('breadcrumb',$this->organism->query_up($row['o_id']));
		
		
	}
	
	public function query_species($genus,$species){
		
	}
	public function query_id($id){
		$this->index();
		$row=$this->organism->query($id);
		if($row==NULL){
			show_404();
			return;
		}
		$this->load->view('breadcrumb',$this->organism->query_up($row['o_id']));
	}
	
}