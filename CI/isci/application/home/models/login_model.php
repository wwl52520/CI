<?php

class login_model extends CI_Model {

    public function get_user($username, $pwd) {
        $user = array
            (
            'UserName' => $username,
            'Password' => $pwd
        );
        $query = $this->db->get_where('admin', $user);
        return $query->row_array();
    }

    public function get_site() {
        $query = $this->db->get('site');
        return $query->row_array();
    }
    
    public function set_site($data)
    {
        $list = array
        (
            'company' => $data['company'],
            'address' => $data['address'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'copyright' => $data['copyright']
        );
        $this->db->where('site_id=', $data['site_id']);
       $result= $this->db->update('site', $list);
       return $result;
    }

}
