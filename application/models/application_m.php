<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Application_m extends CI_MODEL {

	function __construct() {
		parent::__construct();
	}		
	
	function getsAll() {
		return $this->db->get('application')->result();
	}
	
	function getsByMember($mem_id) {
		return $this->db->get_where('application', array('member_id'=>$mem_id))->result();
	}	
}
?>
