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
}
?>