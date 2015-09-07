<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends XT_Model {

	protected $mTable = 'user';
	protected $tb_user = 'user';
	protected $tb_userdetail = 'user_detail';
	protected $tb_usermemo = 'user_memo';

	public function get_info_by_id($id, $fields='*')
	{
		$aUser = $this->get_by_id($id, $fields);
		// if( in_array($aUser['usertype'],array(1,4,5)) )
		// {

			$this->set_table($this->tb_userdetail);
			$aUserDetail = $this->get_by_where("userid=$id",'*');
			if($aUserDetail)
				$aUser = array_merge($aUserDetail, $aUser);
			$this->set_table($this->tb_usermemo);
			$aUserMemo = $this->get_by_where("userid=$id",'*');
			if($aUserMemo)
				$aUser = array_merge($aUserMemo, $aUser);
			$this->set_table($this->tb_user);
			return $aUser;
		// }
		// else
		// {
		// 	$this->set_table($this->tb_usermemo);
		// 	$aUserMemo = $this->get_by_where("userid=$id",'*');
		// 	if($aUserMemo)
		// 		$aUser = array_merge($aUserMemo, $aUser);
		// 	$this->set_table($this->tb_user);
		// 	return $aUser;
		// }

		/*$rs = $this->db->select($fields)
		->from($this->mTable.' a')
		->join($this->tb_userdetail.' b','a.id=b.userid','left')
		->join($this->tb_usermemo.' c','a.id=c.userid','left')
		->where("a.id=$id")
		->get()->row_array();
		print_r($rs);die;
		return $rs;
		*/
	}


	public function get_user_by_username($username, $fields='*')
	{
		$db_temp = $this->db->select($fields)
		->from($this->mTable)
		->where('username', $username)
		->get()
		->row_array();
		echo $this->db->last_query();
		die;
		return $db_temp;
	}

	public function get_user_by_nickname($nickname, $fields='*')
	{
		$db_temp = $this->db->select($fields)
		->from($this->mTable)
		->where('nickname', $username)
		->get()
		->row_array();
		return $db_temp;
	}

	public function get_user_by_mobile($mobile, $fields='*')
	{
		$db_temp = $this->db->select($fields)
		->from($this->mTable)
		->where('mobile', $mobile)
		->get()
		->row_array();
		return $db_temp;
	}

	public function get_user_by_email($email, $fields='*')
	{
		$db_temp = $this->db->select($fields)
		->from($this->mTable)
		->where('email', $email)
		->get()
		->row_array();
		return $db_temp;
	}

	

	public function login_update($id, $last_datetime, $last_ip)
	{
		$this->db->set('lastlogintime', $last_datetime, FALSE);
		$this->db->set('lastip', $last_ip, FALSE);
		//$this->db->set('login_num', 'login_num+1', FALSE);
		//$this->db->set('security_code', $this->security_code);
		$this->db->where('id', $id);
		return $this->db->update($this->mTable);
	}

	/**
	*更新email
	*/
	public function email_update($id, $email, $email_true){
		if(empty($id)) return 0;

		$email_true=($email_true==1)?1:0;
		if($email){
			$this->db->set('email', $email);
		}
		//$this->db->set('email_true', $email_true, FALSE);
		$this->db->where('id', $id);
		return $this->db->update($this->mTable);
	}

	/**
	*通过用户表id更新
	*/
	public function update_info_by_id($id, $data, $data_detail=array(), $data_memo=array()){
		$where = array('id'=> $id);
		if(!empty($data_detail))
		{
			$this->set_table($this->tb_userdetail);
			$this->update_by_where(array('userid'=>$id), $data_detail, $this->tb_userdetail);
		}
		if(!empty($data_memo))
		{
			$this->set_table($this->tb_usermemo);
			$this->update_by_where(array('userid'=>$id), $data_memo, $this->tb_usermemo);
		}
		$this->set_table($this->tb_user);

		return $this->update_by_id($id, $data);
	}

	public function get_user_by_ids($id, $fields = "*")
	{
		$db_temp = $this->db->select($fields)
		->from($this->mTable)
		->where_in('id', $id)
		->get()
		->result_array();
		return $db_temp;
	}

	public function user_nickname_check($val)
	{
		$db_temp = $this->db->select('count(1) as num ',false)
		->from($this->mTable)
		->where('nickname', $val)
		->get()
		->row_array();
		return $db_temp['num'];
	}

	public function user_mobile_check($val)
	{
		$db_temp = $this->db->select('count(1) as num ',false)
		->from($this->mTable)
		->where('mobile', $val)
		->get()
		->row_array();
		return $db_temp['num'];
	}

	public function user_email_check($val)
	{
		$db_temp = $this->db->select('count(1) as num ',false)
		->from($this->mTable)
		->where('email', $val)
		->get()
		->row_array();
		return $db_temp['num'];
	}

	public function user_username_check($val)
	{
		$db_temp = $this->db->select('count(1) as num ',false)
		->from($this->mTable)
		->where('username', $val)
		->get()
		->row_array();
		return $db_temp['num'];
	}

	public function add_user_by_ins($insid,$usertype)
	{
		$data = array('username'=>time(),
			'usertype'=>$usertype,
			'insid'=>$insid,
			'status'=>2,		//无登录功能
			'addtime'=>time(),
			'lastip'=>_ip_long(),
			);
		$userid = $this->insert_string( $data );

		$data_detail = array('userid'=>$userid,
			);
		$data_memo = array('userid'=>$userid,
			);
		$this->set_table($this->tb_userdetail);
        $this->insert($data_detail);
        $this->set_table($this->tb_usermemo);
        $this->insert($data_memo);
        $this->set_table($this->tb_user);

        return $userid;
	}

}
