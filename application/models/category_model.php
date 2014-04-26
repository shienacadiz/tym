<?php
class Category_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function new_category($username, $code, $desc) { // returns the id
		$data = array(
			'user' => $username,
			'category_code' => $code,
			'category_desc' => $desc
		);
		$this->db->insert('category', $data);
		return $this->db->insert_id();
	}
	
	public function edit_category($id, $code, $desc) {
		$data = array(
			'category_code' => $code,
			'category_desc' => $desc
		);
		$this->db->where('category_id', $id);
		$this->db->update('category', $data);
	}

	public function del_category($id) {
		$this->db->delete('category', array('category_id' => $id));
	}
	
	public function get_all_category($username) {
		$this->db->order_by('category_code');
		$query = $this->db->get_where('category', array('user' => $username));
		return $query->result_array();
	}
	
	public function get_category_owner($id) {
		$this->db->select('user');
		$query = $this->db->get_where('category', array('category_id' => $id));
		foreach($query->row_array() AS $result) {
			return $result;
		}
	}
	
	public function get_category($id) {
		$query = $this->db->get_where('category', array('category_id' => $id));
		return $query->row_array();
	}
	
	public function category_in_use($id) {	// check the expenses table if category is in use
		$this->db->select('expenses_id');
		$query = $this->db->get_where('expenses', array('category_id' => $id));
		foreach($query->row_array() AS $result) {
			return $result;
		}
	}
}
?>