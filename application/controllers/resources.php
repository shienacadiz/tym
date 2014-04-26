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
			if($this->input->post('resource_id')) {	// means it is edit. since resource_id was defined
				$this->resources_model->edit_resources(
					$this->input->post('resource_id'),
					addslashes($this->input->post('resource_code')),
					addslashes($this->input->post('resource_desc'))
				);
				$data['active'] = $this->input->post('resource_id');
				$data['success_message'] = "Resource updated successfully";
			}
			else {
				$data['active'] = $this->resources_model->new_resources(
					$this->session->userdata('username'),
					addslashes($this->input->post('resource_code')),
					addslashes($this->input->post('resource_desc'))
				);
				$data['success_message'] = "Resource added successfully";
			}
		}
		$this->call_view($data);
	}
	
	public function edit($id) {
		verify_session();
		$data = array('valid'=>1);
		$resource_user = $this->resources_model->get_resource_owner($id);
		if($resource_user == $this->session->userdata('username')) {	//this is to check on whether the id to delete is from the active user
			$data['label_title'] = "Edit existing resources";
			$data['label_button'] = "Update";
			$data['edit'] = $this->resources_model->get_resource($id);
		}
		else {
			$data['error_message'] = "No illegal editting allowed!";
		}
		$this->call_view($data);
	}
	
	public function del($id) {
		verify_session();
		$data = array('valid'=>1);
		$resource_user = $this->resources_model->get_resource_owner($id);
		if($resource_user == $this->session->userdata('username')) {	//this is to check on whether the id to delete is from the active user
			$resource_in_use = $this->resources_model->resource_in_use($id); //check if in use first
			if($resource_in_use) {
				$data['error_message'] = "Cannot delete the resource code. Code still in use!";
			}
			else {
				$this->resources_model->del_resources($id);
				$data['success_message'] = "Resource successfully deleted";
			}
		}
		else {
			$data['error_message'] = "No illegal deletion allowed!";
		}
		$this->call_view($data);
	}
	
	function call_view($data = FALSE) {
		if(!isset($data['valid'])) {	//if accessing /resources/call_view manually from address bar, return 404
			show_404();
		}
		$data['base'] = $this->config->item('base_url');
		$data['css'] = $this->config->item('css');
		$data['jquery'] = $this->config->item('jquery');
		
		$data['resources_array'] = $this->resources_model->get_all_resources($this->session->userdata('username'));
		$data['code_array']['code'] = array();
		$data['code_array']['id'] = array();
		foreach($data['resources_array'] AS $resources) {
			array_push($data['code_array']['code'], stripslashes($resources['resource_code']));
			array_push($data['code_array']['id'], $resources['resource_id']);
		}
		
		if(!(isset($data['label_title']))) $data['label_title'] = "Add another resources";
		if(!(isset($data['label_button']))) $data['label_button'] = "Add";
		
		$this->load->view('resources', $data);
	}
}
?>