<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_has_mem_m extends CI_MODEL {

	function __construct() {
		parent::__construct();
	}		
	
	function getsAll() {
		return $this->db->get('group_has_member')->result();
	}
	
	function getsMembersInGroup($group_id) {
		return $this->db->get_where('group_has_member', array('group_id'=>$group_id))->result();
	}
	
	function getsGroupsOfMember($mem_id) {
		return $this->db->get_where('group_has_member', array('member_id'=>$mem_id))->result();
	}		
}
?>
