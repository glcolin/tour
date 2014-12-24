<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Colin - 12/21/2014
*/
class categorymodel extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	/**
	* è¿”å›žåˆ†ç±»å��å­—:
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
	* è¿”å›žä¸€ä¸ªrouteåˆ—è¡¨:
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
					ON
						A.RouteId = B.RouteId
					JOIN
						(SELECT RouteID, GROUP_CONCAT(City) AS Destinations
							FROM route_destination
							GROUP BY RouteId
						) AS C
					ON 
						A.RouteId = C.RouteId
					JOIN 
						(SELECT RouteId, MIN(StartDate) AS MinDate, MAX(EndDate) AS MaxDate
							FROM route_schedule
							GROUP BY RouteId
						) AS D
					ON
						A.RouteId = D.RouteId
					LEFT JOIN 	
						route_schedule_day AS E
					ON 
						A.RouteId = E.RouteId
					");
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return FALSE;
		}
	}

}