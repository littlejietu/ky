<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recommend_model extends XT_Model {

	protected $mTable = 'recommend';

	protected $db_user = 'user';
	protected $db_activity = 'activity';

	public function get_info_by_id($id, $fields='*')
	{
		return $this->get_by_id($id, $fields);
	}

	public function get_user_list($where, $feild, $limit=0)
    {
    	$result = $this->db->select($feild)->from($this->db_user)
    		->join($this->mTable,$this->db_user.'.id='.$this->mTable.'.outerid and kind=1')
    		->where($where)
    		->get()->result_array();

    	return $result;

    }

    public function get_act_list($where, $feild, $limit=0)
    {
    	$result = $this->db->select($feild)->from($this->db_activity)
    		->join($this->mTable,$this->db_activity.'.id='.$this->mTable.'.outerid and kind=2')
    		->where($where)
    		->get()->result_array();

    	return $result;

    }

    public function do_recommend($kind, $outerid){
    	$arrWhere = array('kind'=>$kind,'outerid'=>$outerid);
		$o = $this->get_by_where($arrWhere);
		if($o)
		{
			$this->delete_by_where($arrWhere);
		}
		else
		{
			$data = array(
				'kind'=>$kind,
				'outerid'=>$outerid,
				'addtime'=>time(),
				'op_userid'=>$this->session->userdata['admin_id'],
				'op_username'=>$this->session->userdata['user_name'],
				'op_time'=>time(),
				);
			
			$this->Recommend_model->insert($data);
		}

    }
    
}