<?php
class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();        
    }
	
	function _remap($method, $params = array()) {
		$this->load->view('header_v');
		
		if (method_exists($this, $method)) {
			call_user_func_array(array($this, $method), $params);
		}
		
		$this->load->view('footer_v');
	}
}