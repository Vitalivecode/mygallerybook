<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('insertdata');
		$this->load->model('getdata');
	}

	public function index($page = 'home'){
		if(! file_exists('application/views/'.$page.'.php')) {
			show_404();
		}
		$this->load->view($page);
	}

}
?>