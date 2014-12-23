<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Colin - 12/21/2014
*/
class categorymodel extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	/**
	* 返回分类名字:
	*/
	public function getCategoryName($categoryId){
		$query = $this->db->query("
					SELECT *
					FROM category
					WHERE CategoryId = ".$this->db->escape($categoryId)."
					");
		return $query->row()->CategoryName;
	}
	
	/**
	* 返回一个route列表:
	*/
	public function getRoutes($categoryId){
		$query = $this->db->query("
					SELECT *
					FROM
						(SELECT * 
							FROM route
							WHERE CategoryId = ".$this->db->escape($categoryId)."
						) AS A
					JOIN 
						(SELECT RouteID, GROUP_CONCAT(City) AS Departures
							FROM route_departure 
							GROUP BY RouteId
						) AS B
					JOIN
						(SELECT RouteID, GROUP_CONCAT(City) AS Destinations
							FROM route_destination
							GROUP BY RouteId
						) AS C
					ON 
						A.RouteId = B.RouteId 	
						AND A.RouteId = C.RouteId
					");
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return FALSE;
		}
	}

}