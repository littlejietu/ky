<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class userAction extends MY_Admin_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('admin/UserModel');
        $user_level = $this->session->userdata('user_level');
        $userList = $this->UserModel->getUser($user_level);
        /*用户权限改为文字显示*/
        $powerList = $this->UserModel->getPowerList(); //全部权限列表
        //全部权限列表转换成一维数组
        $powerArr = array();
        foreach ($powerList as $value) {
            $powerArr[$value->sys_id] = $value->sys_name;
        }

        foreach ($userList as $key => $value) {
            $tempArr = explode(',', $value->user_power);
            foreach ($tempArr as $k => $v) {
                $tempArr[$k] = isset($powerArr[$v]) ? $powerArr[$v] : '';
            }
            $tempArr = array_filter($tempArr);
            $userList[$key]->user_power = implode(',', $tempArr);
        }

        $data['userList'] = $userList;
        $this->load->view('admin/system/userlist', $data);
    }

    /*登录页面*/
    public function login()
    {
        /*
        //phpinfo();
        //$code = $this->verify_image();
        $loginCodeSession = array(
            'login_code' => self::setMd5(strtolower($code['word'])),
        );

        $this->session->set_userdata($loginCodeSession);
        $data = array(
            'code' => $code,
        );
        */
        $this->load->view('admin/login');
    }

    /**
     * ajax获取验证码
     
    public function ajaxGetVerify()
    {
        //$code = $this->verify_image();
        $loginCodeSession = array(
            'login_code' => self::setMd5(strtolower($code['word'])),
        );
        $this->session->set_userdata($loginCodeSession);
        //echo $code['image'];
    }
*/
    /**
     * ajax登录
     */
    public function ajaxLogin()
    {
        $this->load->model('admin/UserModel');

        $userName = $_POST['username']; //过滤特殊字符和html标签
        $password = self::setMd5($_POST['password']);
        $code = $this->input->post('code');

        //
        if (!$code)
        {
            echo 'code_error';
            exit;
        }
        $this->load->helper('captcha');

        if (!check_captcha($code,'verify_adm'))
        {
            echo 'code_error';
            exit;
        }

        $userInfo = $this->UserModel->getAdminUserInfoByUserName($userName);

        if (!$this->UserModel->isNotEmpty($userInfo)) { //没有该用户
            echo 'no_user';
            exit;
        }
        if ($userInfo[0]->is_lock == 1) { //是否锁定
            echo 'is_lock';
            exit;
        }
        if ($password != $userInfo[0]->user_password) { //密码错误
            echo 'password_error';
            exit;
        }


        /*登录通过*/
        $loginSuccessSession = array(
            'admin_id' => $userInfo[0]->user_id,
            'user_name' => $userInfo[0]->user_name,
            'user_level' => $userInfo[0]->user_level,
            'user_power' => $userInfo[0]->user_power,
        );
        $this->session->set_userdata($loginSuccessSession);

        /*更新用户最后登录时间和登录IP*/
        $userIp = $this->get_real_ip();
        $filter = array(
            'userIp' => $userIp,
            'nowTime' => time(),
            'userId' => $userInfo[0]->user_id,
        );

        $this->UserModel->updateUserLastLoginTimeAndIp($filter);
        echo 'success';
    }

    /**
     * 添加管理员
     */
    public function addUser($action = '', $userId = '')
    {

        $this->load->model('admin/UserModel');
        $action = (empty($_POST['action'])) ? $action : $_POST['action'];
        $userId = (empty($_POST['userId'])) ? $userId : $_POST['userId'];
        if ($action == 'edit') {
            $edit = empty($_POST['edit']) ? '' : $_POST['edit'];
            if ($edit == 1) { //保存编辑的数据
                /*参数接收*/
                $userName = $_POST['username'];
                $userPassword = self::setMd5($_POST['password']);
                $userEmail = $_POST['email'];
                $userPower = $_POST['userpower'];
                $userTel = $_POST['tel'];
                $realName = $_POST['realname'];

                //保存至admin表
                $userinfo = array(
                    'user_name' => $userName,
                    'user_password' => $userPassword,
                    'user_email' => $userEmail,
                    'user_tel' => $userTel,
                    'user_real_name' => $realName,
                    'user_level' => $userPower,
                    'userId' => $userId,
                );
                $this->UserModel->editUser($userinfo);
                echo 'success';
            } else { //取要编辑的数据
                $userInfo = $this->UserModel->getUserInfoByUserId($userId);
                $data = array(
                    'userInfo' => $userInfo,
                );
                $this->load->view('admin/system/edituser', $data);
            }
        } elseif ($action == 'adduser') {
            /*参数接收*/
            $userName = $_POST['username'];
            $userPassword = self::setMd5($_POST['password']);
            $userEmail = $_POST['email'];
            $userPower = $_POST['userpower'];
            $userTel = $_POST['tel'];
            $realName = $_POST['realname'];

            $notHavaThisUser = $this->UserModel->notHaveThisUser($userName);
            if ($notHavaThisUser) {
                //保存至admin表
                $userinfo = array(
                    'user_name' => $userName,
                    'user_password' => $userPassword,
                    'user_email' => $userEmail,
                    'user_level' => $userPower,
                    'user_tel' => $userTel,
                    'user_real_name' => $realName,
                );
                $this->UserModel->addUser($userinfo);
                echo 'success';
            } else {
                echo 'false';
            }
        } else {
            $data = array();
            $this->load->view('admin/system/adduser', $data);
        }
    }

    /**
     *改变用户的锁定状态
     */
    public function changeLock()
    {

        $this->load->model('UserModel');
        $lockType = $_POST['lockType'];
        $userId = $_POST['userId'];

        /*验证传递过来的lockType*/
        if ($lockType != 0 && $lockType != 1) {
            echo json_encode('false');
            return;
        }

        /*验证传递过来的userid*/
        if (!is_numeric($userId)) {
            echo json_encode('false');
            return;
        }

        /*改变lock值*/
        $filter = array(
            'userId' => $userId,
            'is_lock' => $lockType,
        );
        $this->UserModel->updateLock($filter);
        echo json_encode('success');
        return;
    }

    /*删除管理员*/
    public function delAdmin()
    {

        $userId = $_POST['userId'];
        $this->load->model('admin/UserModel');
        $this->UserModel->deleteAdmin($userId);
        echo json_encode('success');
        return;
    }

    /*分配权限*/
    public function givePower($userId)
    {
        $this->load->model('admin/UserModel');
        $this->load->model('admin/IndexModel');
        //保存分配的权限
        $act = empty($_POST['act']) ? '' : $_POST['act'];
        if ($act == 'save') {
            $userId = empty($_POST['userId']) ? '' : $_POST['userId'];
            $first = empty($_POST['first']) ? '' : $_POST['first'];
            $second = empty($_POST['second']) ? '' : $_POST['second'];
            if (!empty($first) && !empty($second)) {
                $power = implode(',', $first) . ',' . implode(',', $second);
                $this->UserModel->givePower($userId, $power);
                //如果是给自己分配权限，立刻更新session
                if ($userId == $this->session->userdata['admin_id']) {
                    $loginSuccessSession = array(
                        'user_power' => $power,
                    );
                    $this->session->set_userdata($loginSuccessSession);
                }

            }
        }

        //取用户信息
        $userInfo = $this->UserModel->getUserInfoByUserId($userId);
        //则取出自己权限内的左侧
        $myLeft = $this->IndexModel->getLeft($this->session->userdata['user_level'], $this->session->userdata['user_power']);
        $data = array(
            'power' => $myLeft,
            'userInfo' => $userInfo,
            'userId' => $userId,
        );

        //如果是超管 赋予全部权限
        if ($this->session->userdata['user_level'] == 0) {
            $data['power'] = $this->systemList;
        }

        $this->load->view('admin/system/givepower', $data);
    }

    /*退出登录*/
    public function logout()
    {
        $loginSuccessSession = array(
            'admin_id' => '',
            'user_level' => '',
            'user_power' => '',
        );
        $this->session->set_userdata($loginSuccessSession);
        echo json_encode('success');
    }

    /**
     *读取用户收藏产品信息
     */
    public function getCollectList($page = 1)
    {
        $this->load->model('admin/usermodel');
        $page = ($page > 0) ? $page : 1;
        $where[] = 'type = 1'; //组装 查询条件
        $collectNum = $this->usermodel->getCollectNum($where);
        $perPage = 10;
        $pageArr = array(
            'page' => $page,
            'total' => $collectNum,
            'url' => base_url() . 'useraction/getCollectList/', //路径
            'perPage' => $perPage, //每页显示多少条数据
            'maxSize' => 5, //分页显示多长
            'isFirst' => 1, //是否显示首页尾页
            'isprev' => 1, //是否显示上一页下一页
            'prevClass' => 'syy', //上一页class
            'nextClass' => 'xyy', //下一页的class
            'firstClass' => 'sy', //首页的class
            'endClass' => 'my', //尾页的class
        );

        $this->load->library('page');
        $pageClass = new page();

        $pageHtml = $pageClass->data($pageArr);
        $collectList = $this->usermodel->getCollectList($page, $perPage, $where);

        //读取用户名
        foreach ($collectList as $key => $v) {
            $username = $this->usermodel->getUserNikeName($v->user_id);
            $collectList[$key]->user_name = $username;
        }

        $data = array(
            'collectList' => $collectList,
            'pageHtml' => $pageHtml,
        );
        $this->load->view('admin/system/myCollection', $data);
    }

    /**
     *读取收藏文章
     */
    public function  getCollectionArticleList($page = 1)
    {
        $this->load->model('admin/usermodel');
        $page = ($page > 0) ? $page : 1;
        $where[] = 'type =2'; //组装 查询条件
        $collectNum = $this->usermodel->getCollectNum($where);

        $perPage = 10;
        $pageArr = array(
            'page' => $page,
            'total' => $collectNum,
            'url' => base_url() . 'useraction/getCollectionArticleList/',
            'perPage' => $perPage, //每页显示多少条数据
            'maxSize' => 5, //分页显示多长
            'isFirst' => 1, //是否显示首页尾页
            'isprev' => 1, //是否显示上一页下一页
            'prevClass' => 'syy', //上一页class
            'nextClass' => 'xyy', //下一页的class
            'firstClass' => 'sy', //首页的class
            'endClass' => 'my', //尾页的class
        );

        $this->load->library('page');
        $pageClass = new page();

        $pageHtml = $pageClass->data($pageArr);
        $collectList = $this->usermodel->getCollectList($page, $perPage, $where);
        //读取用户名
        foreach ($collectList as $key => $v) {
            $username = $this->usermodel->getUserNikeName($v->user_id);
            $collectList[$key]->user_name = $username;
        }
        $data = array(
            'collectList' => $collectList,
            'pageHtml' => $pageHtml,
        );
        $this->load->view('admin/system/myCollectionArticle', $data);
    }

    /**
     * 根据ID删除收藏
     * */
    public function deleteCollect()
    {
        $this->load->model('admin/usermodel');
        $ct_id = $this->input->get_post('id');
        //判断接受ID是否有值
        if (!empty($ct_id)) {
            $boolCt = $this->usermodel->deleteCollect($ct_id);
            if ($boolCt) {
                msg('删除成功！', base_url('system/myCollectionArticle/'), 2, 2000);
            } else {
                msg('删除失败！', base_url('system/myCollectionArticle/'), 2, 2000);
            }
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */