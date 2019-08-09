<?php

class index extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('system_model');
        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('index');
    }

}
