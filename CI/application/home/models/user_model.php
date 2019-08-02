<?php

class user_model extends CI_Model {

    /**
     * 获取会员信息
     * @param type $id 
     * @return type    /
     */
    public function get_user($id) {
        if ($id == FALSE) {
            $query = $this->db->get('user');
            return $query->result_array();
        }
        $query = $this->db->get_where('user', 'id=' . $id);

        return $query->row_array();
    }

    /**
     * 修改会员信息
     * @param type $data
     * @return type     /
     */
    public function edit_user($data) {
        $list = array(
            'group_id' => $data['group_id'],
            'user_name' => $data['user_name'],
            'password' => $data['password'],
            'status' => $data['status'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'sex' => $data['sex'],
            'img' => $data['img'],
            'birthaday' => $data['birthaday'],
            'address' => $data['address'],
            'amount' => $data['amount'],
            'point' => $data['point'],
            'exp' => $data['exp']
        );
        $this->db->where('id', $data['id']);
        $query = $this->db->update('user', $list);
        return $query;
    }

    /**
     * 新增会员信息
     * @param type $data
     * @return type     /
     */
    public function add_user($data) {
        $list = array(
            'user_name' => $data['user_name'],
            'group_id' => $data['group_id'],
            'password' => $data['password'],
            'status' => $data['status'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'sex' => $data['sex'],
            'img' => $data['img'],
            'birthaday' => $data['birthaday'],
            'address' => $data['address'],
            'amount' => $data['amount'],
            'point' => $data['point'],
            'exp' => $data['exp'],
            'createtime' => $data['createtime'],
            'reg_ip' => $data['reg_ip']
        );

        $query = $this->db->insert('user', $list);
        return $query;
    }

    /**
     * 获取会员组别
     * @param type $id
     * @return type     /
     */
    public function get_user_group($id) {
        if ($id == FALSE) {
            $query = $this->db->get('user_group');
            return $query->result_array();
        }
        $query = $this->db->get_where('user_group', 'id=' . $id);
        return $query->row_array();
    }

    /**
     * 新增会员组别
     * @param type $data
     * @return type     /
     */
    public function add_user_group($data) {
        $list = array(
            'title' => $data['title'],
            'grade' => $data['grade'],
            'is_default' => $data['is_default'],
            'is_grade_up' => $data['is_grade_up'],
            'point' => $data['point'],
            'amount' => $data['amount'],
            'upgrade_exp' => $data['upgrade_exp'],
            'discount' => $data['discount']
        );
        $query = $this->db->insert('user_group', $list);
        return $query;
    }

    /**
     * 修改会员组别
     * @param type $data
     * @return type     /
     */
    public function edit_user_group($data) {
        $list = array(
            'title' => $data['title'],
            'grade' => $data['grade'],
            'is_default' => $data['is_default'],
            'is_grade_up' => $data['is_grade_up'],
            'point' => $data['point'],
            'amount' => $data['amount'],
            'upgrade_exp' => $data['upgrade_exp'],
            'discount' => $data['discount']
        );
        $this->db->where('id', $data['id']);
        $query = $this->db->update('user_group', $list);
        return $query;
    }

    /**
     * 获取会员充值记录
     * @param type $data
     * @return type     /
     */
    public function get_user_recharge() {
        $query = $this->db->get('user_recharge');
        return $query->result_array();
    }
    /**
     * 获取会员消费记录
     * @param type $data
     * @return type     /
     */
    public function get_user_amount_log()
    {
        $query=$this->db->get('user_amount_log');
        return $query->result_array();
    }
    
    
    /**
     * 新增一条充值记录
     * @param type $data
     * @return type     /
     */
    public function add_user_recharge($data) {

        $this->db->trans_strict(FALSE);  //禁用严格模式（严格模式下多组事物只要有一组出错，就全部回滚）
        $this->db->trans_start();         //开启事物
        //新增一条金额记录
        $amountlist = array(
            'user_id' => $data['user_id'],
            'user_name' => $data['user_name'],
            'value' => $data['amount'],
            'payment_id' => $data['payment_id'],
            'remark' => "在线充值，单号：" . $data['recharge_no'],
            'add_time' => $data['add_time']
        );
        $this->db->insert('user_amount_log', $amountlist);
        if ($this->db->affected_rows() == 0) {
            echo " <script>alert('新增金额记录失败');history.go(-2);</script>";
            die();
        }

        $sql="update user set amount=amount+".$data['amount']." where id=".$data['user_id'];
        $this->db->query($sql);
        
        if ($this->db->affected_rows() == 0) {
            echo " <script>alert('修改会员金额失败');history.go(-2);</script>";
            die();
        }
        $list = array(
            'user_id' => $data['user_id'],
            'user_name' => $data['user_name'],
            'recharge_no' => $data['recharge_no'],
            'payment_id' => $data['payment_id'],
            'amount' => $data['amount'],
            'status' => $data['status'],
            'add_time' => $data['add_time'],
            'complete_time' => $data['complete_time']
        );
        $this->db->insert('user_recharge', $list);
        $this->db->trans_complete();        //结束事务(不需要关心是否回滚)
        if (!$this->db->trans_status())     //// 错误处理
        {
             echo " <script>alert('数据提交失败，请联系管理员');</script>";
             return FALSE;
        }
        
        return TRUE;
    }

}
