<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Login extends MY_Controller {

    public function __construct() {
          parent::__construct();
        $this->load->model('Login_model');
        $this->load->helper('my_captcha_helper');
        $this->load->helper('captcha');
        $this->load->library('form_validation');
    }

    /**
     * 判断是否登录
     */
    public function index() {
        if ($this->session->userdata('username')) {
            $this->load->view('index/index');
        } else {
            $this->load->view('login/login');
        }
    }

    /**
     * 注册方法   
     */
    
    public function login() {
        if (isset($_POST['btn'])) {
            $data['UserName'] = trim($this->input->post('username'));
            $code = $this->input->post('code');
            if (strtolower($code) != $_SESSION['cap_word']) {
                $this->error_msg("请输入正确的验证码", FALSE);
                return;
            }
            $user = $this->Login_model->get_user($data['UserName']);
            if ($user) {
                $salt = $user['salt'];
                $pass = md5($salt + trim($this->input->post('password')));
                if (strncmp($user['Password'], $pass, 32) == 0) {
                    if ($user['islock'] == 0) {
                        $this->error_msg("您的账号被锁定", FALSE);
                    }
                    $this->session->set_userdata('user_info', $user);
                    $this->session->set_userdata('username', $data['UserName']);
                    $this->session->set_userdata('userid', $user['ID']) ;
                   //得到是否开启管理员日
                    $res = file_get_contents(APPPATH . "config/site.json");
                    $site = json_decode($res, TRUE);
                    $this->session->set_userdata('sites', $site);
                    //重定向  改变页面地址链接 控制器/方法 重定向到index页面，这样每次刷新就只刷新index页面
                    redirect('Index/index');        
        } else {
                    $this->error_msg("密码错误,登录");
                }
            } else {
                $this->error_msg("用户名错误,登录");
                die();
            }
        } else {
            $this->error_msg("非法操作", FALSE);
        }
    }

    /**
     * 验证码
     */
    public function verification_code() {

        $vals = array(
            'word' => rand(1000, 9999),
            'word_length' => 4
        );
        $cap = create_captcha($vals);
        session_start();
        $_SESSION['cap_word'] = $cap['word'];
    }  
}
