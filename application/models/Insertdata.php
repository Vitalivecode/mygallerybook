<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insertdata extends CI_Model 
{
    /*===== Customer Register =====*/
    public function cRegister($customerData){
        $this->db->insert('customer', $customerData);
		return $this->db->insert_id();
    }
    
    /*===== Customer Profile =====*/
    public function cProfile($profileData){
        $this->db->insert('profile', $profileData);
		$pId = $this->db->insert_id();
		$query = $this->db->get_where('profile', array('pId' => $pId));
        return $query->row();
    }
    
    /*===== Customer Profile Update=====*/
    public function cProfileUpdate($profileData,$pId){
        $this->db->set($profileData);
		$this->db->where('pId',$pId);
        $query = $this->db->update('profile');
        return $query;
    }
    
    /*===== Customer Address =====*/
    public function cAddress($addressData){
        $this->db->insert('address', $addressData);
		$aId = $this->db->insert_id();
		$query = $this->db->get_where('address', array('aId' => $aId));
        return $query->row();
    }
    
    /*===== Customer Active =====*/
    function customeractive($cId,$cStatus,$modifiedAt){
        $this->db->set('cStatus', $cStatus);
        $this->db->set('modifiedAt', $modifiedAt);
        $this->db->where('cId',$cId);
        $query = $this->db->update('customer');
        return $query;
    }
    
    /*===== Subscription Add =====*/
    public function subscription($subscriptionData){
        $this->db->insert('subscriptions', $subscriptionData);
		$sId = $this->db->insert_id();
		$query = $this->db->get_where('subscriptions', array('sId' => $sId));
        return $query->row();
    }
    
    /*===== Subscription update =====*/
    public function subscriptionedit($subscriptionData,$sId){
        $this->db->where('sId',$sId);
        $query = $this->db->update('subscriptions',$subscriptionData);
        return $query;
    }
    
    /*===== Subscription Active =====*/
    public function subscriptionactive($sId,$sStatus,$modifiedAt){
        $this->db->set('sStatus', $sStatus);
        $this->db->set('modifiedAt', $modifiedAt);
        $this->db->where('sId',$sId);
        $query = $this->db->update('subscriptions');
        return $query;
    }
    
    /*===== Subscription Payment =====*/
    public function pack($packData){
        $sId = $packData['sId'];
        $this->db->insert('payment', $packData);
		$pId = $this->db->insert_id();
		$query["payment"] = $this->db->get_where('payment', array('pId' => $pId))->row();
		$query["subscriptions"] = $this->db->get_where('subscriptions', array('sId' => $sId))->row();
        return $query;
    }
    
    /*===== Subscription Payment =====*/
    public function order($orderData){
        return $this->db->insert_batch('orders', $orderData);
    }
    
    
    
    /*===== Pack Update =====*/
    public function packUpdate($pId){
        $this->db->where('pId',$pId);
        $data = $this->db->get('payment')->row();
        
        if($data->sRemainAlbums>0){
            $this->db->where('pId',$pId);
            $this->db->set('sRemainAlbums', ($data->sRemainAlbums-1));
            return $this->db->update('payment');
        }
        else{
            return false;
        }  
    }
    
    
    /*===== Payment Update Albums =====*/
    function updatePayment($pId,$sRemainAlbums){
        $this->db->set('sRemainAlbums', $sRemainAlbums);
        $this->db->where('pId',$pId);
        $query = $this->db->update('payment');
        return $query;
    }
    
    /*===== Booking Update Remain albums =====*/
    function updateBooking($albumId,$oReorder,$bookingAt,$bHistory){
        $this->db->set('oReorder', $oReorder);
        $this->db->set('bookingAt', $bookingAt);
        $this->db->set('bHistory', $bHistory);
        $this->db->where('albumId',$albumId);
        $query = $this->db->update('booking');
        return $query;
    }
    
    /*===== Customer Feedback =====*/
    public function feedback($feedbackData){
        $this->db->insert('feedback', $feedbackData);
		$fId = $this->db->insert_id();
		$query = $this->db->get_where('feedback', array('fId' => $fId));
        return $query->row();
    }
    
    /*===== Customer Update =====*/
    public function cUpdate($cId,$customerData){
        $this->db->where('cId',$cId);
        $this->db->update('customer',$customerData);
        $query = $this->db->get_where('customer', array('cId' => $cId));
        return $query->row();
    }
    
    /*===== Order Status =====*/
    function orderstatus($albumId,$oStatus,$modifiedAt){
        $this->db->set('oStatus', $oStatus);
        $this->db->set('modifiedAt', $modifiedAt);
        $this->db->where('albumId',$albumId);
        $query = $this->db->update('orders');
        return $query;
    }
    
    /*===== Dispatched Details =====*/
    public function dispatched($dispatchedData){
        $this->db->insert('dispatched', $dispatchedData);
		$dId = $this->db->insert_id();
		$query = $this->db->get_where('dispatched', array('dId' => $dId));
        return $query->row();
    }
    
    /*===== Templates Add =====*/
    public function tAdd($templateData){
        $this->db->insert('template', $templateData);
        $tId = $this->db->insert_id();
		$query = $this->db->get_where('template', array('tId' => $tId));
        return $query->row();
    }
    
    /*===== Templates update =====*/
    public function tEdit($templateData,$tId){
        $this->db->where('tId',$tId);
        $query = $this->db->update('template',$templateData);
        return $query;
    }
   
   /*===== Template Active =====*/
    public function templateactive($tId,$tStatus){
        $this->db->set('tStatus', $tStatus);
        $this->db->where('tId',$tId);
        $query = $this->db->update('template');
        return $query;
    }
    
    /*===== Emplyee Add =====*/
    public function eAdd($employeeData){
        $this->db->insert('owner', $employeeData);
        $id = $this->db->insert_id();
		$query = $this->db->get_where('owner', array('id' => $id));
        return $query->row();
    }
    
    /*===== Templates update =====*/
    public function eEdit($employeeData,$id){
        $this->db->where('id',$id);
        $query = $this->db->update('owner',$employeeData);
        return $query;
    }
   
   /*===== Template Active =====*/
    public function eActive($id,$status){
        $this->db->set('status', $status);
        $this->db->where('id',$id);
        $query = $this->db->update('owner');
        return $query;
    }

    /*===== Order Finalized =====*/
    function finalized($albumId,$bFinal){
        $this->db->set('bFinal', $bFinal);
        $this->db->where('albumId',$albumId);
        $query = $this->db->update('booking');
        return $query;
    }
    
}
?>