<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');
class Category extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('category_model');
	}
	
	public function index() {
		verify_session();
		$data = array('valid'=>1);	// this flag is to check if the page is called properly. url can be manipulated manually. memory data can't.
		if($_POST) {
			if($this->input->post('category_id')) {	// means it is edit. since category_id was defined
				$this->category_model->edit_category(
					$this->input->post('category_id'),
					addslashes($this->input->post('category_code')),
					addslashes($this->input->post('category_desc'))
				);
				$data['active'] = $this->input->post('category_id');
				$data['success_message'] = "Category updated successfully";
			}
			else {
				$data['active'] = $this->category_model->new_category(
					$this->session->userdata('username'),
					addslashes($this->input->post('category_code')),
					addslashes($this->input->post('category_desc'))
				);
				$data['success_message'] = "Category added successfully";
			}
		}
		$this->call_view($data);
	}
	
	public function edit($id) {
		verify_session();
		$data = array('valid'=>1);
		$category_user = $this->category_model->get_category_owner($id);
		if($category_user == $this->session->userdata('username')) {	//this is to check on whether the id to delete is from the active user
			$data['label_title'] = "Edit existing category";
			$data['label_button'] = "Update";
			$data['edit'] = $this->category_model->get_category($id);
		}
		else {
			$data['error_message'] = "No illegal editting allowed!";
		}
		$this->call_view($data);
	}
	
	public function del($id) {
		verify_session();
		$data = array('valid'=>1);
		$category_user = $this->category_model->get_category_owner($id);
		if($category_user == $this->session->userdata('username')) {	//this is to check on whether the id to delete is from the active user
			$category_in_use = $this->category_model->category_in_use($id); //check if in use first
			if($category_in_use) {
				$data['error_message'] = "Cannot delete the category code. Code still in use!";
			}
			else {
				$this->category_model->del_category($id);
				$data['success_message'] = "Resource successfully deleted";
			}
		}
		else {
			$data['error_message'] = "No illegal deletion allowed!";
		}
		$this->call_view($data);
	}
	
	function call_view($data = FALSE) {
		if(!isset($data['valid'])) {	//if accessing /category/call_view manually from address bar, return 404
			show_404();
		}
		$data['base'] = $this->config->item('base_url');
		$data['css'] = $this->config->item('css');
		$data['jquery'] = $this->config->item('jquery');
		
		$data['category_array'] = $this->category_model->get_all_category($this->session->userdata('username'));
		$data['code_array']['code'] = array();
		$data['code_array']['id'] = array();
		foreach($data['category_array'] AS $category) {
			array_push($data['code_array']['code'], stripslashes($category['category_code']));
			array_push($data['code_array']['id'], $category['category_id']);
		}
		
		if(!(isset($data['label_title']))) $data['label_title'] = "Add another category";
		if(!(isset($data['label_button']))) $data['label_button'] = "Add";
		
		$this->load->view('category', $data);
	}
}
?>