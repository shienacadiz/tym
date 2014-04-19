<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('users_model');
	}
	
	public function index() {
		$data['base']= $this->config->item('base_url');
		$data['css'] = $this->config->item('css');
		$data['jquery'] = $this->config->item('jquery');
		
		if(!$_POST) {
			$data['existing_users'] = $this->users_model->get_users_by_code();
			$this->load->view('register', $data);
		}
		else {
			$this->users_model->new_user();
			$this->load->view('register_success', $data);
		}
	}
}
?>