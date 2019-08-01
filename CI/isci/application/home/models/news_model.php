<?php

class news_model extends CI_Model {

    public function get_category($id) {
        if ($id == FALSE) {
            $query = $this->db->get('news_category');
            return $query->result_array();
        }
        $query = $this->db->get_where('news_category', 'id=' . $id);
        return $query->row_array();
    }

    public function get_news($id) {
        if ($id == 0) {
            $sql = "select count(id) from news";
            $query = $this->db->query($sql);
            return $query->row_array();
        }
        $query = $this->db->get_where('news', 'id=' . $id);
        return $query->row_array();
    }

    public function operation_news($data, $id) {
        $list = array
            (
            'title' => $data['title'],
            'Img' => $data['Img'],
            'NewType' => $data['NewType'],
            'sort' => $data['sort'],
            'Status' => $data['Status'],
            'addate' => $data['addate'],
            'content' => $data['content'],
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
    
    public function operation_category($data, $id) {
        $list = array(
            'category_Name' => $data['category_Name'],
            'sort' => $data['sort'],
            'pid' => $data['pid'],
            'content' => $data['content']
        );
        if ($id == FALSE) {
            $result = $this->db->insert('news_category', $list);
            return $result;
        }
        $this->db->where('id', $id);
        $result = $this->db->update('news_category', $list);
        return $result;
    }

}
