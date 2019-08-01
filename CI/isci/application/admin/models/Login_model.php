<?php

class Login_model extends CI_Model {

    public function get_user($username) {
        $username = array('UserName' => $username);
        $query = $this->db->get_where('admin', $username);
        return $query->row_array();
    }

    //获取main页面所有展示信息
    public function get_index_content() {
        $sql = "call get_index_content()";
       // $i = 0;
      //  $i++;
        if (mysqli_multi_query($this->db->conn_id, $sql)) {
            do {
                if ($result = mysqli_store_result($this->db->conn_id)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $rows[] = $row;
                    }
                } else {
                    break;
                }
            } while (mysqli_next_result($this->db->conn_id));
        }
        return $rows;
    }

}
