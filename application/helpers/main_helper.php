<?php
/*公用函数库*/


function _get_userlogo_url($userlogo){

    return $userlogo? '/'.trim($userlogo,'/') : _get_cfg_path('images').'imghead.jpg';

}

function _get_companylogo_url($logo){

    return $logo? '/'.trim($logo,'/') : _get_cfg_path('images').'imghead.jpg';

}

function _get_login_agent_user(){
	$CI =& get_instance();

	$agentUser = $CI->cache->get('agentUser');
	if(!empty($agentUser))
		return $agentUser;
	else
		return $CI->loginUser;
}

function _get_image_url($img){

    return $img? '/'.trim($img,'/') : '';

}

function _check_password_safe($pwd){
	$res = 1;
	if(preg_match('/^[0-9]{1,6}$/', $pwd))
		$res = 1;
	else if(preg_match('/^([a-z]+(?=[0-9])|[0-9]+(?=[a-z]))[a-z0-9]+$/i',$pwd))
		$res = 3;
	else
		$res = 2;

	return $res;
}

function _get_timehello()
{
	$res = '';
	$arrHello = _get_config('timehello');
	$h = date('h',time());
	if($h>=6 && $h< 12)
		$res = $arrHello[1];
	else if($h>=12 && $h< 2)
		$res = $arrHello[2];
	else if($h>=2 && $h< 6)
		$res = $arrHello[3];
	else
		$res = $arrHello[4];

	return $res;
}



?>