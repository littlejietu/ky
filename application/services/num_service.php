<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Num_service
{
	public function __construct()
	{
		$this->ci = & get_instance();
		
		$this->ci->load->model('Usernum_model');
	}

	public function set_user_num($userid, $field, $addnum = 0)
	{
		$res_num = 0;
		$aField = array('ordernum','ordernum_new','ordernum_m','be_ordernum','be_ordernum_new','be_ordernum_m','be_commentnum','be_commentnum_new','commentnum','commentnum_new','fansnum','concernnum','visitnum','fund_m','be_fund_m','be_ordernum_t','ordernum_t');
		if(in_array($field, $aField))
		{
			$this->ci->load->model('Order_model');
			$this->ci->load->model('Comment_model');
			switch ($field) {
				case 'be_ordernum':
					$num = $this->ci->Order_model->get_count(array('sellerid'=>$userid,'status'=>1));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'be_ordernum'=>$num));
					$res_num = $num;
					break;
				case 'be_ordernum_new':
					$o = $this->ci->Usernum_model->get_by_id($userid);
					$num = $o ? $o['be_ordernum_new']:0;
					$num = $num + $addnum;
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'be_ordernum_new'=>$num));
					$res_num = $num;
					break;
				case 'ordernum':
					$num = $this->ci->Order_model->get_count(array('buyerid'=>$userid,'status'=>1));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'ordernum'=>$num));
					$res_num = $num;
					break;
				case 'ordernum_new':
					$o = $this->ci->Usernum_model->get_by_id($userid);
					$num = $o ? $o['ordernum_new']:0;
					$num = $num + $addnum;
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'ordernum_new'=>$num));
					$res_num = $num;
					break;
				case 'be_commentnum':
					$num = $this->ci->Comment_model->get_count(array('touserid'=>$userid,'status'=>1));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'be_commentnum'=>$num));
					$res_num = $num;
					break;
				case 'be_commentnum_new':
					$o = $this->ci->Usernum_model->get_by_id($userid);
					$num = $o ? $o['be_commentnum_new']:0;
					$num = $num + $addnum;
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'be_commentnum_new'=>$num));
					$res_num = $num;
					break;
				case 'commentnum':
					$num = $this->ci->Comment_model->get_count(array('userid'=>$userid,'status'=>1));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'commentnum'=>$num));
					$res_num = $num;
					break;
				case 'commentnum_new':
					$o = $this->ci->Usernum_model->get_by_id($userid);
					$num = $o ? $o['commentnum_new']:0;
					$num = $num + $addnum;
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'commentnum_new'=>$num));
					$res_num = $num;
					break;
				case 'be_ordernum_m':
					$num = $this->ci->Order_model->get_count(array('sellerid'=>$userid,'status'=>1,'addtime<'=>time()+30*24*60*60));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'be_ordernum_m'=>$num));
					$res_num = $num;
					break;
				case 'ordernum_m':
					$num = $this->ci->Order_model->get_count(array('buyerid'=>$userid,'status'=>1,'addtime<'=>time()+30*24*60*60));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'ordernum_m'=>$num));
					$res_num = $num;
					break;
				case 'be_ordernum_t':
					$num = $this->ci->Order_model->get_count(array('sellerid'=>$userid,'status'=>1,'date(from_unixtime(addtime))'=>'date(now())'));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'be_ordernum_t'=>$num));
					$res_num = $num;
					break;
				case 'ordernum_t':
					$num = $this->ci->Order_model->get_count(array('buyerid'=>$userid,'status'=>1,'date(from_unixtime(addtime))'=>'date(now())'));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'ordernum_t'=>$num));
					$res_num = $num;
					break;
				case 'be_fund_m':
					$db = $this->ci->Order_model->db;
					$db->select(' sum(totalprice) as s', FALSE)->from('order');
					$db->where(array('sellerid'=>$userid,'status'=>1,'addtime>='=>(time()-30*24*60*60)));
					$db->where_in('paystatus',array('payed','finish'));
					$rs = $db->get()->row_array();
					$total = $rs['s'];
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'be_fund_m'=>$total));
					$res_num = $total;
					break;
				case 'fund_m':
					$db = $this->ci->Order_model->db;
					$db->select(' sum(totalprice) as s', FALSE)->from('order');
					$db->where(array('buyerid'=>$userid,'status'=>1,'addtime>='=>(time()-30*24*60*60)));
					$db->where_in('paystatus',array('payed','finish'));
					$rs = $db->get()->row_array();
					$total = $rs['s'];
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'fund_m'=>$total));
					$res_num = $total;
					break;
				case 'fansnum':
					$this->ci->load->model('Fans_model');
					$num = $this->ci->Fans_model->get_count(array('userid'=>$userid,'status>'=>0));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'fansnum'=>$num));
					$res_num = $num;
					break;
				case 'concernnum':
					$this->ci->load->model('Fans_model');
					$num = $this->ci->Fans_model->get_count(array('fansuserid'=>$userid,'status>'=>0));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'concernnum'=>$num));
					$res_num = $num;
					break;
				case 'visitnum':
					$this->ci->load->model('Visit_model');
					$num = $this->ci->Visit_model->get_count(array('userid'=>$userid));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'visitnum'=>$num));
					$res_num = $num;
					break;
				default:
					# code...
					break;
			}
		}

		return $res_num;

	}

	public function clear_user_num($userid, $field)
	{
		$aField = array('ordernum_new','commentnum_new','be_ordernum_new','be_commentnum_new');
		if(in_array($field, $aField))
		{
			$this->ci->Usernum_model->insert(array('userid'=>$userid, $field=>0));
			//if($this->ci->loginUserNum && $this->ci->loginUserNum[$field]) $this->ci->loginUserNum[$field]=0;
		}
	}

	public function set_album_photo_num($userid, $field, $albumid = 0)
	{
		$res_num = 0;
		$aField = array('photonum');
		if(in_array($field, $aField))
		{
			$this->ci->load->model('Photo_model');
			$this->ci->load->model('Album_model');
			switch ($field) {
				case 'photonum':
					$num = $this->ci->Photo_model->get_count(array('albumid'=>$albumid,'status'=>1));
					$this->ci->Album_model->update_by_where(array('id'=>$albumid),array($field=>$num));
					$num = $this->ci->Photo_model->get_count(array('userid'=>$userid,'status'=>1));
					$this->ci->Usernum_model->insert(array('userid'=>$userid, $field=>$num));
					$res_num = $num;
					break;
				
				default:
					# code...
					break;
			}
		}

		return $res_num;

	}

}