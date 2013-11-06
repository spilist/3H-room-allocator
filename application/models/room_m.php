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
	
	//XXX: rename to create
	function createRoom($room_info) {
		$data = array(
			'room_name'=>$room_info['room_name'],
			'group_id'=>$room_info['group_id'],
		);
		
		$this->db->insert('room', $room_info);
		return $this->db->insert_id();
	}
}
?>
