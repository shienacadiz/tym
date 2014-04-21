<?php
class Cycle_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
/*	public function get_cycle_dates($cycle_id) {
		$this->db->select('from_month', 'from_day', 'from_year', 'to_month', 'to_day', 'to_year');
		$query = $this->db->get_where('cycle', array('cycle_id' => $cycle_id));
		return $query->row_array();
	}
*/	
	public function get_start_date($cycle_id) {
		$this->db->select('from_month, from_day, from_year');
		$query = $this->db->get_where('cycle', array('cycle_id' => $cycle_id));
		return $query->row_array();
	}
}
?>