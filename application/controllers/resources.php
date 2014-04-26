<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');
class Resources extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('resources_model');
	}

	public function index() {
		verify_session();
		$data = array('valid'=>1);	// this flag is to check if the page is called properly. url can be manipulated manually. memory data can't.
		if($_POST) {
			$data['active'] = $this->resources_model->new_resources(
				$this->session->userdata('username'),
				$this->input->post('resource_code'),
				$this->input->post('resource_desc')
			);
			$data['success_message'] = "Resource added successfully";
		}
		$this->call_view($data);
	}
	
	public function edit($id) {
		verify_session();
	}
	
	public function del($id) {
		verify_session();
		$data = array('valid'=>1);
		$resource_user = $this->resources_model->get_resource_owner($id);
		if($resource_user == $this->session->userdata('username')) {
			// INSERT DELETE HERE
			$data['success_message'] = "Resource successfully deleted";
		}
		else {
			$data['error_message'] = "No illegal deletion!";
		}
		$this->call_view($data);
	}
	
	function call_view($data = FALSE) {
		if(!isset($data['valid'])) {
			show_404();
		}
		$data['base'] = $this->config->item('base_url');
		$data['css'] = $this->config->item('css');
		$data['jquery'] = $this->config->item('jquery');
		
		$data['resources_array'] = $this->resources_model->get_all_resources($this->session->userdata('username'));
		$data['label_title'] = "Add another resources";
		$data['label_button'] = "Add";
		
		$this->load->view('resources', $data);
	}
}
?>