<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class indexAction extends MY_Admin_Controller {
    function __construct(){
        parent::__construct();
    }
	public function index()
	{
        $this->load->model('admin/indexmodel');
        //取头部管理员数据
        $userInfo       = $this->indexmodel->getUserInfo($this->session->userdata('admin_id'));

        //根据管理员处理应该显示的左侧
        $myLeft         = $this->getLeft();

        $data           = array(
            'leftList'      => $myLeft,
            'userInfo'      => $userInfo,
        );
        $this->load->view('admin/index',$data);
	}

    /*首页*/
    public function indexPage($page='1'){
        $this->load->helper('url');
        $this->load->model('admin/indexmodel');
        /*取公告信息*/
        $noticeClassId  = '297';
        $noticeNum      = $this->indexmodel->getNoticeNum($noticeClassId);
        //分页
        $perPage        = 20;
        $pageArr        = array(
            'page'          => $page,
            'total'         => $noticeNum,
            'url'           => '/admin/indexaction/indexpage/',
            'perPage'       => $perPage,
            'maxSize'       => $page,
            'isFirst'       => 1,
            'isprev'        => 1,
            'prevClass'     => 'syy',
            'nextClass'     => 'xyy',
            'firstClass'    => 'sy',
            'endClass'      => 'my',
        );
        $this->load->library('page');
        $pageClass      = new page();
        $pageHtml       = $pageClass->data($pageArr);

        //取当前页信息
        $noticeList     = $this->indexmodel->getNoticeList($noticeClassId,$page,$perPage);

        $data           = array(
            'noticeList'    => $noticeList,
            'pageHtml'      => $pageHtml,
        );
        $this->load->view('admin/indexpage',$data);
    }

    /*根据管理员处理应该显示的左侧*/
    public function getLeft(){
        $myLeft         = $this->systemList;
        if($this->session->userdata['user_level'] > 0 ){
            $myPower        = explode(',',$this->session->userdata['user_power']);
            foreach($myLeft as $k => $v){
                foreach($v as $key => $value){
                    if(!in_array($value->sys_id,$myPower)){
                        unset($myLeft[$k][$key]);
                    }
                }
            }
        }
        return $myLeft;
    }

    /*左侧目录*/
    public function leftList(){
        $myLeft        = $this->getLeft();
        $data = array(
            'myLeft'    => $myLeft,
            'userLevel' => $this->session->userdata['user_level'],
        );
        $this->load->view('admin/systemcore/sysleft',$data);
    }

    /*添加-编辑左侧目录*/
    public function addLeft($act='',$id=''){
        $act            = empty($_REQUEST['act'])?$act:$_REQUEST['act'];
        $id             = (empty($id) or !is_numeric($id))?@$_POST['id']:$id;

        $sysPartId  = 0;
        if($act == 'add'){
            $this->load->model('admin/indexmodel');
            //参数接收
            $sysPartId  = @$_POST["sys_partid"];
            $sysName    = @$_POST["sys_name"];
            $sysLink    = @$_POST["sys_link"];
            $isShow     = @$_POST["is_show"];
            if(!empty($id)){//编辑
                if(!empty($sysName)){
                    //查找该分类的step
                    if($sysPartId == '0' or empty($sysPartId)){
                        $sysStep = 0;
                    }else{
                        $sysStep = $this->indexmodel->leftStep($sysPartId);
                    }

                    $sqlInfo    = array(
                        'sysPartId' => $sysPartId,
                        'sysName'   => $sysName,
                        'is_show'   => $isShow,
                        'sysLink'   => $sysLink,
                        'sysStep'   => $sysStep,
                    );
                    $this->indexmodel->editLeft($sqlInfo,$id);
                }
            }else{//添加
                if(!empty($sysName)){
                    //查找该分类的step
                    if($sysPartId == '0' or empty($sysPartId)){
                        $sysStep = 0;
                    }else{
                        $sysStep = $this->indexmodel->leftStep($sysPartId);
                    }

                    $sqlInfo    = array(
                        'sysPartId' => $sysPartId,
                        'sysName'   => $sysName,
                        'is_show'   => $isShow,
                        'sysLink'   => $sysLink,
                        'sysStep'   => $sysStep,
                    );
                    $this->indexmodel->addLeft($sqlInfo);
                }
            }
        }

        /*编辑左侧列表*/
        $leftInfo = '';
        if(!empty($id) && is_numeric($id)){//取left栏目的详细信息
            $leftInfo = $this->indexmodel->getLeftInfo($id);
        }

        $leftList       = $this->getLeft();
        $data           = array(
            'leftList'    => $leftList,
            'sysPartId'   => $sysPartId,
            'leftInfo'    => $leftInfo
        );
        $this->load->view('admin/systemcore/addleft',$data);
    }

    /*客服页面*/
    public function onlineService(){

    }

    /*财务中心*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */