<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ins extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    public function index()
    {
        $get_type = (int)$this->input->get('type');
        
        $page     = _get_page();
        $pagesize = 15;
        $arrParam = array();
        $arrWhere = array('status'=>1,'usertype'=>2);
        if($get_type)
        {
            $arrWhere["concat(',',type,',') like "]="'%,".$get_type.",%'";
            $arrParam['type']=$get_type;
        }

        $dbprefix = $this->User_model->db->dbprefix;
        $tb = $dbprefix.'user a left join '.$dbprefix.'user_detail b on(a.id=b.userid)';
        $list = $this->User_model->fetch_page($page, $pagesize, $arrWhere, 'a.id,company,nickname,showimg','addtime desc', $tb);
        //echo $this->User_model->db->last_query();die;
        

        //分页
        $pagecfg = array();
        $pagecfg['base_url']     = _create_url('ins', $arrParam);
        $pagecfg['total_rows']   = $list['count'];
        $pagecfg['cur_page'] = $page;
        $pagecfg['per_page'] = $pagesize;
        //$this->load->library('pagination');
        $this->pagination->initialize($pagecfg);
        $list['pages'] = $this->pagination->create_links();

        $oSysType = _get_config('type');
        $oSysType = $oSysType[2];

        $result = array(
            'list' => $list,
            'oSysType' => $oSysType,
            'arrParam' => $arrParam,
            );


        $this->load->view('ins',$result);
    }

}
