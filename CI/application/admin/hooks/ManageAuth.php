<?php

class ManageAuth {
    private  $CI;
    public function __construct() {
        $this->CI = &get_instance();  //获取CI对象
        $this->CI->load->helper('url');
        $this->CI->load->model('system_model');
        $this->CI->load->model('common_model');
        $this->CI->load->library('session');
    }
    //权限认证
    public function auth()
    {
       $con = $this->CI->router->fetch_class();
       $func = $this->CI->router->fetch_method();//获取方法名  
     
       $user = $this->CI->session->userdata('user_info');   //获取当前管理员信息表
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
                    return;
                }
            }
        } 
        else if($con == "login" && $func=="index")
        {
        }
        else 
        {
            echo " <script>alert('您还没有登录,请先登录');window.location.href='" . site_url() . "login/index';</script>";
        }
    }
}
