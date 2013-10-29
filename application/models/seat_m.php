<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seat_m extends CI_MODEL {

	function __construct() {
		parent::__construct();
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
}
?>
