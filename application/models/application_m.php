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
	
	function create($mid, $gid, $sid, $priority) {
		$data = array(
			'member_id' => $mid,
			'group_id' => $gid,
			'seat_id' => $sid,
			'seat_priority' => $priority,
			);
		$this->db->insert('application', $data);
		return $this->db->insert_id();
	}
}
?>
