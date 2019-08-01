<?php

class News_model extends CI_Model {

    public function get_category($id) {
        if ($id == FALSE) {
            $query = $this->db->get('news_category');
            return $query->result_array();
        }
        $query = $this->db->get_where('news_category', 'id=' . $id);
        return $query->row_array();
    }
    

   /**
     * 查询新闻
     * @param type $data
     * @param type $id
     * @return type     /
     */
    public function get_news($id) {  
        $query = $this->db->get_where('news', 'id=' . $id);
        return $query->row_array();
    }
    
    /**
     * 新增/修改新闻
     * @param type $data
     * @param type $id
     * @return type     /
     */
    public function operation_news($data, $id) {
        $list = array
            (
            'title' => $data['title'],
            'Img' => $data['Img'],
            'NewType' => $data['NewType'],
            'sort' => $data['sort'],
            'Status' => $data['Status'],
             'click'=>$data['click'],
            'is_top'=>$data['is_top'],
            'is_red'=>$data['is_red'],
            'is_msg'=>$data['is_msg'],
            'author'=>$data['author'],
            'source'=>$data['source'],
            'addate' => $data['addate'],
            'Content' => $data['Content'],
            'seo_title' => $data['seo_title'],
            'seo_keywords' => $data['seo_keywords'],
            'seo_description' => $data['seo_description']
        );

 
        if ($id == FALSE) {
            $result = $this->db->insert('news', $list);
            return $result;
        } else {
            $this->db->where('id', $id);
            $result = $this->db->update('news', $list);
            return $result;
        }
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
            'pid' => $data['pid']
        );
        if ($id == FALSE) {
            $result = $this->db->insert('news_category', $list);
            return $result;
        }
        $this->db->where('id', $id);
        $result = $this->db->update('news_category', $list);
        return $result;
    }
    
    public function cate_export()
    {
        $res=$this->db->select('id,category_Name,pid')->get('news_category');
       return $res->result_array();
    }
    
    
    public function import_cate($table,$data)
    {
        $list=array(
            'category_Name'=>$data['category_Name'],
            'pid'=>$data['pid']
        );
      $result=  $this->db->insert($table,$list);
        return $result;
    }
}
