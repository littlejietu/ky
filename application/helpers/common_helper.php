<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('get_json') ){
	function _get_json($data)
	{
		$callback = isset($_GET['callback']) ? $_GET['callback'] : '';
		$data = json_encode($data);
		if ($callback && preg_match('~^(jQuery)[\d\_]+$~', $callback))
		{
			echo $callback.'('.$data.')';
		}
		else
		{
			echo $data;
		}
		exit;
	}
}

if ( ! function_exists('ip_long') ){
	function _ip_long($ip='')
	{
		$CI =& get_instance();
		return sprintf('%u', ip2long( $ip ? $ip : $CI->input->ip_address() ));
	}
}

function _current_url(){//获取当前URL
	$url = $_SERVER['PHP_SELF']; 
	$filename= substr( $url , strrpos($url , '/')+1 );
	return $filename;
}


function _get_db($group='xt')
{
	static $db=array();
	if (!isset($db[$group])){
		$CI =& get_instance();
		$db[$group] = $CI->load->database($group, TRUE);
		$db_name = 'xt_'.$group;
		$CI->$db_name = $db[$group];
	}
	return $db[$group];
}

function _get_config($key)
{
	$CI     =& get_instance();
	return $CI->config->item($key);
}

/**
 * 返回加密串
 * @param $val
 * @param $flag
 * @return unknown_type
 */
function _get_key_val($val, $flag=FALSE, $redirct=FALSE)
{
	if (!$val)return '';
	if ($flag)
	{
		$md5 = substr($val, -32);
		$str = substr($val,0,-32);
		// if(_get_config('encrypt_open'))
		// {
			if ( $md5 == md5(session_id().'!#%&)'.$str))
				return $str;
			else if($redirct)
			{
				redirect('/home/expired');
				return '';
			}
			else
				return '';
			
		// }
		// else
		// 	return $str;

	}
	else
	{
		return $val.md5(session_id().'!#%&)'.$val);
	}
}



function _get_cfg_path($key)
{
	$CI     =& get_instance();
	$arrCfgpath = $CI->config->item('cfg_path');
	if(!empty($arrCfgpath[$key]))
		return $arrCfgpath[$key];
	else
		return '';
}

function _create_url($base_url, $params=array())
{
	if (substr($base_url, 0, 7) !='http://')$base_url = base_url($base_url);
	return $base_url._array_to_url($params);
}

function _array_to_url($params=array())
{
	$url = array();
	if ($params)
	foreach($params as $k=>$v)
	{
		if (strlen($v)==0)continue;
		$url[] = $k.'='.urlencode($v);
	}
	return $url ? '?'.join('&',$url):'';
}

function _get_page($name='page')
{
	$CI =& get_instance();
	$page = (int)$CI->input->get($name);
	return max($page,1);
}

function _is_empty($val)
{
	if(empty($val))
		return '';
	else
		return $val;
}



function XTM($model)
{
	$model = ucfirst($model).'_model';
	$CI =& get_instance();
	$CI->load->model($model);
	return $CI->$model;
}


function XTT($table)
{
	$model = 'XT_model';
	$CI =& get_instance();
	$CI->load->model($model);
	return $CI->$model->set_table(strtolower($table));
}





//缓存--begin
if(!function_exists('cache_read')){
    function _cache_read($file, $dir = '', $mode = '') {
        $file = _get_cache_file($file, $dir);
        if(!is_file($file)) return NULL;
        return $mode ? read_file($file) : include $file;
    }
}
  
if(!function_exists('cache_write')){
    function _cache_write($file, $string, $dir = '') {
        if(is_array($string)) {
            $string = "<?php return ".var_export($string, true)."; ?>";
            $string =  str_replace(array(chr(13), chr(10), "\n", "\r", "\t", '  '),array('', '', '', '', '', ''), $string);
        }
        $file = _get_cache_file($file, $dir);
        return write_file($file, $string);
    }
}
  
  
if(!function_exists('cache_delete')){
    function _cache_delete($file, $dir = '') {
        $file = _get_cache_file($file, $dir);
        return unlink($file);
    }
}
  
  
if(!function_exists('_get_cache_file')){
    function _get_cache_file($file, $dir) {
        $path = config_item('cache_path') ? config_item('cache_path') : APPPATH . 'cache/';
        return ($dir ? $path.$dir.'/'.$file : $path.$file);
    }
}
//缓存--end


?>