<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Colin - 12/26/2014
*/
class storemodel extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	/**
	* return store_id:
	*/
	public function getStoreId($domain){
		$query = $this->db->query("
					SELECT * 
					FROM store
					WHERE Domain = '".$domain."'
					");
		if ($query->num_rows() > 0){
			return $query->row()->StoreId;
		}else{
			return 0;
		}
	}
	
	public function getStoreName($storeId){
		$query = $this->db->query("
					SELECT Name 
					FROM store
					WHERE StoreId = '".$storeId."'
					");
		if ($query->num_rows() > 0){
			return $query->row()->Name;
		}else{
			return FALSE;
		}
	}

}