<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room extends MY_Controller {
    function __construct() {
        parent::__construct();
		$this->load->model('group_m');
		$this->load->model('room_m');
		$this->load->model('seat_m');
		$this->load->model('object_m');
    }
	
	function index() {
		redirect('/main/dashboard');
	}
	
	function add($gid) {
		$group = $this->group_m->get($gid);
		$data = array(
			'gid'=>$gid,
			'group_name'=>$group->group_name,
			'work'=>'add',
			'seats'=>array(),
			'rid'=>0,
			'room_name'=>'Room',
			'room_width'=>425,
			'room_height'=>300,
			'objects'=>array(),
			);
		$this->load->view('room_add_v', $data);
	}
	
	//XXX: rename to work (add/modify)
	function create($gid) {
		// Create a room
		$rid = $this->room_m->createRoom(array(
			'room_name'=>$this->input->post('roomName'),
			'room_width'=>(int)$this->input->post('roomWidth'),
			'room_height'=>(int)$this->input->post('roomHeight'),
			'group_id'=>$gid,
		));
		
		$seats = json_decode($this->input->post('roomJson'));
		
		foreach ($seats as $seat) {
			$seatInfo = array(
				'seat_location_x'=>(int)$seat->seat_location_x,
				'seat_location_y'=>(int)$seat->seat_location_y,
				'room_id'=>$rid,
			);
			$this->seat_m->createSeat($seatInfo);
		}
		
		$objects = json_decode($this->input->post('objects'));
		
		foreach ($objects as $obj) {
			$objInfo = array(
				'object_type'=>1,
				'object_location_x'=>(int)$obj->object_location_x,
				'object_location_y'=>(int)$obj->object_location_y,
				'room_id'=>$rid,
			);
			$this->object_m->create($objInfo);
		}
		
		// Increase seat count
		$limit = $this->group_m->getMemberLimit($gid) + count($seats);
		$this->group_m->updateMemberLimit($gid, $limit);
	}
	
	function update($gid, $rid) {
		//delete
		$seats = $this->seat_m->getsByRoom($rid);
		$limit = $this->group_m->getMemberLimit($gid) - count($seats);
		$this->group_m->updateMemberLimit($gid, $limit);
		$this->room_m->delete($rid);
		
		//create($gid);
		$rid = $this->room_m->createRoom(array(
			'room_name'=>$this->input->post('roomName'),
			'room_width'=>(int)$this->input->post('roomWidth'),
			'room_height'=>(int)$this->input->post('roomHeight'),
			'group_id'=>$gid,
		));
		
		$seats = json_decode($this->input->post('roomJson'));
		
		foreach ($seats as $seat) {
			$seatInfo = array(
				'seat_location_x'=>(int)$seat->seat_location_x,
				'seat_location_y'=>(int)$seat->seat_location_y,
				'room_id'=>$rid,
			);
			$this->seat_m->createSeat($seatInfo);
		}
		
		$objects = json_decode($this->input->post('objects'));
		
		foreach ($objects as $obj) {
			$objInfo = array(
				'object_type'=>1,
				'object_location_x'=>(int)$obj->object_location_x,
				'object_location_y'=>(int)$obj->object_location_y,
				'room_id'=>$rid,
			);
			$this->object_m->create($objInfo);
		}
		
		// Increase seat count
		$limit = $this->group_m->getMemberLimit($gid) + count($seats);
		$this->group_m->updateMemberLimit($gid, $limit);
	}
	
	//XXX: transaction?
	function delete($rid, $gid) {
		$seats = $this->seat_m->getsByRoom($rid);
		$limit = $this->group_m->getMemberLimit($gid) - count($seats);
		$this->group_m->updateMemberLimit($gid, $limit);
		$this->room_m->delete($rid);
		redirect('/group/configure/'.$gid);
	}
	
	function modify($rid, $gid) {
		$room = $this->room_m->get($rid);
		$group = $this->group_m->get($gid);
		$seats = $this->seat_m->getsByRoom($rid);
		$objects = $this->object_m->getsInRoom($rid);
		$data = array(
			'work'=>'modify',
			'gid'=>$gid,
			'group_name'=>$group->group_name,
			'rid'=>$rid,
			'seats'=>$seats,
			'room_name'=>$room->room_name,
			'room_width'=>$room->room_width,
			'room_height'=>$room->room_height,
			'objects'=>$objects,
		);
		$this->load->view('room_add_v', $data);
	}
}
?>
