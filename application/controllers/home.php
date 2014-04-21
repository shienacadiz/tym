<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		verify_session(); // this is from functions(helper)
		$data['base']= $this->config->item('base_url');
		$data['css'] = $this->config->item('css');
		$data['jquery'] = $this->config->item('jquery');
		//check first if the user has an existing cycle
		if(! $this->session->userdata('cycle_id')) { // no initialised cycle yet
			if($_POST) {
			
			}
		}
		else {
			$this->load->view('home', $data);
		}
	}
}

?>