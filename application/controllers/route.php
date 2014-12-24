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
		//Retrieve route info:
		$this->data['route'] = $this->routemodel->getRouteInfo($routeId);
		$this->data['departures'] = $this->routemodel->getDepartures($routeId);
		$this->data['destinations'] = $this->routemodel->getDestinations($routeId);
		$this->data['start'] = $this->routemodel->getStartDate($routeId);
		$this->data['end'] = $this->routemodel->getEndDate($routeId);
		$this->data['weekdays'] = $this->routemodel->getWeekdays($routeId);
		//Load view:
		$this->load->view('common/header',$this->data);
		$this->load->view('route',$this->data);
		$this->load->view('common/footer',$this->data);
		
	}
	
}

