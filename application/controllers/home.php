<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('cycle_model');
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
			
			}
			else {	// display the form
				$display_homepage = FALSE;
				$this->load->view('home_ini', $data);	//this view ask for initial values (ie, starting date, money and etc)
			}
		}
		if($display_homepage) {
			//gets the Start Date of the cycle
			extract($this->cycle_model->get_start_date($this->session->userdata('cycle_id')));	//returns from_month, from_day, from_year
			$data['start_date'] = format_month($from_month)." $from_day, $from_year";
			
			$this->load->view('home', $data);
		}
	}
}

?>