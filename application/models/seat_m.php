<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seat_m extends CI_MODEL {

	function __construct() {
		parent::__construct();
	}
	
	function get($id) {
		return $this->db->get_where('seat', array('id'=>$id))->row();
	}
	
	function getsAll() {
		return $this->db->get('seat')->result();
	}
	
	function getsByRoom($room_id) {
		return $this->db->get_where('seat', array('room_id'=>$room_id))->result();
	}	
	
	function getsBySeatOwner($seat_owner_id) {
		return $this->db->get_where('seat', array('seat_owner_id'=>$seat_owner_id))->result();
	}
	
	function createSeat($seat_info) {
		$data = array(
			'seat_location_x'=>$seat_info['seat_location_x'],
			'seat_location_y'=>$seat_info['seat_location_y'],
			'room_id'=>$seat_info['room_id'],
		);
		
		$this->db->insert('seat', $data);
		return $this->db->insert_id();
	}
}
?>
