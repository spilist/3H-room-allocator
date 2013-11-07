<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends MY_Controller {
		
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->form_validation->set_error_delimiters('<dd class="error">','</dd>');
		$this->load->model('group_m');
		$this->load->model('room_m');
		$this->load->model('seat_m');
		$this->load->model('application_m');
		$this->load->model('member_m');
		$this->load->model('group_has_mem_m');
	}
	
	public function index() {
		redirect('/main/dashboard');
	}
	
	function createForm($error='') {
		$this->load->view('group_add_v', array('errored'=>$error));
	}
	
	function create() {
		$this->form_validation->set_rules('group_name', 'Group name', 'required|is_unique[group.group_name]');
		$this->form_validation->set_rules('group_pw', 'Group join password', 'required');		
		
		if (!$this->form_validation->run()) {
			$this->createForm('errored');
		}
		else {
			$mid = $this->session->userdata('num');
			$gid = $this->group_m->create($mid, $this->input->post('group_name'), $this->input->post('group_pw'), $this->input->post('num_seats'));
			
			$this->group_has_mem_m->putMemInGroup($mid, $gid);
			$this->session->set_userdata(array(
							'group_now'=>$gid,
							));			
			redirect('/group/configure/'.$gid);
		}
	}
	
	function configure($gid) {
		$group = $this->group_m->get($gid);
		
		if ($this->session->userdata('num') != $group->group_owner_id) {
			redirect("/");
		}
		
		$rooms = $this->room_m->getsByGroup($gid);
		$rooms_data = array();
		if (!empty($rooms)) {
			foreach ($rooms as $room) {
				array_push($rooms_data, array(
					'room_id' => $room->id,
					'room_name' => $room->room_name,					
					));
			}
		}
		
		$data = array(
				'gid' => $gid,
				'gname' => $group->group_name,
				'gpw' => $group->group_pw,
				'gseats' => $group->selectable_seat_numbers,
				'rooms' => $rooms_data,
				);
		$this->load->view('group_configure_v', $data);
	}
	
	function allocate($gid) {
		$allocatedMembers = array();
		$rooms = $this->room_m->getsByGroup($gid);
		$priority = 1; //TODO: to max
		
		//XXX: clear for test
		foreach ($rooms as $room) {
			$seats = $this->seat_m->getsByRoom($room->id);
			foreach ($seats as $seat) {
				$this->seat_m->setOwner($seat->id, null);
			}
		}
		
		//XXX: fix to max room config
		for ($priority = 1; $priority <= 5; $priority++) {
			foreach ($rooms as $room) {
				$seats = $this->seat_m->getsByRoom($room->id);
				
				foreach ($seats as $seat) {
					$applications = $this->application_m->getsBySeatAndPriority($seat->id, $priority);
					$candidates = array();
					
					foreach ($applications as $application) {
						if (in_array($application->member_id, $allocatedMembers) == FALSE)
							$candidates[] = $application->member_id;
					}
					
					$count = count($candidates);
					//echo $count;
					
					if ($count > 0) {
						$selected = rand(0, $count-1);
						$allocatedMembers[] = $candidates[$selected];
						$this->seat_m->setOwner($seat->id, $candidates[$selected]);
						//TODO: maintain alloc_result_m
					}
				}		
			}
		}
		
		// TODO: handle not allocated members
		// Do after join finished
		
		$this->alloc_result($gid);
	}
	
	function allocate_simple($gid) {
		$allocatedMembers = array();
		$rooms = $this->room_m->getsByGroup($gid);
		$priority = 1; //TODO: to max
		
		foreach ($rooms as $room) {
			$seats = $this->seat_m->getsByRoom($room->id);
			
			foreach ($seats as $seat) {
				$applications = $this->application_m->getsBySeatAndPriority($seat->id, $priority);
				$candidates = array();
				
				foreach ($applications as $application) {
					if (in_array($application->member_id, $allocatedMembers) == FALSE)
						$candidates[] = $application->member_id;
				}
				
				$count = count($candidates);
				echo $count;
				
				if ($count > 0) {
					$selected = rand(0, $count-1);
					$mid =  $candidates[$selected];
					
					$allocatedMembers[] = $mid;
					$this->seat_m->setOwner($seat->id, $mid);
					
					$this->load->model('alloc_result_m');
					$this->alloc_result_m->set($mid, $gid, $seat->id);					
				}
			}		
		}
		
		$this->alloc_result($gid);
	}
	
	function alloc_result($gid) {
		$rooms = $this->room_m->getsByGroup($gid);
		$roomArray = array();
		
		foreach ($rooms as $room) {
			$seats = $this->seat_m->getsByRoom($room->id);
			
			// Find names
			foreach ($seats as $seat) {
				if ($seat->seat_owner_id) {
					$seat->seat_owner_name = $this->member_m->getName($seat->seat_owner_id)->member_name;	
				} else {
					$seat->seat_owner_name = "empty";
				}
			}
			
			$roomInfo = array(
				'room_name'=>$room->room_name,
				'room_width'=>0, //TODO:
				'room_height'=>0, //TODO:
				'seats'=>$seats,
				);
				
			
			$roomArray[] = $roomInfo;//$seats;
		}
		
		$data = array(
			'roomArray'=>$roomArray,
		);
		
		$this->load->view('group_allocate_v', $data);
	}
	
	function leave() {
		$this->group_has_mem_m->leave($mid, $gid);
		redirect("/");
	}
}