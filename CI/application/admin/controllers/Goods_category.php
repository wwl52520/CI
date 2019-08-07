<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Goods_category extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->need_login = TRUE;
        $this->load->model('Goods_model');
        $this->islogin_or_rule();
    }

    /**
     * 列表页显示
     */
    public function index() {
        $category = $this->Goods_model->get_category(0);
        $data['cate'] = $this->tree_all($category, 0, "cate_list", 0);
        $this->load->view('goods/goods_category_list', $data);
    }

    /**
     * 分类显示
     */
    public function show() {
        //获取编辑id，如果Id为false则是新增
        $id = $this->uri->segment(3);
        $category = $this->Goods_model->get_category(0);
        if ($id == FALSE) {
            $data['cate'] = $this->tree_all($category, 0, "cate_edit", 0);
            $this->load->view('goods/goods_category_add', $data);
        } else {
            $data = array
                (
                'cate' => $this->tree_all($category, 0, "cate_edit", $id),
                'list' => $this->Goods_model->get_category($id)
            );
            $this->load->view('goods/goods_category_edit', $data);
        }
    }

    /**
     * 分类新增/
     */
    public function add() {
        if ($_POST) {
            $data = $this->input->post();
            if ($data['sort'] == FALSE) {
                $data['sort'] = 99;
            }
            $this->operation($data, '新增', FALSE);
        } else {
            $this->error_msg("非法操作", FALSE);
        }
    }

    /**
     * 分类修改
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
     * 新增或者修改时调用
     * @param type  $data 表单结果集
     * @param type $type 类型 新增或者修改
     * @param type $id   id  有id则为修改，没有则false  /
     */
    public function operation($data, $type, $id) {
        foreach ($data as $key => $value) {
            $data[$key] = trim($data[$key]);
        }
      
        $result = $this->Goods_model->operation_category($data, $id);
        $this->msg($result, $type . '商品分类', $this->router->fetch_method(), $data['category_Name'], 'Goods_category/index');
    }

 /**
     * 商品分类删除     /
     */
    public function delete() {
        $this->contro_list_opreation("goods_category", $this->router->fetch_method(), '商品分类');
    }

    
    
    
      //上传成功后返回图片路径
    public function return_img() {
        $this->do_uploads();
    }
    
    
    /**
     * 返回分类列表
     */
    public function return_list() {
      $table = $this->my_return_list('goods_category');
        if ($table) {
            $res['total'] = $table['sum'];
        } else {
            $res['total'] = 0;
        }
        $res['status'] = 200;
        $res['hint'] = '';
        $res['rows'] = $table;
        echo json_encode($res, JSON_UNESCAPED_UNICODE);        //返回只能用echo  不能用return  并且返回一定要将数组或者对象转为json数组或者对象 
    }
    
 
}
