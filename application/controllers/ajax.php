<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajax extends CI_Controller {
	function __construct() {
		parent::__construct();					
	}
	
	function group_join($mid) {
		$this->form_validation->set_rules('group_name', 'Group name', 'trim|required');
		$this->form_validation->set_rules('group_pw', 'Group join password', 'trim|required');
		
		if (!$this->form_validation->run()) {
			echo json_encode(array(
				'error'=> true, 
				'msg'=>"Group name and password must be specified!",
			));
		}
		else {
			$this->load->model('group_m');
			
			$gname = $this->input->post('group_name');
			$gpw = $this->input->post('group_pw');
			
			$group = $this->group_m->getByGroupNameAndPW($gname, $gpw);
			
			if (empty($group)) { // there is no such group
				echo json_encode(array(
					'error'=> true, 
					'msg'=>"Group name or password is incorrect. Please try again.",
				));
			}
			else {
				$this->load->model('group_has_mem_m');
				$gid = $group->id;
				// Can't join to the group you joined				
				if ($this->group_has_mem_m->isMemInGroup($mid, $gid)) {
					echo json_encode(array(
						'error'=> true, 
						'msg'=>"You're already in the group!",
					));
				}
				// Can't join if the group reaches the member limit
				else if ($this->group_has_mem_m->getMembersNumInGroup($gid) == $group->member_limit) {
					echo json_encode(array(
						'error'=> true, 
						'msg'=>"Sorry, the group is now full of members.",
					));
				}
				else {
					$this->group_has_mem_m->putMemInGroup($mid, $gid);
					echo json_encode(array(
						'error'=> false, 
						'msg'=>"Success",
					));					
				}								 
			}
		}
	}
}