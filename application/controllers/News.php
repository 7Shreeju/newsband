<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

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
        $data['page_name'] = 'News Category List';
        $this->index->activity_log('News Category List');
        $data['newscategory_list'] = $this->common->list('news_category');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();
        $data['content_view'] = 'News/newscategory_list';
        $this->load->view('admin_template', $data);
    }

    //news category



    public function add_newscategory() {
        $this->index->activity_log('News Category Add');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'news category Name', 'trim|required|is_unique[news_category.category_name]', array('is_unique' => 'This %s already exists.'));
        if ($this->form_validation->run()) {
            $insert_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => $this->common->cleanStr($this->input->post('category_name')),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
            $id = $this->common->insert_table('news_category', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'News Category added successfully.'
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

    public function fetch_newscategory() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'news_category');
            echo json_encode($data);
        }
    }

    function check_order_no($order_no) {
        if ($this->input->post('id'))
            $id = $this->input->post('id');
        else
            $id = '';
        $result = $this->common->check_unique_order_no( $order_no, 'news_category', 'category_name',$id);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('check_order_no', 'Category Name  already exist');
            $response = false;
        }
        return $response;
    }

    public function edit_newscategory() {
        $this->index->activity_log('News Category Edit');
        $id = $this->input->post('id');

        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'category Name', 'required|callback_check_order_no');

        if ($this->form_validation->run()) {
            $id = $this->input->post('id');
            $update_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
              
            );
            $this->common->update_table('news_category', $update_data, $id);
            if($this->db->affected_rows() == 0){
            $array = array(
                'warning' => 'You have made no changes.'
            );
        }else{
            $update_data['createdDate'] = DATE;
            $this->common->update_table('news_category', $update_data, $id);
            $array = array(
                'success' => 'Newscategory updated successfully.'
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

    public function delete_newscategory() {
        $this->index->activity_log('News Category Delete');

        $id = $this->input->post('id');

        $this->common->delete_table('news_category', $id);
        $this->common->delete_table1('news', 'category_id', $id);

        $array = array(
            'success' => 'Newscategory deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_newscategory() {
        $this->index->activity_log('News Category Status');
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('news_category', $delete_data, $id);
        $this->common->update_table1('news', $delete_data, 'category_id', $id);
        $array = array(
            'success' => 'Newscategory status updated successfully.'
        );
        echo json_encode($array);
    }

    // News Functionality

    public function addnews() {
        $data['page_name'] = 'Add Advertisement';
        $this->index->activity_log('Advertisement Add');
        $data['newscategory_list'] = $this->common->list1('news_category', 'status', '1');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'News/addnews';
        $this->load->view('admin_template', $data);
    }

    public function news_list() {
        $data['page_name'] = 'Advertisement List';
        $this->index->activity_log('Advertisement List');
        $data['news_list'] = $this->common->list('news');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'News/newslist';
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
    public function insert_news() {
        $this->form_validation->set_error_delimiters('', '');
//        $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
//        $this->form_validation->set_rules('date', 'date', 'trim|required');
//        $this->form_validation->set_rules('briefintro', 'briefintro', 'trim|required');
        
        if ($this->form_validation->run()) {
        $insert_data = array(
//            'category_id' => $this->input->post('category_id'),
            'posted_by' => $this->input->post('posted_by'),
            'title' => $this->input->post('title'),
            'url' => $this->common->cleanStr($this->input->post('title')),
//            'date' => $this->input->post('date'),
//            'briefintro' => $this->input->post('briefintro'),
//            'details' => $this->input->post('details'),
//            'conical' => $this->common->cleanStr($this->input->post('title')),
            'status' => '1',
            'createdBy' => $this->session->userdata('user_id'),
            'createdDate' => DATE
        );

        $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");
//
//        if (isset($_FILES['main_img']) && $_FILES['main_img']['name'] != "") {
//            $extId = pathinfo($_FILES['main_img']['name'], PATHINFO_EXTENSION);
//            $errors = array();
//            $maxsize = 26214400;
//            if (!in_array($extId, $extensionResume) && (!empty($_FILES["main_img"]["type"]))) {
//                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
//            }
//            if (($_FILES['main_img']['size'] >= $maxsize) || ($_FILES["main_img"]["size"] == 0)) {
//                $this->session->set_flashdata('error', 'Image Size Too Large');
//            }
//
//            $image_data = $_FILES['main_img'];
//            $path = './uploads/news/';
//            $file_path_image = base_url() . 'uploads/news/';
//            $image = $this->common->upload_image($image_data, 1, $path);
//            $insert_data['main_img'] = $image;
//            $insert_data['main_imgurl'] = $file_path_image . $image;
//        }



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
            $path = './uploads/news/';
            $file_path_image = base_url() . 'uploads/news/';
            $image = $this->common->upload_image($image_data, 2, $path);
            $insert_data['featured_image'] = $image;
            $insert_data['featured_imageurl'] = $file_path_image . $image;
        }


        $id = $this->common->insert_table('news', $insert_data);

        $lid = $this->db->insert_id();
        $url = array(
            'column_id' => $lid,
            'type' => 'News',
            'old_url' => str_replace(' ', '-', strtolower($this->input->post('title'))),
            'new_url' => str_replace(' ', '-', strtolower($this->input->post('title'))),
        );
        $this->common->insert_table('url_redirections', $url);

        if ($id) {
            $this->session->set_flashdata('success', 'Advertisement added successfully !!!!! ');
            redirect("add-news");
        }
    }else{
        $this->session->set_flashdata('error', 'Something went wrong');
            redirect("add-news");
    }
}

    public function edit_news($id) {

        $data['page_name'] = 'Advertisement List';
        $this->index->activity_log('Advertisement Edit');
        $data['edit_details'] = $this->common->view('news', $id);
        $data['newscategory_list'] = $this->common->list1('news_category', 'status', '1');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'News/editnews';
        $this->load->view('admin_template', $data);
    }

    public function editnews() {
        $this->form_validation->set_error_delimiters('', '');
//        $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
    $this->form_validation->set_rules('title', 'title', 'trim|required');
//        $this->form_validation->set_rules('date', 'date', 'trim|required');
//        $this->form_validation->set_rules('briefintro', 'briefintro', 'trim|required');
        
        if ($this->form_validation->run()) {
        $id = $this->input->post('id');

        $update_data = array(
//            'category_id' => $this->input->post('category_id'),
            'posted_by' => $this->input->post('posted_by'),
            'title' => $this->input->post('title'),
            'url' => $this->common->cleanStr($this->input->post('title')),
//            'conical' => $this->common->cleanStr($this->input->post('title')),
            'date' => $this->input->post('date'),
//            'briefintro' => $this->input->post('briefintro'),
//            'details' => $this->input->post('details'),
           
        );

        $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");

//        if (isset($_FILES['main_img']) && $_FILES['main_img']['name'] != "") {
//            $extId = pathinfo($_FILES['main_img']['name'], PATHINFO_EXTENSION);
//            $errors = array();
//            $maxsize = 26214400;
//            if (!in_array($extId, $extensionResume) && (!empty($_FILES["main_img"]["type"]))) {
//                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
//            }
//            if (($_FILES['main_img']['size'] >= $maxsize) || ($_FILES["main_img"]["size"] == 0)) {
//                $this->session->set_flashdata('error', 'Image Size Too Large');
//            }
//
//            $image_data = $_FILES['main_img'];
//            $path = './uploads/news/';
//            $file_path_image = base_url() . 'uploads/news/';
//            $image = $this->common->upload_image($image_data, 1, $path);
//            $update_data['main_img'] = $image;
//            $update_data['main_imgurl'] = $file_path_image . $image;
//        }
//


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
            $path = './uploads/news/';
            $file_path_image = base_url() . 'uploads/news/';
            $image = $this->common->upload_image($image_data, 2, $path);
            $update_data['featured_image'] = $image;
            $update_data['featured_imageurl'] = $file_path_image . $image;
        }


        $this->common->update_table('news', $update_data, $id);
        $hb = $this->db->affected_rows();
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
         if( $hb == 0){
            $this->session->set_flashdata('warning', 'You have made no changes.');
        redirect("edit-news/" . $id);  
         }
         $update_data['createdDate'] = DATE;
         $this->common->update_table('news', $update_data, $id);
        $this->session->set_flashdata('success', 'Advertisement Updated successfully');
        redirect("edit-news/" . $id);
    }else{
        $this->session->set_flashdata('error', 'Something went wrong');
        redirect("edit-news/" . $id); 
    }
    }
    public function fetch_news() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'news');
            echo json_encode($data);
        }
    }

    public function delete_news() {

        $this->index->activity_log('Advertisement Delete');
        $id = $this->input->post('id');

        $this->common->delete_table('news', $id);
        $array = array(
            'success' => 'Advertisement Deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_news() {
        $id = $this->input->post('id');
        $this->index->activity_log('Advertisement Status');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('news', $delete_data, $id);
        $array = array(
            'success' => 'Advertisement status updated successfully.'
        );
        echo json_encode($array);
    }

    public function feature_news() {
        $id = $this->input->post('id');
        $this->index->activity_log('Advertisement Featured');
        $delete_data = array(
            'alt_features' => $this->input->post('status_id'),
        );
        $this->common->update_table('news', $delete_data, $id);
        $array = array(
            'success' => 'Advertisement featured status updated successfully.'
        );
        echo json_encode($array);
    }

    public function editseo($id) {

        if ($id == 'editevntseo') {
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('meta_title', 'Meta Title ', 'trim|required');

            if ($this->form_validation->run()) {

                $id = $this->input->post('id');
                $update_data = array(
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description'),
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'conical' => $this->input->post('conical'),
                    'alt_tag_main_img' => $this->input->post('alt_tag_main_img'),
                    'alt_tag_featured_img' => $this->input->post('alt_tag_featured_img'),
                    'schemap' => $this->input->post('schemap'),
                );
                $this->common->update_table('news', $update_data, $id);
                $array = array(
                    'success' => 'SEO data updated successfully.'
                );
            } else {
                $array = array(
                    'error' => true,
                    'meta_title_error' => form_error('meta_title')
                );
            }
            echo json_encode($array);
        } else {
            $data['page_name'] = 'News List';
            $this->index->activity_log('News Seo');
            $data['edit_details'] = $this->news->view('news', $id);
            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
            $data['user_detail'] = $this->common->view1();

            $data['content_view'] = 'News/seo';
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
            $abc = $this->common->deleteAll($checkbox, 'news');

            $array = array(
                'success' => 'Selected Advertisement deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Advertisement',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'news');

            $array = array(
                'success' => 'Selected Advertisement activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Advertisement',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'news');

            $array = array(
                'success' => 'Selected Advertisement deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Advertisement',
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
            $abc = $this->common->deleteAll($checkbox, 'news_category');
            $abc = $this->common->deleteAllcat($checkbox, 'news');

            $array = array(
                'success' => 'Selected Advertisement Category deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Advertisement Category',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'news_category');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'news');

            $array = array(
                'success' => 'Selected Advertisement Category activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Advertisement Category',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'news_category');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'news');

            $array = array(
                'success' => 'Selected Advertisement Category deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Advertisement Category',
            );
        }
        echo json_encode($array);
    }

}
