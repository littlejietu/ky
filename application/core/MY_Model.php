<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CustomCore
 *
 * 自定义MODEL类，实现增删改查的基本操作
 *
 * @author		     smallBird
 * @createtime	     2014-04-25
 * @since		     Version 1.0
 * @filesource
 *
 */

class MY_Model extends CI_Model {

    private  $CI;

    private  $table     = '';                   //表名
    private  $fields    = array();              //字段
    private  $where     = array();              //条件
    private  $order     = array();              //排序
    private  $groupby   = '';                   //分组
    private  $limit     = '';                   //条数

    public function __construct(){
        parent::__construct();
        //$this->CI =& get_instance();
        $this->db = _get_db('default');
    }

    /**
     * 取信息函数
     * return:(object)array
    */
    public function CoreSelect($arr=array()){
        /*清空所有属性的值，并重新赋值*/
        if(!empty($arr)){
            $this->cleanParm();
            $this->setValue($arr);
        }
        $sql = $this->makeSql('select');
        //echo $sql,'<br>';
        $rel = $this->db->query($sql);
        $this->cleanParm();
        return $rel->result();
    }

    /**
     * 存信息函数
     * return:insert_id
     */
    public function CoreInsert($arr=array()){
        if(!empty($arr)){
            $this->cleanParm();
            $this->setValue($arr);
        }
        $sql = $this->makeSql('insert');
        $rel = $this->db->query($sql);
        $this->cleanParm();
        if($rel){
            return mysql_insert_id();
        }else{
            return $this->modelError('sqlerror');
        }
    }

    /**
     * 更新信息函数
     */
    public function CoreUpdate($arr=array()){
        if(!empty($arr)){
            $this->cleanParm();
            $this->setValue($arr);
        }
        $sql = $this->makeSql('update');
        $rel = $this->db->query($sql);
        $this->cleanParm();
        if(!$rel){
            return $this->modelError('sqlerror');
        }
        return true;
    }

    /**
     * 删除信息函数
     */
    public function CoreDelete($arr=array()){
        if(!empty($arr)){
            $this->cleanParm();
            $this->setValue($arr);
        }
        $sql = $this->makeSql('delete');
        $rel = $this->db->query($sql);
        $this->cleanParm();
        if(!$rel){
            return $this->modelError('sqlerror');
        }
        return true;
    }

    /**
     * 组合sql语句
     * select:
     *      $table：（no dbprofix）
     *      $fields：（'field1','field2'...）
     *      $where：（array('fidle1=str1','field2>str2'...)）
     *      $groupby：（'fidle'）
     *      $order：（array('order1 ordertype1','order2 ordertype2'...)）
     *      $limit：（num,num）
     * insert:
     *      $table：（no dbprofix）
     *      $fields：（field1=>value1,field2=>value2...）
     * update:
     *      $table：（no dbprofix）
     *      $fields：（field1=>value1,field2=>value2...）
     *      $where：（array('fidle1=str1','field2>str2'...)）
     * delete:
     *      $table：（no dbprofix）
     *      $where：（array('fidle1=str1','field2>str2'...)）
     */
    private function makeSql($action){
        $tablePrefix    = $this->db->dbprefix;//数据库表名前缀
        $sqlTable       = $tablePrefix . $this->table;//组合数据表
        $this->where    = array_filter($this->where);
        switch($action){
            case 'select':
                $selectOther    = '';//other条件
                $selectFields   = ($this->isNotEmpty($this->fields))?implode(',',$this->fields):'*';//拆分字段数组，默认为*
                $selectWhere    = ($this->isNotEmpty($this->where))?' WHERE ' . implode($this->where,' and ') : '';//拆分where条件数组

                //组合other条件
                $selectOther    .= ($this->isNotEmpty($this->groupby))?   ' GROUP BY ' . $this->groupby    :   '';
                $selectOther    .= ($this->isNotEmpty($this->order))?     ' ORDER BY ' . implode($this->order,',') : '';
                $selectOther    .= ($this->isNotEmpty($this->limit))?     ' LIMIT ' . $this->limit    :   '';

                if($this->isNotEmpty($selectFields) && $this->isNotEmpty($this->table)){
                    $sql        =  'SELECT ' . $selectFields . ' FROM ' . $sqlTable . $selectWhere . $selectOther;
                    return $sql;
                }
                break;
            case 'insert':
                if($this->isNotEmpty($this->fields)){

                    $insertField =' (';//插入字段
                    $insertValue =' (';//插入的值
                    $numFields = count($this->fields);
                    $i=0;

                    foreach($this->fields as $key => $value){
                        $insertField .= '`' . $key . '`';
                        $insertValue .= '"' . $value . '"';
                        if($i<$numFields-1){
                            $insertField .= ',';
                            $insertValue .= ',';
                        }
                        $i++;
                    }
                    $insertField .= ') ';
                    $insertValue .= ') ';
                }
                if($this->isNotEmpty($insertField) && $this->isNotEmpty($insertValue)){
                    $sql = ' INSERT INTO '. $sqlTable . $insertField .' VALUES ' .$insertValue;
                    return $sql;
                }
                break;
            case 'update':
                $updateSql ='';//更新的sql(field1=str1,field2=str2)
                if($this->isNotEmpty($this->fields) && $this->isNotEmpty($this->where)){

                    $udpateWhere = implode($this->where,' and ');//拆分where条件数组

                    $numFields = count($this->fields);
                    $i=0;
                    foreach($this->fields as $key => $value){
                        $updateSql .= '`' . $key . '` = "' . $value . '"';
                        if($i<$numFields-1){
                            $updateSql .= ',';
                        }
                        $i++;
                    }
                }
                if($this->isNotEmpty($updateSql)){
                    $sql = ' UPDATE '. $sqlTable . ' set ' . $updateSql .' WHERE ' . $udpateWhere;
                    return $sql;
                }
                break;
            case 'delete':
                if($this->isNotEmpty($this->where)){
                    $deleteWhere = implode($this->where,' and ');//拆分where条件数组
                    $sql = ' DELETE FROM '. $sqlTable . ' WHERE ' . $deleteWhere;
                    return $sql;
                }
                break;
        }
        return $this->modelError('sqlerror');
    }

    /**
     * 异常处理函数
    */
    public function modelError($errorinfo){
        switch($errorinfo){
            case 'sqlerror':
                return 'SQL error!Please call the manage!';
            break;
            default:
                return 'SQL error!Please call the manage!';
        }

    }

    /**
     * 判断是否为非空
     */
    public  function isNotEmpty($str){
        if(is_array($str)){
            foreach($str as $value){
                if(is_array($value)){
                    $this->isNotEmpty($value);
                }
                if($value == '0'){
                    return true;
                }
                if(!empty($value)){
                    return true;
                }
            }
            return false;
        }
        if(!empty($str)){
            return true;
        }
        return false;
    }

    /*清空所有属性的值*/
    private function cleanParm(){
        $this->table        = '';
        $this->fields       = array();
        $this->where        = array();
        $this->order        = array();
        $this->groupby      = '';
        $this->limit        = '';
    }
    /*重新赋值*/
    private function setValue($arr){
        foreach($arr as $key => $value){
            $this->$key = $value;
        }
    }


    public function  __set($key,$value){
        $this->$key = $value;
    }

}
