<?php

class System_model extends CI_Model {

  /**
   *  //获取管理员信息列表
   * @param type $content  id
   * @param type $content2  用户名
   * @return type   /
   */
    public function get_admin($content, $content2 = FALSE) {
        //新增时查询所有
        if ($content == FALSE && $content2 == FALSE) {
            $query = $this->db->get('admin');
            return $query->result_array();
        }
        //修改用户名的时候判断用户名是否存在，这里查询是新增时判断用户名是否存在
        //参数放进数组里面不需要加引号的--array('UserName'=>$content)
        else if ($content == FALSE && $content2 != FALSE) {
            $this->db->get_where('admin', array('UserName' => $content2));
            return $this->db->affected_rows();
            //判断修改时用户名是否存在
        } else if ($content != FALSE && $content2 != FALSE) {
            $this->db->get_where('admin', array('ID<>' => $content, 'UserName' => $content2));
            // var_dump($this->db->last_query());
            return $this->db->affected_rows();
        }
        $query = $this->db->get_where('admin', 'ID=' . $content);
        return $query->row_array();
    }

    /**
     * 新增/修改管理员
     * @param type $data
     * @param type $id
     * @return type     /
     */
    public function operation_admin($data, $id) {
        $list = array
            (
            'UserName' => $data['UserName'],
            'Password' => $data['Password'],
            'islock' => $data['islock'],
            'salt' => $data['salt'],
            'telephone' => $data['telephone'],
            'nikename' => $data['nikename'],
            'img' => $data['img'],
            'role_id' => $data['role_id']
        );
        if ($id == FALSE) {
            $list['createtime'] = time();
            $list['loginhits'] = 0;
            $result = $this->db->insert('admin', $list);
            return $result;
        } else {
            if (isset($data['lastlogtime'])) {
                $list['lastlogtime'] = $data['lastlogtime'];
            }
            if (isset($data['lastlogip'])) {
                $list['lastlogip'] = $data['lastlogip'];
            }
            $this->db->where('id', $id);
            $result = $this->db->update('admin', $list);
            return $result;
        }
    }

    /**
     * 获取角色种类
     */
    public function get_role($role=false) {
        if ($role == FALSE) {
            return $this->db->get('admin_role')->result_array();
        }
        //is_numeric 判断是数字，或者数字的字符串
        $query = $this->db->get_where('admin_role', 'id=' . $role);
        return $query->row_array();
    }

    /**
     * @param 新增角色
     * @return 返回角色总条数     /
     */
    public function add_role($data) {
        $role_name = $data['role_name'];
        $createtime = time();
        $sql = "call p_add_role('$role_name',$createtime)";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        mysqli_next_result($this->db->conn_id); //核心，必须处理所有  获取到下一个jieguoj
        $query->free_result();
        return $result;
    }

    
    
    /**
     * 获取传过来的role_id对应的角色权限
     * @param type $id role_id
     * @return type     /
     */
    public function get_role_rule($id) {
        $query = $this->db->select('controller,action,nav_id')->where('role_id', $id)->get('admin_rule');
        return $query->result_array();
    }
    
    
    /**
     * 修改角色名称 (修改需要先删除原来的规则 再新增)
     * @param type $data
     * @return type    
     */ 
    public function update_role($data) {
        $sql = "call p_edit_role('" . $data['role_name'] . "'," . $data['role_id'] . ",@outres)";
        $query = $this->db->query($sql);
        mysqli_next_result($this->db->conn_id); //核心，必须处理所有  获取到下一个jieguoj
        $query->free_result();
        $outsql = "select @outres as outres";
        $outres = $this->db->query($outsql);
        $result = $outres->row_array();
        return $result;
    }

    /**
     * 新增角色规则
     * @param type $role_id
     * @param type $contorller
     * @param type $action
     * @return type 
     */
    public function add_role_rule($role_id, $nav_id, $contorller, $action) {
        $arrlist = array(
            'role_id' => $role_id,
            'nav_id' => $nav_id,
            'controller' => $contorller,
            'action' => $action
        );
        $result = $this->db->insert('admin_rule', $arrlist);
        return $result;
    }

   
    /**
     * 获取规则列表
     * @return type     /
     */
    public function get_navigation() {
        
        $query = $this->db->get('admin_navigation');
        return $query->result_array();
    }

    public function add_navigation($data) {
        $sql = "call nav_add2($data[id],'$data[title]','$data[controller]','$data[action]')";
        $query = $this->db->query($sql);
        // return $query->result();
        return $this->db->affected_rows();
//free_result该方法释放掉查询结果所占的内存
    }

    

   /**
    *删除一个星期之前的所有记录（日期是越早越大）
    */
    //
    public function delete_admin_log() {
        $sql = "delete from admin_log where add_time < DATE_SUB(now(), INTERVAL 7 DAY)";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

}
