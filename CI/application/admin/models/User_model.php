<?php

class User_model extends CI_Model {

    /**
     * 获取会员信息
     * @param type $id 
     * @return type    /
     */
    public function get_user($content, $content2 = FALSE) {
        //新增时查询所有
        if ($content == FALSE && $content2 == FALSE) {
            $query = $this->db->get('user');
            return $query->result_array();
        }
        //短消息检测多个用户名是否正确
          else if($content==FALSE && is_array($content2) ==TRUE)
        {
            $result=$this->db->where_in('user_name',$content2)->get('user');
            return $this->db->affected_rows();
        }
        //修改用户名的时候判断用户名是否存在，这里查询是新增时判断用户名是否存在
        //参数放进数组里面不需要加引号的--array('UserName'=>$content)
        else if ($content == FALSE && $content2 != FALSE) {
            $result = $this->db->get_where('user', array('user_name' => $content2));
            return $result->row_array();
            // return $this->db->affected_rows();
            //判断修改时用户名是否存在
        } else if ($content != FALSE && $content2 != FALSE) {
            $result = $this->db->get_where('user', array('id<>' => $content, 'user_name' => $content2));
            return $result->row();
            //return $this->db->affected_rows();
        }
      
        $query = $this->db->get_where('user', 'id=' . $content);
        return $query->row_array();
    }

    /**
     * 新增/修改会员信息
     * @param type $data
     * @return type     /
     */
    public function operation_user($data) {
        $list = array(
            'group_id' => $data['group_id'],
            'user_name' => $data['user_name'],
            'password' => $data['password'],
            'status' => $data['status'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'nickname' => $data['nickname'],
            'sex' => $data['sex'],
            'img' => $data['img'],
            'birthaday' => $data['birthaday'],
            'address' => $data['address'],
            'amount' => $data['amount'],
            'point' => $data['point'],
            'exp' => $data['exp']
        );
        if (isset($data['id']) == FALSE) {
            $list['createtime']=$data['createtime'];
            $list['reg_ip']=$data['reg_ip'];
            $query = $this->db->insert('user', $list);
            return $query;
        }
        $this->db->where('id', $data['id']);
        $query = $this->db->update('user', $list);
        return $query;
    }


    /**
     * 获取会员组别
     * @param type $id
     * @return type     /
     */
    public function get_user_group($id) {
	if($id==FALSE)
	{
	  $query=$this->db->get('user_group');
	  return $query->result_array();
	}
        $query = $this->db->get_where('user_group', 'id=' . $id);
        return $query->row_array();
    }

    /**
     * 新增/修改会员组别
     * @param type $data
     * @return type     /
     */
    public function operation_user_group($data) {
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
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $query = $this->db->update('user_group', $list);
        } else {
            $query = $this->db->insert('user_group', $list);
        }

        return $query;
    }


    
    //根据ID返回指定的短消息
    public function get_user_message($id) {
        $result = $this->db->get_where('user_message', array('id' => $id));
        return $result->row_array();
    }

    /**
     * 新增一条充值记录
     * @param type $data
     * @return type     /
     */
    public function add_user_recharge($data) {
        
        $sql="call add_user_recharge(".$data['user_id'].",'".$data['user_name']."','".$data['amount']."','".$data['payment_id']."','".$data['recharge_no']."','".$data['add_time']."',@res)";
        $query=$this->db->query($sql);
        $outres="select @res";
        $result=$this->db->query($outres)->row();
        return $result;

        /*
        
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


        $sql="update user set amount=amount+".$data['amount']." where id=".$data['user_id'];
        $this->db->query($sql);
        
   
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
         *
         */
    }

      /**
     * 新增一条短消息记录
     * @param type $data
     */
    public function add_user_message($data)
    {
        $list=array(
            'title'=>$data['title'],
            'content'=>$data['content'],
            'is_read'=>$data['is_read'],
            'post_time'=>$data['post_time'],
            'post_user_name'=>$data['post_user_name'],
            'accept_user_name'=>$data['accept_user_name'],
            'type'=>$data['type']
        );
        $result=$this->db->insert('user_message',$data);
        return $result;
    }
}
