<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');

class Received extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('insertdata');
		$this->load->model('getdata');
	}

	public function index($page = 'received'){
	    
	    if(!$this->session->userdata('sessionreceived')){
                redirect('l/');
        }
        
		if(! file_exists('application/views/'.$page.'.php')) {
			show_404();
		}
		
		$data['title'] = "My Gallerybook";
		
		$data["myOrdersData"] = $this->getdata->allOrders("1");
	    
		$this->load->view('topHeader');
		$this->load->view('header');
		$this->load->view('asideR');
		$this->load->view($page,$data);
		$this->load->view('footer');
		$this->load->view('bottomFooter');
	}
	
}
?>