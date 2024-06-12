<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');

class Owner extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('insertdata');
		$this->load->model('getdata');
	}

	public function index($page = 'owner'){
	    
	    if(!$this->session->userdata('sessionowner')){
                redirect('l/');
        }
        
		if(! file_exists('application/views/'.$page.'.php')) {
			show_404();
		}
		
		$data['title'] = "My Gallerybook";
		
		
		if($page == "owner"){
		    $result = $this->getdata->dashboard("All","All");
		    $data['allOrders'] = count($result);
		    $result1 = $this->getdata->dashboard("1","All");
		    $data['ordered'] = count($result1);
		    $result2 = $this->getdata->dashboard("2","All");
		    $data['received'] = count($result2);
		    $result3 = $this->getdata->dashboard("3","All");
		    $data['printed'] = count($result3);
		    $result4 = $this->getdata->dashboard("4","All");
		    $data['dispatched'] = count($result4);
		    $result5 = $this->getdata->dashboard("5","All");
		    $data['delivered'] = count($result5);
		    
		    $res = $this->getdata->dashboard("All",date('d-m-Y'));
		    $data['TallOrders'] = count($res);
		    $res1 = $this->getdata->dashboard("1",date('d-m-Y'));
		    $data['Tordered'] = count($res1);
		    $res2 = $this->getdata->dashboard("2",date('d-m-Y'));
		    $data['Treceived'] = count($res2);
		    $res3 = $this->getdata->dashboard("3",date('d-m-Y'));
		    $data['Tprinted'] = count($res3);
		    $res4 = $this->getdata->dashboard("4",date('d-m-Y'));
		    $data['Tdispatched'] = count($res4);
		    $res5 = $this->getdata->dashboard("5",date('d-m-Y'));
		    $data['Tdelivered'] = count($res5);
		    
		    $r4 = $this->getdata->dashboardS("4");
		    $data['free'] = count($r4);
		    $r1 = $this->getdata->dashboardS("1");
		    $data['basic'] = count($r1);
		    $r2 = $this->getdata->dashboardS("2");
		    $data['standard'] = count($r2);
		    $r3 = $this->getdata->dashboardS("3");
		    $data['premium'] = count($r3);
		    
		  //  $subscription = $this->getdata->subscription("All");
		  //  $amount = 0;
		  //  foreach($subscription as $row){
		  //      if($row->sId == "1")
		  //          $amount = $amount+(count($r1)*$row->sCost);
		  //      if($row->sId == "2")
		  //          $amount = $amount+(count($r2)*$row->sCost);
		  //      if($row->sId == "3")
		  //          $amount = $amount+(count($r3)*$row->sCost);
		  //      if($row->sId == "4")
		  //          $amount = $amount+(count($r4)*$row->sCost);
		  //  }
		  //  $data['amount'] = $amount;
		    
		    $amount = 0;
		    foreach($r1 as $row1):
		        $amount = $amount+$row1->amountPaid;
		    endforeach;
		    foreach($r2 as $row2):
		        $amount = $amount+$row2->amountPaid;
		    endforeach;
		    foreach($r3 as $row3):
		        $amount = $amount+$row3->amountPaid;
		    endforeach;
		    foreach($r4 as $row4):
		        $amount = $amount+$row4->amountPaid;
		    endforeach;
		    
		    $data['amount'] = $amount;
		    
		    $data["customers"] = $this->getdata->customers();
		}
		
		if($page == "orders"){
		    if($orderAt = $this->input->post('orderAt')){
		        $data["myOrdersData"] = $this->getdata->dashboard($this->input->post('oStatus'),$orderAt);
		    }
		    else{
		        $data["myOrdersData"] = $this->getdata->allOrders("All");
		    }
		}
		
		if($page == "payments"){
		    if($sId = $this->input->post('sId')){
		        $data["payments"] = $this->getdata->dashboardS($sId);
		    }
		    else{
		        $data["payments"] = $this->getdata->payments();
		    }
		}
		
		if($pack = $this->input->post('pack')){
	        $data["pack"] = $pack;
	        $data["subscription"] = $this->getdata->subscription("All");
	    }
		else if($page == "subscriptions"){
		    $data["subscription"] = $this->getdata->subscription("All");
		    $data["pack"] = null;
		}
		if($page == "customers"){
		    $data["customers"] = $this->getdata->customers();
		}
		if($albumId = $this->input->post('albumId')){
		    $data["albumId"] = $albumId;
    	    $data["oStatus"] = $this->input->post('oStatus');
    	    $data["cPhone"] = $this->input->post('cPhone');
	    }
		if($cId = $this->input->post('cId')){
		    $data["customerData"] = $this->getdata->cData($cId);
		    $data["customerProfile"] = $this->getdata->cProfile($cId);
		    $data["customerAddress"] = $this->getdata->cAddress($cId);
	        $data["customerPacks"] = $this->getdata->cPacks($cId);
	        $data["customerOrders"] = $this->getdata->cOrders($cId);
	    }
	    if($temp = $this->input->post('temp')){
	        $data["temp"] = $temp;
	        $data["templates"] = $this->getdata->templates();
	    }
		else if($page == "templates"){
		    $data["temp"] = null;
		    $data["templates"] = $this->getdata->templates();
		}
		
		if($emp = $this->input->post('emp')){
	        $data["emp"] = $emp;
	        $data["employees"] = $this->getdata->employees();
	    }
		else if($page == "employees"){
		    $data["emp"] = null;
		    $data["employees"] = $this->getdata->employees();
		}
		
		$this->load->view('topHeader');
		$this->load->view('header');
		$this->load->view('aside');
		$this->load->view($page,$data);
		$this->load->view('footer');
		$this->load->view('bottomFooter');
	}
	
	public function download(){
	    $this->load->library('zip');
	    $albumId = $this->input->post('albumId');
	    
	    $fileInfo = $this->getdata->album($albumId);
	    
	    foreach($fileInfo as $row){
	        $file = $row->image;
	        $this->zip->add_data($row->albumId.'/'.$file,file_get_contents('uploads/images/'.$file));
	    }
	    
	    $filename = $albumId.'.zip';
        $this->zip->download($filename);
        redirect('orders');
	}
	
	public function contactSupport(){
	   $contactSupport = $this->getdata->contactSupport("1");
	   $this->output
	        ->set_content_type('application/json')
		    ->set_output(json_encode($contactSupport));
	}
	
	
	public function eAdd(){
	    $employeeData = array(
	        'ownerId' => $this->input->post('ownerId'),
	        'passWord' => $this->input->post('phoneNo'),
	        'emailId' => $this->input->post('emailId'),
	        'phoneNo' => $this->input->post('phoneNo'),
	        'role' => $this->input->post('role'),
	        'status' => 1
	        );
	        
	        $employee = $this->insertdata->eAdd($employeeData);
	        $this->output
	                ->set_content_type('application/json')
	                ->set_output(json_encode($employee));
	}
	
	public function eEdit(){
	    $employeeData = array(
	        'ownerId' => $this->input->post('ownerId'),
	        'passWord' => $this->input->post('phoneNo'),
	        'emailId' => $this->input->post('emailId'),
	        'phoneNo' => $this->input->post('phoneNo'),
	        'role' => $this->input->post('role')
	        );
	        
	        $employee = $this->insertdata->eEdit($employeeData,$this->input->post('id'));
	        $this->output
	                ->set_content_type('application/json')
	                ->set_output(json_encode($employee));
	}
	
	public function active(){
	    $id = $this->input->post('id');
        if($this->input->post('status') == 1){
            $status = 0;
        }
        else if($this->input->post('status') == 0){
            $status = 1;
        }
        else if($this->input->post('status') == 2){
            $status = 2;
        }
        $result = $this->insertdata->eActive($id,$status);
		if($result){
			redirect('o/employees');
		}
    }
	
}
?>