<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        if ($this->loginID)
        {
            redirect('/m/index');
        }

        $forword_url = $this->input->get('forword_url');
        if (!$forword_url && !empty($_SERVER['HTTP_REFERER']) )
        {
            $forword_url = $this->input->filter($_SERVER['HTTP_REFERER']);
        }
        $result = array(
            'forword_url'=>$forword_url,
            'random'=>rand(0,999999),
        );

        if ($this->input->is_post())
        {
            $res = $this->login();
            $this->view->json($res);
        }
        
        $this->load->view('user/login');
    }


    public function login()
    {
        $res = array('code'=>0,'data'=>array(), 'error_num'=>0);

        $login  = _get_key_val($this->input->post('login'), TRUE);
        $is_yzm = 0;
        $iplong = _ip_long();
        $this->load->model('login_log_model');
        $res['error_num'] = $this->login_log_model->count(array('ip'=>$iplong));
        $login_code = $this->input->post('login_code');

        if (!$login_code)
        {
            $res['code'] = 201;
            $res['data']['error_messages']['result'] = '请输入验证码';
            return $res;
        }
        $this->load->helper('captcha');

        if (!check_captcha($login_code))
        {
            $res['code'] = 202;
            $res['data']['error_messages']['result'] = '验证码输入不正确';
            return $res;
        }

        if ($res['error_num'] >=10)
        {
            $res['code'] = 203;
            $res['data']['error_messages']['result'] = '输入密码超过10次，您忘记密码了，可以找回~';
            return $res;
        }
        

        $config = array(
            array(
                'field'=>'username',
                'label'=>'用户名',
                'rules'=>'trim|required',
            ),
            array(
                'field'=>'password',
                'label'=>'密码',
                'rules'=>'trim|required',
            ),
            array(
                'field'=>'result',
                'label'=>'',
                'rules'=>'callback_user_login_check',
            ),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE)
        {
            $this->login_log_model->clear($iplong);
            $res['code'] = 200;
        }
        else
        {
            $res['error_num']++;
        }

        $res['data']['error_messages'] = $this->form_validation->getErrors();

        return $res;
    }

    public function user_login_check()
    {
        $username = trim($_POST['username']);
        $fields   = 'id,username,usertype,nickname,mobile,password,status,validmobile,validemail';
        $this->load->helper('email');
        if (valid_email($username))
        {
            $user_info = $this->user_model->fetch_row(array('email'=>$username), $fields);
            if ($user_info && $user_info['validemail']==0)
            {
                $this->form_validation->set_message('user_login_check', '该邮箱尚未完成验证，无法登录.');
                return false;
            }
        }
        elseif (is_mobile($username))
        {
            $user_info = $this->User_model->fetch_row(array('mobile'=>$username), $fields);
            if ($user_info && $user_info['validmobile']==0)
            {
                $this->form_validation->set_message('user_login_check', '该手机号码尚未验证，无法登录.');
                return false;
            }
        }
        elseif (!preg_match("/^([a-z0-9]){3,12}$/i", $username))
        {
            $this->form_validation->set_message('user_login_check', '帐号或密码错误，请重新输入.');
            return false;
        }
        else
        {
            $user_info = $this->user_model->get_user_by_username($username, $fields);
        }

        if ($user_info && $user_info['status'] && $user_info['password'] == md5($_POST['password']))
        {
            $data = array(
                'xt_loginID'=>$user_info['id'],
                'xt_loginName'=>$user_info['nickname'] ? $user_info['nickname'] : $user_info['username'],
            );
            $this->security_code = md5(session_id().$this->input->ip_address());
            $expire = 0;
            if ($this->input->post('is_auto_login') == 'true')
            {
                $expire = 3600*24*7;
            }

            $this->load->library('encrypt');
            $str = $this->encrypt->encode($user_info['id']);
            $str = md5($this->config->item('encryption_key').$str).$str;
            $this->input->set_cookie('loginUser', $str, $expire, XT_DOMAIN);
            $this->input->set_cookie('loginCode', $this->security_code, $expire, XT_DOMAIN);


            $this->User_model->login_update($user_info['id'], time(), _ip_long());

            $this->loginUser = $user_info;

            //$this->add_user_log('login');

            $param = array('ver'=>'v3');
            $this->res['data']['login_userid'] = _get_key_val($user_info['id']);
            $this->res['data']['usertype'] = $user_info['usertype'];
            //$this->res['data']['userinfo'] = insert_user_info();

            return true;
        }

        $map = array(
            'ip'=>_ip_long(),
            'created'=>time(),
        );
        $this->login_log_model->insert($map);

        $this->form_validation->set_message('user_login_check', '帐号或密码错误，请重新输入');
        return false;
    }

    public function out(){
        $data = array('xt_loginID'=>0);
        $this->session->set_userdata($data);
        $this->input->set_cookie('loginUser', '',-1, XT_DOMAIN);
        $this->input->set_cookie('loginCode', '',-1, XT_DOMAIN);
        $this->input->set_cookie('is_next_initial', 0, -1, XT_DOMAIN);
        $this->input->set_cookie('cartNum', 0, 0, XT_DOMAIN);
        setcookie('PHPSESSID', '', -1, '/', XT_DOMAIN);

        header('location:'.base_url('user/login') );
    }
}
