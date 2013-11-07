<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Application extends MY_Controller {
		
	function __construct() {
		parent::__construct();
		$this->load->model('room_m');
		$this->load->model('seat_m');
		$this->load->model('application_m');
		$this->load->model('group_m');
	}
	
	public function index() {
		redirect('/');
	}
	
	function show($mid, $gid, $new='new') {		
    	$rooms = $this->room_m->getsByGroup($gid);
		
		if ($new == 'open') {
			$selects = $this->application_m->getsByMember($mid, $gid);
		}
		
		$roomArray = array();
		foreach ($rooms as $room) {
			$seats = $this->seat_m->getsByRoom($room->id);
			$seat_info = array();
			foreach ($seats as $seat) {
				$priority = 0;
				if ($new == 'open') {
					foreach ($selects as $selected) {
						if ($selected->seat_id == $seat->id) {
							$priority = $selected->seat_priority;							
							break;
						}
					}
				}
				
				array_push($seat_info, array(
					'sid' => $seat->id,
					'loc_x' => $seat->seat_location_x,
					'loc_y' => $seat->seat_location_y,
					'priority' => $priority,
					));				
			}
			
			$roomInfo = array( //이거 어레이로 안아고 오브젝트로 해도 됨
				'room_name'=>$room->room_name,
				'room_width'=>0, //TODO:
				'room_height'=>0, //TODO:
				'seats'=>$seat_info,
				);
			$roomArray[] = $roomInfo;//seats;
		}
		
		$data = array(
			'roomArray'=>$roomArray,
			'mid'=>$mid,
			'gid'=>$gid,
		);
				
		$this->load->view('application_v', $data);
	}
	
	function make_newHandler($mid, $gid) {
		$seats = json_decode($this->input->post('seats'));
		$priority = 1;
		foreach ($seats as $seat) {
			$this->application_m->create($mid, $gid, (int)$seat, $priority++);
		}
		
		$this->group_m->changeMemApplied($gid, 'inc');
	}
	
	function cancel($mid, $gid) {
		//$this->application_m->cancel($mid, $gid);
		//$this->group_m->changeMemApplied($gid, 'dec');
		redirect("/");
	}
}
