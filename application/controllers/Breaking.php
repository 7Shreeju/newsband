<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class breaking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'login');
        $this->load->model('Index_model', 'index');
        $this->load->model('Common_model', 'common');
        $this->load->model('Profile_model', 'pro');
        $this->login->is_logged_in();
        $this->index->activity_update();
    }
  
    public function index() {
        $data['page_name'] = 'Breaking News';
        $this->index->activity_log('Breaking News');
      $data['list'] = $this->common->list('breaking_news');
         $data['article'] = $this->common->list2('blog');
        $data['user_detail'] = $this->common->view1();
        $data['content_view'] = 'Blog/breaking_news';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();


        $this->load->view('admin_template', $data);
    }

  
//GallaryFunctionality

    public function add_link() {
        $this->index->activity_log('Breaking News Add');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('blog_title', 'This Field', 'trim|required');
       

        if ($this->form_validation->run()) {
            $insert_data = array(
                'blog_title' => $this->input->post('blog_title'),
              
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
            $id = $this->common->insert_table('breaking_news', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'Breaking News added successfully.'
                );
            }
        } else {
            $array = array(
                'error' => true,
                'title_error' => form_error('blog_title'),
                

            );
        }
        echo json_encode($array);
    }

    public function fetch_link() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'breaking_news');
            echo json_encode($data);
        }
    }

    public function edit_link() {
        $this->index->activity_log('Edit Breaking News');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('blog_title', 'This field', 'trim|required|is_unique[breaking_news.blog_title]', array('is_unique' => 'This %s already exists.'));
        
        if ($this->form_validation->run()) {
            $id = $this->input->post('id');
            $update_data = array(
                'blog_title' => $this->input->post('blog_title'),
              
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
            $this->common->update_table('breaking_news', $update_data, $id);
            $array = array(
                'success' => 'Breaking News updated successfully.'
            );
        } else {
            $array = array(
                'error' => true,
                'title11_error' => form_error('name'),
             

            );
        }
        echo json_encode($array);
    }

    public function delete_link() {
        $this->index->activity_log('Delete Breaking News');
        $id = $this->input->post('id');
       
        $this->common->delete_table('breaking_news', $id);
        $array = array(
            'success' => 'Breaking News deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_link() {
        $this->index->activity_log('Breaking News Status');
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('breaking_news', $delete_data, $id);
        $array = array(
            'success' => 'Breaking News status updated successfully.'
        );
        echo json_encode($array);
    }

      public function delete_alllinks() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'breaking_news');

            $array = array(
                'success' => 'Selected Breaking News deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Breaking News',
            );
        }
        echo json_encode($array);
    }

    public function status_alllinks() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {
                // echo $row;
                array_push($checkbox, $row);
            }

            $delete_data = array(
                'status' => 1,
            );
            $abc = $this->common->statusall($checkbox, $delete_data, 'breaking_news');

            $array = array(
                'success' => 'Selected Breaking News activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Breaking News',
            );
        }
        echo json_encode($array);
    }

    public function status_alllinksdde() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {
                // echo $row;
                array_push($checkbox, $row);
            }

            $delete_data = array(
                'status' => 0,
            );
            $abc = $this->common->statusall($checkbox, $delete_data, 'breaking_news');

            $array = array(
                'success' => 'Selected Breaking News deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Breaking News',
            );
        }
        echo json_encode($array);
    }

  
    
}

?>
