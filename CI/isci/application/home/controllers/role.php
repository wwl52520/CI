<?php

class role extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        //  $this->config->load('email', FALSE, TRUE);
        $this->load->model('login_model');
        $this->load->model('system_model');
    }

    public function index() {
  $this->output->cache(1/60);
        $data = array('list' => $this->system_model->get_role(0));
        $this->load->view('systems/role_list', $data);
    }

    public function show() {
        $id = $this->uri->segment(3);
        if ($id == FALSE) {
            $data = array('list' => $this->system_model->get_navigation());
            $this->load->view('systems/role_add', $data);
            
            
        } else {
            $data['list'] = $this->system_model->get_navigation();
            $data['role']=$this->system_model->get_role($id);
            
            $this->load->view('systems/role_edit', $data);

        }
    }

    public function add() {
        $data['role_name'] = $this->input->post("role_name");
        $data['controller'] = $this->input->post('allck');
        $result = $this->system_model->get_role($data['role_name']);
        if ($result == FALSE) {
            $res = $this->system_model->add_role($data);
            if ($res['id']) {
                $contlength = count($data['controller']);
                $resultlast = 0;
                for ($i = 0; $i < $contlength; $i++) {
                    $array = $data['controller'][$i];
                    $arrlist = explode('-', $array);
                    $rule_result = $this->system_model->add_role_rule((int) $res['id'], (int)$arrlist[0], $arrlist[1],$arrlist[2]);
                    $resultlast++;
                }
                if ($resultlast == $contlength) {
                    $msg = "新增成功";
                    echo "<script>alert('$msg');</script>";
                    $this->index();
                    redirect('role/index');
                } else {
                    $msg = "新增失败";
                    alert($msg);
                }
            }
        }
    }

    public function delete() {
        //获取传过来的id
        $id = $this->input->post('iditem');
        //判断是提交的一个还是多个，is_numeric判断是否是数组
        if (!is_numeric($id)) {
            //根据，分割字符串转为数组
            $item = explode(",", $id);
            //获取数组个数
            $counts = count($item);
            for ($i = 0; $i < $counts; $i++) {
                $list[$i] = $item[$i];
            }
            //删除第一个数组元素  unset  第一个元素，
            unset($list[0]);
        }
        $query = $this->system_model->delete('admin_role',$list);
        echo '{"count":"' . $query . '"}';
    }
    
    
    public function rule_load() {
        $id = $this->input->post('id');
        $admin_rul = $this->system_model->get_role_rule($id); //存在的规则
        $rules='';
            foreach ($admin_rul as $editurle)
            {
                $rules.=",".$editurle['nav_id']."-".$editurle['controller']."-".$editurle['action']; 
            }
            $rulenght= strlen($rules);
            $rules= substr($rules, "1",$rulenght);
        echo "{$rules}";
       
    }

    public function edit()
    {
      
        $data['role_name'] = $this->input->post("role_name");
        $data['controller'] = $this->input->post('allck');
        $data['role_id']=$this->input->post('role_id');
        $result = $this->system_model->update_role($data);
        $deres=$this->system_model->role_delete('admin_rule',$data['role_id']);
        if($deres==TRUE)
        {
                $contlength = count($data['controller']);
                $resultlast = 0;
               
                for ($i = 0; $i < $contlength; $i++) {
                    $array = $data['controller'][$i];
                    $arrlist = explode('-', $array);
                    $rule_result = $this->system_model->add_role_rule((int) $data['role_id'], (int)$arrlist[0], $arrlist[1],$arrlist[2]);
                    $resultlast++;
                }
                if ($resultlast == $contlength) {
                    $msg = "修改成功";
                    echo "<script>alert('$msg');</script>";
                    $this->index();
                    redirect('role/index');
                } else {
                    $msg = "修改失败";
                    alert($msg);
                }
        }
    }
    
    public function alert($msg) {
        echo "<script>alert('$msg')</script>";
    }

}
