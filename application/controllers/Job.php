<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {

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
        $data['page_name'] = 'Job Category List';
        $this->index->activity_log('Job Category List');
        $data['jobcategory_list'] = $this->common->list('job_category');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Job/jobcategory_list';
        $this->load->view('admin_template', $data);
    }

    public function featured_job() {
        $id = $this->input->post('id');
        $this->index->activity_log('Job Featured');
        $delete_data = array(
            'alt_features' => $this->input->post('status_id'),
        );
        $this->job->update_table('job', $delete_data, $id);

        $array = array(
            'success' => 'Job featured status updated successfully.'
        );
        echo json_encode($array);
    }

    //job category

    public function jobcategory_list() {
        $data['page_name'] = 'Job Category List';
        $this->index->activity_log('Job Category List');
        $data['jobcategory_list'] = $this->common->list('job_category');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Job/jobcategory_list';
        $this->load->view('admin_template', $data);
    }

    public function add_jobcategory() {
        $this->index->activity_log('Add Job Category');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'job category Name', 'trim|required|is_unique[job_category.category_name]', array('is_unique' => 'This %s already exists.'));
        if ($this->form_validation->run()) {
            $insert_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
            $id = $this->common->insert_table('job_category', $insert_data);
           
            if ($id) {

                $array = array(
                    'success' => 'Job Category added successfully.'
                );
            }
        } else {
            $array = array(
                'error' => true,
                'categoryname_error' => form_error('category_name')
            );
        }
        echo json_encode($array);
    }

    public function fetch_jobcategory() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'job_category');
            echo json_encode($data);
        }
    }

    function check_order_no($order_no) {
        if ($this->input->post('id'))
            $id = $this->input->post('id');
        else
            $id = '';
        $result = $this->common->check_unique_order_no( $order_no, 'job_category', 'category_name',$id);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('check_order_no', 'Category Name  already exist');
            $response = false;
        }
        return $response;
    }

    public function edit_jobcategory() {
        $id = $this->input->post('id');
        $this->index->activity_log('Edit Job Category');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'category Name', 'required|callback_check_order_no');

        if ($this->form_validation->run()) {
            $id = $this->input->post('id');
            $update_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
               
            );
            $this->common->update_table('job_category', $update_data, $id);
            if($this->db->affected_rows() == 0){
                $array = array(
                    'warning' => 'You have made no changes..'
                );
            }else{
                $update_data['createdDate'] = DATE;
                $this->common->update_table('job_category', $update_data, $id);
               $array = array(
                'success' => 'Job Category updated successfully.'
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

    public function delete_jobcategory() {

        $this->index->activity_log('Delete Job Category');
        $id = $this->input->post('id');

        $this->common->delete_table('job_category', $id);
        $this->common->delete_table1('job', 'category_id', $id);

        $array = array(
            'success' => 'Jobcategory deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_jobcategory() {
        $this->index->activity_log('Status Job Category');
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('job_category', $delete_data, $id);
        $this->common->update_table1('job', $delete_data, 'category_id', $id);
        $array = array(
            'success' => 'Job Category status updated successfully.'
        );
        echo json_encode($array);
    }

    // Job Functionality

    public function addjob() {
        $data['page_name'] = 'Add Job';
        $this->index->activity_log('Add Job');
        $data['job_list'] = $this->common->list('job');
        $data['jobcategory_list'] = $this->common->list1('job_category', 'status', '1');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Job/addjob';
        $this->load->view('admin_template', $data);
    }

    public function job_list() {
        $data['page_name'] = 'Job List';
        $this->index->activity_log('Job List');
        $data['job_list'] = $this->common->list('job');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Job/job_list';
        $this->load->view('admin_template', $data);
    }

    public function upload() {
        $config['upload_path'] = './upload';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1024;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('upload')) {
            echo json_encode(array('error' => $this->upload->display_errors()));
        } else {
            $upload_data = $this->upload->data();
            $url = base_url() . 'upload/' . $upload_data['file_name'];
            $message = '';
            $function_number = $this->input->get('CKEditorFuncNum');
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
        }
    }

//ADD BLOG
    public function insert_job() {
        $this->form_validation->set_error_delimiters('', '');
//        $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
//        $this->form_validation->set_rules('designation', 'designation', 'trim|required');
        $this->form_validation->set_rules('shortdescription', 'shortdescription', 'trim|required');
//        $this->form_validation->set_rules('experience', 'experience', 'trim|required');
//        $this->form_validation->set_rules('salary', 'salary', 'trim|required');
        
        if ($this->form_validation->run()) {
        $this->index->activity_log('Add Job');
        $insert_data = array(
//            'category_id' => $this->input->post('category_id'),
            'title' => $this->input->post('title'),
            'job_url' => $this->common->cleanStr($this->input->post('title')),
//            'designation' => $this->input->post('designation'),
//            'salary' => $this->input->post('salary'),
//            'experience' => $this->input->post('experience'),
            'shortdescription' => $this->input->post('shortdescription'),
//            'description' => $this->input->post('description'),
            'status' => '1',
            'canonical' => $this->common->cleanStr($this->input->post('title')),
            'createdBy' => $this->session->userdata('user_id'),
            'createdDate' => DATE
        );

//        $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");
//
//        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['name'] != "") {
//            $extId2 = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
//            $errors = array();
//            $maxsize = 26214400;
//            if (!in_array($extId2, $extensionResume) && (!empty($_FILES["featured_image"]["type"]))) {
//                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
//            }
//            if (($_FILES['featured_image']['size'] >= $maxsize) || ($_FILES["featured_image"]["size"] == 0)) {
//                $this->session->set_flashdata('error', 'Image Size Too Large');
//            }
//
//            $image_data = $_FILES['featured_image'];
//            $path = './uploads/job/';
//            $file_path_image = base_url() . 'uploads/job/';
//            $image = $this->common->upload_image($image_data, 2, $path);
//            $insert_data['featured_image'] = $image;
//            $insert_data['featured_image_url'] = $file_path_image . $image;
//        }


//insert data into database table.  
        $id = $this->common->insert_table('job', $insert_data);
        $lid = $this->db->insert_id();
        $url = array(
            'column_id' => $lid,
            'type' => 'Job',
            'old_url' => '',
            'new_url' => str_replace(' ', '-', strtolower($this->input->post('title'))),
        );
        $this->common->insert_table('url_redirections', $url);

        if ($id) {
            $this->session->set_flashdata('success', 'Job added successfully.');
            redirect("add-job");
        }
    }else{
        $this->session->set_flashdata('error', 'Something went wrong');
        redirect("add-job");
    }
}

    public function edit_job($id) {

        $data['page_name'] = 'Job List';
        $this->index->activity_log('Edit Job');
        $data['edit_details'] = $this->common->view('job', $id);
        $data['jobcategory_list'] = $this->common->list1('job_category', 'status', '1');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Job/editjob';
        $this->load->view('admin_template', $data);
    }

    public function editjob() {
        $this->form_validation->set_error_delimiters('', '');
//        $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
//        $this->form_validation->set_rules('designation', 'designation', 'trim|required');
        $this->form_validation->set_rules('shortdescription', 'shortdescription', 'trim|required');
//        $this->form_validation->set_rules('experience', 'experience', 'trim|required');
//        $this->form_validation->set_rules('salary', 'salary', 'trim|required');
        
        if ($this->form_validation->run()) {
        $id = $this->input->post('id');

        $update_data = array(
//            'category_id' => $this->input->post('category_id'),
            'title' => $this->input->post('title'),
            'job_url' => $this->common->cleanStr($this->input->post('title')),
//            'designation' => $this->input->post('designation'),
//            'salary' => $this->input->post('salary'),
//            'experience' => $this->input->post('experience'),
            'shortdescription' => $this->input->post('shortdescription'),
//            'description' => $this->input->post('description'),
            
            'canonical' => $this->common->cleanStr($this->input->post('title'))
        );

        $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");

//        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['name'] != "") {
//            $extId2 = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
//            $errors = array();
//            $maxsize = 26214400;
//            if (!in_array($extId2, $extensionResume) && (!empty($_FILES["featured_image"]["type"]))) {
//                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
//            }
//            if (($_FILES['featured_image']['size'] >= $maxsize) || ($_FILES["featured_image"]["size"] == 0)) {
//                $this->session->set_flashdata('error', 'Image Size Too Large');
//            }
//
//            $image_data = $_FILES['featured_image'];
//            $path = './uploads/job/';
//            $file_path_image = base_url() . 'uploads/job/';
//            $image = $this->common->upload_image($image_data, 2, $path);
//            $update_data['featured_image'] = $image;
//            $update_data['featured_image_url'] = $file_path_image . $image;
//        }

        $this->common->update_table('job', $update_data, $id);
        $ab = $this->db->affected_rows();
        $bb = str_replace(' ', '-', strtolower($this->input->post('title')));
        $this->db->select('*');
        $this->db->where('column_id', $id);
        $this->db->from('url_redirections');
        $query = $this->db->get();
        $row = $query->row();
        if ($row->new_url != $bb) {
            $url = array(
                'old_url' => $row->new_url,
                'new_url' => $bb,
            );
            $this->common->update_table1('url_redirections', $url, 'column_id', $id);
        }
           if($ab == 0){
            $this->session->set_flashdata('warning', 'You have made no changes.');
            redirect("edit-job/" . $id);
           }else{
            $update_data['createdDate'] = DATE;
            $this->common->update_table('job', $update_data, $id);
        $this->session->set_flashdata('success', 'Job updated successfully !!!!! ');
        redirect("edit-job/" . $id);
    }
    }else{
        $this->session->set_flashdata('error', 'Something went wrong');
        redirect("edit-job/" . $id);
    }
}
    public function fetch_job() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'job');
            echo json_encode($data);
        }
    }

    public function delete_job() {

        $this->index->activity_log('Job Delete');
        $id = $this->input->post('id');

        $this->common->delete_table('job', $id);
        $array = array(
            'success' => 'Job deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_job() {
        $id = $this->input->post('id');
        $this->index->activity_log('Job status');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('job', $delete_data, $id);
        $array = array(
            'success' => 'Job status updated successfully.'
        );
        echo json_encode($array);
    }

    public function feature_job() {
        $id = $this->input->post('id');
        $this->index->activity_log('Job Featured');
        $delete_data = array(
            'alt_featued' => $this->input->post('status_id'),
        );
        $this->common->update_table('job', $delete_data, $id);
        $array = array(
            'success' => 'Job featured status updated successfully.'
        );
        echo json_encode($array);
    }

    public function editseo($id) {

        if ($id == 'editseo') {
           

                $id = $this->input->post('id');
                $update_data = array(
                    'metatitle' => $this->input->post('metatitle'),
                    'metadescr' => $this->input->post('metadescr'),
                    'metakey' => $this->input->post('metakey'),
                    'metadescr' => $this->input->post('metadescr'),
                    'canonical' => $this->input->post('canonical'),
                    'alttimage' => $this->input->post('alttimage'),
                    'altfimage' => $this->input->post('altfimage'),
                    'schemap' => $this->input->post('schemap'),
                );
               
                $bb = str_replace(' ', '-', strtolower($this->input->post('canonical')));
                $this->db->select('*');
                $this->db->where('column_id', $id);
                $this->db->from('url_redirections');
                $query = $this->db->get();
                $row = $query->row();
                if ($row->new_url != $bb) {
                    $url = array(
                        'old_url' => $row->new_url,
                        'new_url' => $bb,
                    );
                    $this->common->update_table1('url_redirections', $url, 'column_id', $id);
                }
                $this->common->update_table('job', $update_data, $id);
                if($this->db->affected_rows()== 0){
                    $array = array(
                        'error' => 'You have made no changes.'
                    );
                }else{
                $array = array(
                    'success' => 'SEO data Updated successfully.'
                );
               }
            echo json_encode($array);
        } else {
            $data['page_name'] = 'Job List';
            $this->index->activity_log('Job Seo');
            $data['edit_details'] = $this->common->view('job', $id);
            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
            $data['user_detail'] = $this->common->view1();

            $data['content_view'] = 'Job/seo';
            $this->load->view('admin_template', $data);
        }
    }

     public function deleteAll() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'job');

            $array = array(
                'success' => 'Selected Job deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Job',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'job');

            $array = array(
                'success' => 'Selected Job activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Job',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'job');

            $array = array(
                'success' => 'Selected Job deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Job',
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
            $abc = $this->common->deleteAll($checkbox, 'job_category');
            $abc = $this->common->deleteAllcat($checkbox, 'job');

            $array = array(
                'success' => 'Selected Job Category deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Job Category',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'job_category');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'job');

            $array = array(
                'success' => 'Selected Job Category activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Job Category',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'job_category');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'job');

            $array = array(
                'success' => 'Selected Job Category deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Job Category',
            );
        }
        echo json_encode($array);
    }


}
