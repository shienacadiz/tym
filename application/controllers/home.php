<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('cycle_model');
		$this->load->model('resources_model');
		$this->load->model('money_model');
		$this->load->model('users_model');
		$this->load->model('expenses_model');
		$this->load->model('withdraw_model');
	}
	
	public function index() {
		verify_session(); // this is from functions(helper)
		$display_homepage = TRUE;
		$data['base']= $this->config->item('base_url');
		$data['css'] = $this->config->item('css');
		$data['jquery'] = $this->config->item('jquery');
		//check first if the user has an existing cycle
		if(! $this->session->userdata('cycle_id')) { // no initialised cycle yet
			if($_POST) { // run insert for cycle then display homepage
				$resource_id = $this->resources_model->new_resources	// adding the initial resource
					(	$this->session->userdata('username'),
						$this->input->post('resource_code'),
						'Initial Resource'
					);
				$cycle_starting_money = $this->input->post('starting_money_hand');
				$cycle_flag = 1;
				$enable_banking = 0;
				if($this->input->post('enable_banking')) {
					$enable_banking = 1;
					//check which is higher - bank or in hand. Higher will be put in cycle table. lower would be in money table
					$money_amount = $this->input->post('starting_money_bank');
					$money_flag = 2;
					if($cycle_starting_money < $this->input->post('starting_money_bank')) {
						$cycle_starting_money = $this->input->post('starting_money_bank');
						$cycle_flag = 2;	// on bank
						
						$money_amount = $this->input->post('starting_money_hand');
						$money_flag = 1;	// on hand
					}
				}
				$cycle_id = $this->cycle_model->new_cycle
					(	$this->session->userdata('username'),
						$this->input->post('from_month'),
						$this->input->post('from_day'),
						$this->input->post('from_year'),
						"", "", "",
						$cycle_starting_money,
						$resource_id,
						$cycle_flag
					);
				if($enable_banking) {	// CAN'T put above cause we need the cycle_id
					$this->money_model->new_money
						(	$this->session->userdata('username'),
							$cycle_id,
							$resource_id,
							$this->input->post('from_month'),
							$this->input->post('from_day'),
							$this->input->post('from_year'),
							'Initial Money',
							$money_amount,
							$money_flag 
						);
				}
				if($this->input->post('enable_savings')) {
					$enable_savings = 1;
				}
				else {
					$enable_savings = 0;
				}
				$this->users_model->edit_initial_settings
					(	$this->session->userdata('username'),
						$cycle_id,
						$enable_banking,
						$enable_savings			
					);
				//finally adds a session variable for cycle_id/banking_flag to be used through out the system
				$session_array = array(
						'banking_flag' => $enable_banking,
						'savings_flag' => $enable_savings,
						'cycle_id' => $cycle_id
					);
				$this->session->set_userdata($session_array);
			}
			else {	// display the form
				$display_homepage = FALSE;
				$this->load->view('home_ini', $data);	//this view ask for initial values (ie, starting date, money and etc)
			}
		}
		if($display_homepage) {
			//gets the Start Date of the cycle
			$session_cycle_id = $this->session->userdata('cycle_id');
			$session_username = $this->session->userdata('username');
			extract($this->cycle_model->get_cycle($session_cycle_id));
			$data['start_date'] = format_month($from_month)." $from_day, $from_year";
			$data['overall_budget'] = $this->money_model->get_overall_budget($session_cycle_id);
			$data['total_remaining'] = $this->money_model->get_total_remaining_money($session_username, $session_cycle_id);
			if($this->session->userdata('banking_flag')) {
				$data['on_bank'] = $this->money_model->get_remaining_on_bank($session_cycle_id);
				$data['on_hand'] = $this->money_model->get_remaining_on_hand($session_username, $session_cycle_id);
			}
			$data['total_expenses'] = $this->expenses_model->get_expenses_by_cycle($session_username, $from_month, $from_day, $from_year, 0, 0, 0);
			$data['service_charges'] = $this->withdraw_model->get_service_charge_by_cycle($session_cycle_id);
			$this->load->view('home', $data);
		}
	}
}

?>