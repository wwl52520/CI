<?php

class user_group extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('url');
    }

    public function index() {
       $this->output->cache(1/60);
        $data['user_group'] = $this->user_model->get_user_group(0);
        $this->load->view('user/user_group_list', $data);
    }

    public function show() {
        $id = $this->uri->Segment(3);
        if ($id == TRUE) {
            $data['list'] = $this->user_model->get_user_group($id);
            $this->load->view('user/user_group_edit', $data);
        } else {
            $this->load->view('user/user_group_add');
        }
    }

    public function add() {
        $data['title'] = trim($this->input->post('title'));
        $data['grade'] = trim($this->input->post('grade'));
        $data['upgrade_exp'] = trim($this->input->post('upgrade_exp'));
        $data['amount'] = trim($this->input->post('amount'));
        $data['point'] = trim($this->input->post('point'));
        $data['discount'] = trim($this->input->post('discount'));
        $data['is_default'] = $this->input->post('is_default');
        $data['is_grade_up'] = $this->input->post('is_grade_up');

        $query = $this->user_model->add_user_group($data);
        if ($query == TRUE) {
            echo " <script>alert('新增成功');window.location.href='" . base_url() . "user_group/index';</script>";
        } else {
            echo " <script>alert('新增失败');history.go(-2);</script>";
        }
    }

    public function edit() {
        $data['id'] = $this->input->post('id');
        if ($data['id'] == TRUE) {
            $data['title'] = trim($this->input->post('title'));
            $data['grade'] = trim($this->input->post('grade'));
            $data['upgrade_exp'] = trim($this->input->post('upgrade_exp'));
            $data['amount'] = trim($this->input->post('amount'));
            $data['point'] = trim($this->input->post('point'));
            $data['discount'] = trim($this->input->post('discount'));
            $data['is_default'] = $this->input->post('is_default');
            $data['is_grade_up'] = $this->input->post('is_grade_up');
       
            $query = $this->user_model->edit_user_group($data);
            
            if ($query == TRUE) {
                echo " <script>alert('修改成功');window.location.href='" . base_url() . "user_group/index';</script>";
            } else {
                echo " <script>alert('修改成功');history.go(-2);</script>";
            }
        } else {
            echo " <script>alert('ID不能为空,请联系管理员！');history.go(-2);</script>";
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
        $query = $this->common_model->delete('user_group', $list);
       
        echo '{"count":"' . $query . '"}';
    }

}
