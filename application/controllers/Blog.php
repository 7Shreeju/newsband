<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'login');
        $this->load->model('Common_model', 'common');
        $this->load->model('Profile_model', 'pro');
        $this->load->model('Index_model', 'index');
        $this->login->is_logged_in();
        $this->index->activity_update();
    }

    public function author() {
        $data['page_name'] = 'Add Author';
        $data['user_detail'] = $this->common->view1();
        $data['author_list'] = $this->common->list('author');
        $data['content_view'] = 'Blog/add_author';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));

        $this->load->view('admin_template', $data);
    }
      public function comments() {
        $data['page_name'] = 'Comments List';
        $data['user_detail'] = $this->common->view1();
        $data['list'] = $this->common->list('comments');
        $data['content_view'] = 'Blog/comment_list';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));

        $this->load->view('admin_template', $data);
    }
     

    public function add_author() {

        $this->form_validation->set_error_delimiters('', '');

       

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
      

        if ($this->form_validation->run()) {
            $insert_data = array(
                'name' => $this->input->post('name'),
                'shortinfo' => $this->input->post('shortinfo'),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
            $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "png");

            if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                $extId = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $errors = array();
                $maxsize = 26214400;
                if (!in_array($extId, $extensionResume) && (!empty($_FILES["image"]["type"]))) {
                    $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
                }
                if (($_FILES['image']['size'] >= $maxsize) || ($_FILES["image"]["size"] == 0)) {
                    $this->session->set_flashdata('error', 'Image Size Too Large');
                }

                $image_data = $_FILES['image'];
                $path = './uploads/blog_main_img/';
                $file_path_image = base_url() . 'uploads/blog_main_img/';
                $image = $this->common->upload_image($image_data, 1, $path);
                $insert_data['image'] = $image;
                $insert_data['image_url'] = $file_path_image . $image;
            }
            $id = $this->common->insert_table('author', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'Author data Added successfully.'
                );
            }
        } else {
            $array = array(
                'error' => true,
                'name_error' => form_error('name'),
              
            );
        }
        echo json_encode($array);
    }

    public function author_list() {
        $data['page_name'] = 'Author List';
        $data['author_list'] = $this->common->list('author');
        $data['user_detail'] = $this->common->view1();
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['content_view'] = 'Blog/author_list';
        $this->load->view('admin_template', $data);
    }

    public function edit_author($id) {
        if ($id == 'editauthor') {
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('name', 'Name', 'trim|required');

          

            if ($this->form_validation->run()) {
                $id = $this->input->post('id');
                $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "png");

                if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                    $extId = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $errors = array();
                    $maxsize = 26214400;
                    if (!in_array($extId, $extensionResume) && (!empty($_FILES["image"]["type"]))) {
                        $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
                    }
                    if (($_FILES['image']['size'] >= $maxsize) || ($_FILES["image"]["size"] == 0)) {
                        $this->session->set_flashdata('error', 'Image Size Too Large');
                    }

                    $image_data = $_FILES['image'];
                    $path = './uploads/blog_main_img/';
                    $file_path_image = base_url() . 'uploads/blog_main_img/';
                    $image = $this->common->upload_image($image_data, 1, $path);
                    $update_data['image'] = $image;
                    $update_data['image_url'] = $file_path_image . $image;
                }
  $update_data['name'] = $this->input->post('name');
                $update_data['shortinfo'] = $this->input->post('shortinfo');
                $this->common->update_table('author', $update_data, $id);
                $array = array(
                    'success' => 'Author data Updated successfully.'
                );
            } else {
                $array = array(
                    'error' => true,
                    'nameauthor_error' => form_error('name'),
                  
                );
            }
            echo json_encode($array);
        } else {
            $data['page_name'] = 'Author List';
            $data['edit_details'] = $this->common->view('author', $id);
            $data['user_detail'] = $this->common->view1();

            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
            $data['content_view'] = 'Blog/edit_author';

            $this->load->view('admin_template', $data);
        }
    }

    public function delete_author() {

        $id = $this->input->post('id');

        $this->common->delete_table('author', $id);
        $this->common->delete_table1('blog', 'author_id', $id);

        $array = array(
            'success' => 'Author data Deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_author() {
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('author', $delete_data, $id);
        $this->common->update_table1('blog', $delete_data, 'author_id', $id);

        $array = array(
            'success' => 'Author status data Updated successfully.'
        );
        echo json_encode($array);
    }

    public function index() {
        $data['page_name'] = 'Article Category List';
        $this->index->activity_log('Article Category List');
        $data['blogcategory_list'] = $this->common->list('blogcategory');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Blog/blogcategory_list';
        $this->load->view('admin_template', $data);
    }

    //blog category

    public function blogcategory_list() {
        $data['page_name'] = 'Article Category List';
        $this->index->activity_log('Article Category List');
        $data['blogcategory_list'] = $this->common->list('blogcategory');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Blog/blogcategory_list';
        $this->load->view('admin_template', $data);
    }

    public function add_blogcategory() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'blog category Name', 'trim|required|is_unique[blogcategory.category_name]', array('is_unique' => 'This %s already exists.'));
        if ($this->form_validation->run()) {
            $insert_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
            $id = $this->common->insert_table('blogcategory', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'Article Category added successfully.'
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

    public function fetch_blogcategory() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'blogcategory');
            echo json_encode($data);
        }
    }

    function check_order_no($order_no) {
        if ($this->input->post('id'))
            $id = $this->input->post('id');
        else
            $id = '';
        $result = $this->common->check_unique_order_no($order_no, 'blogcategory', 'category_name', $id);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('check_order_no', 'Category Name  already exist');
            $response = false;
        }
        return $response;
    }

    public function edit_blogcategory() {
        $id = $this->input->post('id');
        $this->index->activity_log('Edit Article Category');

        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_name', 'category Name', 'required|callback_check_order_no');

        if ($this->form_validation->run()) {
            $id = $this->input->post('id');
            $update_data = array(
                'category_name' => $this->input->post('category_name'),
                'url' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
                    // 'createdDate' => DATE
            );
            $this->common->update_table('blogcategory', $update_data, $id);
            if ($this->db->affected_rows() == 0) {

                $array = array(
                    'warning' => 'You have made no changes.'
                );
            } else {
                $update_data['createdDate'] = DATE;
                $this->common->update_table('blogcategory', $update_data, $id);
                $array = array(
                    'success' => 'Article Category updated successfully.'
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

    public function delete_blogcategory() {

        $this->index->activity_log('Article Category Delete');
        $id = $this->input->post('id');

        $this->common->delete_table('blogcategory', $id);
        $this->common->delete_table1('blog', 'category_id', $id);
        $this->common->delete_table1('tbl_subcategory', 'category_id', $id);
        
        $array = array(
            'success' => 'Article Category deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_blogcategory() {
        $this->index->activity_log('Article Category status');
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('blogcategory', $delete_data, $id);
        $this->common->update_table1('blog', $delete_data, 'category_id', $id);
         $this->common->update_table1('tbl_subcategory',$delete_data, 'subcategory_id', $id);
        $array = array(
            'success' => 'Article Category status updated successfully.'
        );
        echo json_encode($array);
    }

     public function subcategory_list() {
        $data['page_name'] = 'Article SubCategory List';
        $this->index->activity_log('Article SubCategory List');
        $data['subcategory_list'] = $this->common->list('tbl_subcategory');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['category_list'] = $this->common->list2('blogcategory');
        $data['content_view'] = 'Blog/subcat';
        $this->load->view('admin_template', $data);
    }


    public function add_subcategory() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category_id', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('subcategory', 'Subcategory Name', 'trim|required|is_unique[tbl_subcategory.subcategory]', array('is_unique' => 'This %s already exists.'));

        if ($this->form_validation->run()) {
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
                    'success' => 'Article Sub Category Data Added successfully.'
                );
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
        $result = $this->common->check_unique_order_no( $order_no, 'tbl_subcategory','subcategory',$id);
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
            $update_data = array(
                'category_id' => $this->input->post('category_id'),
                'subcategory' => $this->input->post('subcategory'),
                'url' => $this->common->cleanStr($this->input->post('subcategory')),
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );

                $this->common->update_table('tbl_subcategory', $update_data, $id);
            $array = array(
                   'success' => 'Article Sub Category Data Updated successfully.'
            );
           
           
        } else {
            $array = array(
                'error' => true,
                'categoryproedit_error' => form_error('category_id'),
                'subcategorycat_error' => form_error('subcategory')
            );
        }
        echo json_encode($array);
    }
    public function delete_subcategory() {
        $id = $this->input->post('id');
        $this->index->activity_log('Blog Sub category Delete');
        $this->common->delete_table('tbl_subcategory', $id);
        $this->common->delete_table1('Blog', 'subcategory_id', $id);

        $array = array(
            'success' => 'Article Sub Category Data Deleted successfully.'
        );
        echo json_encode($array);
    }

        public function getCityDepartment() {
        // POST data 
        $postData = $this->input->post();

        // load model 
        // get data 
//        $data = $this->product->getCityDepartment($postData);
        $data = $this->common->getSubcategoryDependency($postData,'id,subcategory','category_id','tbl_subcategory');


        echo json_encode($data);
    }
    public function status_subcategory() {
        $id = $this->input->post('id');
        $this->index->activity_log('Article Sub category status');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('tbl_subcategory', $delete_data, $id);
        $this->common->update_table1('Blog', $delete_data, 'subcategory_id', $id);

        $array = array(
            'success' => 'Article Sub Category status Updated successfully.'
        );
        echo json_encode($array);
    }
    // Blog Functionality

    public function addblog() {
        $data['page_name'] = 'Add Article';
        $this->index->activity_log('Add Article');
        $data['blog_list'] = $this->common->list('blog');
        $data['blogcategory_list'] = $this->common->list1('blogcategory', 'status', '1');
         $data['auth'] = $this->common->list1('author', 'status', '1');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Blog/addblog';
        $this->load->view('admin_template', $data);
    }

    public function blog_list() {
        $data['page_name'] = 'Article List';
        $this->index->activity_log('Article list');
        $data['blog_list'] = $this->common->list('blog');
        $data['blogcategory_list'] = $this->common->list('blogcategory');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Blog/blog_list';
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
    public function insert_blog() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('blogtitle', 'blogtitle', 'trim|required');
        $this->form_validation->set_rules('shortdescription', 'shortdescription', 'trim|required');
        $this->form_validation->set_rules('author_id', 'author_id', 'trim|required');
        $this->form_validation->set_rules('date', 'date', 'trim|required');

        if ($this->form_validation->run()) {
            $insert_data = array(
                'category_id' => $this->input->post('category'),
                'subcategory_id' => $this->input->post('subcategory_id'),
                'title' => $this->input->post('blogtitle'),
                'blog_url' => $this->common->cleanStr($this->input->post('blogtitle')),
                'date' => $this->input->post('date'),
                'author_id' => $this->input->post('author_id'),
                'shortdescription' => $this->input->post('shortdescription'),
                'description' => $this->input->post('description'),
                'status' => '1', 
                'availability'=>$this->input->post('availability'),
                'url' => $this->common->cleanStr($this->input->post('blogtitle')),
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );

            $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");

            if (isset($_FILES['main_image']) && $_FILES['main_image']['name'] != "") {
                $extId = pathinfo($_FILES['main_image']['name'], PATHINFO_EXTENSION);
                $errors = array();
                $maxsize = 26214400;
                if (!in_array($extId, $extensionResume) && (!empty($_FILES["main_image"]["type"]))) {
                    $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
                }
                if (($_FILES['main_image']['size'] >= $maxsize) || ($_FILES["main_image"]["size"] == 0)) {
                    $this->session->set_flashdata('error', 'Image Size Too Large');
                }

                $image_data = $_FILES['main_image'];
                $path = './uploads/blog_main_img/';
                $file_path_image = base_url() . 'uploads/blog_main_img/';
                $image = $this->common->upload_image($image_data, 1, $path);
                $insert_data['main_image'] = $image;
                $insert_data['main_imageurl'] = $file_path_image . $image;
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
                $path = './uploads/blog_feature_img/';
                $file_path_image = base_url() . 'uploads/blog_feature_img/';
                $image = $this->common->upload_image($image_data, 2, $path);
                $insert_data['featured_image'] = $image;
                $insert_data['featured_imageurl'] = $file_path_image . $image;
            }


//insert data into database table.  
            $id = $this->common->insert_table('blog', $insert_data);

            $lid = $this->db->insert_id();
            $url = array(
                'column_id' => $lid,
                'type' => 'blog',
                'old_url' => '',
                'new_url' => str_replace(' ', '-', strtolower($this->input->post('blogtitle'))),
            );
            $this->common->insert_table('url_redirections', $url);
            if ($id) {
                $this->session->set_flashdata('success', 'Article added successfully.');
                redirect("add-article");
            }
        } else {
            $this->session->set_flashdata('error', 'Something went wrong ');
            redirect("add-article");
        }
    }

    public function edit_blog($id) {

        $data['page_name'] = 'Article List';
        $this->index->activity_log('Edit Article ');
        $data['edit_details'] = $this->common->view('blog', $id);
        $data['blogcategory_list'] = $this->common->list1('blogcategory', 'status', '1');
        $data['subcategory_list'] = $this->common->list1('tbl_subcategory', 'status', '1');
           $data['auth'] = $this->common->list1('author', 'status', '1');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Blog/editblog';
        $this->load->view('admin_template', $data);
    }

    public function editblog() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('blogtitle', 'blogtitle', 'trim|required');
        $this->form_validation->set_rules('shortdescription', 'shortdescription', 'trim|required');
        $this->form_validation->set_rules('author_id', 'author_id', 'trim|required');
        $this->form_validation->set_rules('date', 'date', 'trim|required');

        if ($this->form_validation->run()) {
            $id = $this->input->post('id');

            $update_data = array(
                'category_id' => $this->input->post('category'),
                'subcategory_id' => $this->input->post('subcategory_id'),
                'author_id' => $this->input->post('author_id'),
                'title' => $this->input->post('blogtitle'),
                'blog_url' => $this->common->cleanStr($this->input->post('blogtitle')),
                'url' => $this->common->cleanStr($this->input->post('blogtitle')),
                'date' => $this->input->post('date'),
                'shortdescription' => $this->input->post('shortdescription'),
                'description' => $this->input->post('description'),
                 'availability'=>$this->input->post('availability'),
            );

            $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");

            if (isset($_FILES['main_image']) && $_FILES['main_image']['name'] != "") {
                $extId = pathinfo($_FILES['main_image']['name'], PATHINFO_EXTENSION);
                $errors = array();
                $maxsize = 26214400;
                if (!in_array($extId, $extensionResume) && (!empty($_FILES["pic"]["type"]))) {
                    $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
                }
                if (($_FILES['main_image']['size'] >= $maxsize) || ($_FILES["main_image"]["size"] == 0)) {
                    $this->session->set_flashdata('error', 'Image Size Too Large');
                }

                $image_data = $_FILES['main_image'];
                $path = './uploads/blog_main_img/';
                $file_path_image = base_url() . 'uploads/blog_main_img/';
                $image = $this->common->upload_image($image_data, 1, $path);

                $update_data['main_image'] = $image;
                $update_data['main_imageurl'] = $file_path_image . $image;
            }

            if (isset($_FILES['featured_image']) && $_FILES['featured_image']['name'] != "") {
                $extId1 = pathinfo($_FILES['featured_image1']['name'], PATHINFO_EXTENSION);
                $errors = array();
                $maxsize = 26214400;
                if (!in_array($extId1, $extensionResume) && (!empty($_FILES["pic"]["type"]))) {
                    $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
                }
                if (($_FILES['featured_image']['size'] >= $maxsize) || ($_FILES["featured_image"]["size"] == 0)) {
                    $this->session->set_flashdata('error', 'Image Size Too Large');
                }

                $image_data = $_FILES['featured_image'];
                $path = './uploads/blog_feature_img/';
                $file_path_image = base_url() . 'uploads/blog_feature_img/';
                $image = $this->common->upload_image($image_data, 2, $path);

                $update_data['featured_image'] = $image;

                $update_data['featured_imageurl'] = $file_path_image . $image;
            }
            // print_r($update_data);
            $this->common->update_table('blog', $update_data, $id);
            echo $adf = $this->db->affected_rows();
            //   exit();
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


            if ($adf == 0) {
                $this->session->set_flashdata('warning', 'You have made no changes.');
                redirect("edit-article/" . $id);
            } else {
                $update_data['createdDate'] = DATE;
                $this->common->update_table('blog', $update_data, $id);
                $this->session->set_flashdata('success', 'Article updated successfully ');
                redirect("edit-article/" . $id);
            }
        } else {
            $this->session->set_flashdata('error', 'Something went wrong ');
            redirect("edit-article/" . $id);
        }
    }

    public function fetch_blog() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'blog');
            echo json_encode($data);
        }
    }

    public function delete_blog() {

        $this->index->activity_log('Article Delete');
        $id = $this->input->post('id');

        $this->common->delete_table('blog', $id);
        $array = array(
            'success' => 'Article data deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_blog() {
        $id = $this->input->post('id');
        $this->index->activity_log('Article Status');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('blog', $delete_data, $id);
        $array = array(
            'success' => 'Article status updated successfully.'
        );
        echo json_encode($array);
    }

    public function feature_blog() {
        $id = $this->input->post('id');
        $this->index->activity_log('Article feature');

        if ($this->input->post('status_id') == '1') {
            $this->db->select('*');
            $this->db->where('alt_features', '1');
            $this->db->from('blog');
            $query = $this->db->get();

            if ($query->num_rows() >= 3) {
                $array = array(
                    'error' => 'Only 3 Article can be featured.'
                );
            } else {
                $delete_data = array(
                    'alt_features' => $this->input->post('status_id'),
                );
                $this->common->update_table('blog', $delete_data, $id);

                $array = array(
                    'success' => 'Article Featured status Updated successfully.'
                );
            }
        } else {
            $delete_data = array(
                'alt_features' => $this->input->post('status_id'),
            );
            $this->common->update_table('blog', $delete_data, $id);

            $array = array(
                'success' => 'Article Featured status Updated successfully.'
            );
        }

        echo json_encode($array);
    }

    public function editseo($id) {

        if ($id == 'editseo') {


            $id = $this->input->post('id');
            $update_data = array(
                'meta_title' => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keyword' => $this->input->post('meta_keyword'),
                'url' => $this->input->post('url'),
                'alt_tag_main_img' => $this->input->post('alt_tag_main_img'),
                'alt_tag_featured_img' => $this->input->post('alt_tag_featured_img'),
                'schemap' => $this->input->post('schemap'),
            );

            $bb = str_replace(' ', '-', strtolower($this->input->post('url')));
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
            $this->common->update_table('blog', $update_data, $id);
            if ($this->db->affected_rows() == 0) {
                $array = array(
                    'error' => 'You have made no changes.'
                );
            } else {
                $array = array(
                    'success' => 'SEO data Updated successfully.'
                );
            }
            echo json_encode($array);
        } else {
            $data['page_name'] = 'Article List';
            $data['edit_details'] = $this->common->view('blog', $id);
            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
            $data['user_detail'] = $this->common->view1();
            $this->index->activity_log('Blog Seo');
            $data['content_view'] = 'Blog/seo';
            $this->load->view('admin_template', $data);
        }
    }

    public function deleteAllblogcat() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'blogcategory');

            $abc = $this->common->deleteAllcat($checkbox, 'blog');

            $array = array(
                'success' => 'Selected Article Category deleted successfully',
            );
        } else {

            $array = array(
                'error' => 'Select atleast Article Category',
            );
        }
        echo json_encode($array);
    }

    public function statusallblogcat() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }

            $delete_data = array(
                'status' => 1,
            );
            $abc = $this->common->statusall($checkbox, $delete_data, 'blogcategory');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'blog');

            $array = array(
                'success' => 'Selected Article Category activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Article Category',
            );
        }
        echo json_encode($array);
    }

    public function statusalldeblogcat() {
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'blogcategory');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'blog');

            $array = array(
                'success' => 'Selected Article Category deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Article Category',
            );
        }
        echo json_encode($array);
    }

    public function deleteAllblog() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }
            $abc = $this->common->deleteAll($checkbox, 'blog');

            $array = array(
                'success' => 'Selected Article deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Article',
            );
        }
        echo json_encode($array);
    }

    public function statusallblog() {
        if (!empty($this->input->post('checkbox_value'))) {
            $checkboxs = $this->input->post('checkbox_value');
            $checkbox = [];
            foreach ($checkboxs as $row) {

                array_push($checkbox, $row);
            }

            $delete_data = array(
                'status' => 1,
            );
            $abc = $this->common->statusall($checkbox, $delete_data, 'blog');

            $array = array(
                'success' => 'Selected Article activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Article',
            );
        }
        echo json_encode($array);
    }

    public function statusalldeblog() {
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'blog');

            $array = array(
                'success' => 'Selected Article deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Article',
            );
        }
        echo json_encode($array);
    }

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
                'success' => 'Selected Data Deleted',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one row',
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
                'success' => 'Selected Data Status changed',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one row',
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
                'success' => 'Selected Data Status changed',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one row',
            );
        }
        echo json_encode($array);
    }
    



}
