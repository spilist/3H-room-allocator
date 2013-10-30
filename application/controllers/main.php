<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

	function __construct() {
		parent::__construct();		
	}
	
	public function index() {
		if (!$this->session->userdata('is_login')) {			
			$this->welcome();
		}
		else {
			//redirect('/note/showRecent');			
		}
	}
	
	function welcome() {
		$this->load->view('welcome_v');
	}
}