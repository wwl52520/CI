<?php

class Goods_model extends CI_Model {

    public function get_category($id) {
        if ($id == FALSE) {
            $query = $this->db->get('goods_category');
            return $query->result_array();
        }
        $query = $this->db->get_where('goods_category', 'id=' . $id);
        return $query->row_array();
    }
    
    public function change_attribute($val,$name, $id) {
        $this->db->where('id',$id);
        $result = $this->db->update('goods',array("$name"=>$val));
        return $result;
    }

    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * 查询新闻
     * @param type $data
     * @param type $id
     * @return type     /
     */
    public function get_goods($id) {
        $sql = "call get_goods_relation(" . $id . ")";
        $i = 0;
        if (mysqli_multi_query($this->db->conn_id, $sql)) {
            do {
                if ($result = mysqli_store_result($this->db->conn_id)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        //判断是否是第一条,因为第一条获取的大分类，后面的获取的都是该分类下的子分类  如果当前结果集为空则赋0
                        if ($row) {
                            $rows[$i][] = $row;
                        } else {
                            $rows[$i][] = 0;
                        }
                    }
                    $i++;
                } else {
                    break;
                }
            } while (mysqli_next_result($this->db->conn_id));
        }
        return $rows;
    }

    /**
     * 新增/修改新闻
     * @param type $data
     * @param type $id
     * @return type     /
     */
    public function operation_goods($data, $id=False) {
        
        $returns = $this->operation_goods_spec($data, $id);
        if (isset($returns['@res']) && $returns['@res'] > 0) {
            return TRUE;
        }
        return FALSE;
    }

    /**
   *  对商品的规格，以及商品规格订单进行操作
   * @param type $data  商品总信息 /
   */
    public function operation_goods_spec($data, $id) {
     
        $bool_id = $id ? "edit_spec_goods($id" . "," : "add_spec_good(";
        $sql = "call $bool_id '" . $data['goods_albums'] . "','" . $data['goods_spec_list'] . "','" . $data['spec_good_item'] . "','" . $data['title'] . "',"
                . "'" . $data['sub_title'] . "','" . $data['img_url'] . "','" . $data['cate_id'] . "','" . $data['sort'] . "','" . $data['status'] . "','" . $data['click'] . "',"
                . "'" . $data['is_top'] . "','" . $data['is_red'] . "','" . $data['is_slide'] . "','" . $data['is_msg'] . "','" . $data['goods_no'] . "','" . $data['stock'] . "',"
                . "'" . $data['market_price'] . "','" . $data['sell_price'] . "','" . $data['point'] . "','" . $data['add_time'] . "','" . $data['content'] . "','" . $data['seo_title'] . "',"
                . "'" . $data['seo_keywords'] . "','" . $data['seo_description'] . "',@res)";
        $this->db->query($sql);
        $outres = "select @res";
        $result = $this->db->query($outres)->row_array();
        
        return $result;
    }

    /**
     * 操作分类
     * @param type $data
     * @param type $id
     * @return type     /
     */
    public function operation_category($data, $id) {

        $list = array(
            'category_Name' => $data['category_Name'],
            'sort' => $data['sort'],
            'img'=>$data['img'],
            'pid' => $data['pid']
        );
        if ($id == FALSE) {
        
            $result = $this->db->insert('goods_category', $list);
            return $result;
        }
        $this->db->where('id', $id);
        $result = $this->db->update('goods_category', $list);
        return $result;
    }
 
    /**
     * 获取规格信息
     * $id 要修改的父id
     * @return type     /
     */
    public function get_spec($id=False) {
        if ($id) {
            $query = $this->db->where('id', $id)->or_where('pid', $id)->get('spec');
        } else {
            $query = $this->db->get('spec');
        }
        return $query->result_array();
        
        /*  多表复杂操作用存储过程实例
        $sql = "call get_spec_show($id)";
        $i = 0;
        if (mysqli_multi_query($this->db->conn_id, $sql)) {
            do {
                if ($result = mysqli_store_result($this->db->conn_id)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        //判断是否是第一条,因为第一条获取的大分类，后面的获取的都是该分类下的子分类
                        if ($i < 1) {
                            $rows['list'][] = $row;
                        } else {
                            $rows['child_list'][] = $row;
                        }
                    }
                    $i++;
                } else {
                    break;
                }
            } while (mysqli_next_result($this->db->conn_id));
        }
        return $rows;
        */
    }

    /**
     *  新增/修改规格
     * @param type $data
     * @return type     /
     */
    public function operation_spec($data) {
        if (!isset($data['sort_id']) || $data['sort_id']==0) {
            $data['sort_id'] = 99;
        }
        $list = array(
            'pid' => $data['pid'],
            'title' => $data['title'],
            'sort_id' => $data['sort_id']
        );
        //判断是父类增加
        if (!isset($data['id']) && $data['pid'] == 0) {
            $list['remake'] = $data['remake'];
            $this->db->insert('spec', $list);
            $pid = $this->db->insert_id('spec');
            return $pid;
        }
        //子类增加
        else if (!isset($data['id']) && $data['pid'] != 0) {
            $list['img_url'] = $data['img_url'];
            $result = $this->db->insert('spec', $list);
            return $result;
        }
        //修改
        $this->db->where('id', $data['id']);
        $result = $this->db->update('spec', $list);
        return $result;
    }

    
    //删除相应规格
    public function delete_spec($id)
    {
       $this->db->where('pid',$id);
       $this->db->delete('spec');
    }

    /**
     * 获取对应商品id的评论信息
     * @param type $id 商品ID
     * @return type     /
     */
    public function get_comment($id) {
        $sql="select id,user_name,user_ip,content,status,add_time,is_reply,reply_content,(select title from goods where id=$id) as title from goods_comment";
        $query=$this->db->query($sql);
        $result=$query->row_array();
        $res=$this->db->last_query();
       return $result;
    }
    /**
     * 回复对应商品ID的评论
     * @param type $data
     * @return type     /
     */
    public function update_comment($data) {
        $list = array(
            'is_reply' => 1,
            'status'=>$data['status'],
            'reply_content' => $data['reply_content'],
            'reply_time' => time()
        );
        $this->db->where('id', $data['id']);
        $result = $this->db->update('goods_comment', $list);
        return $result;
    }

}



