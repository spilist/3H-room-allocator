<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Application_m extends CI_MODEL {

	function __construct() {
		parent::__construct();
	}		
	
	function getsAll() {
		return $this->db->get('application')->result();
	}
	
	function getsByMember($mem_id, $gid) {
		return $this->db->get_where('application', array('member_id'=>$mem_id, 'group_id'=>$gid))->result();
	}
	
	// TODO: and not completed.................???? people???? mid......
	function getsBySeatAndPriority($sid, $priority) {
		return $this->db->get_where('application', array('seat_id'=>$sid, 'seat_priority'=>$priority))->result();
	}
	
	function create($mid, $gid, $sid, $priority) {
		$data = array(
			'member_id' => $mid,
			'group_id' => $gid,
			'seat_id' => $sid,
			'seat_priority' => $priority,
		);
		if ($priority != 0) $this->db->insert('application', $data);		
	}
	
	function modify($mid, $gid, $sid, $priority) {
		$data = array(
			'member_id' => $mid,
			'group_id' => $gid,
			'seat_id' => $sid,			
		);
		$this->db->where($data);
		
		if ($priority != 0) $this->db->update('application', array('seat_priority' => $priority));				
		else $this->db->delete('application', $data);
	}
	
	function cancel($mid, $gid) {
		$data = array(
			'group_id' => $gid,
			'member_id' => $mid,				
			);
		$this->db->delete('application', $data);
	}
	
	function exist($mid, $gid) {
		$data = array(
			'group_id' => $gid,
			'member_id' => $mid,				
			);
		return ($this->db->get_where('application', $data)->num_rows() > 0); 
	}
}
?>
