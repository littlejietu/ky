<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends MY_Model {


    /*取全部权限列表*/
    public function getPowerList(){
        $sqlInfo = array(
            'fields'    => array(
                'sys_id',
                'sys_name',
            ),
            'table'     => 'system',
        );
        $list   = $this->CoreSelect($sqlInfo);
        return (empty($list[0])?array():$list);
    }


    /*更新用户余额*/
    public function updateUserBalance($userId,$userBalance){
        $sqlInfo = array(
            'fields'    => array(
                'user_money'        => $userBalance,
                'last_update'       => time(),
            ),
            'table'     => 'admin_user',
            'where'     => array(
                'user_id  = "' . $userId . '"',
            ),
        );
        $this->CoreUpdate($sqlInfo);
    }

    /*根据ID取用户信息*/
    public function getUserInfoByUserId($userId){
        $sqlInfo = array(
            'fields'    => array(
                'user_id',
                'user_name',
                'user_email',
                'user_tel',
                'user_money',
                'user_real_name',
                'user_password',
                'user_power',
                'user_level',
                'is_lock',
                'last_login_time',
            ),
            'table'     => 'admin_user',
            'where'     => array(
                'user_id = "' . $userId . '"',
                'is_lock = 0'
            ),
        );
        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return empty($list[0])?'':$list[0];
    }

    /*登录取用户信息*/
    public function getAdminUserInfoByUserName($username){
        $sqlInfo = array(
            'fields'    => array(
                'user_id',
                'user_name',
                'user_password',
                'user_power',
                'user_money',
                'user_level',
                'is_lock',
                                ),
            'table'     => 'admin_user',
            'where'     => array(
                'user_name = "' . $username . '"',
                                ),
            'groupby'   => '',
            'order'     => array(

                                 ),
            'limit'     => '',
        );
        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return $list;
    }

    //添加管理员
    public function addUser($userinfo){

        $sqlInfo = array(
            'fields' => array(
                'user_name'         => $userinfo['user_name'],
                'user_email'        => $userinfo['user_email'],
                'user_password'     => $userinfo['user_password'],
                'user_level'        => $userinfo['user_level'],
                'user_tel'          => $userinfo['user_tel'],
                'user_real_name'    => $userinfo['user_real_name'],
                'is_lock'           => 0,
                'add_time'          => time(),
                'last_login_time'   => time(),
            ),
            'table' => 'admin_user',
        );

        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }

        $list = $this->CoreInsert();
        return $list;
    }

    //添加用户验证信息是否存在
    public function notHaveThisUser($username){

        $sqlInfo = array(
            'fields'    => array(
                'user_id',
            ),
            'table'     => 'admin_user',
            'where'     => array(
                'user_name = "' . $username . '"',
            ),
        );

        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        if($this->isNotEmpty($list)){
            return false;
        }else{
            return true;
        }
    }

    /**
     *更新用户最后登录时间和登录IP
     */
    public function updateUserLastLoginTimeAndIp($filter){
        $sqlInfo = array(
            'fields'    => array(
                'last_login_time'   => $filter['nowTime'],
                'last_login_ip'     => $filter['userIp'],
            ),
            'table'     => 'admin_user',
            'where'     => array(
                'user_id  = "' . $filter['userId'] . '"',
            ),
        );
        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }

        $list = $this->CoreUpdate();
        return $list;
    }

    /**
     *更改用户锁定状态
     */
    public function updateLock($filter){
        $sqlInfo = array(
            'fields'    => array(
                'is_lock'   => $filter['is_lock'],
            ),
            'table'     => 'admin_user',
            'where'     => array(
                'user_id  = "' . $filter['userId'] . '"',
            ),
        );
        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }
        $list = $this->CoreUpdate();
        return $list;
    }

    /**
     * 获取管理员列表
    */
    public function getUser($user_level){
        $sqlInfo = array(
            'fields'    => array(
                'user_id',
                'user_name',
                'user_real_name',
                'user_tel',
                'user_email',
                'user_level',
                'user_power',
                'is_lock',
                'last_login_time',
            ),
            'table'     => 'admin_user',
            'where'     => array(
                'user_level >= '.$user_level,
            ),
        );
        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return $list;
    }

    /**
     * 删除管理员
    */
    public function deleteAdmin($userId){

        $sqlInfo = array(
            'table' => 'admin_user',
            'where' => array(
                'user_id = "'. $userId .'"',
            ),
        );
        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }
        $list = $this->CoreDelete();
        return $list;
    }

    /*编辑管理员*/
    public function editUser($filter){
        $sqlInfo = array(
            'fields' => array(
                'user_name'         => $filter['user_name'],
                'user_email'        => $filter['user_email'],
                'user_password'     => $filter['user_password'],
                'user_level'        => $filter['user_level'],
                'user_tel'          => $filter['user_tel'],
                'user_real_name'    => $filter['user_real_name'],
                'last_update'   => time(),
            ),
            'table' => 'admin_user',
            'where'     => array(
                'user_id  = "' . $filter['userId'] . '"',
            ),
        );
        //如果密码为空则不更新密码
        if(empty($filter['user_password'])){
            unset($sqlInfo['fields']['user_password']);
        }
        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }

        $list = $this->CoreUpdate();
        return $list;
    }

    /*分配权限*/
    public function givePower($userId,$power){
        $sqlInfo = array(
            'fields'    => array(
                'user_power'   => $power,
            ),
            'table'     => 'admin_user',
            'where'     => array(
                'user_id  = "' . $userId . '"',
            ),
        );
        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }
        $this->CoreUpdate();
    }

    /**
     *读取收藏数量--分页
     */
    public function getCollectNum($where)
    {
        $sqlInfo = array(
            'fields' => array(
                'count(ct_id) as num',
            ),
            'table' => 'collect',
            'where' => $where,
        );
        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0])?0:$list[0]->num;
    }

    /**
     *读取收藏信息--分页
     */
    public function getCollectList($page, $perPage, $where)
    {
        $sqlInfo = array(
            'fields' => array(
                'ct_id',
                'user_id',
                'goods_id',
                'goods_title',
                'goods_thumb',
                'type',
                'goods_money',
                'add_time',
            ),
            'table' => 'collect',
            'where' => $where,
            'order' => array(
                'add_time desc'
            ),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;

    }

    /**
     * 根据收藏ID删除收藏信息
     * */
    public function deleteCollect($ct_id)
    {
        $sqlInfo = array(
            'table' => 'collect',
            'where' => array(
                'ct_id= "' . $ct_id . '"',
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;

    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */