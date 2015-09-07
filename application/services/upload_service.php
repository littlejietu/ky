<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Upload_services
{

	public function __construct()
	{
		$this->ci = & get_instance();
		$this->ci->load->model('user_model');
	}

	private function check_token($key)
    {
        $token = $key.md5($this->config->item('encryption_key').$key);
        return $token == $_POST['token'] ? true : false;
    }

	/**
    *上传图片
    * $type: 控件id
    */
    public function uploadimg() 
    {
    	$timestamp = $_POST['timestamp'];
        $uid = (int)$_POST['uid'];
        $type = $_POST['type'];
        $uploadName = $type."_upload";
        if (isset($_FILES[$uploadName]) && $_FILES[$uploadName]['name'] && $this->check_token($timestamp))
        {
            $config = array();
            $config['upload_path'] = "upload/$type/".date('Ym');
            $config['allowed_types']= 'jpg|png|jpeg';
            $config['max_size']     = 1500;
            $config['overwrite']    = true;
            $config['file_name']    = $type.'_'.$uid.'_'.time();
            mkpath($config['upload_path']);
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload($uploadName)){
                $error = $this->upload->display_errors();
                echo '100|'.strip_tags($error);exit;
            }
            else{
                $upload_data = $this->upload->data();
                // $this->load->model('Attach_model');
                // $map = array(
                //   'attach_type'=>$this->router->fetch_method(),
                //   'uid'=>$uid,
                //   'ctime'=>$this->timestamp,
                //   'name'=>$upload_data['client_name'],
                //   'type'=>$upload_data['file_type'],
                //   'size'=>$upload_data['file_size'],
                //   'extension'=>$upload_data['file_ext'],
                //   'save_path'=>$config['upload_path'],
                //   'save_name'=>$upload_data['orig_name'],
                //   'ip'=>$this->input->ip_address(),
                // );
                // $aid = $this->Attach_model->insert($map);
                $pic  = $config['upload_path'].'/'.$upload_data['file_name'];
            }
            if ($pic){
                   echo '200|'.$pic;exit;
            }
        }   
    }
}