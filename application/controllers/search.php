<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    
    public function index()
    {

        $get_keyword = $this->input->post('keyword')?$this->input->post('keyword'):$this->input->get('keyword');

        $page     = _get_page();
        $pagesize = 3;
        $arrParam = array();
        $arrWhere = array('status'=>1,'showimg<>'=>"''",'showimg2<>'=>"''");

        if($get_keyword)
        {
            $arrParam['keyword']=$get_keyword;
            $arrWhere['@like']=array('nickname'=>$get_keyword);
        }

        $this->load->model('User_model');
        $list = $this->User_model->fetch_page($page, $pagesize, $arrWhere,'id,nickname,showimg,showimg2','addtime desc');

        //分页
        $pagecfg = array();
        $pagecfg['base_url']     = _create_url('model', $arrParam);
        $pagecfg['total_rows']   = $list['count'];
        $pagecfg['cur_page'] = $page;
        $pagecfg['per_page'] = $pagesize;
        //$this->load->library('pagination');
        $this->pagination->initialize($pagecfg);
        $list['pages'] = $this->pagination->create_links();

        $result = array(
            'list' => $list,
            );

        $this->load->view('search',$result);
    }
}