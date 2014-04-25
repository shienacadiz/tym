<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');
class Savings extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('savings_model');
	}
	
	public function index() {
		verify_session();
		
		$data['base'] = $this->config->item('base_url');
		$data['css'] = $this->config->item('css');
		
		$data['savings_array'] = $this->savings_model->get_savings($this->session->userdata('username'));
		
		$this->load->view('savings', $data);
	}
}
?>