<?php

defined('BASEPATH') OR exit('No direct script access allowed');

header("Expires:-1");
header("Cache-Control:no_cache");
header("Pragma:no-cache");
Class systems extends MY_Controller {

    
    
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        //  $this->config->load('email', FALSE, TRUE);
        $this->load->model('login_model');
        $this->load->model('system_model');
    }

    public function index() {
        include(APPPATH . 'config/email.php');
        //   $data['email'] = $this->config->item('email');
        $data['site'] = $this->login_model->get_site();
        $data['email'] = $email;
        $this->load->view('systems/set_message', $data);
    }

    public function set_systems() {

        if (isset($_POST['site']) && $_POST['site'] == 'edit') {
            $data['site_id'] = $this->input->post('id');
            $data['company'] = $this->input->post('company');
            $data['address'] = $this->input->post('address');
            $data['tel'] = $this->input->post('tel');
            $data['email'] = $this->input->post('email');
            $data['copyright'] = $this->input->post('copyright');
            $result = $this->login_model->set_site($data);
            if ($result > 0) {
                $msg = "修改成功";
                echo "<script>alert('$msg');</script>";
                $this->index();
            } else {
                $msg = "修改失败";
                alert($msg);
            }
        } else {
            include(APPPATH . 'config/email.php');
            if (isset($_POST['email']) && $_POST['email'] == 'edit') {
                $file = $email;
                $data['smtp_host'] = $this->input->post('smtp_host');
                $data['smtp_port'] = $this->input->post('smtp_port');
                $data['smtp_user'] = $this->input->post('smtp_user');
                $data['mail_form'] = $this->input->post('mail_form');
                $data['mail_password'] = $this->input->post('mail_password');
                $data['mail_to'] = $this->input->post('mail_to');
                $data['mail_subject'] = $this->input->post('mail_subject');

                $res = array_merge($file, $data);    //合并数组，相同键名，后面的值会覆盖原来的值
                $files = 'application/config/email.php';
                if (!empty($res['smtp_host'])) {
                    if (file_put_contents($files, "<?php\r\n " . "$" . "email= " . var_export($res, true) . ";")) { //写入文件中,更新配置文件       
                        $msg = "修改成功";
                        echo "<script>alert('$msg');</script>";
                        $this->index();
                    }
                } else {
                    $msg = "修改失败";
                    alert($msg);
                }
            }
        }
    }

  

  
    public function index_nav() {
        $data = array('list' => $this->system_model->get_navigation());
        $this->load->view('systems/navigation_list', $data);
    }

    public function nav_show() {
        $data = array('list' => $this->system_model->get_navigation());
        $this->load->view('systems/navigation_add', $data);
    }

    /**
     * 后台导航栏目增加    /
     */
    public function navigation_add() {
        $navlist = $this->system_model->get_navigation();
        $data['id'] = trim($this->input->post('newtype'));
        $data['title'] = trim($this->input->post('title'));
        $data['controller'] = trim($this->input->post('controller'));
        $data['action'] = trim($this->input->post('action'));

        for ($i = 0; $i < count($navlist); $i++) {
            if ($navlist[$i]['id'] == $data['id'] && $navlist[$i]['pid'] == 0 || $data['id'] == 0) {
                $query = $this->system_model->add_navigation($data);
                break;
            } else {
                $query = $this->system_model->add_children_navigation($data);
                break;
            }
        }
        if ($query) {
            echo " <script>alert('新增成功');window.location.href='" . base_url() . "systems/index_nav';</script>";
        } else {
            echo " <script>alert('新增成功');history.go(-2);</script>";
        }
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
