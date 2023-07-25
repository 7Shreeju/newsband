<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

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
        $data['page_name'] = 'Product Category List';
        $this->index->activity_log('Product Category List');
        $data['category_list'] = $this->common->list('tbl_category');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Product/category_list';
        $this->load->view('admin_template', $data);
    }

    public function addproductcategory() {
        $this->index->activity_log('Add Product Category');
        $data['page_name'] = 'Add Product Category';
        $data['content_view'] = 'Product/addcat';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $this->load->view('admin_template', $data);
    }

    public function get_sub_category() {
        $category_id = $this->input->post('id', TRUE);
        $data = $this->common->get_sub_category($category_id)->result();
        echo json_encode($data);
    }

    public function add_category() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|is_unique[tbl_category.category_name]', array('is_unique' => 'This %s already exists.'));

        if ($this->form_validation->run()) {
            $insert_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => $this->common->cleanStr($this->input->post('category_name')),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );

            $id = $this->common->insert_table('tbl_category', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'Product Category added successfully.'
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

    public function fetch_category() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'tbl_category');
            echo json_encode($data);
        }
    }

    function check_order_no($order_no) {
        if ($this->input->post('id'))
            $id = $this->input->post('id');
        else
            $id = '';
        $result = $this->common->check_unique_order_no($order_no, 'tbl_category', 'category_name',$id);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('check_order_no', 'Category Name  already exist');
            $response = false;
        }
        return $response;
    }

    public function edit_category() {
        $this->index->activity_log('Edit Product Category');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|callback_check_order_no');

        if ($this->form_validation->run()) {
            $id = $this->input->post('id');
            $update_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => $this->common->cleanStr($this->input->post('category_name')),
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
              
            $q = $this->db->get_where('tbl_category', array('id' => $id))->row();

            if ($this->input->post('category_name') == $q->category_name) {
                $array = array(
                    'warning' => 'You have made no changes.'
                );
            }else{
                $this->common->update_table('tbl_category', $update_data, $id);
           
                $array = array(
                    'success' => 'Product Category updated successfully.'
                );
            }
              
        } else {
            $array = array(
                'error' => true,
                'categorynameedit_error' => form_error('category_name')
            );
        }
        echo json_encode($array);
    }

    public function delete_category() {
        $id = $this->input->post('id');
        $this->index->activity_log('Delete Product Category');
        $this->common->delete_table('tbl_category', $id);
        $this->common->delete_table1('product', 'category_id', $id);
        $this->common->delete_table1('tbl_subcategory', 'category_id', $id);

        $array = array(
            'success' => 'Product Category deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_category() {
        $this->index->activity_log('Status Product Category');
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('tbl_category', $delete_data, $id);
        $this->common->update_table1('product', $delete_data, 'category_id', $id);
        $this->common->update_table1('tbl_subcategory', $delete_data, 'category_id', $id);

        $array = array(
            'success' => 'Product Category status updated successfully.'
        );
        echo json_encode($array);
    }

    public function subcategory_list() {
        $data['page_name'] = 'Product SubCategory List';
        $this->index->activity_log('Product SubCategory List');
        $data['subcategory_list'] = $this->common->list('tbl_subcategory');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

         $data['category_list'] = $this->common->subcat('tbl_subcategory');
        $data['content_view'] = 'Product/subcategory_list';
        $this->load->view('admin_template', $data);
    }

    public function addproductsubcategory() {
        $data['page_name'] = 'Add SubCategory List';
        $this->index->activity_log('Add SubCategory List');
        $data['content_view'] = 'Product/addsubcat';
        $data['category_list'] = $this->common->subcat('tbl_subcategory');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $this->load->view('admin_template', $data);
    }

    public function add_subcategory() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_id', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('subcategory', 'Subcategory Name', 'trim|required|is_unique[tbl_subcategory.subcategory]', array('is_unique' => 'This %s already exists.'));

        if ($this->form_validation->run()) {
            if($this->input->post('category_id')=='0'){
               $insert_data = array(
               
                'category_id' => $this->input->post('category_id'),
               'subcategory' => $this->input->post('subcategory'),
                'url' => $this->common->cleanStr($this->input->post('subcategory')),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
               $id = $this->common->insert_table('tbl_subcategory', $insert_data);
               $array = array(
                    'success' => 'Product Category added successfully.'
                );

            }else{
            $insert_data = array(
                'category_id' => $this->input->post('category_id'),
                'subcategory' => $this->input->post('subcategory'),
                'url' => $this->common->cleanStr($this->input->post('subcategory')),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
           
            $id = $this->common->insert_table('tbl_subcategory', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'Product Sub Category added successfully.'
                );
            }
            }
            
        } else {
            $array = array(
                'error' => true,
                'categorypro_error' => form_error('category_id'),
                'subcategory_error' => form_error('subcategory')
            );
        }
        echo json_encode($array);
    }

    public function fetch_subcategory() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'tbl_subcategory');
            echo json_encode($data);
        }
    }

    function check_order_no1($order_no) {
        if ($this->input->post('id'))
            $id = $this->input->post('id');
        else
            $id = '';
        $result = $this->common->check_unique_order_no( $order_no, 'tbl_subcategory', 'subcategory',$id);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('check_order_no1', 'This SubCategory Name already exist');
            $response = false;
        }
        return $response;
    }

    public function edit_subcategory() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_id', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('subcategory', 'Subcategory Name', 'trim|required|callback_check_order_no1');

        if ($this->form_validation->run()) {
            
            $id = $this->input->post('id');
            if($this->input->post('category_id')=='0'){
             $update_data = array(
                'category_id' => $this->input->post('category_id'),
                'subcategory' => $this->input->post('subcategory'),
                'url' => $this->common->cleanStr($this->input->post('subcategory')),
               
            );   
             $this->common->update_table('tbl_subcategory', $update_data, $id);
              if ($this->db->affected_rows() == 0) {
                $array = array(
                    'warning' => 'You have made no changes.'
                );
            }else{
                 $update_data['createdBy'] = $this->session->userdata('user_id');
                $update_data['createdDate'] = DATE;
                $this->common->update_table('tbl_subcategory', $update_data, $id);
                   $array = array(
                   'success' => 'Product Category updated successfully.'
            );
            }
            
            }else{
                $update_data = array(
                'category_id' => $this->input->post('category_id'),
                'subcategory' => $this->input->post('subcategory'),
                'url' => $this->common->cleanStr($this->input->post('subcategory')),
                
            ); 
              $this->common->update_table('tbl_subcategory', $update_data, $id);
             if ($this->db->affected_rows() == 0) {
                $array = array(
                    'warning' => 'You have made no changes.'
                );
            }else{
                 $update_data['createdBy'] = $this->session->userdata('user_id');
                $update_data['createdDate'] = DATE;
                $this->common->update_table('tbl_subcategory', $update_data, $id);
                   $array = array(
                   'success' => 'Product Sub Category updated successfully.'
            );
            }
            }

            
            
           
        } else {
            $array = array(
                'error' => true,
                'categoryproedit_error' => form_error('category_id'),
                'subcategorycat_error' => form_error('subcategory')
            );
        }
        echo json_encode($array);
    }

    public function editproductseo($id) {

        if ($id == 'editproductseo') {
          
            

                $id = $this->input->post('id');
                $update_data = array(
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description'),
                    'meta_keyword' => $this->input->post('meta_keyword'),
                    'alt_tag_main_img' => $this->input->post('alt_tag_main_img'),
                    'alt_tag_featured_img' => $this->input->post('alt_tag_featured_img'),
                    'schemap' => $this->input->post('schemap'),
                    'con_url' => $this->input->post('con_url')
                );
                $this->common->update_table('product', $update_data, $id);
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
            $data['page_name'] = 'Product List';
            $data['edit_details'] = $this->common->view('product', $id);
            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
            $data['user_detail'] = $this->common->view1();
            $this->index->activity_log('Product Seo');
            $data['content_view'] = 'Product/seo';
            $this->load->view('admin_template', $data);
        }
    }

    public function delete_subcategory() {
        $this->index->activity_log('Product Sub category Delete');
        $id = $this->input->post('id');
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->from('tbl_subcategory');
        $query= $this->db->get();
        $row= $query->row();
        if($row->category_id == '0'){
        $this->common->delete_table('tbl_subcategory', $id);
        $this->common->delete_table1('tbl_subcategory', 'category_id', $id);
        $this->common->delete_table1('product', 'category_id', $id); 
        }else{
        $this->common->delete_table('tbl_subcategory', $id); 
           $this->common->delete_table1('product', 'category_id', $id);
        }
        $array = array(
            'success' => 'Product Category and Sub Category  Deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_subcategory() {
        $id = $this->input->post('id');
        $this->index->activity_log('Product Sub category status');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('tbl_subcategory', $delete_data, $id);
        $this->common->update_table1('product', $delete_data, 'category_id', $id);

        $array = array(
            'success' => 'Product Category and Sub Category status updated successfully.'
        );
        echo json_encode($array);
    }

    public function addproduct() {
        $data['page_name'] = 'Add E-Paper';
        $this->index->activity_log('Add E-Paper');
        $data['category_list'] = $this->common->subcat('tbl_subcategory');

        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Product/add_product';
        $this->load->view('admin_template', $data);
    }

    public function product_list() {
        $data['page_name'] = 'E-Paper List';
        $this->index->activity_log('E-Paper List');
        $data['product_list'] = $this->common->list('product');
         $data['category_list'] = $this->common->subcat('tbl_subcategory');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Product/product_list';
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
                $allowed_extension = array("jpg","jpeg","gif", "png", "webp");
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

    public function insert_product() {

        $this->form_validation->set_error_delimiters('', '');

       
        $this->form_validation->set_rules('name', ' Name', 'trim|required');
       
        

        if (empty($_FILES['featured_image']['name'])) {
            $this->form_validation->set_rules('featured_image', 'Image', 'required');
        }
       


        if ($this->form_validation->run()) {
        $insert_data = array(
           
            'name' => $this->input->post('name'),
             'date' => $this->input->post('date'),
            'url' => $this->common->cleanStr($this->input->post('name')), 
            'con_url' => $this->input->post('name'),
            
            'status' => '1',
            'createdDate' => DATE
        );

        $extensionResume = array("jpg", "jpeg", "JPG", "JPEG","png","PNG", "webp");
       

        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['name'] != "") {
            $extId = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
            $errors = array();
            $maxsize = 1000;
            $maxsize1 = 500;
            if (!in_array($extId, $extensionResume) && (!empty($_FILES["featured_image"]["type"]))) {
                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
            }
            if (($_FILES['featured_image']['size'] >= $maxsize) && ($_FILES["featured_image"]["size"] == $maxsize1)) {
                $this->session->set_flashdata('error', 'Image Size Too Large');
            }

            $image_data = $_FILES['featured_image'];
            $path = './uploads/product/';
            $file_path_image = base_url() . 'uploads/product/';
            $image = $this->common->upload_image($image_data, 2, $path);

            $insert_data['featured_image'] = $image;
            $insert_data['featured_imageurl'] = $file_path_image . $image;
        }
        $extensionResume1 = array("pdf");

        if (isset($_FILES['pdf']) && $_FILES['pdf']['name'] != "") {
            $extId = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);
            $errors = array();
//            $maxsize = 26214400;
            $maxsize = 1000;
            $maxsize1 = 500;
            if (!in_array($extId, $extensionResume1) && (!empty($_FILES["pdf"]["type"]))) {
                $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
            }
            if (($_FILES['pdf']['size'] == $maxsize) || ($_FILES["pdf"]["size"] == 0)) {
                $this->session->set_flashdata('error', 'Image Size Too Large');
            }

            $image_data = $_FILES['pdf'];
            $path = './uploads/product/';
            $file_path_image = base_url() . 'uploads/product/';
            $image = $this->common->upload_image($image_data, 2, $path);

            $insert_data['pdf'] = $image;
            $insert_data['pdf_url'] = $file_path_image . $image;
        }

        $id = $this->common->insert_table('product', $insert_data);

        $lid = $this->db->insert_id();
        $url = array(
            'column_id' => $lid,
            'type' => 'product',
            'old_url' => str_replace(' ', '-', strtolower($this->input->post('name'))),
            'new_url' => str_replace(' ', '-', strtolower($this->input->post('name'))),
        );
        $this->common->insert_table('url_redirections', $url);
        if ($id == true) {
            $this->session->set_flashdata('success', 'E-Paper added successfully !!!!! ');
        }

        redirect("add-product");
        // }
    }else{
        $this->session->set_flashdata('Error', 'Something went wrong ');
        redirect("add-product");
    }
}

    public function myformAjax($id) {
        $this->db->where("category_id", $id);
        $this->db->where('status', '1');
        $result = $this->db->get("tbl_subcategory")->result();

        echo json_encode($result);
    }

    public function editproduct($id) {

        $data['page_name'] = 'E-Paper List';
        $this->index->activity_log('E-Paper Edit');
        $data['edit_details'] = $this->common->view('product', $id);
            $data['category_list'] = $this->common->subcat('tbl_subcategory');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Product/edit_product';

        $this->load->view('admin_template', $data);
    }

    public function editproduct1() {
        $this->form_validation->set_error_delimiters('', '');

        
        $this->form_validation->set_rules('name', ' Name', 'trim|required');
       
        

       


        if ($this->form_validation->run()) {

        $id = $this->input->post('id');

     
        $update_data['name'] = $this->input->post('name');
          $update_data['date'] = $this->input->post('date');
        $update_data['url'] = $this->common->cleanStr($this->input->post('name'));

      
        $update_data['createdBy'] = $this->session->userdata('user_id');
        $update_data['createdDate']= DATE;
        // 
        $update_data['status'] = '1';

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
            $path = './uploads/product/';
            $file_path_image = base_url() . 'uploads/product/';
            $fimage = $this->common->upload_image($image_data, 2, $path);

            $update_data['featured_image'] = $fimage;
            $update_data['featured_imageurl'] = $file_path_image . $fimage;
        }
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
            $path = './uploads/product/';
            $file_path_image = base_url() . 'uploads/product/';
            $pdf = $this->common->upload_image($image_data, 2, $path);

            $update_data['pdf'] = $pdf;
            $update_data['pdf_url'] = $file_path_image . $pdf;
        }

        $this->common->update_table('product', $update_data, $id);
       $aff= $this->db->affected_rows();
      
    
        $bb = str_replace(' ', '-', strtolower($this->input->post('blogtitle')));
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
       
        if($aff == 0){
            $this->session->set_flashdata('warning', 'You have made no changes');
        
            redirect("edit-product/" . $id);
        }else{
            $update_data['createdDate'] = DATE;
            $this->common->update_table('product', $update_data, $id);
            $this->session->set_flashdata('success', 'E-Paper Updated successfully ');
            redirect("edit-product/" . $id);
        }
        
           
    }else{
        $this->session->set_flashdata('Error', 'Something went wrong ');
        redirect("edit-product/" . $id);
    }
    }

    function isAlreadyExit() {
        $mobile = trim($this->input->get('category_name'));
        $result = $this->common->isExit($mobile,'category_name','tbl_category');
        if ($result) {
            echo $msg = "false";
        } else {
            echo $msg = "true";
        }
    }

    function isAlreadyExitEdit() {
        $id = $this->uri->segment(2);

        $mobile = trim($this->input->get('category_name'));

        $result = $this->common->isExitEdit($mobile, $id,'category_name','tbl_category');
        if ($result) {
            echo $msg = "false";
        } else {
            echo $msg = "true";
        }
    }

   

    public function status_product() {
        $id = $this->input->post('id');
        $this->index->activity_log('Product Status');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('product', $delete_data, $id);

        $array = array(
            'success' => 'E-Paper status Updated successfully.'
        );
       
        echo json_encode($array);
    }

    public function delete_product() {
        $id = $this->input->post('id');

        $this->common->delete_table('product', $id);
        $array = array(
            'success' => 'E-Paper deleted successfully.'
        );
        echo json_encode($array);
    }

    public function featured() {
        $id = $this->input->post('id');
        $this->index->activity_log('Product Featured');
        $delete_data = array(
            'featured' => $this->input->post('status'),
        );
        $this->common->update_table('product', $delete_data, $id);

        $array = array(
            'success' => 'E-Paper featured status updated successfully.'
        );
        // $this->db->select('*');
        // $this->db->where('id',$id);
        // $this->db->from('product');
        // $query= $this->db->get();
        // $row = $query->row();
        // $array = array(
        //     'status' => $row->featured,
        // );
        echo json_encode($array);
    }

    public function deleteAll() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'product');

            $array = array(
                'success' => 'Selected E-Paper deleted successfully',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one E-Paper ',
            );
        }
        echo json_encode($array);
    }

    public function deleteAllprocat() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'tbl_category');
            $abc = $this->common->deleteAllcat($checkbox, 'tbl_subcategory');

            $abc = $this->common->deleteAllcat($checkbox, 'product');

            $array = array(
                'success' => 'Selected E-Paper Category deleted successfully',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one E-Paper Category',
            );
        }
        echo json_encode($array);
    }

    public function statusallprocat() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }

            $delete_data = array(
                'status' => 1,
            );
            $abc = $this->common->statusall($checkbox, $delete_data, 'tbl_category');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'tbl_subcategory');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'product');

            $array = array(
                'success' => 'Selected E-Paper Category activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one E-Paper Category',
            );
        }
        echo json_encode($array);
    }

    public function statusalldeprocat() {
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'tbl_category');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'tbl_subcategory');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'product');

            $array = array(
                'success' => 'Selected E-Paper Category deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one E-Paper Category',
            );
        }
        echo json_encode($array);
    }

    
    //subcat
    
    
     public function deleteAllprosubcat() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'tbl_subcategory');
                 
            $abc = $this->common->deleteAllcat($checkbox, 'blog');

            $array = array(
                'success' => 'Selected E-Paper Category and Sub Category deleted successfully',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one E-Paper Category and Sub Category',
            );
        }
        echo json_encode($array);
    }

    public function statusallprosubcat() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }

            $delete_data = array(
                'status' => 1,
            );
            $abc = $this->common->statusall($checkbox, $delete_data, 'tbl_subcategory');
           $this->common->statusall12($checkbox, $delete_data, 'blog');
            // $abc = $this->common->statusall1($checkbox, $delete_data, 'product');

            $array = array(
                'success' => 'Selected E-Paper Category and Sub Category deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one E-Paper Category and Sub Category',
            );
        }
        echo json_encode($array);
    }

    public function statusalldeprosubcat() {
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'tbl_subcategory');
            $this->common->statusall12($checkbox, $delete_data, 'blog');

            $array = array(
                'success' => 'Selected E-Paper Category and Sub Category activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one E-Paper Category and Sub Category',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'product');

            $array = array(
                'success' => 'Selected E-Paper activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one E-Paper',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'product');

            $array = array(
                'success' => 'Selected E-Paper deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one E-Paper',
            );
        }
        echo json_encode($array);
    }
     
   
}
