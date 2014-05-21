<?php
class Savings_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function get_savings($username, $cycle_id = FALSE) {	// left join to cycle table
		if ($cycle_id === FALSE) {
			// HERE'S THE MANUAL SCRIPT.
			// select t1.cycle_id, t1.savings_id, SUM(t1.amount) as 'amount', t2.from_month, t2.from_day,t2.from_year, t2.to_month, t2.to_day, t2.to_year
			// from savings t1 left join cycle t2 on t1.cycle_id = t2. cycle_id group by t1.cycle_id order by t1.cycle_id desc;
			// -- I'm not sure if I made my life more difficult below
			$this->db->select("SUM(amount) AS 'amount', from_month, from_day, from_year, to_month, to_day, to_year");
			$this->db->join('cycle','savings.cycle_id=cycle.cycle_id');
			$this->db->order_by('savings.cycle_id', 'desc');
			$this->db->group_by('savings.cycle_id');
			$query = $this->db->get_where('savings', array('savings.user'=>$username));
			return $query->result_array();
		}
		$query = $this->db->get_where('savings', array('user'=>$username, 'cylce_id'=>$cycle_id));
		return $query->result_array();
	}
	
	public function new_savings($cycle_id, $user, $amount) {
		$data = array("cycle_id" => $cycle_id, "user" => $user, "amount" => $amount);
		$this->db->insert("savings", $data);
	}
}
?>