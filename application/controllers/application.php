<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Application extends MY_Controller {
		
	function __construct() {
		parent::__construct();
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
		
	}
}