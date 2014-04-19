<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('users_model');
	}
	
	public function index() {
		$data['base']= $this->config->item('base_url');
		$data['css'] = $this->config->item('css');
		$data['jquery'] = $this->config->item('jquery');
		$data['login_success'] = FALSE;
		
		if($_POST) {
			$data['username'] = $this->input->post('login_username');
			$data['password'] = $this->input->post('login_password');
			$data['user_account'] = $this->users_model->get_user_account($data['username'], $data['password']);
			
			if(empty($data['user_account'])) {
				$data['error_message'] = "INVALID USERNAME OR PASSWORD!";
			}
			else {
				//checking if user account is active
				if($data['user_account']['active'] == 1) {
					$data['login_success'] = TRUE;
					
					//setting the session variables during login
					$username = $data['username'];
					$banking_flag = $data['user_account']['banking_flag'];
					$savings_flag = $data['user_account']['savings_flag'];
					$cycle_id = $data['user_account']['cycle_id'];		
					$session_array = Array(
										'username' => "$username",
										'banking_flag' => "$banking_flag",
										'savings_flag' => "$savings_flag",
										'cycle_id' => "$cycle_id"
									);
					$this->session->set_userdata($session_array);
				}
				else {
					$data['error_message'] = "YOUR ACCOUNT HAS NOT BEEN ACTIVATED YET!";
				}
			}
		}
		$this->load->view('index', $data);
	}
}
?>
