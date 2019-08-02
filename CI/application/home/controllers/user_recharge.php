<?php

class user_recharge extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('common_model');
        $this->load->helper('url');
    }

    public function index() {
        $data = array(
            'user_recharge' => $this->user_model->get_user_recharge(),
            'payment' => $this->common_model->get_payment()
        );
       
        $this->load->view('user/user_recharge_list', $data);
    }

    public function show() {
        $this->load->view('user/user_recharge_add');
    }

    //检验用户存在不存在
    public function user_test() {
        $user_name = $this->input->post('user_name');
        $query = $this->common_model->user_test($user_name);
        if ($query) {
            echo $query['id'];
        }
        echo null;
    }

    public function add() {
        $data['user_id'] = $this->input->post('user_id');
        $data['user_name'] = trim($this->input->post('username'));
        $data['recharge_no'] = trim($this->input->post('recharge_no'));
        $data['amount'] = trim($this->input->post('amount'));
        $data['payment_id'] = 4;
        $data['add_time'] = time();
        $data['complete_time'] = time();
        $data['status'] = 1;
     
        $query = $this->user_model->add_user_recharge($data);
        if ($query) {
            echo " <script>alert('新增成功');window.location.href='" . base_url() . "user_recharge/index';</script>";
        } else {
            echo " <script>alert('新增失败');history.go(-2);</script>";
        }
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
