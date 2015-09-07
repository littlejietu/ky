<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orderbook_model extends XT_Model {

	protected $mTable = 'order_book';

	public function get_info_by_id($id, $fields='*')
	{
		return $this->get_by_id($id, $fields);
	}
}