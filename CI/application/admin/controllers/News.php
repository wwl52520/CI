<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class News extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('News_model');
        // $this->load->library("Redis");
        $this->islogin_or_rule();
    }

    //列表页显示
    public function index() {

        $this->output->cache(1 / 60);
        $category = $this->News_model->get_category(0);
        $data = array(
            'cate' => $this->tree_all($category, 0, "info_list", 0)
        );
        $this->load->view('news/news_list', $data);
    }

    /**
     * 新闻显示/
     */
    public function show() {
        $this->output->cache(1 / 60);
        $category = $this->News_model->get_category(0);
        $cid = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        if (!empty($id)) {
            $data = array(
                'list' => $this->News_model->get_news($id),
                'cate' => $this->tree_all($category, 0, "cate_edit", $cid)
            );
            $this->load->view('news/news_edit', $data);
        } else {
            $data['cate'] = $this->tree_all($category, 0, "cate_edit", 0);
            $this->load->view('news/news_add', $data);
        }
    }

    /**
     * 新闻新增  /
     */
    public function add() {
        if ($_POST) {
            $this->operation('新增');
        } else {
            $this->error_msg("非法操作", FALSE);
        }
    }

    /**
     * 新闻编辑  /
     */
    public function edit() {
        if ($_POST) {
            $this->operation('修改');
        } else {
            $this->error_msg("非法操作", FALSE);
        }
    }

    /**
     * 新增或者修改时调用
     * @param type  
     * @param type $type 类型 新增或者修改
     * @param type $id   id  有id则为修改，没有则false  /
     */
    public function operation($type) {
        $list = $this->input->post();
        $data = $this->loop_trim($list);
        $data['addate'] = strtotime($data['addate']);
        $id = isset($data['id']) == TRUE ? $data['id'] : FALSE;
        $result = $this->News_model->operation_news($data, $id);
        $this->msg($result, $type . '新闻', $this->router->fetch_method(), $data['title'], 'News/index');
    }

    /**
     * 新闻删除 /
     */
    public function delete() {
        $this->contro_list_opreation("news", $this->router->fetch_method(), '新闻');
    }

    /**
     * 新闻数据审核     /
     */
    public function change() {
        $this->contro_list_opreation("news", $this->router->fetch_method(), '新闻');
    }

    //上传成功后返回图片路径
    public function return_img() {
        $this->do_uploads();
    }

    //列表页面返回
    public function return_list() {
        $table = $this->my_return_list('news');
        if ($table) {
            for ($j = 0; $j < count($table); $j++) {
                $table[$j]['addate'] = Date('Y-m-d', $table[$j]['addate']);
                $table[$j]['Status'] = $table[$j]['Status'] == 0 ? "未审核" : "已审核";
            }
        }
        $res = $this->my_list_res($table);
        echo json_encode($res, JSON_UNESCAPED_UNICODE);        //返回只能用echo  不能用return  并且返回一定要将数组或者对象转为json数组或者对象 
    }

}
