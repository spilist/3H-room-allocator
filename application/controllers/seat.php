<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seat extends MY_Controller {
		
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		redirect('/main/dashboard');
	}
	
	function assigned($mid, $gid) {
		/*
		 $seat_result = $this->alloc_result_m->getSeat($mid, $gid);
			$seat_data = array();
			if (isset($seat_result)) {
				$sid = $seat_result->seat_id;
				$seat = $this->seat_m->get($sid);
				$seat_data = array(
						'seat_id' => $sid,
						'loc_x' => $seat->seat_location_x,
						'loc_y' => $seat->seat_location_y,
						'room_id' => $seat->room_id,
						);
			}
		 */
	}		
}