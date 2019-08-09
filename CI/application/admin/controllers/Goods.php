<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Goods extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Goods_model');
        $this->load->model('Common_model');
        $this->islogin_or_rule();
    }

    //列表页显示
    public function index() {
        $category = $this->Goods_model->get_category(0);
        $data = array(
            'cate' => $this->tree_all($category, 0, "info_list", 0)
        );
        $this->load->view('goods/goods_list', $data);
    }

    /**
     * 商品显示/
     */
    public function show() {
        $category = $this->Goods_model->get_category(0);
        $cid = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        //判断是新增还是修改
        if ($id) {
            //获得goods中id为$id相关联的所有表数据
            $goods_all = $this->Goods_model->get_goods($id);

            //若果没有上传内容则赋值数组内容为0
            for ($j = 0; $j < count($goods_all); $j++) {
                if (isset($goods_all[$j]) == FALSE) {
                    $goods_all[$j] = 0;
                }
            }
            $data = array(
                'list' => $goods_all[0][0],
                'albums' => $goods_all[1],
                'goods_spec' => $goods_all[2],
                'goods_spec_item' => $goods_all[3],
                'spec_list' => $this->Goods_model->get_spec(),
                'cate' => $this->tree_all($category, 0, "cate_edit", $cid)
            );
            //修改时得到选中的规格信息
            if ($goods_all[2]) {
                $data['string_goods_spec'] = $this->loop_goods_spec($goods_all[2]);
            } else {
                $data['string_goods_spec'] = $goods_all[2];
            }
            $this->load->view('goods/goods_edit', $data);
        } else {
            $data = array(
                'spec_list' => $this->Goods_model->get_spec(),
                'cate' => $this->tree_all($category, 0, "cate_edit", $cid)
            );
            $this->load->view('goods/goods_add', $data);
        }
    }

    /**
     * 商品新增  /
     */
    public function add() {
        if ($_POST) {
            $this->operation('新增');
        } else {
            $this->error_msg("非法操作", FALSE);
        }
    }

    /**
     * 商品编辑  /
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
     * @param type  $data 表单结果集
     * @param type $type 类型 新增或者修改
     * @param type $id   id  有id则为修改，没有则false  /
     */
    public function operation($type) {
        $list = $this->input->post();
        $data = $this->loop_trim($list);
        $data['add_time'] = strtotime($data['add_time']);
        //得到相册数据内容
        $data['goods_albums'] = $this->albums_string($data);
        //得到选中生成的商品货号以及选中的商品规格
        $data['spec_good_item'] = $this->goods_item($data);
        if ($data['spec_good_item']) {
            $data['goods_spec_list'] = substr($data['goods_spec_list'], 0, strlen($data['goods_spec_list']) - 1);
        } else {
            $data['goods_spec_list'] = '';
        }
        if (isset($data['id'])) {
            $result = $this->Goods_model->operation_goods($data, $data['id']);
        } else {
            $result = $this->Goods_model->operation_goods($data);
        }
        $this->msg($result, $type . '商品', $this->router->fetch_method(), $data['title'], 'Goods/index');
    }

    /**
     * 删除     /
     */
    public function delete() {
        $this->contro_list_opreation("goods", $this->router->fetch_method(), '商品');
    }

    /**
     * 审核     /
     */
    public function change() {
        $this->contro_list_opreation("goods", $this->router->fetch_method(), '商品');
    }

    //上传成功后返回图片路径
    public function return_img() {
        $this->do_uploads();
    }

    //列表页面返回
    public function return_list() {
        $table = $this->my_return_list('goods');
        if ($table) {
            for ($j = 0; $j < count($table); $j++) {
                $table[$j]['add_time'] = Date('Y-m-d H:i', $table[$j]['add_time']);
                $table[$j]['status'] = $table[$j]['status'] == 0 ? '未审核' : '已审核';
            }
        }
        $res = $this->my_list_res($table);
        echo json_encode($res, JSON_UNESCAPED_UNICODE);        //返回只能用echo  不能用return  并且返回一定要将数组或者对象转为json数组或者对象 
    }

    /**
     * 将相册数组转成字符串
     * @param type $data     /
     */
    public function albums_string($data) {
        $goods_albums = '';
        if (isset($data['albums']) && count($data['albums']) > 0) {
            for ($i = 0; $i < count($data['albums']); $i++) {
                $goods_albums .= $data['albums'][$i] . '|';
            }
            return $goods_albums;
        } else {
            return '';
        }
    }

    /**
     * 动态修改列表页面的属性 热门/推荐/评论
     */
    public function change_attribute() {
        $name = $this->input->post('name');
        $id = $this->input->post('id');
        $val = $this->input->post('val');
        $result = $this->Goods_model->change_attribute($val, $name, $id);
        echo $result;
    }

    /**
     * 将商品货号数组转成字符串 （方便在数据库中存储过程的运算）
     * @param type $data     /
     */
    public function goods_item($data) {
        //将商品规格信息的数组转成字符串
        $spec_good_item = '';
        if (isset($data['spec_goods_no']) && $data['spec_goods_no'] > 0) {
            for ($j = 0; $j < count($data['spec_goods_no']); $j++) {
                $spec_good_item .= $data['spec_goods_no'][$j] . '--' . $data['spec_ids'][$j] . '--' . $data['spec_text'][$j] . '--' . $data['spec_stock'][$j] . '--' . $data['spec_market_price'][$j] . '--' . $data['spec_sell_price'][$j] . '|';
            }
            $result = substr($spec_good_item, 0, -1);
            return $result;
        } else {
            $data['goods_spec_list'] = '';
            return '';
        }
    }

    /**
     * 得到商品选中的规格信息 
     * @param type $data  商品选中的规格信息   /
     */
    public function loop_goods_spec($data) {
        $str_all_info = '';
        if ($data) {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['pid'] == 0) {
                    $str_parent_info = $data[$i]['spec_id'] . '--' . '0' . '--' . $data[$i]['title'] . '--' . '*' . '|';
                    $str_all_info .= $str_parent_info;
                } else {
                    $str_child_info = $data[$i]['spec_id'] . '--' . $data[$i]['pid'] . '--' . $data[$i]['title'] . '--' . $data[$i]['img_url'] . '|';
                    $str_all_info .= $str_child_info;
                }
            }
        }
        return $str_all_info;
    }

}
