<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');

class Template extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('insertdata');
		$this->load->model('getdata');
	}
	
	public function tAdd(){
	    
	    $config['upload_path']="./uploads/templates";
		$config['allowed_types']='jpg|jpeg|png';
		$config['encrypt_name'] = TRUE;
// 		$config['max_size'] = 1024;
//      $config['max_width'] = 1200;
//      $config['max_height'] = 900;
		$this->load->library('upload',$config);
		if($this->upload->do_upload("tImage")){
			$data = array('tImage' => $this->upload->data());
		}
		else{
		    $error = array('error' => $this->upload->display_errors());
		    echo json_encode($error);
		}
		$tImage = $data['tImage']['file_name'];
		
		$templateData = array(
		    'tImage' => $tImage,
	        'tURL' => $this->input->post('tURL'),
	        'tStatus' => 1
	        );
	        
	        $templates = $this->insertdata->tAdd($templateData);
		        $this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($templates));
	}
	
	public function tEdit(){
	    
	    $config['upload_path']="./uploads/templates";
		$config['allowed_types']='jpg|jpeg|png';
		$config['encrypt_name'] = TRUE;
// 		$config['max_size'] = 1024;
//      $config['max_width'] = 1200;
//      $config['max_height'] = 900;
		$this->load->library('upload',$config);
		if($this->upload->do_upload("tImage")){
			$data = array('tImage' => $this->upload->data());
			$tImage = $data['tImage']['file_name'];
		
    		$templateData = array(
    		    'tImage' => $tImage,
    	        'tURL' => $this->input->post('tURL')
    	        );
		}
		else{
		    $error = array('error' => $this->upload->display_errors());
		    $templateData = array(
    	        'tURL' => $this->input->post('tURL')
    	       );
		}
		
	        
	        $templates = $this->insertdata->tEdit($templateData,$this->input->post('tId'));
		        $this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($templates));
	}
	
	public function active(){
	    $tId = $this->input->post('tId');
        if($this->input->post('tStatus') == 1){
            $tStatus = 0;
        }
        else if($this->input->post('tStatus') == 0){
            $tStatus = 1;
        }
        else if($this->input->post('tStatus') == 2){
            $tStatus = 2;
        }
        $result = $this->insertdata->templateactive($tId,$tStatus);
		if($result){
			redirect('o/templates');
		}
    }
	
}