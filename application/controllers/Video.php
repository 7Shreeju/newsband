<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

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
        $data['page_name'] = 'Video Category List';
        $this->index->activity_log('Video Category List');
        $data['videocategory_list'] = $this->common->list('video_category');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Video/videocategory_list';
        $this->load->view('admin_template', $data);
    }

    //video category

    public function videocategory_list() {
        $data['page_name'] = 'Video Category List';
        $this->index->activity_log('Video Category List');
        $data['videocategory_list'] = $this->common->list('video_category');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Video/videocategory_list';
        $this->load->view('admin_template', $data);
    }

    public function add_videocategory() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'video category Name', 'trim|required|is_unique[video_category.category_name]', array('is_unique' => 'This %s already exists.'));
        if ($this->form_validation->run()) {
            $insert_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
            $id = $this->common->insert_table('video_category', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'Video Category added successfully.'
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

    public function fetch_videocategory() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'video_category');
            echo json_encode($data);
        }
    }

    function check_order_no($order_no) {
        if ($this->input->post('id'))
            $id = $this->input->post('id');
        else
            $id = '';
        $result = $this->common->check_unique_order_no( $order_no, 'video_category', 'category_name',$id);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('check_order_no', 'Category Name  already exist');
            $response = false;
        }
        return $response;
    }

    public function edit_videocategory() {
        $id = $this->input->post('id');

        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'category Name', 'required|callback_check_order_no');

        if ($this->form_validation->run()) {
            $id = $this->input->post('id');
            $update_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
                
            );
            $this->common->update_table('video_category', $update_data, $id);
            if($this->db->affected_rows()== 0){
                $array = array(
                    'warning' => 'You have made no changes.'
                );  
            }else{
                $update_data['createdDate'] = DATE;
                $this->common->update_table('video_category', $update_data, $id);
            $array = array(
                'success' => 'Video Category data updated successfully.'
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

    public function delete_videocategory() {
        $this->index->activity_log('Video Category Delete');

        $id = $this->input->post('id');

        $this->common->delete_table('video_category', $id);
        $this->common->delete_table1('videos', 'category_id', $id);

        $array = array(
            'success' => 'Video Category data deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_videocategory() {
        $id = $this->input->post('id');
        $this->index->activity_log('Video Category Status');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('video_category', $delete_data, $id);
        $this->common->update_table1('videos', $delete_data, 'category_id', $id);
        $array = array(
            'success' => 'Video Category status updated successfully.'
        );
        echo json_encode($array);
    }

    // Video Functionality

    public function addvideo() {
        $data['page_name'] = 'Add Video';
        $this->index->activity_log('Add Video');
        $data['videocategory_list'] = $this->common->list1('video_category', 'status', '1');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Video/addvideo';
        $this->load->view('admin_template', $data);
    }

    public function video_list() {
        $data['page_name'] = 'Video List';
        $this->index->activity_log('Video List');
        $data['video_list'] = $this->common->list('videos');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Video/video_list';
        $this->load->view('admin_template', $data);
    }

//ADD Video
    public function insert_video() {
        $this->form_validation->set_error_delimiters('', '');
//        $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('link', 'link', 'trim|required');
       
        
        if ($this->form_validation->run()) {
        $insert_data = array(
//            'category_id' => $this->input->post('category_id'),
            'title' => $this->input->post('title'),
            'url' => $this->common->cleanStr($this->input->post('title')),
            'link' => $this->input->post('link'),
//            'briefintro' => $this->input->post('briefintro'),
            'status' => '1',
            'createdBy' => $this->session->userdata('user_id'),
            'conical' => $this->common->cleanStr($this->input->post('title')),
            'createdDate' => DATE
        );

        $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");

        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['name'] != "") {
            $extId2 = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
            $errors = array();
            $maxsize = 26214400;
            if (!in_array($extId2, $extensionResume) && (!empty($_FILES["featured_image"]["type"]))) {
                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
            }
            if (($_FILES['featured_image']['size'] >= $maxsize) || ($_FILES["featured_image"]["size"] == 0)) {
                $this->session->set_flashdata('error', 'Image Size Too Large');
            }

            $image_data = $_FILES['featured_image'];
            $path = './uploads/videos/';
            $file_path_image = base_url() . 'uploads/videos/';
            $image = $this->common->upload_image($image_data, 2, $path);
            $insert_data['featured_image'] = $image;
            $insert_data['featured_imageurl'] = $file_path_image . $image;
        }


//insert data into database table.  
        $id = $this->common->insert_table('videos', $insert_data);

        $lid = $this->db->insert_id();
        $url = array(
            'column_id' => $lid,
            'type' => 'Video',
            'old_url' => str_replace(' ', '-', strtolower($this->input->post('title'))),
            'new_url' => str_replace(' ', '-', strtolower($this->input->post('title'))),
        );
        $this->common->insert_table('url_redirections', $url);

        if ($id) {
            $this->session->set_flashdata('success', 'Video added successfully.');
            redirect("add-video");
        }
    }else{
        $this->session->set_flashdata('error', 'Something went wrong');
        redirect("add-video");
    }
}

    public function edit_video($id) {

        $data['page_name'] = 'Video List';
        $this->index->activity_log('Video Edit');
        $data['edit_details'] = $this->common->view('videos', $id);
        $data['videocategory_list'] = $this->common->list1('video_category', 'status', '1');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Video/editvideo';
        $this->load->view('admin_template', $data);
    }

    public function editvideo() {
        $this->form_validation->set_error_delimiters('', '');
//        $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('link', 'link', 'trim|required');
        
        
        if ($this->form_validation->run()) {
        $id = $this->input->post('id');

        $update_data = array(
//            'category_id' => $this->input->post('category_id'),
            'title' => $this->input->post('title'),
            'url' => $this->common->cleanStr($this->input->post('title')),
            'link' => $this->input->post('link'),
//            'briefintro' => $this->input->post('briefintro'),
           
            'conical' => $this->common->cleanStr($this->input->post('title')),
            
        );

        $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");

        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['name'] != "") {
            $extId2 = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
            $errors = array();
            $maxsize = 26214400;
            if (!in_array($extId2, $extensionResume) && (!empty($_FILES["featured_image"]["type"]))) {
                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
            }
            if (($_FILES['featured_image']['size'] >= $maxsize) || ($_FILES["featured_image"]["size"] == 0)) {
                $this->session->set_flashdata('error', 'Image Size Too Large');
            }

            $image_data = $_FILES['featured_image'];
            $path = './uploads/videos/';
            $file_path_image = base_url() . 'uploads/videos/';
            $image = $this->common->upload_image($image_data, 2, $path);
            $update_data['featured_image'] = $image;
            $update_data['featured_imageurl'] = $file_path_image . $image;
        }

        $this->common->update_table('videos', $update_data, $id);
        $hn = $this->db->affected_rows();
      
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
        if($hn == 0){
            $this->session->set_flashdata('warning', 'You have made no changes.');
            redirect("edit-video/" . $id);
        }else{
            $update_data['createdDate'] = DATE;
            $update_data['createdBy'] = $this->session->userdata('user_id');
            $this->common->update_table('videos', $update_data, $id);
        $this->session->set_flashdata('success', 'Video updated successfully');
        redirect("edit-video/" . $id);
       }
     }else{
        $this->session->set_flashdata('error', 'Something went wrong');
        redirect("edit-video/" . $id); 
     }
    }

    public function fetch_video() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'videos');
            echo json_encode($data);
        }
    }

    public function delete_video() {

        $this->index->activity_log('Video Delete');
        $id = $this->input->post('id');

        $this->common->delete_table('videos', $id);
        $array = array(
            'success' => 'Video deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_video() {
        $id = $this->input->post('id');
        $this->index->activity_log('Video Status');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('videos', $delete_data, $id);
        $array = array(
            'success' => 'Video status updated successfully.'
        );
        echo json_encode($array);
    }

    public function feature_video() {
        $id = $this->input->post('id');
        $this->index->activity_log('Video featured');
        $delete_data = array(
            'alt_featued' => $this->input->post('status_id'),
        );
        $this->common->update_table('videos', $delete_data, $id);
        $array = array(
            'success' => 'Video feature Updated successfully.'
        );
        echo json_encode($array);
    }

    public function editvideoseo($id) {

        if ($id == 'editvideoseo') {
          

                $id = $this->input->post('id');
                $update_data = array(
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'meta_description' => $this->input->post('meta_description'),
                    'conical' => $this->input->post('conical'),
                    'alt_tag_featured_img' => $this->input->post('alt_tag_featured_img'),
                    'alt_tag_main_img' => $this->input->post('alt_tag_main_img'),
                    'schemap' => $this->input->post('schemap'),
                );
                $this->common->update_table('videos', $update_data, $id);
                if($this->db->affected_rows() == 0){
                    $array = array(
                        'error' => 'You have made no changes.'
                    );  
                }else{
                $array = array(
                    'success' => 'SEO data updated successfully.'
                );
                }
            echo json_encode($array);
        } else {
            $data['page_name'] = 'Video List';
            $this->index->activity_log('Video Seo');
            $data['edit_details'] = $this->common->view('videos', $id);
            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
            $data['user_detail'] = $this->common->view1();

            $data['content_view'] = 'Video/seo';
            $this->load->view('admin_template', $data);
        }
    }

    public function delete_allvideocat() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'video_category');

            $abc = $this->common->deleteAllcat($checkbox, 'videos');

            $array = array(
                'success' => 'Selected Video Category deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Video Category',
            );
        }
        echo json_encode($array);
    }

    public function status_allvideocat() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }

            $delete_data = array(
                'status' => 1,
            );
            $abc = $this->common->statusall($checkbox, $delete_data, 'video_category');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'videos');

            $array = array(
                'success' => 'Selected Video Category activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Video Category',
            );
        }
        echo json_encode($array);
    }

    public function status_allvideocatde() {
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'video_category');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'videos');

            $array = array(
                'success' => 'Selected Video Category deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Video Category',
            );
        }
        echo json_encode($array);
    }

    public function delete_allvideo() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'videos');

            $array = array(
                'success' => 'Selected Video deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Video',
            );
        }
        echo json_encode($array);
    }

    public function status_allvideo() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }

            $delete_data = array(
                'status' => 1,
            );
            $abc = $this->common->statusall($checkbox, $delete_data, 'videos');

            $array = array(
                'success' => 'Selected Video activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Video',
            );
        }
        echo json_encode($array);
    }

    public function status_allvideode() {
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'videos');

            $array = array(
                'success' => 'Selected Video deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Video',
            );
        }
        echo json_encode($array);
    }

}
