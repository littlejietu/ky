<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usernum_model extends XT_Model {

	protected $mTable = 'user_num';
	protected $mPkId = 'userid';

	public function get_info_by_id($id, $fields='*')
	{
		return $this->get_by_id($id, $fields);
	}

}