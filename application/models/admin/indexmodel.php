<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IndexModel extends MY_Model {
    /*取信息条数*/
    public function getNoticeNum($classId){
        $sqlInfo = array(
            'fields'    => array(
                'count(art_id) as num',
            ),
            'table'     => 'article',
            'where'     => array(
                'art_class_id = "' . $classId . '"',
                'is_delete = 0',
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
        return $list[0]->num;
    }

    /*取公告信息*/
    public function getNoticeList($classId,$page,$perPage){
        $sqlInfo = array(
            'fields'    => array(
                'art_id',
                'art_title',
                'is_read',
                'last_update',
            ),
            'table'     => 'article',
            'where'     => array(
                'art_class_id = "' . $classId . '"',
                'is_delete = 0',
            ),
            'groupby'   => '',
            'order'     => array(
                'last_update desc'
            ),
            'limit'     => ($page-1)*$perPage.','.$perPage,
        );
        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return $list;
    }

    /*取登录人员数据*/
    public function getUserInfo($userId){
        $sqlInfo = array(
            'fields'    => array(
                'user_id',
                'user_name',
                'user_power',
                'is_lock',
            ),
            'table'     => 'admin_user',
            'where'     => array(
                'user_id = "' . $userId . '"',
                'is_lock = 0'
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

    /**
     * 取页面左侧数据
    */
    public function getLeft($userLevel, $userPower){
        $sqlInfo = array(
            'fields'    => array(
                'sys_id',
                'sys_name',
                'sys_link',
                'sys_partid',
                'sys_step',
                'is_show',
                'sequence',
            ),
            'table'     => 'system',
            'where'     => array(),
            'order'     => array('sequence asc','sys_id asc'),
        );
        if(empty($userPower))
            $userPower = '1';
        $power = ($userLevel==0)?'':'sys_id in ('.$userPower.')';

        $sqlInfo['where']   = array('sys_step = 0',$power);
        $listFirst          = $this->CoreSelect($sqlInfo);

        $sqlInfo['where']   = array('sys_step = 1',$power);
        $listSecond         = $this->CoreSelect($sqlInfo);

        $sqlInfo['where']   = array('sys_step = 2',$power);
        $listThree          = $this->CoreSelect($sqlInfo);
        return array(
            'stepFirst'     => $listFirst,
            'stepSecond'    => $listSecond,
            'stepThree'     => $listThree,
        );
    }

    /*添加左侧栏目*/
    public function addLeft($data){
        $sqlInfo = array(
            'fields' => array(
                'sys_name'          => $data['sysName'],
                'sys_link'          => $data['sysLink'],
                'sys_partid'        => $data['sysPartId'],
                'sys_step'          => $data['sysStep'],
                'is_show'           => $data['is_show'],
                'sequence'          => 0,
                'add_time'          => time(),
                'last_update'       => time(),
            ),
            'table' => 'system',
        );

        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }
        $this->CoreInsert();
    }

    /*编辑左侧栏目*/
    public function editLeft($data,$id){
        $sqlInfo = array(
            'fields' => array(
                'sys_name'          => $data['sysName'],
                'sys_link'          => $data['sysLink'],
                'sys_partid'        => $data['sysPartId'],
                'sys_step'          => $data['sysStep'],
                'is_show'           => $data['is_show'],
                'last_update'       => time(),
            ),
            'table' => 'system',
            'where' => array(
                'sys_id = "'.$id.'"',
            ),
        );

        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }
        $this->CoreUpdate();
    }

    /*左侧栏目添加的时候取本分类的step*/
    public function leftStep($sysPartId){
        $sqlInfo = array(
            'fields'    => array(
                'sys_step',
            ),
            'table'     => 'system',
            'where'     => array(
                'sys_id = "' . $sysPartId . '"',
            ),
        );
        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return ($list[0]->sys_step+1);
    }

    /*按ID取左侧栏目详细信息*/
    public function  getLeftInfo($sysId){
        $sqlInfo = array(
            'fields'    => array(
                'sys_id',
                'sys_name',
                'sys_link',
                'sys_partid',
                'is_show',
            ),
            'table'     => 'system',
            'where'     => array(
                'sys_id = "' . $sysId . '"',
            ),
        );

        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return $list[0];
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */