<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ad_model extends XT_Model {

	protected $mTable = 'ad';

	public function get_info_by_id($id, $fields='*')
	{
		return $this->get_by_id($id, $fields);
	}

	public function get_ads_by_code($adcode)
	{
		$list = $this->get_list(array('adcode'=>$adcode,'status'=>1,'begtime<='=>time(),'endtime>'=>time()),'img,url','sort,addtime desc');
		return $list;

	}

}