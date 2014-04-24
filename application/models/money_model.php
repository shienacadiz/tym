<?php
class Money_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function new_money
		(
			$user,
			$cycle_id,
			$resource_id,
			$month,
			$day,
			$year,
			$description,
			$amount,
			$onHand_onBank
		) {
		$data = array(
			'user' => $user,
			'cycle_id' => $cycle_id,
			'resource_id' => $resource_id,
			'month' => $month,
			'day' => $day,
			'year' => $year,
			'description' => $description,
			'amount' => $amount,
			'onHand_onBank' => $onHand_onBank
		);
		return $this->db->insert('money', $data);
	}
	
	public function get_overall_budget($cycle_id) {
		$query = $this->db->query("SELECT get_overall_budget($cycle_id)");
		foreach($query->row_array() AS $result) {
			return $result;
		}
	}
	
	public function get_total_remaining_money($username, $cycle_id) {
		$query = $this->db->query("SELECT get_total_remaining_money('$username', $cycle_id)");
		foreach($query->row_array() AS $result) {
			return $result;
		}
	}
	
	public function get_remaining_on_bank($cycle_id) {
		$query = $this->db->query("SELECT get_remaining_on_bank($cycle_id)");
		foreach($query->row_array() AS $result) {
			return $result;
		}
	}
	
	public function get_remaining_on_hand($username, $cycle_id) {
		$query = $this->db->query("SELECT get_remaining_on_hand('$username', $cycle_id)");
		foreach($query->row_array() AS $result) {
			return $result;
		}
	}
}
?>