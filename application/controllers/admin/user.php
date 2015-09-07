<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
	
    //默认执行index
	public function index()
	{
		$usertype = $this->input->get_post('usertype');
		$userlevel = $this->input->get_post('userlevel');
		$field = $this->input->get_post('field');
		$cKey = $this->input->get_post('txtKey');
		$fieldDate = $this->input->get_post('fieldDate');
		$begdate = $this->input->get_post('begdate');
		$enddate = $this->input->get_post('enddate');
		$orderby = $this->input->get_post('orderby');


		$dbprefix = $this->User_model->db->dbprefix;
		$page     = _get_page();
		$pagesize = 20;
		$arrParam = array();
		$arrWhere = array('a.status !='=>2);

		if($usertype)
		{
			$arrParam['usertype'] = $usertype;
			$arrWhere['usertype'] = $usertype;
		}
		if($userlevel)
		{
			$arrParam['userlevel'] = $userlevel;
			$arrWhere['userlevel'] = $userlevel;
		}
		if($cKey)
		{
			$arrParam['key'] = $cKey;
			$arrWhere[$field.' like '] = "'%$cKey%'";
		}
		$arrParam['field'] = $field;
		$arrParam['fieldDate'] = $fieldDate;
		if($begdate)
		{
			$arrParam['begdate'] = $begdate;
			$arrWhere["a.$fieldDate >="] = strtotime($begdate);
		}
		if($enddate)
		{
			$arrParam['enddate'] = $enddate;
			$arrWhere["a.$fieldDate <="] = strtotime("$enddate 23:59:59");
		}
		$strOrder = 'a.id desc';
		if($orderby)
		{
			$arrParam['orderby'] = $orderby;
			$strOrder = $orderby;
		}


		//$tb = $dbprefix.'user a left join '.$dbprefix.'user_detail b on(a.id=b.userid) left join '.$dbprefix.'recommend c on(c.outerid=a.id and c.kind=1)';
		$tb = $dbprefix.'user a left join '.$dbprefix.'recommend b on(b.outerid=a.id and b.kind=1)';
		$list = $this->User_model->fetch_page($page, $pagesize, $arrWhere, 'a.*,(b.id is not null) as isrecommend ',$strOrder, $tb);
		//echo $this->db->last_query();die;

		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/user', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$oSysUsertype = _get_config('usertype');
		$oSysUserlevel = _get_config('userlevel');

		$result = array(
			'list' => $list,
			'oSysUsertype' => $oSysUsertype,
			'oSysUserlevel' => $oSysUserlevel,
			'arrParam' => $arrParam,
			);


		$this->load->view('admin/user',$result);
	}

	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();
		$info = array();

		$oSysType = array();
		if(!empty($id))
		{
			$info = $this->User_model->get_info_by_id($id);

			if($info)
			{
				$oSysType = _get_config('type');
	        	$oSysType = $oSysType[$info['usertype']];
	        }
			
		}

		$oSysUsertype = _get_config('usertype');
		$oSysUserlevel = _get_config('userlevel');
		$oSysModelstyle = _get_config('modelstyle');
		$result = array(
				'info'=>$info,
				'oSysUsertype' => $oSysUsertype,
				'oSysUserlevel' => $oSysUserlevel,
				'oSysType' => $oSysType,
				'oSysModelstyle' => $oSysModelstyle,
			);
		

		$this->load->view('admin/user_add', $result);
	}

	public function save()
	{
		
		if ($this->input->is_post())
		{
			$usertype = (int)$this->input->post('usertype');
			if($usertype==1)
				list($config, $data, $data_detail, $data_memo) = $this->u_model_config();
			else if( in_array($usertype, array(4,5)) )
				list($config, $data, $data_detail, $data_memo) = $this->u_photo_config();
			else if($usertype==2)
				list($config, $data, $data_detail, $data_memo) = $this->u_ins_config();

			//验证规则
			

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;
				//保存数据库
  				$this->User_model->update_info_by_id($id, $data, $data_detail, $data_memo);

				//echo '成功,<a href="/admin/aa">返回列表页</a>';
				redirect(base_url('/admin/user'));
				exit;
  			}
  			else
  			{
  				$id	= _get_key_val($this->input->get('id'), TRUE);
				$result = array();

				if(!empty($id))
				{
					$info = $this->User_model->get_info_by_id($id);
					$result = array(
						'info'=>$info,
						);
				}
  				$this->load->view('admin/user_add',$result);
  				//redirect('/admin/link/add?id='.$this->input->get('id'));
  			}
			



		}
	}

	function del(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();
		
		$this->User_model->update_by_where(array('id'=>$id),array('status'=>0));

		redirect( base_url('/admin/user?page='.$page) );

	}

	function recommend(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->load->model('Recommend_model');
		$this->Recommend_model->do_recommend(1,$id);

		redirect( base_url('/admin/user?page='.$page) );

	}




	//////////////////////////////
	private function u_model_config(){
		//验证规则		required必填项
		$config = array(
                array(
                     'field'   => 'username', 
                     'label'   => '用户名', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'nickname', 
                     'label'   => '昵称', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'usertype', 
                     'label'   => '用户类型', 
                     'rules'   => 'trim|required'
                  ),
               	array(
                     'field'   => 'userlevel', 
                     'label'   => '用户级别', 
                     'rules'   => 'trim|required'
                  ), 
                array(
                     'field'   => 'height', 
                     'label'   => '身高', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'weight', 
                     'label'   => '体重', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'bust', 
                     'label'   => '胸围', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'waist', 
                     'label'   => '腰围', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'hips', 
                     'label'   => '臀围', 
                     'rules'   => 'trim|required'
                  ),  
            );
		//-验证规则
        

		$style = '';
		if(is_array($this->input->post('style')))
			$style = implode(',', $this->input->post('style'));

		$data = array(
			'username'=>$this->input->post('username'),
			'nickname'=>$this->input->post('nickname'),
			'usertype'=>$this->input->post('usertype'),
			'userlevel'=>$this->input->post('userlevel'),
			
			'userlogo'=>$this->input->post('userlogo'),
			'realname'=>$this->input->post('realname'),					
			//'mobile'=>$this->input->post('mobile'),					
			'sex'=>$this->input->post('sex'),
			'city'=>$this->input->post('city'),	
			'showimg'=>$this->input->post('showimg'),
			'showimg2'=>$this->input->post('showimg2'),
			'qq'=>$this->input->post('qq'),				
		);
		if($this->input->post('password'))
			$data['password'] = md5($this->input->post('password'));


		$data_detail = array(
			'height'=>$this->input->post('height'),
			'weight'=>$this->input->post('weight'),
			'bust'=>$this->input->post('bust'),
			'waist'=>$this->input->post('waist'),
			'hips'=>$this->input->post('hips'),
			'shoes'=>$this->input->post('shoes'),
			'cup'=>$this->input->post('cup'),
			'style'=>$style,
			'province_id'=>(int)$this->input->post('province_id'),
			'city_id'=>(int)$this->input->post('city_id'),
			);
		$data_memo = array(
			'brand'=>$this->input->post('brand'),
			'brandtype'=>$this->input->post('brandtype'),
			'awards'=>$this->input->post('awards'),
			'fee'=>$this->input->post('fee'),
			'servicetime'=>$this->input->post('servicetime'),
			'takenote'=>$this->input->post('takenote'),
			'planeshot'=>$this->input->post('planeshot'),
			'tactivity'=>$this->input->post('tactivity'),
			'telead'=>$this->input->post('telead'),
			'magazine'=>$this->input->post('magazine'),
			'card'=>$this->input->post('card'),
			'bgimg'=>$this->input->post('bgimg'),
			'video'=>$this->input->post('video'),					
			);

		return array($config, $data, $data_detail, $data_memo);


	}

	private function u_photo_config(){
		//验证规则		required必填项
		$config = array(
            array(
                 'field'   => 'sex', 
                 'label'   => '性别', 
                 'rules'   => 'trim|required'
              ),  
        );
		if(!$this->thatUser['nickname'])
			$config[] = array(
                 'field'   => 'nickname', 
                 'label'   => '艺名', 
                 'rules'   => 'trim|required'
              );
		//-验证规则

		$data = array(					
			'userlogo'=>$this->input->post('userlogo'),
			'realname'=>$this->input->post('realname'),					
			//'mobile'=>$this->input->post('mobile'),					
			'sex'=>$this->input->post('sex'),
			'city'=>$this->input->post('city'),
			'mobile'=>$this->input->post('mobile'),
		);

		$data_detail = array(
			'province_id'=>(int)$this->input->post('province_id'),
			'city_id'=>(int)$this->input->post('city_id'),
			);
		$data_memo = array(
			'brand'=>$this->input->post('brand'),
			'brandtype'=>$this->input->post('brandtype'),
			'memo'=>$this->input->post('memo'),
			'fee'=>$this->input->post('fee'),
			'servicetime'=>$this->input->post('servicetime'),
			'takenote'=>$this->input->post('takenote'),
			'bgimg'=>$this->input->post('bgimg'),
			//'video'=>$this->input->post('video'),					
			);

		return array($config, $data, $data_detail, $data_memo);


	}

	private function u_ins_config(){
		//验证规则
		$config = array(
            array(
                 'field'   => 'realname', 
                 'label'   => '联系人姓名', 
                 'rules'   => 'trim|required'
              ),  
            array(
                 'field'   => 'sex', 
                 'label'   => '性别', 
                 'rules'   => 'trim|required'
              ),
            array(
                 'field'   => 'memo', 
                 'label'   => '公司简介', 
                 'rules'   => 'trim|required'
              ),
        );
		//-验证规则

		$type = '';
		if(is_array($this->input->post('type')))
			$type = implode(',', $this->input->post('type'));

		$data = array(					
			'userlogo'=>$this->input->post('userlogo'),
			'showimg'=>$this->input->post('showimg'),
			'realname'=>$this->input->post('realname'),
			'sex'=>$this->input->post('sex'),
			'city'=>$this->input->post('city'),
		);

		$data_detail = array(
			'type'=>$type,
			'province_id'=>(int)$this->input->post('province_id'),
			'city_id'=>(int)$this->input->post('city_id'),
			);

		$data_memo = array(
			'memo'=>$this->input->post('memo'),
			);
				
		return array($config, $data, $data_detail, $data_memo);
	}
	
}
