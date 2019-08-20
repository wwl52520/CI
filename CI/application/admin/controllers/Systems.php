<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header("Expires:-1");
header("Cache-Control:no_cache");
header("Pragma:no-cache");

Class Systems extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('System_model');
        $this->islogin_or_rule();
    }

    public function index() {
        //导入json文件
       // $this->output->cache(1);
        $site = file_get_contents(APPPATH . 'config/site.json');
        $data['data'] = json_decode($site, TRUE);
      
        $this->load->view('systems/set_message', $data);
    }

    public function edit() {
        if ($_POST) {
            $data = $this->input->post();     
    foreach ($data as $key => $value) {
                $data[$key] = trim($data[$key]);
            }
            $file = 'config/site.json';
            $site = json_decode(file_get_contents(APPPATH . $file), TRUE);
            //合并数组，相同键名，后面的值会覆盖原来的值
            $res = array_merge($site, $data);
            $res = json_encode($res, JSON_UNESCAPED_UNICODE);
            $return = file_put_contents(APPPATH . $file, $res);
             if($return)
             {
                $this->session->set_userdata('sites', $data); 
             }
            
            $this->msg($return, '修改系统设置', $this->router->fetch_method(), '内容', 'Systems/index');
            
        } else {
            $this->error_msg('非法操作');
        }
    }
    
    
    
    public function res_left()
    {
        $site=$this->session->userdata("sites");
        echo json_encode($site);
    }

    /* 邮件发送
      $this->load->library('email');

      $config['protocol']='smtp';                          //邮件发送协议
      $config['smtp_host']='smtp.163.com';                 //SMTP 服务器地址
      $config['smtp_user']='18217099062@163.com';          //发件人用户名
      $config['smtp_pass'] ='wanliang802388';              //发件人密码
      $config['smtp_port']='25';                           //端口号
      $this->email->initialize($config);
      $this->email->from('18217099062@163.com');
      $this->email->to('269588362@qq.com');
      $this->email->subject('Email Test');
      $this->email->message('Testing the email class.');
      $status = $this->email->print_debugger();
      if($status){
      echo "发送到成功！<br>";
      } else {
      echo "发送到失败败了，错误原因：！<br>";
      }
     */
}
