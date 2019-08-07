<?php

class User_message extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->islogin_or_rule();
    }

    /**
     * 列表页显示   
     */
    public function index() {
        $this->load->view('user/user_message_list');
    }

    public function show() {
        $id = $this->uri->Segment(3);
        if ($id != FALSE) {
            $data['list'] = $this->User_model->get_user_message($id);
            $data['list']['type'] = $this->get_mess_type($data['list']['type']);
            $data['list']['post_time'] = Date('Y-m-d H:i:s', $data['list']['post_time']);
            if ($data['list']['read_time'] != FALSE) {
                $data['list']['read_time'] = Date('Y-m-d H:i:s', $data['list']['read_time']);
            }
            if ($data['list']['is_read'] == 0) {
                $data['list']['is_read'] = "未阅读";
            } else {
                $data['list']['is_read'] = "已阅读";
            }
            $this->load->view('user/user_message_edit', $data);
        } else {
            $this->load->view('user/user_message_add');
        }
    }

    public function add() {
        if ($_POST) {
            $data = $this->input->post();
            foreach ($data as $key => $value) {
                $data[$key] = trim($data[$key]);
            }
            $data['post_user_name'] = '-';
            $data['is_read'] = 0;
            $data['type'] = 1;
            $data['post_time'] = time();
            $result = $this->User_model->add_user_message($data);
            $this->msg($result, '发送系统邮件', $this->router->fetch_method(), $data['accept_user_name'], 'user_message/index');
        } else {
            $this->error_msg('非法操作', FALSE);
        }
    }

    public function get_username() {
        $user_name = $this->input->post('uname');
        //判断是提交的一个还是多个，is_numeric判断是否是数组
        if (!is_numeric($user_name)) {
            //根据，分割字符串转为数组
            $item = explode(",", $user_name);
            $query = $this->user_model->get_user(FALSE, $item);
            if ($query == TRUE && $query == count($item)) {
                echo "1";
            }
        } else {
            $item = [$user_name];
            $query = $this->user_model->get_user(FALSE, $item);
            if ($query) {
                echo "1";
            }
        }
        echo '0';
    }

    /**
     *  列表页面返回 /
     */
    public function return_list() {
         $table = $this->my_return_list('user_message');
        if ($table) {
            for ($j = 0; $j < count($table); $j++) {
                $table[$j]['post_time'] = Date('Y-m-d H:i', $table[$j]['post_time']);
                $table[$j]['type'] = $this->get_mess_type($table[$j]['type']);
                if ($table[$j]['is_read'] == 0) {
                    $table[$j]['is_read'] = '未阅读';
                } else {
                    $table[$j]['is_read'] = '已阅读';
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

    public function get_mess_type($type) {
        switch ($type) {
            case "1":
                return "系统消息";
            case "2" :
                return "收件箱";
            case "3" :
                return "发件箱";
        }
    }

}
