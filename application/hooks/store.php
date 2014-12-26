<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Colin - 12/21/2014
*/
class Store extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		//Super Global Variables:
		$GLOBALS['store_id'] = 0;
		$GLOBALS['store_name'] = '';
		//Load:
		$this->load->model('storemodel');
		
	}
	
	public function index(){
		//Get domain string:
		$domain = $_SERVER['HTTP_HOST'];
		//Treat x.com as www.x.com
		if(count(explode('.',$domain)) == 2){
			$domain = 'www.'.$domain;
		}
		//Set store id:
		$GLOBALS['store_id'] = $this->storemodel->getStoreId($domain);
		//Filter:
		if($GLOBALS['store_id'] == 0){
			redirect('404.php');
		}
		$GLOBALS['store_name'] = $this->storemodel->getStoreName($GLOBALS['store_id']);

	}
	
}

