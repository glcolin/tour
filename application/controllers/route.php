<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Colin - 12/21/2014
*/
class Route extends CI_Controller {
	
	//Initialize data:
	private $data = array();
	
	public function __construct(){
		parent::__construct();
		//Loads:
		$this->load->model('routemodel');
		$this->load->helper('datetime');
	}
	
	public function index(){	
		//Set common variables:
		$this->data['title'] = 'Route';		
		//Validate:
		if(($routeId = $this->uri->segment(2)) == FALSE){
			redirect('404');
			exit(1);
		}
		//Check if it is in store:
		if(!$this->routemodel->isInStore($routeId)){
			redirect('404');
			exit(1);
		}
		//Retrieve route info:
		$this->data['route'] = $this->routemodel->getRouteInfo($routeId);
		$this->data['departures'] = $this->routemodel->getDepartures($routeId);
		$this->data['destinations'] = $this->routemodel->getDestinations($routeId);
		$this->data['start'] = $this->routemodel->getStartDate($routeId);
		$this->data['end'] = $this->routemodel->getEndDate($routeId);
		$this->data['weekdays'] = $this->routemodel->getWeekdays($routeId);
		$this->data['schedule'] = $this->routemodel->getSchedule($routeId);
		$this->data['departure_date'] = $this->getDepartureDate($this->data);
		$room_info = $this->routemodel->getRooms($routeId);
		$rooms_price = array();
		if($room_info){
			foreach($room_info as $value){
				$rooms_price[$value->RoomNumber] = $value->Price;
			}
		}
		$this->data['rooms_price'] = $rooms_price;
		
		//Load view:
		$this->load->view('common/header',$this->data);
		$this->load->view('route',$this->data);
		$this->load->view('common/footer',$this->data);
		
	}
	
	public function getDepartureDate($data){
		$weekdays = $data['weekdays'];
		$schedule = $data['schedule'];
		
		$result = array();
		
		$weekdays_arr = array();
		if($weekdays){
			$weekdays_arr = explode(',',$weekdays);
		}
		
		foreach($schedule as $value){
			$inner_dates = array();
			if($value->EndDate){
				$inner_dates = range(date('Ymd',strtotime($value->StartDate)),date('Ymd',strtotime($value->EndDate)));
			}
			else{
				$result[] = date('Ymd',strtotime($value->StartDate));
			}

			foreach($inner_dates as $inner_date){
				$inner_date = strval($inner_date);
				if($weekdays_arr){
					$week = idate('w',strtotime($inner_date));
					if(in_array($week,$weekdays_arr)){
						$result[] = $inner_date;
					}
				}
				else{
					$result[] = $inner_date;
				}
			}
		}
		
		return $result;
	}
	
}

