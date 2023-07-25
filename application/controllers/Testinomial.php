<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Testinomial extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'login');
        $this->load->model('Index_model', 'index');
        $this->load->model('Common_model', 'common');
        $this->load->model('Profile_model', 'pro');
        $this->index->activity_update();
         $this->login->is_logged_in();
    }

    public function index() {
        $data['page_name'] = 'Add Testimonials';
        $this->index->activity_log('Add Testimonials');
        $data['content_view'] = 'Testimonial/add_testimonials';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $this->load->view('admin_template', $data);
    }

//Testinomials Functionality


    public function upload1() {
        if ($_FILES["upload"]['name'] == '') {
            $this->form_validation->set_rules('featured_image', 'featured_image ', 'trim|required');
        } else {
            if (isset($_FILES['upload']['name'])) {
                $file = $_FILES['upload']['tmp_name'];
                $file_name = $_FILES['upload']['name'];
                $file_name_array = explode(".", $file_name);
                $extension = end($file_name_array);
                $new_image_name = rand() . '.' . $extension;
                chmod('upload', 0777);
                $allowed_extension = array("jpg","jpeg", "gif", "png");
                if (in_array($extension, $allowed_extension)) {
                    move_uploaded_file($file, './upload1/' . $new_image_name);
                    $function_number = $_GET['CKEditorFuncNum'];
                    $url = base_url() . 'upload1/' . $new_image_name;
                    $message = '';
                    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
                }
            }
        }
    }

    public function insert_testimonials() {


        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('shortinfo', 'Feebback', 'trim|required');

        if ($this->form_validation->run()) {

            $insert_data = array(
                'name' => $this->input->post('name'),
//                'designation' => $this->input->post('designation'),
                'shortinfo' => $this->input->post('shortinfo'),
                // 'url' => str_replace(' ', '-', strtolower($this->input->post('blogtitle'))),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );

            $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");

            if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                $extId = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $errors = array();
                $maxsize = 26214400;
                if (!in_array($extId, $extensionResume) && (!empty($_FILES["image"]["type"]))) {
                    $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
                    redirect('add-testimonials');
                }
                if (($_FILES['image']['size'] >= $maxsize) || ($_FILES["image"]["size"] == 0)) {
                    $this->session->set_flashdata('error', 'Image Size Too Large');
                    redirect('add-testimonials');
                }

                $image_data = $_FILES['image'];
                $path = './uploads/testimonials/';
                $file_path_image = base_url() . 'uploads/testimonials/';
                $image = $this->common->upload_image($image_data, 1, $path);
                $insert_data['image'] = $image;
                $insert_data['image_url'] = $file_path_image . $image;
            }
            $id = $this->common->insert_table('testimonial', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'Testimonials added successfully.'
                );
            }
        } else {
            $array = array(
                'error' => true,
                'name_error' => form_error('name'),
                'shortinfo_error' => form_error('shortinfo'),
            );
        }
        echo json_encode($array);
    }

    public function testimonial_list() {
        $this->index->activity_log('Testimonial List');

        $data['page_name'] = 'Testimonial List';
        $data['testimonial_list'] = $this->common->list('testimonial');
        $data['content_view'] = 'Testimonial/testimonials_list';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $this->load->view('admin_template', $data);
    }

    public function edit_testimonial($id) {
        if ($id == 'edittestimonial') {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('shortinfo', 'Feebback', 'trim|required');

            if ($this->form_validation->run()) {


                $id = $this->input->post('id');

                $update_data['name'] = $this->input->post('name');
//                $update_data['designation'] = $this->input->post('designation');
                $update_data['shortinfo'] = $this->input->post('shortinfo');
               

                $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");

                if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                    $extId = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $errors = array();
                    $maxsize = 26214400;
                    if (!in_array($extId, $extensionResume) && (!empty($_FILES["image"]["type"]))) {
                        $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
                        redirect('add-testimonials');
                    }
                    if (($_FILES['image']['size'] >= $maxsize) || ($_FILES["image"]["size"] == 0)) {
                        $this->session->set_flashdata('error', 'Image Size Too Large');
                        redirect('add-testimonials');
                    }

                    $image_data = $_FILES['image'];
                    $path = './uploads/testimonials/';
                    $file_path_image = base_url() . 'uploads/testimonials/';
                    $image = $this->common->upload_image($image_data, 1, $path);
                    $update_data['image'] = $image;
                    $update_data['image_url'] = $file_path_image . $image;
                }
                $this->common->update_table('testimonial', $update_data, $id);
                if($this->db->affected_rows()== 0){
                    $array = array(
                        'warning' => 'You have made no changes.'
                    );
                }else{
                    $update_data['createdBy'] = $this->session->userdata('user_id');
                    $update_data['createdDate'] = DATE;
                    $this->common->update_table('testimonial', $update_data, $id);
                $array = array(
                    'success' => 'Testimonial updated successfully.'
                );
            }
            } else {
                $array = array(
                    'error' => true,
                    'nametest_error' => form_error('name'),
                    'shortinfotest_error' => form_error('shortinfo')
                );
            }
            echo json_encode($array);
        } else {
            $data['page_name'] = 'Testimonial List';
            $this->index->activity_log('Edit Testimonials');
            $data['edit_details'] = $this->common->view('testimonial', $id);
            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
            $data['user_detail'] = $this->common->view1();

            $data['content_view'] = 'Testimonial/edit_testimonial';

            $this->load->view('admin_template', $data);
        }
    }

    public function fetch_test() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'testimonial');
            echo json_encode($data);
        }
    }

    public function delete_testimonial() {
      
        $this->index->activity_log('Delete Testimonial');

        $id = $this->input->post('id');

        $this->common->delete_table('testimonial', $id);
        $array = array(
            'success' => 'Testimonial deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_testimonial() {
        $this->index->activity_log('Status Testimonial');

        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('testimonial', $delete_data, $id);
        $array = array(
            'success' => 'Testimonial status updated successfully.'
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
            $abc = $this->common->deleteAll($checkbox, 'testimonial');

            $array = array(
                'success' => 'Selected Testimonial deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Testimonial',
            );
        }
        echo json_encode($array);
    }

    public function statusall() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }

            $delete_data = array(
                'status' => 1,
            );
            $abc = $this->common->statusall($checkbox, $delete_data, 'testimonial');

            $array = array(
                'success' => 'Selected Testimonial activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Testimonial',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'testimonial');

            $array = array(
                'success' => 'Selected Testimonial deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Testimonial',
            );
        }
        echo json_encode($array);
    }

}

?>
