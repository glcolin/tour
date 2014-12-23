<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Colin - 12/21/2014
*/
class homemodel extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	/**
	* 返回一个category列表:
	*/
	public function getCategories(){
		$query = $this->db->query("
					SELECT * 
					FROM category
					");
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return FALSE;
		}
	}

}