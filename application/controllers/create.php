<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create extends MY_Controller {
    function __construct() {
        parent::__construct();
		$this->load->helper('form');
		$this->form_validation->set_error_delimiters('<dd class="error">','</dd>');		
    }
	
	function index() {
		/*if ($this->session->userdata('is_login')) {
			redirect('/');    		
    	}*/
		
		$this->load->view('create_v');
	}
	
	//XXX: rename
	function room() {
		/*if ($this->session->userdata('is_login')) {
			redirect('/');
    	}*/
		
		echo $this->input->post('test');
		
		//echo $this->input->post('seats');
		//$seats = $this->input->post('seats');
		$seats = json_decode($this->input->post('roomJson'));
		foreach ($seats as $seat) {
			echo $seat;
		}
	}
}

?>
