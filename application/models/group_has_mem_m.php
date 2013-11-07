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
	
	function getMembersNumInGroup($gid) {
		return $this->db->get_where('group_has_member', array('group_id'=>$gid))->num_rows();
	}
	
	function getsGroupsOfMember($mem_id) {
		return $this->db->get_where('group_has_member', array('member_id'=>$mem_id))->result();
	}
	
	function isMemInGroup($mid, $gid) {
		$query = $this->db->get_where('group_has_member', array('member_id'=>$mid, 'group_id'=>$gid));
		return ($query->num_rows() > 0);
	}
	
	function putMemInGroup($mid, $gid) {
		$data = array(
				'group_id' => $gid,
				'member_id' => $mid,				
				);
		$this->db->insert('group_has_member', $data);		
	}

	function leave($mid, $gid) {
		$data = array(
			'group_id' => $gid,
			'member_id' => $mid,				
			);
		$this->db->delete('group_has_member', $data);
	}
}
?>
