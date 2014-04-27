<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');
class Money extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('money_model');
		$this->load->model('cycle_model');
		$this->load->model('resources_model');
	}
	
	public function index() {
		verify_session();
		
		$data['base'] = $this->config->item('base_url');
		$data['css'] = $this->config->item('css');
		$data['jquery'] = $this->config->item('jquery');
		
		$data['filter_cycle'] = $this->session->userdata('cycle_id'); //default is current cycle
		if($_POST) {
			if($this->input->post('this_month')) {
			}
			else {	// means form is submitted through filter 
				$filter_cycle = $this->input->post('filter');
				$data['filter_cycle'] = $filter_cycle;
				if($filter_cycle != $this->session->userdata('cycle_id')) {
					$data['error_message'] = "You are no longer allowed to add money to past cycles";
				}
			}
		}
		// getting all the cycle for the drop down filter
		$data['cycle_array'] = $this->cycle_model->get_all_cycle_dates($this->session->userdata('username'));
		
		// getting the money for this cycle
		// read the cycle table first before anything else
		$data['initial_money'] = $this->cycle_model->get_cycle($data['filter_cycle']);
		// finally, getting the money on top of the initial cycle money
		$data['money_array'] = $this->money_model->get_money($data['filter_cycle']);
		
		// getting the resources for the resource drop down of the money form
		$data['resource_array'] = $this->resources_model->get_all_resources($this->session->userdata('username'));
		
		$this->load->view('money', $data);		
	}
}
?>