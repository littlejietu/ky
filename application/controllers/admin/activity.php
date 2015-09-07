<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends MY_Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Activity_model');
    }
	
    //默认执行index
	public function index()
	{
		$type = $this->input->get_post('type');
		$field = $this->input->get_post('field');
		$cKey = $this->input->get_post('txtKey');
		$fieldDate = $this->input->get_post('fieldDate');
		$begtime = $this->input->get_post('begtime');
		$endtime = $this->input->get_post('endtime');
		$orderby = $this->input->get_post('orderby');

		if($field=='ti_tle')
			$field = 'title';

		$dbprefix = $this->Activity_model->db->dbprefix;
		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();

		if($type)
		{
			$arrParam['type'] = $type;
			$arrWhere['type'] = $type;
		}
		
		if($cKey)
		{
			$arrParam['key'] = $cKey;
			if($field=='userid')
				$arrWhere[$field] = $cKey;
			else
				$arrWhere[$field.' like '] = "'%$cKey%'";
		}
		$arrParam['field'] = $field;
		$arrParam['fieldDate'] = $fieldDate;

		if($begtime)
		{
			$arrParam['begtime'] = $begtime;
			$arrWhere["a.$fieldDate >="] = strtotime($begtime);
		}
		if($endtime)
		{
			$arrParam['endtime'] = $endtime;
			$arrWhere["a.$fieldDate <="] = strtotime("$endtime 23:59:59");
		}
		$strOrder = 'a.id desc';
		if($orderby)
		{
			$arrParam['orderby'] = $orderby;
			$strOrder = $orderby;
		}

		$tb = $dbprefix.'activity a left join '.$dbprefix.'recommend b on(b.outerid=a.id and b.kind=2)';
		$list = $this->Activity_model->fetch_page($page, $pagesize, $arrWhere, 'a.*,(b.id is not null) as isrecommend', $strOrder,$tb);
		//echo $this->db->last_query();die;
		$oSysActType = _get_config('activity');

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/activity', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			'oSysActType' => $oSysActType,
			'arrParam' => $arrParam,
			);


		$this->load->view('admin/activity',$result);
	}

	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();

		if(!empty($id))
		{
			$oSysActType = _get_config('activity');
			$info = $this->Activity_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				'oSysActType' => $oSysActType,
				);
		}
		

		$this->load->view('admin/activity_add', $result);
	}

	public function save()
	{
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
               array(
                     'field'   => 'title', 
                     'label'   => '活动名称', 
                     'rules'   => 'trim|required'
                  ),
                array(
                     'field'   => 'type', 
                     'label'   => '活动类型', 
                     'rules'   => 'trim|required'
                  ),
               	array(
                     'field'   => 'img', 
                     'label'   => '活动图片', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'begtime', 
                     'label'   => '开始时间', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'endtime', 
                     'label'   => '结束时间', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'place', 
                     'label'   => '地点', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'display', 
                     'label'   => '显示', 
                     'rules'   => 'trim|required'
                  ),  
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{

  				$data = array(
					'title'=>$this->input->post('title'),
					'type'=>$this->input->post('type'),
					'img'=>$this->input->post('img'),
					'summary'=>$this->input->post('summary'),
					'workfee'=>$this->input->post('workfee'),
					'begtime'=>strtotime($this->input->post('begtime')),
					'endtime'=>strtotime($this->input->post('endtime')),
					'inendtime'=>strtotime($this->input->post('inendtime')),
					'place'=>$this->input->post('place'),
					'address'=>$this->input->post('address'),
					'actnum'=>(int)$this->input->post('actnum'),
					'innumfake'=>$this->input->post('innumfake'),
					'innum'=>$this->input->post('innum'),
					'addtime'=>time(),
					'display'=>$this->input->post('display'),
					'status'=>1,
					'op_userid'=>$this->session->userdata['admin_id'],
					'op_username'=>$this->session->userdata['user_name'],
					'op_time'=>time(),
				);

  				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;

  				$this->Activity_model->insert($data);

				//echo '成功,<a href="/admin/aa">返回列表页</a>';
				redirect(base_url('/admin/activity'));
				exit;
  			}
  			else
  			{
  				$id	= _get_key_val($this->input->get('id'), TRUE);
				$result = array();

				if(!empty($id))
				{
					$info = $this->Activity_model->get_info_by_id($id);
					$result = array(
						'info'=>$info,
						);
				}
  				$this->load->view('admin/activity_add',$result);
  				//redirect('/admin/link/add?id='.$this->input->get('id'));
  			}
			



		}
	}

	function del(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->Activity_model->delete_by_id($id);
		redirect( base_url('/admin/activity?page='.$page) );

	}

	function recommend(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->load->model('Recommend_model');
		$this->Recommend_model->do_recommend(2,$id);

		redirect( base_url('/admin/activity?page='.$page) );

	}
}
