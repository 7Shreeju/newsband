<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller {

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
        $data['page_name'] = 'Package Pricing';
        $this->index->activity_log('Package Pricing');
        $data['content_view'] = 'Pdf/add_pdf';
          $data['edit_details'] = $this->common->list1('package', 'id','1');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();
        $this->load->view('admin_template', $data);
    }

//Pdf Functionality

    public function add_pdf() {
        $this->index->activity_log('Package Pricing');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        if (empty($_FILES['pdf']['name'])) {
            $this->form_validation->set_rules('pdf', 'Pdf', 'required');
        }
        if ($this->form_validation->run()) {
        $insert_data = array(
            'status' => '1',
            'createdDate' => DATE, 
            'createdBy' => $this->session->userdata('user_id'),
            'name' => $this->input->post('name'),
        );

        $extensionResume = array("pdf");

        if (isset($_FILES['pdf']) && $_FILES['pdf']['name'] != "") {
            $extId = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);
            $errors = array();
            $maxsize = 26214400;
            if (!in_array($extId, $extensionResume) && (!empty($_FILES["pdf"]["type"]))) {
                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg,webp Format For Feature Image');
                redirect('add-client');
            }
            if (($_FILES['pdf']['size'] >= $maxsize) || ($_FILES["pdf"]["size"] == 0)) {
                $this->session->set_flashdata('error', 'Image Size Too Large');
                redirect('add-client');
            }

            $image_data = $_FILES['pdf'];
            $path = './uploads/pdf/';
            $file_path_image = base_url() . 'uploads/pdf/';
            $image = $this->common->upload_image($image_data, 1, $path);
            $insert_data['pdf'] = $image;
            $insert_data['pdf_url'] = $file_path_image . $image;
        }

        $id = $this->common->insert_table('pdf', $insert_data);
        if ($id) {
            $array = array(
                'success' => 'Pdf added successfully.'
            );
        }
    }else{
        $array = array(
            'error' => true,
            'name_error' => form_error('name'),
            'pdf_error' => form_error('pdf')
        );
    }

        echo json_encode($array);
    }

    public function pdf_list() {
        $data['page_name'] = 'Pdf List';
        $this->index->activity_log('Pdf List');
        $data['pdf_list'] = $this->common->list('pdf');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();
        $data['content_view'] = 'Pdf/pdf_list';
        $this->load->view('admin_template', $data);
    }

    public function editpdf() {
       
       
            $this->index->activity_log('Package Pricing');
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('month', 'Month', 'trim|required');
             $this->form_validation->set_rules('half', 'Half', 'trim|required');
              $this->form_validation->set_rules('year', 'Year', 'trim|required');
            if ($this->form_validation->run()) {
           
                $id = $this->input->post('id');
 
                $update_data['createdBy'] = $this->session->userdata('user_id');
                $update_data['createdDate'] =DATE;
                $update_data['month']= $this->input->post('month');
                 $update_data['half']= $this->input->post('half'); 
                 $update_data['year']= $this->input->post('year');
                 
                
 $this->common->update_table('package', $update_data, $id);
                $array = array(
                    'success' => 'Package Pricing updated successfully.'
                );
            }else{
                $array = array(
                    'error' => true,
                    'name1_error' => form_error('month'),
                    'name2_error' => form_error('half'),
                    'name3_error' => form_error('year')
                );
            }
            echo json_encode($array);
       
    }

    public function delete_pdf() {
        $this->index->activity_log('Pdf Delete');
        $id = $this->input->post('id');
        $this->common->delete_table('pdf', $id);
        $array = array(
            'success' => 'Pdf deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_pdf() {
        $this->index->activity_log('Pdf Status');
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('pdf', $delete_data, $id);
        $array = array(
            'success' => 'Pdf status updated successfully.'
        );
        echo json_encode($array);
    }

    public function delete_allpdf() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'pdf');

            $array = array(
                'success' => 'Selected Pdf deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Pdf',
            );
        }
        echo json_encode($array);
    }

    public function status_allpdf() {
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'pdf');

            $array = array(
                'success' => 'Selected Pdf activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Pdf',
            );
        }
        echo json_encode($array);
    }

    public function status_allpdfdde() {
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'pdf');

            $array = array(
                'success' => 'Selected Pdf deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Pdf',
            );
        }
        echo json_encode($array);
    }


}
