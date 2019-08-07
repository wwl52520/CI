<?php

class User_recharge extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->islogin_or_rule();
    }

    public function index() {
        $this->load->view('user/user_recharge_list');
    }

    public function show() {
        $this->load->view('user/user_recharge_add');
    }

    //用户输入用户名时判断用户名是否已经存在
    public function get_username() {
        $username = trim($this->input->post('uname'));
        //判断是修改还是新增
        $result = $this->User_model->get_user(FALSE, $username);
        if ($result) {
            echo $result['id'];
        } else {
            echo 0;
        }
    }

    public function add() {
        if ($_POST) {
            $list = $this->input->post();
            $data = $this->loop_trim($list);
        }
        $data['recharge_no'] = $data['recharge_no'];
        $data['add_time'] = time();
        $data['status'] = 1;
        $query = $this->User_model->add_user_recharge($data);
        $this->msg($query, '会员充值', $this->router->fetch_method(), $data['user_name'], 'User_recharge/index');
    }

    /**
     * 会员组别删除     /
     */
    public function delete() {
        $this->contro_list_opreation("user_recharge", $this->router->fetch_method(), '会员充值订单');
    }

    /**
     *  列表页面返回 /
     */
    public function return_list() {
        $table = $this->my_return_list('user_recharge');
        if ($table) {
            for ($j = 0; $j < count($table); $j++) {
                $table[$j]['payment_id'] = $table[$j]['title'];
                $table[$j]['add_time'] = Date('Y-m-d H:i', $table[$j]['add_time']);
                $table[$j]['complete_time'] = Date('Y-m-d H:i', $table[$j]['complete_time']);
                if ($table[$j]['status'] == 0) {
                    $table[$j]['status'] = '未完成';
                } else {
                    $table[$j]['status'] = '已完成' . '(' . $table[$j]['complete_time'] . ')';
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
