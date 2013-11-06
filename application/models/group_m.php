<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_m extends CI_MODEL {

	function __construct() {
		parent::__construct();
	}		
	
	function get($gid) {
		return $this->db->get_where('group', array('id'=>$gid))->row();
	}
	
	function getsAll() {
		return $this->db->get('group')->result();
	}
	
	function getsOwned($owner_id) {
		return $this->db->get_where('group', array('group_owner_id'=>$owner_id))->result();
	}
	
	function getByGroupNameAndPW($name, $pw) {
		return $this->db->get_where('group', array('group_name'=>$name, 'group_pw'=>$pw))->row();
	}
	
	function create($owner_id, $name, $pw, $num_seats) {
		$data = array(
				'group_owner_id' => $owner_id,
				'group_name' => $name,
				'group_pw' => $pw,
				'selectable_seat_numbers' => $num_seats,
				);
		$this->db->insert('group', $data);
		return $this->db->insert_id();
	}
}
?>
