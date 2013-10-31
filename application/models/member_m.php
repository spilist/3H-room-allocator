<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_m extends CI_MODEL {

	function __construct() {
		parent::__construct();
	}		
	
	function getsAll() {
		return $this->db->get('member')->result();
	}
	
	function get($num) {
		return $this->db->get_where('member', array('id'=>$num))->row();
	}
	
	function getByID($id) {
		return $this->db->get_where('member', array('member_id'=>$id))->row();
	}
	
	function register($mem_info) {
		$data = array(
			'member_id'=>$mem_info['member_id'],
			'member_pw'	=>$mem_info['member_pw'],
			'member_name'	=>$mem_info['member_name'],			
		);
		$this->db->insert('member', $data);
		return $this->db->insert_id();
	}
}
?>
