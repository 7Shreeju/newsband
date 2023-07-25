<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallary extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'login');
        $this->load->model('Common_model', 'common');
        $this->load->model('Profile_model', 'pro');
        $this->load->model('Index_model', 'index');
        $this->login->is_logged_in();
        $this->index->activity_update();
    }

    public function index() {
        $data['page_name'] = 'Add Gallery Category';
        $this->index->activity_log(' Gallary Category List');
        $data['gallary_category_list'] = $this->common->list('gallary_category');
        $data['content_view'] = 'Gallary/gallary_category';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $this->load->view('admin_template', $data);
    }

//GallaryFunctionality

    public function add_galcategory() {
        $this->index->activity_log('Add Gallery Category');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|is_unique[gallary_category.category_name]');

        if ($this->form_validation->run()) {
            $insert_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => $this->common->cleanStr($this->input->post('category_name')),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
            $id = $this->common->insert_table('gallary_category', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'Gallery Category added successfully.'
                );
            }
        } else {
            $array = array(
                'error' => true,
                'category_error' => form_error('category_name')
            );
        }
        echo json_encode($array);
    }

    public function fetch_galcat() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'gallary_category');
            echo json_encode($data);
        }
    }

    function check_order_no($order_no) {
        if ($this->input->post('id'))
            $id = $this->input->post('id');
        else
            $id = '';
        $result = $this->common->check_unique_order_no($order_no, 'gallary_category', 'category_name',$id);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('check_order_no', 'Category Name  already exist');
            $response = false;
        }
        return $response;
    }

    public function edit_galcat() {
        $this->index->activity_log('Edit Gallery Category');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'category Name', 'required|callback_check_order_no');

        if ($this->form_validation->run()) {
            $id = $this->input->post('id');
            $update_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => $this->common->cleanStr($this->input->post('category_name')),
               
            );
            $this->common->update_table('gallary_category', $update_data, $id);
            if($this->db->affected_rows() == 0){
                $array = array(
                    'warning' => 'You have made no changes.'
                );
            }else{
                $update_data['createdDate'] = DATE;
                $update_data['createdBy'] = $this->session->userdata('user_id');
                $this->common->update_table('gallary_category', $update_data, $id);

            $array = array(
                'success' => 'Gallery Category updated successfully.'
            );
        }
        } else {
            $array = array(
                'error' => true,
                'category_name_error' => form_error('category_name')
            );
        }
        echo json_encode($array);
    }

    public function delete_galcat() {
        $this->index->activity_log('Delete Gallery Category');
        $id = $this->input->post('id');

        $this->common->delete_table('gallary_category', $id);
        $this->common->delete_table1('gallary', 'category_id', $id);
        $array = array(
            'success' => 'Gallery Category deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_galcat() {
        $this->index->activity_log('Status Gallery Category');
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('gallary_category', $delete_data, $id);
        $this->common->update_table1('gallary', $delete_data, 'category_id', $id);

        $array = array(
            'success' => 'Gallery Category  status updated successfully.'
        );
        echo json_encode($array);
    }

    public function addimg() {
        $data['page_name'] = 'Add Featured';
        $this->index->activity_log('Add Featured');
        //$data['job_list'] = $this->job->list('job');
        $data['galcategory_list'] = $this->common->list1('gallary_category', 'status', '1');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Gallary/add_gallary';
        $this->load->view('admin_template', $data);
    }

    public function gallary() {
        $data['page_name'] = 'Featured List';
        $this->index->activity_log('Featured List');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['gallary_list'] = $this->common->list('gallary');
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Gallary/gallary_list';
        $this->load->view('admin_template', $data);
    }

    public function insert_gal() {
        $this->index->activity_log('Add Featured');
        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules('name', 'Image Name', 'trim|required');
//        $this->form_validation->set_rules('category_id', 'Category Name', 'trim|required');

        if (empty($_FILES['featured_image']['name'])) {
            $this->form_validation->set_rules('featured_image', 'Image', 'required');
        }


        if ($this->form_validation->run()) {


            $insert_data = array(
                'name' => $this->input->post('name'),
//                'category_id' => $this->input->post('category_id'),
                // 'featured_image' => $main_img['msg'],
                // 'featured_imageurl' => $file_path_main . $main_img['msg'],
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
            $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp");

            if (isset($_FILES['featured_image']) && $_FILES['featured_image']['name'] != "") {
                $extId = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
                $errors = array();
                $maxsize = 26214400;
                if (!in_array($extId, $extensionResume) && (!empty($_FILES["featured_image"]["type"]))) {
                    $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
                }
                if (($_FILES['featured_image']['size'] >= $maxsize) || ($_FILES["featured_image"]["size"] == 0)) {
                    $this->session->set_flashdata('error', 'Image Size Too Large');
                }

                $image_data = $_FILES['featured_image'];
                $path = './uploads/gallary/';
                $file_path_image = base_url() . 'uploads/gallary/';
                $image = $this->common->upload_image($image_data, 1, $path);
                $insert_data['featured_image'] = $image;
                $insert_data['featured_imageurl'] = $file_path_image . $image;
            }
            $id = $this->common->insert_table('gallary', $insert_data);

            if ($id) {
                $array = array(
                    'success' => 'Feature added successfully.'
                );
            }
        } else {
            $array = array(
                'error' => true,
                'imgname_error' => form_error('name'), //author variable name
                'img_error' => form_error('featured_image'),
                'categoryname_error' => form_error('category_id')
            );
        }
        echo json_encode($array);
    }

    public function editgallary($id) {
        if ($id == 'edit') {
            $this->form_validation->set_error_delimiters('', '');

            $this->form_validation->set_rules('name', 'Name', 'trim|required');
//            $this->form_validation->set_rules('category_id', 'Category', 'trim|required');

            if ($this->form_validation->run()) {
                $id = $this->input->post('id');

                $update_data['name'] = $this->input->post('name');
//                $update_data['category_id'] = $this->input->post('category_id');

                

                $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "png", "webp");
                if (isset($_FILES['featured_image']) && $_FILES['featured_image']['name'] != "") {
                    $extId = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
                    $errors = array();
                    $maxsize = 26214400;
                    if (!in_array($extId, $extensionResume) && (!empty($_FILES["featured_image"]["type"]))) {
                        $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
                    }
                    if (($_FILES['featured_image']['size'] >= $maxsize) || ($_FILES["featured_image"]["size"] == 0)) {
                        $this->session->set_flashdata('error', 'Image Size Too Large');
                    }

                    $image_data = $_FILES['featured_image'];
                    $path = './uploads/gallary/';
                    $file_path_image = base_url() . 'uploads/gallary/';
                    $image = $this->common->upload_image($image_data, 1, $path);

                    $update_data['featured_image'] = $image;
                    $update_data['featured_imageurl'] = $file_path_image . $image;
                }


                $this->common->update_table('gallary', $update_data, $id);
                if($this->db->affected_rows()== 0){
                    $array = array(
                        'warning' => 'You have made no changes.'
                    );
                }else{
                    $update_data['createdBy'] = $this->session->userdata('user_id');
                $update_data['createdDate'] = DATE;
                $this->common->update_table('gallary', $update_data, $id);
                    $array = array(
                        'success' => 'Feature updated successfully.'
                    );
                }
               
            } else {
                $array = array(
                    'error' => true,
                    'imgname1_error' => form_error('name'),
                    'categoryname1_error' => form_error('category_id'),
                );
            }
            echo json_encode($array);
        } else {
            $data['page_name'] = 'Featured List';
            $this->index->activity_log('Edit Featured');
            $data['edit_details'] = $this->common->view('gallary', $id);
            $data['galcategory_list'] = $this->common->list1('gallary_category', 'status', '1');

            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
            $data['user_detail'] = $this->common->view1();

            $data['content_view'] = 'Gallary/edit_gallary';

            $this->load->view('admin_template', $data);
        }
    }

    public function delete_gallary() {

        $this->index->activity_log('Delete Gallery');
        $id = $this->input->post('id');

        $this->common->delete_table('gallary', $id);
        $array = array(
            'success' => 'Feature deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_gallary() {
        $this->index->activity_log('Status Featured');
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('gallary', $delete_data, $id);
        $array = array(
            'success' => 'Feature status updated successfully.'
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
            $abc = $this->common->deleteAll($checkbox, 'gallary');

            $array = array(
                'success' => 'Selected Features deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Features',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'gallary');

            $array = array(
                'success' => 'Selected Features activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Features',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'gallary');

            $array = array(
                'success' => 'Selected Features deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Features',
            );
        }
        echo json_encode($array);
    }

    public function deleteAllc() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'gallary_category');
            $abc = $this->common->deleteAllcat($checkbox, 'gallary');

            $array = array(
                'success' => 'Selected Features Category deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Features Category',
            );
        }
        echo json_encode($array);
    }

    public function statusallc() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }

            $delete_data = array(
                'status' => 1,
            );
            $abc = $this->common->statusall($checkbox, $delete_data, 'gallary_category');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'gallary');

            $array = array(
                'success' => 'Selected Features Category activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Features Category',
            );
        }
        echo json_encode($array);
    }

    public function statusalldec() {
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'gallary_category');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'gallary');

            $array = array(
                'success' => 'Selected Features Category deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Features Category',
            );
        }
        echo json_encode($array);
    }


}

?>
