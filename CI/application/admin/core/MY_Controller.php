<?php

class MY_Controller extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper('url');
        $this->load->model('System_model');
        $this->load->model('Common_model');
        $this->load->library('session');
    }

    
    /**
     * 判断管理员登录和权限
     */
    public function islogin_or_rule() {
        $user = $this->session->userdata('user_info');   //获取当前管理员信息表
        if ($user) {
            $role_id = $user['role_id'];
            if ($role_id == "1") {
                
            }                     //判断是否是超级管理员
            else {
                $result = $this->System_model->get_role_rules($role_id);
                $con = $this->router->fetch_class(); //获取控制器名  
                $action = $this->router->fetch_method(); //获取方法名    
                $link_address = $con . "/" . $action;
                $control_array = array_column($result, 'ct');     //将二维数组转成1位数组
                if (!in_array($link_address, $control_array)) {
                    $this->error_msg('您没有权限访问该页面', FALSE);
                }
            }
        } else {
            echo " <script>alert('您还没有登录,请先登录');window.location.href='" . site_url() . "Login/index';</script>";
            $this->error_msg('您还没有登录,请先登录', FALSE);
        }
    }

    /**
     * 图片上传
     */
    public function do_uploads() {
        $temp = explode(".", $_FILES["userfile"]["name"]);  //获取文件名称，并通过explode分割，得到一个数组
        $extension = end($temp);                          //得到文件后缀
        $dates = date('Y-m-d', time());
        $config['upload_path'] = './Uploads/images/' . $dates;                              //定义文件上传目录，需要手动创建
        $rands = rand(1000, 9999);
        if (!file_exists($config['upload_path'])) {
            mkdir($config['upload_path']);
        }
        $config['allowed_types'] = 'gif|jpg|png';                         //定义格式
        $config['size'] = 100;                                            //定义大小
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $config['file_name'] = date('YmdHis', time()) . "_" . $rands . "." . $extension;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('userfile')) {  //判断是否选择了文件
            $error = array('error' => $this->upload->display_errors());     //返回错误
        } else {
            $data = array('upload_data' => $this->upload->data());         //得到文件信息\
            
            /*layui 返回格式*/
            $res['code'] = 0;
            $res['msg'] = '';
            $res['data'] = "Uploads/images/" . $dates . "/" . $data['upload_data']['file_name'];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 分页  /
     */
    public function pages($table) {
        //获取总数
        $ss = $this->Common_model->get_common_num($table);
        $number = $ss['count(id)'];
        $config['full_tag_open'] = '<ul class="pagination">'; //起始标签放在所有结果的左侧。可以直接在标签内部加上class标签
        $config['full_tag_close'] = '</ul>'; //结束标签放在所有结果的右侧。
        $config['first_tag_open'] = '<li>'; //第一个链接的起始标签。
        $config['first_tag_close'] = '</li>'; //第一个链接的结束标签。
        $config['next_tag_open'] = '<li>'; //下一页链接的起始标签。
        $config['next_tag_close'] = '</li>'; //下一页链接的结束标签。
        $config['prev_tag_open'] = '<li>'; //上一页链接的起始标签。
        $config['prev_tag_close'] = '</li>'; //上一页链接的结束标签
        $config['base_url'] = site_url() . $this->router->fetch_class() . '/index'; //链接路径
        $config['total_rows'] = $number;  //配置记录总条数        
        $config['per_page'] = 8; //配置每页显示的记录数
        $config['next_link'] = '下一页';
        $config['prev_link'] = '上一页';
        $config['last_link'] = '末页';
        $config['first_link'] = '首页';
        //配置分页导航当前页两边显示的条数
        $config['num_links'] = 3;
        //配置分页类
        $config['cur_page'] = $this->uri->segment(3);
        $tab = $this->Common_model->pages($table, $config['per_page'], $this->uri->segment(3));

        $this->pagination->initialize($config);
        return $tab;
    }

    /**
     * 获取分类节点
     * @param type $cate_nav 数据
     * @param type $pid  父ID 默认为0
     * @param type $control 需要调用的名称
     * @param type $id      一般是修改页面 要传入的具体的id(主要是判断是否是当前元素，如果是就加上某些样式，比如修改分类页面)
     * @param type $level   等级
     * @return type /
     */
    function tree_all($cate_nav, $pid, $control, $id, $level = 0) {
        //  $CI = & get_instance();  //因为除了控制器之外，其他的自定义的类是没办法直接用CI类的东西的，所以要用实例化一个CI的对象  (如果要用他的东西就实例化，不用就不需要实例化 )
        $html = '';
        $level++;
        $items = '';
        foreach ($cate_nav as $i => $nav) {
            if ($cate_nav[$i]['pid'] == $pid && $control == "cate_list") {
                $html .= "<tr>";
                $html .= "<td><input type='checkbox'></td>";
                $html .= "<td>" . $nav['id'] . "</td>";
                if ($level <= 1) {
                    $html .= "<td><a href='" . site_url() . $this->router->fetch_class() ."/show/" . $nav['id'] . "'>" . str_repeat('&nbsp;&nbsp;', $level - 1) . '<i class="icon iconfont">&#xe65a;</i>' . $nav['category_Name'] . "</a></td>";   //函数把字符串重复指定的次数。
                } else {
                    $html .= "<td><a href='" . site_url() . $this->router->fetch_class()."/show/" . $nav['id'] . "'>" . str_repeat('<i style="padding-left:30px"></i>', $level - 2) . '<i  class="icon iconfont">&#xe612;</i><i class="icon iconfont">&#xe65a;</i>' . $nav['category_Name'] . "</a></td>";   //函数把字符串重复指定的次数。
                }
                $html .= "<td>" . $nav['sort'] . "</td>";
                $html .= "</tr>";
                $html .= $this->tree_all($cate_nav, $nav['id'], $control, $id, $level);          //pid=1          //在类中 自己调用自己需要加$this  在视图中 不定义类的情况下  不需要$this
            } else if ($cate_nav[$i]['pid'] == $pid && $control == "cate_edit") {
                if ($nav['id'] == $id) {
                    if ($level <= 1) {
                        $html .= "<option value=" . $nav['id'] . "   selected='selected'>" . $nav['category_Name'] . "</option>";   //函数把字符串重复指定的次数。
                    } else if ($level >= 1) {
                        $html .= "<option  value=" . $nav['id'] . "   selected='selected'>" . str_repeat('&nbsp;&nbsp;&nbsp;', $level - 1) . ' ├  ' . $nav['category_Name'] . "</option>";   //函数把字符串重复指定的次数。
                    }
                } else {
                    if ($level <= 1) {
                        $html .= "<option value=" . $nav['id'] . ">" . $nav['category_Name'] . "</option>";   //函数把字符串重复指定的次数。
                    } else if ($level >= 1) {
                        $html .= "<option value=" . $nav['id'] . ">" . str_repeat('&nbsp;&nbsp;&nbsp;', $level - 1) . ' ├  ' . $nav['category_Name'] . "</option>";   //函数把字符串重复指定的次数。
                    }
                }
                $html .= $this->tree_all($cate_nav, $nav['id'], $control, $id, $level);          //pid=1          //在类中 自己调用自己需要加$this  在视图中 不定义类的情况下  不需要$this
            } else if ($cate_nav[$i]['pid'] == $pid && $control == "info_list") {
                $html .= "<li>";
                if ($level <= 1) {
                    $html .= "<a href='javascript:;' id=" . $nav['id'] . "  data-type='reload' >" . $nav['category_Name'] . "</a>";
                } else if ($level >= 1) {
                    $html .= "<a href='javascript:;' id=" . $nav['id'] . "  data-type='reload' >" . str_repeat('&nbsp;&nbsp;&nbsp;', $level - 1) . ' ├  ' . $nav['category_Name'] . "</a>";
                }
                $html .= "</li>";
                $html .= $this->tree_all($cate_nav, $nav['id'], $control, $id, $level);
            } else if ($cate_nav[$i]['pid'] == $pid && $control == "nav_add") {
                if ($level <= 1) {
                    $html .= "<option value=" . $nav['id'] . ">" . $nav['title'] . "</option>";   //函数把字符串重复指定的次数。
                } else if ($level >= 1) {
                    $html .= "<option value=" . $nav['id'] . ">" . str_repeat('&nbsp;&nbsp;&nbsp;', $level - 1) . ' ├  ' . $nav['title'] . "</option>";   //函数把字符串重复指定的次数。
                }
                $html .= $this->tree_all($cate_nav, $nav['id'], $control, $id, $level);          //pid=1          //在类中 自己调用自己需要加$this  在视图中 不定义类的情况下  不需要$this
            } else if ($cate_nav[$i]['pid'] == $pid && $control == "nav_list") {

                $items = explode(",", $nav['powername']);
                $html .= "<tr>";
                if ($level <= 1) {
                    $html .= "<td>" . str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $level - 1) . '<i class="icon iconfont">&#xe65a;</i>' . $nav['title'] . "</td>";   //函数把字符串重复指定的次数。
                } else {
                    $html .= "<td>" . str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $level - 1) . '<i class="icon iconfont">&#xe612;</i><i class="icon iconfont">&#xe65a;</i>' . $nav['title'] . "</td>";   //函数把字符串重复指定的次数。
                }
                $html .= "<td>";
                if (in_array("view", $items)) {
                    $html .= $this->tree_title($nav['id'], $nav['sub_title'],'view', '显示');
                }
                if (in_array("index", $items)) {
                    $html .= $this->tree_title($nav['id'], $nav['controller'],'index', '显示');
                }
                if (in_array("show", $items)) {
                    $html .= $this->tree_title($nav['id'], $nav['controller'],'show', '查看');
                }
                if (in_array("edit", $items)) {
                    $html .= $this->tree_title($nav['id'], $nav['controller'],'edit', '修改');
                }
                if (in_array("add", $items)) {
                    $html .= $this->tree_title($nav['id'], $nav['controller'],'add', '新增');
                }
                if (in_array("delete", $items)) {
                    $html .= $this->tree_title($nav['id'], $nav['controller'], 'delete','删除');
                }
                $html .= "</td></tr>";
                $html .= $this->tree_all($cate_nav, $nav['id'], $control, $id, $level);
            }
        }
        return $html;
    }

    function tree_title($id, $title,$ident, $content) {

        return "<input class='checkid' name='allck[]' value=" . $id . '-' . $title.'-'  .$ident. " type='checkbox'>" . $content;
    }
    
          /**
     * 记录管理员日志
     * @param type $data 内容
     */
    public function add_admin_log($data) {
     
        if ($this->session->userdata("sites")) {
            $site = $this->session->userdata("sites");
            if ($site['is_admin_log']) {
                $this->Common_model->add_admin_log($data);
            }
        }
    }

   
    
    public function my_return_list($table) {
        //获取页数跟每页条数
        $data = array('page' => '', 'limit' => '', 'keyword' => '', 'category' => '', 'status' => '');
        $list = $this->input->get();
        foreach ($list as $key => $value) {
            $data[$key] = trim($list[$key]);
        }
        //page页数字要从0开始
        $table = $this->Common_model->pages($table, $data['limit'], $data['page'] - 1, $data['keyword'], $data['category'], $data['status']);
        return $table;
    }

    /**
     * 输出成功消息
     * @param type $content 输出内容
     * @param type $link    跳转连接 /
     */
     public function success_msg($cotnent, $link) {
        $return = " <script type='text/javascript' src='" . base_url() . "other/layui/layui.js'>";
        $return .= "</script>";
        $return .= "<script>";
        $return .= "layui.use(['layer'], function () {";
        $return .= "var layer = layui.layer;layer.msg('" . $cotnent . "成功！',{icon: 1});";
        $link= site_url().$link;
        $return .="setTimeout(function(){window.location.href='".$link."';},1000);";
        $return .= "})";
        $return .= "</script>";
        echo $return;
    }

    
    /**
     * 输出失败消息
     * @param type $content 输出内容
     * @param type $bool    默认错误输出，false则为其他输出 /
     */
    public function error_msg($content, $bool = TRUE) {
        $return = " <script type='text/javascript' src='" . base_url() . "other/layui/layui.js'>";
        $return .= "</script>";
        $return .= "<script>";
        $return .= "layui.use(['layer'], function () {";
        if ($bool == TRUE) {
            $return .= "var layer = layui.layer;layer.msg('" . $content . "失败！',{icon: 5});";
        } else {
            $return .= "var layer = layui.layer;layer.msg('" . $content . "！',{icon: 2});";
        }
        $return .= "window.setTimeout('history.go(-1)', 1000);";    //定时器间隔一秒后执行后退操作
        $return .= "})";
        $return .= "</script>";
        echo $return;
    }
    
    /**
     * 页面输出成功或者失败信息
     * @param type $query   结果集
     * @param type $cotnent 输出内容
     * @param type $link    跳转连接
     * @param type $method  方法
     * @param type $user    操作的对象
     */ 
    public function msg($query, $content,$method,$user, $link) {
        if ($query) {
            //记录管理员日志
            $this->add_admin_log(array('type' => $method, 'remark' => $content .":". $user));
            $this->success_msg($content, $link);
        } else {
            $this->error_msg($content);
        }
    }

    /**
     * salt随机数
     * @param type $len
     * @param string $chars
     * @return string     /
     */
    function getRandomString() {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        mt_srand(10000000 * (double) microtime());
        $str = '';
        for ($i = 0, $lc = strlen($chars) - 1; $i < 6; $i++) {
            $str .= $chars[mt_rand(0, $lc)];
        }
        return strtoupper($str);
    }

    /**
     * 对列表页的数据进行删除或者审核
     * @param type 表名
     * @param type 方法名
     * @param type 输出内容
     * @return type     /
     */
    public function contro_list_opreation($table, $method, $content) {
        $id = $this->input->post('iditem');                 //获取要操作的数据id
        $type = $this->input->post('type');                 //请求的类型 删除数据/修改数据审核状态
        if (!is_numeric($id)) {                             //判断是提交的一个还是多个，is_numeric判断是否是数组
            $list = explode(",", $id);                      //根据，分割字符串转为数组
            unset($list[0]);                                //删除第一个数组元素  unset  第一个元素，  
        } else {
            $list = [$id];
        }
        $query = $this->Common_model->list_operation($table, $list, $type);
        if ($query > 0) {
            $log['type'] = $method;
            $msg = $type == "delete" ? "批量删除" : "批量审核";
            $log['remark'] = $msg . $content . $query . "条记录";
            $this->add_admin_log($log);
            echo '{"count":"' . $query . '","msg":"'.$msg.'"}';
        }
        return $query;
    }

    /**
     * 遍历前段传过来的参数tirm()过滤
     * @param type $data     /
     */
    //$key代表键名 $value 代表键值 $data[$key]代表这个键名下的值
    public function loop_trim($data) {
        foreach ($data as $key => $value) {
            //如果不是数组就过滤
            if (!is_array($value)) {
                $data[$key] = trim($data[$key]);
            }
        }
        return $data;
    }

}
