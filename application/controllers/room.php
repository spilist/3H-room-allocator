<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room extends MY_Controller {
    function __construct() {
        parent::__construct();
		$this->load->helper('form');
		$this->load->model('seat_m');
		$this->form_validation->set_error_delimiters('<dd class="error">','</dd>');		
    }
	
	function index() {
		redirect('/main/dashboard');
	}
	
	//function add() {
	//	$this->load->view('room_add_v');
	//}
	
	function add($gid) {
		$data = array('gid'=>$gid);
		$this->load->view('room_add_v', $data);
	}
	
	function create() {		
		$seats = json_decode($this->input->post('roomJson'));
		
		foreach ($seats as $seat) {
			$seatInfo = array(
				'seat_location_x'=>(int)$seat->seat_location_x,
				'seat_location_y'=>(int)$seat->seat_location_y,
				'room_id'=>1,
			);
			$this->seat_m->createSeat($seatInfo);
		}
		
		//ToDo: 어느 그룹으로 되돌려보낼것인지
		//XXX: redirect가.... 여기가 아니네..... 이거 ajax 였음...
		//redirect('/group/configure/124123');
		//redirect('/application/make_new/1/1');
	}	
}
?>
