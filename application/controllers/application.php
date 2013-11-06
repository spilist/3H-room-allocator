<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Application extends MY_Controller {
		
	function __construct() {
		parent::__construct();
		$this->load->model('room_m');
		$this->load->model('seat_m');
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
			$roomArray[] = $seats;
		}
		
		$data = array(
			'roomArray'=>$roomArray,
			'roomCount'=>count($rooms), //XXX: debug
		);
		
		$this->load->view('application_v', $data);
	}
}