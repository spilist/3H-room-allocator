<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('group_has_mem_m');
		$this->load->model('group_m');
		$this->load->model('member_m');	
		$this->load->model('application_m');
		$this->load->model('alloc_result_m');
		$this->load->model('seat_m');
	}
	
	public function index() {
		if (!$this->session->userdata('is_login')) {			
			$this->welcome();
		}
		else {
			$this->dashboard();			
		}
	}
	
	function welcome() {
		$this->load->view('welcome_v');
	}
	
	function dashboard() {
		/* 여기서 보여줘야 할 데이터: 이 유저가 속한 그룹, 이 유저가 만든 그룹 두 가지.
		 * 이 유저의 어플리케이션, 이 유저가 가진 좌석은 대시보드 안에서 클릭하면 된다. */			
		
		/* 유저가 속한 그룹 가져오기 */
		$data['groupsIn'] = $this->getGroupsIn();
		
		/* 유저가 만든 그룹 가져오기 */
		$data['groupsOwn'] = $this->getGroupsOwn();
		
		$this->load->view('dashboard_v', $data);
	}
	
	function getGroupsIn() {
		$mid = $this->session->userdata('num');
		$gidsIn = $this->group_has_mem_m->getsGroupsOfMember($mid);
		$groups_data = array();
		foreach ($gidsIn as $gidIn) {
			// Group metadata
			$gid = $gidIn->group_id;
			$group = $this->group_m->get($gid);
			$gname = $group->group_name;			
			$gowner_name = $this->member_m->getName($group->group_owner_id);
			
			// 내가 이 그룹에 어플리케이션을 넣었는가?
			$apps = $this->application_m->getsByMember($mid, $gid);
			if (empty($apps)) $apps_exist = false;
			else $apps_exist = true;
			
			// 내가 이 그룹에서 좌석을 배정받았는가?
			$seat = $this->alloc_result_m->getSeat($mid, $gid);
			if (empty($seat)) $seat_exist = false;
			else $seat_exist = true;			
			
			array_push($groups_data, array(
					'gid' => $gid,
					'gname' => $gname,
					'gowner' => $gowner_name,
					'num_members' => $num_members,
					'max_members' => $group->member_limit,
					'apps_exist' => $apps_exist,
					'seat_exist' => $seat_exist,
					));			
		}
		return $groups_data;
	}
	
	function getGroupsOwn() {
		$mid = $this->session->userdata('num');
		$groups = $this->group_m->getsOwned($mid);
		
		$data = array();
		foreach ($groups as $group) {
			$num_members = count($this->group_has_mem_m->getsMembersInGroup($group->id));
			array_push($data, array(
					'gid' => $group->id,
					'gname' => $group->group_name,
					'num_members' => $num_members,
					'max_members' => $group->member_limit,
					'mem_applied' => $group->members_applied,
					'alloc_done' => $group->allocation_done,
					));
		}
		return $data;
	}
}