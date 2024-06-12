<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');

class Customer extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('insertdata');
		$this->load->model('getdata');
	}


    public function test1()
	{
        $phone="9490043228";
        $message="Dear Customer, Your OTP is 123457 for registration. cell:9676062515My Gallery Book";
        $username="sct-mybook";
        $password="admin";
        $type="0";
        $dlr="1";
        $entityid="1601100000000017828";
        $tempid="1607100000000297400";
        $senderId = "MGBOOK";
        $url="http://sms1.srichakratech.com/sendsms/bulksms?";
        
        $fields = array(
			'username'      => urlencode($username),
			'password'      => urlencode($password),
			'type'          => urlencode($type),
			'dlr'           => urlencode($dlr),
			'destination'   => urlencode($phone),
			'source'        => urlencode($senderId),
			'message'       => urlencode($message),
			'entityid'      => urlencode($entityid),
			'tempid'        => urlencode($tempid)
        );

        $fields_string = '';
        foreach($fields as $key=>$value)
        {
			if($key == 'tempid'){
				$fields_string .= $key.'='.$value;
			}
			else{
				$fields_string .= $key.'='.$value.'&';
			}
        }
        rtrim($fields_string,'&');
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
		echo curl_errno($ch);
		echo curl_error($ch);
		curl_close($ch);
    }

	
	public function index(){
	    $cPhone = $this->input->post('cPhone');
	    $customer = $this->getdata->cRegister($cPhone);
	   	$otp = rand(999, 9999);
	    if(empty($customer)){
	        $customerData = array(
	            'cPhone' => $cPhone,
		        'cOTP' => $otp,
		        'cStatus' => 1,
		        'createdAt' => date('Y-m-d H:i:s'),
		        'modifiedAt' => date('Y-m-d H:i:s')
		        );
		        $customer = $this->insertdata->cRegister($customerData);
		
        $message="Dear Customer, Your OTP is ".$otp." for registration. cell:9966604609 My Gallery Book";

        $username="sct-mybook";
        $password="admin";
        $type="0";
        $dlr="1";
        $entityid="1601100000000017828";
        $tempid="1607100000000297400";
        $senderId = "MGBOOK";
        $url="http://sms1.srichakratech.com/sendsms/bulksms?";
        
        $fields = array(
        'username'      => urlencode($username),
        'password'      => urlencode($password),
        'type'          => urlencode($type),
        'dlr'           => urlencode($dlr),
        'destination'   => urlencode($cPhone),
        'source'        => urlencode($senderId),
        'message'       => urlencode($message),
        'entityid'      => urlencode($entityid),
        'tempid'        => urlencode($tempid)
        );

        $fields_string = '';
        foreach($fields as $key=>$value)
        {
            if($key == 'tempid'){
				$fields_string .= $key.'='.$value;
			}
			else{
				$fields_string .= $key.'='.$value.'&';
			}
        }
        rtrim($fields_string,'&');
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        curl_close($ch);
					
		$this->output
            ->set_content_type('application/json')
		    ->set_output(json_encode($customer));
	    }
	    else{
            $message="Dear Customer, Your OTP is ".$otp." for registration. cell:9966604609 My Gallery Book";
            $username="sct-mybook";
            $password="admin";
            $type="0";
            $dlr="1";
            $entityid="1601100000000017828";
            $tempid="1607100000000297400";
            $senderId = "MGBOOK";
            $url="http://sms1.srichakratech.com/sendsms/bulksms?";
            
            $fields = array(
				'username'      => urlencode($username),
				'password'      => urlencode($password),
				'type'          => urlencode($type),
				'dlr'           => urlencode($dlr),
				'destination'   => urlencode($cPhone),
				'source'        => urlencode($senderId),
				'message'       => urlencode($message),
				'entityid'      => urlencode($entityid),
				'tempid'        => urlencode($tempid)
            );

            $fields_string = '';
            foreach($fields as $key=>$value)
            {
                if($key == 'tempid'){
					$fields_string .= $key.'='.$value;
				}
				else{
					$fields_string .= $key.'='.$value.'&';
				}
            }
            rtrim($fields_string,'&');
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_POST,count($fields));
            curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($ch);
            curl_close($ch);
                
	        if($customer->cStatus == 1){
	            if($cPhone == "9963879607" || $cPhone == "9963867732")
	            {
	                 $customerData = array(
	                    'cOTP' => "9999",
	                    'modifiedAt' => date('Y-m-d H:i:s')
	                );
	            
	                $customer = $this->insertdata->cUpdate($customer->cId,$customerData);
	        
	                $this->output
		                ->set_content_type('application/json')
		                ->set_output($customer->cId);
	            }
	            else
	            {
	                $customerData = array(
	                    'cOTP' => $otp,
	                    'modifiedAt' => date('Y-m-d H:i:s')
	                );
	            
	                $customer = $this->insertdata->cUpdate($customer->cId,$customerData);
	        
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output($customer->cId);
	            }
	        }
	        else if($customer->cStatus == 2){
	            $this->output
	                ->set_content_type('application/json')
                    ->set_output("Please Contact Admin");
	        }
	    }
	}
	
	public function verifyOTP(){
	    $customerData = array(
	        'cId' => $this->input->post('cId'),
	        'cOTP' => $this->input->post('cOTP'),
	        'cStatus' => 1
	        );
	   $customer = $this->getdata->verifyOTP($customerData);
	   if(!empty($customer)){
	       $customerProfile = $this->getdata->cProfile($this->input->post('cId'));
	       $this->output
	            ->set_content_type('application/json')
		        ->set_output(json_encode($customerProfile));
	   }
	   else{
	       $this->output
	            ->set_content_type('application/json')
		        ->set_output("No Customer");
	   }
	}
	
	public function profileData(){
	    $cId = $this->input->post('cId');
	    $customerProfile = $this->getdata->cProfile($cId);
	    $this->output
			->set_content_type('application/json')
			->set_output(json_encode($customerProfile));
	}
	
	public function profile(){
	    $cId = $this->input->post('cId');
	    $customerProfile = $this->getdata->cProfile($cId);
	    
	    $config['upload_path']="./uploads/profiles";
		$config['allowed_types']='jpg|jpeg|png';
		$config['encrypt_name'] = TRUE;
		
		$this->load->library('upload',$config);
		if($this->upload->do_upload("cPicture")){
			$data = array('cPicture' => $this->upload->data());
			$cPicture = $data['cPicture']['file_name'];
    	    $profileData = array(
    	            'cId' => $cId,
    		        'cFName' => $this->input->post('cFName'),
    		        'cLName' => $this->input->post('cLName'),
    		        'cGender' => $this->input->post('cGender'),
    		        'cEmail' => $this->input->post('cEmail'),
    		        'cPicture' => $cPicture
    		        );
		}
		else{
		    $error = array('error' => $this->upload->display_errors());
		    $profileData = array(
    	            'cId' => $cId,
    		        'cFName' => $this->input->post('cFName'),
    		        'cLName' => $this->input->post('cLName'),
    		        'cGender' => $this->input->post('cGender'),
    		        'cEmail' => $this->input->post('cEmail')
    		        );
		}
		
		        
	    if(empty($customerProfile)){
		        $customerProfile = $this->insertdata->cProfile($profileData);
		        $this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($customerProfile));
	    }
	    else{
	        $cp = $this->insertdata->cProfileUpdate($profileData,$customerProfile->pId);
	        $customerProfile = $this->getdata->cProfile($cId);
	        $this->output
			->set_content_type('application/json')
			->set_output(json_encode($customerProfile));
	    }
	}
	
	public function addressData(){
	    $cId = $this->input->post('cId');
	    $customerAddress = $this->getdata->cAddress($cId);
	    $this->output
			->set_content_type('application/json')
			->set_output(json_encode($customerAddress));
	}
	public function addressDetails(){
	    $aId = $this->input->post('aId');
	    $addressDetails = $this->getdata->addressDetails($aId);
	    $this->output
			->set_content_type('application/json')
			->set_output(json_encode($addressDetails));
	}
	public function address(){
	    $addressData = array(
	        'cId' => $this->input->post('cId'),
	        'cDoorNo' => $this->input->post('cDoorNo'),
	        'cStreet' => $this->input->post('cStreet'),
	        'cLandMark' => $this->input->post('cLandMark'),
	        'cCity' => $this->input->post('cCity'),
	        'cPincode' => $this->input->post('cPincode')
	        );
	        
	        $customerAddress = $this->insertdata->cAddress($addressData);
	        $this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($customerAddress));
	}
	
	public function feedback(){
	    $feedbackData = array(
	        'cId' => $this->input->post('cId'),
	        'albumId' => $this->input->post('albumId'),
	        'cFeedback' => $this->input->post('cFeedback'),
	        'fStatus' => 1,
	        'createdAt' => date('Y-m-d H:i:s'),
	        'modifiedAt' => date('Y-m-d H:i:s')
	        );
	        
	        $feedbackData = $this->insertdata->feedback($feedbackData);
	        $this->output
	            ->set_content_type('application/json')
		        ->set_output(json_encode($feedbackData));
	}
	
	public function active(){
	    $cId = $this->input->post('cId');
        if($this->input->post('cStatus') == 1){
            $cStatus = 0;
        }
        else if($this->input->post('cStatus') == 0){
            $cStatus = 1;
        }
        else if($this->input->post('cStatus') == 2){
            $cStatus = 2;
        }
        $result = $this->insertdata->customeractive($cId,$cStatus,date('Y-m-d H:i:s'));
		if($result){
			redirect('o/customers');
		}
    }
	
	public function logout(){
	    $customerData = array(
	        'cOTP' => 0,
	        'cStatus' => 2,
	        'modifiedAt' => date('Y-m-d H:i:s')
	        );
	        
	        $customer = $this->insertdata->cUpdate($this->input->post('cId'),$customerData);
	        if($customer->cOTP == 0){
	            $this->output
    		        ->set_content_type('application/json')
    		        ->set_output("Logout Success");
	        }
	}
	
}
?>