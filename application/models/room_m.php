<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room_m extends CI_MODEL {

	function __construct() {
		parent::__construct();
	}		
	
	function getsAll() {
		return $this->db->get('room')->result();
	}
	
	function getsByGroup($group_id) {
		return $this->db->get_where('room', array('group_id'=>$group_id))->result();
	}	
}
?>
