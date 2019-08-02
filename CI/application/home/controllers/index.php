<?php

class index extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('system_model');
        $this->load->helper('url');
        ;
    }

    public function index() {
   
        $this->load->view('index/index');
    }
    

    
    

   

    public function quit() {
        session_unset();    //释放当前在内存中已经创建的所有$_SESSION变量，但不删除session文件以及不释放对应的session id
        session_destroy();  //删除当前用户对应的session文件以及释放session id，内存中的$_SESSION变量内容依然保留
        redirect('login/index');
    }

}
