<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Getdata extends CI_Model 
{
    /*===== Owner Login =====*/
    function login($formdata){
        $this->db->where($formdata);
        $query = $this->db->get('owner');
        return $query->row();
    }
    
    /*===== Customer Register =====*/
    public function cRegister($cPhone){
	    $this->db->where('cPhone',$cPhone);
        $query = $this->db->get('customer');
        return $query->row();
    }
    
    /*===== Customer OTP =====*/
    public function verifyOTP($customerData){
	    $this->db->where($customerData);
        $query = $this->db->get('customer');
        return $query->row();
    }
    
    /*===== Customer Profile =====*/
    public function cProfile($cId){
	    $this->db->where('cId',$cId);
        $query = $this->db->get('profile');
        return $query->row();
    }
    
    /*===== Customer Profile =====*/
    public function cAddress($cId){
	    $this->db->where('cId',$cId);
        $query = $this->db->get('address');
        return $query->result();
    }
    
    /*===== Customer Address Details =====*/
    public function addressDetails($aId){
	    $this->db->where('aId',$aId);
        $query = $this->db->get('address');
        return $query->row();
    }
    
    /*===== Subscription Data =====*/
    public function subscription($sId){
        if($sId!="All")
            $this->db->where('sId',$sId);
        $this->db->where('sStatus !=','2');
        $query = $this->db->get('subscriptions');
        return $query->result();
    }
    
    /*===== Templates Data =====*/
    public function templates(){
        $this->db->where('tStatus !=','2');
        $query = $this->db->get('template');
        return $query->result();
    }
    
    /*===== Employee Data =====*/
    public function employees(){
        $this->db->where('status !=','2');
        $query = $this->db->get('owner');
        return $query->result();
    }
    
    /*===== Subscription Payment =====*/
    public function pack($packData){
        $this->db->from ( 'payment p' );
        $this->db->join ( 'subscriptions s', 's.sId = p.sId');
        $this->db->where($packData);
        $query = $this->db->get();
        return $query->result();
    }
    
    /*===== Subscription Pack Checking =====*/
    public function packCheck($cId){
        $this->db->where("cId",$cId);
        $this->db->where("DATE_FORMAT(sEndDate,'%Y-%m-%d')>",date('Y-m-d'));
        $query = $this->db->get('payment');
        return $query->result();
    }
    
    /*===== My Orders Data =====*/
    public function myOrders($order){
        $this->db->where($order);
        $this->db->group_by('albumId');
        $this->db->order_by('orderAt','desc');
        $query = $this->db->get('orders');
        return $query->result();
    }
    
    /*===== Previous Order Data =====*/
    public function previousOrder($order){
        $this->db->where($order);
        $query = $this->db->get('orders');
        return $query->result();
    }
    
    /*===== Album Wise Feedback=====*/
    public function feedback($album){
        $this->db->where($album);
        $query = $this->db->get('feedback');
        return $query->row();
    }
    
    /*===== Template Data =====*/
    public function template($tId){
        if($tId!="All")
            $this->db->where('tId',$tId);
        $this->db->where('tStatus !=','2');
        $query = $this->db->get('template');
        return $query->result();
    }
    
    /*====== Payment Data =======*/
    public function payment($pId){
        $this->db->where('pId',$pId);
        $query = $this->db->get('payment');
        return $query->row();
    }
    
    /*====== Booking Data =======*/
    public function booking($albumId){
        $this->db->where('albumId',$albumId);
        $query = $this->db->get('booking');
        return $query->row();
    }
    
    /*===== All Dashboard Orders Admin=====*/
    public function dashboard($oStatus,$orderAt){
        $this->db->from ( 'orders o' );
        $this->db->join ( 'customer c', 'c.cId = o.cId');
        $this->db->join ( 'profile pr', 'pr.cId = o.cId');
        $this->db->join ( 'payment p', 'p.pId = o.pId');
        $this->db->join ( 'address a', 'a.aId = o.aId');
        $this->db->join ( 'booking b', 'b.albumId = o.albumId');
        // $this->db->order_by("DATE_FORMAT(o.orderAt, '%d-%m-%Y') DESC");
        $this->db->order_by('o.orderAt DESC');
        $this->db->group_by('o.albumId');
        if($oStatus!="All" && $orderAt!="All"){
            $this->db->where("o.oStatus",$oStatus);
            $this->db->where("DATE_FORMAT(o.orderAt,'%d-%m-%Y')",$orderAt);
        }
        else if($oStatus!="All"){
            $this->db->where("o.oStatus",$oStatus);
        }
        else if($orderAt!="All"){
            $this->db->where("DATE_FORMAT(o.orderAt,'%d-%m-%Y')",$orderAt);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    /*===== All Dashboard Packs Admin=====*/
    public function dashboardS($pack){
        $this->db->from ( 'payment p' );
        $this->db->join ( 'customer c', 'c.cId = p.cId');
        $this->db->join ( 'profile pr', 'pr.cId = p.cId');
        $this->db->join ( 'subscriptions s', 's.sId = p.sId');
        $this->db->where("p.sId",$pack);
        $this->db->order_by("DATE_FORMAT(p.paymentAt, '%m-%Y') DESC");
        $query = $this->db->get();
        return $query->result();
    }
    
    /*===== All Orders Data for Admin=====*/
    public function allOrders($oStatus){
        $this->db->from ( 'orders o' );
        $this->db->join ( 'customer c', 'c.cId = o.cId');
        $this->db->join ( 'profile pr', 'pr.cId = o.cId');
        $this->db->join ( 'payment p', 'p.pId = o.pId');
        $this->db->join ( 'address a', 'a.aId = o.aId');
        $this->db->join ( 'booking b', 'b.albumId = o.albumId');
        if($oStatus!="All"){
            $this->db->where("o.oStatus",$oStatus);
        }
        // $this->db->order_by("DATE_FORMAT(o.orderAt, '%d-%m-%Y') DESC");
        $this->db->group_by('o.albumId');
        $this->db->order_by('o.orderAt','desc');
        $query = $this->db->get();
        return $query->result();
    }
    
    /*===== Album Data for Admin=====*/
    public function album($albumId){
        $this->db->where("albumId",$albumId);
        $query = $this->db->get('orders');
        return $query->result();
    }
    
    /*===== Customers Data for Admin=====*/
    public function customers(){
        $this->db->from ( 'customer c' );
        $this->db->join ( 'profile pr', 'pr.cId = c.cId');
        $this->db->where('c.cStatus !=','2');
        $this->db->order_by("c.createdAt", "DESC");
        $query = $this->db->get();
        return $query->result();
    }
    
    /*===== Payment Data for Admin=====*/
    public function payments(){
        $this->db->from ( 'payment p' );
        $this->db->join ( 'customer c', 'c.cId = p.cId');
        $this->db->join ( 'profile pr', 'pr.cId = p.cId');
        $this->db->join ( 'subscriptions s', 's.sId = p.sId');
        //$this->db->order_by("DATE_FORMAT(p.paymentAt, '%m-%Y') DESC");
        $this->db->order_by("p.paymentAt, '%d-%m-%Y' DESC");
        $query = $this->db->get();
        return $query->result();
    }
    
    
    /*===== Customer Data Admin =====*/
    public function cData($cId){
	    $this->db->where('cId',$cId);
        $query = $this->db->get('customer');
        return $query->row();
    }
    
    /*===== Customer Packs =====*/
    public function cPacks($cId){
        $this->db->from ( 'payment p' );
        $this->db->join ( 'subscriptions s', 's.sId = p.sId');
	    $this->db->where('p.cId',$cId);
        $query = $this->db->get();
        return $query->result();
    }
    
    /*===== Customer Orders =====*/
    public function cOrders($cId){
        $this->db->where('cId',$cId);
        $this->db->group_by('albumId');
        $this->db->order_by('orderAt','desc');
        $query = $this->db->get('orders');
        return $query->result();
    }
    
    
    
    /*===== Contact Support =====*/
    public function contactSupport($id){
        $this->db->select('emailId,phoneNo');
        $this->db->where('id',$id);
        $query = $this->db->get('owner');
        return $query->row();
    }
}
?>