<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Colin - 12/21/2014
*/
class Home extends CI_Controller {
	
	//Initialize data:
	private $data = array();
	
	public function __construct(){
		parent::__construct();
		//Loads:
		$this->load->model('homemodel');
	}
	
	public function index(){	
		//Set common variables:
		$this->data['title'] = 'Home Page';
		//Get categories:
		$this->data['categories'] = $this->homemodel->getCategories();
		//Load view:
		$this->load->view('common/header',$this->data);
		$this->load->view('home',$this->data);
		$this->load->view('common/footer',$this->data);
		
	}
	
}

