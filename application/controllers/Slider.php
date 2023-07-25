<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'login');
        $this->load->model('Index_model', 'index');
        $this->load->model('Common_model', 'common');
        $this->load->model('Profile_model', 'pro');
        $this->login->is_logged_in();
        $this->index->activity_update();
    }

    public function index() {
        $data['page_name'] = 'slider-list';
        $this->index->activity_log('Slider list');
        $data['user_detail'] = $this->common->view1();
        $data['content_view'] = 'Slider/slider';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));

        $this->load->view('admin_template', $data);
    }

    public function editopinion($id) {
        if ($id == 'editslider') {

                $id = $this->input->post('id');

                $update_data['question'] = $this->input->post('question');
                $update_data['resp1'] = $this->input->post('resp1');
                $update_data['name1'] = $this->input->post('name1');
                $update_data['resp2'] = $this->input->post('resp2');

                $update_data['name2'] = $this->input->post('name2');
                

               
                $update_data['status'] = '1';

                $extensionResume = array("jpg", "jpeg", "JPG", "JPEG", "webp", "WEBP");

                if (isset($_FILES['slider1_img']) && $_FILES['slider1_img']['name'] != "") {
                    $extId = pathinfo($_FILES['slider1_img']['name'], PATHINFO_EXTENSION);
                    $errors = array();
                    $maxsize = 26214400;
                    if (!in_array($extId, $extensionResume) && (!empty($_FILES["slider1_img"]["type"]))) {
                        $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
                    }
                    if (($_FILES['slider1_img']['size'] >= $maxsize) || ($_FILES["slider1_img"]["size"] == 0)) {
                        $this->session->set_flashdata('error', 'Image Size Too Large');
                    }

                    $image_data = $_FILES['slider1_img'];
                    $path = './uploads/slider1/';
                    $file_path_image = base_url() . 'uploads/slider1/';
                    $image = $this->common->upload_image($image_data, 1, $path);
                    $update_data['slider1_img'] = $image;
                    $update_data['slider1_imgurl'] = $file_path_image . $image;
                }



                if (isset($_FILES['slider2_img']) && $_FILES['slider2_img']['name'] != "") {
                    $extId = pathinfo($_FILES['slider2_img']['name'], PATHINFO_EXTENSION);
                    $errors = array();
                    $maxsize = 26214400;
                    if (!in_array($extId, $extensionResume) && (!empty($_FILES["slider2_img"]["type"]))) {
                        $this->session->set_flashdata('error', 'Please Use only Jpg,Jpeg Format For Feature Image');
                    }
                    if (($_FILES['slider2_img']['size'] >= $maxsize) || ($_FILES["slider2_img"]["size"] == 0)) {
                        $this->session->set_flashdata('error', 'Image Size Too Large');
                    }

                    $image_data = $_FILES['slider2_img'];
                    $path = './uploads/slider2/';
                    $file_path_image = base_url() . 'uploads/slider2/';
                    $image = $this->common->upload_image($image_data, 1, $path);
                    $update_data['slider2_img'] = $image;
                    $update_data['slider2_imgurl'] = $file_path_image . $image;
                }

                

                $this->common->update_table('slider', $update_data, $id);
               if($this->db->affected_rows() == 0){
                $array = array(
                    'warning' => 'You have made no changes.'
                );
                 }else{
                 $update_data['createdBy'] = $this->session->userdata('user_id');
                 $update_data['createdDate'] = DATE;
                 $this->common->update_table('slider', $update_data, $id);
                $array = array(
                    'success' => 'Public Opinion updated successfully.'
                );
               
            }
            
             echo json_encode($array);
        
        } else {
            $data['page_name'] = 'Public Opinion';
            $this->index->activity_log('Public Opinion');
            $data['edit_details'] = $this->common->view('slider', $id);
            $data['user_detail'] = $this->common->view1();
            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
            $data['content_view'] = 'Slider/slider';

            $this->load->view('admin_template', $data);
        }
    }

    
     public function unlinkg() {

        $id = $this->input->post('id');

        $query = $this->common->un($id,'slider');

        $row = $query->row();

        $img1 = $row->slider1_img ;
        $img2 = $row->slider2_img ;

      
if($this->input->post('img')=='img1'){
     if(file_exists("uploads/slider1/".$img1)){

           unlink("uploads/slider1/".$img1);

          }

          $data = array('slider1_img' => NULL);

          $this->common->update_table('slider',$data, $id);
}else{
     if(file_exists("uploads/slider2/".$img2)){

           unlink("uploads/slider2/".$img2);

          }

          $data = array('slider2_img' => NULL);

          $this->common->update_table('slider',$data, $id);
}
      

         //redirect('edit-testimonial/'.$id.'');

            $array=array(

                'success'=>'Image Deleted successfully',

             );

         echo json_encode($array);

    }
    public function editecontact($id) {
        if ($id == 'contact') {
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('mob2', 'mob2 ', 'trim|required');
            $this->form_validation->set_rules('mob1', 'mob1 ', 'trim|required');

            $this->form_validation->set_rules('email1', 'email1 ', 'trim|required');

            $this->form_validation->set_rules('email2', 'email2 ', 'trim|required');

            $this->form_validation->set_rules('link', 'link', 'trim|required');

            if ($this->form_validation->run()) {
                $id = $this->input->post('id');
                $update_data = array(
                    'mob1' => $this->input->post('mob1'),
                    'mob2' => $this->input->post('mob2'),
                    'email1' => $this->input->post('email1'),
                    'email2' => $this->input->post('email2'),
                    'link' => $this->input->post('link'),
                    'address' => $this->input->post('address')
                );
                $this->common->update_table('update_contact', $update_data, $id);
                $array = array(
                    'success' => 'Contact Updated successfully.'
                );
            } else {
                $array = array(
                    'error' => true,
                    'mobile1_error' => form_error('mob1'),
                    'mobile2_error' => form_error('mob2'),
                    'email1_error' => form_error('email1'),
                    'email2_error' => form_error('email2'),
                    'map_error' => form_error('link')
                );
            }
            echo json_encode($array);
        } else {
            $data['page_name'] = 'Add Seo';
            $this->index->activity_log('slider Seo');
            $data['edit_details'] = $this->common->view('update_contact', $id);
            $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
            $data['content_view'] = 'Slider/contact';
            $data['user_detail'] = $this->common->view1();
            $this->load->view('admin_template', $data);
        }
    }

}

?>
