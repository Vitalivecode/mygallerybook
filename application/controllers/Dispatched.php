<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');

class Dispatched extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('insertdata');
		$this->load->model('getdata');
	}

	public function index($page = 'dispatche'){
	    
	    if(!$this->session->userdata('sessiondispatche')){
                redirect('l/');
        }
        
		if(! file_exists('application/views/'.$page.'.php')) {
			show_404();
		}
		
		$data['title'] = "My Gallerybook";
		$data["myOrdersData"] = $this->getdata->allOrders("3");
		
		if($albumId = $this->input->post('albumId')){
		    $data["albumId"] = $albumId;
    	    $data["oStatus"] = $this->input->post('oStatus');
    	    $data["cPhone"] = $this->input->post('cPhone');
	    }
	    
		$this->load->view('topHeader');
		$this->load->view('header');
		$this->load->view('asideD');
		$this->load->view($page,$data);
		$this->load->view('footer');
		$this->load->view('bottomFooter');
	}
	
}
?>