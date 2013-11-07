<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Application extends MY_Controller {
		
	function __construct() {
		parent::__construct();
		$this->load->model('room_m');
		$this->load->model('seat_m');
		$this->load->model('application_m');
	}
	
	public function index() {
		redirect('/main/dashboard');
	}
	
	function show($mid, $gid) {
		/* 
		 $apps_data = array();			
			$apps = $this->application_m->getsByMember($mid, $gid);
			foreach ($apps as $app) {
				array_push($apps_data, array(
						'seat_id' => $app->seat_id,
						'seat_priority' => $app->seat_priority,));
			}
		 */
	}
	
	function make_new($mid, $gid) {
    	$rooms = $this->room_m->getsByGroup($gid);
		$roomArray = array();
		
		foreach ($rooms as $room) {
			$seats = $this->seat_m->getsByRoom($room->id);
			$roomInfo = array( //이거 어레이로 안아고 오브젝트로 해도 됨
				'room_name'=>$room->room_name,
				'room_width'=>0, //TODO:
				'room_height'=>0, //TODO:
				'seats'=>$seats,
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
	}
}
