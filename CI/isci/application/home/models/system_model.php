<?php

class system_model extends CI_Model {

    //获取管理员信息列表
    public function get_admin($id) {
        if ($id == FALSE) {
            $query = $this->db->get('admin');
            return $query->result_array();
        }
        $query = $this->db->get_where('admin', 'id=' . $id);
        return $query->row_array();
    }
    
    public function operation_admin($data, $id) {
        $list = array
            (
            'UserName' => $data['UserName'],
            'Password' => $data['Password'],
            'islock' => $data['islock'],
            'telephone' => $data['telephone'],
            'nikename' => $data['nikename'],
            'img' => $data['img'],
            'role_id' => $data['role_id']
        );
        if ($id == FALSE) {
            $result = $this->db->insert('admin', $list);
            return $result;
        } else {
            $this->db->where('id', $id);
            $result = $this->db->update('admin', $list);
            return $result;
        }
    }

    public function delete($table,$id) {
        $this->db->where_in('id', $id);
        $query = $this->db->delete($table);
       if($query==TRUE)
       {
       $this->db->where_in('id', $id);
        $result = $this->db->delete('admin_rule');
        return $result;
       }
    }

    
 public function role_delete($table,$id)
 {
     $this->db->where('role_id',$id);
   $query=  $this->db->delete($table);
     return $query;
 }
    
    //获取管理员种类
    public function get_role($role) {
        if ($role == FALSE) {
            return $this->db->get('admin_role')->result_array();
        } else if (is_numeric($role)) {   //is_numeric 判断是数字，或者数字的字符串
            $query = $this->db->get_where('admin_role', 'id=' . $role);
            return $query->row_array();
        }
        $query = $this->db->get_where('admin_role', "role_name=" . "'.$role.'");
        return $query->row_array();
    }

    /**
     * @param 新增角色
     * @return 返回角色总条数     /
     */
    public function add_role($data) {
        $list['role_name'] = $data['role_name'];
        $list['createtime']= time();
        $query = $this->db->insert('admin_role', $list);
        if ($query > 0) {
         $sql="select id from admin_role order by id desc limit 1";
         $query=  $this->db->query($sql)->row_array();
            return $query;
            
        } else {
            return FALSE;
        }
    }
    public function update_role($data)
    {
   
        $list['role_name'] = $data['role_name'];
        $this->db->where('id',$data['role_id']);
      $query=  $this->db->update('admin_role',$list);
    return $query;
      
    }
    
    
    /**
     * 新增角色规则
     * @param type $role_id
     * @param type $contorller
     * @param type $action
     * @return type 
     */
    public function add_role_rule($role_id,$nav_id, $contorller, $action) {
        $arrlist = array(
            'role_id' => $role_id,
            'nav_id'=>$nav_id,
            'controller' => $contorller,
            'action' => $action
        );
        $result = $this->db->insert('admin_rule', $arrlist);
        return $result;
    }
   
    
    public function get_role_rule($id)
    {
        $query=$this->db->get_where('admin_rule','role_id='.$id);
        return $query->result_array();
    }
    
    
   
      public function get_role_rules($id)
    {
          $sql="select CONCAT(controller,'/',action) as ct from admin_rule";
          $query = $this->db->query($sql);
          return $query->result_array();
    }
    
    
    /**
     * 获取规则列表
     * @return type     /
     */
    public function get_navigation() {
        $query = $this->db->get('admin_navigation');
        return $query->result_array();
    }
   
    public function add_navigation($data)
    {
        $list=array(
            'pid'=>$data['id'],
            'title'=>$data['title'],
            'sub_title'=>$data['controller'],
            'powername'=>$data['action']
            );
    $query=$this->db->insert('admin_navigation',$list);
    return $query;
    }
    
    public function add_children_navigation($data)
    {
        $list=array(
            'pid'=>$data['id'],
            'title'=>$data['title'],
            'controller'=>$data['controller'],
            'powername'=>$data['action']
            );
    $query=$this->db->insert('admin_navigation',$list);
    return $query;
    }
    
   
}
