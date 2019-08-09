<?php

Class Navigation extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('System_model');
        $this->islogin_or_rule();
    }

    public function index() {
        $this->output->cache(5);
        $nav = $this->System_model->get_navigation();
        $data['nav_list'] = $this->tree_all($nav, 0, "nav_list", 0);
        $this->load->view('systems/navigation_list', $data);
    }

    public function show() {
        $nav = $this->System_model->get_navigation();
        $data['nav_add'] = $this->tree_all($nav, 0, "nav_add", 0);
        $this->load->view('systems/navigation_add', $data);
    }

    /**
     * 后台导航栏目增加    /
     */
    public function add() {
        if ($_POST) {
           $list = $this->input->post();
           $data=$this->loop_trim($list);
            $result = $this->System_model->add_navigation($data);
            $this->msg($result, '新增导航栏目', $this->router->fetch_method(), $data['title'], 'Navigation/index');
        } else {
            $this->error_msg('非法操作', FALSE);
        }
    }

}
