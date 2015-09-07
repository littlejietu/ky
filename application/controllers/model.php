<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Controller {

	
	public function index()
	{
		/*
		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array('status'=>1,'b.photonum>'=>0);

		$this->load->model('User_model');
		$this->load->model('Photo_model');
		$dbprefix = $this->User_model->db->dbprefix;
		$tb = $dbprefix.'user a inner join '.$dbprefix.'user_num b on(a.id=b.userid)';
		$list = $this->User_model->fetch_page($page, $pagesize, $arrWhere,'a.id,a.nickname','a.addtime desc', $tb);

		$alist = array('rows'=>array());
		foreach ($list['rows'] as $key => $value) {
			$rs = $this->Photo_model->fetch_page(1, 5, array('userid'=>$value['id'],'status'=>1),'img');
			$value['photolist'] = $rs['rows'];
			$alist['rows'][]=$value;
		}

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('model', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$alist['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $alist,
			);
		*/
		$get_style = (int)$this->input->get('style');
		$get_sex = (int)$this->input->get('sex');
		$get_area = (int)$this->input->get('area');
		$get_height = $this->input->get('height');
		$get_orderby = $this->input->get('orderby');

		
		$page     = _get_page();
		$pagesize = 12;
		$arrParam = array();
		$arrWhere = array('status'=>1,'showimg<>'=>"''",'showimg2<>'=>"''");
		if($get_style)
		{
			$arrWhere["concat(',',style,',') like "]="'%,".$get_style.",%'";
			$arrParam['style']=$get_style;
		}
		if($get_sex)
		{
			$arrWhere['sex']=$get_sex;
			$arrParam['sex']=$get_sex;
		}
		if($get_area)
		{
			$arrWhere['area']=$get_area;
			$arrParam['area']=$get_area;
		}
		if($get_height)
		{
			$arrHeightParam = explode('-', $get_height);
			if(count($arrHeightParam)==2)
			{
				if($arrHeightParam[0])
					$arrWhere['height>=']=$arrHeightParam[0];
				if($arrHeightParam[1])
					$arrWhere['height<=']=$arrHeightParam[1];
			}
			else
				$arrWhere['height>']=$get_height;
			
			$arrParam['height']=$get_height;
		}
		$orderby = 'visitnum desc,addtime desc';
		if($get_orderby)
		{
			$arrParam['orderby']=$get_orderby;
			switch ($get_orderby) {
				case 1:
					$orderby = 'addtime desc';
					break;
				case 2:
					$orderby = 'fansnum desc';
					break;
				case 3:
					$orderby = 'be_ordernum desc';
					break;
				
				default:
					$orderby = 'addtime desc';
					break;
			}
			
		}

		$this->load->model('User_model');
		$dbprefix = $this->User_model->db->dbprefix;
		$tb = $dbprefix.'user a left join '.$dbprefix.'user_detail b on(a.id=b.userid) left join '.$dbprefix.'user_num c on(a.id=c.userid)';
		$list = $this->User_model->fetch_page($page, $pagesize, $arrWhere,'a.id,nickname,showimg,showimg2',$orderby, $tb);

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('model', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		$oSysModelstyle = _get_config('modelstyle');

		$result = array(
			'list' => $list,
			'oSysModelstyle'=>$oSysModelstyle,
			'arrParam'=>$arrParam,
			);

		$this->load->view('model',$result);
	}
}