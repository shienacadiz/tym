<?php
class Users_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function new_user() {
		$data = array(
			'username' => $this->input->post('reg_username'),
			'password' => md5($this->input->post('reg_password')),
			'fullname' => $this->input->post('reg_full_name'),
			'email' => $this->input->post('reg_mail'),
			'active' => 'N'
		);
		return $this->db->insert('users', $data);
	}
	
	public function edit_initial_settings($username, $cycle_id, $banking_flag, $savings_flag) {
		$data = array(
			'cycle_id' => $cycle_id,
			'banking_flag' => $banking_flag,
			'savings_flag' => $savings_flag
		);
		$this->db->where('username', $username);
		$this->db->update('users', $data);
	}
	
	public function get_users_by_code($code = FALSE) {
		$this->db->select('username');
		if ($code === FALSE) {
			$query = $this->db->get('users');	// select user.users field only
			return $query->result_array();
		}
		$query = $this->db->get_where('users', array('username' => $code));
		return $query->row_array();
	}
	
	public function get_user_account($username = FALSE, $password = FALSE) {
		$encrypt_pass = md5($password);
		$query = $this->db->get_where('users', array('username' => $username, 'password' => $encrypt_pass));
		return $query->row_array();
	}
}
?>