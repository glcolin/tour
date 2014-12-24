<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Colin - 12/21/2014
*/
class Category extends CI_Controller {
	
	//Initialize data:
	private $data = array();
	
	public function __construct(){
		parent::__construct();
		//Loads:
		$this->load->model('categorymodel');
		$this->load->helper('datetime');
	}
	
	public function index(){	
		//Set common variables:
		$this->data['title'] = 'Category';		
		//Validate:
		if(($categoryId = $this->uri->segment(2)) == FALSE){
			redirect('404');
			exit(1);
		}
		//Retrieve category name:
		$this->data['categoryName'] = $this->categorymodel->getCategoryName($categoryId);
		//Retrieve routes:
		$this->data['routes'] = $this->categorymodel->getRoutes($categoryId);
		//Load view:
		$this->load->view('common/header',$this->data);
		$this->load->view('category',$this->data);
		$this->load->view('common/footer',$this->data);
		
	}
	
}

