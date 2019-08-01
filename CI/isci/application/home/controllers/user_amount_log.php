<?php

class user_amount_log extends CI_Controller {

       public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('common_model');
        $this->load->helper('url');
    }

    public function index() {
        $data['user_amount'] = $this->user_model->get_user_amount_log();
        $this->load->view('user/user_amount_log_list', $data);
    }

   



      public function delete() {
        //获取传过来的id
        $id = $this->input->post('iditem');
        //判断是提交的一个还是多个，is_numeric判断是否是数组
        if (!is_numeric($id)) {
            //根据，分割字符串转为数组
            $item = explode(",", $id);
            //获取数组个数
            $counts = count($item);
            for ($i = 0; $i < $counts; $i++) {
                $list[$i] = $item[$i];
            }
            //删除第一个数组元素  unset  第一个元素，
            unset($list[0]);
        }
        $query = $this->common_model->delete('user_recharge', $list);
       
        echo '{"count":"' . $query . '"}';
    }
    
}
