<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Util extends CI_Controller {
	function hello()
	{
	exit;
	}
	public function InternetShortcut()
	{
		$Shortcut = '[InternetShortcut]
URL=http://www.nm.com
IconFile=http://www.nm.com/favicon.ico
IDList=
[{000214A0-0000-0000-C000-000000000046}]
Prop3=19,2';

Header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=牛模网.url;");
echo $Shortcut;exit;
	}
	
	/**
	 * 错误页面
	 */
	public function error()
	{
		display_error('出错啦！喝杯茶休息一会！');
		exit;
	}

	
	/**
	* 根据用户id,取该用户通过的认证,cert_type逗号分隔
	*/
	public function get_user_credit($uid){
		if(empty($uid)) return '';

		$user_credit='';
		$this->load->model('User_cert_model');
		$db = $this->User_cert_model->db;

		$sql="select cert_type from trj_users_cert_info where uid='".$uid."' and shenhe=1";
		$tmp_arr=$db->query($sql)->result_array();
		$cert_arr=array();
		if($tmp_arr){
			foreach($tmp_arr as $k=>$v){
				$cert_arr[]=$v['cert_type'];
			}
		}
		$user_credit=implode(',',$cert_arr);
		return $user_credit;
	}
		
	
	//会员认证中心,邮件验证
	public function vcemail()
	{
		$code = $this->input->get('code');
		if ($code)
		{
			$code = str_replace(' ','+', $code);
			$this->load->library('encrypt');
			$code = $this->encrypt->decode($code);
			if($code)
			{
				$md5 = substr($code, -32); 
				$code = substr($code,0,-32);
				if ($md5 == md5('!#%&)'.$code.'!#%&)'))
				{
					list($user_id, $certid, $email, $time) = explode('|', $code);
					$user_id     = (int)$user_id;
					$certid     = (int)$certid;
					if($user_id && $certid && $email && is_email($email) && ($this->timestamp-$time < 3600))
					{
						$this->load->model('User_cert_model');

						$contentArr=array('email'=>$email);
						$cert_content=json_encode($contentArr);

						$succ=$this->User_cert_model->update_by_id($certid, array('shenhe'=>1,'cert_content'=>$cert_content));
						if($succ){
                                                        //成长值
                                                       $this->load->service('growth_service');
                                                       $this->growth_service->get_growth('auth',$user_id,'email');
                                                       
							$this->load->model('User_model');
							$db = $this->User_model->db;
							
							$user_credit=$this->get_user_credit($user_id);
							$sql="update trj_users set user_credit='".$user_credit."',email='".$email."',email_true=1 where id='".$user_id."'";
							$db->query($sql);

							$result['code'] = 200;
							alert('验证成功！','/manage/user_cert/index.html');
							exit;
						}
					}  
				}    
			}   
		}
		echo '验证已失效！';exit;
	}



	
	//邮件验证
	public function vemail()
	{
		$code = $this->input->get('code');
		if ($code)
		{
			$code = str_replace(' ','+', $code);
			$this->load->library('encrypt');
			$code = $this->encrypt->decode($code);
			if($code)
			{
				$md5 = substr($code, -32); 
				$code = substr($code,0,-32);
				if ($md5 == md5('!#%&)'.$code.'!#%&)'))
				{
					list($user_id, $credit_id, $email, $time) = explode('|', $code);
					$user_id     = (int)$user_id;
					$credit_id     = (int)$credit_id;
					if($user_id && $credit_id && $email && is_email($email) && ($this->timestamp-$time < 3600))
					{
						
						$this->load->model('User_credit_model');
						$this->User_credit_model->update_by_id($credit_id, array('status'=>1));
						if ($credit_id && $this->User_credit_model->db->affected_rows())
						{
							$user_credit = $this->User_credit_model->get_cids_by_uid($user_id);
							$this->load->model('Credit_config_model');
							$type_score = $this->Credit_config_model->get_info_by_id(6, 'type_score');

							$data = array(
								'user_credit'=>$user_credit,
								'email'=>$email,
								'email_true'=>1,
								'credit_points' => (int)$type_score['type_score']+(int)$this->loginUser['credit_points'],
							);
							$this->User_model->update_by_id($user_id,$data);
							add_user_log('credit_points', (int)$type_score['type_score'], '通过了信用认证[邮箱认证] 赠送的积分');

							//zjxm_search
							credit_search_updated($user_id);

							$result['code'] = 200;
							
							alert('验证成功！','/manage/certification.html');
							exit;
						}
					}
					
				}
				
			}
			
		}
		echo '验证已失效！';exit;
	}
	
	/**
	 * 获取用户头像
	 * 
	 */
	public function get_user_logo()
	{
		$res = array();
		$res['code'] = 0;
		if($this->input->is_ajax_request())
		{
			$user_ids = $this->input->post('user_ids');
			if ($user_ids)
			{
				$user_ids = explode(',', $user_ids);
				$user_ids = array_unique( array_filter($user_ids, 'is_numeric') );
				if ($user_ids){
					$this->load->model('User_model');
					$tmp = $this->User_model->get_field_by_ids($user_ids, 'id,user_logo');
					$res['code'] = 200;
					$res['data']['list'] = array();
					foreach($tmp as $val)
					{
						$res['data']['list'][$val['id']] = '/'.$val['user_logo'];
					}
				}
			}
		}
		$this->view->json($res);
	}
	
	
	public function captcha()
	{

		$this->load->helper('captcha');
		create_captcha(4,95,40);
	}

	public function captcha_admin(){
		$this->load->helper('captcha');
		create_captcha(4,95,40,'verify_adm');
	}
	
	public function nokeywords()
	{    
		$cache = get_cache();
		$this->load->model('Non_keywords_model');
		$tmp = $this->Non_keywords_model->get_list();
		$result = array();
		foreach($tmp as $val)
		{
			$result['original'][] = $val['name'];
			$result['replace'][] = $val['replace'];
		}
		$cache->save('nokeyword', $result, 3600*24*300);
		print_r($result);exit;
	}
	
	public function test_email()
	{
//        echo $this->config->item('encryption_key');
//        echo send_email('25241189@qq.com', '投融界注册测试', '投融界测试投融界测试', '亲') ? '成功' : '失败';
	}
	public function area_cache()
	{
		$this->load->model('area_model');
		$this->area_model->set_cache();
	}
	public function area_cache2()
	{
		$this->load->model('area_model');
		$this->area_model->set_pc_cache();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
