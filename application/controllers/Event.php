<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

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
        $data['page_name'] = 'Event Category List';
        $this->index->activity_log('Event Category List');
        $data['eventcategory_list'] = $this->common->list('event_category');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Event/eventcategory_list';
        $this->load->view('admin_template', $data);
    }

    public function featured_event() {
        $id = $this->input->post('id');
        $this->index->activity_log('Event Featured ');
        $delete_data = array(
            'alt_features' => $this->input->post('status_id'),
        );
        $this->common->update_table('event', $delete_data, $id);

        $array = array(
            'success' => 'Event featured Updated successfully.'
        );
        echo json_encode($array);
    }

    //event category

    public function eventcategory_list() {
        $data['page_name'] = 'Event Category List';
        $this->index->activity_log('Event Category List');
        $data['eventcategory_list'] = $this->common->list('event_category');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Event/eventcategory_list';
        $this->load->view('admin_template', $data);
    }

    public function add_eventcategory() {
        
        $this->index->activity_log('Event Category Add');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'event category Name', 'trim|required|is_unique[event_category.category_name]', array('is_unique' => 'This %s already exists.'));
        if ($this->form_validation->run()) {
            $insert_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
            $id = $this->common->insert_table('event_category', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'Event Category added successfully.'
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

    public function fetch_eventcategory() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'event_category');
            echo json_encode($data);
        }
    }

    function check_order_no($order_no) {
        if ($this->input->post('id'))
            $id = $this->input->post('id');
        else
            $id = '';
        $result = $this->common->check_unique_order_no( $order_no, 'event_category', 'category_name',$id);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('check_order_no', 'Category Name  already exist');
            $response = false;
        }
        return $response;
    }

    public function edit_eventcategory() {
        $id = $this->input->post('id');
        $this->index->activity_log('Event Category Edit');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'category Name', 'required|callback_check_order_no');

        if ($this->form_validation->run()) {
            $id = $this->input->post('id');
            $update_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
              
            );
            $this->common->update_table('event_category', $update_data, $id);
           if($this->db->affected_rows() == 0){
                $array = array(
                    'warning' => 'You have made no changes.'
                );
            }else{
                $update_data['createdDate'] = DATE;
                $this->common->update_table('event_category', $update_data, $id);
                 $array = array(
                'success' => 'Event Category updated successfully.'
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

    public function delete_eventcategory() {
        $this->index->activity_log('Delete Category List');

        $id = $this->input->post('id');

        $this->common->delete_table('event_category', $id);
        $this->common->delete_table1('event', 'category_id', $id);

        $array = array(
            'success' => 'Event Category deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_eventcategory() {
        $this->index->activity_log('Status Category List');
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('event_category', $delete_data, $id);
        $this->common->update_table1('event', $delete_data, 'category_id', $id);
        $array = array(
            'success' => 'Event Category status updated successfully.'
        );
        echo json_encode($array);
    }

    // Event Functionality

    public function addevent() {
        $data['page_name'] = 'Home page Slider';
        $this->index->activity_log('Home page Slider');
        
           $data['edit_details'] = $this->common->list1('home_page_slider', 'id','1');
        $data['article'] = $this->common->list1('blog', 'status', '1');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Event/addevent';
        $this->load->view('admin_template', $data);
    }

    public function event_list() {
        $data['page_name'] = 'Event List';
        $this->index->activity_log('Event List');
        $data['event_list'] = $this->common->list('event');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Event/event_list';
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
    public function insert_event() {
        
        $insert_data = array(
            
            'article1' => $this->input->post('article1'),
              'article2' => $this->input->post('article2'),
           'article3' => $this->input->post('article3'),
         'article4' => $this->input->post('article4'),
             'article5' => $this->input->post('article5'),
//            'createdBy' => $this->session->userdata('user_id'),
//            'createdDate' => DATE
        );
        $extensionResume1 = array("pdf");

        if (isset($_FILES['pdf']) && $_FILES['pdf']['name'] != "") {
            $extId = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);
            $errors = array();
            $maxsize = 26214400;
            if (!in_array($extId, $extensionResume1) && (!empty($_FILES["pdf"]["type"]))) {
                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
            }
            if (($_FILES['pdf']['size'] >= $maxsize) || ($_FILES["pdf"]["size"] == 0)) {
                $this->session->set_flashdata('error', 'Image Size Too Large');
            }

            $image_data = $_FILES['pdf'];
            $path = './uploads/events/pdf/';
            $file_path_image = base_url() . 'uploads/events/pdf/';
            $image = $this->common->upload_image($image_data, 1, $path);
            $insert_data['pdf'] = $image;
            $insert_data['pdf_url'] = $file_path_image . $image;
        }
        $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");

        if (isset($_FILES['main_img']) && $_FILES['main_img']['name'] != "") {
            $extId = pathinfo($_FILES['main_img']['name'], PATHINFO_EXTENSION);
            $errors = array();
            $maxsize = 26214400;
            if (!in_array($extId, $extensionResume) && (!empty($_FILES["main_img"]["type"]))) {
                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
            }
            if (($_FILES['main_img']['size'] >= $maxsize) || ($_FILES["main_img"]["size"] == 0)) {
                $this->session->set_flashdata('error', 'Image Size Too Large');
            }

            $image_data = $_FILES['main_img'];
            $path = './uploads/events/';
            $file_path_image = base_url() . 'uploads/events/';
            $image = $this->common->upload_image($image_data, 1, $path);
            $insert_data['main_img'] = $image;
            $insert_data['main_imgurl'] = $file_path_image . $image;
        }



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
            $path = './uploads/events/';
            $file_path_image = base_url() . 'uploads/events/';
            $image = $this->common->upload_image($image_data, 2, $path);
            $insert_data['featured_image'] = $image;
            $insert_data['featured_imageurl'] = $file_path_image . $image;
        }


//insert data into database table.  
        $id = $this->common->insert_table('event', $insert_data);
        $lid = $this->db->insert_id();
        $url = array(
            'column_id' => $lid,
            'type' => 'Event',
            'old_url' => '',
            'new_url' => str_replace(' ', '-', strtolower($this->input->post('name'))),
        );
        $this->common->insert_table('url_redirections', $url);

        
            $this->session->set_flashdata('success', 'Event Added successfully.');
            redirect("add-event");
        
   
}

    public function edit_event($id) {

        $data['page_name'] = 'Event List';
        $this->index->activity_log('Edit Event');
        $data['edit_details'] = $this->common->view('event', $id);
        $data['eventcategory_list'] = $this->common->list1('event_category', 'status', '1');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Event/editevent';
        $this->load->view('admin_template', $data);
    }

    public function editevent() {
       
        $id = $this->input->post('id');

        $update_data = array(
            'article1' => $this->input->post('article1'),
              'article2' => $this->input->post('article2'),
           'article3' => $this->input->post('article3'),
         'article4' => $this->input->post('article4'),
             'article5' => $this->input->post('article5'),
            
        );

       $this->common->update_table('home_page_slider', $update_data, $id);
    
        $this->session->set_flashdata('success', 'home page slider updated successfully.');
        redirect("add-event");
   

    }

    public function fetch_event() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'event');
            echo json_encode($data);
        }
    }

    public function delete_event() {

        $this->index->activity_log('Event Delete');
        $id = $this->input->post('id');

        $this->common->delete_table('event', $id);
        $array = array(
            'success' => 'Event deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_event() {
        $this->index->activity_log('Event Status');
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('event', $delete_data, $id);
        $array = array(
            'success' => 'Event status updated successfully.'
        );
        echo json_encode($array);
    }

    public function feature_event() {
        $id = $this->input->post('id');
        $this->index->activity_log('Event featured');
        $delete_data = array(
            'alt_features' => $this->input->post('status_id'),
        );
        $this->common->update_table('event', $delete_data, $id);
        $array = array(
            'success' => 'Event featured status updated successfully.'
        );
        echo json_encode($array);
    }

    public function editevntseo($id) {

        if ($id == 'editevntseo') {
           

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
                $this->common->update_table('event', $update_data, $id);
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
            $data['page_name'] = 'Event List';
            $data['edit_details'] = $this->common->view('event', $id);
            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
            $data['user_detail'] = $this->common->view1();
            $this->index->activity_log('Event Seo');
            $data['content_view'] = 'Event/seo';
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
            $abc = $this->common->deleteAll($checkbox, 'event');

            $array = array(
                'success' => 'Selected Event deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Event',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'event');

            $array = array(
                'success' => 'Selected Event activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Event',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'event');

            $array = array(
                'success' => 'Selected Event deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Event',
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
            $abc = $this->common->deleteAll($checkbox, 'event_category');
            $abc = $this->common->deleteAllcat($checkbox, 'event');

            $array = array(
                'success' => 'Selected Event Category deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Event Category',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'event_category');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'event');

            $array = array(
                'success' => 'Selected Event Category activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Event Category',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'event_category');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'event');

            $array = array(
                'success' => 'Selected Event Category deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Event Category',
            );
        }
        echo json_encode($array);
    }

}
