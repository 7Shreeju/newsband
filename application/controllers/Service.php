



<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'login');
        $this->load->model('Common_model', 'common');
        $this->load->model('Profile_model', 'pro');
        $this->load->model('Index_model', 'index');
        $this->index->activity_update();
    }

    public function index() {

        $data['page_name'] = 'Service Category List';
        $this->index->activity_log('Service Category List');
        $data['servicecategory_list'] = $this->common->list('servicecategory');

        $data['content_view'] = 'Services/service_category_list';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $this->load->view('admin_template', $data);
    }

    public function add_servicecategory() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'Service category', 'trim|required|is_unique[servicecategory.category_name]', array('is_unique' => 'This %s already exists.'));
        if ($this->form_validation->run()) {
            $insert_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => $this->common->cleanStr($this->input->post('category_name')),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );

            $id = $this->common->insert_table('servicecategory', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'Service Category added successfully.'
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

    public function fetch_servicecat() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'servicecategory');
            echo json_encode($data);
        }
    }

    public function editsercat($id) {
        //  $id= $this->input->post('id');
        $data['page_name'] = 'Service Category List';
        $this->index->activity_log('Service Category Edit');
        $data['content_view'] = 'Services/editsercat';
        $data['edit_details'] = $this->common->view('servicecategory', $id);
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $this->load->view('admin_template', $data);
    }

    function check_order_no($order_no) {
        if ($this->input->post('id'))
            $id = $this->input->post('id');
        else
            $id = '';
        $result = $this->common->check_unique_order_no( $order_no, 'servicecategory', 'category_name',$id);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('check_order_no', 'Category Name  already exist');
            $response = false;
        }
        return $response;
    }

    public function edit_servicecategory() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'Service category', 'trim|required|callback_check_order_no');

        if ($this->form_validation->run()) {
            $id = $this->input->post('id');
            $update_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => $this->common->cleanStr($this->input->post('category_name')),
               
               
            );

            $this->common->update_table('servicecategory', $update_data, $id);
            if($this->db->affected_rows() == 0){
                $array = array(
                    'warning' => 'Service Category has not Updated.'
                );
            }else{
                $update_data['createdBy'] = $this->session->userdata('user_id');
                $update_data['createdDate'] = DATE;
                $this->common->update_table('servicecategory', $update_data, $id);
            $array = array(
                'success' => 'Service Category updated successfully.'
            );
             }
        } else {
            $array = array(
                'error' => true,
                'e_name_error' => form_error('category_name'),
            );
        }
        echo json_encode($array);
    }

    public function delete_servicecategory() {

        $id = $this->input->post('id');
        $this->index->activity_log('Service Category Delete');
        
        $this->common->delete_table1('servicesubcategoory', 'category_id', $id);
 $this->common->delete_table1('services', 'category_id', $id);

        $array = array(
            'success' => 'Service Category deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_servicecategory() {
        $id = $this->input->post('id');
        $this->index->activity_log('Service Category Status');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('servicecategory', $delete_data, $id);
        $this->common->update_table1('servicesubcategoory', $delete_data, 'category_id', $id);

        $this->common->update_table1('services', $delete_data, 'category_id', $id);

        $array = array(
            'success' => 'Service Category status updated successfully.'
        );
        echo json_encode($array);
    }

    //subcat
    public function subcategory_list() {

        $data['page_name'] = 'Service SubCategory List';
        $this->index->activity_log('Service SubCategory List');
        $data['servisubcecategory_list'] = $this->common->list('servicesubcategoory');
        $data['servicecategory_list'] = $this->common->subcat('servicesubcategoory');

        $data['content_view'] = 'Services/subcategory_list';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $this->load->view('admin_template', $data);
    }

    public function add_sersubcategory() {
        $this->index->activity_log('Service SubCategory Add');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_id', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('subcategory_name', 'Subcategory Name', 'trim|required|is_unique[servicesubcategoory.subcategory_name]', array('is_unique' => 'This %s already exists.'));

        if ($this->form_validation->run()) {
            if($this->input->post('category_id')=='0'){
                $insert_data = array(
                'category_id' => $this->input->post('category_id'),
                'subcategory_name' => $this->input->post('subcategory_name'),
                'url' => $this->common->cleanStr($this->input->post('subcategory_name')),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );

            $id = $this->common->insert_table('servicesubcategoory', $insert_data);
             $array = array( 
                    'success' => 'Service Category added successfully.', 
                    );
            }else{
                 $insert_data = array(
                'category_id' => $this->input->post('category_id'),
                'subcategory_name' => $this->input->post('subcategory_name'),
                'url' => $this->common->cleanStr($this->input->post('subcategory_name')),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );

            $id = $this->common->insert_table('servicesubcategoory', $insert_data);
             $array = array( 
                    'success' => 'Service Sub Category added successfully.', 
                    );
            }
             
        } else {
            $array = array(
                'error' => true,
                'categoryser_error' => form_error('category_id'),
                'sersubcategory_error' => form_error('subcategory_name')
            );
        }
        echo json_encode($array);
    }

    public function fetch_servicesubcat() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'servicesubcategoory');
            echo json_encode($data);
        }
    }

    function check_order_no1($order_no) {
        if ($this->input->post('id'))
            $id = $this->input->post('id');
        else
            $id = '';
        $result = $this->common->check_unique_order_no( $order_no, 'servicesubcategoory', 'subcategory_name',$id);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('check_order_no1', 'Category Name  already exist');
            $response = false;
        }
        return $response;
    }

    public function edit_servicesubcategory() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_id', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('subcategory_name', 'Subcategory Name', 'trim|required|callback_check_order_no1');
        $this->index->activity_log('Service SubCategory Edit');
        if ($this->form_validation->run()) {
            $id = $this->input->post('id');
             if($this->input->post('category_id')=='0'){
                $update_data = array(
                'category_id' => $this->input->post('category_id'),
                'subcategory_name' => $this->input->post('subcategory_name'),
                'url' => $this->common->cleanStr($this->input->post('subcategory_name')),
              
            );
            $this->common->update_table('servicesubcategoory', $update_data, $id); 
             if($this->db->affected_rows() == 0){
                $array = array(
                    'warning' => 'You have made no changes.'
                );
            }else{
                $update_data['createdBy'] = $this->session->userdata('user_id');
                $update_data['createdDate'] = DATE;
                $this->common->update_table('servicesubcategoory', $update_data, $id);
             $array = array(
                'success' => 'Service Category updated successfully.'
            );
            }
             }else{
                 $update_data = array(
                'category_id' => $this->input->post('category_id'),
                'subcategory_name' => $this->input->post('subcategory_name'),
                'url' => $this->common->cleanStr($this->input->post('subcategory_name')),
              
            );
            $this->common->update_table('servicesubcategoory', $update_data, $id);
             if($this->db->affected_rows() == 0){
                $array = array(
                    'warning' => 'You have made no changes.'
                );
            }else{
                $update_data['createdBy'] = $this->session->userdata('user_id');
                $update_data['createdDate'] = DATE;
                $this->common->update_table('servicesubcategoory', $update_data, $id);
                 $array = array(
                'success' => 'Service Sub Category updated successfully.'
            );
                  }
            
             }
            
           
          
            
        } else {
            $array = array(
                'error' => true,
                'sercategoryproedit_error' => form_error('category_id'),
                'sersubcatedit_error' => form_error('subcategory_name')
            );
        }
        echo json_encode($array);
    }

    public function status_servicesubcategory() {
        $id = $this->input->post('id');
        $this->index->activity_log('Service SubCategory Status');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('servicesubcategoory', $delete_data, $id);
        $this->common->update_table1('services', $delete_data, 'category_id', $id);

        $array = array(
            'success' => 'Service Category and Sub Category status updated successfully.'
        );
        echo json_encode($array);
    }

    public function delete_servicesubcategory() {
          $this->index->activity_log('Service SubCategory Delete');
   
        $id = $this->input->post('id');
         $id = $this->input->post('id');
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->from('servicesubcategoory');
        $query= $this->db->get();
        $row= $query->row();
        if($row->category_id == '0'){
      
        $this->common->delete_table('servicesubcategoory', $id);
         $this->common->delete_table1('servicesubcategoory', 'category_id', $id);
       $this->common->delete_table1('services', 'category_id', $id);
        }else{
               $this->common->delete_table('servicesubcategoory', $id);
                 $this->common->delete_table1('services', 'category_id', $id);
        }

        $array = array(
            'success' => 'Service Category and Sub Category deleted successfully.'
        );
        echo json_encode($array);
    }

    public function getCityDepartment1() {
        // POST data 
        $postData = $this->input->post();

        // load model 
        // get data 
//        $data = $this->product->getCityDepartment($postData);
        $data = $this->common->getSubcategoryDependency($postData, 'id,subcategory_name', 'category_id', 'servicesubcategoory');

        echo json_encode($data);
    }

    public function addservice() {
        $data['page_name'] = 'Add service';
        $data['servicecategory_list'] = $this->common->subcat('servicesubcategoory');
        $this->index->activity_log('Service Add');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Services/add_service';
        $this->load->view('admin_template', $data);
    }

    public function upload() {
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
                $allowed_extension = array("jpg", "gif", "png", "webp", "jpeg");
                if (in_array($extension, $allowed_extension)) {
                    move_uploaded_file($file, './upload/' . $new_image_name);
                    $function_number = $_GET['CKEditorFuncNum'];
                    $url = base_url() . 'upload/' . $new_image_name;
                    $message = '';
                    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
                }
            }
        }
    }

    public function insert_service() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('briefintro', 'briefintro', 'trim|required');
       
        
        if ($this->form_validation->run()) {
        $insert_data = array(
            'category_id' => $this->input->post('category_id'),
            'subcategory_id' => $this->input->post('subcategory_id'),
            'name' => $this->input->post('name'),
            'ser_url' => $this->common->cleanStr($this->input->post('name')),
            'briefintro' => $this->input->post('briefintro'),
            'details' => $this->input->post('details'),
            'status' => '1',
            'urlr' => $this->common->cleanStr($this->input->post('name')),
            'createdBy' => $this->session->userdata('user_id'),
            'createdDate'=> DATE
        );

        $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");

        if (isset($_FILES['main_img']) && $_FILES['main_img']['name'] != "") {
            $extId = pathinfo($_FILES['main_img']['name'], PATHINFO_EXTENSION);
            $errors = array();
            $maxsize = 26214400;
            if (!in_array($extId, $extensionResume) && (!empty($_FILES["main_img"]["type"]))) {
                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg, webp Format For Feature Image');
            }
            if (($_FILES['main_img']['size'] >= $maxsize) || ($_FILES["main_img"]["size"] == 0)) {
                $this->session->set_flashdata('error', 'Image Size Too Large');
            }

            $image_data = $_FILES['main_img'];
            $path = './uploads/service/';
            $file_path_image = base_url() . 'uploads/service/';
            $image = $this->common->upload_image($image_data, 1, $path);
            $insert_data['main_img'] = $image;
            $insert_data['main_imgurl'] = $file_path_image . $image;
        }



        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['name'] != "") {
            $extId2 = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
            $errors = array();
            $maxsize = 26214400;
            if (!in_array($extId2, $extensionResume) && (!empty($_FILES["featured_image"]["type"]))) {
                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg, webp Format For Feature Image');
            }
            if (($_FILES['featured_image']['size'] >= $maxsize) || ($_FILES["featured_image"]["size"] == 0)) {
                $this->session->set_flashdata('error', 'Image Size Too Large');
            }

            $image_data1 = $_FILES['featured_image'];
            $path = './uploads/service/';
            $file_path_image = base_url() . 'uploads/service/';
            $image = $this->common->upload_image($image_data1, 2, $path);
            $insert_data['featured_image'] = $image;
            $insert_data['featured_imageurl'] = $file_path_image . $image;
        }


        //insert data into database table.  
        $id = $this->common->insert_table('services', $insert_data);
        $lid = $this->db->insert_id();
        $url = array(
            'column_id' => $lid,
            'type' => 'service',
            'old_url' => '',
            'new_url' => str_replace(' ', '-', strtolower($this->input->post('name'))),
        );
        $this->common->insert_table('url_redirections', $url);
        if ($id) {
            $this->session->set_flashdata('success', 'Service added successfully');
            redirect("add-service");
        }
    }else{
        $this->session->set_flashdata('error', 'Something went wrong');
        redirect("add-service");
    }
}

    public function service_list() {
        $data['page_name'] = 'service List';
        $data['service_list'] = $this->common->list('services');
        $this->index->activity_log('Service List');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Services/service_list';
        $this->load->view('admin_template', $data);
    }

    public function myformAjax1($id) {
        $this->db->where("category_id", $id);
        $this->db->where('status', '1');
        $result = $this->db->get("servicesubcategoory")->result();

        echo json_encode($result);
    }

    public function editser() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('briefintro', 'briefintro', 'trim|required');
        if ($this->form_validation->run()) {
        $id = $this->input->post('id');

        $update_data = array(
            'category_id' => $this->input->post('category_id'),
            'subcategory_id' => $this->input->post('subcategory_id'),
            'name' => $this->input->post('name'),
            'ser_url' => $this->common->cleanStr($this->input->post('name')),
            'urlr' => $this->common->cleanStr($this->input->post('name')),
            'briefintro' => $this->input->post('briefintro'),
            'details' => $this->input->post('details'),
            'status' => '1',
            'createdDate'=> DATE
        );

        $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "png", "webp");

        if (isset($_FILES['main_img']) && $_FILES['main_img']['name'] != "") {
            $extId = pathinfo($_FILES['main_img']['name'], PATHINFO_EXTENSION);
            $errors = array();
            $maxsize = 26214400;
            if (!in_array($extId, $extensionResume) && (!empty($_FILES["main_img"]["type"]))) {
                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg, webp Format For Feature Image');
            }
            if (($_FILES['main_img']['size'] >= $maxsize) || ($_FILES["main_img"]["size"] == 0)) {
                $this->session->set_flashdata('error', 'Image Size Too Large');
            }

            $image_data = $_FILES['main_img'];
            $path = './uploads/service/';
            $file_path_image = base_url() . 'uploads/service/';
            $image = $this->common->upload_image($image_data, 1, $path);
            $update_data['main_img'] = $image;
            $update_data['main_imgurl'] = $file_path_image . $image;
        }
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['name'] != "") {
            $extId1 = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
            $errors = array();
            $maxsize = 26214400;
            if (!in_array($extId1, $extensionResume) && (!empty($_FILES["pic"]["type"]))) {
                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg, webp Format For Feature Image');
            }
            if (($_FILES['featured_image']['size'] >= $maxsize) || ($_FILES["featured_image"]["size"] == 0)) {
                $this->session->set_flashdata('error', 'Image Size Too Large');
            }

            $image_data = $_FILES['featured_image'];
            $path = './uploads/service/';
            $file_path_image = base_url() . 'uploads/service/';
            $image = $this->common->upload_image($image_data, 2, $path);

            $update_data['featured_image'] = $image;

            $update_data['featured_imageurl'] = $file_path_image . $image;
        }


        $this->common->update_table('services', $update_data, $id);
        $adff = $this->db->affected_rows();
        $bb = str_replace(' ', '-', strtolower($this->input->post('name')));
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
        if($adff == 0){
            $this->session->set_flashdata('warning', 'You have made no changes.');
        redirect("edit-service/$id");
        }else{
        $this->session->set_flashdata('success', 'Service updated successfully.');
        redirect("edit-service/$id");
        }
    }else{
        $this->session->set_flashdata('error', 'Something went wrong');
        redirect("edit-service/$id");
    }
    }
    public function editservice($id) {
        $data['page_name'] = 'service List';
        $data['edit_details'] = $this->common->view('services', $id);
      
          $data['servicecategory_list'] = $this->common->subcat('servicesubcategoory');
        $this->index->activity_log('Service Edit');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Services/edit_service';

        $this->load->view('admin_template', $data);
    }

    public function delete_service() {

        $id = $this->input->post('id');
        $this->index->activity_log('Service Delete');
        $this->common->delete_table('services', $id);
        $array = array(
            'success' => 'Services deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_service() {
        $id = $this->input->post('id');
        $this->index->activity_log('Service Status');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('services', $delete_data, $id);
        $array = array(
            'success' => 'Service status updated successfully.'
        );
        echo json_encode($array);
    }

    public function featured_service() {
        $id = $this->input->post('id');
        $this->index->activity_log('Service Featured');
        $delete_data = array(
            'featured' => $this->input->post('status'),
        );
        $this->common->update_table('services', $delete_data, $id);
        $array = array(
            'success' => 'Service featured status updated successfully.'
        );
        echo json_encode($array);
    }

    public function editseo($id) {

        if ($id == 'editseo') {
        

                $id = $this->input->post('id');
                $update_data = array(
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description'),
                    'meta_keyword' => $this->input->post('meta_keyword'),
                    'alt_tag_main_img' => $this->input->post('alt_tag_main_img'),
                    'alt_tag_featured_img' => $this->input->post('alt_tag_featured_img'),
                    'schemap' => $this->input->post('schemap'),
                    'urlr' => $this->input->post('urlr')
                );
               

                $bb = str_replace(' ', '-', strtolower($this->input->post('urlr')));
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
                $this->common->update_table('services', $update_data, $id);
                if($this->db->affected_rows() == 0){
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
            $data['page_name'] = 'service List';
            $this->index->activity_log('Service Seo');
            $data['edit_details'] = $this->common->view('services', $id);
            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
            $data['user_detail'] = $this->common->view1();

            $data['content_view'] = 'Services/seo';
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
            $abc = $this->common->deleteAll($checkbox, 'services');

            $array = array(
                'success' => 'Selected Services deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Services',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'services');

            $array = array(
                'success' => 'Selected Services activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Services',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'services');

            $array = array(
                'success' => 'Selected Services deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Services',
            );
        }
        echo json_encode($array);
    }

    //category
    public function deleteAllc() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'servicecategory');
            $abc = $this->common->deleteAllcat($checkbox, 'servicesubcategoory');
            $abc = $this->common->deleteAllcat($checkbox, 'services');

            $array = array(
                'success' => 'Selected Service Category deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Service Category',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'servicecategory');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'servicesubcategoory');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'services');

            $array = array(
                'success' => 'Selected Service Category activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Service Category',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'servicecategory');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'servicesubcategoory');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'services');

            $array = array(
                'success' => 'Selected Services Category deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Service Category',
            );
        }
        echo json_encode($array);
    }

    //subcat


    public function deleteAllsersubcat() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'servicesubcategoory');

            $abc = $this->common->deleteAllcat($checkbox, 'services');

            $array = array(
                'success' => 'Selected Service Category and Sub Category deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Service Category and Sub Category',
            );
        }
        echo json_encode($array);
    }

    public function statusallsersubcat() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }

            $delete_data = array(
                'status' => 1,
            );
            $abc = $this->common->statusall($checkbox, $delete_data, 'servicesubcategoory');
            $this->common->statusall12($checkbox, $delete_data, 'services');

            $array = array(
                'success' => 'Selected Service Category and Sub Category activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Service Category and Sub Category',
            );
        }
        echo json_encode($array);
    }

    public function statusalldesersubcat() {
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'servicesubcategoory');
            $this->common->statusall12($checkbox, $delete_data, 'services');

            $array = array(
                'success' => 'Selected Service Category and Sub Category deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Service Category and Sub Category',
            );
        }
        echo json_encode($array);
    }
    
    
}
