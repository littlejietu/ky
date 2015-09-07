<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fans_model extends XT_Model {

	protected $mTable = 'fans';

	public function get_info_by_id($id, $fields='*')
	{
		return $this->get_by_id($id, $fields);
	}

}