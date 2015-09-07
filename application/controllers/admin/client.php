<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends MY_Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Client_model');
    }
	
    //默认执行index
	public function index()
	{
		
		$field = $this->input->get_post('field');
		$cKey = $this->input->get_post('txtKey');
		$fieldDate = $this->input->get_post('fieldDate');
		$begtime = $this->input->get_post('begtime');
		$endtime = $this->input->get_post('endtime');
		$orderby = $this->input->get_post('orderby');

		if($field=='li_nkman')
			$field = 'linkman';

		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();

		
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
			$arrWhere["$fieldDate >="] = strtotime($begtime);
		}
		if($endtime)
		{
			$arrParam['endtime'] = $endtime;
			$arrWhere["$fieldDate <="] = strtotime("$endtime 23:59:59");
		}
		$strOrder = 'addtime desc';
		if($orderby)
		{
			$arrParam['orderby'] = $orderby;
			$strOrder = $orderby;
		}


		$list = $this->Client_model->fetch_page($page, $pagesize, $arrWhere, '*', $strOrder);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/client', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			'arrParam' => $arrParam,
			);


		$this->load->view('admin/client',$result);
	}

	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();

		if(!empty($id))
		{
			$info = $this->Client_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				);
		}
		

		$this->load->view('admin/client_add', $result);
	}

	public function save()
	{
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
               
                array(
                     'field'   => 'linkman', 
                     'label'   => '联系人', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'contact', 
                     'label'   => '联系方式', 
                     'rules'   => 'trim|required'
                  ),  
               
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				$data = array(
					'linkman'=>$this->input->post('linkman'),
					'contact'=>$this->input->post('contact'),
					'memo'=>$this->input->post('memo'),					
					'addtime'=>time(),					
					'status'=>$this->input->post('status'),					
				);

  				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;

  				$this->Client_model->insert($data);

				//echo '成功,<a href="/admin/aa">返回列表页</a>';
				redirect(base_url('/admin/client'));
				exit;
  			}
  			else
  			{
  				$id	= _get_key_val($this->input->get('id'), TRUE);
				$result = array();

				if(!empty($id))
				{
					$info = $this->Client_model->get_info_by_id($id);
					$result = array(
						'info'=>$info,
						);
				}
  				$this->load->view('admin/client_add',$result);
  				//redirect('/admin/link/add?id='.$this->input->get('id'));
  			}
			



		}
	}

	function del(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->Client_model->delete_by_id($id);
		redirect( base_url('/admin/client?page='.$page) );

	}
}
