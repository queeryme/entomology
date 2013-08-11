<?php

class MY_Column{
	private $name;//final
	private $type;
	private $length;//may be an array if decimal
	private $format;
	private $nullable;
	
	public function __construct(
			$name='c1',				//column name
			$type='INT',			//column data type (sql datatype)
			$length=11,				//may be an array: [total_length,decimal_length]
			$nullable=TRUE,
			$format='####'){	//format to be used when displaying values in HTML
			
		$this->name=$name;
		$this->type=$type;
		$this->length=$length;
		$this->nullable=$nullable;
		$this->format=$format;
	}
	public function getName(){
		return $this->name;
	}
	public function setName($name){
		$this->name=$name;
	}
	public function getType(){
		return $this->name;
	}
	public function setType($type){
		$this->type=$type;
	}
	public function getLength(){
		return $this->length;
	}
	public function setLength($length){
		$this->length=$length;
	}
	public function getNullable($nullable){
		return $this->nullable;
	}
	public function setNullable($nullable){
		$this->nullable=$nullable;
	}
	
}

class MY_Table extends CI_Model{
	private $tableName=NULL;
	private $columns=array();
	
	public function __construct($tableName='test'){
		if(!preg_match_all("/^[a-z|$|_]{1,}$/i",$tableName))
			throw new MY_Exception(1110);
		
		$this->tableName=$tableName;
		
		$this->load->database();	
	}
	
	public function insert($params=NULL){
		$this->_doBeforeInsert();	
		
		$sql="insert into ".$this->table_name;
		
		$this->db->query();
		$this->_doAfterInsert();
	}
	
	protected function getColumn($index){
		return $this->columns[$index];
	}
	
	public final function addColumn(MY_Column $columnName){
		$this->columns[$column->getName()]=$columnName;
	}
	
	public final function removeColumn($columnName){
		unset($this->columns[$column->getName()]);
	}
	
	private function getWhere(){
		return 'where ';
	}
	
	protected function _doBeforeUpdate(){}
	protected function _doBeforeInsert(){}
	protected function _doBeforeDelete(){}
	protected function _doBeforeQuery(){}
	protected function _doAfterUpdate(){}
	protected function _doAfterInsert(){}
	protected function _doAfterDelete(){}
	protected function _doAfterQuery(){}
}