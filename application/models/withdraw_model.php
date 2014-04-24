<?php
class Withdraw_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function get_service_charge_by_cycle($cycle_id) {
		$query = $this->db->query("SELECT get_service_charge_by_cycle($cycle_id)");
		foreach($query->row_array() AS $result) {
			return $result;
		}
	}
}
?>