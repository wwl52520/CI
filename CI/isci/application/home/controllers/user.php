<?php

class user extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
        $this->load->model('common_model');
        $this->load->library('pagination'); //系统的library 
    }

    public function index() {
        $this->output->cache(1/60);
        $data = array(
            'user' => $this->pages('user'),
            'user_group' => $this->user_model->get_user_group(0)
        );
        $this->load->view('user/user_list', $data);
    }

    public function show() {
        $id = $this->uri->Segment(3);
        if ($id == TRUE) {
            $data = array(
                'list' => $this->user_model->get_user($id),
                'user_group' => $this->user_model->get_user_group(0)
            );
            $this->load->view("user/user_edit", $data);
        } else {
            $data['user_group'] = $this->user_model->get_user_group(0);
            $this->load->view('user/user_add', $data);
        }
    }

    public function edit() {
        $data['id'] = $this->input->post('id');
        if ($data['id'] == TRUE) {
            $data['group_id'] = trim($this->input->post('newtype'));
            $data['user_name'] = trim($this->input->post('user_name'));
            $data['password'] = trim(md5($this->input->post('password')));
            $data['tel'] = trim($this->input->post('tel'));
            $data['birthaday'] = strtotime($this->input->post('birthaday'));
            $data['email'] = trim($this->input->post('email'));
            $data['address'] = trim($this->input->post('address'));
            $data['status'] = trim($this->input->post('status'));
            $data['sex'] = trim($this->input->post('sex'));
            $data['img'] = $this->do_uploads();
            if (empty($data['img'])) {
                $data['img'] = $this->input->post('img');
            }
            $data['amount'] = trim($this->input->post('amount'));
            $data['point'] = trim($this->input->post('point'));
            $data['exp'] = trim($this->input->post('exp'));
            $result = $this->user_model->edit_user($data);
            if ($result) {
                echo " <script>alert('修改成功');window.location.href='" . base_url() . "user/index';</script>";
            } else {
                echo " <script>alert('修改失败');history.go(-2);</script>";
            }
        } else {
            echo " <script>alert('ID不能为空,请联系管理员！');history.go(-2);</script>";
        }
    }

    public function add() {
        $data['group_id'] = trim($this->input->post('newtype'));
        $data['user_name'] = trim($this->input->post('user_name'));
        $data['password'] = trim(md5($this->input->post('password')));
        $data['tel'] = trim($this->input->post('tel'));
        $data['birthaday'] = strtotime($this->input->post('birthaday'));
        $data['email'] = trim($this->input->post('email'));
        $data['address'] = trim($this->input->post('address'));
        $data['status'] = trim($this->input->post('status'));
        $data['sex'] = $this->input->post('sex');
        $data['img'] = $this->do_uploads();
        if (empty($data['img'])) {
            $data['img'] = $this->input->post('img');
        }
        $data['amount'] = trim($this->input->post('amount'));
        $data['point'] = trim($this->input->post('point'));
        $data['exp'] = trim($this->input->post('exp'));
        $data['createtime'] = time();
        $data['reg_ip'] = $this->input->ip_address();

        $query = $this->user_model->add_user($data);
        if ($query) {
            echo " <script>alert('新增成功');window.location.href='" . base_url() . "user/index';</script>";
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
        $query = $this->common_model->delete('user', $list);
        echo '{"count":"' . $query . '"}';
    }

}
