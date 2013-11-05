<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Select extends MY_Controller {
    function __construct() {
        parent::__construct();
		$this->load->helper('form');
		$this->load->model('seat_m');
		$this->form_validation->set_error_delimiters('<dd class="error">','</dd>');		
    }
	
	function index() {
		/*if ($this->session->userdata('is_login')) {
			redirect('/');    		
    	}*/
		$seats = $this->seat_m->getsByRoom(1);
		$data['seats'] = $seats;//json_encode($seats);
		
		/*foreach ($seats as $seat) {
			echo $seat->seat_location_x;
		}*/
		
		$this->load->view('select_v', $data);
	}
	
	//XXX: rename
	function room() {
		/*if ($this->session->userdata('is_login')) {
			redirect('/');
    	}*/
		
		
	}
}
?>
