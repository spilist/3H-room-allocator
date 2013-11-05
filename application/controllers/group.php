<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends MY_Controller {
		
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		redirect('/main/dashboard');
	}	
}