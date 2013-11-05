<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Select extends MY_Controller {
    function __construct() {
        parent::__construct();
		$this->load->helper('form');
		//$this->load->model('seat_m');
		$this->form_validation->set_error_delimiters('<dd class="error">','</dd>');		
    }
	
	function index() {
		/*if ($this->session->userdata('is_login')) {
			redirect('/');    		
    	}*/
		$data = 
		$this->load->view('select_v');
	}
	
	//XXX: rename
	function room() {
		/*if ($this->session->userdata('is_login')) {
			redirect('/');
    	}*/
		
		
	}
}
?>
