<?php
class Expenses_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function get_expenses_by_cycle($username, $from_month, $from_day, $from_year, $to_month, $to_day, $to_year) {
		$query = $this->db->query("SELECT get_expenses_by_cycle('$username', $from_month, $from_day, $from_year, $to_month, $to_day, $to_year)");
		foreach($query->row_array() AS $result) {
			return $result;
		}
	}
}
?>