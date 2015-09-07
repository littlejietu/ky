<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_log_model extends XT_Model {

	protected $mTable = 'login_log';

	public function clear($ip)
	{
		return $this->db->where('ip', $ip)->delete($this->mTable);
	}
	
}