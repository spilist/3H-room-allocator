<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_m extends CI_MODEL {

	function __construct() {
		parent::__construct();
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
}
?>
