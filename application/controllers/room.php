<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room extends MY_Controller {
    function __construct() {
        parent::__construct();
		$this->load->model('room_m');
		$this->load->model('seat_m');
		$this->load->model('group_m');
    }
	
	function index() {
		redirect('/main/dashboard');
	}
	
	function add($gid) {
		$data = array('gid'=>$gid);
		$this->load->view('room_add_v', $data);
	}
	
	function create($gid) {
		// Create a room
		$rid = $this->room_m->createRoom(array(
			'room_name'=>"TEMPORAL_ROOM_NAME",
			'group_id'=>$gid,
		));
		
		$seats = json_decode($this->input->post('roomJson'));
		
		foreach ($seats as $seat) {
			$seatInfo = array(
				'seat_location_x'=>(int)$seat->seat_location_x,
				'seat_location_y'=>(int)$seat->seat_location_y,
				'room_id'=>$rid,
			);
			$this->seat_m->createSeat($seatInfo);
		}
		
		// Increase seat count
		$limit = $this->group_m->getMemberLimit($gid) + count($seats);
		$this->group_m->updateMemberLimit($gid, $limit);
	}	
}
?>
