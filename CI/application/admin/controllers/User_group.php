<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_group extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->islogin_or_rule();
    }

    public function index() {
        $this->output->cache(1 / 60);
        $this->load->view('user/user_group_list');
    }

    public function show() {
        $id = $this->uri->Segment(3);
        if ($id == TRUE) {
            $data['list'] = $this->User_model->get_user_group($id);
            $this->load->view('user/user_group_edit', $data);
        } else {
            $this->load->view('user/user_group_add');
        }
    }

    /**
     *  新增 /
     */
    public function add() {
        if ($_POST) {
            $data = $this->input->post();
            $this->operation($data, '新增');
        } else {
            $this->error_msg("非法操作", FALSE);
        }
    }

    /**
     *  修改 /
     */
    public function edit() {
        if (isset($_POST['id'])) {
            $data = $this->input->post();
            $this->operation($data, '修改');
        } else {
            $this->error_msg("非法操作", FALSE);
        }
    }

    /**
     * 会员组别删除     /
     */
    public function delete() {
        $this->contro_list_opreation("user_group", $this->router->fetch_method(), '会员组别');
    }

    /**
     * 会员组别审核     /
     */
    public function change() {
        $this->contro_list_opreation("user_group", $this->router->fetch_method(), '会员组别');
    }

    /**
     *  新增/修改时调用
     * @param type $data 数据
     * @param type $type 新增/修改    /
     */
    public function operation($data, $type) {
        foreach ($data as $key => $value) {
            $data[$key] = trim($data[$key]);
        }
        $result = $this->User_model->operation_user_group($data);
        $this->msg($result, $type . "会员组别", $this->router->fetch_method(), $data['title'], 'User_group/index');
    }

    /**
     *  列表页面返回 /
     */
    public function return_list() {
        //获取页数跟每页条数
        $page = $this->input->get('page');
        $limit = $this->input->get('limit');
        $page = (int) ($page - 1) * (int) $limit;
        //分页查询
        $table = $this->Common_model->pages('user_group', $limit, $page, '', '', '');
        if ($table) {
            for ($j = 0; $j < count($table); $j++) {
                if ($table[$j]['is_default'] == 0) {
                    $table[$j]['is_default'] = '×';
                } else {
                    $table[$j]['is_default'] = '√';
                }
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

}
