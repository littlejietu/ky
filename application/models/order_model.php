<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends XT_Model {

	protected $mTable = 'order';

	public function get_info_by_id($id, $fields='*')
	{
		return $this->get_by_id($id, $fields);
	}

}