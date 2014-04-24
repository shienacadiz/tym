<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');
class Useraccount extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('users_model');
	}
	
	public function index() {
		verify_session();
		
		$data['base'] = $this->config->item('base_url');
		$data['css'] = $this->config->item('css');
		$data['jquery'] = $this->config->item('jquery');
		
		if($_POST) {
			if($this->input->post('banking_flag')) {
				$banking_flag = 1;
			}
			else {
				$banking_flag = 0;
			}
			if($this->input->post('savings_flag')) {
				$savings_flag = 1;
			}
			else {
				$savings_flag = 0;
			}
			$this->users_model->edit_flags($this->session->userdata('username'), $banking_flag, $savings_flag);
			
			//changing the session data
			$flags = array('banking_flag' => $banking_flag, 'savings_flag' => $savings_flag);
			$this->session->set_userdata($flags);
			
			//some message for UI
			$data['message'] = "Record has been updated successfully";
		}
		
		$this->load->view('useraccount', $data);
	}
}