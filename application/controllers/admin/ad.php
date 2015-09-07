<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ad extends MY_Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Ad_model');
    }
	
    //默认执行index
	public function index()
	{
		$ad_place = $this->input->get_post('ad_place');
		$field = $this->input->get_post('field');
		$cKey = $this->input->get_post('txtKey');
		$fieldDate = $this->input->get_post('fieldDate');
		$begtime = $this->input->get_post('begtime');
		$endtime = $this->input->get_post('endtime');
		$orderby = $this->input->get_post('orderby');
		
		if($field=='ti_tle')
			$field = 'title';

		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array();

		if($ad_place)
		{
			$arrParam['ad_place'] = $ad_place;
			$arrWhere['ad_place'] = $ad_place;
		}
		
		if($cKey)
		{
			$arrParam['key'] = $cKey;
			if($field=='adcode')
				$arrWhere[$field] = "'$cKey'";
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
		$strOrder = 'id desc';
		if($orderby)
		{
			$arrParam['orderby'] = $orderby;
			$strOrder = $orderby;
		}

		$list = $this->Ad_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		$this->load->model('Ad_place_model');
		$ad_placeList = $this->Ad_place_model->get_list(array('status'=>1));
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/Ad', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			'arrParam' => $arrParam,
			'ad_placeList'=>$ad_placeList,
			);


		$this->load->view('admin/Ad',$result);
	}

	public function add()
	{

		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();
		$info = array();

		$this->load->model('Ad_place_model');
		$arrPlace = $this->Ad_place_model->get_list(array('status'=>1));

		if(!empty($id))
		{
			$info = $this->Ad_model->get_info_by_id($id);
		}
		
		$result = array(
				'info'=>$info,
				'arrPlace'=>$arrPlace,
		);
		

		$this->load->view('admin/Ad_add', $result);
	}

	public function save()
	{
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
				array(
                     'field'   => 'title', 
                     'label'   => '广告名称', 
                     'rules'   => 'trim|required'
                  ),  
				array(
                     'field'   => 'placeid', 
                     'label'   => '广告位id', 
                     'rules'   => 'trim|required'
                  ),  
				array(
                     'field'   => 'img', 
                     'label'   => '图片地址', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'url', 
                     'label'   => '链接地址', 
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
                     'field'   => 'display', 
                     'label'   => '显示', 
                     'rules'   => 'trim|required'
                  ),  
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				$placeid = (int)$this->input->post('placeid');
  				$adcode = '';
  				$this->load->model('Ad_place_model');
  				$oPlace = $this->Ad_place_model->get_by_id($placeid);
  				if($oPlace)
  					$adcode = $oPlace['adcode'];
  				//将需要保存的数据赋值给数组$data
  				$data = array(
					'title'=>$this->input->post('title'),
					'placeid'=>$this->input->post('placeid'),
					'adcode'=>$adcode,
					'img'=>$this->input->post('img'),
					'url'=>$this->input->post('url'),
					'summary'=>$this->input->post('summary'),
					'memo'=>$this->input->post('memo'),
					'price'=>$this->input->post('price'),
					'addtime'=>time(),
					'begtime'=>strtotime($this->input->post('begtime')),
					'endtime'=>strtotime($this->input->post('endtime').' 23:59:59'),
					'sort'=>$this->input->post('sort'),
					'display'=>$this->input->post('display'),
					'status'=>1,
					'op_userid'=>$this->session->userdata['admin_id'],
					'op_username'=>$this->session->userdata['user_name'],
					'op_time'=>time(),
				);

  				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;
  				//保存至数据库
  				$this->Ad_model->insert($data);

				//echo '成功,<a href="/admin/aa">返回列表页</a>';
				redirect(base_url('/admin/Ad'));
				exit;
  			}
  			else
  			{
  				$id	= _get_key_val($this->input->get('id'), TRUE);
				$result = array();

				if(!empty($id))
				{
					$info = $this->Ad_model->get_info_by_id($id); //查找
					$result = array(
						'info'=>$info,
						);
				}
  				$this->load->view('admin/Ad_add',$result);
  				//redirect('/admin/link/add?id='.$this->input->get('id'));
  			}
			



		}
	}

	function del(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->Ad_model->delete_by_id($id);
		redirect( base_url('/admin/Ad?page='.$page) );

	}
}
