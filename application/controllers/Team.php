<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {

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
        $data['page_name'] = 'Add Team';
        $this->index->activity_log('Add Team');
        $data['content_view'] = 'Team/add_team';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $this->load->view('admin_template', $data);
    }

//Team Functionality



    public function insert_team() {


        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
//        $this->form_validation->set_rules('briefintro', 'Brief Intro', 'trim|required');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
        
        if (empty($_FILES['featured_image']['name'])) {
            $this->form_validation->set_rules('featured_image', 'Image', 'required');
        }
        if ($this->form_validation->run()) {

            $insert_data = array(
                'name' => $this->input->post('name'),
                 'fb' => $this->input->post('fb'),
                 'twitter' => $this->input->post('twitter'),
                 'linked' => $this->input->post('linked'),
                
                'designation' => $this->input->post('designation'),
                'briefintro' => $this->input->post('briefintro'),
                'url' => str_replace(' ', '-', strtolower($this->input->post('name'))),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );

            $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");

            if (isset($_FILES['featured_image']) && $_FILES['featured_image']['name'] != "") {
                $extId = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
                $errors = array();
                $maxsize = 26214400;
                if (!in_array($extId, $extensionResume) && (!empty($_FILES["featured_image"]["type"]))) {
                    $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
                    redirect('add-client');
                }
                if (($_FILES['featured_image']['size'] >= $maxsize) || ($_FILES["featured_image"]["size"] == 0)) {
                    $this->session->set_flashdata('error', 'Image Size Too Large');
                    redirect('add-client');
                }

                $image_data = $_FILES['featured_image'];
                $path = './uploads/team/';
                $file_path_image = base_url() . 'uploads/team/';
                $image = $this->common->upload_image($image_data, 1, $path);
                $insert_data['featured_image'] = $image;
                $insert_data['featured_imageurl'] = $file_path_image . $image;
            }
            $id = $this->common->insert_table('team', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'Team added successfully.'
                );
            }
        } else {
            $array = array(
                'error' => true,
                'name_error' => form_error('name'),
              'image_error' => form_error('featured_image'),
                'designation_error' => form_error('designation')
            );
        }
        echo json_encode($array);
    }

    public function team_list() {

        $data['page_name'] = 'Team List';
        $this->index->activity_log('Team List');
        $data['team_list'] = $this->common->list('team');
        $data['content_view'] = 'Team/team_list';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $this->load->view('admin_template', $data);
    }

    public function edit_team($id) {
        if ($id == 'editteam') {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
//            $this->form_validation->set_rules('briefintro', 'Brief Intro', 'trim|required');
            $this->form_validation->set_rules('designation', 'Designation', 'trim|required');

            if ($this->form_validation->run()) {


                $id = $this->input->post('id');

                $update_data['name'] = $this->input->post('name');
                 $update_data['fb'] = $this->input->post('fb');
                  $update_data['twitter'] = $this->input->post('twitter');
                  $update_data['linked'] = $this->input->post('linked');
                $update_data['designation'] = $this->input->post('designation');
                $update_data['briefintro'] = $this->input->post('briefintro');
               

                $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");

                if (isset($_FILES['featured_image']) && $_FILES['featured_image']['name'] != "") {
                    $extId = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
                    $errors = array();
                    $maxsize = 26214400;
                    if (!in_array($extId, $extensionResume) && (!empty($_FILES["featured_image"]["type"]))) {
                        $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
                        redirect('add-client');
                    }
                    if (($_FILES['featured_image']['size'] >= $maxsize) || ($_FILES["featured_image"]["size"] == 0)) {
                        $this->session->set_flashdata('error', 'Image Size Too Large');
                        redirect('add-client');
                    }

                    $image_data = $_FILES['featured_image'];
                    $path = './uploads/team/';
                    $file_path_image = base_url() . 'uploads/team/';
                    $image = $this->common->upload_image($image_data, 1, $path);
                    $update_data['featured_image'] = $image;
                    $update_data['featured_imageurl'] = $file_path_image . $image;
                }
                $this->common->update_table('team', $update_data, $id);
                if($this->db->affected_rows() == 0){
                    $array = array(
                        'warning' => 'You have made no changes.'
                    );
                }else{
                    $update_data['createdBy'] = $this->session->userdata('user_id');
                    $update_data['createdDate'] = DATE;
                    $this->common->update_table('team', $update_data, $id);
                $array = array(
                    'success' => 'Team data successfully.'
                );
                }
            } else {
                $array = array(
                    'error' => true,
                    'nameteam_error' => form_error('name'),
                    'desoteam_error' => form_error('designation'),
//                    'shortinfoteam_error' => form_error('briefintro')
                );
            }
            echo json_encode($array);
        } else {
            $data['page_name'] = 'Team List';
            $this->index->activity_log('Edit Team');
            $data['edit_details'] = $this->common->view('team', $id);
            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
            $data['user_detail'] = $this->common->view1();

            $data['content_view'] = 'Team/edit_team';

            $this->load->view('admin_template', $data);
        }
    }

    public function fetch_team() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'team');
            echo json_encode($data);
        }
    }

    public function delete_team() {

        $this->index->activity_log('Delete Team');
        $id = $this->input->post('id');

        $this->common->delete_table('team', $id);
        $array = array(
            'success' => 'Team deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_team() {
        $this->index->activity_log('Status Team');
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('team', $delete_data, $id);
        $array = array(
            'success' => 'Team status updated successfully.'
        );
        echo json_encode($array);
    }

    public function deleteAllteam() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'team');

            $array = array(
                'success' => 'Selected Team deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Team',
            );
        }
        echo json_encode($array);
    }

    public function statusallteam() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }

            $delete_data = array(
                'status' => 1,
            );
            $abc = $this->common->statusall($checkbox, $delete_data, 'team');

            $array = array(
                'success' => 'Selected Team activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Team',
            );
        }
        echo json_encode($array);
    }

    public function statusalldeteam() {
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'team');

            $array = array(
                'success' => 'Selected Team deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Team',
            );
        }
        echo json_encode($array);
    }

}

?>
