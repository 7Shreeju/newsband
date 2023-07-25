<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'login');
        $this->load->model('Common_model', 'common');
        $this->load->model('Profile_model', 'pro');
        $this->load->model('Index_model', 'index');
        $this->index->activity_update();
    }

    public function index() {

        $id = $this->session->userdata('user_id');
        $data['page_name'] = 'FAQs Category List';
        $data['faqcategory_list'] = $this->common->list('faq_category');
        $this->index->activity_log('FAQs Category List');
        $data['content_view'] = 'Faq/faqcategory_list';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $this->load->view('admin_template', $data);
    }

    //FAQ CAtegory



    public function add_faqcategory() {
        $this->index->activity_log('FAQs Category Add');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category', 'Category Name', 'trim|required|is_unique[faq_category.category]');
        if ($this->form_validation->run()) {
            $insert_data = array(
                'category' => $this->input->post('category'),
                'status' => '1',
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
            $id = $this->common->insert_table('faq_category', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'Faq Category added successfully.'
                );
            }
        } else {
            $array = array(
                'error' => true,
                'category_error' => form_error('category')
            );
        }
        echo json_encode($array);
    }

    public function fetch_faqcategory() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'faq_category');
            echo json_encode($data);
        }
    }
 function check_order_no($order_no) {
        if ($this->input->post('id'))
            $id = $this->input->post('id');
        else
            $id = '';
        $result = $this->common->check_unique_order_no( $order_no, 'faq_category', 'category',$id);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('check_order_no', 'Category Name  already exist');
            $response = false;
        }
        return $response;
    }

 

    public function edit_faqcategory() {
        $this->index->activity_log('FAQs Category Edit');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category', 'Category Name', 'trim|required|callback_check_order_no');
        if ($this->form_validation->run()) {
            $id = $this->input->post('id');
            $update_data = array(
                'category' => $this->input->post('category'),
              
              
            );
            $this->common->update_table('faq_category', $update_data, $id);
            if($this->db->affected_rows() == 0){
                $array = array(
                    'warning' => 'You have made no changes.'
                );
            }else{
                $update_data['createdDate'] = DATE;
                $update_data['createdBy'] = $this->session->userdata('user_id');
                $this->common->update_table('faq_category', $update_data, $id);
            $array = array(
                'success' => 'Faq Category updated successfully.'
            );
        }
        } else {
            $array = array(
                'error' => true,
                'faqcategory1_error' => form_error('category')
            );
        }
        echo json_encode($array);
    }

    public function status_faqcategory() {
        $id = $this->input->post('id');
        $this->index->activity_log('FAQs Category Status');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('faq_category', $delete_data, $id);
        $this->common->update_table1('faq_list', $delete_data, 'category_id', $id);

        $array = array(
            'success' => 'Faq status updated successfully.'
        );
        echo json_encode($array);
    }

    public function delete_faqcategory() {
        $id = $this->input->post('id');
        $this->index->activity_log('FAQs Category Delete');
        $this->common->delete_table('faq_category', $id);
        $this->common->delete_table1('faq_list', 'category_id', $id);

        $array = array(
            'success' => 'Faq Category deleted successfully.'
        );
        echo json_encode($array);
    }

// faq functionality

    public function addfaq() {

        $data['page_name'] = 'Add FAQs';
        $data['faqcategory_list'] = $this->common->list2('faq_category');
        $this->index->activity_log('Add FAQ');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['content_view'] = 'Faq/addfaq';
        $this->load->view('admin_template', $data);
    }

    public function faq_list() {
        $this->index->activity_log('FAQ List');
        $data['page_name'] = 'FAQs List';
        $data['faq_list'] = $this->common->list('faq_list');
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['user_detail'] = $this->common->view1();

        $data['faqcategory_list'] = $this->common->list('faq_list');
        $data['content_view'] = 'Faq/faq_list';
        $this->load->view('admin_template', $data);
    }

    public function add_faq() {
        $this->index->activity_log('Add FAQ');
        $this->form_validation->set_error_delimiters('', '');
//        $this->form_validation->set_rules('category_id', 'Category', 'trim|required');

        $this->form_validation->set_rules('faq', 'Question', 'trim|required');
        $this->form_validation->set_rules('answer', 'Answer', 'trim|required');

        if ($this->form_validation->run()) {
            $insert_data = array(
//                'category_id' => $this->input->post('category_id'),
                'faq' => $this->input->post('faq'),
                'status' => '1',
                'answer' => $this->input->post('answer'),
                'createdBy' => $this->session->userdata('user_id'),
                'createdDate' => DATE
            );
            $id = $this->common->insert_table('faq_list', $insert_data);
            if ($id) {
                $array = array(
                    'success' => 'Faq added successfully.'
                );
            }
        } else {
            $array = array(
                'error' => true,
//                'cat_error' => form_error('category_id'),
                'faq_error' => form_error('faq'),
                'answer_error' => form_error('answer')
            );
        }
        echo json_encode($array);
    }

    public function fetch_faq() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->input->post('id');
            $data = $this->common->fetch_data($id, 'faq_list');
            echo json_encode($data);
        }
    }

    public function editfaq($id) {
        if ($id == 'edit') {
            $this->form_validation->set_error_delimiters('', '');
//            $this->form_validation->set_rules('category_id', 'Category Name', 'trim|required');

            $this->form_validation->set_rules('faq', 'question', 'trim|required');
            $this->form_validation->set_rules('answer', 'Answer', 'trim|required');
            if ($this->form_validation->run()) {
                $id = $this->input->post('id');
                $update_data = array(
//                    'category_id' => $this->input->post('category_id'),
                    'faq' => $this->input->post('faq'),
                    'answer' => $this->input->post('answer'),
                  
                    
                );
                $this->common->update_table('faq_list', $update_data, $id);
                if($this->db->affected_rows() == 0){
                    $array = array(
                    'warning' => 'You have made no changes.'
                    );  
                }else{
                    $update_data['createdDate'] = DATE;
                    $update_data['createdBy'] = $this->session->userdata('user_id');
                    $this->common->update_table('faq_list', $update_data, $id);
                $array = array(
                    'success' => 'Faq Updated successfully.'
                );
            }
            } else {
                $array = array(
                    'error' => true,
//                    'cat1_error' => form_error('category_id'),
                    'faq1_error' => form_error('faq'),
                    'answer1_error' => form_error('answer')
                );
            }
            echo json_encode($array);
        } else {
            $data['page_name'] = 'FAQs List';
            $this->index->activity_log('Edit FAQ');
            $data['edit_details'] = $this->common->view('faq_list', $id);
            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
            $data['user_detail'] = $this->common->view1();

            $data['faqcategory_list'] = $this->common->list2('faq_category');
            $data['content_view'] = 'Faq/editfaq';
            $this->load->view('admin_template', $data);
        }
    }

    public function delete_faq() {
        $id = $this->input->post('id');
        $this->index->activity_log('Delete FAQ');
        $this->common->delete_table('faq_list', $id);
        $array = array(
            'success' => 'Faq deleted successfully.'
        );
        echo json_encode($array);
    }

    public function status_faq() {
        $this->index->activity_log('Status FAQ');
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('faq_list', $delete_data, $id);
        $array = array(
            'success' => 'Faq status updated successfully.'
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
            $abc = $this->common->deleteAll($checkbox, 'faq_list');

            $array = array(
                'success' => 'Selected Faq deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Faq',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'faq_list');

            $array = array(
                'success' => 'Selected Faq activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Faq',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'faq_list');

            $array = array(
                'success' => 'Selected Faq deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Faq',
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
            $abc = $this->common->deleteAll($checkbox, 'faq_category');
            $abc = $this->common->deleteAllcat($checkbox, 'faq_list');

            $array = array(
                'success' => 'Selected Faq Category deleted successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Faq Category',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'faq_category');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'faq_list');

            $array = array(
                'success' => 'Selected Faq Category activated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Faq Category',
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
            $abc = $this->common->statusall($checkbox, $delete_data, 'faq_category');
            $abc = $this->common->statusall1($checkbox, $delete_data, 'faq_list');

            $array = array(
                'success' => 'Selected Faq Category deactivated successfully.',
            );
        } else {

            $array = array(
                'error' => 'Select atleast one Faq Category',
            );
        }
        echo json_encode($array);
    }

}

?>
