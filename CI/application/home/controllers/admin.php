<?php

class admin extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        //  $this->config->load('email', FALSE, TRUE);
        $this->load->model('login_model');
        $this->load->model('system_model');
         $this->load->model('common_model');
    }

    //加载管理员列表
    public function index() {
         $this->output->cache(1/60);
        $data = array
            (
            'admin_list' => $this->system_model->get_admin(0),
            'admin_role' => $this->system_model->get_role(0)
        );
        $this->load->view('systems/admin_list', $data);
    }

    //显示页面
    public function show() {


        $id = $this->uri->segment(3);
        if ($id == FALSE) {
            $data = array('admin_role' => $this->system_model->get_role(0));
            $this->load->view('systems/admin_add', $data);
        } else {
            $data = array(
                'admin_list' => $this->system_model->get_admin($id),
                'admin_role' => $this->system_model->get_role(0)
            );
            $this->load->view('systems/admin_edit', $data);
        }
    }

    public function edit() {
        $data['id'] = $this->input->post('id');
        $data['img'] = $this->do_uploads();
        
        if (empty($data['img'])) {
            $data['img'] = $this->input->post('userfile');
        }
        
         $data['UserName'] = $this->input->post('UserName');
         $data['Password'] = $this->input->post('Password');
         $admin=$this->common_model->get_pwd('admin',$data['id']);
        //判断密码是否修改，修改则将修改的密码再次加密
        if (strncmp($data['Password'],$admin['Password'],32)!=0) {
            $data['Password'] = md5($this->input->post('Password'));
        }
        $data['nikename'] = $this->input->post('nikename');
        $data['islock'] = $this->input->post('islock');
        $data['telephone'] = $this->input->post('telephone');
        $data['role_id'] = $this->input->post('newtype');
        $result = $this->system_model->operation_admin($data, $data['id']);
        if ($result > 0) {
            
            
            
            
                 echo " <script>alert('修改成功');window.location.href='" . base_url() . "admin/index';</script>";
        } else {
           echo " <script>alert('修改失败');history.go(-2);</script>";
            alert($msg);
        }
    }

    public function add() {
        $data['img'] = $this->do_uploads();
        $data['UserName'] = $this->input->post('UserName');
        $data['Password'] = md5($this->input->post('Password'));
        $data['nikename'] = $this->input->post('nikename');
        $data['islock'] = $this->input->post('islock');
        $data['telephone'] = $this->input->post('telephone');
        $data['role_id'] = $this->input->post('newtype');
        $result = $this->system_model->operation_admin($data, 0);
        if ($result > 0) {
            $msg = "新增成功";
            echo "<script>alert('$msg');</script>";
            $this->admin_list();
            redirect('admin/index');
        } else {
            $msg = "新增失败";
            alert($msg);
        }
    }

    public function alert($msg) {
        echo "<script>alert('$msg')</script>";
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
        $query = $this->system_model->delete('admin',$list);
        echo '{"count":"' . $query . '"}';
        
    }

}
