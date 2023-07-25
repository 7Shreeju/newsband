<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clientele extends CI_Controller {

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
        $data['page_name'] = 'Add Cartoon';
        $this->index->activity_log('Add Cartoon');
        $data['content_view'] = 'clientele/add_clientele';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
         $data['user_detail'] = $this->common->view1();


         $data['user_detail'] = $this->common->view1();


        $this->load->view('admin_template', $data);
    }

//Clientele Functionality

    public function add_client() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Image', 'required');
        }

        if ($this->form_validation->run()) {
            $insert_data = array(
                'name' => $this->input->post('name'),
                'url' => $this->common->cleanStr($this->input->post('name')),
                'status' => '1',
                'createdDate' => DATE
            );

            $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp");

            if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                $extId = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $errors = array();
                $maxsize = 26214400;
                if (!in_array($extId, $extensionResume) && (!empty($_FILES["image"]["type"]))) {
                    $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg,webp Format For Feature Image');
                    redirect('add-client');
                }
                if (($_FILES['image']['size'] >= $maxsize) || ($_FILES["image"]["size"] == 0)) {
                    $this->session->set_flashdata('error', 'Image Size Too Large');
                    redirect('add-client');
                }

                $image_data = $_FILES['image'];
                $path = './uploads/client/';
                $file_path_image = base_url() . 'uploads/client/';
                $image = $this->common->upload_image($image_data, 1, $path);
                $insert_data['image'] = $image;
                $insert_data['image_url'] = $file_path_image . $image;
            }

            $id = $this->common->insert_table('clientele', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'Cartoon  Added successfully.'
                );
            }
        } else {
            $array = array(
                'error' => true,
                'name_error' => form_error('name'),
                'clientimg_error' => form_error('image'),
            );
        }
        echo json_encode($array);
    }

    public function client_list() {
        $data['page_name'] = 'Cartoon List';
        $this->index->activity_log('Cartoon list');
        $data['client_list'] = $this->common->list('clientele');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
         $data['user_detail'] = $this->common->view1();


        $data['content_view'] = 'clientele/clientele_list';
        $this->load->view('admin_template', $data);
    }

    public function editclient($id) {
        if ($id == 'editclient') {
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('name', 'Name', 'trim|required');

            if ($this->form_validation->run()) {
                $id = $this->input->post('id');

                $update_data['name'] = $this->input->post('name');
                $update_data['url'] = $this->common->cleanStr($this->input->post('name'));

                $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp");
                if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                    $extId = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $errors = array();
                    $maxsize = 26214400;
                    if (!in_array($extId, $extensionResume) && (!empty($_FILES["image"]["type"]))) {
                        $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg,webp Format For Feature Image');
                    }
                    if (($_FILES['image']['size'] >= $maxsize) || ($_FILES["image"]["size"] == 0)) {
                        $this->session->set_flashdata('error', 'Image Size Too Large');
                        redirect('add-client');
                    }

                    $image_data = $_FILES['image'];
                    $path = './uploads/client/';
                    $file_path_image = base_url() . 'uploads/client/';
                    $image = $this->common->upload_image($image_data, 1, $path);
                    $update_data['image'] = $image;
                    $update_data['image_url'] = $file_path_image . $image;
                }
                $this->common->update_table('clientele', $update_data, $id);
                if($this->db->affected_rows() == 0){
                    $array = array(
                        'warning' => 'You have made no changes.'
                    );
                }else{
                $array = array(
                    'success' => 'Cartoon Updated successfully.'
                );
            }
            } else {
                $array = array(
                    'error' => true,
                    'name1_error' => form_error('name'),
                );
            }
            echo json_encode($array);
        } else {
            $data['page_name'] = 'Cartoon List';
            $this->index->activity_log('Edit Cartoon');
            $data['edit_details'] = $this->common->view('clientele', $id);
            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
             $data['user_detail'] = $this->common->view1();


            $data['content_view'] = 'clientele/edit_clientele';
            $this->load->view('admin_template', $data);
        }
    }

    public function delete_client() {
        $this->index->activity_log('Delete Clientele');
        $id = $this->input->post('id');
        $this->common->delete_table('clientele', $id);
        $array = array(
            'success' => 'Cartoon Deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_client() {
        $this->index->activity_log('Status Clientele');
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('clientele', $delete_data, $id);
        $array = array(
            'success' => 'Cartoon Status Updated successfully.'
        );
        echo json_encode($array);
    }

 

    public function deleteAll() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'clientele');

            $array = array(
                'success' => 'Selected Cartoon Deleted successfully',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Cartoon',
            );
        }
        echo json_encode($array);
    }

    public function statusall() {
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'clientele');

            $array = array(
                'success' => 'Selected Cartoon activated successfully',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Cartoon',
            );
        }
        echo json_encode($array);
    }

    public function statusallde() {
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'clientele');

            $array = array(
                'success' => 'Selected Cartoon deactivated successfully',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Cartoon',
            );
        }
        echo json_encode($array);
    }

//    public function unlink() {
//        $id = $this->input->post('id');
//        $query = $this->common->un($id, 'clientele');
//        $row = $query->row();
//        $img = $row->image;
//
//        if (file_exists("uploads/client/" . $img)) {
//            unlink("uploads/client/" . $img);
//        }
//        $data = array('image' => NULL);
//        $this->db->where('id', $id);
//        $this->db->update('clientele', $data);
//        //redirect('edit-testimonial/'.$id.'');
//        $array = array(
//            'success' => 'Data deleted',
//        );
//        echo json_encode($array);
//    }

}
