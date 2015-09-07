<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lottery extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Lottery_model');
        $this->load->model('Lottery_Log_model');
        $this->load->model('Lottery_award_model');
    }

	public function index()
	{
		$key = "xxx";
		$userid = (int)$this->input->get_post('userid');
		$sign = $this->input->get_post('sign');

		$get_sign = md5($userid.$key);
		if($get_sign!=$sign )
		{
			echo "非法";exit;
		}
		else
		{
			$this->session->set_userdata('userid',$userid);
		}

		$id = 1;

		$arr = checkPecent($id);
		if($arr['code']!='Success') return $arr;

		
	}

	public function start($id)
	{
		$arr = array('code'=>'Success','message'=>'');
		$userid = $this->session->userdata('userid');
		$id = _get_key_val($id, TRUE);
		if(empty($userid)) {echo "过期";exit;}

		//核查用户是否满足条件抽奖
		$arr = checkRule($id);
		if($arr['code']!='Success') return $arr;

		//判断概率是否正确
		$arr = checkPecent($id);
		if($arr['code']!='Success') return $arr;
		
		//随机抽取
		$arr = doLottery($id);

		echo json_encode($arr);
		exit;

	}

	//核查用户是否满足条件抽奖
	private function checkRule($id)
	{
		$arr = array('code'=>'Success','message'=>'');

		$userid = $this->session->userdata('userid');
		$id = _get_key_val($id, TRUE);
		if(empty($userid)) {echo "过期";exit;}

		$o = $this->Lottery_model->get_info_by_id($id);
		//核查用户是否满足条件抽奖
		$arrRule = json_decode( $o->rulejson );
		if(!empty($arrRule['num']) )	//次数检查
		{
			$num = $this->Lottery_Log_model->get_count(array('lotteryid'=>$id));
			if($num>=$arrRule['num'])
			{
				$arr['code']='Fail';
				$arr['message']='抽奖最多只能抽'.$arr['num'].'次';

			}

		}
		return $arr;
	}

	//判断概率是否正确
	private function checkPecent($id){
		$arr = array('code'=>'Success','message'=>'');
		$result = $this->Lottery_award_model->db->select('sum(xx) as allpecent')->from('Lottery_award')
												->where('lotteryid', $id)
												->where('status', 1)
												->get()
												->row_array();
		if($result['allpecent']!=100)
		{
			$arr['code']='Fail';
			$arr['message']='概率不正确';
		}

		return $arr;
	}

	//返回中奖id
	private function doLottery($lotteryid){
		$arr = array('code'=>0,'message'=>'');
		$awadid = randLottery($id);
		$o = $this->Lottery_Awad_model->get_by_id($awadid);
		

		// $data = array(
			// 		'title'=>$this->input->post('title'),
			// 		'placeid'=>$this->input->post('placeid'),
			// 		'adcode'=>$adcode,
			// 		'img'=>$this->input->post('img'),
			// 		'url'=>$this->input->post('url'),
			// 		'summary'=>$this->input->post('summary'),
					
			// 	);
			// $this->Lottery_Log_model->insert($data);

		//如果抽中的奖品数量为0,或者奖品是未启用的,那么自动把奖品改为未中奖。
		if(empty($o) || $o['status']==0)
			$awadid = 0;

		//中奖
		if($awadid>0)
		{
			//调用接口
			//...

			$arr['code'] = $awadid;
			$arr['message'] = '恭喜你，中奖了~';
		}
		else
		{
			$arr['code'] = $awadid;
			$arr['message'] = '对不起，未中奖';
		}

		return $arr;
	}

	//随机抽奖
	private function randLottery($lotteryid){
		$sum = 0;//概率区间计算值 
		$num = rand(0,100);
		$list = $this->Lottery_Awad_model->get_list(array('lotteryid'=>$lotteryid));

		$awadid = 0;
		foreach ($list as $key => $a) {
			if ($num >= $sum)
            {
                $sum += $a['xx'];
                if ($num < $sum)
                {
                    $awadid = $a['id'];
                    break;
                }
            }
		}

		return $awadid;

	}

}