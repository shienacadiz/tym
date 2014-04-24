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
	public function new_cycle	// TO dates are optional. returns the ID
		(	$user,
			$from_month,
			$from_day,
			$from_year,
			$to_month = 0,
			$to_day = 0,
			$to_year = 0,
			$starting_money,
			$resource_id,
			$onHand_onBank
		) {
		$data = array(
			'user' => $user,
			'from_month' => $from_month,
			'from_day' => $from_day,
			'from_year' => $from_year,
			'to_month' => $to_month,
			'to_day' => $to_day,
			'to_year' => $to_year,
			'starting_money' => $starting_money,
			'resource_id' => $resource_id,
			'onHand_onBank' => $onHand_onBank
		);
		$this->db->insert('cycle', $data);
		return $this->db->insert_id();
	
	}
	public function get_start_date($cycle_id) {
		$this->db->select('from_month, from_day, from_year');
		$query = $this->db->get_where('cycle', array('cycle_id' => $cycle_id));
		return $query->row_array();
	}
}
?>