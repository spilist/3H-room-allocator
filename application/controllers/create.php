<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create extends MY_Controller {
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
		
		$this->load->view('create_v');
	}
	
	//XXX: rename
	function room() {
		/*if ($this->session->userdata('is_login')) {
			redirect('/');
    	}*/
		
		//TODO: form_validation
		
		$seats = json_decode($this->input->post('roomJson'));
		
		foreach ($seats as $seat) {
			echo $seat->seat_location_x;
			$seatInfo = array(
				'seat_location_x'=>(int)$seat->seat_location_x,
				'seat_location_y'=>(int)$seat->seat_location_y,
				'room_id'=>0,
			);
			
			$this->seat_m->createSeat($seatInfo);
			
			/*$this->seat_m->createSeat(array(
				'seat_location_x'=>(int)$seat->seat_location_x,
				'seat_location_y'=>(int)$seat->seat_location_y,
				'room_id'=>0, //XXX:use room id
			));*/
		}
		
		
	}
}
?>
