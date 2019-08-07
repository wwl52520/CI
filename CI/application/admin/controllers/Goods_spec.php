<?php

class Goods_spec extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Goods_model');
        $this->islogin_or_rule();
    }

    /**
     * 列表页显示 /
     */
    public function index() {
        $this->load->view('goods/spec_list');
    }

    /**
     * 新增/修改页面显示
     */
    public function show() {
        $id = $this->uri->segment(3);
        if ($id == FALSE) {
            $this->load->view('goods/spec_add');
        } else {
            $data['list'] = $this->Goods_model->get_spec($id);
            
            $this->load->view('goods/spec_edit', $data);
        }
    }

    /**
     * 规格新增 /
     */
    public function add() {
        if ($_POST) {
            $data = $this->input->post();
            $data['pid'] = 0;
            $this->operation($data, '新增');
        } else {
            $this->error_msg("非法操作,新增会员信息");
        }
    }

    /**
     * 规格修改 /
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
     * 规格删除     /
     */
    public function delete() {
        $this->contro_list_opreation("spec", $this->router->fetch_method(), '规格');
    }
    

    
    
    /**
     * 增加和修改时调用
     * @param type $data
     * @param type $type 操作类型   /
     */
    public function operation($data, $type) {
        foreach ($data as $key => $value) {
            if ($key != 'spec_content') {
                $data[$key] = trim($data[$key]);
            }
        }
        if ($type == '新增') {
            //得到父类ID
            $res = $this->Goods_model->operation_spec($data);
        }
        //修改
        else {
            $data['pid'] = 0;
            //开启事务
            $this->db->trans_start();
            //禁用严格模式
            $this->db->trans_strict(FALSE);
            //删除大规格下所有子规格
            $this->Goods_model->delete_spec($data['id']);
            //修改大分类信息
            $this->Goods_model->operation_spec($data);
            $this->db->trans_complete();
            //判断事物提交是否有错误
            if ($this->db->trans_status() === FALSE) {
                $this->error_msg('父规格新增');
                die();
            }
            $res = $data['id'];
        }
        //判断是否存在子类
        if ($res > 0 && isset($data['spec_content'])) {
            $list = [];
            for ($i = 0; $i < count($data['spec_content']); $i++) {
                //分割字符串为数组，得到三个参数,然后添加到后台
                $spli = explode('|', $data['spec_content'][$i]);
                $list = array('title' => $spli[0], 'img_url' => $spli[1], 'sort_id' => $spli[2], 'pid' => $res);
                $result = $this->Goods_model->operation_spec($list);
                $this->msg($result, $type . '规格', $this->router->fetch_method(), $data['title'], 'Goods_spec/index');
            }
        } else if (!isset($data['spec_content']) && $res > 0) {
            $this->success_msg('规格新增', 'Goods_spec/index');
        } else {
            $this->error_msg('规格新增');
        }
    }

    /**
     *  上传成功后返回图片路径
     */
    public function return_img() {
        $this->do_uploads();
    }

    /**
     * 列表页面返回信息
     */
    public function return_list() {
          $table = $this->my_return_list('spec');
        if ($table) {
            for ($j = 0; $j < count($table); $j++) {
                //判断是否是顶级层
                if ($table[$j]['pid'] == 0) {
                    //将数据放到新的数组
                    $dt[$j]['title'] = $table[$j]['title'];
                    $dt[$j]['id'] = $table[$j]['id'];
                    $dt[$j]['sort_id'] = $table[$j]['sort_id'];
                    $dt[$j]['remake'] = '';
                    //再次循环 判断顶层分类的id与循环的中的下级分类的父ID是否相等
                    for ($i = 0; $i < count($table); $i++) {
                        //如果相等，将对应的下级分类的名称赋给新的数组中，这样就将数组重新组合了
                        if ($dt[$j]['id'] == $table[$i]['pid']) {
                            //判断规格图片是否有，没有就显示文字
                            if ($table[$i]['img_url'] == FALSE) {
                                $dt[$j]['remake'] .= '<span class="spec_box">' . $table[$i]['title'] . '</span>' . " ";
                            } else {
                                $dt[$j]['remake'] .= '<span class="spec_box" style="border:none" title="' . $table[$i]['title'] . '"><img src="/' . $table[$i]['img_url'] . '" alt="' . $table[$i]['title'] . '">';
                            }
                        }
                    }
                }
            }
            $res['total'] = $table[0]['sum'];
        } else {
            $res['total'] = 0;
        }
        $res['status'] = 200;
        $res['hint'] = '';
        $res['rows'] = $dt;
        echo json_encode($res, JSON_UNESCAPED_UNICODE);        //返回只能用echo  不能用return  并且返回一定要将数组或者对象转为json数组或者对象 
    }

}
