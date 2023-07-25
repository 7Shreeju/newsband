<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FrontList extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'login');
        $this->load->model('Common_model', 'common');
        $this->load->model('Profile_model', 'pro');
        $this->login->is_logged_in();
    }

    public function index() {
        $data['page_name'] = 'Blog Category List';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'List/contact_list';
        $this->load->view('admin_template', $data);
    }

 
}
