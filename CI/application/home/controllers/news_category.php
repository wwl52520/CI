<?php

class news_category extends MY_Controller {

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
    
    public function index()
    { 
        $this->output->cache(1/60);
         $this->output->cache(1);
        $data['category']=$this->news_model->get_category(0);
        $this->load->view('news/category_list',$data);
    }
    
    /**
     * 分类显示
     */
    public function show()
    {
        //获取编辑id，如果Id为false则是新增
        $id = $this->input->get("edit");
        //判断是新增
        if ($id == FALSE)
        {
            $addid = $this->input->get('add');
            if ($addid == true)
            {
                $data = array
                (
                    'category' => $this->news_model->get_category(0),
                    'list' => array('id' => $addid)
                );
                $this->load->view('news/category_add', $data);
            } 
           else 
           {
                $data = array ( 'category' => $this->news_model->get_category(0));
                $this->load->view('news/category_add', $data);
            }
        }
        //编辑
        else
        {
            $data = array
                (
                'category' => $this->news_model->get_category(0),
                'list' => $this->news_model->get_category($id)
            );
            $this->load->view('news/category_edit', $data);
        }
    }

    public function edit() {
        if (isset($_POST['btn']) && $_POST['btn'] == 'edit') {
            $data['pid'] = $this->input->post('newtype');
            $id = $this->input->post('category_id');
            $data['category_Name'] = $this->input->post('category_Name');
            $data['content']=$this->input->post('editor_id');
            $data['sort'] = $this->input->post('sort');
            $result = $this->news_model->operation_category($data, $id);
            if ($result > 0) {
                $msg = "编辑成功";
                echo "<script>alert('$msg');</script>";
                
                $this->category_list();
            } else {
                $msg = "编辑失败";
                alert($msg);
            }
        }
    }

    
    public function add()
    {
        if(isset($_POST['btn']) && $_POST['btn']=='add')
        {
            $data['pid'] = $this->input->post('newtype');
            $id = $this->input->post('category_id');
            $data['category_Name'] = $this->input->post('category_Name');
            $data['content']=$this->input->post('editor_id');
            $data['sort'] = $this->input->post('sort');
             $result = $this->news_model->operation_category($data, 0);
            if ($result > 0) {
                $msg = "新增成功";
                echo "<script>alert('$msg');</script>";
                
                $this->category_list();
            } else {
                $msg = "新增失败";
                alert($msg);
            }
        }
    }
}
