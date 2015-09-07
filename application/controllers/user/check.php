<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }



    public function regcheck()
    {
        $res = array('code'=>200,'data'=>array());
        $type = $this->input->post('type');

        $is_remote = $this->input->post('is_remote');

        switch($type)
        {
            case 'username':

                $username  = $this->input->post('username');
                if (is_numeric($username) && strlen($username) ==11)
                {
                    $res['code'] = 201;
                    $res['data']['error'] = '为避免与手机号重复，不能用11位数字作为用户名';
                }

                if ($res['code'] ==200 && $this->User_model->user_username_check($username))
                {
                    $res['code'] = 201;
                    $res['data']['error'] = '用户名 已被注册';
                    $username = substr($username, 0, 8);
                    $usernames = array();
                    $year = date('Y');
                    while(true)
                    {
                        if (!$this->User_model->user_username_check($username.$year))
                        {
                            $usernames[] = $username.$year;
                        }
                        $year++;
                        if (count($usernames)>=4)break;
                    }
                    $res['data']['usernames'] = $usernames;
                }

                break;
            case 'email':
                $email  = $this->input->post('email');
                if (!$email || !$this->form_validation->valid_email($email))
                {
                    $res['code'] = 201;
                    $res['data']['error'] = '请输入您的常用邮箱地址';
                }
                if ($res['code'] ==200 && $this->User_model->user_email_check($email))
                {
                    $res['code'] = 201;
                    $res['data']['error'] = '邮箱地址 已被注册';
                }
                if ($res['code'] ==200 && M('user_contact')->count(array('email'=>$email)) )
                {
                    $res['code'] = 201;
                    $res['data']['error'] = '邮箱地址 已被注册';
                }
                break;
            case 'nickname':
                $nickname  = $this->input->post('nickname');
                if ($res['code'] ==200 && $this->User_model->user_nickname_check($nickname))
                {
                    $res['code'] = 202;
                    $res['data']['error'] = '该昵称已被注册，请更换其他昵称并重新提交';
                }
                break;
            case 'mobile':
                $mobile  = $this->input->post('mobile');
                if (!$mobile || !is_mobile($mobile))
                {
                    $res['code'] = 201;
                    $res['data']['error'] = '会员注册完全免费，请输入真实的手机号码';
                }
                if ($res['code'] ==200 && $this->User_model->user_mobile_check($mobile))
                {
                    $res['code'] = 202;
                    $res['data']['error'] = '该手机号码已被注册，请更换其他号码并重新提交';
                }
                if ($res['code'] ==200 && $this->User_model->count(array('mobile'=>$mobile)) )
                {
                    $res['code'] = 202;
                    $res['data']['error'] = '该手机号码已被注册，请更换其他号码并重新提交';
                }
                break;

            case 'mobile_code':
            case 'mobilecode':
                $this->callback = true;
                $mobilecode  = $this->input->post($type);
                $mobile  = $this->input->post('mobile');
                if (!($mobilecode && strlen($mobilecode)==6 && $mobile && is_mobile($mobile) && $this->mobile_code_check($mobilecode) ) )
                {
                    $res['code'] = 201;
                    $res['data']['error']      = '您输入的验证码不正确';
                }
                else
                {
                    $res['code'] ==200;
                    $res['data']['authcode'] = urlencode(encrypt($mobile.'|'.$mobilecode));
                    $res['data']['mobile']      = $mobile;
                }
                break;
            case 'logincheck':
                $res['data']['error']      = '您输入的密码不正确';
                $mobile  = $this->input->post('mobile');
                $pwd  = $this->input->post('pwd');
                if ($mobile && $pwd && is_mobile($mobile))
                {
                    $user_info = $this->User_model->get_user_by_mobile($mobile, 'id,username,passwd,status');
                    if ($user_info['status'] && md5($pwd) == $user_info['passwd'])
                    {
                        $res['code'] = 200;
                        $data = array(
                        'trjcn_loginID'=>$user_info['id'],
                        'trjcn_loginName'=>$user_info['username'],
                        );
                        $this->session->set_userdata($data);
                    }
                }
                break;

        }

        if($is_remote == 1)
        {
            $result = false;
            if($res['code']==200)
                $result = true;
            $this->view->json($result);
        }
        else
            $this->view->json($res);

    }




	public function mobilecode(){
		$res = array();
		$res['code'] = 0;
		$res['data'] = array();
		if ($this->input->is_ajax_request() || (isset($_REQUEST['key']) && isset($_REQUEST['callback'])))
		{
			$mobile = $this->input->post('mobile');
			if (!is_mobile($mobile))
			{
				$res['code'] = 201;
				$res['data']['error'] = '请填写真实的手机号码';
			}
			elseif ($this->User_model->user_mobile_check($mobile))
			{
				$res['code'] = 202;
				$res['data']['error'] = $error;
			}
			else
			{
				$today = strtotime('today');
				$db = $this->User_model->db;
				$ip = _ip_long();

				$limit_num = 2;

				if (defined('ENVIRONMENT'))
				{
					switch (ENVIRONMENT)
					{
						case 'development':
							$limit_num = 50;
							break;
					}
				}

				if ($ip == '3078726954')
				{
					$limit_num = 50;
				}

				$result = $db->select('COUNT(1) as num')
							 ->from('mobile_blacklist')
							 ->where('mobile', $mobile)
							 ->get()
							 ->row_array();
				if ($result && $result['num']>0)
				{
					$res['code'] = 204;
					$res['data']['error'] = '您输入的手机号码存在异常操作，如有疑问请联系400-858-1000';
					$this->view->json($res);
				}


				//同一个IP 3次,
				$result = $db->select('COUNT(distinct mobile) AS num')
								->from('sms_code')
								->where('ip', $ip)
								->where('created >=', $today)
								->where('type', 'register')
								->get()
								->row_array();

				if ($result && $result['num'] >= $limit_num)
				{
					$res['code'] = 204;
					$res['data']['error'] = '您更换手机号超过系统限制无法继续注册，请联系400-858-1000';
				}

				$result = $db->select('COUNT(1) AS sendnum')
								->from('sms_code')
								->where('mobile', $mobile)
								->where('created >=', $today)
								->where('type', 'register')
								->get()
								->row_array();

				$sendnum = isset($result['sendnum']) ? $result['sendnum']:0;

				if ($res['code'] == 0)
				{
					//同一个号码同一个IP 5次,
					$result = $db->select('COUNT(*) AS num')
									->from('sms_code')
									->where('mobile', $mobile)
									// ->where('ip', $ip)
									->where('created >=', $today)
									->where('type', 'register')
									->get()
									->row_array();
					if ($result && $result['num'] >= $limit_num)
					{
						$res['code'] = 204;
						$res['data']['error'] = '您今天手机验证功能已使用超过系统限制无法继续使用，请联系400-858-1000';
					}
				}

				$code = '';
				if ($res['code'] == 0)
				{
					$result = $db->select('id,code,created')
									->from('sms_code')
									->where('mobile', $mobile)
									->where('type', 'register')
									->order_by('id DESC')
									->limit(1)
									->get()
									->row_array();

					if ($result)
					{
						$left_time = time()-$result['created'];
						if ($left_time < 60)
						{
							$res['data']['time'] = 60-$left_time;
							$res['data']['last'] = date('Y-m-d H:i:s', $result['created']);
							$res['data']['now']  = date('Y-m-d H:i:s', $this->timestamp);
							$res['data']['smsid'] = get_key_val($result['id']);
							$res['code'] = 203;
						}
						if ($left_time < 30*60)
						{
							$code = $result['code'];
						}
					}
				}

				if ($res['code'] == 0)
				{
					$code   = $code ? $code : rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9);
					$smsway = $this->config->item('smsway');
					$count  = count($smsway);
					$n = 0;
					for($i=0;$i<=$sendnum;$i++)
					{
						if($n >= $count)
						{
							$n = 0;
						}
						$way = $smsway[$n];
						$n++;
					}
					list($trackid, $referer) = $this->trackid();
					$data = array(
						'type'=>'register',
						'mobile'=>$mobile,
						'code'=>$code,
						'created' => time(),
						'ip'=>$ip,
						'way'=>$way,
						'trackid'=>$trackid,
						'referer'=>$referer,
					);
					if(isset($_POST['from']))
					{
						switch($_POST['from'])
						{
							case 'zjxmdetail':
								$data['from_web'] = 1;
								break;
						}
					}
					$db->insert('sms_code', $data);
					$smsid = $db->insert_id();
					if ($this->input->post('method') == 'publishquick')
					{
						$sms = '您的注册验证码是:'.$data['code'].'，该验证码在半小时内均有效，验证成功后您可使用该验证码作为登录密码。如非本人操作，请回复“1”退订！';
					}
					elseif ($this->input->post('method') == 'zjxm_sendsms')
					{
						$sms = '您的验证码是：'.$data['code'].'。该验证码在半小时内均有效。如非本人操作，请回复“1”退订！';
					}
					else
					{
						$sms = '您的注册验证码是:'.$data['code'].'。该验证码在半小时内均有效。如非本人操作，请勿理会！';
						if($way == 'ent')
						{
							$sms = '您的注册验证码是:'.$data['code'].'。该验证码在半小时内均有效。如非本人操作，请回复“1”退订！';
						}
					}
					$this->load->helper('sms');
					if ($smsid && do_send_sms($mobile, $sms, $way))
					{
						$res['code'] = 200;
						$result = $this->User_model->db->select('sum(voice_num) as sendnum')
												->from('sms_code')
												->where('mobile', $mobile)
												->where('created >=', strtotime('today'))
												->where('is_voice', 1)
												->get()
												->row_array();
						$res['data']['smsid'] = $result['sendnum'] > 1 ? '' : _get_key_val($smsid);
					}
					else
					{
						$res['code'] = 206;
						$res['data']['error'] = '手机校验码发失败，请重试或联系客服';
					}
				}
			}

		}

		$this->view->json($res);
	}

	

	private function trackid()
	{
		$trackid = $referer = '';
		$tracker = $this->input->cookie('trackid', TRUE);
		if ($tracker)
		{
			list($trackid, $referer) = explode('|T|', $tracker);
		}
		$trackid = ($trackid && preg_match('~^([a-z:0-9]{0,50})$~i', $trackid)) ? $trackid : '';
		return array($trackid,$referer);
	}

}