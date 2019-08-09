<?php

class Index extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('System_model');
    }

    public function index() {
        $this->load->view('index/index');
    }

    public function main() {
        if ($_SESSION['user_info']) {
            $user = $_SESSION['user_info'];
            $site = json_decode(file_get_contents(APPPATH . "config/site.json"), TRUE);
            $user['ip'] = $this->input->ip_address();
            $web = $site;
            $user['webname'] = $web['webname'];
            $user['weburl'] = $web['weburl'];
            $user['server_address'] = GetHostByName($_SERVER['SERVER_NAME']); //服务器IP地址
            $user['server_version'] = php_uname('s') . php_uname('r'); //服务器版本
            $user['php_version'] = PHP_VERSION;             //PHP版本
            $result = $this->Login_model->get_index_content();

            $data = array(
                'user' => $user,
                'res_top' => $this->request_key($result, array('num', 'titles')),
                'res_news' => $this->request_key($result, array('title', 'click', 'addate', 'author')),
                'res_order' => $this->request_key($result, array('user_name', 'recharge_no', 'amount', 'status', 'add_time'))
            );

            $this->load->view('index/main', $data);
            /*
              $lianglong=$this->output->get_output();
              $this->load->helper("file");
              if(!write_file(APPPATH. 'test2.html',$lianglong)){
              echo "写入文件成功";
              }else{
              echo "error";
              }
             * 
             */
        } else {
            $this->error("您还没有登录,请重新登录");
        }
    }

    public function getrole() {
        $role_id = $this->input->post('role_id');
        $data_navigation = $this->System_model->get_navigation();
        $data_rule = $this->System_model->get_role_rule($role_id);
        $nav_one[] = '';
        $nav_two[] = '';
        $nav_three[] = '';
        $nav_thress[] = '';
        $link_three[] = '';
        for ($i = 0; $i < count($data_navigation); $i++) {
            for ($j = 0; $j < count($data_rule); $j++) {
                if ($data_navigation[$i]['pid'] == 0 && $data_navigation[$i]['id'] == $data_rule[$j]['nav_id']) {
                    $nav_one[] .= $data_navigation[$i]['id'] . "-" . $data_navigation[$i]['title'] . "-" . $data_navigation[$i]['sub_title'];
                } else if ($data_navigation[$i]['pid'] != 0 && $data_navigation[$i]['sub_title'] . $data_navigation[$i]['powername'] == $data_rule[$j]['controller'] . $data_rule[$j]['action'] && $data_navigation[$i]['id'] == $data_rule[$j]['nav_id']) {
                    $nav_two[] .= $data_navigation[$i]['pid'] . "-" . $data_navigation[$i]['title'] . "-" . $data_navigation[$i]['id'];
                } else if (strpos($data_navigation[$i]['powername'], ",")) {
                    if ($data_navigation[$i]['controller'] = $data_rule[$j]['controller'] && $data_navigation[$i]['id'] == $data_rule[$j]['nav_id']) {
                        if ($data_rule[$j]['action'] == "index") {
                            $nav_three[] .= $data_navigation[$i]['pid'] . "-" . $data_navigation[$i]['title'] . "-" . $data_rule[$j]['controller'] . "/" . $data_rule[$j]['action'] . "-" . $data_rule[$j]['id'];
                        }
                    }
                }
            }
        }
        // $nav_thress[] = array_values(array_unique($nav_three));     //array_unique()去除数组中重复的数据          array_values()使数组重新排序
        unset($nav_two[0]);
        unset($nav_one[0]);
        unset($link_three[0]);
        $arr = array("title" => $nav_one, "twotitle" => $nav_two, "threetitle" => $nav_three);    //JSON_UNESCAPED_SLASHES使斜杠不被转转义
        $dataStr = str_replace("\/", "/", json_encode($arr, JSON_UNESCAPED_UNICODE));
        echo $dataStr;
    }

    //退出
    public function quit() {
        if (($user = $this->session->userdata('user_info')) == TRUE) {
            $user['lastlogtime'] = time();
            $user['lastlogip'] = $this->input->ip_address();

            $result = $this->System_model->operation_admin($user, $user['ID']);
            if ($result) {
                session_unset();    //释放当前在内存中已经创建的所有$_SESSION变量，但不删除session文件以及不释放对应的session id
                session_destroy();  //删除当前用户对应的session文件以及释放session id，内存中的$_SESSION变量内容依然保留
            }
            echo $result;
        } else {
            $this->error_msg('你还没有登录呢！');
        }
    }

    /**
     * 输出多维数组中指定列生成新的数组
     * @param type $res
     * @param type $keys
     * @return type     /
     */
    public function request_key($res, $keys) {
        for ($i = 0; $i < count($res); $i++) {
            for ($j = 0; $j < count($keys); $j++) {
                //判断数组里面是否存在该键名
                if (array_key_exists($keys[$j], $res[$i])) {
                    $res_array[$i][$keys[$j]] = $res[$i][$keys[$j]];
                }
            }
        }
        return $res_array;
    }

}
