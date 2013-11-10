<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Application extends MY_Controller {
		
	function __construct() {
		parent::__construct();
		$this->load->model('room_m');
		$this->load->model('seat_m');
		$this->load->model('application_m');
		$this->load->model('group_m');
		$this->load->model('member_m');
		$this->load->model('object_m');
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
			$objects = $this->object_m->getsInRoom($room->id);
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
				'room_width'=>$room->room_width,
				'room_height'=>$room->room_height,
				'seats'=>$seat_info,
				'objects'=>$objects,
				);
			$roomArray[] = $roomInfo;//seats;
		}
		
		$group = $this->group_m->get($gid);
		
		$data = array(
			'roomArray'=>$roomArray,
			'mid'=>$mid,
			'gid'=>$gid,
			'gname'=>$group->group_name,
			'gseats' => $group->selectable_seat_numbers,
			'gowner' => $this->member_m->getName($group->group_owner_id)->member_name,
			'new' => $new,
		);
				
		$this->load->view('application_v', $data);
	}
	
	function make_newHandler($mid, $gid, $new='new') {
		$seats = json_decode($this->input->post('seats'));
		$prios = json_decode($this->input->post('prio'));
		
		for ($i=0; $i<count($seats); $i++) {
			if ($new=='new') {
				$this->application_m->create($mid, $gid, $seats[$i], $prios[$i]);
			}
			else {
				$this->application_m->modify($mid, $gid, $seats[$i], $prios[$i]);
			}
		}
		
		if ($new=='new') {
			$this->group_m->changeMemApplied($gid, 'inc');
		}
	}
	
	function cancel($mid, $gid, $new='new') {
		if ($new=='open') {
			$this->application_m->cancel($mid, $gid);
			$this->group_m->changeMemApplied($gid, 'dec');
		}
			
		redirect("/");
	}
}
