<?php
class Login extends CI_Controller{
	private $max_attempts=3;
	private $wait_time=180;//seconds
	public function __construct(){
		parent::__construct();
		session_start();
	}
	public function index(){
		if($this->_validate()===false)
			return;
			
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		
		$this->load->model('User');
		
		if(!isset($_SESSION['attempts']))
			$_SESSION['attempts']=0;
		if(!isset($_SESSION['last_attempt']))
			$_SESSION['last_attempt']=0;
			
		$attempts=$_SESSION['attempts'];
		$last_attempt=$_SESSION['last_attempt'];
		
		if($attempts===$this->max_attempts){
			$attempt_secs=$_SERVER['REQUEST_TIME']-$last_attempt;
			if($attempt_secs<$this->wait_time){
				$error=array(
					'code'=>1000,
					'data'=>array(
						'max_attempts'=>$this->max_attempts,
						'actual_wait_time'=>$this->wait_time-$attempt_secs
					)
				);
				$this->load->view('ajax/error',$error);
				return;
			}
			else{
				$_SESSION['attempts']=$attempts=0;
				$_SESSION['last_attempt']=$last_attempt=0;
			}
		}
		
		$array=$this->User->query($username,$password);
		if($array===NULL){
			$data=array(
				'code'=>1500,
				'data'=>NULL
			);
			$this->load->view('ajax/error',$data);
			$_SESSION['attempts']++;
			$_SESSION['last_attempt']=time();
			return;
		}
		
		echo json_encode($array);//no need for view, ajax call
		
		$_SESSION['attempts']=0;
		$_SESSION['last_attempt']=0;
		$_SESSION['user']=$array;
		session_commit();
	}
	private function _validate(){
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$config=array(
			array(
				'field'=>'username',
				'label'=>'username',
				'rules'=>'required|min_length[6]|max_length[12]|alpha_numeric'
			),
			array(
				'field'=>'password',
				'label'=>'password',
				'rules'=>'required|min_length[6]|max_length[12]|alpha_numeric'
			)
		);
		$this->form_validation->set_rules($config);
		$is_valid=$this->form_validation->run();
		if($is_valid===false){
			$data=array('username','password');
			$data2=array();
			foreach($data as $key=>$value){
				$form_error=form_error($key);
				if($form_error==false||$form_error=='');
				else $data2[$key]=$form_error;
			}
			$error=array(
				'code'=>500,
				'data'=>$data2
			);
			$this->load->view('ajax/error',$error);
			return false;
		}
		return true;
	}
}