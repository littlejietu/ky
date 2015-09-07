<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * 注册页
 *
 * 
 */
class Register extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    
    public function index()
    {
        // if ($this->loginUser['id'])
        // {
        //     redirect('/m/index');
        // }
        

        $data = array(
            'usertype'=> $this->config->item('usertype'),
        );
        $this->load->view('user/register', $data);
    }
    
    
    
    private function check_360()
    {
        if ($_SERVER['QUERY_STRING'] && strpos(urldecode($_SERVER['QUERY_STRING']), '<')!==false)
        {//没实际意义。为了360高分而已        
            show_404();
            exit;
        }
    }

    public function save()
    {
        $res = array('code'=>0,'data'=>array());
        if ($this->input->is_post())
        {
            $this->callback = true;
            $version = $this->input->post('version');
            switch($version)
            {
                default://默认注册页
                    list($config, $data_main, $data_detail) = $this->phone_config();
                    break;
            }

            $this->form_validation->set_rules($config);
            if ($res['code'] == 0  && $this->form_validation->run() === true)
            {
                $data_init = array(
                        'addtime'=>time(),
                        'status'=>1,
                        'validmobile'=>1,
                        'lastip'=>_ip_long(),
                    );
                $userid = $this->User_model->insert_string( array_merge($data_main,$data_init) );

                $data_detail = array_merge(array('userid'=>$userid), $data_detail);
                $data_memo = array(
                        'userid'=>$userid,
                    );

                $this->User_model->set_table('user_detail');
                $this->User_model->insert($data_detail);
                $this->User_model->set_table('user_memo');
                $this->User_model->insert($data_memo);
                //begin-初始化相册
                $this->load->model('Album_model');
                $data_album = array('userid'=>$userid,
                    'title'=>'精选作品',
                    'memo'=>'系统默认',
                    'kind'=>1,
                    'status'=>1,
                    'addtime'=>time(),
                    );
                $this->Album_model->insert($data_album);
                //end-初始化相册

                $res['code'] = 200;
            }
            else
            {
                $res['data']['error_messages'] = $this->form_validation->getErrors();
            }

        }//-if ($this->input->is_post())

        $this->view->json($res);
    }

    private function phone_config()
    {
        $config = array(
            array(
                'field'=>'usertype',
                'label'=>'用户类型',
                'rules'=>'trim|required',
            ),
            array(
                'field'=>'password_phone',
                'label'=>'密码',
                'rules'=>'trim|required|min_length[6]|max_length[20]',
            ),
            array(
                'field'=>'mobile',
                'label'=>'手机号码',
                'rules'=>'trim|required|valid_mobile|exist_user_mobile',
            ),
            array(
                'field'=>'code_phone',
                'label'=>'手机验证码',
                'rules'=>'trim|required|callback_mobilecode_check',
            ),
        );
        $plaintext = $this->input->post('password_phone');
        $this->load->library('des');
        $passwd_plaintext = ':'.$this->des->encrypt($plaintext);
        $data_main = array(
            'password'=>md5($plaintext),
            //'password_plaintext'=>$passwd_plaintext,
            'mobile'=>$this->input->post('mobile'),
            'username'=>$this->input->post('mobile'),
            'usertype'=>$this->input->post('usertype'),
            'userlevel'=>0,
        );

        $safety = _check_password_safe($this->input->post('password_phone'));
        $data_detail = array(
            'safety'=>$safety,
        );

        return array($config, $data_main, $data_detail);
    }



    public function mobilecode_check($code)
    {
        if (!$this->callback)exit;
        $db = $this->User_model->db;
        $result = $db->select('id,code')
                    ->from('sms_code')
                    ->where('type', 'register')
                    ->where('mobile', $this->input->post('mobile'))
                    ->order_by('id DESC')
                    ->limit(1)
                    ->get()
                    ->row_array();
        if ($result && $result['code'] == $code)
        {
            return TRUE;
        }
        $this->form_validation->set_message('mobilecode_check', ' %s 不正确');
        return FALSE;

    }








    public function success()
    {
        $this->check_360();
        if (!$this->loginID)
        {
//            redirect('register');
        }
        $result = array();
        $result['username'] = $this->loginUser['username'];
//        $result['user'] = insert_user_list(array('templete'=>'user_new_list_reg2','limit'=>8));
        $forward = $this->input->get('forward');
        
        if (preg_match('~http:\/\/(\w+)'.TRJ_DOMAIN.'~', $forward, $m))
        {
            $result['forward'] = $forward;
        }
        if($_GET['ver'] == 'base'){
        	$this->view->_template->css_path = $this->yun_url.'/assets/src/css/';
        	$this->view->display('user/register_success');
        	return;
        }elseif($_GET['ver'] == 'qr'){
        	$passwd_plaintext = $this->loginUser['passwd_plaintext'];
        	if($passwd_plaintext{0} == ':')
        	{
        		$this->load->library('des');
        		$result['passwd_plaintext'] = $this->des->decrypt(substr($passwd_plaintext, 1));
        		if (is_numeric($result['passwd_plaintext']))
        		{
        			$this->view->assign('ver', 'qr');
        		}
        	}
        }elseif ($_GET['ver'] == 'qk'){
            $passwd_plaintext = $this->loginUser['passwd_plaintext'];
            if($passwd_plaintext{0} == ':')
            {
                $this->load->library('des');
                $result['passwd_plaintext'] = $this->des->decrypt(substr($passwd_plaintext, 1));
                if (is_numeric($result['passwd_plaintext']))
                {
                    $this->view->assign('ver', 'v1');                    
                }
            }
        }
        elseif ($_GET['ver'] == 'v2')
        {
        	$this->view->assign('mobile',$this->loginUser['mobile']);
        	$this->view->assign('mobilecode',$this->input->get('mobilecode'));
        }
        elseif ($this->loginUser['email'])
        {
            $result['email_url'] = 'http://mail.'.array_pop(explode('@', $this->loginUser['email']));        
            $this->sendemail($this->input->cookie('IsSendEmail') ? false : true);
        }

        $this->view->assign('result', $result);
        $this->view->display('user/reg_success');
    }
    
    function sendmail()
    {
        $res = array('code'=>0,'data'=>array());
        if($this->input->is_ajax_request())
        {
            $this->sendemail(true);
            $res['code'] = 200;
        }
        $this->view->json($res);
    }
    
    private function sendemail($flag=false)
    {
        if($this->loginUser['id'] && $this->loginUser['email'] && $this->loginUser['email_true']==0 && $flag===true)
        {
            $this->load->model('User_cert_model');
            $data = array(	
    			'uid'=>$this->loginUser['id'],
    			'username'=>$this->loginUser['username'],
    			'cert_type'=>1,
    			'cert_code'=>'email',
    			'cert_content'=>'{"email":"'.$this->loginUser['email'].'"}',
    			'addtime'=>$this->timestamp,
    			'updatetime'=>$this->timestamp,
    			'is_shenhe'=>0,
    			'shenhe'=>0,
    		);
    		$certid = $this->User_cert_model->insert($data);
    		
    		$email = $this->loginUser['email'];
            //发邮件
    		$this->load->library('encrypt');
    		$code = $this->loginUser['id'].'|'.$certid.'|'.$email.'|'.$this->timestamp;
    		$code .= md5('!#%&)'.$code.'!#%&)');
    		$code = $this->encrypt->encode($code);
            
    		$param = array('username'=>$email, 'content'=>'您的邮箱激活地址：<a href="http://'.$_SERVER['HTTP_HOST'].'/util/vcemail.html?code='.$code.'" target=_blank>点此激活</a>' );
    		$this->view->assign('email', $param);
    		$html = $this->view->fetch('/library/email/cert_email','.lbi');
    		if(send_email($email, '邮箱激活', $html, '投融会员'))
    		{
    		    $this->input->set_cookie('IsSendEmail', 1, 0, TRJ_DOMAIN);
    		}
        }
    }

}
