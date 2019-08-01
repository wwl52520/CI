<?php

class common_model extends CI_Model{
  
    
    /**
     *  获取表的总条数
     * @param type $id
     * @return type     /
     */
        public function get_common_num($table) {
            $sql = "select count(id) from ".$table;
            $query = $this->db->query($sql);
            return $query->row_array();
    }
    
    /**
     * 分页
     * @param type $table 表
     * @param type $num  总条数
     * @param type $offset 从第几条开始
     * @return type     /
     */
    public function pages($table,$num, $offset) {
        $query = $this->db->get($table, $num, $offset);
        return $query->result_array();
    }
    
    /**
     * 获取密码,与前台输入的密码做对比
     * @param type $table 表
     * @param type $id   ID
     * @return type     /
     */
    public function get_pwd($table,$id)
    {
       $query= $this->db->get_where($table,'ID='.$id);
        return $query->row_array();
    }
    
    /**
     * 删除指定ID
     * @param type $table
     * @param type $id
     * @return type     /   
     */
    public function delete($table,$id) {
    
        $this->db->where_in('id', $id);
         $this->db->delete($table);
     return $this->db->affected_rows();
    }
    
    public function user_test($user_name) {
        $query = $this->db->get_where('user', 'user_name=' . $user_name);
        return $query->row_array();
    }

    public function get_payment()
    {
        $query=$this->db->get('payment');
        return $query->result_array();
    }
    
}
