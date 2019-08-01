<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class login extends MY_Controller {

    public function __construct() {
          parent::__construct();
        $this->load->model('login_model');
        $this->load->helper('url');
        $this->load->helper('MY_captcha_helper');
        $this->load->helper('captcha');
        $this->load->library('session');
    }

    /**
     * 判断是否登录
     */
    public function index() {
        
        if ($this->session->set_userdata('username')) {
            $this->load->view('index/main');
        } else {
            $this->load->view('login/login');
        }
    }

    /**
     * 注册方法   
     */
    public function login() {

        if (isset($_POST['btn'])) {
            $data['UserName'] = $this->input->post('username');
            $data['Password'] = $this->input->post('password');
            $data['Password'] = md5($data['Password']);
            $code = $this->input->post('code');
            if (strtolower($code) != $_SESSION['cap_word']) {
                echo "<script>alert('请输入正确的验证码');history.go(-1);</script>";
                die();
            }
            $user = $this->login_model->get_user($data['UserName'], $data['Password']);
            if ($user) {
                if ($user['islock'] == 0) {
                    $msg = '您的账号已被锁定';
                    $this->alert($msg);
                }
                $this->session->set_userdata('user_info', $user);
                $this->session->set_userdata('username', $data['UserName']);
                
               // $this->load->view('index/main', $user);
                redirect("index/index");
            } else {
             echo "<script>alert('用户名或者密码错误！');history.go(-1);</script>";
             die();
            }
        } else {
            echo "你还没有提交数据";
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

    public function alert($msg) {
        echo "<script>alert('$msg');history.go(-1);</script>";
        die();
    }

    
}
