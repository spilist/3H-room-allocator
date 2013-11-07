<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alloc_result_m extends CI_MODEL {

	function __construct() {
		parent::__construct();
	}		
	
	function getsAll() {
		return $this->db->get('allocate_result')->result();
	}
	
	function getSeat($mid, $gid) {
		return $this->db->get_where('allocate_result', array('group_id'=>$gid, 'mem_id'=>$mid))->row();
	}
	
	function set($mid, $gid, $sid) {
		$data = array(
			'mem_id' => $mid,
			'group_id' => $gid,
			'seat_id' => $sid,
			);
		$this->db->insert('allocate_result', $data);
	}	
}
?>
