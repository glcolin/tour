<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Colin - 12/21/2014
*/
class routemodel extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	/**
	* 提取路线信息:
	*/
	public function getRouteInfo($routeId){
		$query = $this->db->query("
					SELECT *
					FROM
						(SELECT *
							FROM route
							WHERE RouteId = '".$routeId."'
						) AS A
					LEFT JOIN
						category AS B
					ON A.CategoryId = B.CategoryId
					");
		return $query->row();
	}
	
	/**
	* 提取路线出发地:
	*/
	public function getDepartures($routeId){
		$query = $this->db->query("
					SELECT GROUP_CONCAT(City) AS Departures
					FROM route_departure
					WHERE RouteId = '".$routeId."'
					");
		return $query->row()->Departures;
	}
	
	/**
	* 提取路线目的地:
	*/
	public function getDestinations($routeId){
		$query = $this->db->query("
					SELECT GROUP_CONCAT(City) AS Destinations
					FROM route_destination
					WHERE RouteId = '".$routeId."'
					");
		return $query->row()->Destinations;
	}
	
	/**
	* 提取开始日期:
	*/
	public function getStartDate($routeId){
		$query = $this->db->query("
					SELECT MIN(StartDate) AS StartDate
					FROM route_schedule
					WHERE RouteId = '".$routeId."'
					");
		return $query->row()->StartDate;
	}
	
	/**
	* 提取结束日期:
	*/
	public function getEndDate($routeId){
		$query = $this->db->query("
					SELECT MAX(EndDate) AS EndDate
					FROM route_schedule
					WHERE RouteId = '".$routeId."'
					");
		return $query->row()->EndDate;
	}
	
	/**
	* 提取一周日期:
	*/
	public function getWeekdays($routeId){
		$query = $this->db->query("
					SELECT Days
					FROM route_schedule_day
					WHERE RouteId = '".$routeId."'
					");
		return $query->row()->Days;
	}

}