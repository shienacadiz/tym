<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');
class Logout extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		verify_session();
		
		$data['base']= $this->config->item('base_url');
		$data['css'] = $this->config->item('css');
		
		$this->session->sess_destroy();
		
		$this->load->view('logout', $data);
	}
}
?>