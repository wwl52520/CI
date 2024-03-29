<?php

/**
 * Description of goods_comment
 *
 * @author Administrator
 */
class Goods_comment extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Goods_model');
    }

    public function index() {
        $this->load->view('goods/comment_list');
    }

    public function show() {
        $id = $this->uri->segment(3);
        $data['list'] = $this->Goods_model->get_comment($id);
        $this->load->view('goods/comment_edit', $data);
    }

    public function edit() {
        $list = $this->input->post();
        $data = $this->loop_trim($list);
        $result = $this->Goods_model->update_comment($data);
        $this->msg($result, '回复评论', $this->router->fetch_method(), $data['title'], 'Goods_comment/index');
    }

    /**
     * 商品评论删除     /
     */
    public function delete() {
        $this->contro_list_opreation("goods_comment", $this->router->fetch_method(), '商品评论');
    }

    /**
     * 商品评论审核  /
     */
    public function change() {
        $this->contro_list_opreation("goods_comment", $this->router->fetch_method(), '商品评论');
    }

    //列表页面返回
    public function return_list() {
        $table = $this->my_return_list('goods_comment');
        if ($table) {
            for ($j = 0; $j < count($table); $j++) {
                $table[$j]['add_time'] = Date('Y-m-d H:i', $table[$j]['add_time']);
                if (isset($table[$j]['reply_time'])) {
                    $table[$j]['reply_time'] = Date('Y-m-d H:i', $table[$j]['reply_time']);
                }
            }
        }
        $res = $this->my_list_res($table);
        echo json_encode($res, JSON_UNESCAPED_UNICODE);        //返回只能用echo  不能用return  并且返回一定要将数组或者对象转为json数组或者对象 
    }

}
