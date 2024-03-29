<?php

class admin_log extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->islogin_or_rule();
    }
    
    /**
     * 列表页显示  /
     */
    public function index() {
        $this->load->view('systems/admin_log_list');
    }

    /**
     *  列表页面返回 /
     */
    public function return_list() {
        $table = $this->my_return_list('admin_log');
        if ($table) {
            for ($i = 0; $i < count($table); $i++) {
                $table[$i]['user_ip'] = $table[$i]['user_ip'] == '::1' ? '127.0.0.1' : $table[$i]['user_ip'];
                $table[$i]['add_time'] = Date('Y-m-d H:i:s', $table[$i]['add_time']);
            }
        }
        $res = $this->my_list_res($table);
        echo json_encode($res, JSON_UNESCAPED_UNICODE);        //返回只能用echo  不能用return  并且返回一定要将数组或者对象转为json数组或者对象 
    }

    public function delete() {
        $result = $this->System_model->delete_admin_log();
        echo $result;
    }

}
