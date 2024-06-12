<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');

class Order extends CI_Controller {



    public function __construct(){
		parent::__construct();
		$this->load->model('insertdata');
		$this->load->model('getdata');
	}
	
	public function index(){
	   
	    $cId = $this->input->post('cId');
	    $pId = $this->input->post('pId');
	    $albumId = "MGB".$cId.$pId.date('Ym');
	    $aId = $this->input->post('aId');
	    
	    $order = array(
	        'cId' => $this->input->post('cId'),
	        'albumId' => $albumId
	        );
	    $previousOrder = $this->getdata->previousOrder($order);
	    if(count($previousOrder)>0){
	        $this->output
        		->set_content_type('application/json')
        		->set_output("Try Next Month Please");
	    }
	    else{
	        $packUpdate = $this->insertdata->packUpdate($pId);
	        if(!$packUpdate){
	            $this->output
	                ->set_content_type('application/json')
            		->set_output("Your Albums are Closed");
	        }
	        else{
	            $this->load->library('upload');
        		$ImageCount = count($_FILES['image']['name']);
        		//print_r($_FILES['image']);
        		//echo $ImageCount;
        		for($i = 0; $i < $ImageCount; $i++){
        		    //echo $i;
        			$_FILES['file']['name']       = $_FILES['image']['name'][$i];
        			$_FILES['file']['type']       = $_FILES['image']['type'][$i];
        			$_FILES['file']['tmp_name']   = $_FILES['image']['tmp_name'][$i];
        			$_FILES['file']['error']      = $_FILES['image']['error'][$i];
        			$_FILES['file']['size']       = $_FILES['image']['size'][$i];
        			$config['upload_path'] = "./uploads/images/";
        			$config['allowed_types']='jpg|jpeg|png';
        			//$config['encrypt_name'] = TRUE;
        // 			$config['max_size'] = 1024;
        //          $config['max_width'] = 1200;
        //          $config['max_height'] = 900;
        			$this->load->library('upload', $config);
        			$this->upload->initialize($config);
        			$this->upload->do_upload('file');
        			//$error = $this->upload->display_errors();
                    //print_r($error);
        			//echo "enterd in iffffff";
        				$imageData = $this->upload->data();
        				$image = $imageData['file_name'];
        				$orderData[$i] = array(
        					'cId' => $cId,
        					'aId' => $aId,
                	        'pId' => $pId,
                	        'albumId' => $albumId,
                	        'image' => $image,
                	        'oStatus' => 1,
                	        'orderAt' => date('Y-m-d H:i:s'),
                	        'modifiedAt' => date('Y-m-d H:i:s')
        				);
        		
        		}
        		//print_r( $orderData);
        		$order = $this->insertdata->order($orderData);
        		if($order>0){
        		    $this->output
        		        ->set_content_type('application/json')
        		        ->set_output(json_encode($order));
        		}
        		else{
        		   $this->output
            		->set_content_type('application/json')
            		->set_output("Try Againe to upload"); 
        		}
	        }
	    }
	}
	
	public function reOrder(){
	    $albumId = $this->input->post('albumId');
	    $oReorder = $this->input->post('oReorder');
	    $pId = $this->input->post('pId');
	    
	    $booking = $this->getdata->booking($albumId);
	    $bHistory = $booking->bHistory.'@'.$oReorder;
	    
	    $payment = $this->getdata->payment($pId);
	    $ra = $payment->sRemainAlbums;
	    
	    $sRemainAlbums = 0;
	    if($ra>=$oReorder){
	        $sRemainAlbums = $ra-$oReorder;
	        
	        $updatePayment = $this->insertdata->updatePayment($pId,$sRemainAlbums);
	        $updateBooking = $this->insertdata->updateBooking($albumId,$oReorder,date('Y-m-d H:i:s'),$bHistory);
	        
	        $this->output
	                ->set_content_type('application/json')
	                ->set_output("Reorder Success");
	    }
	    else{
	        $this->output
	                ->set_content_type('application/json')
	                ->set_output("You have Less Albums");
	    }
	    
	    
	    
	        
	}
	
	public function myOrders(){
	    $order = array(
	        'cId' => $this->input->post('cId'),
	        );
	    $myOrdersData = $this->getdata->myOrders($order);
	    if(count($myOrdersData)>0){
	        foreach($myOrdersData as $row):
	        $order = array(
	            'cId' => $row->cId,
	            'albumId' => $row->albumId
	            );
	            $previousOrder = $this->getdata->previousOrder($order);
	            $NofoImages = count($previousOrder);
	            $UploadImages = array();
	            foreach(array_slice($previousOrder, 0,5) as $row1):
	                $UploadImages[] = $row1->image;
	            endforeach;
	            $album = array(
	                'albumId' => $row->albumId
	                );
	            $feedback = $this->getdata->feedback($album);
	            
	            $data[] = array(
	                'oId' => $row->oId,
                    'cId' => $row->cId,
                    'aId' => $row->aId,
                    'pId' => $row->pId,
                    'albumId' => $row->albumId,
                    'oStatus' => $row->oStatus,
                    'orderAt' => $row->orderAt,
                    'modifiedAt' => $row->modifiedAt,
	                'NofoImages' => $NofoImages,
	                'UploadImages' => $UploadImages,
	                'feedback' => $feedback
	                );
	           $this->output
            		->set_content_type('application/json')
            		->set_output(json_encode($data));
	    endforeach;
	    }
	    else{
	        $data = array();
	        $this->output
        		->set_content_type('application/json')
        		->set_output(json_encode($data));
	    }
	}
	
	public function previousOrder(){
        $booking = $this->getdata->booking($this->input->post('albumId'));
        if(!empty($booking)){
            $bFinal = $booking->bFinal;
            if($bFinal == 4)
                $bFinal = "Yes";
            else
                $bFinal = "No";
        }
        else{
            $bFinal = "No";
        }
            

	    $order = array(
	        'cId' => $this->input->post('cId'),
	        'albumId' => $this->input->post('albumId')
	        );
	    $previousOrder = $this->getdata->previousOrder($order);
	    $NofoImages = count($previousOrder);
	    foreach($previousOrder as $row1):
	        $UploadImages[] = $row1->image;
	        
	        $oId = $row1->oId;
	        $cId = $row1->cId;
	        $aId = $row1->aId;
	        $pId = $row1->pId;
	        $albumId = $row1->albumId;
	        $oStatus = $row1->oStatus;
	        $orderAt = $row1->orderAt;
	        $modifiedAt = $row1->modifiedAt;
	    endforeach;
	    $data = array(
	        'oId' => $oId,
	        'cId' => $cId,
	        'aId' => $aId,
	        'pId' => $pId,
	        'albumId' => $albumId,
	        'oStatus' => $oStatus,
	        'orderAt' => $orderAt,
	        'modifiedAt' => $modifiedAt,
	        'NofoImages' => $NofoImages,
	        'UploadImages' => $UploadImages,
            'bFinal' => $bFinal
	       );
	    $this->output
    		->set_content_type('application/json')
    		->set_output(json_encode($data));
	}
	
	
	public function status(){
	    $albumId = $this->input->post('albumId');
	    $oStatus = $this->input->post('oStatus');
        $result = $this->insertdata->orderstatus($albumId,$oStatus,date('Y-m-d H:i:s'));
		if($result){
			redirect('/o/orders');
		}
    }
    
    public function dispatched(){
	    $dispatchedData = array(
	        'albumId' => $this->input->post('albumId'),
	        'cPhone' => $this->input->post('cPhone'),
	        'courierN' => $this->input->post('courierN'),
	        'courierTI' => $this->input->post('courierTI'),
	        'courierStatus' => 1,
	        'courierDate' => $this->input->post('courierDate'),
	        );
	        
	        $dispatched = $this->insertdata->dispatched($dispatchedData);
	        $result = $this->insertdata->orderstatus($this->input->post('albumId'),$this->input->post('oStatus'),date('Y-m-d H:i:s'));
	        $this->output
	                ->set_content_type('application/json')
	                ->set_output(json_encode($dispatched));
	}

    public function finalized(){
	    $albumId = $this->input->post('albumId');
	    $bFinal = strtoupper($this->input->post('bFinal'));
        if(!empty($bFinal) && !empty($albumId)){
            if($bFinal === "YES")
                $bFinal = 4;
            elseif($bFinal === "NO")
                $bFinal = 1;
            $result = $this->insertdata->finalized($albumId,$bFinal);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output("Updated");
    }
	
}
?>