<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ad_place extends MY_Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Ad_place_model');
    }
	
    //默认执行index
	public function index()
	{
		
		$field = $this->input->get_post('field');
		$cKey = $this->input->get_post('txtKey');

		if($field=='ti_tle')
			$field = 'title';

		$page     = _get_page();
		$pagesize = 3;
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
		

		
		

		$list = $this->Ad_place_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/ad_place', $arrParam);
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


		$this->load->view('admin/ad_place',$result);
	}

	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();

		if(!empty($id))
		{
			$info = $this->Ad_place_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				);
		}
		

		$this->load->view('admin/ad_place_add', $result);
	}

	public function save()
	{
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
               array(
                     'field'   => 'title', 
                     'label'   => '广告位名称', 
                     'rules'   => 'trim|required'
                  ),
                array(
                     'field'   => 'adcode', 
                     'label'   => '广告代码', 
                     'rules'   => 'trim|required'
                  ),
               array(
                     'field'   => 'size', 
                     'label'   => '广告尺寸', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'status', 
                     'label'   => '是否停用', 
                     'rules'   => 'trim|required'
                  ),  
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				$data = array(
					'title'=>$this->input->post('title'),
					'price'=>$this->input->post('price'),
					'adcode'=>$this->input->post('adcode'),
					'size'=>$this->input->post('size'),
					'status'=>$this->input->post('status'),
				);

  				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;

  				$this->Ad_place_model->insert($data);

				//echo '成功,<a href="/admin/aa">返回列表页</a>';
				redirect(base_url('/admin/ad_place'));
				exit;
  			}
  			else
  			{
  				$id	= _get_key_val($this->input->get('id'), TRUE);
				$result = array();

				if(!empty($id))
				{
					$info = $this->Ad_place_model->get_info_by_id($id);
					$result = array(
						'info'=>$info,
						);
				}
  				$this->load->view('admin/ad_place_add',$result);
  				//redirect('/admin/ad_place/add?id='.$this->input->get('id'));
  			}
			



		}
	}

	function del(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->Ad_place_model->delete_by_id($id);
		redirect( base_url('/admin/ad_place?page='.$page) );

	}
}
