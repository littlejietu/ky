<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fans extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Fans_model');
    }


	public function concern()
	{
		$res = array('code'=>0,'data'=>array());
		$mid = _get_key_val($this->input->post('mid'), true);
		if($mid==$this->loginID)
		{
			$res['code'] = 202;
			$res['data']['msg'] = '自己不能关注自己';
			$this->view->json($res);
			exit;
		}

		$this->load->model('User_model');
		$oMaster = $this->User_model->get_by_id($mid);
		if(!$oMaster)
		{
			$res['code'] = 202;
			$res['data']['msg'] = '用户不存在';
			$this->view->json($res);
			exit;
		}


		$o = $this->Fans_model->get_by_where(array('userid'=>$mid,'fansuserid'=>$this->loginID,'status<>'=>-1));
		if(!$o)
		{
			$data = array(
				'userid'=>$mid,
				'nickname'=>$oMaster['nickname'],
				'userlogo'=>$oMaster['userlogo'],
				'fansuserid'=>$this->loginID,
				'fansnickname'=>$this->loginNickName,
				'fanslogo'=>$this->loginUser['userlogo'],
				'type'=>1,
				'status'=>1,
				'addtime'=>time(),
				);

			$this->Fans_model->insert($data);
			$this->load->service('Num_service');
			$this->num_service->set_user_num($mid,'fansnum');
			$this->num_service->set_user_num($this->loginID,'concernnum');
			
			$res['code']=200;
		}
		else
		{
			$res['code'] = 201;
			$res['data']['msg'] = '已关注';
		}

		//判断是否相互关注
		$oFans = $this->Fans_model->get_by_where(array('userid'=>$this->loginID,'fansuserid'=>$mid,'status<>'=>-1));
		if($oFans)
		{
			$this->Fans_model->update_by_where(array('userid'=>$mid,'fansuserid'=>$this->loginID),array('status'=>2));
			$this->Fans_model->update_by_where(array('userid'=>$this->loginID,'fansuserid'=>$mid),array('status'=>2));
		}

		$this->view->json($res);
	}

}