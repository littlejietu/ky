<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends XT_Model {

	protected $mTable = 'product';

	public function get_info_by_id($id, $fields='*')
	{
		return $this->get_by_id($id, $fields);
	}

	public function get_product_by_uid($id, $fields='*'){
		return $this->get_list("userid=$id and status=1", $fields);
	}

	public function get_produdct_by_uist($userid, $item, $scene, $time)
	{
		$o = $this->fetch_row("userid=$userid and item=$item and scene=$scene and time=$time and status=1");
		return $o;
	}

	public function insert_update($data){
		$res = 0;
		$where = 'userid='.$data['userid'].' and item='.$data['item'].' and scene='.$data['scene'].' and time='.$data['time'].' and status=1';
		
		$o = $this->fetch_row($where);
		if(!empty($o))
		{
			unset($data['userid']);
			unset($data['item']);
			unset($data['scene']);
			unset($data['time']);
			$res = $this->update_by_where($where,$data);
		}
		else
			$res = $this->insert_string($data);

		return $res;
	}
}