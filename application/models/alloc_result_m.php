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
	
	function create($mid, $gid) {
		//TODO:
	}	
}
?>
