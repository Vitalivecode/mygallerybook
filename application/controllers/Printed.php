<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');

class Printed extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('insertdata');
		$this->load->model('getdata');
	}

	public function index($page = 'printed'){
	    
	    if(!$this->session->userdata('sessionprinted')){
                redirect('l/');
        }
        
		if(! file_exists('application/views/'.$page.'.php')) {
			show_404();
		}
		
		$data['title'] = "My Gallery Book";
		$data["myOrdersData"] = $this->getdata->allOrders("2");
	    
		$this->load->view('topHeader');
		$this->load->view('header');
		$this->load->view('asideP');
		$this->load->view($page,$data);
		$this->load->view('footer');
		$this->load->view('bottomFooter');
	}
	
}
?>