<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Object_m extends CI_MODEL {

	function __construct() {
		parent::__construct();
	}		
	
	function getsAll() {
		return $this->db->get('object')->result();
	}
	
	function getsInRoom($room_id) {
		return $this->db->get_where('object', array('room_id'=>$room_id))->result();
	}
	
	function create($objInfo) {
		$this->db->insert('object', $objInfo);
		return $this->db->insert_id();
	}		
}
?>
