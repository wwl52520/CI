<?php

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->islogin_or_rule();
    }

    public function index() {
        $this->output->cache(2 / 60);
        $this->load->view('user/user_list');
    }

    public function show() {
        $id = $this->uri->Segment(3);
        $data['user_group'] = $this->User_model->get_user_group(FALSE);
        if ($id == TRUE) {
            $data['list'] = $this->User_model->get_user($id);
            $this->load->view("user/user_edit", $data);
        } else {
            $this->load->view('user/user_add', $data);
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
            $this->error_msg("非法操作,新增会员信息");
        }
    }

    /**
     *  修改 /
     */
    public function edit() {
        if ($_POST) {
            $data = $this->input->post();
            $this->operation($data, '修改');
        } else {
            $this->error_msg("非法操作!");
        }
    }

    /**
     *  增加和修改时调用 /
     */
    public function operation($data, $type) {
        foreach ($data as $key => $value) {
            $data[$key] = trim($data[$key]);
        }
        $data['birthaday'] = strtotime($this->input->post('birthaday'));
        $data['password'] = base64_encode($this->input->post('password'));
        if ($type == '新增') {
            $data['createtime'] = time();
            $data['reg_ip'] = $this->input->ip_address();
        }
        $result = $this->User_model->operation_user($data);
        $this->msg($result, $type . "会员", $this->router->fetch_method(), $data['user_name'], "User/index");
    }

    /**
     * 管理员删除     /
     */
    public function delete() {
        $this->contro_list_opreation("news", $this->router->fetch_method(), '会员');
    }

    /**
     * 管理员审核     /
     */
    public function change() {
        $this->contro_list_opreation("news", $this->router->fetch_method(), '会员');
    }

    //用户输入用户名时判断用户名是否已经存在
    public function get_username() {
        $username = trim($this->input->post('uname'));
        $id = trim($this->input->post('id'));
        //判断是修改还是新增
        if ($id == FALSE) {
            $result = $this->User_model->get_user(FALSE, $username);
        } else {
            $result = $this->User_model->get_user($id, $username);
        }
        if ($result) {
            echo "1";
        } else {
            echo "0";
        }
    }

    /**
     *  上传成功后返回图片路径 /
     */
    public function return_img() {
        $this->do_uploads();
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
        $table = $this->Common_model->pages('user', $limit, $page, $keyword, '', '');
        if ($table) {
            for ($j = 0; $j < count($table); $j++) {
                $table[$j]['createtime'] = Date('Y-m-d', $table[$j]['createtime']);
                if ($table[$j]['status'] == 0) {
                    $table[$j]['status'] = '禁用';
                } else if ($table[$j]['status'] == 1) {
                    $table[$j]['status'] = '正常';
                } else {
                    $table[$j]['status'] = '待审核';
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
