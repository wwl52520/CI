<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class news extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->need_login = TRUE;
        $this->load->model('news_model');
        $this->load->helper('url');
        $this->load->library('pagination'); //系统的library 
        $this->load->helper(array('form', 'url'));
        //加载CI表单验证库  
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->islogin_or_rule();
    }

    public function index() {
      $this->output->cache(1/60);
        $table = $this->pages('news');
        $data = array(
            'category' => $this->news_model->get_category(0),
            'list' => $table
        );

        $this->load->view('news/news_list', $data);
    }

    /**
     * 新闻显示/
     */
    public function show() {
        $id = $this->uri->segment(3);
        if (!empty($id)) {
            $data = array(
                'list' => $this->news_model->get_news($id),
                'category' => $this->news_model->get_category(0)
            );

            $this->load->view('news/news_edit', $data);
        } else {
            $data['category'] = $this->news_model->get_category(0);
            $this->load->view('news/news_add', $data);
        }
    }

    /**
     * 新闻编辑  /
     */
    public function edit() {
        if (isset($_POST['btn']) && $_POST['btn'] == 'edit') {
            $data['Img'] = $this->do_uploads();
            if (empty($data['Img'])) {
                $data['Img'] = $this->input->post('img');
            }
            $id = $this->input->post('id');
            if ($id == TRUE) {
                $data['title'] = $this->input->post('title');
                $data['Status'] = $this->input->post('status');
                $data['NewType'] = $this->input->post('newtype');
                $data['sort'] = $this->input->post('sort');
                $data['click'] = $this->input->post('click');
                $time = $this->input->post('addate');
                $data['addate'] = strtotime($time);
                $data['content'] = $this->input->post('editor_id');
                $data['seo_title'] = $this->input->post('seo_title');
                $data['seo_keywords'] = $this->input->post('seo_keywords');
                $data['seo_description'] = $this->input->post('seo_description');
                $result = $this->news_model->operation_news($data, $id);
                if ($result > 0) {
                    $msg = "修改成功";
                    echo "<script>alert('$msg');</script>";
                    $this->index();
                } else {
                    $msg = "修改失败";
                    alert($msg);
                }
            } else {
                echo " <script>alert('ID不能为空,请联系管理员！');history.go(-2);</script>";
            }
        } else {
            echo " <script>alert('提交失败,请联系管理员');history.go(-2);</script>";
        }
    }

    /**
     * 新闻新增  /
     */
    public function add() {
        if (isset($_POST['btn']) && $_POST['btn'] == 'add') {
            $data['Img'] = $this->do_uploads();
            if (empty($data['Img'])) {
                $data['Img'] = $this->input->post('img');
            }
            $data['title'] = $this->input->post('title');
            $data['Status'] = $this->input->post('status');
            $data['NewType'] = $this->input->post('newtype');
            $data['sort'] = $this->input->post('sort');
            $data['click'] = $this->input->post('click');
            $time = $this->input->post('addate');
            $data['addate'] = strtotime($this->input->post('birthaday'));
            $data['content'] = $this->input->post('editor_id');
            $data['seo_title'] = $this->input->post('seo_title');
            $data['seo_keywords'] = $this->input->post('seo_keywords');
            $data['seo_description'] = $this->input->post('seo_description');

            $result = $this->news_model->operation_news($data, '');
            if ($result > 0) {
                $msg = "新增成功";
                echo "<script>alert('$msg');</script>";
                $this->index();
            } else {
                $msg = "新增失败";
                alert($msg);
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
        $query = $this->common_model->delete('news', $list);
        echo '{"count":"' . $query . '"}';
    }

    public function alert($msg) {
        echo "<script>alert('$msg');history.go(-1);</script>";
        die();
    }

}
