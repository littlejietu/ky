<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class MY_Controller extends CI_Controller{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		// if (substr($this->uri->uri_string,0,8) == 'modules/')
		// {
		// 	header('location:/');exit;
		// }
		// if ($this->router->is_in_module === TRUE)
		// {
		// 	$this->load->add_package_path(APPPATH.$this->router->fetch_module());
		// }
		// $this->view->assign('assets_url', config_item('assets_url'));
	}


}

// END Controller class
/* End of file Controller.php */
/* Location: ./system/core/Controller.php */





class MY_Admin_Controller extends CI_Controller {
    public  $systemList;
    function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url', 'main'));

        //验证登录
        $this->checkLogin();
        $userId         = $this->session->userdata('admin_id');
        if($userId){
            /*取左侧数据*/
            $this->load->model('admin/indexmodel');
            $sessionLevel   = $this->session->userdata['user_level'];
            $sessionPower   = $this->session->userdata['user_power'];
            $data['systemList']   = $this->indexmodel->getLeft($sessionLevel,$sessionPower);
            $this->systemList = $data['systemList'];
        }
    }

    /**
     * checkLogin 检查是否登录
    */
    public function checkLogin(){
        $isLoginHtml    = strpos('anything'.uri_string(),'login.html');//显示登录窗口时不验证是否登录
        $sqlBat         = strpos('anything'.uri_string(),'adminaction');
        $isAjaxGetCode  = strpos('anything'.uri_string(),'useraction/ajaxGetVerify');//ajax获取验证码时不验证是否登录
        $isAjaxLogin    = strpos('anything'.uri_string(),'useraction/ajaxLogin');//ajax提交登录信息时不验证是否登录

        if($isLoginHtml == False && $sqlBat == False && $isAjaxLogin == False && $isAjaxGetCode == False && $this->session->userdata ( 'admin_id' ) == ''){
            redirect(base_url('/admin/login.html'));
        }
    }

    /**
     * 生成验证码
     
    public function verify_image() {
        $this->load->helper('captcha');
        $allStr = 'QWERTYUIOPLKJHGFDSAZXCVBNM';
        $randStr=$allStr[rand(0,9)].$allStr[rand(0,9)].$allStr[rand(0,9)].$allStr[rand(0,9)];
        $vals = array(
            'word' => $randStr,
            'img_path' => './upload/captcha/',
            'img_url' => base_url('upload/captcha').'/',
            'img_width' => 78,
            'img_height' => 40,
            'expiration' => 7200
        );

        //删除两个小时以前生产的缩略图文件
        $this->deldir($vals['img_path'],$vals['expiration']);

        //生成新的缩略图
        $cap = create_captcha($vals);
        return $cap;
    }
    
    */

    /**
     * MD5加密
     */
    public function setMd5($str){
        $md5Prefix = $this->config->config['md5_prefix'];
        $str = md5($md5Prefix . md5($str) . $md5Prefix);
        return $str;
    }

    /**
     * 删除文件夹下所有文件
     * paramerter:
     *      $dir:文件夹名称（绝对路径）
     *      $delTime:设置删除的时间（当前时间 - 创建时间）
    */
    function deldir($dir='',$delTime=0) {
        if($dir == ''){
            return false;
        }
        $delTime = 0;//设置删除时间

        $dh=opendir($dir);
        $nowTime = time();
        while ($file=readdir($dh)) {

            if($file!="." && $file!="..") {
                $fullpath=$dir."/".$file;
                $fileTime = filectime($fullpath);
                $canDelTime = $nowTime - $fileTime;
                if(!is_dir($fullpath) && $canDelTime>$delTime) {
                    unlink($fullpath);
                }
            }
        }
        closedir($dh);
    }

    /**
     * 获得用户的真实IP
    */
    function get_real_ip(){
        $ip=false;
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
            for ($i = 0; $i < count($ips); $i++) {
                if (!preg_match("^(10|172.16|192.168).", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }

    public function  __set($key,$value){
        $this->$key = $value;
    }


    /**
    * 给分类名排版
     */
    function outClassName($categoryList){
        foreach($categoryList as $k => $v){
            $realIdArr          = explode(',',$v->cat_real_id);
            $realIdNum          = count($realIdArr);
            $nbsp               ='';
            for($i = 0; $i < ($realIdNum-1); $i++){
                $nbsp               .= '|----';
            }
            $categoryList[$k]->cat_name = $nbsp.$v->cat_name;
        }
        return $categoryList;
    }




}