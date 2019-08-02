<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class News_category extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->need_login = TRUE;
        $this->load->model('News_model');
        $this->islogin_or_rule();
    }

    /**
     * 列表页显示
     */
    public function index() {
        $this->output->cache(1 / 60);
        $category = $this->News_model->get_category(0);
        $data['cate'] = $this->tree_all($category, 0, "cate_list", 0);
        $this->load->view('news/category_list', $data);
    }

    /**
     * 分类显示
     */
    public function show() {
        //获取编辑id，如果Id为false则是新增
        $id = $this->uri->segment(3);
        $category = $this->News_model->get_category(0);
        if ($id == FALSE) {
            $data['cate'] = $this->tree_all($category, 0, "cate_edit", 0);
            $this->load->view('news/category_add', $data);
        } else {
            $data = array
                (
                'cate' => $this->tree_all($category, 0, "cate_edit", $id),
                'list' => $this->News_model->get_category($id)
            );
            $this->load->view('news/category_edit', $data);
        }
    }

    /**
     * 分类新增/
     */
    public function add() {
        if ($_POST) {
            $data = $this->input->post();
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
        $result = $this->News_model->operation_category($data, $id);
        $this->msg($result, $type . '新闻分类', $this->router->fetch_method(), $data['category_Name'], 'News_category/index');
    }

    /**
     * 新闻分类删除 /
     */
    public function delete() {
        $this->contro_list_opreation("news_category", $this->router->fetch_method(), '新闻分类');
    }

    /**
     * 返回分类列表
     */
    public function return_list() {
        //获取页数跟每页条数
        $page = $this->input->get('page');
        $limit = $this->input->get('limit');
        $page = (int) ($page - 1) * (int) $limit;
        //分页查询
        $table = $this->Common_model->pages('news_category', $limit, $page, FALSE, FALSE, FALSE);
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

    //上传excel
    public function excel_put() {
        //先做一个文件上传，保存文件
        $path = $_FILES['excel_file'];
        $date = Date('Y-m-d', time()); //日期文件命名
        $filePath = "uploads/excel/" . $date;
        //如果文件不存在则创建
        if (!file_exists($filePath)) {
            mkdir($filePath);
        }
        //解决中文名称乱码
        $filename = iconv("utf-8", "gb2312", $path['name']);
        $filePath = "uploads/excel/" . $date . "/" . $filename;
        //    $filePath = "uploads/" . $path["name"];
        move_uploaded_file($path["tmp_name"], $filePath);

        $tablename = 'news_category'; //表名字
        $this->excel_fileput($filePath, $tablename);
    }

    /**
     *  添加到数据库中
     * @param type $filePath 文件路径
     * @param type $tablename 表名
     * @return type     /
     */
    private function excel_fileput($filePath, $tablename) {
        $this->load->library("phpexcel"); //ci框架中引入excel类
        $PHPExcel = new PHPExcel();
        $PHPReader = new PHPExcel_Reader_Excel2007();
        if (!$PHPReader->canRead($filePath)) {
            $PHPReader = new PHPExcel_Reader_Excel5();
            if (!$PHPReader->canRead($filePath)) {
                echo 'no Excel';
                return;
            }
        }
        // 加载excel文件
        $PHPExcel = $PHPReader->load($filePath);
        // 读取excel文件中的第一个工作表
        $currentSheet = $PHPExcel->getSheet(0);
        // 取得最大的列号
        $allColumn = $currentSheet->getHighestColumn();
        // 取得一共有多少行()
        $allRow = $currentSheet->getHighestRow();
        // 从第二行开始输出，因为excel表中第一行为列名
        $result = 0;
        $query = 0;
        $data1 = [];
        //循环行 从第二行开始
        for ($currentRow = 2; $currentRow <= $allRow; $currentRow++) {
            for ($currentColumn = 'A'; $currentColumn <= $allColumn; $currentColumn++) {
                $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow)->getValue();  //获取当前列的值  ord将字符转为十进制数 通过列索引和行索引设置单元格的值，返回类型同上
                //判断列
                if ($currentColumn == "A") {
                    $data1['category_Name'] = $val;
                } else {
                    $data1['pid'] = $val;
                }
            }
            //插入到数据库
            $query = $this->news_model->import_cate($tablename, $data1);
            if ($query) {
                $result++;
            }
        }
        //总条数，第一行列名不算，所以-1
        $total = $allRow - 1;
        $errnum = ($total) - $result;
        $data = array('total' => $total, 'success' => $result, 'error' => $errnum);
        echo json_encode($data);
    }

    //导出excel
    public function excel_export() {
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');
        $resultPHPExcel = new PHPExcel();
        //设置当前的描述
        $resultPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        //设置当前的sheet
        $resultPHPExcel->setActiveSheetIndex(0);
        //设置sheet的name
        $resultPHPExcel->getActiveSheet()->setTitle('Simple');

        //取出数据
        $result = $this->News_model->cate_export();

        //设置列名称（手动）
        $resultPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
        $resultPHPExcel->getActiveSheet()->setCellValue('B1', '名称');
        $resultPHPExcel->getActiveSheet()->setCellValue('C1', '分类ID');

        //提取该数组中的键名为一个数组（只能提取一位数组的列名）
        $filed = array_keys($result[0]);
        $col = 0;
        //循环输出列名到excel的第一行 （自动）
        foreach ($filed as $field) {
            //setCellValueByColumnAndRow(列,行,列名)
            $resultPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
        //设置数据导出从第二行开始，因为第一行是列名
        $row = 2;

        //二维数组循环的话  as后面的变量其实是一个一位数组 而不是具体的变量
        foreach ($result as $res) {
            $col = 0;
            foreach ($filed as $fields) {
                $resultPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $res[$fields]);
                $col++;
            }
            $row++;
        }

        $resultPHPExcel->setActiveSheetIndex(0);
        $objWriter = IOFactory::createWriter($resultPHPExcel, 'Excel5');
        // Sending headers to force the user to download the file
        //发送标题强制用户下载文件
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition:inline;filename="分类导出.xls"');
        header("Content-Transfer-Encoding: binary");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        $objWriter->save("php://output");
    }

}
