<?php

class User_amount_log extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->islogin_or_rule();
    }

    public function index() {
        $this->load->view('user/user_amount_log_list');
    }

    /**
     *  列表页面返回 /
     */
    public function return_list() {
        //获取页数跟每页条数
        $page = $this->input->get('page');
        $limit = $this->input->get('limit');
        $page = (int) ($page - 1) * (int) $limit;
        $keyword = $this->input->get('keyword');
        //分页查询
        $table = $this->Common_model->pages('user_amount_log', $limit, $page, $keyword, '', '');
        if ($table) {
            for ($i = 0; $i < count($table); $i++) {
                $table[$i]['add_time'] = Date('Y-m-d H:i:s', $table[$i]['add_time']);
            }
            $res['total'] = $table[0]['sum'];
        } else {
            $res['total'] = 0;
        }
        $res['status'] = 200;
        $res['hint'] = '';
        $res['rows'] = $table;
        echo json_encode($res, JSON_UNESCAPED_UNICODE);        //返回只能用echo  不能用return  并且返回一定要将数组或者对象转为json数组或者对象 
    }

    public function delete() {
        $this->deleteall($this->router->fetch_class(), $this->router->fetch_method(), '删除会员');
    }

}