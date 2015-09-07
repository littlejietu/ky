<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//漫道短信商接口
function Ent_send_sms($mobile, $content)
{
    if (ENVIRONMENT == 'development')return true;
    static $sms = null;
    if (! ($mobile && is_mobile($mobile, TRUE) && $content)) return FALSE;
    $CI  =& get_instance();
    if ($sms === null)
    {    
        $CI->config->load('account', TRUE);
        $sms = $CI->config->item('sms_ent', 'account');
        $CI->load->library('curl'); 
    }
    $result = '';
    $content .= '[牛模网]';
    $content= utf_to_gbk($content);
    $post = array(
        'sn'=>$sms['Sn'],
        'pwd'=>$sms['Pwd'],
        'content'=> $content,
        'mobile'=>$mobile,
    );
    
    $result = $CI->curl->simple_get($sms['ApiUrl'], $post);
    $log_path = FCPATH.'../tmp/sms_ent';
    !is_dir($log_path) && mkdir($log_path, 0777, TRUE);
    file_put_contents($log_path.'/'.date('Ymd').'.log', $mobile.'=>'.$content.'=>'.$result."\r\n", FILE_APPEND);

    if (is_numeric($result) && $result{0}!='-')
    {
        return TRUE;
    }
    return FALSE;
}


//漫道广告短信商接口
function Ent_send_sms_ad($mobile, $content)
{
    if (ENVIRONMENT == 'development')return true;
    static $sms = null;
    if (! ($mobile && is_mobile($mobile, TRUE) && $content)) return FALSE;
    $CI  =& get_instance();
    if ($sms === null)
    {    
        $CI->config->load('account', TRUE);
        $sms = $CI->config->item('sms_ent', 'account');
        $CI->load->library('curl'); 
    	$CI->load->library('mobileblack_service');
    }
	if ($CI->mobileblack_service->get($mobile))return FALSE;
    $result = '';
    $content .= '[牛模网]';
    
    $content= utf_to_gbk(filter_ad_sms($content));
    $post = array(
        'sn'=>$sms['Sn'],
        'pwd'=>$sms['Pwd'],
        'content'=> $content,
        'mobile'=>$mobile,
        'ext'=>1,
    );
    
    if ($sms['ApiUrl'])$result = $CI->curl->simple_get($sms['ApiUrl'], $post);
    $log_path = FCPATH.'../tmp/sms_ent';
    !is_dir($log_path) && mkdir($log_path, 0777, TRUE);
    file_put_contents($log_path.'/adv_'.date('Ymd').'.log', $mobile.'=>'.$content.'=>'.$result."\r\n", FILE_APPEND);

    if (is_numeric($result) && $result{0}!='-')
    {
        return TRUE;
    }
    return FALSE;
}



//联通
function LT_send_sms($mobile, $content)
{
    static $sms = null;
    if (! ($mobile && is_mobile($mobile, TRUE) && $content)) return FALSE;
    $CI  =& get_instance();
    if ($sms === null)
    {
        $CI->config->load('account', TRUE);
        $sms = $CI->config->item('sms_high', 'account');
        $CI->load->library('curl');
    }
    $result = '';
    $content= utf_to_gbk($content);
    $CI->curl->create($sms['ApiUrl']);
    $post = array(
        'SpCode'=>$sms['SpCode'],
        'LoginName'=>$sms['LoginName'],
        'Password'=>$sms['Password'],
        'MessageContent'=> $content,
        'UserNumber'=>$mobile,
        'SerialNumber'=>str_pad(time().'0'.rand(1000,9999), 20, '0', STR_PAD_LEFT),
        'ScheduleTime'=>'',
        'f'=>1,
    );
    
    $CI->curl->post($post);
    $result = $CI->curl->execute();
    
    $log_path = FCPATH.'../tmp/sms_high';
    !is_dir($log_path) && mkdir($log_path, 0777, TRUE);
    file_put_contents($log_path.'/'.date('Ymd').'.log', $mobile.'=>'.$content.'=>'.$result."\r\n", FILE_APPEND);

    parse_str($result, $params);
    if (isset($params['result']) && $params['result']==0)
    {
        return TRUE;
    }
    return FALSE;
}



//亿美
function YM_send_sms($mobile, $content)
{
    static $sms = null;
    if (! ($mobile && is_mobile($mobile, TRUE) && $content)) return FALSE;
    
    if ($sms === null)
    {
        $CI  = & get_instance();
        $CI->config->load('account', TRUE);
        $sms = $CI->config->item('sms_ym', 'account');
        require_once APPPATH.'third_party/ymsdk/Client.php';
    }

    $client = new Client($sms['ApiUrl'],$sms['Sn'],$sms['Pwd'],'12345',FALSE,FALSE,FALSE,FALSE,2,10);
    
    $content= utf_to_gbk($content);
    $statusCode = $client->sendSMS(array($mobile), $content);

    $log_path = FCPATH.'../tmp/sms_ym';
    !is_dir($log_path) && mkdir($log_path, 0777, TRUE);
    file_put_contents($log_path.'/'.date('Ymd').'.log', $mobile.'=>'.$content.'=>'.$statusCode."\r\n", FILE_APPEND);
    if($statusCode === '0')
    {
        return TRUE;
    }
    return FALSE;
}

/**
 * 发送手机短信 走优质通道
 * @param $mobile
 * @param $content
 * @param $type
 * @return Boolen
 */
function do_send_sms($mobile, $content, $way='')
{
    if (ENVIRONMENT == 'development')return true;
    
    switch($way)
    {
        case 'ym':
            return YM_send_sms($mobile, $content);
            break;
        case 'lt':
            return LT_send_sms($mobile, $content);
            break;
        default:
            return Ent_send_sms($mobile, $content);
            break;
    }
       
}

function filter_ad_sms($content)
{
    $ar = array('房地产','地产','代办','私募');
    $br = array('房产','房产','协办','直募');
    $content = str_replace($ar, $br, $content);
    return $content;
}

/**
 * 发送手机短信 走广告通道
 * @param $mobile
 * @param $content
 * @return Boolen
 */
function do_ad_send_sms($mobile, $content)
{
    if (strlen($content)<10)return;
    return Ent_send_sms_ad($mobile, $content);
}



// ------------------------------------------------------------------------

/* End of file sms_helper.php */
/* Location: ./application/frontend/heleprs/sms_helper.php */
