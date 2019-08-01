<?php

class admin extends MY_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('System_model');
        $this->load->model('Common_model');
        $this->load->library('form_validation');
        $this->islogin_or_rule();
    }

    /**
     *  显示列表页面 /
     */
    public function index() {
        $this->output->cache(1 / 60);
        $data = array
            (
            'admin_list' => $this->System_model->get_admin(FALSE),
            'admin_role' => $this->System_model->get_role(0)
        );
        $this->load->view('systems/admin_list', $data);
    }

    /**
     *  根据ID有无加载新增/修改页面 /
     */
    public function show() {
        $id = $this->uri->segment(3);
        $data['admin_role'] = $this->System_model->get_role(0);
        if ($id == FALSE) {
            $this->load->view('systems/admin_add', $data);
        } else {
            $data['admin_list'] = $this->System_model->get_admin($id);
            $this->load->view('systems/admin_edit', $data);
        }
    }

    /**
     *  管理员修改 /
     */
    public function edit() {
        if ($_POST) {
            $data = $this->input->post();
            $this->operation($data, '修改', $data['id']);
        } else {
            $this->error_msg("非法操作", FALSE);
        }
    }
    
    /**
     *  管理员新增 /
     */
    public function add() {
        if ($_POST) {
            $data = $this->input->post();
            $this->operation($data, '新增',FALSE);
        } else {
            $this->error_msg("非法操作", FALSE);
        }
    }
    
    
     
    /**
     * 管理员删除     /
     */
    public function delete() {
        $this->contro_list_opreation("admin", $this->router->fetch_method(), '管理员');
    }
    
    /**
     * 管理员审核     /
     */
    public function change() {
        $this->contro_list_opreation("admin", $this->router->fetch_method(), '管理员');
    }
    
    
    
    /**
     * 新增和修改时调用
     */     
    public function operation($data, $type, $id) {
        $this->form_validation->set_rules('UserName', 'UserName', 'required|alpha_dash', '用户名不能输入汉字,请输入正确的格式');
        $this->form_validation->set_rules('Password', 'Password', 'required|alpha_dash', '用户名不能输入汉字,请输入正确的格式');
        if ($this->form_validation->run() == FALSE) {
            $this->error_msg("用户名和密码不能输入汉字,请输入正确的格式",FALSE);
        } else {
            foreach ($data as $key => $value) {
                $data[$key] = trim($data[$key]);
            }
            if ($type == '新增') {
                //给salt赋值一个随机的6位数字字母数
                $data['salt'] = $this->getRandomString();
            } else {
                //如果密码没有修改
                if ($data['Password'] == "0_0_0_0") {
                    $data['Password'] == $data['is_pass'];
                }
            }
            $data['Password'] = md5($data['salt'] . $data['Password']);
            $result = $this->System_model->operation_admin($data, $id);
            $this->msg($result, $type . '管理员', $this->router->fetch_method(), $data['UserName'], 'admin/index');
        }
    }

    /**
     *  上传成功后返回图片路径 /
     */
    public function return_img() {
        $this->do_uploads();
    }
    
    //用户输入用户名时判断用户名是否已经存在
    public function get_username() {
        $username = trim($this->input->post('uname'));
        $id = trim($this->input->post('id'));
        //判断是修改还是新增
        if ($id == FALSE) {
            $result = $this->System_model->get_admin(FALSE, $username);
        } else {
            $result = $this->System_model->get_admin($id, $username);
        }
        echo $result;
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
        $table = $this->Common_model->pages('admin', $limit, $page, $keyword, '', '');
        if ($table) {
            for ($j = 0; $j < count($table); $j++) {
                $table[$j]['ctime'] = Date('Y-m-d', $table[$j]['ctime']);
                if ($table[$j]['islock'] == 0) {
                    $table[$j]['islock'] = '禁用';
                } else {
                    $table[$j]['islock'] = '启用';
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
