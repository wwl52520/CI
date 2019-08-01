<?php

class MY_Controller extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('system_model');
          $this->load->model('common_model');
    }

/**
 *判断管理员登录和权限
 */
    public function islogin_or_rule() {
        $user = $this->session->userdata('user_info');   //获取当前管理员信息表
        if ($user) 
        {
            $role_id = $user['role_id'];                    
            if ($role_id == "1") {}                     //判断是否是超级管理员
            else 
            {
                $result = $this->system_model->get_role_rules($role_id);
                $con = $this->router->fetch_class(); //获取控制器名  
                $action = $this->router->fetch_method(); //获取方法名    
                $link_address = $con . "/" . $action;
                $control_array = array_column($result, 'ct');     //将二维数组转成1位数组
                if (!in_array($link_address, $control_array)) 
                {
                    echo " <script>alert('你没有权限访问该页面');history.go(-1);</script>";
                    die();
                }
            }
        } 
        else 
        {
            echo " <script>alert('您还没有登录,请先登录');window.location.href='" . base_url() . "login/index';</script>";
        }
    }

    /**
     * 图片上传
     */
    public function do_uploads() {
        $temp = explode(".", $_FILES["userfile"]["name"]);  //获取文件名称，并通过explode分割，得到一个数组
        $extension = end($temp);                          //得到文件后缀
        $dates = date('Y-m-d', time());
        $config['upload_path'] = './Uploads/images/' . $dates;                              //定义文件上传目录，需要手动创建
        $rands = rand(1000, 9999);
        if (!file_exists($config['upload_path'])) {
            mkdir($config['upload_path']);
        }
        $config['allowed_types'] = 'gif|jpg|png';                         //定义格式
        $config['size'] = 100;                                            //定义大小
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $config['file_name'] = date('YmdHis', time()) . "_" . $rands . "." . $extension;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('userfile')) {  //判断是否选择了文件
            $error = array('error' => $this->upload->display_errors());     //返回错误
        } else {
            $data = array('upload_data' => $this->upload->data());         //得到文件信息\

            return "Uploads/images/" . $dates . "/" . $data['upload_data']['file_name'];
        }
    }

    /**
     * 分页  /
     */
    public function pages($table) {
        //获取总数
        $ss = $this->common_model->get_common_num($table);
        $number = $ss['count(id)'];
        $config['full_tag_open'] = '<ul class="pagination">'; //起始标签放在所有结果的左侧。可以直接在标签内部加上class标签
        $config['full_tag_close'] = '</ul>'; //结束标签放在所有结果的右侧。
        $config['first_tag_open'] = '<li>'; //第一个链接的起始标签。
        $config['first_tag_close'] = '</li>'; //第一个链接的结束标签。
        $config['next_tag_open'] = '<li>'; //下一页链接的起始标签。
        $config['next_tag_close'] = '</li>'; //下一页链接的结束标签。
        $config['prev_tag_open'] = '<li>'; //上一页链接的起始标签。
        $config['prev_tag_close'] = '</li>'; //上一页链接的结束标签
        $config['base_url'] = base_url() . $this->router->fetch_class() .'/index'; //链接路径
        $config['total_rows'] = $number;  //配置记录总条数        
        $config['per_page'] = 4; //配置每页显示的记录数
        $config['next_link'] = '下一页';
        $config['prev_link'] = '上一页';
        $config['last_link'] = '末页';
        $config['first_link'] = '首页';
        //配置分页导航当前页两边显示的条数
        $config['num_links'] = 3;
        //配置分页类
        $config['cur_page'] = $this->uri->segment(3);
        $tab = $this->common_model->pages($table,$config['per_page'], $this->uri->segment(3));

        $this->pagination->initialize($config);
        return $tab;
    }


}
