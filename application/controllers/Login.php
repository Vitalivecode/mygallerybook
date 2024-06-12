<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('insertdata');
		$this->load->model('getdata');
	}

	public function index($page = 'login'){
		if(! file_exists('application/views/'.$page.'.php')) {
			show_404();
		}
		$this->load->view($page);
	}
	
	public function login(){

		$formdata = array(
			'ownerId' => $this->input->post('ownerId'),
			'passWord' => $this->input->post('passWord'),
			'status' => 1
		);
	
		$result = $this->getdata->login($formdata);
		
		if($result->role == 'Owner')
		    $this->session->set_userdata('sessionowner',$result);
        else if($result->role == 'Received')
            $this->session->set_userdata('sessionreceived',$result);
        else if($result->role == 'Printed')
            $this->session->set_userdata('sessionprinted',$result);
        else if($result->role == 'Dispatched')
            $this->session->set_userdata('sessiondispatche',$result);
        else if($result->role == 'Delivered')
            $this->session->set_userdata('sessiondelivered',$result);
            
		if($result){
			$response_array['role'] = $result->role;
			$response_array['status'] = '200';
		}
		else {
		    $response_array['role'] = 'null';
			$response_array['status'] = '500';
		}
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response_array));
	}
	
	public function logout(){
        $this->session->unset_userdata('sessionowner');
        $this->session->unset_userdata('sessionreceived');
        $this->session->unset_userdata('sessionprinted');
        $this->session->unset_userdata('sessiondispatche');
        $this->session->unset_userdata('sessiondelivered');
        redirect('l/');
    }
	
}
?>