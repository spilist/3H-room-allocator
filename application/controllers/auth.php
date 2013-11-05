<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {
    function __construct() {
        parent::__construct();
		$this->load->helper('form');
		$this->load->model('member_m');			
		$this->form_validation->set_error_delimiters('<dd class="error">','</dd>');		
    }
	
	function index() {		
		$this->login();
	}
	
	function register() {
		if ($this->session->userdata('is_login')) {
			redirect('/');    		
    	}
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[45]');
		$this->form_validation->set_rules('id', 'ID', 'trim|required|is_unique[member.id]|max_length[11]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[30]');
		
		if (!$this->form_validation->run()) {
			$data = array(
					'errored' => 'errored',
				);
			$this->load->view('register_v', $data);
		}
		else {
			if (!function_exists('password_hash')) {
				$this->load->helper('password');	
			}
			$hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);			
			$user_num = $this->member_m->register(array(
				'member_id'=>$this->input->post('id'),
				'member_pw'=>$hash,
				'member_name'=>$this->input->post('name')				
			));
			
			$this->setUserDataForLogin($this->member_m->get($user_num));
			
			/* 추가로 session에 들어가야 할 데이터: 이 유저가 속한 그룹, 이 유저가 만든 그룹, 이 유저의 어플리케이션, 이 유저가 가진 좌석 */
			
			$this->session->set_flashdata('message', 'You have successfully signed up for RAFA!');
			redirect('/');	
		}							
	}	
	
    function login() {
    	if ($this->session->userdata('is_login')) {
			redirect('/');    		
    	}				
		
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if (!$this->form_validation->run()) {
			$data['error'] = "Please enter your ID and password.";
			$this->load->view('login_v', $data);
		}
		else {
			$this->load->model('member_m');
			if (!function_exists('password_verify')) {
				$this->load->helper('password');	
			}			
			
			$user = $this->member_m->getByID($this->input->post('id'));			
			if(isset($user) &&
	    		password_verify($this->input->post('password'), $user->member_pw)) {
	    			
	    		$this->setUserDataForLogin($user);
	    		redirect("/");
	    	} else {	    		
	    		$data['error'] = "ID or password doesn't match."; 			
	    		$this->load->view('login_v', $data);
	    	}			
		}
	}
	
	function showLogin() {
		$this->load->view('login_v');
	}

    function logout() {
    	$this->session->sess_destroy();    	
    	redirect('/');
    }
	
	private function setUserDataForLogin($user) {
		$userdata = array (
	    			'is_login' => true,
	    			'num' => $user->id,
	    			'name' => $user->member_name,
	    			'id' => $user->member_id,	    			
					);
	    
	    $this->session->set_userdata($userdata);
	}
	
	function fakeLogin() {
		$userdata = array (
	    			'is_login' => true,
	    			'num' => 1,
	    			'name' => 'Hwidong Bae',
	    			'id' => 'spilist',
					);
	    $this->session->set_userdata($userdata);		
		redirect("/");
	}
}	