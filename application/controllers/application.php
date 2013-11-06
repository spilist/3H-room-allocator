<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Application extends MY_Controller {
		
	function __construct() {
		parent::__construct();
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
		
		/*if ($this->session->userdata('is_login')) {
			redirect('/');    		
    	}*/
		$seats = $this->seat_m->getsByRoom(1);
		$data['seats'] = $seats;//json_encode($seats);
		
		/*foreach ($seats as $seat) {
			echo $seat->seat_location_x;
		}*/
		
		$this->load->view('application_v', $data);
	}
}