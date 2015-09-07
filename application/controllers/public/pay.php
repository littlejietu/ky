<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pay extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
    }
	

	public function done()
	{
		if ($this->input->is_post())
		{
			$id = _get_key_val( $this->input->post('orderid'),true);
			$no = $this->input->post('orderno');

			$o = $this->Order_model->get_by_id($id);
			if($o && $o['no']==$no)
			{
				$oSysPaystatus = _get_config('get_paystatus');
				$this->Order_model->update_by_where(array('id'=>$id), array('paystatus'=>$oSysPaystatus[2]));

				redirect(base_url('/m/order'));
			}
		}
	}

}