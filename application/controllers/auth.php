<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {
    function __construct() {
        parent::__construct();
		$this->load->helper('form');
		$this->form_validation->set_error_delimiters('<dd class="error">','</dd>');		
    }
	
	function index() {		
		$this->login();
	}
	
	function register() {
		if ($this->session->userdata('is_login')) {
			redirect('/');    		
    	}
		
		$this->form_validation->set_rules('name', '이름', 'required|max_length[16]');
		$this->form_validation->set_rules('email', '이메일', 'required|valid_email|is_unique[users.user_email]|max_length[32]');
		$this->form_validation->set_rules('password', '암호', 'required|min_length[6]|max_length[30]');
		
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
			$this->load->model('user_m');
			$user_num = $this->user_m->register(array(
				'email'=>$this->input->post('email'),
				'password'=>$hash,
				'name'=>$this->input->post('name')				
			));
			
			$this->setUserDataForLogin($this->user_m->get($user_num));
			// 회원가입 성공ㅎ면 자동으로 첫 번째 노트 생성해주고, 폴더 생성하는 모듈 필요
			$this->session->set_flashdata('message', '드림노트 회원가입에 성공했습니다.');			
			redirect('/');	
		}							
	}	
	
    function login() {
    	if ($this->session->userdata('is_login')) {
			redirect('/');    		
    	}				
		
		$this->form_validation->set_rules('email', '이메일', 'required|valid_email');
		$this->form_validation->set_rules('password', '암호', 'required');
		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('message', '이메일 또는 비밀번호가 맞지 않습니다.');
			$this->load->view('login_v');
		}
		else {
			$this->load->model('user_m');
			if (!function_exists('password_verify')) {
				$this->load->helper('password');	
			}			
			
			$user = $this->user_m->getByEmail($this->input->post('email'));			
			if($user &&
	    		password_verify($this->input->post('password'), $user->user_pw)) {
	    			
	    		$this->setUserDataForLogin($user);
				if ($this->session->userdata('type')=='student') {
					$this->setStuData($user->user_number);
				}
				$this->session->set_flashdata('message', '로그인 성공');
	    		redirect("/");
	    	} else {	    		
	    		$this->session->set_flashdata('message', '이메일 또는 비밀번호가 맞지 않습니다.'); 			
	    		redirect('/auth/login');
	    	}			
		}
	}

    function logout() {
    	$this->session->sess_destroy();    	
    	redirect('/');
    }
	
	function resetPassword() {
		
	}
	
	private function setUserDataForLogin($user) {
		$userdata = array (
	    			'is_login' => true,
	    			'id' => $user->user_number,
	    			'name' => $user->user_name,
	    			'type' => $user->user_type,
	    			'email' => $user->user_email,
	    			'profile_pic' => base_url(array('users', $user->user_number, 'profile_pic.png'))
					);
	    
	    $this->session->set_userdata($userdata);
	}
	
	private function setStuData($stu_num) {
		$this->load->model('student_m');		
		$stu_data = $this->student_m->get($stu_num);
		
		$this->load->model('canvas_m');
		$canvas_data = $this->canvas_m->get($stu_data->student_current_canvas);
		
		$data = array (			
			'group_num' => $stu_data->student_group_number,
			'canvas_num' => $canvas_data->canvas_number,
			'canvas_title' => $canvas_data->canvas_title,
			'recent_note' => $stu_data->student_recent_note,
			'cur_LV' => (int)$canvas_data->canvas_current_note_level,
			'max_LV' => (int)$stu_data->student_available_note_level,	
			'canvas_mode' => 'collapsed',							
			);
		
		$this->session->set_userdata($data);
	}
	
	function fakeLogin() {
		$userdata = array (
	    			'is_login' => true,
	    			'id' => 1,
	    			'name' => '김연아',
	    			'type' => 'student',
	    			'email' => 'qwert@gmail.com',
	    			'profile_pic' => base_url('/users/1/profile_pic.png')
					);
	    $this->session->set_userdata($userdata);
		$this->setStuData(1);
		redirect("/");
	}
}	