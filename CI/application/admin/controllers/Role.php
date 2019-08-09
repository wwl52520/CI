<?php

class Role extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->islogin_or_rule();
    }

    public function index() {
        $this->output->cache(1/10);
        $data = array('list' => $this->System_model->get_role());
        $this->load->view('systems/role_list', $data);
    }

    public function show() {
        $id = $this->uri->segment(3);
        $list = $this->System_model->get_navigation();
        $data = array('tree_nav' => $this->tree_all($list, 0, "nav_list", 0));
        if ($id == FALSE) {
            $this->load->view('systems/role_add', $data);
        } else {
            $data['role'] = $this->System_model->get_role($id);
            $this->load->view('systems/role_edit', $data);
        }
    }

    //这里有逻辑bug（代码在   if ($resultlast == $contlength) 这个逻辑判断中，因为有其他的错误导致这两个值不相等） 后期记得解决！
    public function add() {
        $data['role_name'] = trim($this->input->post("role_name"));
        $data['controller'] = $this->input->post('allck');
        //先查询是否存在重复的角色名，不存在就新增！
        $result = $this->System_model->add_role($data);
        //判断是否新增成功  
        $this->operation($result, $data, '新增');
    }

    /**
     * 管理员删除     /
     */
    public function delete() {
        $this->contro_list_opreation("admin_role", $this->router->fetch_method(), '角色');
    }



    //获取前端传过来的ID对应的角色规则
    public function rule_load() {
        $id = $this->input->post('id');
        $admin_rul = $this->System_model->get_role_rule($id); //存在的规则
        $rules = '';
        foreach ($admin_rul as $editurle) {
            $rules .= "," . $editurle['nav_id'] . "-" . $editurle['controller'] . "-" . $editurle['action'];
        }
        $rulenght = strlen($rules);
        $rules = substr($rules, "1", $rulenght);
        echo "{$rules}";
    }

    public function edit() {
        $data['role_name'] = $this->input->post("role_name");
        $data['controller'] = $this->input->post('allck');
        $data['role_id'] = $this->input->post('role_id');
        $result = $this->System_model->update_role($data);
        $this->operation($result, $data, '修改');
    }
    

    //新增或者修改时调用该方法
    public function operation($result, $data, $type) {
        if ($result != FALSE) {
            //这里是得到权限的选中个数，如果个数为0，则代表只是添加了一个角色名称，并没有选择权限内容，但是也是新增成功的
            $contlength = count($data['controller']);

            //判断是否有权限需要添加
            if ($contlength > 1) {
                $control = array_values($data['controller']);        //重新排序数组索引
                $resultlast = 0;
                for ($i = 0; $i < $contlength; $i++) {
                    $array = $control[$i];
                    $arrlist = explode('-', $array);
                    $rule_result = $this->System_model->add_role_rule((int) current($result), (int) $arrlist[0], $arrlist[1], $arrlist[2]);
                    $resultlast++;
                }
                if ($resultlast == $contlength) {
                    $result = TRUE;
                    $this->msg($result, $type . '角色', $this->router->fetch_method(), $data['role_name'], 'role/index');
                }
            } else {
                $this->add_admin_log(array('type' => $this->router->fetch_method(), 'remark' => '' . $type . '角色' . $data['role_name']));
                $this->success_msg('' . $type . '角色', 'role/index');
            }
        } else {
            $this->error_msg('该角色名称已存在,' . $type);
        }
    }

    /**
     *  列表页面返回 /
     */
    public function return_list() {
        $table = $this->my_return_list('admin_role');
        $res = $this->my_list_res($table);
        echo json_encode($res, JSON_UNESCAPED_UNICODE);        //返回只能用echo  不能用return  并且返回一定要将数组或者对象转为json数组或者对象 
    }

}
