<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function _get_product_default_price(){
	$CI =& get_instance();
	$aItem = $CI->config->item('workitem');
	$aScene = $CI->config->item('workscene');
	$aTime = $CI->config->item('worktime');

	$res = array();

	foreach ($aItem as $k1 => $v1) {
		foreach ($aScene as $k2 => $v2) {
			foreach ($aTime as $k3 => $v3) {
				$res[$k1.'_'.$k2.'_'.$k3] = $CI->config->item('workprice');
			}
		}
	}
	return $res;
}






?>