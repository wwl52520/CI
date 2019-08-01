<?php

class Common_model extends CI_Model{


    /**
     *  获取表的总条数
     * @param type $id
     * @return type     /
     */
        /*
        public function get_common_num($table) {
            $sql = "select count(id) from ".$table;
            $query = $this->db->query($sql);
            return $query->row_array();
    }
    */
    
    /**
     * 分页
     * @param type $table 表
     * @param type $num  总条数
     * @param type $offset 从第几条开始
     * @return type     /
     */
    public function pages($table, $page, $limit, $keyword, $category, $status) {
        switch ($table) {
            case "goods":
                $sql = "call goods_page($limit,$page,'$keyword','$category','$status')";
                break;
            case "news" :
                $sql = "call news_page($limit,$page,'$keyword','$category','$status')";
                break;
            case "admin":
                $sql = "call admin_page($limit,$page,'$keyword')";
                break;
              //用户分页
            case "user" :
                $sql = "call user_page($limit,$page,'$keyword')";
                break;
              //消费分页
            case "user_recharge":
                $sql = "call user_recharge_page($limit,$page,'$keyword')";
                break;
            //评论分页
            case "goods_comment" :
                $sql="call goods_comment_page($limit,$page,'$keyword','$status')";
                break;
            default :
                $sql = "call common_page('" . $table . "',$limit,$page,'$keyword')";
                break;
        }
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // $query->free_result();
        // $this -> db -> reconnect();
        return $result;
    }

    /**
     * 对列表页操作 删除/审核
     * @param type $table
     * @param type $id
     * @param type $type 类型 删除还是审核
     * @return type     /   
     */
    public function list_operation($table, $id, $type = 'delete') {
        //如果是分类表  删除所有id等于这个id的数据 或者pid=这个id的数据
        if ($table == 'news_category') {
            //条件匹配所有要删除的ID
            $this->db->where_in('id', $id);
            //条件匹配id中所含有的pid  
            $this->db->or_where_in('pid', $id);
            $this->db->delete($table);
            return $this->db->affected_rows();
        }
        $this->db->where_in('id', $id);
        if ($type == "delete") {
            $this->db->delete($table);
        } else {
            $this->db->update($table, array('status'=>1));
        }
        return $this->db->affected_rows();
    }

    public function add_admin_log($data)
    { 
        $data=array(
            'user_id'=>$_SESSION['userid'],
            'user_name'=>$_SESSION['username'],
            'action_type'=>$data['type'],
            'remark'=>$data['remark'],
            'user_ip'=>$this->input->ip_address(),
            'add_time'=> time()
        );
        $this->db->insert('admin_log',$data);
       return  $this->db->affected_rows();
    }
}
