<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends MY_Controller {
		
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->form_validation->set_error_delimiters('<dd class="error">','</dd>');
		$this->load->model('group_m');
		$this->load->model('room_m');
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
			$group_id = $this->group_m->create($this->session->userdata('num'), $this->input->post('group_name'), $this->input->post('group_pw'), $this->input->post('num_seats'));
			$this->session->set_userdata(array(
							'group_now'=>$group_id,
							));			
			redirect('/group/configure/'.$group_id);
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
	
	function join_new($mid) {
		
	}
}