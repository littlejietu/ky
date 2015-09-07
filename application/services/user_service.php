<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_service
{

	public function __construct()
	{
		$this->ci = & get_instance();
		$this->ci->load->model('User_model');
		// $this->ci->load->model('Usernum_model');
	}


	public function login()
	{
		$res = array('code'=>0,'data'=>array(), 'error_num'=>0);

		$login  = _get_key_val($this->ci->input->post('login'), TRUE);
		$is_yzm = 0;
		$iplong = _ip_long();
		$this->ci->load->model('login_log_model');
		$res['error_num'] = $this->ci->login_log_model->count(array('ip'=>$iplong));
		$login_code = $this->ci->input->post('login_code');
		if ($res['error_num'] >=3)
		{
			$this->ci->load->helper('captcha');
			if (!$login_code)
			{
				$res['code'] = 201;
				$res['data']['error_messages']['result'] = '请输入验证码';
				return $res;
			}
			elseif (!check_captcha($login_code))
			{
				$res['code'] = 201;
				$res['data']['error_messages']['result'] = '验证码输入不正确';
				return $res;
			}
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
		$this->ci->form_validation->set_ci_service($this);
		$this->ci->form_validation->set_rules($config);
		if ($this->ci->form_validation->run() === TRUE)
		{
			$this->ci->login_log_model->clear($iplong);
			$res['code'] = 200;
		}
		else
		{
			$res['error_num']++;
		}

		$res['data']['error_messages'] = $this->ci->form_validation->getErrors();

		return $res;
	}
	
	public function verify_login()
	{
		$res = array('code'=>0,'data'=>array(), 'error_num'=>0);
		$iplong = ip_long();
		$this->ci->load->model('login_log_model');
		$config = array(
				array(
						'field'=>'mobile',
						'label'=>'手机号',
						'rules'=>'trim|required',
				),
				array(
						'field'=>'mobilecode',
						'label'=>'手机验证码',
						'rules'=>'trim|required',
				),
				array(
						'field'=>'result',
						'label'=>'',
						'rules'=>'callback_verify_login_check',
				),
		);
		$this->ci->form_validation->set_ci_service($this);
		$this->ci->form_validation->set_rules($config);
		if ($this->ci->form_validation->run() === TRUE)
		{
			$this->ci->login_log_model->clear($iplong);
			$res['code'] = 200;
		}
		$res['data']['error_messages'] = $this->ci->form_validation->getErrors();
		return $res;
	}
	
	public function verify_login_check()
	{
		$mobile = trim($this->ci->input->post('mobile'));
		$fields   = 'id,username,user_type,contact_name,mobile,passwd,status,mobile_true,email_true';
		if(is_mobile($mobile))
		{
			$user_info = $this->ci->user_model->fetch_row(array('mobile'=>$mobile), $fields);
			if(!$user_info){
				$this->ci->form_validation->set_message('verify_login_check', '手机号和验证码不一致，请重新输入');
				return false;
			}
			if($user_info['mobile_true']==0)
			{
				$this->ci->form_validation->set_message('verify_login_check', '该手机号码尚未验证，无法登录.');
				return false;
			}
			$result = $this->ci->user_model->db->select('id,code')
			->from('sms_code')
			->where('type', 'login')
			->where('mobile', $mobile)
			->order_by('id DESC')
			->limit(1)
			->get()
			->row_array();
			if ($result && $result['code'] == $this->ci->input->post('mobilecode'))
			{
				$this->ci->security_code = md5(session_id().$this->ci->input->ip_address());
				$expire = 0;
				$this->ci->load->library('encrypt');
				$str = $this->ci->encrypt->encode($user_info['id']);
				$str = md5($this->ci->config->item('encryption_key').$str).$str;
				$this->ci->input->set_cookie('loginUser', $str, $expire, TRJ_DOMAIN);
				$this->ci->input->set_cookie('loginCode', $this->ci->security_code, $expire, TRJ_DOMAIN);
				$this->ci->user_model->login_update($user_info['id'], $this->ci->timestamp, ip_long());
				$this->ci->loginUser = $user_info;
				//$this->add_user_log('login');
	
	
				$this->ci->load->service('cart_service');
				$this->ci->cart_service->init_cart_num($user_info['id']);
	
				$this->ci->res['data']['login_user_id'] = _get_key_val($user_info['id']);
				$this->ci->res['data']['user_type'] = $user_info['user_type'];
				$this->ci->res['data']['user_info'] = insert_user_info();
				return TRUE;
			}
			$this->ci->form_validation->set_message('verify_login_check', '手机号和验证码不一致，请重新输入');
			return FALSE;
		}else{
			$this->ci->form_validation->set_message('verify_login_check', '请填写正确的手机号码');
			return false;
		}
	}

	public function user_login_check()
	{
		$username = trim($_POST['username']);
		$fields   = 'id,username,usertype,nickname,mobile,password,status,validmobile,validemail';
		$this->ci->load->helper('email');
		if (valid_email($username))
		{
			$user_info = $this->ci->user_model->fetch_row(array('email'=>$username), $fields);
			if ($user_info && $user_info['validemail']==0)
			{
				$this->ci->form_validation->set_message('user_login_check', '该邮箱尚未完成验证，无法登录.');
				return false;
			}
		}
		elseif (is_mobile($username))
		{
			$user_info = $this->ci->user_model->fetch_row(array('mobile'=>$username), $fields);
			if ($user_info && $user_info['validmobile']==0)
			{
				$this->ci->form_validation->set_message('user_login_check', '该手机号码尚未验证，无法登录.');
				return false;
			}
		}
		elseif (!preg_match("/^([a-z0-9]){3,12}$/i", $username))
		{
			$this->ci->form_validation->set_message('user_login_check', '帐号或密码错误，请重新输入.');
			return false;
		}
		else
		{
			$user_info = $this->ci->user_model->get_user_by_username($username, $fields);
		}
		if ($user_info && $user_info['status'] && $user_info['passwd'] == md5($_POST['password']))
		{
			$data = array(
				'xt_loginID'=>$user_info['id'],
				'xt_loginName'=>$user_info['contact_name'] ? $user_info['contact_name'] : $user_info['username'],
			);
			$this->ci->security_code = md5(session_id().$this->ci->input->ip_address());
			$expire = 0;
			if ($this->ci->input->post('is_auto_login') == 'true')
			{
				$expire = 3600*24*7;
			}

			$this->ci->load->library('encrypt');
			$str = $this->ci->encrypt->encode($user_info['id']);
			$str = md5($this->ci->config->item('encryption_key').$str).$str;
			$this->ci->input->set_cookie('loginUser', $str, $expire, TRJ_DOMAIN);
			$this->ci->input->set_cookie('loginCode', $this->ci->security_code, $expire, TRJ_DOMAIN);


			$this->ci->user_model->login_update($user_info['id'], $this->ci->timestamp, ip_long());

			$this->ci->loginUser = $user_info;

			//$this->add_user_log('login');


			$this->ci->load->service('cart_service');
			$this->ci->cart_service->init_cart_num($user_info['id']);

			$param = array('ver'=>'v3');
			$this->ci->res['data']['login_userid'] = get_key_val($user_info['id']);
			$this->ci->res['data']['usertype'] = $user_info['user_type'];
			//$this->ci->res['data']['userinfo'] = insert_user_info();

			return true;
		}

		$map = array(
			'ip'=>_ip_long(),
			'created'=>$this->ci->timestamp,
		);
		$this->ci->login_log_model->insert($map);

		$this->ci->form_validation->set_message('user_login_check', '帐号或密码错误，请重新输入');
		return false;
	}

	public function login_out()
	{
		$data = array('trjcn_loginID'=>0);
		$this->ci->session->set_userdata($data);
		$this->ci->input->set_cookie('loginUser', '',-1, TRJ_DOMAIN);
		$this->ci->input->set_cookie('loginCode', '',-1, TRJ_DOMAIN);
		$this->ci->input->set_cookie('is_next_initial', 0, -1, TRJ_DOMAIN);
		$this->ci->input->set_cookie('cartNum', 0, 0, TRJ_DOMAIN);
		setcookie('PHPSESSID', '', -1, '/', TRJ_DOMAIN);
	}

	public function get_user_homeinfo($mid, $loginID){
		$this->ci->load->model('Usernum_model');
		$this->ci->load->model('Fans_model');

		$oUser = $this->ci->User_model->get_info_by_id($mid);
		$oUsernum = $this->ci->Usernum_model->get_by_id($mid, 'fansnum,concernnum,visitnum,be_commentnum,be_ordernum');
		if($oUsernum)
			$oUser = array_merge($oUsernum, $oUser);

		$o['concernstatus'] = 0;
		if($loginID)
		{
			$o = $this->ci->Fans_model->get_by_where(array('userid'=>$mid,'fansuserid'=>$loginID,'status<>'=>-1),'status as concernstatus');
			if(!$o)
			{
				$o['concernstatus'] = 0;
			}
		}
			
		$oUser = array_merge($o, $oUser);

		return $oUser;

	}

	public function get_ins_homeinfo($userid, $loginID){
		$this->ci->load->model('Usernum_model');
		$this->ci->load->model('Fans_model');

		$oUser = $this->ci->User_model->get_info_by_id($userid);
		if($oUser)
		{
			$insid = $oUser['insid'];
			$oIns = $this->ci->User_model->get_info_by_id($insid);

			$oInsnum = $this->ci->Usernum_model->get_by_id($insid, 'fansnum,concernnum,visitnum,be_commentnum,be_ordernum');
			if($oInsnum)
				$oIns = array_merge($oInsnum, $oIns);

			$o['concernstatus'] = 0;
			if($loginID)
			{
				$o = $this->ci->Fans_model->get_by_where(array('userid'=>$insid,'fansuserid'=>$loginID,'status<>'=>-1),'status as concernstatus');
				if(!$o)
				{
					$o['concernstatus'] = 0;
				}
			}

			$oIns['modelinfo'] = $oUser;
				
			$oIns = array_merge($o, $oIns);
		}

		return $oIns;

	}

	public function get_user_goodwork($mid){
		$res = array();
		$this->ci->load->model('Album_model');
		$this->ci->load->model('Photo_model');

		$oAlbum = $this->ci->Album_model->get_by_where(array('userid'=>$mid,'status'=>1,'kind'=>1),'id');
		if($oAlbum)
		{
			$albumid = $oAlbum['id'];
			$res = $this->ci->Photo_model->get_list(array('albumid'=>$albumid,'userid'=>$mid,'status'=>1),'title,img,addtime','addtime desc');
		}

		return $res;
	}

	public function visit($mid, $visitid, $type){
		if($mid==$visitid)
			return;
		$this->ci->load->model('Visit_model');
		$o = $this->ci->Visit_model->get_by_where(array('userid'=>$mid,'type'=>$type,'sessionid'=>"'".session_id()."'"));
		if(!$o)
		{
			$data = array(
				'userid'=>$mid,
				'visituserid'=>$visitid,
				'type'=>$type,
				'addtime'=>time(),
				'sessionid'=>session_id(),
				);
			$this->ci->Visit_model->insert_string($data);

			$this->ci->load->service('Num_service');
			$this->ci->num_service->set_user_num($mid,'visitnum');
			
		}

	}

}