<?php
class Resources_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function new_resources($username, $code, $desc) { // returns the id
		$data = array(
			'user' => $username,
			'resource_code' => $code,
			'resource_desc' => $desc
		);
		$this->db->insert('resources', $data);
		return $this->db->insert_id();
	}
	
	public function edit_resources($id, $code, $desc) {
		$data = array(
			'resource_code' => $code,
			'resource_desc' => $desc
		);
		$this->db->where('resource_id', $id);
		$this->db->update('resources', $data);
	}
	
	public function del_resources($id) {
		$this->db->delete('resources', array('resource_id' => $id));
	}
	
	public function get_all_resources($username) {
		$this->db->order_by('resource_code');
		$query = $this->db->get_where('resources', array('user' => $username));
		return $query->result_array();
	}
	
	public function get_resource_owner($id) {
		$this->db->select('user');
		$query = $this->db->get_where('resources', array('resource_id' => $id));
		foreach($query->row_array() AS $result) {
			return $result;
		}
	}
}
?>