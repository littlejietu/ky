<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		//echo '正在建设中..';die;
		//header('location:'.base_url('model') );

		$this->load->model('Ad_model');
		$adlist = $this->Ad_model->get_ads_by_code('home_top_banner');

		$this->load->model('Recommend_model');
		
		$arrWhere = array('usertype'=>1,'status'=>1,'userlevel'=>1,'sex'=>2);
		$feild = 'user.id,nickname,userlogo,company,showimg,showimg2';
		$rmdlist1 = $this->Recommend_model->get_user_list($arrWhere, $feild, 10);

		$arrWhere = array('usertype'=>1,'status'=>1,'userlevel'=>0,'sex'=>2);
		$rmdlist2 = $this->Recommend_model->get_user_list($arrWhere, $feild, 10);

		$arrWhere = array('usertype'=>1,'status'=>1,'userlevel'=>1,'sex'=>1);
		$rmdlist3 = $this->Recommend_model->get_user_list($arrWhere, $feild, 10);

		$arrWhere = array('usertype'=>1,'status'=>1,'userlevel'=>0,'sex'=>1);
		$rmdlist4 = $this->Recommend_model->get_user_list($arrWhere, $feild, 10);

		$arrWhere = array('usertype'=>2,'status'=>1,'userlevel'=>0);
		$rmdlist5 = $this->Recommend_model->get_user_list($arrWhere, $feild, 10);

		$this->load->model('Recommend_model');
		$fields = 'activity.id,title,img,summary,workfee,activity.addtime,begtime,endtime,inendtime,img,place,address,actnum,innum,innumfake';
		$arrWhere = array('type'=>1,'status'=>1,'display'=>1);
		$actlist1 = $this->Recommend_model->get_act_list($arrWhere, $fields, 4);
		$arrWhere = array('type'=>2,'status'=>1,'display'=>1);
		$actlist2 = $this->Recommend_model->get_act_list($arrWhere, $fields, 4);
		$arrWhere = array('type'=>3,'status'=>1,'display'=>1);
		$actlist3 = $this->Recommend_model->get_act_list($arrWhere, $fields, 4);
		$oSysAct = _get_config('activity');

		$result = array(
			'adlist' => $adlist,
			'rmdlist1' => $rmdlist1,
			'rmdlist2' => $rmdlist2,
			'rmdlist3' => $rmdlist3,
			'rmdlist4' => $rmdlist4,
			'rmdlist5' => $rmdlist5,
			'actlist1' => $actlist1,
			'actlist2' => $actlist2,
			'actlist3' => $actlist3,
			'oSysAct' => $oSysAct,
			);
		$this->load->view('home',$result);
	}

/*
	public function model(){
		$type = $this->input->get('type');
		$type = $type==0?1:$type;
		$this->load->model('Recommend_model');
		$arrWhere = array('type'=>$type,'status'=>1,'display'=>1,'img2<>'=>'');
		$actlist = $this->Recommend_model->get_act_list($arrWhere, 'activity.id,title,img2,summary,activity.addtime', 10);
		$oAct = array();
		if(!empty($actlist))
		{
			$oAct = $actlist[0];
			unset($actlist[0]);
		}

		$result = array(
			'actlist' => $actlist,
			'oAct' => $oAct,
			);
		$this->load->view('homemodel',$result);
	}
*/


	public function expired(){
		$this->load->view('homeexpired');
	}
}

