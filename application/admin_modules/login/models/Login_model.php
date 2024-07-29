<?php
class Login_model extends CI_Model
{
	var $tblusers = 'users';
	var $tblcompany = 'company';
	function __construct()
	{
		parent::__construct();
	}
	/* For check and insert wordpress user in our table which is not administrator */
	function insertUser($dataArray, $role)
	{
		$this->db->select('*');
		$this->db->where('name', $dataArray->user_login);
		$this->db->where('isDeleted', '0');
		$this->db->from($this->tblusers);
		$data = $this->db->get();
		if ($data->num_rows() == 0) {
			$insertData = array(
				"name" => $dataArray->user_login,
				"first_name" => $dataArray->first_name,
				"last_name" => $dataArray->last_name,
				"emailId" => $dataArray->user_email,
				"password" => $dataArray->user_pass,
				"userRole" => $role,
				"companyId" => 1,
				"isVerified" => 1
			);
			$this->db->trans_start();
			$query = $this->db->insert($this->tblusers, $insertData);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			return array("userId" => $insert_id, "companyId" => 1);
		} else {
			$row = $data->result()[0];
			return array("userId" => $row->userId, "companyId" => $row->companyId);
		}
	}
}
